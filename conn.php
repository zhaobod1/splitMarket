<?php
include("config.php");
$conn = @mysql_connect($config_ip,$config_name,$config_pass) or die ("链接错误");
mysql_select_db($config_dbname,$conn);
mysql_query("set names 'UTF8'");

?>