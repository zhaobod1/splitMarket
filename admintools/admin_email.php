<?php
include("admin_check.php");
include_once("../class/email_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(6,23);
	$_email=new email_class();
	$email=$_email->getemail();
	
	
if($_POST['button']){
		$_email=new email_class();
		$email['id']=1;
		$email['isstart']=$_POST['isstart'];
		$email['txtzhy']=$_POST['txtzhy'];
		$email['txtzadmin']=$_POST['txtzadmin'];
		$email['cztzadmin']=$_POST['cztzadmin'];
		$email['hktzadmin']=$_POST['hktzadmin'];
		$email['ddtzadmin']=$_POST['ddtzadmin'];
		$email['emailuser']=$_POST['emailuser'];
		$email['emailpass']=$_POST['emailpass'];
		$email['emailname']=$_POST['emailname'];
		$email['emailsmtp']=$_POST['emailsmtp'];
		$email['zchy']=$_POST['zchy'];
		$email['hytitle']=$_POST['hytitle'];
		$email['hycontent']=$_POST['hycontent'];
		$_email->update_email($email);
		alert('保存成功.','?');
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>级别参数</title>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="3" align="center">电子邮件参数<br>
        (此功能需要用户自行开启邮箱一些设置,具体开启方法请咨询技术人员.)</td>
      </tr>
      <tr>
        <td width="33%" align="center">电子邮件功能</td>
        <td width="67%" align="center"><input name="isstart" type="radio" id="isstart" value="1"  <?php if($email['isstart']==1){ ?> checked <?php }?>>
开
  <input type="radio" name="isstart" id="isstart" value="0" <?php if($email['isstart']==0){ ?> checked <?php }?>>
关 </td>
      </tr>
      <tr>
        <td align="center">管理员邮箱帐号</td>
        <td align="center"><input name="emailuser" type="text" id="emailuser" value="<?=$email['emailuser']?>" size="20" maxlength="50"></td>
      </tr>
<tr>
        <td align="center">管理员邮箱密码</td>
        <td align="center"><input name="emailpass" type="password" id="emailpass" value="<?=$email['emailpass']?>" size="20" maxlength="50"></td>
      </tr>
       <tr>
        <td align="center">管理员名称</td>
        <td align="center"><input name="emailname" type="text" id="emailname" value="<?=$email['emailname']?>" size="20" maxlength="20"></td>
      </tr>
      <tr>
        <td align="center">SMTP</td>
        <td align="center"><input name="emailsmtp" type="text" id="emailsmtp" value="<?=$email['emailsmtp']?>" size="20" maxlength="50"></td>
      </tr>
      <tr>
        <td align="center">提现通知</td>
        <td align="center">通知会员
          <input name="txtzhy" type="checkbox" id="txtzhy" value="1" <?php if($email['txtzhy']==1){?>checked<?php }?>>
          通知管理员
        <input type="checkbox" name="txtzadmin" id="txtzadmin" value="1" <?php if($email['txtzadmin']==1){?>checked<?php }?>></td>
      </tr>
      <tr>
        <td align="center">充值通知管理员</td>
        <td align="center"><input type="radio" name="cztzadmin" id="cztzadmin" value="1" <?php if($email['cztzadmin']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="cztzadmin" id="cztzadmin" value="0" <?php if($email['cztzadmin']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr>
        <td align="center">汇款通知管理员</td>
        <td align="center"><input type="radio" name="hktzadmin" id="hktzadmin" value="1" <?php if($email['hktzadmin']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="hktzadmin" id="hktzadmin" value="0" <?php if($email['hktzadmin']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr>
        <td align="center">订单通知管理员</td>
        <td align="center"><input type="radio" name="ddtzadmin" id="ddtzadmin" value="1" <?php if($email['ddtzadmin']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="ddtzadmin" id="ddtzadmin" value="0" <?php if($email['ddtzadmin']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr>
        <td align="center">注册欢迎邮件</td>
        <td align="center"><input type="radio" name="zchy" id="zchy" value="1" <?php if($email['zchy']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="zchy" id="zchy" value="0" <?php if($email['zchy']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr>
        <td align="center">欢迎邮件标题</td>
        <td align="center"><input name="hytitle" type="text" id="hytitle" value="<?=$email['hytitle']?>" size="20" maxlength="50"></td>
      </tr>
      <tr>
        <td align="center">欢迎邮件内容</td>
        <td align="center">
        <textarea name="hycontent" id="hycontent" cols="45" rows="5"><?=$email['hycontent']?></textarea></td>
    </tr>
      <tr>
        <td colspan="3" align="center"><input name="button" type="submit" class="btn2" id="button" value="保存"></td>
      </tr>
    </table>
</form>
</body>
</html>