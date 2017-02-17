<?php
include("admin_check.php");
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(6,21);
$_system=new system_class();
$sys=$_system->system_information(1);
if($_POST['button']){
	$ulevel=new ulevel_class();
	$lvid="lvid";
	$lvname="lvname";
	$dan="dan";
	$lsk="lsk";
	$yl1="yl1";
	$yl2="yl2";
	$yl3="yl3";
	$yl4="yl4";
	$yl5="yl5";
	$yl6="yl6";
	$yl7="yl7";
	$yl8="yl8";
	$yl9="yl9";
	$yl10="yl10";
	for($i=1;$i<=$ulevel->Getulevelcount();$i++){
		$up_ulevel=NULL;
		$up_ulevel['id']=$_POST[$lvid.$i];
		$up_ulevel['lvname']=$_POST[$lvname.$i];
		$up_ulevel['dan']=$_POST[$dan.$i];
		$up_ulevel['lsk']=$_POST[$lsk.$i];
		//$up_ulevel['isbd']=$_POST['isbd']==1 ? 1:0;
		$up_ulevel['yl1']=$_POST[$yl1.$i];
		$up_ulevel['yl2']=$_POST[$yl2.$i];
		$up_ulevel['yl3']=$_POST[$yl3.$i];
		$up_ulevel['yl4']=$_POST[$yl4.$i];
		$up_ulevel['yl5']=$_POST[$yl5.$i];
		$up_ulevel['yl6']=$_POST[$yl6.$i];
		$up_ulevel['yl7']=$_POST[$yl7.$i];
		/*$up_ulevel['yl8']=$_POST[$yl8.$i];
		$up_ulevel['yl9']=$_POST[$yl9.$i];
		$up_ulevel['yl10']=$_POST[$yl10.$i];*/
		$ulevel->ulevel_update($up_ulevel);	
	}
	
	$sys_update['d1']=$_POST['d1'];
	$sys_update['d2']=$_POST['d2'];
	$sys_update['d3']=$_POST['d3'];
	$sys_update['d4']=$_POST['d4'];
	$sys_update['d5']=$_POST['d5'];
	$sys_update['d6']=$_POST['d6'];
	$sys_update['d7']=$_POST['d7'];
	$sys_update['d8']=$_POST['d8'];
	$sys_update['d9']=$_POST['d9'];
	$sys_update['d10']=$_POST['d10'];
	
	$sys_update['ds1']=$_POST['ds1'];
	$sys_update['ds2']=$_POST['ds2'];
	$sys_update['ds3']=$_POST['ds3'];
	$sys_update['ds4']=$_POST['ds4'];
	$sys_update['ds5']=$_POST['ds5'];
	$sys_update['ds6']=$_POST['ds6'];
	$sys_update['ds7']=$_POST['ds7'];
	$sys_update['ds8']=$_POST['ds8'];
	$sys_update['ds9']=$_POST['ds9'];
	$sys_update['ds10']=$_POST['ds10'];
	
	$sys_update['dbl1']=$_POST['dbl1'];
	$sys_update['dbl2']=$_POST['dbl2'];
	$sys_update['dbl3']=$_POST['dbl3'];
	$sys_update['dbl4']=$_POST['dbl4'];
	$sys_update['dbl5']=$_POST['dbl5'];
	$sys_update['dbl6']=$_POST['dbl6'];
	$sys_update['dbl7']=$_POST['dbl7'];
	$sys_update['dbl8']=$_POST['dbl8'];
	$sys_update['dbl9']=$_POST['dbl9'];
	$sys_update['dbl10']=$_POST['dbl10'];
	
	$sys_update['lsbl']=$_POST['lsbl'];
	$sys_update['fxkc']=$_POST['fxkc'];
	$sys_update['fxlj']=$_POST['fxlj'];
	$sys_update['fxtzbl']=$_POST['fxtzbl'];
	$sys_update['jybl']=$_POST['jybl'];
	
	
	$sys_update['id']=1;
	$_system->system_update($sys_update);
	
	alert('保存成功.','?');
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>级别参数</title>
</head>
<body>
<form name="form1" method="post" action="?">
  <table width="100%" border="0">
    <tr>
      <td><table width="90%" cellpadding="3" cellspacing="1" border="0" align="left" class="table1">
        <tr>
          <td height="10" colspan="10" align="center">级别参数</td>
        </tr>
        <tr>
          <td width="30" align="center">级别</td>
          <td width="30" align="center">名称</td>
          <td width="30" align="center">金额</td>
          <td style="display:none" align="center">单数</td>
          <td width="30" align="center">推荐奖(%)</td>
          <td width="30" align="center">对碰奖(%)</td>
          <td width="40" align="center">一层见点奖(%)</td>
          <td width="40"  align="center">二层见点奖(%)</td>
          <td width="40"  align="center">三层见点奖(%)</td>
          <td width="40" align="center">四层见点奖(%)</td>
          <td width="40" align="center">五层见点奖(%)</td>
        </tr>
        <?php
      	$sql = "SELECT * FROM `ulevel` order by ulevel";
		if($query = mysql_query($sql)){
			$i=1;
			while ($row=mysql_fetch_array($query)){
	  ?>
        <tr>
          <td align="center"><input name="lvid<?=$i?>" type="hidden" value="<?=$row['id']?>">
            <?=$row['ulevel']?></td>
          <td align="center"><input name="lvname<?=$i?>" type="text" value="<?=$row['lvname']?>" size="5" maxlength="20"></td>
          <td align="center"><input name="lsk<?=$i?>" type="text" value="<?=$row['lsk']?>" size="3" maxlength="10"></td>
          <td style="display:none" align="center"><input name="dan<?=$i?>" type="text" value="<?=$row['dan']?>" size="3" maxlength="3"></td>
          <td align="center"><input name="yl1<?=$i?>" type="text" value="<?=$row['yl1']?>" size="3" maxlength="20"></td>
          <td align="center"><input name="yl2<?=$i?>" type="text" value="<?=$row['yl2']?>" size="3" maxlength="20"></td>
          <td align="center"><input name="yl3<?=$i?>" type="text" value="<?=$row['yl3']?>" size="3" maxlength="20"></td>
          <td align="center"><input name="yl4<?=$i?>" type="text" value="<?=$row['yl4']?>" size="3" maxlength="20"></td>
          <td align="center"><input name="yl5<?=$i?>" type="text" value="<?=$row['yl5']?>" size="3" maxlength="20"></td>
          <td  align="center"><input name="yl6<?=$i?>" type="text" value="<?=$row['yl6']?>" size="3" maxlength="20"></td>
          <td  align="center"><input name="yl7<?=$i?>" type="text" value="<?=$row['yl7']?>" size="3" maxlength="20"></td>
        </tr>
        <?php
	  			$i++;
			}
		}
	  ?>
      </table></td>
    </tr>
    <tr>
      <td><input name="button" type="submit" class="btn2" id="button" value="保存"></td>
    </tr>
  </table>
  <br>
<table style="float:left; display:none" width="50%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" >
  <tr>
    <td align="center">级别</td>
    <td align="center">小区-业绩</td>
    <td align="center">代数</td>
    <td align="center">比例(%)</td>
  </tr>
  <tr>
    <td align="center">一星</td>
    <td align="center">
      <input name="d1" type="text" id="d1" value="<?=$sys['d1']?>" size="8"></td>
    <td align="center"><input name="ds1" type="text" id="ds1" value="<?=$sys['ds1']?>" size="8"></td>
    <td align="center"><input name="dbl1" type="text" id="dbl1" value="<?=$sys['dbl1']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">二星</td>
    <td align="center"><input name="d2" type="text" id="d2" value="<?=$sys['d2']?>" size="8"></td>
    <td align="center"><input name="ds2" type="text" id="ds2" value="<?=$sys['ds2']?>" size="8"></td>
    <td align="center"><input name="dbl2" type="text" id="dbl2" value="<?=$sys['dbl2']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">三星</td>
    <td align="center"><input name="d3" type="text" id="d3" value="<?=$sys['d3']?>" size="8"></td>
    <td align="center"><input name="ds3" type="text" id="ds3" value="<?=$sys['ds3']?>" size="8"></td>
    <td align="center"><input name="dbl3" type="text" id="dbl3" value="<?=$sys['dbl3']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">四星</td>
    <td align="center"><input name="d4" type="text" id="d4" value="<?=$sys['d4']?>" size="8"></td>
    <td align="center"><input name="ds4" type="text" id="ds4" value="<?=$sys['ds4']?>" size="8"></td>
    <td align="center"><input name="dbl4" type="text" id="dbl4" value="<?=$sys['dbl4']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">五星</td>
    <td align="center"><input name="d5" type="text" id="d5" value="<?=$sys['d5']?>" size="8"></td>
    <td align="center"><input name="ds5" type="text" id="ds5" value="<?=$sys['ds5']?>" size="8"></td>
    <td align="center"><input name="dbl5" type="text" id="dbl5" value="<?=$sys['dbl5']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">一总</td>
    <td align="center"><input name="d6" type="text" id="d6" value="<?=$sys['d6']?>" size="8"></td>
    <td align="center"><input name="ds6" type="text" id="ds6" value="<?=$sys['ds6']?>" size="8"></td>
    <td align="center"><input name="dbl6" type="text" id="dbl6" value="<?=$sys['dbl6']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">二总</td>
    <td align="center"><input name="d7" type="text" id="d7" value="<?=$sys['d7']?>" size="8"></td>
    <td align="center"><input name="ds7" type="text" id="ds7" value="<?=$sys['ds7']?>" size="8"></td>
    <td align="center"><input name="dbl7" type="text" id="dbl7" value="<?=$sys['dbl7']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">三总</td>
    <td align="center"><input name="d8" type="text" id="d8" value="<?=$sys['d8']?>" size="8"></td>
    <td align="center"><input name="ds8" type="text" id="ds8" value="<?=$sys['ds8']?>" size="8"></td>
    <td align="center"><input name="dbl8" type="text" id="dbl8" value="<?=$sys['dbl8']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">四总</td>
    <td align="center"><input name="d9" type="text" id="d9" value="<?=$sys['d9']?>" size="8"></td>
    <td align="center"><input name="ds9" type="text" id="ds9" value="<?=$sys['ds9']?>" size="8"></td>
    <td align="center"><input name="dbl9" type="text" id="dbl9" value="<?=$sys['dbl9']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">五总</td>
    <td align="center"><input name="d10" type="text" id="d10" value="<?=$sys['d10']?>" size="8"></td>
    <td align="center"><input name="ds10" type="text" id="ds10" value="<?=$sys['ds10']?>" size="8"></td>
    <td align="center"><input name="dbl10" type="text" id="dbl10" value="<?=$sys['dbl10']?>" size="8"></td>
  </tr>
</table>
<table width="50%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" style="display:none">
  <tr>
    <td align="center">零售报单计算比例(%)</td>
    <td align="center"><input name="lsbl" type="text" id="lsbl" value="<?=$sys['lsbl']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">复销扣除(%)</td>
    <td align="center"><input name="fxkc" type="text" id="fxkc" value="<?=$sys['fxkc']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">复销累计金额</td>
    <td align="center"><input name="fxlj" type="text" id="fxlj" value="<?=$sys['fxlj']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">复销计算拓展奖比例(%)</td>
    <td align="center"><input name="fxtzbl" type="text" id="fxtzbl" value="<?=$sys['fxtzbl']?>" size="8"></td>
  </tr>
  <tr>
    <td align="center">拓展奖大区结余比例(%)</td>
    <td align="center"><input name="jybl" type="text" id="jybl" value="<?=$sys['jybl']?>" size="8"></td>
  </tr>
</table>
</form>
</body>
</html>