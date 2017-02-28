<?php
include("check.php");
include("check2.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
if ($_POST['submit']){
	$uid=$_SESSION['ID'];
	$jine=$_POST['jine'];
	//if ($jine>=0){
		$us=que_select_cl('member',$_SESSION['ID']);
		//if ($jine>=0){
			$member['isbd']=1;
			$sheng=$_POST['province'];
			$shi=$_POST['city1'];
			$xian=$_POST['city2'];
			$member['bdnickname']=$_POST['bdnickname'];
			$member['bddiqu']=$sheng.$shi.$xian;
			$member['bdbeizhu']=$_POST['bdbeizhu'];
			$member['bdlevel']=$_POST['bdlevel'];
			//$member['sqbdje']=$jine;
			edit_update_cl('member',$member,$uid);
			echo "<script language=javascript>alert('您的申请已经提交,请耐心等待审核.\\n申请金额:".$jine."');window.location.href='?'</script>";
		//}else{
			//alert("首次申请续购币23500.","?");
		//}
	//}else{
		//echo "<script language=javascript>alert('申请金额不正确,请确认后重新申请');window.location.href='?'<123/script>";	
	//}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>服务中心申请</title>
<script src='../js/shengshixian/jquery-1[1].2.6.js'></script>
<script src="../js/shengshixian/jquery.provincesCity.js" type="text/javascript"></script>
<script src="../js/shengshixian/provincesdata.js" type="text/javascript"></script>
 <script>
	//调用插件
	$(function(){
		$("#test").ProvinceCity();
	});
  </script>
  <style>
	#test select{
		width:100px;
	}
  </style>
</head>
<body>
<form name="form1" method="post" action="?" >
<?php
	$_member=que_select_cl('member',$_SESSION['ID']);
	if ($_member['isbd']==0){
?>
<table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr>
    <td width="35%" height="22" align="right"><?=$shenqing2?>：</td>
    <td width="65%" align="left"><input name="nickname" type="text" id="nickname" size="20" maxlength="20" value="<?=$_SESSION['nickname']?>" readonly></td>
  </tr>
  <tr style="display:none">
    <td width="35%" height="22" align="right">服务中心名称：</td>
    <td width="65%" align="left"><input name="bdnickname" type="text" id="bdnickname" size="20" maxlength="20" value=""></td>
  </tr>
  <tr style="display:none">
    <td width="35%" height="22" align="right">服务中心级别：</td>
    <td width="65%" align="left">
      <select name="bdlevel" id="bdlevel">
        <option value="1">A级</option>
        <option value="2">B级</option>
      </select></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$shenqing3?>：</td>
    <td align="left"><div id="test"></div></td>
  </tr>
  <tr style="display:none">
    <td height="22" align="right">备注：</td>
    <td align="left">
      <textarea name="bdbeizhu" id="bdbeizhu" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" id="submit" type="submit" class="button_green" value="<?=$anniu1?>"></td>
  </tr>
</table>
<?php
	}else if($_member['isbd']==1){
		echo "您的申请已经提交,正在审核中,请耐心等待.";	
	}else if($_member['isbd']==2){
		echo "".$shenqing1."：".$_SESSION['nickname']."";		
	}
?>
</form>
</body>
</html>