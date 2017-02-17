<!DOCTYPE HTML>
<?php
include_once("../function.php");
include_once("../class/system_class.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$today = time()+3600*8;//这里和标准时间相差8小时需要补足
$day1 = $today-3600*24*1;
$day2 = $today-3600*24*2;
$day3 = $today-3600*24*3;
$day4 = $today-3600*24*4;
$day5 = $today-3600*24*5;
$day6 = $today-3600*24*6;
$day7 = $today-3600*24*7;
$day8 = $today-3600*24*8;
$day9 = $today-3600*24*9;

addgupiaolist($today,0,0);

$categories="categories: ['".date("m-d",$day9)."', '".date("m-d",$day8)."', '".date("m-d",$day7)."', '".date("m-d",$day6)."', '".date("m-d",$day5)."', '".date("m-d",$day4)."', '".date("m-d",$day3)."', '".date("m-d",$day2)."', '".date("m-d",$day1)."', '".date("m-d",$today)."']";

$data="data: [".getPricebyTime($day9).", ".getPricebyTime($day8).", ".getPricebyTime($day7).", ".getPricebyTime($day6).", ".getPricebyTime($day5).", ".getPricebyTime($day4).", ".getPricebyTime($day3).", ".getPricebyTime($day2).", ".getPricebyTime($day1).", ".getPricebyTime($today)."]";

function getPricebyTime($t){
	$price=0;
	$sql="select * from `stockrecord` where year(sdate)=".date("Y",$t)." and month(sdate)=".date("m",$t)." and day(sdate)=".date("d",$t)."";
	if ($query=mysql_query($sql)){
		while($row=mysql_fetch_array($query)){
			$price=$price+$row["num"];
		}
	}else{
		$price=0;
	}
	return $price;
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>交易量图</title>
        <link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            title: {
                text: '交易量图',
                x: -20 //center
            },
            subtitle: {
                text: '最近10天交易量',
                x: -20
            },
            xAxis: {
                <?=$categories?>
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '交易数量',
                <?=$data?>
            }]
        });
    });
</script>
	</head>
<body>
<script src="../js/zoushitu/exporting.js"></script>
<script src="../js/zoushitu/highcharts.js"></script>
<div id="container" style="min-width: 310px; height: 300px; margin: 0 auto" ></div>
<table width="50%" cellpadding="3" cellspacing="1" border="0" align="left" class="table1">
  <tr>
    <td height="20" colspan="4" align="center"> <?=$yxhq2?></td>
  </tr>
  <tr>
    <td align="center"><?=$yxhq4?></td>
    <td align="center"><?=$yxhq5?></td>
    <td align="center"><?=$yxhq6?></td>
    <td align="center"><?=$yxhq8?></td>
  </tr>
  <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 and isjs=0";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码 
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 and isjs=0 order by price,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
  <tr>
    <td align="center"><?=$row['nickname']?></td>
    <td align="center"><?=round($row['num'])?></td>
    <td align="center"><?=$row['price']?></td>
    <td align="center"><?=$row['price']*$row['num']?></td>
  </tr>
  <?php
			}
		}
	  ?>
</table>
<table width="50%" cellpadding="3" cellspacing="1" border="0" align="right" class="table1">
 <tr>
    <td height="20" colspan="4" align="center"> <?=$yxhq3?></td>
  </tr>
  <tr>
    <td align="center"><?=$yxhq4?></td>
    <td align="center"><?=$yxhq5?></td>
    <td align="center"><?=$yxhq7?></td>
    <td align="center"><?=$yxhq8?></td>
  </tr>
  <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE lx=0 and isjs=0";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码 
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `stockbuy` WHERE lx=0 and isjs=0 order by price desc,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
  <tr>
    <td align="center"><?=$row['nickname']?></td>
    <td align="center"><?=round($row['num'])?></td>
    <td align="center"><?=$row['price']?></td>
    <td align="center"><?=$row['price']*$row['num']?></td>
  </tr>
  <?php
			}
		}
	  ?>
</table>
</body>
</html>
