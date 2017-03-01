<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/3/1
 * Time: 下午12:30
 */

if (!defined('IN_HUO15'))
{
	die('Hacking attempt');
}


class Sms {
	private $key = "15yj1xdaxt0vrcbjrhi5zhwagc36yw";
	private $url = "http://www.mfcall.com/api.php";
	private $sendUrl = '';

	public $content;//【中豪国际】编号#，您的操作已经生效，请登录中豪国际官网查看。
	public $mobile;

	function __construct($mobile,$content="")
	{
		$this->mobile = $mobile;
		$this->content = trim("【中豪国际】编号".$content."，您的操作已经生效，请登录中豪国际官网查看。");
		$this->sendUrl = $this->url . "?mobile=" . $this->mobile . "&content=" . urlencode($this->content) . "&key=" . $this->key;
	}

	function sendSms() {
		$res =  $this->curlHttpGet();
		return json_decode($res);
	}

	public function curlHttpGet()
	{
		$url = trim($this->sendUrl);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //执行后不打印出来。
		curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);

		//设置https
		date_default_timezone_set('PRC'); //使用cookies时，必须设置时区
		$output = curl_exec($ch);
		if ($output == false) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $output;
	}
	public function curlHttpsGet($url)
	{
		$url = trim($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);

		//设置https
		date_default_timezone_set('PRC'); //使用cookies时，必须设置时区
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //终止从服务器端进行验证
		$output = curl_exec($ch);
		if ($output == false) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $output;
	}


}