<?php
include("../admin_check.php");
include_once("../../function.php");
checkqx(3,10);
$pid=$_GET['pid'];
$sql="select * from `member` where userprovinceid=".$pid;
if ($query=mysql_query($sql)){
	$zcount=mysql_num_rows($query);
}else{
	$zcount=0;
	echo "aaa";
}


$sql="select * from `member` where ispay>0 and userprovinceid=".$pid;
if($query=mysql_query($sql)){
	$zscount=mysql_num_rows($query);
}else{
	$zscount=0;	
}


$sql="select * from `member` where ispay=0 and userprovinceid=".$pid;
if($query=mysql_query($sql)){
	$lscount=mysql_num_rows($query);
}else{
	$lscount=0;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo getProvincebyid($pid);?></title>
</head>
<body>
会员总数：<?=$zcount?>人<br />
正式会员：<?=$zscount?>人<br />
临时会员：<?=$lscount?>人
</body>
</html>