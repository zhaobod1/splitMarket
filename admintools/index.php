
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理系统</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>

<?php
	include_once("../class/admin_class.php");
	session_start();
	if ($_POST['button'])
	{
		$_admin = new admin_class();
		if ($loginadmin=$_admin->getadminbynamepass($_POST['username'],$_POST['password']))
		{
			if($_SESSION['to_admin']){
				alert("检测到您上个帐号尚未退出登录,请您先安全退出上个帐号或关闭浏览器后再尝试重新登录","?");
			}else{
				$_SESSION['to_admin']=$loginadmin['loginname'];
				$_SESSION['adminid']=$loginadmin['id'];
				$_SESSION['qx']=$loginadmin['group'];
				date_default_timezone_set('PRC');
				$_SESSION['lgdate']=date('Y-m-d H:i:s',time());
				$_SESSION['sclgdate']=$loginadmin['logindate'];
				$update_admin['logindate']=$_SESSION['lgdate'];
				$_SESSION['zq1']=$loginadmin['zq1'];
				$_SESSION['zq2']=$loginadmin['zq2'];
				$_SESSION['zq3']=$loginadmin['zq3'];
				$_SESSION['zq4']=$loginadmin['zq4'];
				$_SESSION['zq5']=$loginadmin['zq5'];
				$_SESSION['zq6']=$loginadmin['zq6'];
				$_SESSION['zq7']=$loginadmin['zq7'];
				$_SESSION['zq8']=$loginadmin['zq8'];
				$_SESSION['zq9']=$loginadmin['zq9'];
				$_SESSION['zq10']=$loginadmin['zq10'];
				$_SESSION['q1']=$loginadmin['q1'];
				$_SESSION['q2']=$loginadmin['q2'];
				$_SESSION['q3']=$loginadmin['q3'];
				$_SESSION['q4']=$loginadmin['q4'];
				$_SESSION['q5']=$loginadmin['q5'];
				$_SESSION['q6']=$loginadmin['q6'];
				$_SESSION['q7']=$loginadmin['q7'];
				$_SESSION['q8']=$loginadmin['q8'];
				$_SESSION['q9']=$loginadmin['q9'];
				$_SESSION['q10']=$loginadmin['q10'];
				$_SESSION['q11']=$loginadmin['q11'];
				$_SESSION['q12']=$loginadmin['q12'];
				$_SESSION['q13']=$loginadmin['q13'];
				$_SESSION['q14']=$loginadmin['q14'];
				$_SESSION['q15']=$loginadmin['q15'];
				$_SESSION['q16']=$loginadmin['q16'];
				$_SESSION['q17']=$loginadmin['q17'];
				$_SESSION['q18']=$loginadmin['q18'];
				$_SESSION['q19']=$loginadmin['q19'];
				$_SESSION['q20']=$loginadmin['q20'];
				$_SESSION['q21']=$loginadmin['q21'];
				$_SESSION['q22']=$loginadmin['q22'];
				$_SESSION['q23']=$loginadmin['q23'];
				$_SESSION['q24']=$loginadmin['q24'];
				$_SESSION['q25']=$loginadmin['q25'];
				$_SESSION['q26']=$loginadmin['q26'];
				$_SESSION['q27']=$loginadmin['q27'];
				$_SESSION['q28']=$loginadmin['q28'];
				$_SESSION['q29']=$loginadmin['q29'];
				$_SESSION['q30']=$loginadmin['q30'];
				$_admin->admin_update($update_admin,$loginadmin['id']);
				echo "<script language=javascript>window.location.href='main.php'</script>";	
			}
		}else{
			alert('用户名密码错误,请重新登录','?');
		}
	}
	
	if ($_GET['action']=="Quit"){
		$_SESSION['qx']="";
		$_SESSION['to_admin']="";
		$_SESSION['adminid']="";
		$_SESSION['lgdate']="";
		$_SESSION['sclgdate']="";
		$_SESSION['zq1']="";
		$_SESSION['zq2']="";
		$_SESSION['zq3']="";
		$_SESSION['zq4']="";
		$_SESSION['zq5']="";
		$_SESSION['zq6']="";
		$_SESSION['zq7']="";
		$_SESSION['zq8']="";
		$_SESSION['zq9']="";
		$_SESSION['zq10']="";
		$_SESSION['q1']="";
		$_SESSION['q2']="";
		$_SESSION['q3']="";
		$_SESSION['q4']="";
		$_SESSION['q5']="";
		$_SESSION['q6']="";
		$_SESSION['q7']="";
		$_SESSION['q8']="";
		$_SESSION['q9']="";
		$_SESSION['q10']="";
		$_SESSION['q11']="";
		$_SESSION['q12']="";
		$_SESSION['q13']="";
		$_SESSION['q14']="";
		$_SESSION['q15']="";
		$_SESSION['q16']="";
		$_SESSION['q17']="";
		$_SESSION['q18']="";
		$_SESSION['q19']="";
		$_SESSION['q20']="";
		$_SESSION['q21']="";
		$_SESSION['q22']="";
		$_SESSION['q23']="";
		$_SESSION['q24']="";
		$_SESSION['q25']="";
		$_SESSION['q26']="";
		$_SESSION['q27']="";
		$_SESSION['q28']="";
		$_SESSION['q29']="";
		$_SESSION['q30']="";
	}
?>

<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>Simpla Admin</h1>
    <!-- Logo (221px width) -->
    <img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></div>
  <!-- End #logn-top -->
  <div id="login-content">
    <form action="?" method="post">
      <div class="notification information png_bg">
        <div>管理员登录</div>
      </div>
      <p>
        <label>用户名</label>
        <input type="text" class="text-input" id="username" name="username" />
      </p>
      <div class="clear"></div>
      <p>
        <label>密码</label>
        <input type="password" class="text-input" id="password" name="password" />
      </p>
      <div class="clear"></div>
      <div class="clear"></div>
      <p>
        <input type="submit" class="button" id="button" name="button" value="登  录" />
      </p>
    </form>
  </div>
  <!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>
