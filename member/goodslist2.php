<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/email_class.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("../class/ulevel_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();

function printTable($_id,$_goodsimg,$_goodsname,$_price){
	echo "<table height=266 border=0 style='width:200px;height:240px;border-left: #0FF solid 1px; border-right: #0FF solid 1px; border-bottom:#0FF solid 1px; border-top:#0FF solid 1px; float:left; margin:8px;'>";
    echo "<tr>";
    echo "<td><a href='goodscontent.php?id=".$_id."' style='text-decoration:none'><img src=../upload/".$_goodsimg." width=200 height=200 border=0></a></td>";
    echo "</tr>";
  	echo "<tr>";
    echo "<td height=20 align=center><strong>".$_goodsname."</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td height=20>价格：<font color=#FF0000>￥".$_price."</font></td>";
  	echo "</tr>";
	echo "</table>";
}

#搜索商品
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索商品名称
			$_SESSION['Search']="and goodsname like '%".$SearchContent."%'";
		}
	}else{
		$_SESSION['Search']=NULL;	
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

$member=getMemberbyID($_SESSION['ID']);

if($_POST['button3']){
	$cheuid_arr = $_POST['UID'];
	$_SESSION['shoppingcart']=NULL;
	$gwb=0;
	if ($member['ulevel']<4){
		foreach ((array)$cheuid_arr as $id)
		{
			$shopingcart_arr=$_SESSION['shoppingcart'];
			$goods=que_select_cl('goods',$id);
			$num=$_POST[$goods['id']."num"];
			if(is_numeric($num) && $num>0){
				$arr=array("id"=>$goods['id'],"goodsname"=>$goods['goodsname'],"num"=>$num,"price"=>$goods['price'],"lx"=>$goods['lx']);
				$shopingcart_arr[$goods['id']]=$arr;
				$_SESSION['shoppingcart']=$shopingcart_arr;
				$gwb=$gwb+$goods['price']*$num;
			}else{
				echo "<script language=javascript>alert('购买数量输入错误,请输入0以上的数字.');window.location.href='?'</script>";
			}
		}
		
		if($_SESSION['shoppingcart']<>""){
			$ulevel_cl=new ulevel_class();
			$lvup=$_POST['lvup'];
			$ylv=$member['ulevel'];
			$upulevel=$ulevel_cl->getulevelbyulevel($lvup);
			$cha=$upulevel['lsk']-$member['lsk'];
			if($cha<>$gwb){
				alert("购物金额错误,请选择价值".$cha."的产品.","?");
			}else{
				if($member['zsq']>=$gwb){
				$member_update['zsq']=$member['zsq']-$gwb;
				$member_update['lsk']=$member['lsk']+$gwb;
				$member_update['ulevel']=$lvup;
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
				$orders['gwb']=$gwb;
				$orders['cdate']=now();
				echo edit_update_cl('member',$member_update,$member['id']);
				echo add_insert_cl('orders',$orders);
				$_SESSION['shoppingcart']="";
				
				$member_cl=new member_class();
				$bonus_cl=new bonus_class();
				$bonus_cl->b1bonus($member['id'],$member['reid'],$cha);
				$yul=$ulevel_cl->getulevelbyulevel($ylv);
				$b2=$upulevel['yl2']-$yul['yl2'];
				$b3=$upulevel['yl3']-$yul['yl3'];
				$bonus_cl->b2bonus($member['id'],$b2,$b3);
				$bonus_cl->b4bonus($member['pid'],$cha,$member['id'],$member['nickname']);
				$member_cl->addArea($member['id'],$member['treeplace'],$cha);
				$bonus_cl->b0bonus();
				$_systemyeji=new system_class();
				$_systemyeji->yejitongji(0,0,$cha,0,0,0,0);
				$_email=new email_class();
				$email=$_email->getemail();
				if ($email['ddtzadmin']==1){
					$title="会员订单";
					$content="管理员您好,会员".$member['nickname']."于".now()."向公司购买产品,订单编号：".$FileID."";
					$_email->sendemail($email['emailuser'],$email['emailname'],$title,$content);
				}
					alert("商品购买成功,您已成功升级.","?");
				}else{
					alert("您的激活币币余额不足,请充值.","?");
				}	
			}
		}
	}else{
		alert("您已成为四级会员,无需进行升级购物.","?");
	}
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>购物商城</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
function jiage(numname,pic){
	var price=document.getElementById(pic).value
	var zong=numname.value*price;
	document.getElementById(pic+"zong").innerText=zong;
	zongjiage=0;
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		if (e.checked==true){
			var jiage=document.getElementById(e.value).value;
			var shuangliang=document.getElementById(e.value+"num").value;
			zongjiage=zongjiage+jiage*shuangliang;
		}
	}
	document.getElementById("zongjiage").innerText=zongjiage;
}
function zjiage(){
	zongjiage=0;
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		if (e.checked==true){
			var jiage=document.getElementById(e.value).value;
			var shuangliang=document.getElementById(e.value+"num").value;
			zongjiage=zongjiage+jiage*shuangliang;
		}
	}
	document.getElementById("zongjiage").innerText=zongjiage;
}
-->
</script>
<style type="text/css">
*{margin:0; padding:0; font-size:12px;}
#tablit {margin:0px;width:100%; height:400; border:#BCE2F3 1px solid;padding-top:10px;background:#E4F2FB;}
#tablit dl{ float:left; width:100%;}
#tablit dl dt{float:left;border-bottom:#64B8E4 1px solid; width:15px; height:31px; line-height:30px;}
#tablit dl dd{float:left;width:110px;height:30px; line-height:30px; text-align:center;}
#tablit .on{
	border:#64B8E4 1px solid;
	border-bottom:#FFF 1px solid;
	color:#FF6600;
	font-weight: bold;
}
#tablit .out{
	border:#64B8E4 1px solid;
	color:#000;
	background:#64B8E4;
	font-weight: bold;
}
.tabcon{width:99%; height:365px; clear:both;}
.dis{display:none;}
</style>
</head>
<body>
<form name="form1" method="post" action="?">
<div class="ziti"><select name="SearchType" id="SearchType">
            <option value="1">商品名称</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="button_blue" value="搜  索"></div>    
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
		<tr>
        <td height="30" colspan="8" align="center" >选择级别
          <select name="lvup" id="lvup">
            <?php if($member['ulevel']<2){?><option value="2">二级会员</option><?php }?>
            <?php if($member['ulevel']<3){?><option value="3">三级会员</option><?php }?>
            <?php if($member['ulevel']<4){?><option value="4">四级会员</option><?php }?>
          </select></td>
      </tr>
 		<tr>
        <td height="30" align="center" >选择</td>
        <td height="30" align="center" >产品图片</td>
        <td height="30" align="center" >产品名称</td>
        <td align="center" >价格</td>
        <td align="center" >库存</td>
        <td align="center" >购买数量</td>
        <td align="center" >总价格</td>
        <td align="center" >查看详细</td>
      </tr>
 		<?php
	  	$pagesize = 100; //设置每页记录数 
	  	$sql = "SELECT * FROM `goods` WHERE isdisplay=1 and lx=2 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `goods` WHERE isdisplay=1 and lx=2 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by shunxu,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
			?>	
      <tr>
      	<td align="center" ><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>" onClick="zjiage();"></td>
        <td height="80" width="80" align="center" ><img src='../upload/<?=$row['goodsimg']?>' width=80 height=80 border=0></td>
        <td align="center" ><?=$row['goodsname']?></td>
        <td align="center" ><?=$row['price']?></td>
        <td align="center" ><?=$row['kucun']?></td>
        <td align="center" ><input name="<?=$row['id']?>num" id="<?=$row['id']?>num" type="text" value="0" size="4" onKeyUp="jiage(this,<?=$row['id']?>);">          <input name="<?=$row['id']?>" id="<?=$row['id']?>" type="hidden" value="<?=$row['price']?>">
        </td>
        <td align="center" ><label name="<?=$row['id']?>zong" id="<?=$row['id']?>zong">0</label></td>
        <td align="center" ><a href='goodscontent.php?id=<?=$row['id']?>' style='text-decoration:none'>查看</a></td>
      </tr>
	  <?php
      		}
		}
	  ?>
      <tr><td colspan="7"><input name="button3" type="submit" class="button_green" id="button3" value="购买" onClick="{if(confirm('您确定要购买商品吗?')){this.document.selform.submit();return true;}return false;}">  </td>
        <td>总计金额：<label name="zongjiage" id="zongjiage">0</label></td>
      </tr>
      <tr>
        <td height="21" colspan="8" align="right">
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