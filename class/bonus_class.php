<?php
include_once("../function.php");
include_once("member_class.php");
include_once("ulevel_class.php");
include_once("system_class.php");

class bonus_class{
	/*
	*直推
	*/
	function b1bonus($_uid,$_reid,$lsk){
		$_member = new member_class();
		$_us=$_member->getMemberbyID($_uid);
		$_reus=$_member->getMemberbyID($_reid);
		$_ulevel_cl=new ulevel_class();
		$_reul=$_ulevel_cl->getulevelbyulevel($_reus['ulevel']);
		//$_uul=$_ulevel_cl->getulevelbyulevel($_us['ulevel']);
		$b1=$_reul['yl1']/100*$lsk;
		$_member_update['b1']=$_reus['b1']+$b1;
		edit_update_cl('member',$_member_update,$_reid);
		$beizhu=$lsk."*".$_reul['yl1']."%";
		$this->bonus_laiyuan($_reus['id'],$_reus['nickname'],$_us['id'],$_us['nickname'],1,$b1,$beizhu);
	}
	
	/*
	*对碰奖
	*/
	function b2bonus(){
		$_member = new member_class();
		$_ulevel_cl=new ulevel_class();
		$sql="SELECT * FROM `member` where yarea1>0 and yarea2>0";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$_member_update=NULL;
				$y1=$row['yarea1'];
				$y2=$row['yarea2'];
				$dan=0;
				
				if($y1>=$y2){
					$dan=$y2;
					$y1=$y1-$y2;
					$y2=0;	
				}else{
					$dan=$y1;
					$y2=$y2-$y1;
					$y1=0;		
				}
				
				//while ($y1>0 && $y2>0){
//					$dan=$dan+1;
//					$y1=$y1-1;
//					$y2=$y2-1;	
//				}
				if ($dan>0){
					$_iul=$_ulevel_cl->getulevelbyulevel($row['ulevel']);
					$_b2=$_iul['yl2']/100*$dan;
					//日封顶判断
					$rb2=$this->ljbonus('b2',$row['id'],2);
					if($_b2+$rb2>$row['lsk']*2){
						$_b2=$row['lsk']*2-$rb2;
						if($_b2<0){
							$_b2=0;	
						}
					}
					
					if ($_b2>0){
						$_member_update['b2']=$row['b2']+$_b2;
						$_member_update['yarea1']=$y1;
						$_member_update['yarea2']=$y2;
						edit_update_cl('member',$_member_update,$row['id']);
						$beizhu="对碰奖";
						$this->bonus_laiyuan($row['id'],$row['nickname'],0,"-",2,$_b2,$beizhu);
					}
				}
			}
		}	
	}
	
	function b3bonus($uid){
		$_member = new member_class();
		$_ulevel_cl=new ulevel_class();
		$_us=$_member->getMemberbyID($uid);
		$sql="select * from `member` where id in(0".$_us['ppath']."0) and ".$_us['plevel']."-plevel<=5";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$bili=0;
				$_iul=$_ulevel_cl->getulevelbyulevel($row['ulevel']);
				$cha=$_us['plevel']-$row['plevel'];
				switch($cha){
					case 1:
						$bili=$_iul['yl3']/100;
						break;
					case 2:
						$bili=$_iul['yl4']/100;
						break;
					case 3:
						$bili=$_iul['yl5']/100;
						break;
					case 4:
						$bili=$_iul['yl6']/100;
						break;
					case 5:
						$bili=$_iul['yl7']/100;
						break;	
				}
				$b3=$_us['lsk']*$bili;
				$_member_update=NULL;
				$_member_update['b3']=$row['b3']+$b3;
				edit_update_cl('member',$_member_update,$row['id']);
				$beizhu=$cha."层见点奖";
				$this->bonus_laiyuan($row['id'],$row['nickname'],$_us['id'],$_us['nickname'],3,$b3,$beizhu);
			}
		}
	}
	
	function b4bonus($uid,$sid,$snickname,$b4){
		$us=getMemberbyID($uid);
		$zb4=$this->ljbonus("b4",$uid,0);
		if ($b4+$zb4>$us['lsk']*10){
			$b4=$us['lsk']*10-$zb4;
			if($b4<0){
				$b4=0;	
			}
		}
		if ($b4>0){
			edit_sql("update `member` set b4=b4+".$b4-$b4*0.05.",zb4=zb4+".$b4-$b4*0.05." where id=".$us['id']."");
			$beizhu="pe币交易";
			$this->bonus_laiyuan($uid,$us['nickname'],$sid,$snickname,4,$b4,$beizhu);
			if ($us['reid']>0){
				$b1=$b4*0.05;
				edit_sql("update `member` set b1=b1+".$b1." where id=".$us['reid']."");
				$beizhu2="pe币交易提成";
				$this->bonus_laiyuan($us['reid'],$us['rname'],$us['id'],$us['nickname'],1,$b1,$beizhu2);
			}
		}
	}
	
	function b5bonus(){
		$system_cl=new system_class();
		$sys=$system_cl->system_information(1);
		$sql="select * from `member` where zb4+pe*".$sys['peprice'].">=lsk*".$sys['qzbs']."";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$b5=$row['pe']*$sys['peprice'];
				$b5=$b5-$b5*0.2;
				edit_sql("update `member` set b5=b5+".$b5.",pe=0,pelock=1 where id=".$row['id']."");	
				$beizhu="强制卖出(已扣除20%)";
				$this->bonus_laiyuan($row['id'],$row['nickname'],0," - ",5,$b5,$beizhu);
			}
		}
	}
	
	/*
	*查询累计金额
	*$_jx=奖金类型b0,b1,b2……
	*$_uid=查询编号
	*$_lx=查询类型0总计,1月,2日
	*/
	function ljbonus($_jx,$_uid,$_lx){
		$y=date("Y",strtotime(now()));
		$m=date("m",strtotime(now()));
		$d=date("d",strtotime(now()));
		$sql="SELECT sum(".$_jx.") from `bonus` where uid=".$_uid."";
		if($_lx==1){
			$sql=$sql." and year(bdate)=".$y." and month(bdate)=".$m."";	
		}else if($_lx==2){
			$sql=$sql." and year(bdate)=".$y." and month(bdate)=".$m." and day(bdate)=".$d."";
		}
		
		if ($query=mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$fanhui=$row[0];
			}
		}else{
			$fanhui=0;
		}
		
		return $fanhui;
	}
	
	function b0bonus(){
		$lj=0;
		$sql="SELECT * FROM `member` WHERE b1>0 or b2>0 or b3>0 or b4>0 or b5>0 or b6>0 or b7>0 or b8>0 or b10>0";
		if ($query=mysql_query($sql)){
			if(mysql_num_rows($query)>0){
				$system_cl=new system_class();
				$_system=$system_cl->system_information(1);
				//$sl=$_system['sl']/100;
				$sql=0;
				$wlf=$_system['wlf'];
				$lx=1; //产生数据条数,0产生N条,1每日产生1条
				$did=$this->bonustime_insert($lx);
				while ($row=mysql_fetch_array($query)){
					$member_update=NULL;
					$b1=$row['b1'];
					$b2=$row['b2'];
					$b3=$row['b3'];
					$b4=$row['b4'];
					$b5=$row['b5'];
					$b6=$row['b6'];
					$b7=0;
					$b8=0;
					$b9=0;
					$b10=0;
					$b11=0;
					$b0=$b1+$b2+$b3+$b4+$b5+$b6;
					
					//$b7=$b0*$_system['fxkc']/100;
					//$b8=$b0*$_system['sl']/100;
					//$beizhu=$b0."*".$_system['sl']."%";
					//$b0=$b0-$b7-$b8;
					//$b7=0-$b7;
					//$b8=0-$b8;
					//$this->bonus_laiyuan($row['id'],$row['nickname'],0," - ",8,$b8,$beizhu);
					
					//if ($row['wlf']==0){
//						if ($b0>=$wlf){
//							$b0=$b0-$wlf;
//							$b9=0-$wlf;
//							$member_update['wlf']=1;
//							$this->bonus_laiyuan($row['id'],$row['nickname'],0," - ",9,$b9,"年度网络维护费");
//						}
//					}
					$member_update['b0']=0;
					$member_update['b1']=0;
					$member_update['b2']=0;
					$member_update['b3']=0;
					$member_update['b4']=0;
					$member_update['b5']=0;
					$member_update['b6']=0;
					$member_update['b7']=0;
					$member_update['b8']=0;
					$member_update['b9']=0;
					$member_update['b10']=0;
					$member_update['mey']=$row['mey']+$b0;
					$member_update['maxmey']=$row['maxmey']+$b0;
					edit_update_cl('member',$member_update,$row['id']);
					$bonus_update['did']=$did;
					$bonus_update['uid']=$row['id'];
					$bonus_update['b0']=$b0;
					$bonus_update['b1']=$b1;
					$bonus_update['b2']=$b2;
					$bonus_update['b3']=$b3;
					$bonus_update['b4']=$b4;
					$bonus_update['b5']=$b5;
					$bonus_update['b6']=$b6;
					$bonus_update['b7']=$b7;
					$bonus_update['b8']=$b8;
					$bonus_update['b9']=$b9;
					$bonus_update['b10']=$b10;
					$bonus_update['b11']=$b11;
					$lj=$lj+$b0;
					//if($b0>0 || $b7>0 || $b8>0){
					$this->bonus_insert($lx,$bonus_update);
					//}
				}
			}
		}
		$_systemyeji=new system_class();
		$_systemyeji->yejitongji(0,0,0,$lj,0,0,0);
	}
	
	/*
	*@lx 0产生多条数据，1每天产生1条
	*/
	function bonustime_insert($lx){
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if($lx==1){
			$sql="SELECT * FROM `bonustime` WHERE year(jsdate)=".$y." and month(jsdate)=".$m." and day(jsdate)=".$d."";
			$query=mysql_query($sql);
	 		if ($_bonustime=mysql_fetch_array($query)){
				$did=$_bonustime['id'];
			}else{
				$sql1="INSERT INTO bonustime(jsdate,jslx) VALUES('".now()."',1)";
				$reult=mysql_query($sql1);
				$did=mysql_insert_id();
			}
		}else if($lx==0){
				$sql1="INSERT INTO bonustime(jsdate,jslx) VALUES('".now()."',1)";
				$reult=mysql_query($sql1);
				$did=mysql_insert_id();
		}
		return $did;
	}
	
	/*
	*@lx 0产生多条数据，1每天产生1条,必须与bonustime的lx同步
	*/
	function bonus_insert($lx,$_bonus){
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if($lx==1){
			$sql="SELECT * FROM `bonus` WHERE year(bdate)=".$y." and month(bdate)=".$m." and day(bdate)=".$d." and uid=".$_bonus['uid']."";
			$query=mysql_query($sql);
	 		if ($bonus=mysql_fetch_array($query)){
				$bonus_update=NULL;
				$bonus_update['b0']=$bonus['b0']+$_bonus['b0'];
				$bonus_update['b1']=$bonus['b1']+$_bonus['b1'];
				$bonus_update['b2']=$bonus['b2']+$_bonus['b2'];
				$bonus_update['b3']=$bonus['b3']+$_bonus['b3'];
				$bonus_update['b4']=$bonus['b4']+$_bonus['b4'];
				$bonus_update['b5']=$bonus['b5']+$_bonus['b5'];
				$bonus_update['b6']=$bonus['b6']+$_bonus['b6'];
				$bonus_update['b7']=$bonus['b7']+$_bonus['b7'];
				$bonus_update['b8']=$bonus['b8']+$_bonus['b8'];
				$bonus_update['b9']=$bonus['b9']+$_bonus['b9'];
				$bonus_update['b10']=$bonus['b10']+$_bonus['b10'];
				edit_update_cl('bonus',$bonus_update,$bonus['id']);
			}else{
				$bonus_update=NULL;
				$bonus_update['bdate']=now();
				$bonus_update['did']=$_bonus['did'];
				$bonus_update['uid']=$_bonus['uid'];
				$bonus_update['b0']=$_bonus['b0'];
				$bonus_update['b1']=$_bonus['b1'];
				$bonus_update['b2']=$_bonus['b2'];
				$bonus_update['b3']=$_bonus['b3'];
				$bonus_update['b4']=$_bonus['b4'];
				$bonus_update['b5']=$_bonus['b5'];
				$bonus_update['b6']=$_bonus['b6'];
				$bonus_update['b7']=$_bonus['b7'];
				$bonus_update['b8']=$_bonus['b8'];
				$bonus_update['b9']=$_bonus['b9'];
				$bonus_update['b10']=$_bonus['b10'];
				add_insert_cl('bonus',$bonus_update);
			}
		}else if($lx==0){
				$bonus_update=NULL;
				$bonus_update['bdate']=now();
				$bonus_update['did']=$_bonus['did'];
				$bonus_update['uid']=$_bonus['uid'];
				$bonus_update['b0']=$_bonus['b0'];
				$bonus_update['b1']=$_bonus['b1'];
				$bonus_update['b2']=$_bonus['b2'];
				$bonus_update['b3']=$_bonus['b3'];
				$bonus_update['b4']=$_bonus['b4'];
				$bonus_update['b5']=$_bonus['b5'];
				$bonus_update['b6']=$_bonus['b6'];
				$bonus_update['b7']=$_bonus['b7'];
				$bonus_update['b8']=$_bonus['b8'];
				$bonus_update['b9']=$_bonus['b9'];
				$bonus_update['b10']=$_bonus['b10'];
				add_insert_cl('bonus',$bonus_update);
		}
	}
	
	//写入奖金来源
	function bonus_laiyuan($uid,$nickname,$yid,$ynickname,$lx,$jine,$beizhu){
		$bonuslaiyuan=NULL;
		$bonuslaiyuan['uid']=$uid;
		$bonuslaiyuan['nickname']=$nickname;
		$bonuslaiyuan['yid']=$yid;
		$bonuslaiyuan['ynickname']=$ynickname;
		$bonuslaiyuan['lx']=$lx;
		$bonuslaiyuan['jine']=$jine;
		$bonuslaiyuan['bdate']=now();
		$bonuslaiyuan['beizhu']=$beizhu;
		add_insert_cl('bonuslaiyuan',$bonuslaiyuan);
	}
}
?>