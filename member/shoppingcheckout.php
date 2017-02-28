<?php
include("check.php");
include_once("../function.php");
include_once("../class/email_class.php");
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>购物结算</title>
</head>

<?php
$member=getMemberbyID($_SESSION['ID']);
#结算
if ($_POST['buy']){
	$member=getMemberbyID($_SESSION['ID']);
	$sgb=$_POST['sgb'];
	$gwb=$_POST['gwb'];
	if($_SESSION['shoppingcart']<>""){
		if($member['gwb']>=$gwb && $member['sgb']>=$sgb){
			$us['sgb']=$member['sgb']-$sgb;
			$us['zsq']=$member['zsq']-$gwb;
			$FileID='1'.date("mdHis") . '' . rand(100,999);
			$orders['ordersnumber']=$FileID;
			$orders['uid']=$member['id'];
			$orders['userid']=$member['userid'];
			$orders['username']=$member['username'];
			$orders['usertel']=$member['usertel'];
			$orders['useraddress']=$member['useraddress'];
			$orders['goods']=serialize($_SESSION['shoppingcart']);
			if($_shoplist=$_SESSION['shoppingcart']){
				foreach($_shoplist as $gid=>$goods){
					foreach($goods as $key=>$value){
						if ($key=="num"){
							$num=$value;	
						}
					}
					$sql="SELECT * FROM `goods` WHERE id=".$gid."";
					if ($query=mysql_query($sql)){
						while ($row=mysql_fetch_array($query)){
							$goods_update=NULL;
							$goods_update['kucun']=$row['kucun']-$num;
							$goods_update['sales']=$row['sales']+$num;
							edit_update_cl('goods',$goods_update,$row['id']);
						}
					}
				}
			}
			$orders['sgb']=$sgb;
			$orders['gwb']=$gwb;
			$orders['cdate']=now();
			echo edit_update_cl('member',$us,$member['id']);
			echo add_insert_cl('orders',$orders);
			$_SESSION['shoppingcart']="";
			$_email=new email_class();
			$email=$_email->getemail();
			if ($email['ddtzadmin']==1){
				$title="会员订单";
				$content="管理员您好,会员".$member['nickname']."于".now()."向公司购买产品,订单编号：".$FileID."";
				$_email->sendemail($email['emailuser'],$email['emailname'],$title,$content);
			}
			
			alert("商品购买成功.","shoppingcart.php");
		}else{
			alert("您的货币余额不足,请充值.","?");
		}
	}else{
		alert("您的购物车中没有商品.","?");
	}
}

if ($_POST['goback']){
	echo "<script language=javascript>window.location.href='shoppingcart.php'</script>";
}
?>

<body>
 <form name="form" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <div id="daochu">
      <tr>
        <td height="10" colspan="5" align="center"> 付款</td>
      </tr>
      <tr>
        <td align="center">商品名称</td>
        <td align="center">商品类型</td>
        <td align="center">商品价格</td>
        <td align="center">购买数量</td>
        <td align="center">总计金额</td>
        </tr>
        
      <?php
	  	$j_sgb=0;
		$j_gwb=0;
		$u_sgb=$member['sgb'];
		$u_zsq=$member['zsq'];
		$username=$member['username'];
		$usertel=$member['usertel'];
		$useraddress=$member['useraddress'];
		
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
			if ($lx==1){
					$j_sgb=$j_sgb+$price*$num;
				}elseif($lx==2){
					$j_gwb=$j_gwb+($price*$num);
				}
	  ?>
      <tr>
        <td align="center"><?=$goodsname?></td>
        <td align="center"><?php if ($lx==1){?>首购商品<?php }else{?>重购商品<?php }?></td>
        
        <td align="center"><?=$price?></td>
        <td align="center"><?=$num?></td>
        <td align="center"><?=$price*$num?></td>
      </tr>
      <?php
			}
		}
	  ?>
      </div>
     
      <tr>
        <td colspan="5" align="left">
        收货人姓名：<?=$username?><br>
联系电话：<?=$usertel?><br>
        联系地址：<?=$useraddress?><br>
        <br>
        本次消费：<br>
        首购币￥<?=$j_sgb?><input name="sgb" type="hidden" value="<?=$j_sgb?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        激活币￥<?=$j_gwb?>
        <input name="gwb" type="hidden" value="<?=$j_gwb?>">
        <br>
        <br>
        货币余额：<br>
        剩余首购币￥<?=$u_sgb?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		剩余激活币￥<?=$u_zsq?>
		<br>
		<?php
        	if($u_zsq<$j_gwb || $u_sgb<$j_sgb){ 
		?>
        <font color="#FF0000">您的剩余货币不足以支付本次交易,请充值.</font>
        <?php
			}
		?>
        </td>
      </tr>
        <td colspan="5" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="center">
              	<input name="buy" type="submit" class="button_green" id="buy" value="确认支付">&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="goback" type="submit" class="button_blue" id="goback" value="回购物车">
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>