<?php
include_once("../function.php");
session_start();
if ($_GET['mid']!=NULL){
	$mail=que_select_cl('mail',$_GET['mid']);
	if ($mail['sid']==$_SESSION['ID']){
		if ($mail['isread']==0){
			$mail_update['isread']=1;
			echo edit_update_cl('mail',$mail_update,$mail['id']);	
		}
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title><?=$mail['title']?></title>
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td valign="top" align="center"><h1><?=$mail['title']?></h1></td>
  </tr>
  <tr>
    <td valign="top" ><?=$mail['mailcontent']?><p></p></td>
  </tr>
  <tr>
    <td align="right" class="ziti" ><hr><?=$mail['nickname']?> 发送至 <?=$mail['snickname']?><br><?=$mail['fdate']?></td>
  </tr>
  <tr>
    <td align="center">
    <?php if ($_GET['hf']==1){?><input name="" type="button" class="button_green" value="回  复" onClick="window.location.href='mailadd.php?nickname=<?=$mail['nickname']?>'">&nbsp;&nbsp;<?php }?><input name="" type="button" class="button_blue" value="返  回" onClick="history.back(-1)">
    </td>
  </tr>
</table>
</body>
</html>