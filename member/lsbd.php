<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/ulevel_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$us=GetMemberbyID($_SESSION['ID']);
if ($_POST['submit']){
	if ($sus=GetMemberbyNickname($_POST['nickname'])){
		if($us['zsq']>=$_POST['lsk']){
			$lsbd['uid']=$_SESSION['ID'];
			$lsbd['nickname']=$us['nickname'];
			$lsbd['username']=$us['username'];
			$lsbd['sid']=$sus['id'];
			$lsbd['snickname']=$sus['nickname'];
			$lsbd['susername']=$sus['username'];
			$lsbd['bdate']=now();
			$lsbd['lsk']=$_POST['lsk'];
			add_insert_cl('lsbd',$lsbd);
			
			$us_update['zsq']=$us['zsq']-$_POST['lsk'];
			$_ulevel_class=new ulevel_class();
			$_ul=$_ulevel_class->getulevelbyulevel($us['ulevel']);
			$b5=$_ul['yl6']/100*$_POST['lsk'];
			$us_update['b5']=$us['b5']+$b5;
			edit_update_cl('member',$us_update,$us['id']);
			
			$_bonus=new bonus_class();
			$_bonus->b4bonus($sus['id'],$_POST['lsk']);
			$_bonus->xlevelup();
			$_bonus->addcfxf();
			$_bonus->b3bonus();
			$_bonus->b0bonus();
			
			echo "<script language=javascript>alert('零售报单完成.');window.location.href='?'</script>";	
		}else{
			echo "<script language=javascript>alert('您的激活币余额不足.');window.location.href='?'</script>";	
		}
	}else{
		echo "<script language=javascript>alert('该会员不存在,请确认后重新输入.');window.location.href='?'</script>";	
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>零售报单</title>
<script language="javascript">
<!--
function checknickname(lx)
{
	var iframe = document.getElementById("iframe");
	var user =  document.getElementById("nickname");
	iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
}
function CheckForm(){
	var lsk =  document.getElementById("lsk");
	if (lsk.value=="" || lsk.value==0){
		alert("报单金额请输入0以上的数字");
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table  width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
	<tr>
  <td align="right">激活币余额:</td>
  <td><?=$us['zsq']?></td>
  </tr>
  <tr>
  <td align="right">报单会员编号:</td>
  <td><input name="nickname" id="nickname" type="text">
    <input name="button4" type="button" class="button_blue" id="button4" onclick='checknickname(7);' value="验  证"><iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe></td>
  </tr>
  <tr>
    <td width="46%" height="22" align="right">报单金额：</td>
    <td width="54%" align="left"><input name="lsk" id="lsk" type="text" value="0"></td>
  </tr>
</table>
<table align="center" class="ziti">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="button_green" value="提 交 报 单" onClick="javascript:return confirm('确认提交报单吗？');"></td>
        </tr>
      </table>
<br>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="9" align="center"> 报 单 记 录</td>
      </tr>
      <tr>
        <td align="center">报单会员编号</td>
        <td align="center">报单会员姓名</td>
        <td align="center">报单金额</td>
        <td align="center">报单时间</td>
        <td align="center">操作人编号</td>
      	<td align="center">操作人姓名</td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `lsbd` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `lsbd` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$yul=ulevel($row['ylevel']);
			$uul=ulevel($row['uplevel']);
	  ?>
      <tr>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=$row['susername']?></td>
        <td align="center"><?=$row['lsk']?></td>
        <td align="center"><?=$row['bdate']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
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