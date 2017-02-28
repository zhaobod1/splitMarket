<?php
include_once("../function.php");
include_once("../class/system_class.php");
include_once("../class/bonus_class.php");
session_start();

$system_cl=new system_class();
$bonus_cl=new bonus_class();
$sys=$system_cl->system_information(1);
$zs=0;
$sql="select sum(pe) from `member`";
if ($query=mysql_query($sql)){
	while ($row=mysql_fetch_array($query)){
		$zs=$row[0];
	}	
}
if ($_POST['button']){
	$jine=$_POST['jine'];
	$num=$_POST['num'];
	$sql="select * from `stockbuy` where lx=0 and price=".$jine." and num>0 and isjs=0 order by id";
	if ($query=mysql_query($sql)){
		while ($row=mysql_fetch_array($query) and $num>0){
			if($row['num']>$num){
				$stockrecord=NULL;
				$stockrecord['uid']=0;
				$stockrecord['nickname']="管理员";
				$stockrecord['sid']=$row['uid'];
				$stockrecord['snickname']=$row['nickname'];
				$stockrecord['num']=$num;
				$stockrecord['price']=$row['price'];
				$stockrecord['sdate']=now();
				add_insert_cl('stockrecord',$stockrecord);
				
				$row['num']=$row['num']-$num;
				edit_update_cl('stockbuy',$row,$row['id']);
				
				$yxb=$num*$row['price'];
				edit_sql("update `member` set pe=pe+".$num." where id=".$row['uid']."");
				$num=0;
			}else{
				$stockrecord=NULL;
				$stockrecord['uid']=0;
				$stockrecord['nickname']="管理员";
				$stockrecord['sid']=$row['uid'];
				$stockrecord['snickname']=$row['nickname'];
				$stockrecord['num']=$row['num'];
				$stockrecord['price']=$row['price'];
				$stockrecord['sdate']=now();
				$yxb=$row['num']*$row['price'];
				edit_sql("update `member` set pe=pe+".$row['num']." where id=".$row['uid']."");
				
				$num=$num-$row['num'];
				
				$row['isjs']=1;
				$row['num']=0;
				edit_update_cl('stockbuy',$row,$row['id']);	
			}
		}
	}
	if($num>0){
		$stock['uid']=0;
		$stock['nickname']="管理员";
		$stock['num']=$num;
		$stock['total']=$num;
		$stock['price']=$jine;
		$stock['lx']=1;
		$stock['sdate']=now();
		add_insert_cl('stockbuy',$stock);
	}
	echo "<script language=javascript>alert('新增pe币完成.');window.location.href='?'</script>";	
}

if ($_POST['button2']){
	$sql="select * from `stockbuy` where isjs=0";
	if ($query=mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			if ($row['isjs']==0){
				if($row['lx']==0){
					$yxb=$row['num']*$row['price'];
					edit_sql("update `member` set yxb=yxb+".$yxb." where id=".$row['uid']."");	
					edit_sql("update `stockbuy` set isjs=2 where id=".$row['id']."");	
				}else if ($row['lx']==1){
					edit_sql("update `member` set pe=pe+".$row['num']." where id=".$row['uid']."");	
					edit_sql("update `stockbuy` set isjs=2 where id=".$row['id']."");	
				}
			}
		}
	}
	$bonus_cl->b5bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('撤消完成');window.location.href='?'</script>";	
}

if ($_POST['button3']){
	edit_sql("update `systemparameters` set peprice=".$_POST['peprice']." where id=1");	
	addgupiaolist(time()+3600*8,$_POST['peprice'],0);
	
	$bonus_cl->b5bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('当前价格修改完成');window.location.href='?'</script>";	
}

