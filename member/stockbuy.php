<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/email_class.php");
include_once("../class/system_class.php");
include_once("../class/bonus_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$system_cl=new system_class();
$bonus_cl=new bonus_class();
$sys=$system_cl->system_information(1);
$us=que_select_cl_where("member","where id=".$_SESSION['ID']."");
if ($_POST['submit']){
	if ($sys['ispe']==1){
	if ($us['pelock']==0){
	$lx=$_POST['lx'];
	$jine=$_POST['jine'];
	$num=$_POST['num'];
	if($lx==0){
		if($us['yxb']>=$jine*$num){
			edit_sql("update `member` set yxb=yxb-".$jine*$num." where id=".$us['id']."");
			$sql="select * from `stockbuy` where lx=1 and price=".$jine." and num>0 and isjs=0 and uid<>".$us['id']." order by id";
			if ($query=mysql_query($sql)){
				while ($row=mysql_fetch_array($query) and $num>0){
					if($row['num']<=$num){
						$stockrecord=NULL;
						$stockrecord['uid']=$us['id'];
						$stockrecord['nickname']=$us['nickname'];
						$stockrecord['sid']=$row['uid'];
						$stockrecord['snickname']=$row['nickname'];
						$stockrecord['num']=$row['num'];
						addgupiaolist(time()+3600*8,0,$row['num']);
						$stockrecord['price']=$row['price'];
						$stockrecord['sdate']=now();
						$stockrecord['lx']=$lx;
						add_insert_cl('stockrecord',$stockrecord);
						
						$yxb=$row['num']*$row['price'];
						$b4=$yxb*0.6;
						edit_sql("update `member` set yxb=yxb+".$yxb*0.3." where id=".$row['uid']."");
						$bonus_cl->b4bonus($row['uid'],$us['id'],$us['nickname'],$b4);
						$bonus_cl->b0bonus();
						edit_sql("update `member` set pe=pe+".$row['num']." where id=".$us['id']."");
						edit_sql("update `systemparameters` set peprice=".$row['price']." where id=1");
						$num=$num-$row['num'];
						
						$row['num']=0;
						$row['isjs']=1;
						edit_update_cl('stockbuy',$row,$row['id']);
					}else{
						$stockrecord=NULL;
						$stockrecord['uid']=$us['id'];
						$stockrecord['nickname']=$us['nickname'];
						$stockrecord['sid']=$row['uid'];
						$stockrecord['snickname']=$row['nickname'];
						$stockrecord['num']=$num;
						addgupiaolist(time()+3600*8,0,$num);
						$stockrecord['price']=$row['price'];
						$stockrecord['sdate']=now();
						$stockrecord['lx']=$lx;
						add_insert_cl('stockrecord',$stockrecord);
						
						$yxb=$num*$row['price'];
						$b4=$yxb*0.6;
						edit_sql("update `member` set yxb=yxb+".$yxb*0.3." where id=".$row['uid']."");
						$bonus_cl->b4bonus($row['uid'],$us['id'],$us['nickname'],$b4);
						$bonus_cl->b0bonus();
						edit_sql("update `member` set pe=pe+".$num." where id=".$us['id']."");
						edit_sql("update `systemparameters` set peprice=".$row['price']." where id=1");	
						$row['num']=$row['num']-$num;
						edit_update_cl('stockbuy',$row,$row['id']);
						
						$num=0;
					}
				}
			}
			if($num>0){
				$stock['uid']=$us['id'];
				$stock['nickname']=$us['nickname'];
				$stock['num']=$num;
				$stock['total']=$num;
				$stock['price']=$jine;
				$stock['lx']=$lx;
				$stock['sdate']=now();
				add_insert_cl('stockbuy',$stock);
			}
			$bonus_cl->b5bonus();
			$bonus_cl->b0bonus();
			echo "<script language=javascript>alert('委托交易成功.');window.location.href='?'</script>";	
		}else{
			echo "<script language=javascript>alert('您的余额不足,请充值.');window.location.href='?'</script>";	
		}
	}else{
		if ($jine>=$sys['peprice']){
			if($us['pe']>=$num){
				edit_sql("update `member` set pe=pe-".$num." where id=".$us['id']."");
				$sql="select * from `stockbuy` where lx=0 and price=".$jine." and num>0 and isjs=0 and uid<>".$us['id']." order by id";
				if ($query=mysql_query($sql)){
					while ($row=mysql_fetch_array($query) and $num>0){
						if($row['num']>$num){
							$stockrecord=NULL;
							$stockrecord['uid']=$us['id'];
							$stockrecord['nickname']=$us['nickname'];
							$stockrecord['sid']=$row['uid'];
							$stockrecord['snickname']=$row['nickname'];
							$stockrecord['num']=$num;
							addgupiaolist(time()+3600*8,0,$num);
							$stockrecord['price']=$row['price'];
							$stockrecord['sdate']=now();
							$stockrecord['lx']=$lx;
							add_insert_cl('stockrecord',$stockrecord);
							
							$row['num']=$row['num']-$num;
							edit_update_cl('stockbuy',$row,$row['id']);
							
							$yxb=$num*$row['price'];
							$b4=$yxb*0.6;
							edit_sql("update `member` set yxb=yxb+".$yxb*0.3." where id=".$us['id']."");
							$bonus_cl->b4bonus($us['id'],$row['uid'],$row['nickname'],$b4);
							$bonus_cl->b0bonus();
							edit_sql("update `member` set pe=pe+".$num." where id=".$row['uid']."");
							edit_sql("update `systemparameters` set peprice=".$row['price']." where id=1");
							$num=0;
						}else{
							$stockrecord=NULL;
							$stockrecord['uid']=1;
							$stockrecord['nickname']="admin";
							$stockrecord['sid']=$row['uid'];
							$stockrecord['snickname']=$row['nickname'];
							$stockrecord['num']=$row['num'];
							addgupiaolist(time()+3600*8,0,$row['num']);
							$stockrecord['price']=$row['price'];
							$stockrecord['sdate']=now();
							$stockrecord['lx']=$lx;
							add_insert_cl('stockrecord',$stockrecord);
							$yxb=$row['num']*$row['price'];
							$b4=$yxb*0.6;
							edit_sql("update `member` set yxb=yxb+".$yxb*0.3." where id=".$us['id']."");
							$bonus_cl->b4bonus($us['id'],$row['uid'],$row['nickname'],$b4);
							$bonus_cl->b0bonus();
							edit_sql("update `member` set pe=pe+".$row['num']." where id=".$row['uid']."");
							edit_sql("update `systemparameters` set peprice=".$row['price']." where id=1");
							$num=$num-$row['num'];
							
							$row['isjs']=1;
							$row['num']=0;
							edit_update_cl('stockbuy',$row,$row['id']);	
						}
					}
				}
				if($num>0){
					$stock['uid']=$us['id'];
					$stock['nickname']=$us['nickname'];
					$stock['num']=$num;
					$stock['total']=$num;
					$stock['price']=$jine;
					$stock['lx']=$lx;
					$stock['sdate']=now();
					add_insert_cl('stockbuy',$stock);
				}
				$bonus_cl->b5bonus();
				$bonus_cl->b0bonus();
				echo "<script language=javascript>alert('委托交易成功.');window.location.href='?'</script>";	
			}else{
				echo "<script language=javascript>alert('您的pe币不足.');window.location.href='?'</script>";		
			}
		}else{
			echo "<script language=javascript>alert('卖出价格不能低于实时交易价格.');window.location.href='?'</script>";	
		}
	}
	}else{
		echo "<script language=javascript>alert('您的pe币已被锁定,无法交易.');window.location.href='?'</script>";			
	}
	}else{
		echo "<script language=javascript>alert('游戏币拆分中, 请稍微再试.');window.location.href='?'</script>";		
	}
}

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
	$bonus_cl->b5bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('撤消完成');window.location.href='?'</script>";	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>交易大厅</title>
<script language="javascript">
<!--
function CheckForm(){
	jine=document.form1.jine.value;
	num=document.form1.num.value;
	if(jine.length == 0){
		alert("温馨提示:\n请输入价格.");
		document.form1.jine.focus();
		return false;
	}
	if(jine <= 0){
		alert("温馨提示:\n价格必须大于0.");
		document.form1.jine.focus();
		return false;
	}
	if(num.length == 0){
		alert("温馨提示:\n请输入交易数量.");
		document.form1.num.focus();
		return false;
	}
	if(num <= 0){
		alert("温馨提示:\n交易数量必须大于0.");
		document.form1.num.focus();
		return false;
	}
	if(isNaN(jine)){
		alert("温馨提示:\n交易价格请输入数字.");
		document.form1.jine.focus();
		return false;
	}
	if(isNaN(num)){
		alert("温馨提示:\n交易数量请输入数字.");
		document.form1.num.focus();
		return false;
	}
	if(parseInt(num)!=num){
		alert("温馨提示:\n交易数量请输入整数.");
		document.form1.num.focus();
		return false;	
	}

	return true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">

<table width="100%" border="0">
  <tr>
    <td valign="top"><table width="100%" cellpadding="3" cellspacing="1" border="0" align="left" class="table1">
      <tr>
    <td height="20" colspan="4" align="center"> <?=$yxhq2?></td>
  </tr>
  <tr>
    <td align="center"><?=$yxhq4?></td>
    <td align="center"><?=$yxhq5?></td>
    <td align="center"><?=$yxhq6?></td>
    <td align="center"><?=$yxhq8?></td>
  </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 and isjs=0";
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
      	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 and isjs=0 order by price,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=round($row['num'])?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['price']*$row['num']?></td>
      </tr>
      <?php
			}
		}
	  ?>
    </table></td>
    <td valign="top"><table width="100%" cellpadding="3" cellspacing="1" border="0" align="right" class="table1">
      <tr>
    <td height="20" colspan="4" align="center"> <?=$yxhq3?></td>
  </tr>
  <tr>
    <td align="center"><?=$yxhq4?></td>
    <td align="center"><?=$yxhq5?></td>
    <td align="center"><?=$yxhq7?></td>
    <td align="center"><?=$yxhq8?></td>
  </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE lx=0 and isjs=0";
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
      	$sql = "SELECT * FROM `stockbuy` WHERE lx=0 and isjs=0 order by price desc,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=round($row['num'])?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['price']*$row['num']?></td>
      </tr>
      <?php
			}
		}
	  ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php
  	$nk="";
	$snk="";
	$shuliang=0;
	$jiage=0;
	$sql="SELECT * FROM `stockrecord` order by id desc limit 0,1";
	if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			if ($row['lx']==0){
				$nk=$row['nickname'];
				$snk=$row['snickname'];	
			}else{
				$nk=$row['snickname'];
				$snk=$row['nickname'];		
			}
			$shuliang=$row['num'];
			$jiage=$row['price'];
		}
	}
  ?>
      <table width="60%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td colspan="3" align="center"><?=$weituo1?></td>
      </tr>
      <tr>
        <td width="33%" align="center"><?=$weituo2?></td>
        <td width="34%" rowspan="2" align="center"><?=$jiage?></td>
        <td width="33%" align="center"><?=$weituo3?></td>
      </tr>
      <tr>
        <td align="center"><?=$nk?></td>
        <td align="center"><?=$snk?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><?=$weituo4?>
          ：
          <?=round($shuliang)?></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <td height="22" align="right"><?=$weituo5?>
    ：</td>
    <td colspan="2" align="left"><?=$sys['peprice']?></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$main6?>：</td>
    <td colspan="2" align="left"><?=$us['yxb']?></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$main7?>：</td>
    <td colspan="2" align="left"><?=$us['pe']?></td>
  </tr>
  <tr>
    <td width="51%" height="22" align="right"><?=$weituo6?>
      ：</td>
    <td width="49%" colspan="2" align="left"><select name="lx" id="lx">
      <option value="0"><?=$weituo7?></option>
      <option value="1"><?=$weituo8?></option>
    </select></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$weituo9?>：</td>
    <td colspan="2" align="left"><input name="jine" type="text" id="jine" size="10" maxlength="20"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$weituo10?>：</td>
    <td colspan="2" align="left"><input name="num" type="text" id="num" size="10" maxlength="20"></td>
  </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="2"><table align="center" class="ziti">
      <tr>
        <td><input name="submit" id="submit" type="submit" class="button_green" value="<?=$anniu1?>"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="20" colspan="7" align="center"><?=$menu20?></td>
      </tr>
      <tr>
        <td align="center"><?=$weituo10?></td>
        <td align="center"><?=$weituo11?></td>
        <td align="center"><?=$weituo9?></td>
        <td align="center"><?=$jiaoyijilu7?></td>
        <td align="center"><?=$jiaoyijilu9?></td>
        <td align="center"><?=$weituo6?></td>
        <td align="center"><?=$weituo12?></td>
      </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE uid=".$_SESSION['ID']." and isjs=0";
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
      	$sql = "SELECT * FROM `stockbuy` WHERE uid=".$_SESSION['ID']." and isjs=0 order by isjs,id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['total']?></td>
        <td align="center"><?=$row['num']?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['price']*$row['num']?></td>
        <td align="center"><?=$row['sdate']?></td>
        <td align="center"><?php if ($row['lx']==0){?>
          <?=$weituo7?>
          <?php }elseif($row['lx']==1){?>
          <?=$weituo8?>
          <?php }?></td>
        <td align="center"><?php if ($row['isjs']==1){?>
          交易成功
          <?php }else if($row['isjs']==0){?>
          <font color="#FF0000"><a href="?action=Revoke&id=<?=$row['id']?>" onClick="{if(confirm('您确定要撤消您的委托吗?')){return true;}return false;}">撤消委托</a></font>
          <?php }else if($row['isjs']==2){?>
          已撤消
          <?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
    </table></td>
    </tr>
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