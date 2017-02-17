<?php
include("check.php");
include("check2.php");
include_once("../function.php");

session_start();

#修改数量
if ($_POST['button']){
	$gid = $_GET['gid'];
	$goodsname=$_POST['goodsname'];
	$price=$_POST['price'];
	$num=$_POST['num'];
	$lx=$_POST['lx'];
	$arr=array("id"=>$gid,"goodsname"=>$goodsname,"num"=>$num,"price"=>$price,"lx"=>$lx);
	$goodslist=$_SESSION['shoppingcart'];
	$goodslist[$gid]=$arr;
	$_SESSION['shoppingcart']=$goodslist;
	echo "<script language=javascript>window.location.href='?'</script>";
}

if ($_POST['button2']){
	$gid = $_GET['gid'];
	$goodslist=$_SESSION['shoppingcart'];
	unset($goodslist[$gid]);
	$_SESSION['shoppingcart']=$goodslist;
	echo "<script language=javascript>window.location.href='?'</script>";
}

if ($_POST['Remove']){
	$_SESSION['shoppingcart']=NULL;
	echo "<script language=javascript>window.location.href='?'</script>";
}

if ($_POST['checkout']){
	echo "<script language=javascript>window.location.href='shoppingcheckout.php'</script>";	
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>我的购物车</title>
</head>
<body>

<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <div id="daochu">
      <tr>
        <td height="10" colspan="6" align="center"> 购 物 车</td>
      </tr>
      <tr>
        <td align="center">商品名称</td>
        <td align="center">商品类型</td>
        <td align="center">商品价格</td>
        <td align="center">购买数量</td>
        <td align="center">总计金额</td>
        <td align="center">操作</td>
        </tr>
        
      <?php
	  	if($_shoplist=$_SESSION['shoppingcart']){
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
      <form name="form1" method="post" action="?gid=<?=$gid?>">
      <tr>
        <td align="center"><?=$goodsname?><input name="goodsname" type="hidden" value="<?=$goodsname?>"></td>
        <td align="center"><?php if ($lx==1){?>首购商品<?php }else{?>重购商品<?php }?><input name="lx" type="hidden" value="<?=$lx?>"></td>
        
        <td align="center"><?=$price?><input name="price" type="hidden" value="<?=$price?>"></td>
        <td align="center"><input name="num" type="text" value="<?=$num?>" size="5" maxlength="5"></td>
        <td align="center"><?=$price*$num?></td>
        <td align="center"><input name="button" type="submit" class="button_blue" id="button" value="修改数量">&nbsp;&nbsp;&nbsp;&nbsp;<input name="button2" type="submit" class="button_red" id="button2" value="清除商品"></td>
      </tr>
       </form>
      <?php
			}
		}
	  ?>
      </div>
    </table>
    <table width="100%" border="0">
          <tr>
            <td align="center">
              <form name="form" method="post" action="?">
              	<input name="checkout" type="submit" class="button_green" id="checkout" value="去结算">&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="Remove" type="submit" class="button_red" id="Remove" value="清空商品">
            </form></td>
          </tr>
        </table>
</body>
</html>