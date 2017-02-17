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
$us=que_select_cl('member',$_SESSION['ID']);
if ($_POST['submit']){
	if ($sus=getMemberbyNickName($_POST['snickname'])){
		if($sus['id']==$us['id']){
			echo "<script language=javascript>alert('不能给自己转账.');window.location.href='?'</script>";	
		}else{
			$jine=intval($_POST['jine'], 10);
			$lx=$_POST['lx'];
			if ($jine>0 and is_int($jine)){
				if ($lx==0){
					if ($us['zsq']>=$jine){
						$us_update['zsq']=$us['zsq']-$jine;
						$sus_update['zsq']=$sus['zsq']+$jine;
					}else{
						echo "<script language=javascript>alert('您的余额不足,无法转账.');window.location.href='?'</script>";		
					}
				}elseif($lx==1){
					if ($us['yxb']>=$jine){
						$us_update['yxb']=$us['yxb']-$jine;
						$sus_update['yxb']=$sus['yxb']+$jine;
					}else{
						echo "<script language=javascript>alert('您的余额不足,无法转账.');window.location.href='?'</script>";		
					}	
				}elseif($lx==2){
					if ($us['mey']>=$jine){
						$us_update['mey']=$us['mey']-$jine;
						$sus_update['mey']=$sus['mey']+$jine;
					}else{
						echo "<script language=javascript>alert('您的余额不足,无法转账.');window.location.href='?'</script>";		
					}	
				}
				edit_update_cl('member',$us_update,$us['id']);
				edit_update_cl('member',$sus_update,$sus['id']);
				
				$zhuanzhang['uid']=$us['id'];
				$zhuanzhang['nickname']=$us['nickname'];
				$zhuanzhang['username']=$us['username'];
				$zhuanzhang['sid']=$sus['id'];
				$zhuanzhang['snickname']=$sus['nickname'];
				$zhuanzhang['susername']=$sus['username'];
				$zhuanzhang['jine']=$jine;
				$zhuanzhang['zdate']=now();
				$zhuanzhang['lx']=$lx;
				echo add_insert_cl('zhuanzhang',$zhuanzhang);
				echo "<script language=javascript>alert('转账成功.\\n转入会员:".$sus['nickname']."\\n转账金额:".$jine."');window.location.href='?'</script>";	
			}else{
				echo "<script language=javascript>alert('转账金额不正确,请确认后重新转账');window.location.href='?'</script>";	
			}
		}
	}else{
			echo "<script language=javascript>alert('该会员不存在,请确认后重新转账');window.location.href='?'</script>";	
	}
}

if ($_GET['action']=="que" and $_GET['zid']!=""){
	$zj=que_select_cl("zhuanzhang",$_GET['zid']);
	if ($zj['isqr']==0){
		$sus=getMemberbyID($zj['sid']);
		$sus_update['zsq']=$sus['zsq']+$zj['jine'];
		$zj_update['isqr']=1;
		edit_update_cl('member',$sus_update,$sus['id']);
		edit_update_cl('zhuanzhang',$zj_update,$zj['id']);
		echo "<script language=javascript>alert('确认完成.');window.location.href='?'</script>";	
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>货币转帐</title>
<script language="javascript">
<!--
function CheckForm(){
	jine=document.form1.jine.value;
	snickname=document.form1.snickname.value;
	if(snickname.length == 0){
		alert("温馨提示:\n请输入转入会员.");
		document.form1.snickname.focus();
		return false;
	}
	if(jine.length == 0){
		alert("温馨提示:\n请输入转帐金额.");
		document.form1.jine.focus();
		return false;
	}
	if(jine <= 0){
		alert("温馨提示:\n转帐金额必须大于0.");
		document.form1.jine.focus();
		return false;
	}
	return true;
}
function checknickname(lx)
{
	var iframe = document.getElementById("iframe");
	var user =  document.getElementById("snickname");
	iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
}
-->
</script>
</head>
<body>

<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
<!--    <tr>
    <td width="46%" height="22" align="right">电子币：</td>
    <td width="54%" align="left"><?=$us['zsq']?></td>
  </tr>
  <tr>
    <td width="46%" height="22" align="right">游戏币：</td>
    <td width="54%" align="left"><?=$us['yxb']?></td>
  </tr>-->
	<tr>
    <td width="46%" height="22" align="right"><?=$zhuanzhang1?>：</td>
    <td width="54%" align="left"><?=$us['mey']?></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$zhuanzhang2?>
      ：</td>
    <td align="left"><input name="snickname" type="text" id="snickname" size="10" maxlength="20">
      <input name="button4" type="button" class="button_blue" id="button4" onclick='checknickname(5);' value="<?=$anniu6?>"><iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe></td>
  </tr>
  <tr>
    <td width="46%" height="22" align="right"><?=$zhuanzhang3?>
      ：</td>
    <td width="54%" align="left">
      <select name="lx" id="lx">
        <!--<option value="0">电子币</option>
        <option value="1">游戏币</option>-->
        <option value="2"><?=$zhuanzhang1?></option>
      </select></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$zhuanzhang4?>
      ：</td>
    <td align="left"><input name="jine" type="text" id="jine" size="10" maxlength="10"></td>
  </tr>
</table>
<table align="center">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="button_green" value="<?=$anniu1?>"></td>
        </tr>
  </table>
<br>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="7" align="center"><?=$zhuanzhang5?></td>
      </tr>
      <tr>
        <td align="center"><?=$zhuanzhang6?></td>
        <td align="center"><?=$zhuanzhang7?></td>
        <td align="center"><?=$zhuanzhang8?></td>
        <td align="center"><?=$zhuanzhang9?></td>
        <td align="center"><?=$zhuanzhang10?></td>
        
        <td align="center"><?=$zhuanzhang11?></td>
        <td align="center"><?=$zhuanzhang12?></td>
        <td style="display:none" align="center">状态</td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `zhuanzhang` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']."";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码 
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `zhuanzhang` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=$row['susername']?></td>
        <td align="center"><?=$row['jine']?></td>
		<td  align="center"><?php if ($row['lx']==2){?>奖金<?php }elseif($row['lx']==1){?>购物币<?php }?></td>
        <td align="center"><?=$row['zdate']?></td>
        <td style="display:none" align="center"><?php if($row['isqr']==0){if($row['uid']==$_SESSION['ID']){?>未确认<?php }else{ ?><a href="?action=que&zid=<?=$row['id']?>">未确认</a><?php } }else{?>已确认<?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
  </table>
  <table width="100%" border="0" class="ziti">
          <tr>
            <td align="left">&nbsp;</td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table>
</form>
</body>
</html>