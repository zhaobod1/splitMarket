<?php
include_once("../function.php");
include_once("../class/system_class.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<title>会员信息</title>
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

<body scroll="no" style="height:400px;">
<?php
$_system=new system_class();
$system=$_system->system_right();
?>
<table width="100%" height="300" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
    <td width="28%" align="right">上次登录时间:</td>
    <td width="22%"><?=$_SESSION['sclgdate']?></td>
    <td width="27%" align="right">本次登录时间：</td>
    <td width="23%"><?=$_SESSION['lgdate']?></td>
  </tr>
  <tr>
    <td align="right">本日新增会员：</td>
    <td><font color="#FF0000">
      <?=$system['xhyday']?>
    </font></td>
    <td align="right">本日新增收入：</td>
    <td><font color="#FF0000">
      <?=$system['xyejiday']?>
    </font></td>
  </tr>
  <tr>
    <td align="right">本月新增会员：</td>
    <td><font color="#FF0000">
      <?=$system['xhymonth']?>
    </font></td>
    <td align="right">本月新增收入：</td>
    <td><font color="#FF0000">
      <?=$system['xyejimonth']?>
    </font></td>
  </tr>
  <tr>
    <td align="right">年度新增会员：</td>
    <td><font color="#FF0000">
      <?=$system['xhyyear']?>
    </font></td>
    <td align="right">年度新增收入：</td>
    <td><font color="#FF0000">
      <?=$system['xyejiyear']?>
    </font></td>
  </tr>
  <tr>
    <td align="right">待激活会员：</td>
    <td><font color="#0000FF"><?=$system['weijh']?>
    </font>&nbsp;
    <input type="submit" class="button" id="button" name="button" value="现在处理" onClick="window.location.href='admin_jihuo.php'" /></td>
    <td align="right">已激活会员：</td>
    <td><font color="#0000FF"><?=$system['yijh']?>
    </font>&nbsp;<input type="submit" class="button" id="button" name="button" value="现在处理"  onClick="window.location.href='admin_member.php'" /></td>
  </tr>
  <tr>
    <td align="right">待处理提现申请：</td>
    <td><font color="#0000FF">
      <?=$system['tixian']?>
    </font>&nbsp;
    <input type="submit" class="button" id="button2" name="button2" value="现在处理" onClick="window.location.href='admin_tixian.php'" /></td>
    <td align="right">待处理充值申请：</td>
    <td><font color="#0000FF">
      <?=$system['chongzhi']?>
    </font>&nbsp;
    <input type="submit" class="button" id="button4" name="button4" value="现在处理" onClick="window.location.href='admin_chongzhi.php'" /></td>
  </tr>
  <tr>
    <td align="right">待处理汇款通知：</td>
    <td><font color="#0000FF">
      <?=$system['tongzhi']?>
    </font>&nbsp;
    <input type="submit" class="button" id="button3" name="button3" value="现在处理" onClick="window.location.href='admin_huikuan.php'" /></td>
    <td align="right">待处理商品订单：</td>
    <td><font color="#0000FF">
      <?=$system['dingdan']?>
    </font>&nbsp;
    <input type="submit" class="button" id="button5" name="button5" value="现在处理" onClick="window.location.href='admin_Orders.php'" /></td>
  </tr>
</table>
</body>
</html>