<?php
include("check.php");
include_once("../function.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$information=que_select_cl('information',1);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>公司账户</title>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td valign="top" align="center"><strong><?=$menu4?></strong><br><hr></td>
  </tr>
  <tr>
    <td valign="top" ><?=$information['company']?><p></p></td>
  </tr>
  <tr>
    <td valign="top" ><hr></td>
  </tr>
</table>
</body>
</html>