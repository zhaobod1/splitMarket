<?php
include("check.php");
include("check2.php");
include_once("../function.php");

header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$us=que_select_cl('member',$_SESSION['ID']);
if ($_POST['submit']){
	if ($sus=getMemberbyNickName($_POST['snickname'])){
		$mail['uid']=$us['id'];
		$mail['nickname']=$us['nickname'];
		$mail['sid']=$sus['id'];
		$mail['snickname']=$sus['nickname'];
		$mail['title']=$_POST['title'];
		$mail['mailcontent']=$_POST['mailcontent'];
		$mail['fdate']=now();
		echo add_insert_cl('mail',$mail);
		echo "<script language=javascript>alert('邮件发送成功.');window.location.href='?'</script>";	
	}else{
			echo "<script language=javascript>alert('该会员不存在,请确认后重新填写');window.location.href='?'</script>";	
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="xheditor/common.css" type="text/css" media="screen" />
<script type="text/javascript" src="xheditor/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<title>发送邮件</title>
<script language="javascript">
<!--
function lxClick(lx){
	if(lx == 1){
		document.getElementById("snickname").readOnly = false;
		document.getElementById("snickname").value = "";
	}else if(lx == 2){
		document.getElementById("snickname").readOnly = true;
		document.getElementById("snickname").value = "admin";
	}
}
function CheckForm(){
	snickname=document.form1.snickname.value;
	title=document.form1.title.value;
	mailcontent=document.form1.mailcontent.value;
	if(snickname.length == 0){
		alert("温馨提示:\n请输入收件会员.");
		document.form1.snickname.focus();
		return false;
	}
	if(title.length == 0){
		alert("温馨提示:\n请输入邮件标题.");
		document.form1.title.focus();
		return false;
	}
	if(mailcontent == ''){
		alert("温馨提示:\n请输入邮件内容.");
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table  width="90%" height="350" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
    <td width="90" height="22" align="right"><?=$mailadd1?>：</td>
    <td align="left"><input name="snickname" type="text" id="snickname" size="20" maxlength="20" value="<?=$_GET['nickname']?>">
      <input name="lx" type="radio" id="lx" value="1" checked onClick="lxClick(1)">
      <?=$mailadd2?>
      <input type="radio" name="lx" id="lx" value="2" onClick="lxClick(2)">
      <?=$mailadd3?></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$mailadd4?>：</td>
    <td align="left"><input name="title" type="text" id="title" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right" valign="top"><?=$mailadd5?>：</td>
    <td align="left">
	<textarea id="mailcontent" name="mailcontent" class="xheditor-simple" rows="12" cols="80" style="width: 70%">
	</textarea></td>
  </tr>
</table>
<table align="center">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="button_green" value="<?=$anniu1?>" onClick="javascript:return confirm('您确认要发送站内信吗？');"></td>
        </tr>
      </table>
</form>
</body>
</html>