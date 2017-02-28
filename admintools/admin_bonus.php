<?php
include("admin_check.php");
include_once("../function.php");
include_once("../bonus.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

if ($_GET['did']==""){
	$did=$_SESSION['did'];
}else{
	$did=$_GET['did'];
	$_SESSION['did']=$_GET['did'];	
}
if ($did=="") alert('查询错误','admin_bonustime.php');

#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	$SearchType=$_POST['SearchType'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and b.bdate>='".$TimeStart."' and b.bdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and m.nickname='".$SearchContent."'";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>奖金查询</title>
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
<form name="form1" method="post" action="?did=<?=$did?>">
<table width="100%" cellpadding="3" cellspacing="0" border="0" align="center" class="table1">
	  <tr>
	    <td align="center" colspan="2">奖金查询</td></tr>
      <tr>
        <td height="4" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
        <input name="input" type="button" class="btn1" value="返回" onClick="javascript:history.go(-1);"></td>
        <td height="4" align="center"><input type="button" name="dayin" id="dayin" class="btn1" value="导出表格" onClick="exportExcel('daochu')"></td>
      </tr>
      <tr><td colspan="2">
      <table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" class="table1" id="daochu">
      <tr>
      	<td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td align="center" <?=$bonus1xs?>><?=$bonus1name?></td>
        <td align="center" <?=$bonus2xs?>><?=$bonus2name?></td>
        <td align="center" <?=$bonus3xs?>><?=$bonus3name?></td>
        <td align="center" <?=$bonus4xs?>><?=$bonus4name?></td>
        <td align="center" <?=$bonus5xs?>><?=$bonus5name?></td>
        <td align="center" <?=$bonus6xs?>><?=$bonus6name?></td>
        <td align="center" <?=$bonus7xs?>><?=$bonus7name?></td>
        <td align="center" <?=$bonus8xs?>><?=$bonus8name?></td>
        <td align="center" <?=$bonus9xs?>><?=$bonus9name?></td>
        <td align="center" <?=$bonus10xs?>><?=$bonus10name?></td>
        <td align="center" <?=$bonus0xs?>><?=$bonus0name?></td>
        <td align="center" >奖金明细</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by b.bdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center" <?=$bonus1xs?>><?=$row['b1']?></td>
        <td align="center" <?=$bonus2xs?>><?=$row['b2']?></td>
        <td align="center" <?=$bonus3xs?>><?=$row['b3']?></td>
        <td align="center" <?=$bonus4xs?>><?=$row['b4']?></td>
        <td align="center" <?=$bonus5xs?>><?=$row['b5']?></td>
        <td align="center" <?=$bonus6xs?>><?=$row['b6']?></td>
        <td align="center" <?=$bonus7xs?>><?=$row['b7']?></td>
        <td align="center" <?=$bonus8xs?>><?=$row['b8']?></td>
        <td align="center" <?=$bonus9xs?>><?=$row['b9']?></td>
        <td align="center" <?=$bonus10xs?>><?=$row['b10']?></td>
        <td align="center" <?=$bonus0xs?>><?=$row['b0']?></td>
        <td align="center" >
          <input type="button" class="button" id="button" name="button" value="查看" onClick="window.location.href='admin_bonuslaiyuan2.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>'" /></td>
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