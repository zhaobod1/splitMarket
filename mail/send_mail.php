<?php
 require_once("class.phpmailer.php");
 $name=$_POST["name"]; 
 $pw=$_POST["pw"];
 $address=$_POST["address"];
 
$subject="恭喜您，".$name."你在我网注册成功";
$replyto="liushahdj@163.com";
$mail = new PHPMailer();     //得到一个PHPMailer实例

$mail->CharSet = "utf-8"; //设置采用gb2312中文编码
$mail->IsSMTP();                    //设置采用SMTP方式发送邮件
$mail->Host = "smtp.qq.com";    //设置邮件服务器的地址
$mail->Port = 25;                           //设置邮件服务器的端口，默认为25

$mail->From     = "jyling77@qq.com"; //设置发件人的邮箱地址
$mail->FromName = "ling";                       //设置发件人的姓名
$mail->SMTPAuth = true;                                    //设置SMTP是否需要密码验证，true表示需要

$mail->Username="jyling77@qq.com";

$mail->Password = "linglovesu";
$mail->Subject = $subject;                         //设置邮件的标题

$mail->AltBody = "text/html";                                // optional, comment out and test


$mail->Body = "您的用户名为：".$name."您的密码为：".$pw;                    

$mail->IsHTML(true);                                        //设置内容是否为html类型
//$mail->WordWrap = 50;                                 //设置每行的字符数
$mail->AddReplyTo(" $replyto","");     //设置回复的收件人的地址


$mail->AddAddress(" $address","");     //设置收件的地址


	if(!$mail->Send()) {                    //发送邮件
	echo "发送失败了！";
	} else {
	echo "您的注册信息以发往您注册邮箱，请注意查收！";
	}



?>