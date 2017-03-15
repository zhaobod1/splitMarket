<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/3/14
 * Time: 下午7:26
 */

require_once "cls_sms.php";

/**
 * 同时向客户和管理员发提醒消息。主要用于提现消息。
 * @param string $userPhone 客户的电话号码
 * @param string $order_sn 客户的订单号
 * @return voidå
 */
function sendSmsToAdminAndClient($userPhone, $order_sn) {
	$oSms = new Sms($userPhone,"");
	$oSms->changeMsg("尊敬的客户，您的订单编号".$order_sn."，已经生效，请查收！");
	$oRes = $oSms->sendSms();
	$oSms2 = new Sms(ADMIN_PHONE);
	$oSms2->changeMsg("管理员您好，有客户下单了，订单：".$order_sn."，请注意查收！");
	$oSms2->sendSms();
}

/**
 * 积分兑换
 * @param integer $userId 用户的ID $us['userid']
 * @param integer $sourcePoint 要兑换的金币数 设置比例
 * @param integer $targetPoint 要兑换目标应用的币数 设置比例
 * @param integer $targetAPP 目标应用ID
 * @param integer $targetAmount 目标应用兑换的币数量
 * @return bool 1 兑换成功，0 兑换失败
 */
function addShopCoin($userId,$sourcePoint,$targetPoint,$targetAPP,$targetAmount) {
	include_once "../include/config.inc.php";
	include_once   "../uc_client/client.php";
	list($uid, $username, $password, $email) = uc_get_user($userId);

	$res = uc_credit_exchange_request($uid,$sourcePoint, $targetPoint,$targetAPP,$targetAmount);
	return $res;

}


