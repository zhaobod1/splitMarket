<?php
include("check.php");
include("check2.php");
include_once("../function.php");

session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
	$us=getMemberbyID($_SESSION['ID']);
	$bdName=$us['bdname'];
	$rName=$us['rname'];
	$FatherName=$us['fathername'];
	$TreePlace=$us['treeplace'];
	$UserID=$us['userid'];
	$NickName=$us['nickname'];
	$UserName=$us['username'];
	$UserTel=$us['usertel'];
	$UserAddress=$us['useraddress'];
	$UserQQ=$us['userqq'];
	$BankName=$us['bankname'];
	$BankCard=$us['bankcard'];
	$BankUserName=$us['bankusername'];
	$BankAddress=$us['bankaddress'];
	$zhifubao=$us['zhifubao'];
	$caifutong=$us['caifutong'];
	$rdt=$us['rdt'];
	$pdt=$us['pdt'];
	$uLevel=$us['ulevel'];
	$useremail=$us['useremail'];
	$rus=getMemberbyID($us['reid']);
	$fus=getMemberbyID($us['fatherid']);
	$rusername=$rus['username'];
	$fusername=$fus['username'];
	switch ($TreePlace)
	{
		case 0:
			$quyu="顶层用户";
			break;
		case 1:
			$quyu="A区";
			break;
		case 2:
			$quyu="B区";
			break;
		case 3:
			$quyu="C区";
			break;
		case 4:
			$quyu="D区";
			break;
		case 5:
			$quyu="E区";
			break;
		case 6:
			$quyu="F区";
			break;
		case 7:
			$quyu="G区";
			break;	
	}
	$ul=ulevel($uLevel);
	$jibie=$ul['lvname'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>个人资料</title>
</head>
<body>
<table  width="100%" height="100%" cellpadding="3" cellspacing="1"  align="center" class="table1" border="0">
	<tr>
    <td colspan="2" align="center"><?=$personal1?></td>
    </tr>
	<tr>
	  <td width="50%" align="right"><?=$personal2?>：</td>
	  <td width="50%" align="left"><?=$bdName?></td>
    </tr>
	<tr>
    <td align="right"><?=$personal3?>：</td>
    <td align="left">
      <?=$rName?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal4?>：</td>
    <td align="left">
      <?=$rusername?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal5?>：</td>
    <td align="left">
      <?=$FatherName?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal6?>：</td>
    <td align="left">
      <?=$fusername?></td>
  </tr>
  <tr style="display:none">
    <td align="right">安置区域：</td>
    <td align="left">
      <?=$quyu?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal7?>
    ：</td>
    <td align="left">
      <?=$UserID?></td>
  </tr>
  <tr style="display:none">
    <td align="right">会员编号：</td>
    <td align="left"><?=$NickName?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal8?>
    ：</td>
    <td align="left"><?=$UserName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">联系地址：</td>
    <td align="left"><?=$UserAddress?></td>
  </tr>
  <tr style="display:none">
    <td align="right">联系电话：</td>
    <td align="left"><?=$UserTel?></td>
  </tr>
  <tr style="display:none">
    <td align="right">电子邮箱：</td>
    <td align="left"><?=$useremail?></td>
  </tr>
  <tr style="display:none">
    <td align="right">QQ号码：</td>
    <td align="left"><?=$UserQQ?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户银行：</td>
    <td align="left">
      <?=$BankName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户帐号：</td>
    <td align="left"><?=$BankCard?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户姓名：</td>
    <td align="left"><?=$BankUserName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户地址：</td>
    <td align="left"><?=$BankAddress?></td>
  </tr>
  <tr style="display:none">
    <td align="right">支付宝账号：</td>
    <td align="left"><?=$zhifubao?></td>
  </tr>
  <tr style="display:none">
    <td align="right">财付通帐号：</td>
    <td align="left"><?=$caifutong?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal9?>
    ：</td>
    <td align="left"><?=$rdt?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal10?>
    ：</td>
    <td align="left"><?=$pdt?></td>
  </tr>
  <tr>
    <td align="right"><?=$personal11?>
    ：</td>
    <td align="left">
      <?=$jibie?></td>
  </tr>
</table>
</body>
</html>