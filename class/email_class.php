<?php
require("../PHPMailer/class.phpmailer.php");
include_once("../function.php");
class email_class{

function getemail(){
	$sql="select * from `email` where id=1";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}
function update_email($email){
	edit_update_cl('email',$email,1);
}
function sendemail($addressee,$nickname,$title,$content){
	$_email=$this->getemail();
	$mail = new PHPMailer(); //建立邮件发送类
	$mail->IsSMTP(); // 使用SMTP方式发送
	$mail->Host = $_email['emailsmtp']; // 您的企业邮局域名
	$mail->SMTPAuth = true; // 启用SMTP验证功能
	$mail->Username = $_email['emailuser']; // 邮局用户名(请填写完整的email地址)
	$mail->Password = $_email['emailpass']; // 邮局密码
	$mail->Port=25;
	$mail->From = $_email['emailuser']; //邮件发送者email地址
	$mail->FromName = $_email['emailname'];
	$mail->AddAddress($addressee, $nickname);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
	$mail->Subject = $title; //邮件标题
	$mail->Body = $content; //邮件内容
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
	if(!$mail->Send())
	{
		//echo "邮件发送失败. <p>";
		//echo "错误原因: " . $mail->ErrorInfo;
		//exit;
	}
		//echo "邮件发送成功";
	}
}
?>