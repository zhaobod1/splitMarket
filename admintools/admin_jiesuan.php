<?php 
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(3,26);

if ($_POST['button1']){
	$bonus_cl=new bonus_class();
	$bonus_cl->b2bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('日结算完成.');window.location.href='?'</script>";
}

if ($_POST['button2']){
	$bonus_cl=new bonus_class();
	$bonus_cl->b4bonus();
	$bonus_cl->b0bonus2();
	echo "<script language=javascript>alert('周结算完成.');window.location.href='?'</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清空数据库</title>
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
    <td align="center"><strong><font color="#FF0000">注意：结算奖金前请先做好数据备份</font></strong></td>
  </tr>
  <tr style="display:none">
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <input name="button1" type="submit" class="btn2" id="button1" value="日结算" onClick="{if(confirm('您确定要结算奖金吗?')){this.document.selform.submit();return true;}return false;}"/>
    </form></td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <input name="button2" type="submit" class="btn2" id="button2" value="周结算" onClick="{if(confirm('您确定要结算奖金吗?')){this.document.selform.submit();return true;}return false;}"/>
    </form></td>
  </tr>
</table>
</body>
</html>