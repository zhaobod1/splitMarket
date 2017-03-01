<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/3/1
 * Time: 下午2:46
 */

define("IN_HUO15", true);
$b = 0;
if ($b) {
	require_once "../include/cls_sms.php";
	require_once "../include/initMysql.php";
	global $ecs_db;

	$oSms = new Sms("15288986891", "huo15");
	$oRes = $oSms->sendSms();

	$res = trim($oRes->reason);
	if ($res=='10000') {
		echo "success.";
	} else {
		echo "fail.";
	}
	echo "<br>";
	var_dump($oRes);
}
