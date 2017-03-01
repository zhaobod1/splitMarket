<?php
include("function.php");
header("Content-Type: text/html;charset=utf-8");
error_reporting(E_ALL);
session_start();

define('ROOT_PATH', str_replace('index.php', '', str_replace('\\', '/', __FILE__)));

if (@$_GET['lang'] == "") {
	$_SESSION['language'] = 2;
} else {
	$_SESSION['language'] = $_GET['lang'];
}

if ($_SESSION['language'] == 1) {
	$title = "会员商务系统";
	$memberid = "登录帐号";
	$password = "登录密码";
	$code = "登录验证";
	$lang = "语言";
	$zh = "中文版";
	$en = "English";
	$px = "360";
	$px2 = "340";
	$loginimg = "loginimages/enniu.png";
} else {
	$title = "Member Systme";
	$memberid = "Member ID";
	$password = "PassWord";
	$code = "Code";
	$lang = "Language";
	$zh = "中文版";
	$en = "English";
	$px = "340";
	$px2 = "340";
	$loginimg = "loginimages/enniu2.png";
}

unset($_SESSION['ID']);
unset($_SESSION['NickName']);
unset($_SESSION['UserID']);
unset($_SESSION['isboss']);
if (@$_POST['loginnow'] == "loginnow") {
	if ($_POST['code'] == $_SESSION['code']) {
		if (systemstatus()) {
		    $nickName = isset($_REQUEST['NickName'])? $_REQUEST['NickName']:0;
		    if ($nickName) {
		        if (!(preg_match("/^CN.*/i",$nickName) || preg_match("/admin/", $nickName))) {
                    require_once "include/initMysql.php";
                    global $ecs_db;
                    $sql = "select nickname from member WHERE usertel='" . $nickName . "'";
                    $nickNameRes = $ecs_db->getOne($sql);
                    if ($nickNameRes) {
                        $_POST["NickName"] = $nickNameRes;
                    } else {
	                    echo "<script language=javascript>alert('手机号码有误，请重新输入！.');window.location.href='?'</script>";

                    }
                }
            }
			if (checkLogin($_POST['NickName'], $_POST['password'])) {
				$us = getMemberbyNickName($_POST['NickName']);
				$_SESSION['ID'] = $us['id'];
				$_SESSION['nickname'] = $us['nickname'];
				$_SESSION['username'] = $us['username'];
				$_SESSION['userid'] = $us['userid'];
				@$_SESSION['isboss'] = $us['isboss'];
				$_SESSION['sclogin'] = $us['sclogin'];
				$_SESSION['bdid'] = $us['bdid'];
				$_SESSION['isbd'] = $us['isbd'];
				$_SESSION['bdlevel'] = $us['bdlevel'];
				if ($us['id'] == 1) {
					$_SESSION['bdname'] = $us['nickname'];
				} else {
					if ($us['isbd'] == 2) {
						$_SESSION['bdname'] = $us['nickname'];
					} else {
						$_SESSION['bdname'] = $us['bdname'];
					}
				}
				$_SESSION['bclogin'] = now();
				$member_update['sclogin'] = now();
				edit_update_cl('member', $member_update, $us['id']);

				//同步登录  huo15.com
				error_reporting(E_ALL);
				include_once "./include/config.inc.php";
				include_once   "./uc_client/client.php";
				$GLOBALS['db'] = uc_api_mysql("user","ReturnDb");

				writeLog("***********主站 login **********");
				list($uid, $username, $password, $email) = uc_user_login($_SESSION['userid'],$_POST['password']);


				if ($uid>0) {
					//同步登录成功
					echo uc_user_synlogin($uid);

				} elseif ($uid==-1) {
					//用户不存在，或者被删除
					if ($username != "admin"){
						if ($us['ispay']==1) {
							$uid = uc_user_register($_SESSION['userid'], $_POST['password'], time()."@163.com");
							list($uid, $username, $password, $email) = uc_user_login($_SESSION['userid'],$_POST['password']);
							hasTitleLog("test 兑换积分请求", $us, "w+");
							$sql = "SELECT * FROM `centre_config` WHERE `code`='points_rule'";
							$sRes = $GLOBALS['db']->fetch_first($sql);
							$oPointsRule = uc_unserialize($sRes['value']);
							$oPointsRule = $oPointsRule[0];
							writeLog("unserialize序列化:");
							writeLog($oPointsRule);
							hasTitleLog("oPointsRule: uid->".$uid.", oPointsRule['creditsrc']->".$oPointsRule['creditsrc'].", oPointsRule['creditdesc']->".$oPointsRule['creditdesc'].", oPointsRule['appiddesc']->".$oPointsRule['appiddesc'].", shop_coin->".intval($us['shop_coin']));
							$res = uc_credit_exchange_request($uid,$oPointsRule['creditsrc'], $oPointsRule['creditdesc'],$oPointsRule['appiddesc'],intval($us['shop_coin']));
							hasTitleLog("积分兑换请求开始：", $res);
						}



					} else {
						$uid = -7;
					}
					if($uid <= 0) {
						if($uid == -1) {
							echo '用户名不合法';
						} elseif($uid == -2) {
							echo '包含要允许注册的词语';
						} elseif($uid == -3) {
							echo '用户名已经存在';
						} elseif($uid == -4) {
							echo 'Email 格式有误';
						} elseif($uid == -5) {
							echo 'Email 不允许注册';
						} elseif($uid == -6) {
							echo '该 Email 已经被注册';
						} else {
							echo '未定义';
						}

					} else {
						echo uc_user_synlogin($uid);

					}

				} elseif ($uid==-2) {
					//ucenter 登录密码错误
					echo "ucenter 登录密码错误";
					die;
				} else {
					//-3 ucenter 登 安全提问错误。
					echo "ucenter 登录密码错误";
					die;
				}
				writeLog("登录成功：".$uid.",".$username.",".$password.",".$email);
				writeLog("***********主站 login end**********");

				echo "<script language=javascript>window.location.href='member/main.php?lang=" . $_SESSION['language'] . "'</script>";
			} else {
				echo "<script language=javascript>alert('用户名或密码错误.');window.location.href='?'</script>";
			}
		} else {
			echo "<script language=javascript>alert('系统维护,暂时关闭,给您带来不便我们感到万分抱歉.');window.location.href='?'</script>";
		}
	} else {
		echo "<script language=javascript>alert('验证码错误.');window.location.href='?'</script>";
	}
} else {
	$_SESSION['ID'] = null;
	$_SESSION['nickname'] = null;
	$_SESSION['userid'] = null;
	$_SESSION['isboss'] = null;
	$_SESSION['pass2'] = null;
	$_SESSION['pass3'] = null;
	$_SESSION['bdname'] = null;
	$_SESSION['bdid'] = null;

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>登录</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="huo15doc/css/normalize.css">
	<link rel="stylesheet" href="huo15doc/css/main.css">
	<script src="huo15doc/js/vendor/modernizr-2.6.2.min.js"></script>
	<!-- Bootstrap -->
	<link href="huo15doc/static/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

	<style>
		/* Reset CSS */
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, font, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td {
			margin: 0;
			padding: 0;
			border: 0;
			outline: 0;
			font-size: 100%;
			vertical-align: baseline;
			background: transparent;
		}

		body {
			/*background: #DCDDDF url(http://cssdeck.com/uploads/media/items/7/7AF2Qzt.png);*/
			background: none;
			color: #000;
			font: 14px Arial;
			margin: 0 auto;
			padding: 0;
			position: relative;
		}

		h1 {
			font-size: 28px;
		}

		h2 {
			font-size: 26px;
		}

		h3 {
			font-size: 18px;
		}

		h4 {
			font-size: 16px;
		}

		h5 {
			font-size: 14px;
		}

		h6 {
			font-size: 12px;
		}

		h1, h2, h3, h4, h5, h6 {
			color: #563D64;
		}

		small {
			font-size: 10px;
		}

		b, strong {
			font-weight: bold;
		}

		a {
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}

		.left {
			float: left;
		}

		.right {
			float: right;
		}

		.alignleft {
			float: left;
			margin-right: 15px;
		}

		.alignright {
			float: right;
			margin-left: 15px;
		}

		.clearfix:after,
		form:after {
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}

		.container {
			margin: 25px auto;
			position: relative;
			width: 900px;
		}

		#content {
			background: #f9f9f9;
			opacity: 0.9;
			filter: alpha(opacity=90);
			background: -moz-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -webkit-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -o-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -ms-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8f8f8', endColorstr='#f9f9f9', GradientType=0);
			-webkit-box-shadow: 0 1px 0 #fff inset;
			-moz-box-shadow: 0 1px 0 #fff inset;
			-ms-box-shadow: 0 1px 0 #fff inset;
			-o-box-shadow: 0 1px 0 #fff inset;
			box-shadow: 0 1px 0 #fff inset;
			border: 1px solid #c4c6ca;
			margin: 0 auto;
			padding: 25px 0 0;
			position: relative;
			text-align: center;
			text-shadow: 0 1px 0 #fff;
			width: 400px;
		}

		#content h1 {
			color: #7E7E7E;
			font: bold 25px Helvetica, Arial, sans-serif;
			letter-spacing: -0.05em;
			line-height: 20px;
			margin: 10px 0 30px;
		}

		#content h1:before,
		#content h1:after {
			content: "";
			height: 1px;
			position: absolute;
			top: 10px;
			width: 27%;
		}

		#content h1:after {
			background: rgb(126, 126, 126);
			background: -moz-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -webkit-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -o-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -ms-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			right: 0;
		}

		#content h1:before {
			background: rgb(126, 126, 126);
			background: -moz-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -webkit-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -o-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: -ms-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			background: linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
			left: 0;
		}

		#content:after,
		#content:before {
			background: #f9f9f9;
			background: -moz-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -webkit-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -o-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: -ms-linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			background: linear-gradient(top, rgba(248, 248, 248, 1) 0%, rgba(249, 249, 249, 1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8f8f8', endColorstr='#f9f9f9', GradientType=0);
			border: 1px solid #c4c6ca;
			content: "";
			display: block;
			height: 100%;
			left: -1px;
			position: absolute;
			width: 100%;
		}

		#content:after {
			-webkit-transform: rotate(2deg);
			-moz-transform: rotate(2deg);
			-ms-transform: rotate(2deg);
			-o-transform: rotate(2deg);
			transform: rotate(2deg);
			top: 0;
			z-index: -1;
		}

		#content:before {
			-webkit-transform: rotate(-3deg);
			-moz-transform: rotate(-3deg);
			-ms-transform: rotate(-3deg);
			-o-transform: rotate(-3deg);
			transform: rotate(-3deg);
			top: 0;
			z-index: -2;
		}

		#content form {
			margin: 0 20px;
			position: relative
		}

		#content form input[type="text"],
		#content form input[type="password"] {
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-ms-border-radius: 3px;
			-o-border-radius: 3px;
			border-radius: 3px;
			-webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-webkit-transition: all 0.5s ease;
			-moz-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
			transition: all 0.5s ease;
			background: #eae7e7 url(http://cssdeck.com/uploads/media/items/8/8bcLQqF.png) 10px 5px no-repeat;
			border: 1px solid #c8c8c8;
			color: #777;
			font: 13px Helvetica, Arial, sans-serif;
			margin: 0 0 10px;
			padding: 15px 10px 15px 40px;
			width: 80%;
		}
		#content form input#code {
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-ms-border-radius: 3px;
			-o-border-radius: 3px;
			border-radius: 3px;
			-webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
			-webkit-transition: all 0.5s ease;
			-moz-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
			transition: all 0.5s ease;
			background: #eae7e7;
			border: 1px solid #c8c8c8;
			color: #777;
			font: 13px Helvetica, Arial, sans-serif;
			margin: 0 0 10px;
			padding: 15px 10px 15px 40px;
			width: 80%;
		}

		#content form input[type="text"]:focus,
		#content form input[type="password"]:focus {
			-webkit-box-shadow: 0 0 2px #ed1c24 inset;
			-moz-box-shadow: 0 0 2px #ed1c24 inset;
			-ms-box-shadow: 0 0 2px #ed1c24 inset;
			-o-box-shadow: 0 0 2px #ed1c24 inset;
			box-shadow: 0 0 2px #ed1c24 inset;
			background-color: #fff;
			border: 1px solid #ed1c24;
			outline: none;
		}

		#username {
			background-position: 10px 10px !important
		}

		#password {
			background-position: 10px -53px !important
		}

		#content form input[type="submit"] {
			background: rgb(254, 231, 154);
			background: -moz-linear-gradient(top, rgba(254, 231, 154, 1) 0%, rgba(254, 193, 81, 1) 100%);
			background: -webkit-linear-gradient(top, rgba(254, 231, 154, 1) 0%, rgba(254, 193, 81, 1) 100%);
			background: -o-linear-gradient(top, rgba(254, 231, 154, 1) 0%, rgba(254, 193, 81, 1) 100%);
			background: -ms-linear-gradient(top, rgba(254, 231, 154, 1) 0%, rgba(254, 193, 81, 1) 100%);
			background: linear-gradient(top, rgba(254, 231, 154, 1) 0%, rgba(254, 193, 81, 1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fee79a', endColorstr='#fec151', GradientType=0);
			-webkit-border-radius: 30px;
			-moz-border-radius: 30px;
			-ms-border-radius: 30px;
			-o-border-radius: 30px;
			border-radius: 30px;
			-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8) inset;
			-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8) inset;
			-ms-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8) inset;
			-o-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8) inset;
			box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8) inset;
			border: 1px solid #D69E31;
			color: #85592e;
			cursor: pointer;
			float: left;
			font: bold 15px Helvetica, Arial, sans-serif;
			height: 35px;
			margin: 20px 0 35px 15px;
			position: relative;
			text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
			width: 120px;
		}

		#content form input[type="submit"]:hover {
			background: rgb(254, 193, 81);
			background: -moz-linear-gradient(top, rgba(254, 193, 81, 1) 0%, rgba(254, 231, 154, 1) 100%);
			background: -webkit-linear-gradient(top, rgba(254, 193, 81, 1) 0%, rgba(254, 231, 154, 1) 100%);
			background: -o-linear-gradient(top, rgba(254, 193, 81, 1) 0%, rgba(254, 231, 154, 1) 100%);
			background: -ms-linear-gradient(top, rgba(254, 193, 81, 1) 0%, rgba(254, 231, 154, 1) 100%);
			background: linear-gradient(top, rgba(254, 193, 81, 1) 0%, rgba(254, 231, 154, 1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fec151', endColorstr='#fee79a', GradientType=0);
		}

		#content form div a {
			color: #004a80;
			float: right;
			font-size: 12px;
			margin: 30px 15px 0 0;
			text-decoration: underline;
		}

		.button {
			background: rgb(247, 249, 250);
			background: -moz-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
			background: -webkit-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
			background: -o-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
			background: -ms-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
			background: linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7f9fa', endColorstr='#f0f0f0', GradientType=0);
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
			-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
			-ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
			-o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
			-webkit-border-radius: 0 0 5px 5px;
			-moz-border-radius: 0 0 5px 5px;
			-o-border-radius: 0 0 5px 5px;
			-ms-border-radius: 0 0 5px 5px;
			border-radius: 0 0 5px 5px;
			border-top: 1px solid #CFD5D9;
			padding: 15px 0;
		}

		.button a {
			background: url(http://cssdeck.com/uploads/media/items/8/8bcLQqF.png) 0 -112px no-repeat;
			color: #7E7E7E;
			font-size: 17px;
			padding: 2px 0 2px 40px;
			text-decoration: none;
			-webkit-transition: all 0.3s ease;
			-moz-transition: all 0.3s ease;
			-ms-transition: all 0.3s ease;
			-o-transition: all 0.3s ease;
			transition: all 0.3s ease;
		}

		.button a:hover {
			background-position: 0 -135px;
			color: #00aeef;
		}

		.other {
			height: 300px;
			color: #FFF;
		}

		.other div {
			position: absolute;
			bottom: 0;
			width: 100%;
			background: #000;
			background: rgba(0, 0, 0, 0.7);
		}

		.other div p {
			padding: 10px;
		}
		.logo {
			margin-bottom:30px;
		}
	</style>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
	improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->

<!--内容区域-->
<div class="container">

	<section id="content">

		<form name=form1 action="index.php?lang=1 " method="post" onSubmit="return CheckForm();">

			<h1><a href="/login">登录</a></h1>
			<div class="logo">
				<img src="images/headLogo.png" alt="" width="300">
			</div>
			<INPUT type=hidden value=loginnow name=loginnow>

			<input type="text" name="NickName" placeholder="会员编号/手机号" id="NickName" value="" required="required">

			<input type="password" name="password" id="password" placeholder="密码" required="required">

			<div>
				<input style="width:225px;" name="code" id="code" type="text" placeholder="验证码">
				<img id="code" src="code.php" style="cursor: pointer; vertical-align:middle;"  onClick="this.src='code.php?rndcode=' +Math.random();"/>
			</div>

			<div style="width: 100%;padding-left: 10%;">
				<!--<input type="checkbox" id="remember_me" name="_remember_me" value="on">-->
				<!--<label for="remember_me">自动登录</label>-->

				<input  type="submit" id="btnLogin" name="btnLogin" value="登录">
			</div>
			<div class="clearfix" style="height: 30px;"></div>

		</form>
		<div class="button">
			<a href="#">注册</a>
		</div>
	</section>
</div>
<!--内容区域 end -->


<link rel="stylesheet" href="huo15doc/static/css/common.css">
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>-->
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="huo15doc/static/js/jquery-3.1.0.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="huo15doc/static/js/bootstrap.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
<script src="huo15doc/js/plugins.js"></script>
<script src="huo15doc/js/main.js"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<!--login-->
<script src="huo15doc/js/jquery.backstretch.js"></script>
<script>
	$(function () {
		$(".container").css({
			opacity: .8,//设置透明度

		});
		//$.backstretch(["huo15doc/img/bg/3.jpg"]); //背景
		$("body").backstretch(["huo15doc/img/bg/1.jpg", "huo15doc/img/bg/2.jpg", "huo15doc/img/bg/3.jpg"], {duration: 4000}); //元素背景，切换现实
	});
	function CheckForm() {
		NickName = document.form1.NickName.value;
		password = document.form1.password.value;
		if (NickName.length == 0) {
			alert("请输入用户名.");
			document.form1.NickName.focus();
			return false;
		}
		if (password.length == 0) {
			alert("请输入密码.");
			document.form1.password.focus();
			return false;
		}
	}
</script>

</body>
</html>
