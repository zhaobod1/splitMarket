<?php

include_once("../function.php");
include_once("../bonus.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$ID=$_GET['ID'];
if ($ID=="") $ID=$_SESSION['ID'];
$cx="&ID=".$ID."";

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>奖金总表</title>
</head>
<body>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
          <td align="center"><?=$bs1?></td>
          <td align="center" <?=$bonus1xs?>><?=$bs2?></td>
          <td align="center" <?=$bonus2xs?>><?=$bs3?></td>
          <td align="center" <?=$bonus3xs?>><?=$bs4?></td>
          <td align="center" <?=$bonus4xs?>><?=$bs5?></td>
          <td align="center" <?=$bonus5xs?>><?=$bonus5name?></td>
          <td align="center" <?=$bonus6xs?>><?=$bonus6name?></td>
          <td align="center" <?=$bonus7xs?>><?=$bonus7name?></td>
          <td align="center" <?=$bonus8xs?>><?=$bonus8name?></td>
          <td align="center" <?=$bonus9xs?>><?=$bonus9name?></td>
          <td align="center" <?=$bonus0xs?>><?=$bs6?></td>
        </tr>
        <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `bonus` WHERE uid=".$ID."";
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
      	$sql = "SELECT * FROM `bonus` WHERE uid=".$ID." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
        <tr>
          <td align="center" ><?=date("Y-m-d",strtotime($row['bdate']))?></td>
          <td align="center" <?=$bonus1xs?>><?=$row['b1']?></td>
          <td align="center" <?=$bonus2xs?>><?=$row['b2']?></td>
          <td align="center" <?=$bonus3xs?>><?=$row['b3']?></td>
          <td align="center" <?=$bonus4xs?>><?=$row['b4']?></td>
          <td align="center" <?=$bonus5xs?>><?=$row['b5']?></td>
          <td align="center" <?=$bonus6xs?>><?=$row['b6']?></td>
          <td align="center" <?=$bonus7xs?>><?=$row['b7']?></td>
          <td align="center" <?=$bonus8xs?>><?=$row['b8']?></td>
          <td align="center" <?=$bonus9xs?>><?=$row['b9']?></td>
          <td align="center" <?=$bonus0xs?>><?=$row['b0']?></td>
        </tr>
        <?php
			}
		}
		$sql1="SELECT sum(b0),sum(b1),sum(b2),sum(b3),sum(b4),sum(b5),sum(b6),sum(b7),sum(b8),sum(b9),sum(b10) FROM `bonus` WHERE uid=".$ID."";
		if($query=mysql_query($sql1)){
			$zj=mysql_fetch_array($query);
		}
	  ?>
      <tr>
          <td align="center"><?=$bs7?></td>
          <td align="center" <?=$bonus1xs?>><?=$zj[1]?></td>
          <td align="center" <?=$bonus2xs?>><?=$zj[2]?></td>
          <td align="center" <?=$bonus3xs?>><?=$zj[3]?></td>
          <td align="center" <?=$bonus4xs?>><?=$zj[4]?></td>
          <td align="center" <?=$bonus5xs?>><?=$zj[5]?></td>
          <td align="center" <?=$bonus6xs?>><?=$zj[6]?></td>
          <td align="center" <?=$bonus7xs?>><?=$zj[7]?></td>
          <td align="center" <?=$bonus8xs?>><?=$zj[8]?></td>
          <td align="center" <?=$bonus9xs?>><?=$zj[9]?></td>
          <td align="center" <?=$bonus0xs?>><?=$zj[0]?></td>
        </tr>
</table>
<table width="100%" border="0" class="ziti">
              <tr>
                <td align="left">&nbsp;</td>
                <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                </tr>
            </table>
</body>
</html>