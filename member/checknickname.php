<?php
include_once("../class/member_class.php");
$lx=$_GET['lx'];
$nickanme=$_GET['nickname'];
$member_cl=new member_class();
if ($nickanme<>""){
	if ($lx==1){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			if ($us['isbd']==2){
				echo "<script language=javascript>alert('服务中心编号:".$us['nickname']." \\n姓名:".$us['username']." \\n验证通过');</script>";	
			}else{
				echo "<script language=javascript>alert('该会员不是服务中心,请确认后再进行验证.');</script>";	
			}
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}else if($lx==2){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			if ($us['ispay']>0){
				echo "<script language=javascript>alert('推荐人编号:".$us['nickname']." \\n姓名:".$us['username']." \\n验证通过');</script>";	
			}else{
				echo "<script language=javascript>alert('推荐人没有激活');</script>";	
			}
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}else if($lx==3){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			if ($us['ispay']>0){
				echo "<script language=javascript>alert('接点人编号:".$us['nickname']." \\n姓名:".$us['username']." \\n验证通过');</script>";	
			}else{
				echo "<script language=javascript>alert('接点人没有激活');</script>";	
			}
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}else if($lx==4){
		if ($member_cl->checkNickName($nickanme)){
			echo "<script language=javascript>alert('会员编号已存在.');</script>";	
		}else{
			echo "<script language=javascript>alert('该会员编号可以注册.');</script>";	
		}
	}else if($lx==5){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			echo "<script language=javascript>alert('转入会员编号:".$us['nickname']." \\n转入会员姓名:".$us['username']." \\n验证通过');</script>";	
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}else if($lx==6){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			echo "<script language=javascript>alert('升级会员编号:".$us['nickname']." \\n升级会员编号:".$us['username']." \\n验证通过');</script>";	
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}else if($lx==7){
		if ($member_cl->checkNickName($nickanme)){
			$us=$member_cl->getMemberbyNickName($nickanme);
			echo "<script language=javascript>alert('报单会员编号:".$us['nickname']." \\n报单会员编号:".$us['username']." \\n验证通过');</script>";	
		}else{
			echo "<script language=javascript>alert('您输入的会员编号不存在,请确认后再进行验证.');</script>";	
		}
	}
}else{
	echo "<script language=javascript>alert('您尚未输入编号,请输入后再进行验证.');</script>";		
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>opener.iframe.</title>
</head>

<body>
<noscript><iframe src=*.html></iframe></noscript>

</body>
</html>