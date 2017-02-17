<?php
ob_start();
error_reporting(0);
import_request_variables('pg');

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

$config_ip="localhost";
$config_name="splitMarket";
$config_pass="huo15com";
$config_dbname="splitMarket_db";


/*$config_ip="localhost";
$config_name="qdcms";
$config_pass="huo15.com";
$config_dbname="qdcms";*/
?>