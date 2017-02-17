<?php
session_start();
if ($_SESSION['pass2'] <> 1){
	echo "<script language=javascript>window.location.href='test.php'</script>";
}
?>
