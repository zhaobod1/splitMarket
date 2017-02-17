<?php 
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(7,25);

if ($_POST['button2']){
	$sql="select * from `member` where ispay>0 and yxb>0";
	if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$pebi=$row['yxb']*10;
			edit_sql("update `member` set pe=pe+".$pebi.",yxb=0 where id=".$row['id']."");
		}		
	}
	echo "<script language=javascript>alert('全部买入完成.');window.location.href='?'</script>";
}

if ($_POST['button']){
	$sql="delete from `member` where id<>1";
	@mysql_query($sql) or die (mysql_error());
	$member_update['ulevel']=4;
	$member_update['sgb']=0;
	$member_update['gwb']=0;
	$member_update['zsq']=0;
	$member_update['mey']=0;
	$member_update['maxmey']=0;
	$member_update['wlf']=0;
	$member_update['recount']=0;
	$member_update['reyeji']=0;
	$member_update['area1']=0;
	$member_update['area2']=0;
	$member_update['area3']=0;
	$member_update['area4']=0;
	$member_update['area5']=0;
	$member_update['area6']=0;
	$member_update['area7']=0;
	$member_update['narea1']=0;
	$member_update['narea2']=0;
	$member_update['narea3']=0;
	$member_update['narea4']=0;
	$member_update['narea5']=0;
	$member_update['narea6']=0;
	$member_update['narea7']=0;
	$member_update['yarea1']=0;
	$member_update['yarea2']=0;
	$member_update['yarea3']=0;
	$member_update['yarea4']=0;
	$member_update['yarea5']=0;
	$member_update['yarea6']=0;
	$member_update['yarea7']=0;
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
	$member_update['pe']=0;
	$member_update['cfxf']=0;
	$member_update['xlevel']=0;
	$member_update['ishb']=0;
	$member_update['zb4']=0;
	$member_update['yxb']=0;
	$member_update['lsk']=3000;
	
	edit_update_cl('member',$member_update,1);
	$system_update['yeji']=0;
	$system_update['petcount']=0;
	$system_update['petallcount']=0;
	edit_delete_all('zengjianjilu');
	edit_delete_all('stockprice');
	edit_delete_all('stockbuy');
	edit_delete_all('stockrecord');
	edit_update_cl('systemparameters',$system_update,1);
	edit_delete_all('ulevelup');
	edit_delete_all('lsbd');
	edit_delete_all('bonus');
	edit_delete_all('bonustime');
	edit_delete_all('chongzhi');
	edit_delete_all('huikuan');
	edit_delete_all('mail');
	edit_delete_all('orders');
	edit_delete_all('systemyeji');
	edit_delete_all('tixian');
	edit_delete_all('zhuanhuan');
	edit_delete_all('zhuanzhang');
	edit_delete_all('bdrecord');
	edit_delete_all('bonuslaiyuan');
	
	
	echo "<script language=javascript>alert('清空数据完成.');window.location.href='?'</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清空数据库</title>
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
    <td align="center"><strong><font color="#FF0000">注意：清空数据库前请先做好数据备份，以免重要数据丢失</font></strong></td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <input name="button" type="submit" class="btn3" id="button" value="清空数据" onClick="{if(confirm('您确定要清空数据吗?')){this.document.selform.submit();return true;}return false;}"/>
    </form></td>
  </tr>
  <tr style="display:none">
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <input name="button2" type="submit" class="btn3" id="button2" value="全部买入" onClick="{if(confirm('确定要全部买入吗?')){this.document.selform.submit();return true;}return false;}"/>
    </form></td>
  </tr>
</table>
</body>
</html>