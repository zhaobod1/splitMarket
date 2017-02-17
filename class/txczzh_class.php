<?php
include_once("../function.php");
class txczzh_class{
	function gettxbyuidisgrant($_uid,$_isgrant){
		$sql="SELECT sum(jine) FROM `tixian` WHERE uid=".$_uid." and isgrant=".$_isgrant."";
		if($query=mysql_query($sql)){
			$sumjine=mysql_fetch_array($query);
			if ($sumjine[0]==""){
				return 0;
			}else{
				return $sumjine[0];
			}
		}
	}
	
	function getczbyuidisgrant($_uid,$_isgrant){
		$sql="SELECT sum(jine) FROM `chongzhi` WHERE uid=".$_uid." and isgrant=".$_isgrant."";
		if($query=mysql_query($sql)){
			$sumjine=mysql_fetch_array($query);
			if ($sumjine[0]==""){
				return 0;
			}else{
				return $sumjine[0];
			}
		}
	}
	
	function getzzbyuid($_uid){
		$sql="SELECT sum(jine) FROM `zhuanzhang` WHERE uid=".$_uid."";
		if($query=mysql_query($sql)){
			$sumjine=mysql_fetch_array($query);
			if ($sumjine[0]==""){
				return 0;
			}else{
				return $sumjine[0];
			}
		}
	}
	
	function getzzbysid($_sid){
		$sql="SELECT sum(jine) FROM `zhuanzhang` WHERE sid=".$_sid."";
		if($query=mysql_query($sql)){
			$sumjine=mysql_fetch_array($query);
			if ($sumjine[0]==""){
				return 0;
			}else{
				return $sumjine[0];
			}
		}
	}
	
	function getbonustop50(){
		$array[50];
		$i=0;
		$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid where b.b0>0 order by b.bdate desc limit 50";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$nickname = $row['nickname'];
				$array[$i]=$nickname." 奖金:".$row['b0'];
				$i++;
			}
		}
		return $array;
	}
	
	function gettixiantop50(){
		$array[50];
		$i=0;
		$sql = "SELECT * FROM `tixian` order by tdate desc limit 50";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$nickname = $row['nickname'];
				$zt="未发放";
				if ($row['isgrant']==1){ $zt="已发放";}
				$array[$i]=$nickname." 提现金额:".$row['jine']." 状态:".$zt;
				$i++;
			}
		}
		return $array;
	}
	
	function getnewstopnum($num){
		$array[$num];
		$i=0;
		$sql = "SELECT * FROM `news` where isedit=1 order by newstime desc limit ".$num."";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$array[$i]=$row;
				$i++;
			}
		}
		return $array;	
	}
	
	function getgoodstopnum($num){
		$array[$num];
		$i=0;
		$sql = "SELECT * FROM `goods` where isdisplay=1 order by id desc limit ".$num."";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$array[$i]=$row;
				$i++;
			}
		}
		return $array;	
	}
	
}
?>