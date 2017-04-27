<?php
ob_start();
error_reporting(E_ALL);
//import_request_variables('pg');
function huo15_get_client_ip()
{
	if ($_SERVER['REMOTE_ADDR']) {
		$cip = $_SERVER['REMOTE_ADDR'];
	} elseif (getenv("REMOTE_ADDR")) {
		$cip = getenv("REMOTE_ADDR");
	} elseif (getenv("HTTP_CLIENT_IP")) {
		$cip = getenv("HTTP_CLIENT_IP");
	} else {
		$cip = "unknown";
	}
	return $cip;
}
$check_ary=array(" ","'","or","OR","and","%","‘","‘","’","union","join",";","\%","{","}","\$","=","/","\\");

if (count($_POST)) {
    while (list($key, $val) = each($_POST)) {
        if (!(is_array($val)))  {
            $val=trim($val);
            $$key = addslashes($val);}
        else{
            $$key = $val;}
    }
}
if ( !ini_get('register_globals') )
{
    extract($_POST);
    extract($_GET);
    extract($_SERVER);
    extract($_FILES);
    extract($_ENV);
    extract($_COOKIE);

    if ( isset($_SESSION) )
    {
        extract($_SESSION);
    }
}
if (huo15_get_client_ip() == "127.0.0.1") {
	$config_ip="211.149.214.242";
	$config_name="splitmarket";
	$config_pass="huo15com";
	$config_dbname="splitmarket";
} else {
	$config_ip="localhost";
	$config_name="splitmarket";
	$config_pass="huo15com";
	$config_dbname="splitmarket";
}

define("IN_HUO15", true);
/*$config_ip="localhost";
$config_name="qdcms";
$config_pass="huo15.com";
$config_dbname="qdcms";*/
?>