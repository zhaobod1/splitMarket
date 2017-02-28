<?php
include("check.php");
include("check2.php");
include_once("../function.php");

session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>订单详细信息</title>
</head>

<?php
$oid=$_GET['oid'];
$page=$_GET['page'];
$orders=que_select_cl('orders',$oid);

if ($_POST['goback']){
	echo "<script language=javascript>window.location.href='Orders.php?page=".$page."'</script>";
}
?>

<body>
 <form name="form" method="post" action="?oid=<?=$oid?>&page=<?=$page?>">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <div id="daochu">
      <tr>
        <td height="10" colspan="6" align="center"> 订单详细信息</td>
      </tr>
      <tr>
        <td height="10" colspan="6" align="left"><p>订单编号：<?=$orders['ordersnumber']?>
          <br>
          物流公司：<?=$orders['logistics']?>
          <br>
          物流编号：<?=$orders['logisticsno']?><br>
          会员编号：<?=$orders['userid']?><br>
        会员姓名：<?=$orders['username']?><br>
        联系电话：<?=$orders['usertel']?><br>
        联系地址：<?=$orders['useraddress']?><br>
        订单金额：<?=$orders['gwb']?><br>
        </p></td>
      </tr>
      <tr>
        <td align="center">商品名称</td>
        <!--<td align="center">商品类型</td>-->
        <td align="center">商品价格</td>
        <td align="center">购买数量</td>
        <td align="center">总计金额</td>
        </tr>
        
      <?php
	  	if($_shoplist=unserialize($orders['goods'])){
		foreach($_shoplist as $gid=>$goods){
			foreach($goods as $key=>$value){
				if ($key=="goodsname"){
					$goodsname=$value;	
				}elseif ($key=="num"){
					$num=$value;	
				}elseif ($key=="price"){
					$price=$value;	
				}elseif ($key=="lx"){
					$lx=$value;	
				}
			}
	  ?>
      <tr>
        <td align="center"><?=$goodsname?></td>
        <!--<td align="center"><?php if ($lx==1){?>首购商品<?php }else{?>重购商品<?php }?></td>-->
        
        <td align="center"><?=$price?></td>
        <td align="center"><?=$num?></td>
        <td align="center"><?=$price*$num?></td>
      </tr>
      <?php
			}
		}
	  ?>
      </div>
        <td colspan="6" align="center"><input name="goback" type="submit" class="button_blue" id="goback" value="返回"></td>
      </tr>
   </table>
    </form>
</body>
</html>