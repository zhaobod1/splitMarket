<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/email_class.php");
include_once("../class/system_class.php");

header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
	$us=getMemberbyID($_SESSION['ID']);
	$UserTel=$us['usertel'];
	$BankName=$us['bankname'];
	$BankCard=$us['bankcard'];
	$BankUserName=$us['bankusername'];
	$BankAddress=$us['bankaddress'];
	$zhifubao=$us['zhifubao'];
	$caifutong=$us['caifutong'];
	$mey=$us['mey'];
	$bdid=$us['bdid'];
	$bdname=$us['bdname'];
	$_system=new system_class();
	$system=$_system->system_information(1);
if ($_POST['submit']){
	$uid=$_SESSION['ID'];
	$jine=$_POST['jine'];
	if ($jine<=$mey){
	$tixian['uid']=$uid;
	$tixian['nickname']=$_SESSION['nickname'];
	$tixian['username']=$us['username'];
	$tixian['usertel']=$_POST['UserTel'];
	$tixian['bankusername']=$_POST['BankUserName'];
	if ($_POST['txlx']==1){
		$tixian['bankname']=$_POST['BankName'];
		$tixian['bankcard']=$_POST['BankCard'];
		$tixian['bankaddress']=$_POST['BankAddress'];
	}else if($_POST['txlx']==2){
		$tixian['bankname']="支付宝";
		$tixian['bankcard']=$_POST['zhifubao'];
	}else if($_POST['txlx']==3){
		$tixian['bankname']="财付通";
		$tixian['bankcard']=$_POST['caifutong'];
	}
	$tixian['bdid']=$bdid;
	$tixian['bdname']=$bdname;
	$tixian['jine']=$jine;
	$shouxu=$system['txsl']/100*$jine;
	$tixian['shouxu']=$shouxu;
	$tixian['tdate']=now();
	$member['mey']=$mey-$jine;
	add_insert_cl('tixian',$tixian);
	edit_update_cl('member',$member,$uid);
	$_email=new email_class();
	$email=$_email->getemail();
	if ($email['isstart']==1){
		if ($email['txtzhy']==1){
			$title="提现申请通知";
			$content="尊敬的用户您好,您于".now()."向公司提现：".$jine."元,如不是您本人操作,请立即联系公司管理员.";
			$_email->sendemail($us['useremail'],$us['nickname'],$title,$content);
		}
		if ($email['txtzadmin']==1){
			$title="会员提现申请";
			$content="管理员您好,会员".$us['nickname']."于".now()."向公司提现：".$jine."元";
			$_email->sendemail($email['emailuser'],$email['emailname'],$title,$content);
		}
	}
	echo "<script language=javascript>alert('您的提现申请已经提交,请耐心等待审核.\\n本次提现金额:".$jine."\\n手续费:".$shouxu."');window.location.href='?'</script>";
	}else{
		echo "<script language=javascript>alert('您的余额不足,申请提交失败');window.location.href='?'</script>";	
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>奖金提现</title>
<script language="javascript">
<!--
function CheckForm(){
	UserTel=document.form1.UserTel.value;
	BankCard=document.form1.BankCard.value;
	BankUserName=document.form1.BankUserName.value;
	BankAddress=document.form1.BankAddress.value;
	jine=document.form1.jine.value;
	if(UserTel.length == 0){
		alert("温馨提示:\n请输入联系电话.");
		document.form1.UserTel.focus();
		return false;
	}
	if(BankCard.length == 0){
		alert("温馨提示:\n请输入开户帐号.");
		document.form1.BankCard.focus();
		return false;
	}
	if(BankUserName.length == 0){
		alert("温馨提示:\n请输入开户姓名.");
		document.form1.BankUserName.focus();
		return false;
	}
	if(BankAddress.length == 0){
		alert("温馨提示:\n请输入开户地址.");
		document.form1.BankAddress.focus();
		return false;
	}
	if(jine.length == 0){
		alert("温馨提示:\n请输入提现金额.");
		document.form1.jine.focus();
		return false;
	}
	if(jine < <?=$system['txmix']?>){
		alert("温馨提示:\n提现最小金额为<?=$system['txmix']?>.");
		document.form1.jine.focus();
		return false;
	}
	if(jine % <?=$system['txbs']?> != 0){
		alert("温馨提示:\n提现金额必须为<?=$system['txbs']?>的倍数.");
		document.form1.jine.focus();
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
    <tr>
    <td width="46%" height="22" align="right"><?=$tixian1?>：</td>
    <td width="54%" align="left"><?=$mey?></td>
  </tr>
  <tr>
    <td width="46%" height="22" align="right"><?=$tixian2?>
      ：</td>
    <td width="54%" align="left">
      <select name="txlx" id="txlx">
        <option value="1">农业银行</option>
        <!--<option value="2">支付宝</option>
        <option value="3">财付通</option>-->
      </select></td>
  </tr>
  <tr style="display:none">
    <td width="46%" height="22" align="right">联系电话
      ：</td>
    <td width="54%" align="left"><input type="text" name="UserTel" id="UserTel" value="<?=$UserTel?>"></td>
  </tr>
  <tr style="display:none">
    <td height="22" align="right">银行名称
      ：</td>
    <td align="left"><input type="text" name="BankName" id="BankName" value="<?=$BankName?>"></td>
  </tr>
  <tr >
    <td height="22" align="right"><?=$tixian3?>
      ：</td>
    <td align="left"><input type="text" name="BankCard" id="BankCard" value="<?=$BankCard?>"></td>
  </tr>
  <tr >
    <td height="22" align="right"><?=$tixian4?>
      ：</td>
    <td align="left"><input type="text" name="BankUserName" id="BankUserName" value="<?=$BankUserName?>"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$tixian5?>
      ：</td>
    <td align="left"><input type="text" name="BankAddress" id="BankAddress" value="<?=$BankAddress?>"></td>
  </tr>
  <tr style="display:none">
    <td height="22" align="right">支付宝账号：</td>
    <td align="left"><input type="text" name="zhifubao" id="zhifubao" value="<?=$zhifubao?>"></td>
  </tr>
  <tr style="display:none">
    <td height="22" align="right">财付通帐号：</td>
    <td align="left"><input type="text" name="caifutong" id="caifutong" value="<?=$caifutong?>"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$tixian6?>
      ：</td>
    <td align="left"><input name="jine" type="text" id="jine" size="10" maxlength="10">
    (<?=$tixian7?>)</td>
  </tr>
</table>
<table align="center">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="button_green" value="<?=$anniu1?>"></td>
        </tr>
      </table>
<br>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="11" align="center"><?=$tixian17?></td>
      </tr>
      <tr>
        <td align="center"><?=$tixian15?></td>
        <td align="center"><?=$tixian16?></td>
        <td align="center"><?=$tixian6?></td>
        <td align="center"><?=$tixian8?></td>
        <td align="center"><?=$tixian9?></td>
        <td align="center"><?=$tixian10?></td>
        <td align="center"><?=$tixian3?></td>
        <td align="center"><?=$tixian4?></td>
        <td align="center"><?=$tixian5?></td>
        <td align="center"><?=$tixian11?></td>
        <td align="center"><?=$tixian12?></td>
        <td style="display:none" align="center">服务中心</td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `tixian` WHERE uid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `tixian` WHERE uid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['shouxu']?></td>
        <td align="center"><?=number_format($row['jine']-$row['shouxu'],2) ?></td>
        <td align="center"><?=$row['bankname']?></td>
        <td align="center"><?=$row['bankcard']?></td>
        <td align="center"><?=$row['bankusername']?></td>
        <td align="center"><?=$row['bankaddress']?></td>
        <td align="center"><?php if ($row['isgrant']==1){?><?=$tixian13?><?php }else{?> <font color="#FF0000"><?=$tixian14?></font><?php }?></td>
        <td align="center"><?=$row['tdate']?></td>
        <td style="display:none" align="center"><?=$row['bdname']?></td>
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