<?php
include_once("../class/system_class.php");
session_start();
if ($_SESSION['ID'] == null){
	echo "<script language=javascript>alert('您尚未登录,请您重新登录.');top.location='../index.php'</script>";	
}
if ($_SESSION['ID'] != 1){
	$_system=new system_class();
	$sys=$_system->system_information(1);
	if ($sys['xtkg']==0){
		echo "<script language=javascript>alert('系统当前正在维护,暂时无法登录.');top.location='../index.php'</script>";	
	}
}
?>
