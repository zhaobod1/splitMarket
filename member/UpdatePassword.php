
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>个人资料</title>
<?php
include("check.php");
include("check2.php");
include_once("../function.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
if ($_POST['submit']){
	$us=getMemberbyID($_SESSION['ID']);
	if ($_GET['pass'] == 1){
		if ($_POST['password1'] == $us['password1']){
			$pass['password1']=	$_POST['npassword1'];
		}else{
			echo "<script language=javascript>alert('密码错误,请确认后重新输入.');window.location.href='?'</script>";		
		}
	}elseif ($_GET['pass'] == 2){
		if ($_POST['password2'] == $us['password2']){
			$pass['password2']=	$_POST['npassword2'];
		}else{
			echo "<script language=javascript>alert('密码错误,请确认后重新输入.');window.location.href='?'</script>";		
		}
	}elseif ($_GET['pass'] == 3){
		if ($_POST['password3'] == $us['password3']){
			$pass['password3']=	$_POST['npassword3'];
		}else{
			echo "<script language=javascript>alert('密码错误,请确认后重新输入.');window.location.href='?'</script>";	
		}
	}
	echo edit_update_cl('member',$pass,$_SESSION['ID']);
	echo "<script language=javascript>alert('修改成功.');window.location.href='?'</script>";
}
?>
<script language="javascript">
<!--
function ckpass1(){
	document.getElementById('pass1').style.display='';
	document.getElementById('pass2').style.display='none';
	document.getElementById('pass3').style.display='none';
}
function ckpass2(){
	document.getElementById('pass1').style.display='none';
	document.getElementById('pass2').style.display='';
	document.getElementById('pass3').style.display='none';
}
function ckpass3(){
	document.getElementById('pass1').style.display='none';
	document.getElementById('pass2').style.display='none';
	document.getElementById('pass3').style.display='';
}

function CheckForm1(){
	password1=document.form1.password1.value;
	npassword1=document.form1.npassword1.value;
	qnpassword1=document.form1.qnpassword1.value;
	
	
	if(password1.length == 0){
		alert("温馨提示:\n请输入原密码.");
		document.form1.password1.focus();
		return false;
	}
	if(npassword1.length == 0){
		alert("温馨提示:\n请输入新密码.");
		document.form1.npassword1.focus();
		return false;
	}
	if(qnpassword1.length == 0){
		alert("温馨提示:\n请确认新密码.");
		document.form1.qnpassword1.focus();
		return false;
	}
	if(qnpassword1 != npassword1){
		alert("温馨提示:\n两次密码输入不一致,请确认后重新输入.");
		document.form1.qnpassword1.focus();
		return false;
	}
	return true;
}

function CheckForm2(){
	password2=document.form2.password2.value;
	npassword2=document.form2.npassword2.value;
	qnpassword2=document.form2.qnpassword2.value;
	
	
	if(password2.length == 0){
		alert("温馨提示:\n请输入原密码.");
		document.form2.password2.focus();
		return false;
	}
	if(npassword2.length == 0){
		alert("温馨提示:\n请输入新密码.");
		document.form2.npassword2.focus();
		return false;
	}
	if(qnpassword2.length == 0){
		alert("温馨提示:\n请确认新密码.");
		document.form2.qnpassword2.focus();
		return false;
	}
	if(qnpassword2 != npassword2){
		alert("温馨提示:\n两次密码输入不一致,请确认后重新输入.");
		document.form2.qnpassword2.focus();
		return false;
	}
	return true;
}

function CheckForm3(){
	password3=document.form3.password3.value;
	npassword3=document.form3.npassword3.value;
	qnpassword3=document.form3.qnpassword3.value;
	
	
	if(password3.length == 0){
		alert("温馨提示:\n请输入原密码.");
		document.form3.password3.focus();
		return false;
	}
	if(npassword3.length == 0){
		alert("温馨提示:\n请输入新密码.");
		document.form3.npassword3.focus();
		return false;
	}
	if(qnpassword3.length == 0){
		alert("温馨提示:\n请确认新密码.");
		document.form3.qnpassword3.focus();
		return false;
	}
	if(qnpassword3 != npassword3){
		alert("温馨提示:\n两次密码输入不一致,请确认后重新输入.");
		document.form3.qnpassword3.focus();
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<div>
	<div class="buttons"><button style="float:left" type="botton" class="regular" onClick="ckpass1();">
    <img src="images/textfield_key.png" alt=""/> 
    <?=$updatepassword2?>
    </button>
    </div>
    <div class="buttons"><button style="float:left" type="botton" class="regular" onClick="ckpass2();">
    <img src="images/textfield_key.png" alt=""/> 
    <?=$updatepassword3?>
    </button>
    </div>
    <div class="buttons"><button style="float:left;display:none" type="botton" class="regular" onClick="ckpass3();">
    <img src="images/textfield_key.png" alt=""/> 
    修改三级密码
    </button>
    </div>
</div>
<br><br><br>
<table id="pass1" width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
<form name="form1" method="post" action="?pass=1" onSubmit="return CheckForm1();">
	<tr>
    <td colspan="2" align="center"><?=$updatepassword2?></td>
    </tr>
     <tr>
    <td width="50%" align="right"><?=$updatepassword4?>：</td>
    <td width="50%" align="left">
      <input type="password" name="password1" id="password1">
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><?=$updatepassword5?>：</td>
    <td width="50%" align="left">
      <input type="password" name="npassword1" id="npassword1" >
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><?=$updatepassword6?>：</td>
    <td width="50%" align="left">
      <input type="password" name="qnpassword1" id="qnpassword1" >
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
  <input name="submit" type="submit" class="button_green" value="<?=$updatepassword7?>" id="submit">
      </td>
  </tr>
</form>
</table>

<table id="pass2" width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" style="display:none">
<form name="form2" method="post" action="?pass=2" onSubmit="return CheckForm2();">
	<tr>
    <td colspan="2" align="center"><?=$updatepassword3?></td>
    </tr>
     <tr>
    <td width="50%" align="right"><?=$updatepassword4?>：</td>
    <td width="50%" align="left">
      <input type="password" name="password2" id="password2">
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><?=$updatepassword5?>：</td>
    <td width="50%" align="left">
      <input type="password" name="npassword2" id="npassword2" >
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><?=$updatepassword6?>：</td>
    <td width="50%" align="left">
      <input type="password" name="qnpassword2" id="qnpassword2" >
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
 <input name="submit" type="submit" class="button_green" value="<?=$updatepassword7?>" id="submit">
      </td>
  </tr>
</form>
</table>

<table id="pass3" width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" style="display:none">
<form name="form3" method="post" action="?pass=3" onSubmit="return CheckForm3();">
	<tr>
    <td colspan="2" align="center">修改三级密码</td>
    </tr>
     <tr>
    <td width="50%" align="right">原密码：</td>
    <td width="50%" align="left">
      <input type="password" name="password3" id="password3">
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">新密码：</td>
    <td width="50%" align="left">
      <input type="password" name="npassword3" id="npassword3" >
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">确认新密码：</td>
    <td width="50%" align="left">
      <input type="password" name="qnpassword3" id="qnpassword3" >
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
  <div class="buttons"><button type="submit" class="positive" name="submit" id="submit">
    <img src="images/apply2.png" alt=""/> 
    确认修改
    </button>
    </div>
      </td>
  </tr>
</form>
</table>

</body>
</html>