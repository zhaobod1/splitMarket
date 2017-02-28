<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/email_class.php");
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
		$jine=$_POST['jine'];
		if ($jine>0){
			$huikuan['uid']=$us['id'];
			$huikuan['nickname']=$us['nickname'];
			$huikuan['username']=$us['username'];
			$huikuan['bankcard']=$_POST['bankcard'];
			$huikuan['bankusername']=$_POST['bankusername'];
			$huikuan['sid']=$sus['id'];
			$huikuan['snickname']=$sus['nickname'];
			$huikuan['jine']=$jine;
			$huikuan['shuoming']=$_POST['shuoming'];
			$huikuan['hdate']=now();
			$huikuan['sdate']=$_POST['sdate'];
			echo add_insert_cl('huikuan',$huikuan);
			$_email=new email_class();
			$email=$_email->getemail();
			if ($email['hktzadmin']==1){
				$title="汇款通知";
				$content="管理员您好,会员".$huikuan['nickname']."于".now()."向公司提交汇款通知,汇款金额：".$jine."元";
				$_email->sendemail($email['emailuser'],$email['emailname'],$title,$content);
			}
			
			echo "<script language=javascript>alert('汇款通知已经提交.');window.location.href='?'</script>";	
		}else{
			echo "<script language=javascript>alert('金额不正确,请重新填写');window.location.href='?'</script>";	
		}
	}else{
			echo "<script language=javascript>alert('该会员不存在,请确认后重新填写');window.location.href='?'</script>";	
	}
}

if ($_GET['action']=="del" and $_GET['hid']!=""){
	$hk=que_select_cl("huikuan",$_GET['hid']);
	if ($hk['isgrant']==0){
		edit_delete_cl('huikuan',$_GET['hid']);	
		echo "<script language=javascript>alert('删除完成.');window.location.href='?'</script>";	
	}else{
		echo "<script language=javascript>alert('汇款通知已确认,删除失败.');window.location.href='?'</script>";		
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="../js/settime.js"></script>
<title>汇款通知</title>
<script language="javascript">
<!--
function CheckForm(){
	jine=document.form1.jine.value;
	snickname=document.form1.snickname.value;
	bankcard=document.form1.bankcard.value;
	bankusername=document.form1.bankusername.value;
	sdate=document.form1.sdate.value;
	if(snickname.length == 0){
		alert("温馨提示:\n请输入通知会员.");
		document.form1.snickname.focus();
		return false;
	}
	if(jine.length == 0){
		alert("温馨提示:\n请输入汇款金额.");
		document.form1.jine.focus();
		return false;
	}
	if(jine <= 0){
		alert("温馨提示:\n汇款金额必须大于0.");
		document.form1.jine.focus();
		return false;
	}
	if(bankcard <= 0){
		alert("温馨提示:\n请输入汇款账户.");
		document.form1.bankcard.focus();
		return false;
	}
	if(bankusername <= 0){
		alert("温馨提示:\n请输入账户姓名.");
		document.form1.bankusername.focus();
		return false;
	}
	if(sdate <= 0){
		alert("温馨提示:\n请输入汇款时间.");
		document.form1.sdate.focus();
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
  <tr style="display:none">
    <td width="30%" height="22" align="right">通知会员：</td>
    <td width="70%" align="left"><input name="snickname" type="text" id="snickname" size="10" maxlength="20" value="<?=$us['bdname']?>"></td>
  </tr>
  <tr>
    <td width="30%" height="22" align="right"><?=$huikuan1?>：</td>
    <td width="70%" align="left"><input name="jine" type="text" id="jine" size="10" maxlength="10"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$huikuan2?>
      ：</td>
    <td align="left"><input name="bankcard" type="text" id="bankcard" size="20" maxlength="20"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$huikuan3?>
      ：</td>
    <td align="left"><input name="bankusername" type="text" id="bankusername" size="20" maxlength="20"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$huikuan4?>
      ：</td>
    <td align="left"><input name="sdate" type="text" id="sdate" size="20" maxlength="20" value="<?=now()?>"  readonly  onclick="_SetTime(this)"></td>
  </tr>
  <tr>
    <td height="22" align="right"><?=$huikuan5?>
      ：</td>
    <td align="left">
      <textarea name="shuoming" id="shuoming" cols="45" rows="5"></textarea>      
      <br>
      (
      <?=$huikuan6?>
      )</td>
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
        <td height="20" colspan="7" align="center"><?=$huikuan7?></td>
      </tr>
      <tr>
        <td style="display:none" align="center">会员编号</td>
        <td align="center"><?=$huikuan2?></td>
        <td align="center"><?=$huikuan3?></td>
        <td align="center"><?=$huikuan1?></td>
        <td align="center"><?=$huikuan4?></td>
        <td align="center"><?=$huikuan5?></td>
        <td align="center"><?=$huikuan8?></td>
        <td style="display:none" align="center">服务中心</td>
        <td align="center"><?=$huikuan9?></td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `huikuan` WHERE uid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `huikuan` WHERE uid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      
        <td style="display:none" align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['bankcard']?></td>
        <td align="center"><?=$row['bankusername']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['sdate']?></td>
        <td align="center"><?=$row['shuoming']?></td>
        <td align="center"><?=$row['hdate']?></td>
        <td style="display:none" align="center"><?=$row['snickname']?></td>
		<td align="center"><?php if ($row['isgrant']==0){?><a href="?action=del&hid=<?=$row['id']?>" onClick="{if(confirm('确认删除此条汇款记录吗?')){return true;}return false;}"><?=$anniu3?></a><?php }elseif($row['isgrant']==1){?>
		  已确认<?php }?></td>
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