<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/2/24
 * Time: 下午2:25
 */

header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("Etc/GMT-8");
//error_reporting(E_ALL ^ E_NOTICE);

define('IN_HUO15', true);
define('EC_CHARSET', 'utf-8');
define("ADMIN_PHONE", "18050782016");
define("YXB_SHOPCOIN", 7);
if (!ROOT_PATH) {
	define('ROOT_PATH', dirname(__FILE__).'/..');

}
define('DATA_DIR', 'data');

$db_host = "localhost:3306";
$db_name = "splitMarket_db";
$db_user = "splitMarket";
$db_pass = "huo15com";

require_once 'cls_mysql.php';
$ecs_db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);