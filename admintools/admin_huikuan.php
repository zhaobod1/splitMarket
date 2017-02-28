<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(2,6);
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	$SearchType=$_POST['SearchType'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and sdate>='".$TimeStart."' and sdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}
	}else{
		if ($SearchType==1){
			$_SESSION['Search']=NULL;
		}elseif($SearchType==2){
			#搜索未确认
			$_SESSION['Search']="and isgrant=0";
		}elseif($SearchType==3){
			#搜索已确认
			$_SESSION['Search']="and isgrant=1";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#提现确认
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$tixian['isgrant']=1;
	foreach ((array)$cheuid_arr as $id)
	{
		$hk=que_select_cl("huikuan",$id);
		if ($hk['isgrant']==0){
			$us=getMemberbyID($hk['uid']);
			$us_update['gwb']=$us['zsq']+$hk['jine']+$hk['jine']*0.03;
			edit_update_cl('member',$us_update,$us['id']);
			edit_update_cl('huikuan',$tixian,$id);
		}
	}
	echo "<script language=javascript>alert('确认完成.');window.location.href='?'</script>";
}

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('huikuan',$id);
	}
	echo "<script language=javascript>alert('删除完成.');window.location.href='?'</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>汇款通知</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
-->
</script>
<script language="javascript"> 
<!--     
//导出excel
function exportExcel(DivID){
var oXL = new ActiveXObject("Excel.Application"); 
  var oWB = oXL.Workbooks.Add(); 
  var oSheet = oWB.ActiveSheet;  
  var sel=document.body.createTextRange();
  sel.moveToElementText(daochu);
  sel.select();
  sel.execCommand("Copy");
  oSheet.Paste();
  oXL.Visible = true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="0" border="0" align="center" class="table1">
      <tr>
        <td height="4" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
            <option value="2">未确认</option>
            <option value="3">已确认</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索"></td>
        <td height="4" align="center"><input type="button" name="dayin" id="dayin" class="btn1" value="导出表格" onClick="exportExcel('daochu')"></td>
      </tr>
      <tr>
        <td height="5" colspan="2" align="left">搜索时间范围：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <tr><td colspan="2">
      <table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" class="table1" id="daochu">
      <tr>
        <td height="10" colspan="11" align="center"> 汇 款 通 知</td>
      </tr>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td align="center">汇款帐户</td>
        <td align="center">账户姓名</td>
        <td align="center">汇款金额</td>
        <td align="center">汇款时间</td>
        <td align="center">汇款说明</td>
        <td align="center">记录时间</td>
        <td align="center">服务中心</td>
        <td align="center">汇款确认</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `huikuan` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `huikuan` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by hdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['bankcard']?></td>
        <td align="center"><?=$row['bankusername']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['sdate']?></td>
        <td align="center"><?=$row['shuoming']?></td>
        <td align="center"><?=$row['hdate']?></td>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?php if ($row['isgrant']==1){?>
          已确认
          <?php }else{?> 
        <font color="#FF0000">未确认</font><?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
      </table>
      </td>
      </tr>
      <tr>
        <td height="21" colspan="2" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left"><input name="button" type="submit" class="btn1" id="button" value="确认汇款" onClick="{if(confirm('您确定要进行确认吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="btn3" id="button4" value="删除记录" onClick="{if(confirm('您确定要删除该记录吗?')){this.document.selform.submit();return true;}return false;}"></td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>