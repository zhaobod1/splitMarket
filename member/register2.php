<?php
include_once("../function.php");
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
include_once("../class/email_class.php");
session_start();
if($_POST['submit']){
	$bdName=$_POST['bdName'];//服务器中心编号
	$rName=$_POST['rName'];//推荐人编号
	$FatherName=$_POST['FatherName'];//接点人编号
	$TreePlace=$_POST['TreePlace'];//安置区域
	$UserID=$_POST['UserID'];
	//$NickName=$_POST['NickName'];
	$NickName=$_POST['UserID'];//会员编号
	$password1=$_POST['password1'];//一级密码
	$password2=$_POST['password2'];//二级密码
	$password3=$_POST['password3'];//三级密码 （隐藏）
	$passQuestion=$_POST['passQuestion'];//密码安全问题(隐藏）
	$passAnswer=$_POST['passAnswer'];//安全问题答案（隐藏）
	$UserCard=$_POST['UserCard'];//身份证号码(hidden)
	$UserName=$_POST['UserName'];//会员姓名
	$UserTel=$_POST['UserTel'];//电话号码(hidden)
	$UserAddress=$_POST['UserAddress'];//地址（hidden）
	$UserQQ=$_POST['UserQQ'];//hidden
	$BankName=$_POST['bankname'];//hidden
	$BankCard=$_POST['BankCard'];//hidden
	$BankUserName=$_POST['BankUserName'];//hidden
	$BankAddress=$_POST['BankAddress'];//hidden
	$useremail=$_POST['useremail'];
	$sex=$_POST['sex'];
	$nian=$_POST['nian'];
	$yue=$_POST['yue'];
	$ri=$_POST['ri'];
	$xueli=$_POST['xueli'];
	$zhifubao=$_POST['zhifubao'];
	$caifutong=$_POST['caifutong'];
	$userprovinceid=$_POST['classification'];
	$usercityid=$_POST['menu'];
	$uLevel=$_POST['uLevel'];
	$_ulevel=new ulevel_class();
	$ul=$_ulevel->getulevelbyulevel($uLevel);
	$jibie=$ul['lvname'];
	$lsk=$ul['lsk'];
	$dan=$ul['dan'];
	$pv=0;
	$sheng=$_POST['province'];
	$shi=$_POST['city1'];
	$xian=$_POST['city2'];
	
	$zhuce=true;



	if(checkUserID($UserID) == true)
	{
		$zhuce=false;
		echo "<script language=javascript>alert('会员编号已存在,请刷新后再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}
	if(checkNickName($NickName) == true)
	{
		$zhuce=false;
		echo "<script language=javascript>alert('会员编号已存在,请更换后再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}
	if(checkNickName($bdName) == false){
		$zhuce=false;
		echo "<script language=javascript>alert('服务中心编号不存在,请检查后再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}else{
		$array=getMemberbyNickName($bdName);
		$bdid=$array['id'];		
	}
	if(checkNickNamebyispay($rName) == false){
		$zhuce=false;
		echo "<script language=javascript>alert('推荐人编号不存在,或尚未激活,请检查后再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}else{
		$array=getMemberbyNickName($rName);
		$reid=$array['id'];
		$reLevel=$array[relevel]+1;
		$rePath="".$array[repath].$array[id].",";
	}
	if(checkNickNamebyispay($FatherName) == false){
		$zhuce=false;
		echo "<script language=javascript>alert('接点人编号不存在,或尚未激活,请检查后再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}else{
		$array=getMemberbyNickName($FatherName);
		$FatherID=$array['id'];
		$pLevel=$array[plevel]+1;
		$fplevel=$array[plevel];
		$pPath="".$array[ppath].$array[id].",";
		$area1=$array['area1'];
		$area2=$array['area2'];
		$fxlevel=$array['xlevel'];
	}
	
	if(checkFatherMan($FatherID,$TreePlace) == true){
		$zhuce=false;
		echo "<script language=javascript>alert('该位置已有会员注册,请更换区域再试.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}
	
	if($TreePlace==3 and ($area1<16800 or $area2<16800)){
		$zhuce=false;
		echo "<script language=javascript>alert('AB区业绩必须达到16800才能注册C区.');window.location.href='register.php?nickname=".$FatherName."&tid=".$TreePlace."'</script>";
	}
	
	if($zhuce){
		$member['userid']=$UserID;
		$member['nickname']=$NickName;
		$member['password1']=$password1;
		$member['password2']=$password2;
		$member['password3']=$password3;
		$member['passquestion']=$passQuestion;
		$member['passanswer']=$passAnswer;
		$member['username']=$UserName;
		$member['usercard']=$UserCard;
		$member['usertel']=$UserTel;
		$member['useraddress']=$UserAddress;
		$member['userqq']=$UserQQ;
		$member['bankname']=$BankName;
		$member['bankcard']=$BankCard;
		$member['bankuserName']=$BankUserName;
		$member['sheng']=$sheng;
		$member['shi']=$shi;
		$member['xian']=$xian;
		$member['bankaddress']=$BankAddress;
		$member['ulevel']=$uLevel;
		$member['dan']=$dan;
		$member['lsk']=$lsk;
		$member['pv']=$pv;
		$member['reid']=$reid;
		$member['rname']=$rName;
		$member['relevel']=$reLevel;
		$member['repath']=$rePath;
		$member['treeplace']=$TreePlace;
		$member['fatherid']=$FatherID;
		$member['fathername']=$FatherName;
		$member['plevel']=$pLevel;
		$member['ppath']=$pPath;
		$member['bdid']=$bdid;
		$member['bdname']=$bdName;
		$member['useremail']=$useremail;
		$member['rdt']=now();
		$member['sex']=$sex;
		$member['nian']=$nian;
		$member['yue']=$yue;
		$member['ri']=$ri;
		$member['xueli']=$xueli;
		$member['zhifubao']=$zhifubao;
		$member['caifutong']=$caifutong;
		$member['zcid']=$_SESSION['ID'];

		/* 青岛火一五信息科技有限公司huo15.com 日期：2017/1/7 */
		include_once "../include/config.inc.php";
		include_once   "../uc_client/client.php";

		$uid = uc_user_register($member['userid'], $member['password1'], time()."@163.com");

		echo uc_user_synlogin($uid);
		/* 青岛火一五信息科技有限公司huo15.com 日期：2017/1/7 end */
		if (!$uid) {
			echo "<script language=javascript>alert('同步商城会员出错！请重新注册。.');</script>";
			die;

		}

		add_insert_cl('member',$member);
		$_email=new email_class();
		$email=$_email->getemail();
		if ($email['zchy']==1){
			$_email->sendemail($member['useremail'],$member['nickname'],$email['hytitle'],$email['hycontent']);
		}
	}
	
	
	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>注册成功</title>
</head>
<body>
<table  width="100%" height="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
	<tr>
    <td colspan="2" align="center">注册成功</td>
    </tr>
	<tr>
	  <td width="50%" height="30" align="right">服务中心编号：</td>
	  <td width="50%" align="left"><?=$bdName?></td>
    </tr>
	<tr>
    <td align="right">推荐人编号：</td>
    <td align="left">
      <?=$rName?></td>
  </tr>
  <tr>
    <td align="right">接点人编号：</td>
    <td align="left">
      <?=$FatherName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">安置区域：</td>
    <td align="left">
      <?=$quyu?></td>
  </tr>
  <tr>
    <td align="right">会员编号：</td>
    <td align="left">
      <?=$UserID?></td>
  </tr>
  <tr style="display:none">
    <td align="right">会员编号：</td>
    <td align="left"><?=$NickName?></td>
  </tr>
  <tr>
    <td align="right">一级密码：</td>
    <td align="left"><?=$password1?></td>
  </tr>
  <tr>
    <td align="right">二级密码：</td>
    <td align="left"><?=$password2?></td>
  </tr>
  <tr style="display:none">
    <td align="right">三级密码：</td>
    <td align="left"><?=$password3?></td>
  </tr>
  <tr style="display:none">
    <td align="right">密码安全问题：</td>
    <td align="left"><?=$passQuestion?></td>
  </tr>
  <tr style="display:none">
    <td align="right">密码安全答案：</td>
    <td align="left"><?=$passAnswer?></td>
  </tr>
  <tr  style="display:none">
    <td align="right">身份证号码：</td>
    <td align="left"><?=$UserCard?></td>
  </tr>
  <tr>
    <td align="right">会员姓名：</td>
    <td align="left"><?=$UserName?></td>
  </tr>
  <tr>
    <td align="right">性别：</td>
    <td align="left">
	<?php if ($sex==1){?>男<?php }else{?>女<?php }?></td>
  </tr>
  <tr>
    <td align="right">出生日期：</td>
    <td align="left"><?=$nian?>年<?=$yue?>月<?=$ri?>日</td>
  </tr>
  <tr  style="display:none">
    <td align="right">学历：</td>
    <td align="left"><?=$xueli?></td>
  </tr>
  <tr style="display:none">
    <td align="right">联系电话：</td>
    <td align="left"><?=$UserTel?></td>
  </tr>
  <tr style="display:none">
    <td align="right">联系地址：</td>
    <td align="left"><?=$sheng?><?=$shi?><?=$xian?></td>
  </tr>
  <tr style="display:none">
    <td align="right">收货详细地址：</td>
    <td align="left"><?=$UserAddress?></td>
  </tr>
  <tr style="display:none">
    <td align="right">QQ号码：</td>
    <td align="left"><?=$UserQQ?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户银行：</td>
    <td align="left">
      <?=$BankName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户帐号：</td>
    <td align="left"><?=$BankCard?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户姓名：</td>
    <td align="left"><?=$BankUserName?></td>
  </tr>
  <tr style="display:none">
    <td align="right">开户地址：</td>
    <td align="left"><?=$BankAddress?></td>
  </tr>
  <tr style="display:none">
    <td align="right">支付宝账号：</td>
    <td align="left"><?=$zhifubao?></td>
  </tr>
  <tr style="display:none">
    <td align="right">财付通帐号：</td>
    <td align="left"><?=$caifutong?></td>
  </tr>
  <tr>
    <td align="right">加盟级别：</td>
    <td align="left">
      <?=$jibie?></td>
  </tr>
  <tr>
    <td align="right">汇款金额：</td>
    <td><?=$lsk?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">请尽快汇款至公司账户并与公司联系，确认收款后激活成为正式会员。</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center"><a href="register.php">继续注册</a></td>
  </tr>
  
</table>
</body>
</html>