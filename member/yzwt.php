<style type="text/css">
body p {
	color: #666;
	font-size: 12px;
}
</style>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />
<title>密码问题验证</title>

</head>
<?php
include("check.php");
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
echo "<script language=javascript>window.location.href='UpdateProfile.php'</script>";	
//验证
if($_POST['submit']){
	if (checkQuestion($_SESSION['nickname'],$_POST['passanswer'])){
		echo "<script language=javascript>window.location.href='UpdateProfile.php'</script>";	
	}else{
		echo "<script language=javascript>alert('密码安全答案错误,请重新输入.');window.location.href='?'</script>";
	}
}
?>
<body>
<form name="form1" method="POST" action="?">
<table width="330" border="0" align="center" cellpadding="3" cellspacing="1" class="table1">
  <tr>
    <td align="center"><p>密码安全问题:<?=$member['passquestion']?></p></td>
  </tr>
  <tr>
    <td align="center">
    <p>请输入密码安全答案:
      <input name="passanswer" type="text" id="passanswer" size="20" ></p>
    </td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td align="center"><input name="submit" type="submit" class="button_green" value="确  认"></td>
  </tr>
</table>

</form>
</body>
</html>