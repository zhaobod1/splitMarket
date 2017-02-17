<?php
include_once("../function.php");
class system_class{
	function system_information($_id){
		return que_select_cl('systemparameters',$_id);
	}
	function system_update($_system){
		edit_update_cl('systemparameters',$_system,1);
	}
	
	function system_wlt(){
		$sys=que_select_cl('systemparameters',1);
		return $sys['azkg'];
	}
	
	function system_tjt(){
		$sys=que_select_cl('systemparameters',1);
		return $sys['tjkg'];
	}
	
	function system_bdbonus(){
		$sys=que_select_cl('systemparameters',1);
		return $sys['bdbonus'];
	}
	
	function system_right(){
		$_y=date("Y");
		$_m=date("m");
		$_d=date("d");
		$sql="SELECT * FROM `member` where ispay>0 and year(pdt)=".$_y." and month(pdt)=".$_m." and day(pdt)=".$_d."";
		$_xyejiday=0;
		if ($query=mysql_query($sql)){
			$_xhyday=mysql_num_rows($query);
			while($row=mysql_fetch_array($query)){
				$_xyejiday=$_xyejiday+$row['lsk'];
			}	
		}else{
			$_xhyday=0;
		}
		
		$sql="SELECT * FROM `member` where ispay>0 and year(pdt)=".$_y." and month(pdt)=".$_m."";
		$_xyejimonth=0;
		if ($query=mysql_query($sql)){
			$_xhymonth=mysql_num_rows($query);
			while($row=mysql_fetch_array($query)){
				$_xyejimonth=$_xyejimonth+$row['lsk'];
			}	
		}else{
			$_xhymonth=0;
		}
		
		$sql="SELECT * FROM `member` where ispay>0 and year(pdt)=".$_y."";
		$_xyejiyear=0;
		if ($query=mysql_query($sql)){
			$_xhyyear=mysql_num_rows($query);
			while($row=mysql_fetch_array($query)){
				$_xyejiyear=$_xyejiyear+$row['lsk'];
			}	
		}else{
			$_xhyyear=0;
		}
		
		$sql="SELECT * FROM `member`";
		$_weijh=0;
		$_yijh=0;
		if ($query=mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
				if ($row['ispay']==0){
					$_weijh=$_weijh+1;
				}else{
					$_yijh=$_yijh+1;
				}
			}
		}
		
		$_tixian=0;
		$sql="SELECT * FROM `tixian` where isgrant=0";
		if ($query=mysql_query($sql)){
			$_tixian=mysql_num_rows($query);
		}
		
		$_chongzhi=0;
		$sql="SELECT * FROM `chongzhi` where isgrant=0";
		if ($query=mysql_query($sql)){
			$_chongzhi=mysql_num_rows($query);
		}
		
		$_tongzhi=0;
		$sql="SELECT * FROM `huikuan` where isgrant=0";
		if ($query=mysql_query($sql)){
			$_tongzhi=mysql_num_rows($query);
		}
		
		$_dingdan=0;
		$sql="SELECT * FROM `orders` where issend=0";
		if ($query=mysql_query($sql)){
			$_dingdan=mysql_num_rows($query);
		}
		
		$_return['xhyday']=$_xhyday;
		$_return['xyejiday']=$_xyejiday;
		$_return['xhymonth']=$_xhymonth;
		$_return['xyejimonth']=$_xyejimonth;
		$_return['xhyyear']=$_xhyyear;
		$_return['xyejiyear']=$_xyejiyear;
		$_return['weijh']=$_weijh;
		$_return['yijh']=$_yijh;
		$_return['tixian']=$_tixian;
		$_return['chongzhi']=$_chongzhi;
		$_return['tongzhi']=$_tongzhi;
		$_return['dingdan']=$_dingdan;
		
		return $_return;
	}
	
	/*
	*xzhy 新增会员数量
	*xzyj 新增业绩
	*xzdan 新增会员单数
	*ff 奖金发放
	*tx 提现
	*cz 充值
	*dd 订单
	*/
	function yejitongji($xzhy,$xzdan,$xzyj,$ff,$tx,$cz,$dd){
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		$sql="SELECT * FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$m." and day(ydate)=".$d."";
		$query=mysql_query($sql);
	 	if ($_systemyeji=mysql_fetch_array($query)){
			$systemyeji_update['xzhy']=$_systemyeji['xzhy']+$xzhy;
			$systemyeji_update['zhy']=$_systemyeji['zhy']+$xzhy;
			$systemyeji_update['xzdan']=$_systemyeji['xzdan']+$xzdan;
			$systemyeji_update['zdan']=$_systemyeji['zdan']+$xzdan;
			$systemyeji_update['xzyj']=$_systemyeji['xzyj']+$xzyj;
			$systemyeji_update['zyj']=$_systemyeji['zyj']+$xzyj;
			$systemyeji_update['ff']=$_systemyeji['ff']+$ff;
			$systemyeji_update['zff']=$_systemyeji['zff']+$ff;
			$systemyeji_update['tx']=$_systemyeji['tx']+$tx;
			$systemyeji_update['cz']=$_systemyeji['cz']+$cz;
			$systemyeji_update['dd']=$_systemyeji['dd']+$dd;
			edit_update_cl('systemyeji',$systemyeji_update,$_systemyeji['id']);
		}else{
			$sql="SELECT * FROM `systemyeji`";
			$query=mysql_query($sql);
			if(mysql_num_rows($query) >= 1){
				$sql1="SELECT sum(xzhy),sum(xzdan),sum(xzyj),sum(ff) FROM `systemyeji`";
				$query1=mysql_query($sql1);
				$zzz=mysql_fetch_array($query1);
			}else{
				$zzz=array(0,0,0,0);	
			}
			$_systemyeji['ydate']=now();
			$_systemyeji['xzhy']=$xzhy;
			$_systemyeji['zhy']=$xzhy+$zzz[0];
			$_systemyeji['xzdan']=$xzdan;
			$_systemyeji['zdan']=$xzdan+$zzz[1];
			$_systemyeji['xzyj']=$xzyj;
			$_systemyeji['zyj']=$xzyj+$zzz[2];
			$_systemyeji['ff']=$ff;
			$_systemyeji['zff']=$ff+$zzz[3];
			$_systemyeji['tx']=$tx;
			$_systemyeji['cz']=$cz;
			$_systemyeji['dd']=$dd;
			add_insert_cl('systemyeji',$_systemyeji);
		}
	}
}
?>