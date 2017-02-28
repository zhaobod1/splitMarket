<?php
include("check.php");
include_once("../function.php");
include_once("../class/txczzh_class.php");
date_default_timezone_set('PRC');
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$txczzh_cl=new txczzh_class();
$ytx=$txczzh_cl->gettxbyuidisgrant($_SESSION['ID'],1);
$dtx=$txczzh_cl->gettxbyuidisgrant($_SESSION['ID'],0);
$ycz=$txczzh_cl->getczbyuidisgrant($_SESSION['ID'],1);
$dcz=$txczzh_cl->getczbyuidisgrant($_SESSION['ID'],0);
$zzzc=$txczzh_cl->getzzbyuid($_SESSION['ID']);
$zzsr=$txczzh_cl->getzzbysid($_SESSION['ID']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
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

<body style="width:638px; height:600px;">
<?php
$us=getMemberbyID($_SESSION['ID']);
?>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
  	<?php 
	$ul=ulevel($us['ulevel']);
$h=(int)date("H");
switch ($h){
	case 0:
		$shijian="晚上";	
		break;
	case 1:
		$shijian="晚上";	
		break;
	case 2:
		$shijian="晚上";	
		break;
	case 3:
		$shijian="晚上";	
		break;
	case 4:
		$shijian="晚上";	
		break;
	case 5:
		$shijian="晚上";	
		break;
	case 6:
		$shijian="晚上";	
		break;
	case 7:
		$shijian="上午";	
		break;
	case 8:
		$shijian="上午";	
		break;
	case 9:
		$shijian="上午";	
		break;
	case 10:
		$shijian="上午";	
		break;
	case 11:
		$shijian="上午";	
		break;
	case 12:
		$shijian="上午";	
		break;
	case 13:
		$shijian="下午";	
		break;
	case 14:
		$shijian="下午";	
		break;
	case 15:
		$shijian="下午";	
		break;
	case 16:
		$shijian="下午";	
		break;
	case 17:
		$shijian="下午";	
		break;
	case 18:
		$shijian="下午";	
		break;
	case 19:
		$shijian="晚上";	
		break;
	case 20:
		$shijian="晚上";	
		break;
	case 21:
		$shijian="晚上";	
		break;
	case 22:
		$shijian="晚上";	
		break;
	case 23:
		$shijian="晚上";	
		break;
}
	$xjibie="";
	switch ($us['xlevel']){
		case 1:
			$xjibie="一星";
			break;
		case 2:
			$xjibie="二星";
			break;
		case 3:
			$xjibie="三星";
			break;
		case 4:
			$xjibie="四星";
			break;
		case 5:
			$xjibie="五星";
			break;
		case 6:
			$xjibie="一总";
			break;
		case 7:
			$xjibie="二总";
			break;
		case 8:
			$xjibie="三总";
			break;
		case 9:
			$xjibie="四总";
			break;
		case 10:
			$xjibie="五总";
			break;	
	}
	?>
    <td colspan="2" align="center">
    <?php if ($_SESSION['language']==1){?>
    尊敬的<!--<?=$ul['lvname']?>-->会员
      <font color="#FF0000">
      <?=$_SESSION['userid']?>
	  <?php if($_SESSION['bdlevel']>0){
		  if($_SESSION['bdlevel']==1){
			echo "-服务中心";  
		  }elseif($_SESSION['bdlevel']==2){
			echo "-服务中心";  
		  }
	  }
		  ?>
    </font><?=$shijian?>    好 ！
    <?php }else{?>
    Welcome <?=$_SESSION['nickname']?>
    <?php }?>
    </td>
  </tr>
  <tr>
    <td align="center"><?=$shou1?>:<font color="#FF0000"><?=$_SESSION['sclogin']?></font></td>
    <td align="center"><?=$shou2?>：<font color="#FF0000"><?=$_SESSION['bclogin']?></font></td>
  </tr>
  <tr>
    <td align="center"><?=$shou3?>：<font color="#FF0000">
      <?=$us['maxmey']?>
    </font></td>
    <td align="center"><?=$shou4?>：<font color="#FF0000">
      <?=$us['mey']?>
    </font></td>
  </tr>
  <tr>
    <td align="center"><?=$shou5?>
      ：<font color="#FF0000">
      <?=$us['zsq']?>
    </font></td>
    <td align="center"><?=$shou6?>
      ：<font color="#FF0000">
      <?=$us['yxb']?>
    </font></td>
  </tr>
  <tr style="display:none">
    <td align="center"><?=$shou7?>：<font color="#FF0000"><?=$ytx?></font></td>
    <td align="center"><?=$shou8?>：<font color="#FF0000"><?=$dtx?></font></td>
  </tr>
  <tr style="display:none">
    <td align="center">已充值：<font color="#FF0000"><?=$ycz?></font></td>
    <td align="center">待确认充值：<font color="#FF0000"><?=$dcz?></font></td>
  </tr>
  <tr style="display:none">
    <td align="center">转账支出：<font color="#FF0000"><?=$zzzc?></font></td>
    <td align="center">转账收入：<font color="#FF0000"><?=$zzsr?></font></td>
  </tr>
</table><br />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr>
<td width="80%" style="border-bottom:#999 solid 1px;"><h4><?=$menu1?></h4></td>
<td width="20%" style="border-bottom:#999 solid 1px;"><a href="newslist.php" class="button_link_green"><?=$anniu5?></a></td>
</tr>
<?php
$txczzh_cl=new txczzh_class();
if($array=$txczzh_cl->getnewstopnum(5)){
	foreach($array as $row){
		echo "<tr>";
		echo "<td align='left'><font size='-1'>";
		echo "<a href='newscontent.php?nid=".$row['id']."'>".$row['newstitle']."</a>";
		echo "</font></td>";
		echo "<td align='right'><font size='-1'>";
		echo $row['newstime'];
		echo "</font></td>";
		echo "</tr>";
	}
}
?>
</table>
<table width="100%" border="0" cellpadding="10" cellspacing="0" style="display:none">
<tr>
<td width="248" style="border-bottom:#999 solid 1px;"><h4>商品展示</h4></td>
<td width="257" style="border-bottom:#999 solid 1px; display:none"><a href="goodslist.php" class="button_link_green">到商城</a></td>
</tr>
</table>
<style type="text/css">
<!--
#demo {
background: #FFF;
overflow:hidden;
border: 1px dashed #CCC;
width: 100%;
}
#demo img {
border: 3px solid #F2F2F2;
}
#indemo {
float: left;
width: 800%;
}
#demo1 {
float: left;
}
#demo2 {
float: left;
}
-->
</style>
<!--<div id="demo">
<div id="indemo">
<div id="demo1">
<?php 
if ($array=$txczzh_cl->getgoodstopnum(10)){
	foreach($array as $row){
		echo "<a href='goodscontent.php?id=".$row['id']."'>";
		echo "<img src='../upload/".$row['goodsimg']."' border='0'  width=125 height=125 alt='".$row['goodsname']."' title='".$row['goodsname']."'/>";
		echo "</a>";	
	}
}
?>
</div>
<div id="demo2"></div>
</div>
</div>-->
<script>
<!--
var speed=20;
var tab=document.getElementById("demo");
var tab1=document.getElementById("demo1");
var tab2=document.getElementById("demo2");
tab2.innerHTML=tab1.innerHTML;
function Marquee(){
if(tab2.offsetWidth-tab.scrollLeft<=0)
tab.scrollLeft-=tab1.offsetWidth
else{
tab.scrollLeft++;
}
}
var MyMar=setInterval(Marquee,speed);
tab.onmouseover=function() {clearInterval(MyMar)};
tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
-->
</script>
</body>
</html>