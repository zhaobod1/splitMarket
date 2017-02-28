<?php
include("check.php");
include_once("../function.php");

session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}

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
		$_SESSION['SearchTime']="and fdate>='".$TimeStart."' and fdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
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

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
		$mail['issdelete']=1;
    	edit_update_cl('mail',$mail,$id);
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
<title>收件箱</title>
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
        <td height="4" colspan="6" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1"><?=$shouxin1?></option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="button_blue" value="<?=$anniu4?>">        <!--<input type="button" name="dayin" id="dayin" class="btn1" value="导出表格" onClick="exportExcel('daochu')">--></td>
      </tr>
      <tr>
        <td height="5" colspan="6" align="left"><?=$shijiansousuo?>：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <div id="daochu">
      <tr>
        <td height="10" colspan="6" align="center"><?=$menu23?></td>
      </tr>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center"><?=$shouxin1?></td>
        <td align="center"><?=$shouxin2?></td>
        <td align="center"><?=$shouxin3?></td>
        <td align="center"><?=$shouxin4?></td>
        <td align="center"><?=$shouxin5?></td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `mail` WHERE sid=".$_SESSION['ID']." and issdelete=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `mail` WHERE sid=".$_SESSION['ID']." and issdelete=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by fdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['title']?></td>
        <td align="center"><?=$row['fdate']?></td>
        <td align="center"><?php if ($row['isread']==0){?><font color="#FF0000">未读</font><?php }elseif($row['isread']==1){?>已读<?php }?></td>
        <td align="center"><input name="" type="button" class="button_green" value="<?=$anniu5?>" onClick="window.location.href='mailcontent.php?mid=<?=$row['id']?>&hf=1'"></td>
      </tr>
      <?php
			}
		}
	  ?>
      </div>
    </table>
    <table width="100%" border="0" class="ziti">
          <tr>
            <td align="left"><input name="button4" type="submit" class="button_red" id="button4" value="<?=$shouxin6?>" onClick="{if(confirm('您确定要删除该邮件吗?')){this.document.selform.submit();return true;}return false;}"></td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table>
</form>
</body>
</html>