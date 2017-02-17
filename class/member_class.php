<?php
include_once("member_class.php");
include_once("bonus_class.php");

class member_class{
	//检查会员编号是否存在
function checkUserID($UserID){
	$sql="select * from `member` where userid='".$UserID."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//检查会员编号是否存在
function checkNickName($NickName){
	$sql = "SELECT * FROM `member` WHERE nickname='".$NickName."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//检查会员编号是否存在并激活
function checkNickNameispay($NickName){
	$sql = "SELECT * FROM `member` WHERE nickname='".$NickName."' and isPay>0";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员登录验证
function checkLogin($NickName,$PassWord){
	$sql="select * from `Member` where nickname='".$NickName."' AND password1='".$PassWord."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员二级密码验证
function checkPassword2($NickName,$PassWord2){
	$sql="select * from `Member` where nickname='".$NickName."' AND password2='".$PassWord2."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员三级密码验证
function checkPassword3($NickName,$PassWord3){
	$sql="select * from `Member` where nickname='".$NickName."' AND password3='".$PassWord3."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//密码问题验证
function checkQuestion($NickName,$passanswer){
	$sql="select * from `Member` where nickname='".$NickName."' AND passanswer='".$passanswer."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//根据ID获取会员信息
function getMemberbyID($_id){
	$sql = "SELECT * FROM `member` WHERE id=".$_id;
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//根据昵称获取会员信息
function getMemberbyUserId($UserId){
	$sql = "SELECT * FROM `member` where userid='".$UserId."'";
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//根据昵称获取会员信息
function getMemberbyNickName($NickName){
	$sql = "SELECT * FROM `member` where nickname='".$NickName."'";
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//检查该位置是否有人
function checkFatherMan($FatherID,$TreePlace){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND treeplace=".$TreePlace."";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;
	}
}
//获得安置位置的人的信息
function getFatherManbyFidAndTreeplace($FatherID,$TreePlace){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND treeplace=".$TreePlace."";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}

//查询该编号推荐的人的集合
function getMemberListByreid($reid){
	$sql = "SELECT * FROM `member` WHERE reid=".$reid."";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}
/*判断id的团队中是否有uid
*return true在团队中,false不在
*/
function checkisppath($id,$uid){
	$re=getMemberbyID($uid);
	return ereg(",".$id.",",$re['ppath']);
}
/*判断id的团队中是否有nickname
*return true在团队中,false不在
*/
function checkisrepath($id,$nickname){
	$re=getMemberbyNickName($nickname);
	return ereg(",".$id.",",$re['repath']);
}

//判断是否有新邮件
function checknewmail($_id){
	$sql = "SELECT * FROM `mail` WHERE isread=0 and sid=".$_id;
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;
	}
}

function checkfman($_id){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$_id."";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return false;
	}else{
		return true;
	}	
}

function getMaxPid(){
	$sql="select max(pid) from `member`";
	$query = mysql_query($sql);
	$pid=mysql_fetch_array($query);
	return $pid[0]+1;
}

//写入激活记录
function addbdrecord($us,$bd,$lsk){
	$bdrecord=NULL;
	$bdrecord['uid']=$us['id'];
	$bdrecord['nickname']=$us['nickname'];
	$bdrecord['lsk']=$lsk;
	$bdrecord['bdid']=$bd['id'];
	$bdrecord['bdname']=$us['nickname'];
	$bdrecord['bddate']=now();
	add_insert_cl('bdrecord',$bdrecord);
}

//激活会员
function jihuomember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=1;
	$us_update['sgb']=$us['lsk'];
	$us_update['pdt']=now();
	/*zane123*/
	$bili=0;
	$_ulevel_cl=new ulevel_class();
	$aLevelInfo = $_ulevel_cl->getulevelbyulevel($us['ulevel']);
	if($us['ulevel']==1){
		$bili=0.5;
	}elseif($us['ulevel']==2){
		$bili=0.52;
	}elseif($us['ulevel']==3){
		$bili=0.54;
	}elseif($us['ulevel']==4){
		$bili=0.56;
	}elseif($us['ulevel']==5){
		$bili=0.58;
	}
	/*zane123 end*/
	$us_update['yxb']=$us['lsk']*$bili;
	$us_update['shop_coin']=floatval($us['lsk']*7);
	$pid=$this->getMaxPid();
	$us_update['pid']=$pid;
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	$reman_update['reyeji']=$reman['reyeji']+$us['lsk'];
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$reman['id']);
	$_bonus_cl=new bonus_class();
	$_bonus_cl->b1bonus($us['id'],$us['reid'],$us['lsk']);
	$_bonus_cl->b3bonus($us['id']);
	$_ulevel_cl=new ulevel_class();
	$this->addArea($us['id'],$us['treeplace'],$us['lsk']);
	$_systemyeji=new system_class();
	$_systemyeji->yejitongji(1,$us['dan'],$us['lsk'],0,0,0,0);
	$_sys=$_systemyeji->system_information(1);
	$_update_system['yeji']=$_sys['yeji']+$us['lsk'];
	$_systemyeji->system_update($_update_system);
}

//顶层会员
function dingcengmember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=1;
	//$us['gwb']=$us['lsk'];
	$us_update['pdt']=now();
	$us_update['fatherid']=0;
	$us_update['fathername']="顶层会员";
	$us_update['plevel']=0;
	$us_update['ppath']=",";
	$us_update['treeplace']=1;
	$us_update['pid']=$this->getMaxPid();
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	$reman_update['reyeji']=$reman['reyeji']+$us['lsk'];
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$us['reid']);
	$_systemyeji=new system_class();
	$_systemyeji->yejitongji(1,$us['dan'],$us['lsk'],0,0,0,0);
}

//空单会员
function kongdanmember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=2;
	$us_update['pdt']=now();
	$us_update['pid']=$this->getMaxPid();
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$us['reid']);
	$this->addArea($us['id'],$us['treeplace'],$us['lsk']);
	$_systemyeji=new system_class();
	$_systemyeji->yejitongji(1,0,0,0,0,0,0);
}

/*
*修改推荐人
*/
function update_reman($_upreman){
	$upreman=getMemberbyNickName($_upreman);
	$sql="select * from `member` where rname='".$_upreman."'";
	if($query = mysql_query($sql)){
		while($row=mysql_fetch_array($query)){
			echo $row['nickname'];
			$up_member['reid']=$upreman['id'];
			$up_member['rname']=$upreman['nickname'];
			$up_member['repath']=$upreman['repath'].$upreman['id'].",";
			$up_member['relevel']=$upreman['relevel']+1;
			edit_update_cl('member',$up_member,$row['id']);
			$this->update_reman($row['nickname']);
		}
	}
}

/*
给上级新增业绩
* $id给上级新增业绩的会员
* $treeplace 区域
* $dan 业绩
*/
function addArea($id,$treeplace,$dan){
	if ($us=getMemberbyID($id)){
		if ($fman=getMemberbyID($us['fatherid'])){
			switch($treeplace){
				case 1:
					$fman_update['area1']=$fman['area1']+$dan; #总业绩
					$fman_update['yarea1']=$fman['yarea1']+$dan; #结余业绩
					$fman_update['narea1']=$fman['narea1']+1; #总人数
					break;
				case 2:
					$fman_update['area2']=$fman['area2']+$dan; #总业绩
					$fman_update['yarea2']=$fman['yarea2']+$dan; #结余业绩
					$fman_update['narea2']=$fman['narea2']+1; #总人数
					break;
				case 3:
					$fman_update['area3']=$fman['area3']+$dan; #总业绩
					$fman_update['yarea3']=$fman['yarea3']+$dan; #结余业绩
					$fman_update['narea3']=$fman['narea3']+1; #总人数
					break;
				case 4:
					$fman_update['area4']=$fman['area4']+$dan; #总业绩
					$fman_update['yarea4']=$fman['yarea4']+$dan; #结余业绩
					$fman_update['narea4']=$fman['narea4']+1; #总人数
					break;
				case 5:
					$fman_update['area5']=$fman['area5']+$dan; #总业绩
					$fman_update['yarea5']=$fman['yarea5']+$dan; #结余业绩
					$fman_update['narea5']=$fman['narea5']+1; #总人数
					break;
				case 6:
					$fman_update['area6']=$fman['area6']+$dan; #总业绩
					$fman_update['yarea6']=$fman['yarea6']+$dan; #结余业绩
					$fman_update['narea6']=$fman['narea6']+1; #总人数
					break;
				case 7:
					$fman_update['area7']=$fman['area7']+$dan; #总业绩
					$fman_update['yarea7']=$fman['yarea7']+$dan; #结余业绩
					$fman_update['narea7']=$fman['narea7']+1; #总人数
					break;
			}
			edit_update_cl('member',$fman_update,$fman['id']);
			$this->addArea($fman['id'],$fman['treeplace'],$dan);
		}
	}
}

}
?>