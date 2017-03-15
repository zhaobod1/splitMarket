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


