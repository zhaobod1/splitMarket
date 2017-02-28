<?php
include_once("../class/admin_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
	if($_SESSION['admin_id']){
		if($_SESSION['admin_id']==1){
			alert('超级管理员禁止修改权限.','');
		}else{
			$_admin=new admin_class();
			if($admin_us=$_admin->getadminbyid($_SESSION['admin_id'])){
				$zq1=$admin_us['zq1'];
				$zq2=$admin_us['zq2'];
				$zq3=$admin_us['zq3'];
				$zq4=$admin_us['zq4'];
				$zq5=$admin_us['zq5'];
				$zq6=$admin_us['zq6'];
				$zq7=$admin_us['zq7'];
				$zq8=$admin_us['zq8'];
				$zq9=$admin_us['zq9'];
				$zq10=$admin_us['zq10'];
				$q1=$admin_us['q1'];
				$q2=$admin_us['q2'];
				$q3=$admin_us['q3'];
				$q4=$admin_us['q4'];
				$q5=$admin_us['q5'];
				$q6=$admin_us['q6'];
				$q7=$admin_us['q7'];
				$q8=$admin_us['q8'];
				$q9=$admin_us['q9'];
				$q10=$admin_us['q10'];
				$q11=$admin_us['q11'];
				$q12=$admin_us['q12'];
				$q13=$admin_us['q13'];
				$q14=$admin_us['q14'];
				$q15=$admin_us['q15'];
				$q16=$admin_us['q16'];
				$q17=$admin_us['q17'];
				$q18=$admin_us['q18'];
				$q19=$admin_us['q19'];
				$q20=$admin_us['q20'];
				$q21=$admin_us['q21'];
				$q22=$admin_us['q22'];
				$q23=$admin_us['q23'];
				$q24=$admin_us['q24'];
				$q25=$admin_us['q25'];
			}else{
				alert('访问出错,该管理员不存在.','');		
			}	
		}
	}else{
		alert('访问出错,请从权限管理页面进入.','');	
	}


	
if ($_POST['submit']){
	if($_POST['admin_id']){
		$admin_update["zq1"]=$_POST['zq1'];
		$admin_update["zq2"]=$_POST['zq2'];
		$admin_update["zq3"]=$_POST['zq3'];
		$admin_update["zq4"]=$_POST['zq4'];
		$admin_update["zq5"]=$_POST['zq5'];
		$admin_update["zq6"]=$_POST['zq6'];
		$admin_update["zq7"]=$_POST['zq7'];
		//$admin_update["zq8"]=$_POST['zq8'];
		//$admin_update["zq9"]=$_POST['zq9'];
		//$admin_update["zq10"]=$_POST['zq10'];
		$admin_update["q1"]=intval($_POST['q1']);
		$admin_update["q2"]=intval($_POST['q2']);
		$admin_update["q3"]=intval($_POST['q3']);
		$admin_update["q4"]=intval($_POST['q4']);
		$admin_update["q5"]=intval($_POST['q5']);
		$admin_update["q6"]=intval($_POST['q6']);
		$admin_update["q7"]=intval($_POST['q7']);
		$admin_update["q8"]=intval($_POST['q8']);
		$admin_update["q9"]=intval($_POST['q9']);
		$admin_update["q10"]=intval($_POST['q10']);
		$admin_update["q11"]=intval($_POST['q11']);
		$admin_update["q12"]=intval($_POST['q12']);
		$admin_update["q13"]=intval($_POST['q13']);
		$admin_update["q14"]=intval($_POST['q14']);
		$admin_update["q15"]=intval($_POST['q15']);
		$admin_update["q16"]=intval($_POST['q16']);
		$admin_update["q17"]=intval($_POST['q17']);
		$admin_update["q18"]=intval($_POST['q18']);
		$admin_update["q19"]=intval($_POST['q19']);
		$admin_update["q20"]=intval($_POST['q20']);
		$admin_update["q21"]=intval($_POST['q21']);
		$admin_update["q22"]=intval($_POST['q22']);
		$admin_update["q23"]=intval($_POST['q23']);
		$admin_update["q24"]=intval($_POST['q24']);
		$admin_update["q25"]=intval($_POST['q25']);
		$_admin->admin_update($admin_update,$_POST['admin_id']);
		alert("权限修改成功.","?");
	}else{
		alert("提交错误,请重新再试.","admin_Administrator.php");	
	}
}
function display($qx){
	$sx="style='display:none'";
	if($qx==1){
		$sx="";
	}
	return $sx;
}

function checked($qx){
	if($qx==1){
		return "checked";
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>设置权限</title>
<script language="javascript">
<!--
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" >
<table  width="100%" height="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
	<tr>
    <td colspan="2" align="center">管理员<?=$admin_us['loginname']?>权限设置<input name="admin_id" type="hidden" value="<?=$admin_us['id']?>"></td>
    </tr>
    <tr>
    <td width="50%" align="right">会员管理：</td>
    <td width="50%" align="left">
    <input type="radio" name="zq1" id="zq1" value="0" checked>
        否
    <input name="zq1" type="radio" id="zq1" value="1"  <?=checked($zq1)?>>
      是
     </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">财务管理：</td>
    <td width="50%" align="left"><input type="radio" name="zq2" id="zq2" value="0" checked>
否
  <input name="zq2" type="radio" id="zq2" value="1"  <?=checked($zq2)?>>
是 </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">数据统计：</td>
    <td width="50%" align="left"><input type="radio" name="zq3" id="zq3" value="0" checked>
否
  <input name="zq3" type="radio" id="zq3" value="1"  <?=checked($zq3)?>>
是 </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">商城管理：</td>
    <td width="50%" align="left">
    <input type="radio" name="zq4" id="zq4" value="0" checked>
否
  <input name="zq4" type="radio" id="zq4" value="1"  <?=checked($zq4)?>>
是 </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">信息管理：</td>
    <td width="50%" align="left"><input type="radio" name="zq5" id="zq5" value="0" checked>
否
  <input name="zq5" type="radio" id="zq5" value="1"  <?=checked($zq5)?>>
是 </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">系统设置：</td>
    <td width="50%" align="left"><input type="radio" name="zq6" id="zq6" value="0" checked>
否
  <input name="zq6" type="radio" id="zq6" value="1"  <?=checked($zq6)?>>
是 </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">数据管理：</td>
    <td width="50%" align="left"><input type="radio" name="zq7" id="zq7" value="0" checked>
否
  <input name="zq7" type="radio" id="zq7" value="1"  <?=checked($zq7)?>>
是 </td>
  </tr>
  <tr id="qx1" <?=display($zq1)?>>
    <td colspan="2" align="center">
    	<input name="q1" type="checkbox" id="q1" value="1" <?=checked($q1)?>>
     	激活会员
        <input name="q2" type="checkbox" id="q2" value="1" <?=checked($q2)?>>
        正式会员
        <input name="q3" type="checkbox" id="q3" value="1" <?=checked($q3)?>>
        服务中心
    </td>
  </tr>
  <tr id="qx2" <?=display($zq2)?>>
    <td colspan="2" align="center">
    <input name="q4" type="checkbox" id="q4" value="1" <?=checked($q4)?>>
	提现管理
    <input name="q5" type="checkbox" id="q5" value="1" <?=checked($q5)?>>
    充值管理
    <input name="q6" type="checkbox" id="q6" value="1" <?=checked($q6)?>>
    汇款通知
    <input name="q7" type="checkbox" id="q7" value="1" <?=checked($q7)?>>
	转账记录
	<input name="q8" type="checkbox" id="q8" value="1" <?=checked($q8)?>>
	转换记录</td>
    </tr>
    <tr id="qx3" <?=display($zq3)?>>
    <td colspan="2" align="center">
    <input name="q26" type="checkbox" id="q26" value="1" <?=checked($q26)?>>
	奖金结算
    <input name="q9" type="checkbox" id="q9" value="1" <?=checked($q9)?>>
	奖金查询
    <input name="q10" type="checkbox" id="q10" value="1" <?=checked($q10)?>>
    会员统计
    <input name="q11" type="checkbox" id="q11" value="1" <?=checked($q11)?>>
    收支统计</td>
    </tr>
    <tr id="qx4" <?=display($zq4)?>>
    <td colspan="2" align="center">
    <input name="q12" type="checkbox" id="q12" value="1" <?=checked($q12)?>>
	添加商品
    <input name="q13" type="checkbox" id="q13" value="1" <?=checked($q13)?>>
    商品管理
    <input name="q14" type="checkbox" id="q14" value="1" <?=checked($q14)?>>
    订单管理</label></td>
    </tr>
    <tr id="qx5" <?=display($zq5)?>>
    <td colspan="2" align="center">
    <input name="q15" type="checkbox" id="q15" value="1" <?=checked($q15)?>>
    添加新闻
    <input name="q16" type="checkbox" id="q16" value="1" <?=checked($q16)?>>
    新闻管理
    <input name="q17" type="checkbox" id="q17" value="1" <?=checked($q17)?>>
    站内短信
  	<input name="q18" type="checkbox" id="q18" value="1" <?=checked($q18)?>>
	公司简介
 	<input name="q19" type="checkbox" id="q19" value="1" <?=checked($q19)?>>
 	奖金制度
 	<input name="q20" type="checkbox" id="q20" value="1" <?=checked($q20)?>>
 	公司账户
</td>
    </tr>
    <tr id="qx6" <?=display($zq6)?>>
    <td colspan="2" align="center">
    <input name="q21" type="checkbox" id="q21" value="1" <?=checked($q21)?>>
	会员设置
    <input name="q22" type="checkbox" id="q22" value="1" <?=checked($q22)?>>
    参数设置
    <input name="q23" type="checkbox" id="q23" value="1" <?=checked($q23)?>>
    电子邮件</td>
    </tr>
  <tr id="qx7" <?=display($zq7)?>>
    <td colspan="2" align="center">
    <input name="q24" type="checkbox" id="q24" value="1" <?=checked($q24)?>>
	数据备份
    <input name="q25" type="checkbox" id="q25" value="1" <?=checked($q25)?>>
    清空数据</td>
    </tr>
  <tr>
    <td colspan="2" align="center">
      <table align="center">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="btn2" value="修改">
            <input name="" type="reset" class="btn3" value="重置"></td>
          </tr>
        </table>
      
      </td>
  </tr>
</table>
</form>
</body>
</html>