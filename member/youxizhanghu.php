<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language'] == 1) {
	include_once("../language/zh.php");
} else {
	include_once("../language/en.php");
}
$us = que_select_cl('member', $_SESSION['ID']);
$system_cl = new system_class();
$sys = $system_cl->system_information(1);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/table.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>游戏账户</title>
</head>
<body>

<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
    <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
            <td height="22" colspan="2" align="center"><?= $yxzh1 ?></td>
        </tr>
        <tr>
            <td width="50%" height="22" align="right"><?= $yxzh2 ?>
                ：
            </td>
            <td width="50%" align="left"><?= round($us['pe']) ?></td>
        </tr>
        <tr>
            <td width="50%" height="22" align="right"><?= $yxzh3 ?>
                ：
            </td>
            <td width="50%" align="left"><?= $us['yxb'] ?></td>
        </tr>
        <tr>
            <td width="50%" height="22" align="right">
                <?///*= $yxzh4 */?><!--：-->
                商城币：
            </td>
            <!--<td width="50%" align="left">--><?//= $us['gwb'] ?><!--</td>-->
            <td width="50%" align="left"><?= $us['shop_coin'] ?></td>
        </tr>
        <tr>
            <td width="50%" height="22" align="right"><?= $yxzh5 ?>
                ：
            </td>
            <td width="50%" align="left"><?= $us['pe'] * $sys['peprice'] ?></td>
        </tr>
    </table>
    <br>
</form>
</body>
</html>