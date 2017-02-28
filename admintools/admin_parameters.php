<?php
include("admin_check.php");
include_once("../class/system_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(6,22);
	$_system=new system_class();
	$systemparameters=$_system->system_information(1);
	
	
if($_POST['button']){
		$_system=new system_class();
		$systemparameters['id']=1;
		$systemparameters['qzbs']=$_POST['qzbs'];
		$systemparameters['txbs']=$_POST['txbs'];
		$systemparameters['txmix']=$_POST['txmix'];
		$systemparameters['txsl']=$_POST['txsl'];
		$systemparameters['wlf']=$_POST['wlf'];
		$systemparameters['xtkg']=$_POST['xtkg'];
		$systemparameters['ispe']=$_POST['ispe'];
		$systemparameters['azkg']=$_POST['azkg'];
		$systemparameters['tjkg']=$_POST['tjkg'];
		$systemparameters['ziliao']=$_POST['ziliao'];
		$systemparameters['ff']=$_POST['ff'];
		$systemparameters['ms']=$_POST['ms'];
		$systemparameters['bdbonus']=$_POST['bdbonus'];
		$systemparameters['isb2']=$_POST['isb2'];
		$systemparameters['isb3']=$_POST['isb3'];
		$systemparameters['qq1']=$_POST['qq1'];
		$systemparameters['qq2']=$_POST['qq2'];
		$systemparameters['qq3']=$_POST['qq3'];
		$systemparameters['qq4']=$_POST['qq4'];
		$systemparameters['password1']=$_POST['password1'];
		$systemparameters['password2']=$_POST['password2'];
		$systemparameters['sl']=$_POST['sl'];
		$systemparameters['duanxinzhanghao']=$_POST['duanxinzhanghao'];
		$systemparameters['duanxinmima']=$_POST['duanxinmima'];
		
		
		$_system->system_update($systemparameters);
		
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
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="3" align="center">系统参数</td>
      </tr>
      <tr>
        <td align="center">强制卖出倍数</td>
        <td align="center"><input name="qzbs" type="text" id="qzbs" value="<?=$systemparameters['qzbs']?>" size="7" maxlength="7"></td>
      </tr>
      <tr>
        <td align="center">提现倍数</td>
        <td align="center"><input name="txbs" type="text" id="txbs" value="<?=$systemparameters['txbs']?>" size="7" maxlength="7"></td>
      </tr>
      <tr>
        <td align="center">提现最小金额</td>
        <td align="center"><input name="txmix" type="text" id="txmix" value="<?=$systemparameters['txmix']?>" size="7" maxlength="7"></td>
      </tr>
		<tr>
        <td align="center">网络维护费</td>
        <td align="center"><input name="wlf" type="text" id="wlf" value="<?=$systemparameters['wlf']?>" size="7" maxlength="7"></td>
      </tr>
       <tr>
        <td align="center">提现手续费</td>
        <td align="center"><input name="txsl" type="text" id="txsl" value="<?=$systemparameters['txsl']?>" size="5" maxlength="4">
        %</td>
      </tr>
      <tr>
        <td align="center">奖金税收</td>
        <td align="center"><input name="sl" type="text" id="sl" value="<?=$systemparameters['sl']?>" size="5" maxlength="4">
        %</td>
      </tr>
      <tr>
        <td align="center">默认一级密码</td>
        <td align="center"><input name="password1" type="text" id="password1" value="<?=$systemparameters['password1']?>" maxlength="20">
        </td>
      </tr>
      <tr>
        <td align="center">默认二级密码</td>
        <td align="center"><input name="password2" type="text" id="password2" value="<?=$systemparameters['password2']?>" maxlength="20">
        </td>
      </tr>
      <tr style="display:none">
        <td align="center">短信接口帐号</td>
        <td align="center"><input name="duanxinzhanghao" type="text" id="duanxinzhanghao" value="<?=$systemparameters['duanxinzhanghao']?>" maxlength="20">
        </td>
      </tr>
      <tr style="display:none">
        <td align="center">短信接口密码</td>
        <td align="center"><input name="duanxinmima" type="password" id="duanxinmima" value="<?=$systemparameters['duanxinmima']?>" maxlength="20">
        </td>
      </tr>
       <tr>
        <td align="center">系统开关</td>
        <td align="center"><input name="xtkg" type="radio" id="xtkg" value="1"  <?php if($systemparameters['xtkg']==1){ ?> checked <?php }?>>
          开
          <input type="radio" name="xtkg" id="xtkg" value="0" <?php if($systemparameters['xtkg']==0){ ?> checked <?php }?>>
          关
        </td>
      </tr>
      <tr>
        <td align="center">pe币交易</td>
        <td align="center"><input name="ispe" type="radio" id="ispe" value="1"  <?php if($systemparameters['ispe']==1){ ?> checked <?php }?>>
          开
          <input type="radio" name="ispe" id="ispe" value="0" <?php if($systemparameters['ispe']==0){ ?> checked <?php }?>>
          关
        </td>
      </tr>
      <tr style="display:none">
        <td align="center">推荐奖开关</td>
        <td align="center"><input type="radio" name="isb2" id="isb2" value="1" <?php if($systemparameters['isb2']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="isb2" id="isb2" value="0" <?php if($systemparameters['isb2']==0){ ?> checked <?php }?>>
    关 </td>
      </tr>
      <tr style="display:none">
        <td align="center">领导奖开关</td>
        <td align="center"><input type="radio" name="isb3" id="isb3" value="1" <?php if($systemparameters['isb3']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="isb3" id="isb3" value="0" <?php if($systemparameters['isb3']==0){ ?> checked <?php }?>>
    关 </td>
      </tr>
      <tr>
        <td align="center">安置图开关</td>
        <td align="center"><input type="radio" name="azkg" id="azkg" value="1" <?php if($systemparameters['azkg']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="azkg" id="azkg" value="0" <?php if($systemparameters['azkg']==0){ ?> checked <?php }?>>
    关 </td>
      </tr>
      <tr>
        <td align="center">推荐图开关</td>
        <td align="center"><input type="radio" name="tjkg" id="tjkg" value="1" <?php if($systemparameters['tjkg']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="tjkg" id="tjkg" value="0" <?php if($systemparameters['tjkg']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr>
        <td align="center">修改资料开关</td>
        <td align="center"><input type="radio" name="ziliao" id="ziliao" value="1" <?php if($systemparameters['ziliao']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="ziliao" id="ziliao" value="0" <?php if($systemparameters['ziliao']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      <tr style="display:none">
        <td align="center">服务中心奖金查询</td>
        <td align="center"><input type="radio" name="bdbonus" id="bdbonus" value="1" <?php if($systemparameters['bdbonus']==1){ ?> checked <?php }?>>
开
    <input type="radio" name="bdbonus" id="bdbonus" value="0" <?php if($systemparameters['bdbonus']==0){ ?> checked <?php }?>>
    关</td>
      </tr>
      
	  <tr style="display:none">
        <td align="center">服务奖方案</td>
        <td align="center">
          <select name="ff" id="ff">
            <option value="1" <?php if($systemparameters['ff']==1){?> selected <?php }?>>十代</option>
            <option value="2" <?php if($systemparameters['ff']==2){?> selected <?php }?>>十层</option>
        </select></td>
      </tr>
      
      <tr style="display:none">
        <td align="center">第三市场方案</td>
        <td align="center">
          <select name="ms" id="ms">
            <option value="1" <?php if($systemparameters['ms']==1){?> selected <?php }?>>始终开启</option>
            <option value="2" <?php if($systemparameters['ms']==2){?> selected <?php }?>>不开启</option>
            <option value="3" <?php if($systemparameters['ms']==3){?> selected <?php }?>>一星以上开启</option>
            <option value="4" <?php if($systemparameters['ms']==4){?> selected <?php }?>>二星以上开启</option>
            <option value="5" <?php if($systemparameters['ms']==5){?> selected <?php }?>>三星以上开启</option>
            <option value="6" <?php if($systemparameters['ms']==6){?> selected <?php }?>>四星以上开启</option>
            <option value="7" <?php if($systemparameters['ms']==7){?> selected <?php }?>>五星以上开启</option>
            <option value="8" <?php if($systemparameters['ms']==8){?> selected <?php }?>>一总以上开启</option>
            <option value="9" <?php if($systemparameters['ms']==9){?> selected <?php }?>>二总以上开启</option>
            <option value="10" <?php if($systemparameters['ms']==10){?> selected <?php }?>>三总以上开启</option>
            <option value="11" <?php if($systemparameters['ms']==11){?> selected <?php }?>>四总以上开启</option>
            <option value="12" <?php if($systemparameters['ms']==12){?> selected <?php }?>>五总以上开启</option>
          </select></td>
      </tr>
      
      <tr>
        <td align="center">在线客服1</td>
        <td align="center"><input name="qq1" type="text" id="qq1" value="<?=$systemparameters['qq1']?>" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td align="center">在线客服2</td>
        <td align="center"><input name="qq2" type="text" id="qq2" value="<?=$systemparameters['qq2']?>" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td align="center">在线客服3</td>
        <td align="center"><input name="qq3" type="text" id="qq3" value="<?=$systemparameters['qq3']?>" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td align="center">在线客服4</td>
        <td align="center"><input name="qq4" type="text" id="qq4" value="<?=$systemparameters['qq4']?>" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><input name="button" type="submit" class="btn2" id="button" value="保存"></td>
      </tr>
    </table>
</form>
</body>
</html>