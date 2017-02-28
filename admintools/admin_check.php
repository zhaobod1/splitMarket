<?php
error_reporting(0);
session_start();
if ($_SESSION['to_admin'] == null){
	echo "<script language=javascript>alert('您尚未登录,请您重新登录.');top.location='index.php'</script>";	
}

function checkqx($zq,$q){
	$_zq="zq".$zq;
	$_q="q".$q;
	if($_SESSION[$_zq]!=1){
		echo "<script language=javascript>alert('您没有管理该项功能的权限.');window.history.back();</script>";		
	}
	if($_SESSION[$_q]!=1){
		echo "<script language=javascript>alert('您没有管理该项功能的权限.');window.history.back();</script>";		
	}
}

?>
