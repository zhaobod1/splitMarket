<?php
include("conn.php");
include_once "include/initMysql.php";







function dd($arr,$useDie=true) {
	var_dump($arr);
	if ($useDie) {
		die;
	}
}

/**
 * 检测手机号是否已经存在，存在返回 TRUE，不存在返回 FALSE。
 * @param string $mobile
 * @param integer $userId
 * @return bool
 */
function checkMobileIsExisted($mobile, $userId) {
	global $ecs_db;
	$sql = "select count(*) from member WHERE usertel='".$mobile."' and userid=" . $userId;
	$res = $ecs_db->getOne($sql);
	if ($res) {
		return false; //自己的手机存在相当于不存在。
	} else {
		$sql = "select count(*) from member WHERE usertel='".$mobile."' and userid <> " . $userId;
		$res = $ecs_db->getOne($sql);
		if ($res) {
			return true;
		} else {
			return false;
		}

	}

}

//获取当前时间
function now(){
	date_default_timezone_set('PRC');
	return date('Y-m-d H:i:s',time());
}


if (!function_exists('writeLog')) {

	function writeLog($msg, $style="a+")
	{

		$f = fopen("./api/log.txt", $style);
		fwrite($f, "\n");
		if (is_array($msg)) {
			//fwrite($f,  implode(",", $msg));
			fwrite($f,  json_encode($msg));
		} elseif (is_object($msg)) {
			fwrite($f,  json_encode($msg));
		} elseif ($msg =='') {
			fwrite($f,  "__________空值__________");
		} else {
			fwrite($f,  $msg);
		}
		fwrite($f, "\n");
		fclose($f);
	}
	function hasTitleLog($title, $msg, $style="a+") {

		$f = fopen("./api/log.txt", $style);
		fwrite($f,  "\n********** ".$title." **********\n");
		fclose($f);
		writeLog($msg);
		$f = fopen("./api/log.txt");
		fwrite($f,  "\n********** ".$title." end **********\n");
		fclose($f);
	}
}


function systemstatus(){
	$sql="SELECT xtkg FROM `systemparameters` where id=1";	
	$query=mysql_query($sql);
	$row=mysql_fetch_row($query);
	if ($row[0]==1){
		return true;
	}else{
		return false;	
	}
}

//消息框函数
function alert($msg,$url=""){ 
$str = "<script type='text/javascript'>"; 
$str.="alert('".$msg."');"; 
if ($url != "") 
{ 
$str.="window.location.href='{$url}';"; 
} 
else 
{ 
$str.="window.history.back();"; 
} 
echo $str.='</script>'; 
}

function getProvincebyid($pid){
	$where="where provinceid=".$pid;
	$province=que_select_cl_where('province',$where);
	return $province['province'];
}

function getCitybyid($cid){
	$where="where cityid=".$cid;
	$city=que_select_cl_where('city',$where);
	return $city['city'];
}

/*
树状图输出逻辑
@reid 推荐人
return 输出格式
*/
function tree($id){
	$shuchu = "<ul>";
	$sql = "SELECT * FROM `member` WHERE reid=".$id."";
	$query = mysql_query($sql);
	if (mysql_num_rows($query)>0){
		while($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
			$shuchu.="<li>".$row['nickname']."[".$ul['lvname']."]";
			$shuchu.=tree($row['id']);
			$shuchu.="</li>";
		}
		$shuchu .= "</ul>";
	}else{
		$shuchu="";
	}
	return $shuchu;
}

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

//检查会员编号是否激活
function checkNickNamebyispay($NickName){
	$sql = "SELECT * FROM `member` WHERE nickname='".$NickName."' and ispay>0";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}

