<?php
include("admin_check.php");
include_once("../function.php");
include_once("../bonus.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

$uid=$_GET['uid'];
$bdate=$_GET['bdate'];
$date_elements = explode("-" ,$bdate);
$cx="&uid=".$uid."&bdate=".$bdate.""
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>奖金明细</title>
<script language="javascript"> 
<!--     
//导出excel
function exportExcel(DivID){
var oXL = new ActiveXObject("Excel.Application"); 
  var oWB = oXL.Workbooks.Add(); 
  var oSheet = oWB.ActiveSheet;  
  var sel=document.body.createTextRange();
  sel.moveToElementText(daochu);
  sel.select();
  sel.execCommand("Copy");
  oSheet.Paste();
  oXL.Visible = true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="0" border="0" align="center" class="table1">
	  <tr>
	    <td align="center">奖金明细</td>
	    <td align="right"><input name="input" type="button" class="btn1" value="返回" onClick="javascript:history.go(-1);"></td>
	  </tr>
      <tr><td colspan="2">
        <table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" class="table1" id="daochu">
          <tr>
            <td align="center">结算时间</td>
            <td align="center" >会员</td>
            <td align="center" >类型</td>
            <td align="center" >摘要</td>
            <td align="center" >相关会员</td>
            <td align="center" >金额</td>
          </tr>
          <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `bonuslaiyuan` WHERE 1=1 and uid=".$uid." and year(bdate)=".$date_elements[0]."";
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
      	$sql = "SELECT * FROM `bonuslaiyuan` WHERE 1=1 and uid=".$uid." and year(bdate)=".$date_elements[0]."  order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
          <tr>
            <td align="center" ><?=date("Y-m-d",strtotime($row['bdate']))?></td>
            <td align="center" ><?=$row['nickname']?></td>
            <?php
          switch ($row['lx']){
				case 1:
					$lx=$bonus1name;
					break;
				case 2:
					$lx=$bonus2name;
					break;
				case 3:
					$lx=$bonus3name;
					break;
				case 4:
					$lx=$bonus4name;
					break;
				case 5:
					$lx=$bonus5name;
					break;
				case 6:
					$lx=$bonus6name;
					break;
				case 7:
					$lx=$bonus7name;
					break;
				case 8:
					$lx=$bonus8name;
					break;
				case 9:
					$lx=$bonus9name;
					break;
				case 10:
					$lx=$bonus10name;
					break;  
		  }
		  ?>
            <td align="center" ><?=$lx?></td>
            <td align="center" ><?=$row['beizhu']?></td>
            <td align="center" ><?=$row['ynickname']?></td>
            <td align="center" ><?=$row['jine']?></td>
          </tr>
          <?php
			}
		}
	  ?>
        </table>
        </td>
      </tr>
      <tr>
        <td height="21" colspan="2" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>