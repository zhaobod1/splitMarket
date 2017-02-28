<?php
include_once("../function.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
header("Content-Type: text/html;charset=utf-8");
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and pdt>='".$TimeStart."' and pdt<='".$TimeEnd."'";	
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

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>个人资料</title>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="10" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1"><?=$member2?></option>
            <option value="2"><?=$member5?></option>
            <option value="3"><?=$member8?></option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="button_blue" value="<?=$anniu4?>"></td>
      </tr>
      <tr>
        <td height="5" colspan="10" align="left"><?=$shijiansousuo?>：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <tr>
        <td height="10" colspan="10" align="center"><?=$member1?></td>
      </tr>
      <tr>
        <td align="center"><?=$member2?></td>
        <td align="center"><?=$member3?></td>
        <td align="center"><?=$member4?></td>
        <td align="center"><?=$member5?></td>
        <td align="center"><?=$member5?></td>
        <td align="center"><?=$member7?></td>
        <td align="center"><?=$member9?></td>
        <td align="center"><?=$member8?></td>
        <td align="center"><?=$member10?></td>
        <td align="center"><?=$member11?></td>
    </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` WHERE ispay>0 and bdid=".$_SESSION['ID']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` WHERE ispay>0 and bdid=".$_SESSION['ID']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by pdt desc,id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
      <tr>
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$ul['lvname']?></td>
        <td align="center"><?=$row['rname']?></td>
        <td align="center"><?=$row['fathername']?></td>
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['userqq']?></td>
        <td align="center"><?=$row['bdname']?></td>
        <td align="center"><?=$row['pdt']?></td>
        <td align="center"><a href="UpdateProfile.php?id=<?=$row['id']?>"><?=$member11?></a></td>
      </tr>
      <?php
			}
		}
	  ?>
    </table>
    <table width="100%" border="0" class="ziti">
          <tr>
            <td align="left">&nbsp;</td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table>
</form>
</body>
</html>