<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/3/14
 * Time: 下午12:11
 */
include("check.php");
include_once("../function.php");
require_once "../include/initMysql.php";
global $ecs_db;


$act = isset($_REQUEST['act'])? $_REQUEST['act']:0;

//获取备用金
if ($act == "getPettyCash") {
	$pettyCash = 1000000;
	$sql = "select sum(total) from stockbuy WHERE lx=1";
	$totalBuy = $ecs_db->getOne($sql);
	$addPettyCash = floatval($totalBuy)*0.1;
	$pettyCash = $pettyCash + $addPettyCash;

	$strPettyCash = "¥ " . $pettyCash;
	echo json_encode($strPettyCash);
	die;
}