if ($_POST['button4']){
	$peprice=$_POST['peprice'];
	$peprice2=$_POST['peprice2'];
	$lx=$_POST['lx'];
	$beishu=$_POST['beishu'];
	if ($lx==1){
		if($peprice<=$peprice2){
			echo "<script language=javascript>alert('金额错误,拆分后价格不能大于当前价格.');window.location.href='?'</script>";		
		}else{
				$cha=$peprice-$peprice2;
				$sql="select * from `member` where pe>0";
				if ($query=mysql_query($sql)){
					while ($row=mysql_fetch_array($query)){
						edit_sql("update `member` set pe=pe+".$row['pe']*$cha." where id=".$row['id']."");
					}	
				}
				addgupiaolist(time()+3600*8,$_POST['peprice2'],0);
				edit_sql("update `systemparameters` set peprice=".$_POST['peprice2']." where id=1");
				
				//$sql="select * from `member` where pe>=lsk*10";
//				if ($query = mysql_query($sql)){
//					while($row=mysql_fetch_array($query)){
//						$cha=$row['pe']-$row['lsk']*10;
//						edit_sql("update `member` set pe=pe-".$cha.",gwb=gwb+".$cha." where id=".$row['id']."");
//					}
//				}
		}
	}else{
		$sql="select * from `member` where pe>0";
		if ($query=mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				edit_sql("update `member` set pe=pe*".$beishu." where id=".$row['id']."");
			}	
		}
		addgupiaolist(time()+3600*8,$_POST['peprice']/$beishu,0);
		edit_sql("update `systemparameters` set peprice=".$_POST['peprice']/$beishu." where id=1");
		/*$sql="select * from `member` where pe>=lsk*10";
		if ($query = mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
				$cha=$row['pe']-$row['lsk']*10;
				edit_sql("update `member` set pe=pe-".$cha.",gwb=gwb+".$cha." where id=".$row['id']."");
			}
		}	*/
	}
	$bonus_cl->b5bonus();
	$bonus_cl->b0bonus();
	echo "<script language=javascript>alert('拆分完成.');window.location.href='?'</script>";	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<title>pe币管理</title>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body scroll="no">
<form id="form1" name="form1" method="post" action="?">
  <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
    <tr>
      <td colspan="2" align="center">新增pe币</td>
    </tr>
    <tr>
      <td width="49%" align="right">新增数量：</td>
      <td width="51%" align="left"><input type="text" name="num" id="num" /></td>
    </tr>
    <tr>
      <td align="right">新增价格：</td>
      <td align="left"><input type="text" name="jine" id="jine" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="提  交"  class="btn1"/></td>
    </tr>
  </table>
  <br />
  <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
    <tr>
      <td width="100%" align="center">撤消所有委托</td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="button2" id="button2" value="撤  消"  class="btn1"/></td>
    </tr>
  </table>
  <br />
  <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
    <tr>
      <td width="100%" colspan="2" align="center">股票拆分</td>
    </tr>
    <tr>
      <td width="50%" align="right">当前系统pe币总数：</td>
      <td width="50%" align="left"><?=$zs?></td>
    </tr>
    <tr>
      <td width="50%" align="right">当前pe币价格：</td>
      <td width="50%" align="left">
      <input name="peprice" type="text" id="peprice" value="<?=$sys['peprice']?>" size="5" maxlength="5"/>
      <input type="submit" name="button3" id="button3" value="修  改"  class="btn1"/></td>
    </tr>
    <tr>
      <td width="50%" align="right">拆分类型：</td>
      <td width="50%" align="left"><!--价格拆分
        <input name="lx" type="radio" id="lx" value="1" checked="checked" />-->
        倍数拆分
      <input name="lx" type="radio" id="lx" value="2" checked="checked" /></td>
    </tr>
    <tr style="display:none">
      <td width="50%" align="right">拆分后价格：</td>
      <td width="50%" align="left">
      <input name="peprice2" type="text" id="peprice2" value="1.00" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <td width="50%" align="right">拆分后倍数：</td>
      <td width="50%" align="left">
      <input name="beishu" type="text" id="beishu" value="1" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button4" id="button4" value="拆  分"  class="btn1"/></td>
    </tr>
  </table>
</form>
</body>
</html>