//会员登录验证
function checkLogin($NickName,$PassWord){
	$sql="select * from `member` where nickname='".$NickName."' AND password1='".$PassWord."'";
	$query=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($query) >= 1){

		return true;
	}else{

		return false;	
	}
}
//会员二级密码验证
function checkPassword2($NickName,$PassWord2){
	$sql="select * from `member` where nickname='".$NickName."' AND password2='".$PassWord2."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员三级密码验证
function checkPassword3($NickName,$PassWord3){
	$sql="select * from `member` where nickname='".$NickName."' AND password3='".$PassWord3."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//密码问题验证
function checkQuestion($NickName,$passanswer){
	$sql="select * from `member` where nickname='".$NickName."' AND passanswer='".$passanswer."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//根据ID获取会员信息
function getmemberbyID($_id){
	$sql = "SELECT * FROM `member` WHERE id=".$_id;
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//根据昵称获取会员信息
function getmemberbyNickName($NickName){
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
	if ($query = mysql_query($sql)){
		return mysql_fetch_array($query);
	}else{
		return "";	
	}
}

//查询该编号推荐的人的集合
function getmemberListByreid($reid){
	$sql = "SELECT * FROM `member` WHERE reid=".$reid."";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}
/*判断id的团队中是否有uid
*return true在团队中,false不在
*/
function checkisppath($id,$uid){
	$re=getmemberbyID($uid);
	return preg_match(",".$id.",",$re['ppath']);
}
/*判断id的团队中是否有nickname
*return true在团队中,false不在
*/
function checkisrepath($id,$nickname){
	$re=getmemberbyNickName($nickname);
	return preg_match(",".$id.",",$re['repath']);
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

/*
*单条数据查询实例
*$table=表名
*$编号
*/
function que_select_cl($talbe,$id){
	$sql="select * from ".$talbe." where id=".$id."";
	if ($query=mysql_query($sql)){
		return mysql_fetch_array($query);
	}
}

/*
*单条数条件据查询实例
*$table=表名
*$条件
*/
function que_select_cl_where($talbe,$where){
	$sql="select * from ".$talbe." ".$where."";
	if ($query=mysql_query($sql)){
		return mysql_fetch_array($query);
	}
}

/*
*插入实例
*$table=表名
*$err=数组
*/
function add_insert_cl($table,$err){     
	$sql = "INSERT INTO ".$table." (";    
	foreach ( $err as $key => $value  ){    
		$sql .= $key.", ";     
	}      
	$sql = substr($sql, 0, strlen($sql)-2) .  ") VALUES (";    
	foreach ( $err as $key => $value  ){
		//$value = fixEncoding($value);
		//echo $value,":",mb_detect_encoding($value),"<br/>";
		$sql .= "'".$value."', ";     
	}      
	$sql = substr($sql, 0, strlen($sql)-2) .  ")";
	global $ecs_db;
	$res = $ecs_db->query($sql);
	if (!$res) {
		die (mysql_error());
	}
	//@mysql_query($sql) or die (mysql_error());
}
// Fixes the encoding to uf8

function fixEncoding($in_str)

{

	$cur_encoding = mb_detect_encoding($in_str) ;

	if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8"))

		return $in_str;

	else

		return utf8_encode($in_str);

}

function h15_update_member($table, $arr, $id) {

	$sql = "UPDATE ".$table." SET ";
	if (is_array($arr)) {
		foreach ($arr as $key => $value) {
			if (preg_match("/[0-9a-zA-Z]+/", $value)) {
				$sql .= $key."='".$value."', ";
			} else {
				echo "<script language=javascript>alert('密码只能包含数字和字母.');window.location.href='?'</script>";
			}
		}
		$sql = substr($sql, 0, strlen($sql)-2) .  " WHERE id=".$id;
		global $ecs_db;
		$res = $ecs_db->query($sql);
		if (!$res) {
			echo "<script language=javascript>alert('请从新输入密码." . $ecs_db->error() . "');window.location.href='?'</script>";
		} else {
			return true;
		}

	} else {
		echo "<script language=javascript>alert('请从新输入密码.(is not array.)');window.location.href='?'</script>";

	}
}
/*
*修改实例
*$table=表名
*$err=数组
*$id=编号
*/
function edit_update_cl($table,$err,$id){
	$sql = "UPDATE ".$table." SET ";
	foreach ( $err as $key => $value  ){
		if(preg_match("/^[\d]*$/",$key)){
			#过滤数字
		}else{
			$sql .= $key."='".$value."', ";	
		}
	}      
	$sql = substr($sql, 0, strlen($sql)-2) .  " WHERE id=".$id;


	@mysql_query($sql) or die (mysql_error());
}

/*根据编号删除表数据
$table表名
$id 编号
*/
function edit_delete_cl($table,$id){
	$sql = "DELETE FROM ".$table." WHERE id=".$id; 
	@mysql_query($sql) or die (mysql_error());
}

function edit_delete_all($table){
	$sql = "DELETE FROM ".$table;
	@mysql_query($sql) or die (mysql_error());
}

function edit_sql($sql){
	@mysql_query($sql) or die (mysql_error());	
}
/*
*@ulevel 等级数字
return 文字级别
*/
function ulevel($ulevel){
	$ul="";
	$ul=que_select_cl('ulevel',$ulevel);
	return $ul;	
}

/*
t=时间
p=价格
n=数量
*/
function addgupiaolist($t,$p,$n){
	$system_cl=new system_class();
	$sys=$system_cl->system_information(1);
	$sql="select * from `stockprice` where year(sdate)=".date("Y",$t)." and month(sdate)=".date("m",$t)." and day(sdate)=".date("d",$t)." ";
	if ($query=mysql_query($sql)){
		if(mysql_num_rows($query)>0){
			while($row=mysql_fetch_array($query)){
				$stockprice=NULL;
				$stockprice['price']=$sys['peprice'];//当时价格
				$stockprice['num']=$row['num']+$n;
				edit_update_cl("stockprice",$stockprice,$row['id']);
			}
		}else{
			$stockprice=NULL;
			$stockprice['price']=$sys['peprice'];
			$stockprice['num']=$n;
			$stockprice['sdate']=date("Y-m-d H:i:s" ,$t);
			add_insert_cl("stockprice",$stockprice);
		}
	}
	edit_sql("update `systemparameters` set petcount=petcount+".$n.",petallcount=petallcount+".$n."");
	$sys=$system_cl->system_information(1);
	$petcount=$sys['petcount'];
	while ($petcount>=1000000){
		edit_sql("update `systemparameters` set peprice=peprice+0.01,petcount=petcount-1000000");
		$petcount=$petcount-1000000;	
	}
}

/*分页处理
@ $p当前页数
@ $total总页数
@ $sum条目总数
@ $pagesize每页显示条数
return 分页文字信息
*/
function fenye($p,$pagesize,$sum,$total,$cx){
	#前5页
	$top5="<a href='?page=1".$cx."' style='text-decoration:none' title='到第1页'><<</a>&nbsp;&nbsp;";
	for($i = $p-4; $i < $p; $i++) {
		if($i>=1){
			$top5=$top5."<a href='?page=".$i."".$cx."' style='text-decoration:none' title='到第".$i."页'>".$i."</a>&nbsp;&nbsp;";
		}
	}
	$desc5="";
	for($i = $p+1; $i <= $p+4; $i++) {
		if($i<=$total){
			$desc5=$desc5."<a href='?page=".$i."".$cx."' style='text-decoration:none' title='到第".$i."页'>".$i."</a>&nbsp;&nbsp;";
		}
	}
	$desc5=$desc5."<a href='?page=".$total."".$cx."' style='text-decoration:none' title='到第".$total."页'>>></a>&nbsp;&nbsp;";
	$dianji=$top5.$p."&nbsp;&nbsp;".$desc5;
	$shuchu="每页".$pagesize."条,总共".$sum."条,当前显示第".$p."页,总共".$total."页\n\n";
	if($p > 1) //当前页不是第一页时，输出上一页的链接 
	{ 
		$prev = $p - 1; 
		$shuchu .= "<a href='?page=".$prev."".$cx."' style='text-decoration:none'>上一页</a>\n\n"; 
	}
	if($p < $total) //当前页不是最后一页时，输出下一页的链接 
	{ 
		$next = $p + 1; 
		$shuchu .= "<a href='?page=".$next."".$cx."' style='text-decoration:none'>下一页</a>"; 
	}
	return $dianji.$shuchu;
}



?>