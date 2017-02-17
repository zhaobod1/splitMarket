<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(1,1);
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and rdt>='".$TimeStart."' and rdt<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}elseif($SearchType==2){
			#搜索推荐人
			$_SESSION['Search']="and rname='".$SearchContent."'";
		}elseif($SearchType==3){
			#搜索报单中心
			$_SESSION['Search']="and bdname='".$SearchContent."'";
		}
	}else{
		$_SESSION['Search']=NULL;	
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#激活会员
if ($_POST['button']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	$bonus_cl=new bonus_class();
	$chenggong=0;
	$shibai=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	$_member->jihuomember($id);
	}
	$bonus_cl->b2bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('会员激活完成');window.location.href='?'</script>";
}

#顶层会员
if ($_POST['button2']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
	{
    	$_member->dingcengmember($id);
	}
	echo "<script language=javascript>alert('会员已设置为团队领导.');window.location.href='?'</script>";
}

#空单会员
if ($_POST['button3']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
	{
    	$_member->kongdanmember($id);
	}
	echo "<script language=javascript>alert('空单会员设置完成.');window.location.href='?'</script>";
}

#删除会员
if ($_POST['button4']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
	{
		if ($_member->checkfman($id)){
    		edit_delete_cl('member',$id);
		}else{
			$us=$_member->getMemberbyID($id);
			echo "<script language=javascript>alert('会员".$us['nickname']."下方已经安置了会员,删除失败.');window.location.href='?'</script>";	
		}
	}
	echo "<script language=javascript>alert('删除会员完成.');window.location.href='?'</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>激活会员</title>
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
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="4" colspan="9" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
            <option value="2">推荐人</option>
            <option value="3">服务中心</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索"></td>
      </tr>
      <tr>
        <td height="5" colspan="9" align="left">搜索时间范围：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <tr>
        <td height="10" colspan="9" align="center">未激活会员</td>
      </tr>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td align="center">投资金额</td>
        <td align="center">会员资格</td>
        <td align="center">推荐人</td>
        <td align="center">接点人</td>
        <td style="display:none" align="center">联系电话</td>
        <td style="display:none" align="center">QQ号码</td>
        <td align="center">服务中心</td>
        <td align="center">详细信息</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` WHERE ispay=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` WHERE ispay=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by rdt desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['lsk']?></td>
        <td align="center"><?=$ul['lvname']?></td>
        <td align="center"><?=$row['rname']?></td>
        <td align="center"><?=$row['fathername']?></td>
        <td style="display:none" align="center"><?=$row['usertel']?></td>
        <td style="display:none" align="center"><?=$row['userqq']?></td>  
        <td align="center"><?=$row['bdname']?></td>
        
        <td align="center"><input type="button" class="button" id="button" name="button" value="查看" onClick="window.location.href='admin_UpdateProfile.php?ID=<?=$row['id']?>'" /></td>
      </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="9" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left"><input name="button" type="submit" class="btn1" id="button" value="激活会员" onClick="{if(confirm('您确定要激活该会员吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button2" type="submit" class="btn1" id="button2" value="团队领导" onClick="{if(confirm('您确定要将该会员设置为团队领导吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button3" type="submit" class="btn1" id="button3" value="空单会员" onClick="{if(confirm('您确定要将该会员设置为空单会员吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="btn3" id="button4" value="删除会员" onClick="{if(confirm('您确定要删除该会员吗?')){this.document.selform.submit();return true;}return false;}"></td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>