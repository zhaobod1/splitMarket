<?php
include_once("../function.php");
session_start();
if ($_GET['nid']!=NULL){
	$news=que_select_cl('news',$_GET['nid']);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title><?=$news['newstitle']?></title>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td valign="top" align="center"><strong><?=$news['newstitle']?></strong><br><hr></td>
  </tr>
  <tr>
    <td valign="top" ><?=$news['newscontent']?><p></p></td>
  </tr>
  <tr>
    <td valign="top" ><hr></td>
  </tr>
  <tr>
    <td align="center" > <input name="" type="button" class="button_blue" value="返  回" onClick="history.back(-1)"></td>
  </tr>
 
</table>
</body>
</html>