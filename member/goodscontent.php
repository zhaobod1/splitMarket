<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php
include_once("../function.php");
session_start();
if ($_GET['id']!=NULL){
	$goods=que_select_cl('goods',$_GET['id']);
}

if ($_POST['button']){
	$num=$_POST['num'];
	$shopingcart_arr=$_SESSION['shoppingcart'];
	$arr=array("id"=>$goods['id'],"goodsname"=>$goods['goodsname'],"num"=>$num,"price"=>$goods['price'],"lx"=>$goods['lx']);
	if ($shopingcart_arr!=NULL){
		
		if(array_key_exists($goods['id'],$shopingcart_arr) ){
			echo "<script language=javascript>alert('该商品已在您的购物车中.');window.location.href='?id=".$_GET['id']."'</script>";
		}else{
			$shopingcart_arr[$goods['id']]=$arr;
			$_SESSION['shoppingcart']=$shopingcart_arr;	
		}
	}else{
		$shopingcart_arr=array();
		$shopingcart_arr[$goods['id']]=$arr;
		$_SESSION['shoppingcart']=$shopingcart_arr;
	}
	echo "<script language=javascript>alert('商品已加入购物车.');window.location.href='?id=".$_GET['id']."'</script>";
}

if ($_POST['checkout']){
	echo "<script language=javascript>window.location.href='shoppingcheckout.php'</script>";	
}
?>
<title><?=$goods['goodsname']?></title>
<script language="javascript">
<!--
function numChange(num){
	var zjg=num.value*<?=$goods['price']?>;
	document.getElementById("zj").innerText="￥"+zjg;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?id=<?=$goods['id']?>">
<table width="100%" border="0" >
  <tr>
    <td rowspan="9" align="center" valign="top" style="width:5cm; height:5cm;">
    <img src="../upload/<?=$goods['goodsimg']?>" style="width:5cm; height:5cm;" align="top"></td>
    <td align="center" valign="top">
      <h3><?=$goods['goodsname']?></h3></td>
    <td colspan="2" align="center" valign="top"><h3>库存：
      <?=$goods['kucun']?></h3></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">单价：
      <?=$goods['price']?>
      <!--购买数量
      <input name="num" type="text" id="num" value="1" size="5" maxlength="5"   onKeyUp="numChange(this);">
      总计金额：
      <label name="zj" id="zj"><?=$goods['price']?>--></label></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><!--<input name="button" type="submit" class="button_green" id="button" value="加入购物车">-->      <!--<input name="checkout" type="submit" class="button_green" id="checkout" value="去结算">-->      <input name="input" type="button" class="button_blue" value="返  回" onClick="history.back(-1)"></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  
  <tr >
    <td colspan="4" valign="top" ><h3>产品介绍</h3><?=$goods['goodscontent']?></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" ></td>
  </tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>