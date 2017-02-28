<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/email_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_GET['action']=="Revoke"){
	$stockbuy=que_select_cl('stockbuy',$_GET['id']);
	if ($stockbuy['isjs']==0){
		if($stockbuy['lx']==0){
			$yxb=$stockbuy['num']*$stockbuy['price'];
			edit_sql("update `member` set yxb=yxb+".$yxb." where id=".$stockbuy['uid']."");	
			edit_sql("update `stockbuy` set isjs=2 where id=".$stockbuy['id']."");	
		}else if ($stockbuy['lx']==1){
			edit_sql("update `member` set pe=pe+".$stockbuy['num']." where id=".$stockbuy['uid']."");	
			edit_sql("update `stockbuy` set isjs=2 where id=".$stockbuy['id']."");	
		}
	}
	echo "<script language=javascript>alert('撤消完成');window.location.href='?'</script>";	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>我的委托</title>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="6" align="center"> 我 的 委 托</td>
      </tr>
      <tr>
        <td align="center">委托数量</td>
        <td align="center">剩余数量</td>
        <td align="center">委托价格</td>
        <td align="center">委托时间</td>
        <td align="center">委托类型</td>
        <td align="center">状态</td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE uid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `stockbuy` WHERE uid=".$_SESSION['ID']." order by isjs,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['total']?></td>
        <td align="center"><?=$row['num']?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['sdate']?></td>
		<td align="center"><?php if ($row['lx']==0){?>买入<?php }elseif($row['lx']==1){?>卖出<?php }?></td>
        <td align="center"><?php if ($row['isjs']==1){?>交易成功<?php }else if($row['isjs']==0){?> <font color="#FF0000"><a href="?action=Revoke&id=<?=$row['id']?>" onClick="{if(confirm('您确定要撤消您的委托吗?')){return true;}return false;}">撤消委托</a></font><?php }else if($row['isjs']==2){?>已撤消<?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
  </table>
  <table width="100%" border="0" class="ziti">
          <tr>
            <td align="left">&nbsp;</td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table>
</form>
</body>
</html>