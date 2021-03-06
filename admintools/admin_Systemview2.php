<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript">
		<?php
			include("admin_check.php");
			include_once("../function.php");
			session_start();
header("Content-Type: text/html;charset=utf-8");
			checkqx(3,11);
			$_Month[13];
			$y=date("Y");
			for ($i=1;$i<=12;$i++){
				$sql="SELECT * FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i."";
				$query=mysql_query($sql);
				if(mysql_num_rows($query) >= 1){
					$sql1="SELECT sum(xzyj),sum(ff) FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i."";
					$query1=mysql_query($sql1);
					$mm=mysql_fetch_array($query1);
					$sql2="SELECT zyj,zff FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i." order by id desc";
					$query2=mysql_query($sql2);
					$mm2=mysql_fetch_array($query2);
					$_Month[$i]=array($mm[0],$mm2[0],$mm[1],$mm2[1]);
				}else{
					$_Month[$i]=array(0,0,0,0);
				}
			}
		?>
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: '收支统计'
            },
            subtitle: {
                text: '单位/元'
            },
            xAxis: {
                categories: [
                    '1月',
                    '2月',
                    '3月',
                    '4月',
                    '5月',
                    '6月',
                    '7月',
                    '8月',
                    '9月',
                    '10月',
                    '11月',
                    '12月'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' 元';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: '收入',
                data: [<?=$_Month[1][0]?>, <?=$_Month[2][0]?>, <?=$_Month[3][0]?>, <?=$_Month[4][0]?>, <?=$_Month[5][0]?>, <?=$_Month[6][0]?>, <?=$_Month[7][0]?>, <?=$_Month[8][0]?>, <?=$_Month[9][0]?>, <?=$_Month[10][0]?>, <?=$_Month[11][0]?>, <?=$_Month[12][0]?>]
    
            },{
                name: '总收入',
                data: [<?=$_Month[1][1]?>, <?=$_Month[2][1]?>, <?=$_Month[3][1]?>, <?=$_Month[4][1]?>, <?=$_Month[5][1]?>, <?=$_Month[6][1]?>, <?=$_Month[7][1]?>, <?=$_Month[8][1]?>, <?=$_Month[9][1]?>, <?=$_Month[10][1]?>, <?=$_Month[11][1]?>, <?=$_Month[12][1]?>]
    
            },{
                name: '拨出',
                data: [<?=$_Month[1][2]?>, <?=$_Month[2][2]?>, <?=$_Month[3][2]?>, <?=$_Month[4][2]?>, <?=$_Month[5][2]?>, <?=$_Month[6][2]?>, <?=$_Month[7][2]?>, <?=$_Month[8][2]?>, <?=$_Month[9][2]?>, <?=$_Month[10][2]?>, <?=$_Month[11][2]?>, <?=$_Month[12][2]?>]
    
            },{
                name: '总拨出',
                data: [<?=$_Month[1][3]?>, <?=$_Month[2][3]?>, <?=$_Month[3][3]?>, <?=$_Month[4][3]?>, <?=$_Month[5][3]?>, <?=$_Month[6][3]?>, <?=$_Month[7][3]?>, <?=$_Month[8][3]?>, <?=$_Month[9][3]?>, <?=$_Month[10][3]?>, <?=$_Month[11][3]?>, <?=$_Month[12][3]?>]
    
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	</body>
</html>
