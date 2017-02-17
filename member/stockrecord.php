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
if ($_POST['submit']){
	$uid=$_SESSION['ID'];
	$jine=$_POST['jine'];
	if ($jine>0){
		$chongzhi['uid']=$uid;
		$chongzhi['nickname']=$_SESSION['nickname'];
		$chongzhi['username']=$_SESSION['username'];
		$chongzhi['jine']=$jine;
		$chongzhi['cdate']=now();
		$chongzhi['sdate']=now();
		$chongzhi['lx']=$_POST['lx'];
		echo add_insert_cl('chongzhi',$chongzhi);
		$_email=new email_class();
		$email=$_email->getemail();
		if ($email['cztzadmin']==1){
			$title="会员充值申请";
			$content="管理员您好,会员".$chongzhi['nickname']."于".now()."向公司申请充值：".$jine."元";
			$_email->sendemail($email['emailuser'],$email['emailname'],$title,$content);
		}
		
		echo "<script language=javascript>alert('您的充值申请已经提交,请耐心等待审核.\\n本次申请充值金额:".$jine."');window.location.href='?'</script>";
	}else{
		echo "<script language=javascript>alert('申请金额不正确,请确认后重新申请');window.location.href='?'</script>";	
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>充值申请</title>
<script language="javascript">
<!--
function CheckForm(){
	jine=document.form1.jine.value;
	if(jine.length == 0){
		alert("温馨提示:\n请输入充值金额.");
		document.form1.jine.focus();
		return false;
	}
	if(jine <= 0){
		alert("温馨提示:\n申请金额必须大于0.");
		document.form1.jine.focus();
		return false;
	}
	return true;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="8" align="center"><?=$jiaoyijilu1?></td>
      </tr>
      <tr>
        <td align="center"><?=$jiaoyijilu2?></td>
        <td align="center"><?=$jiaoyijilu3?></td>
        <td align="center"><?=$jiaoyijilu4?></td>
        <td align="center"><?=$jiaoyijilu5?></td>
        <td align="center"><?=$jiaoyijilu6?></td>
        <td align="center"><?=$jiaoyijilu7?></td>
        <td align="center"><?=$jiaoyijilu8?></td>
        <td align="center"><?=$jiaoyijilu9?></td>
        
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockrecord` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `stockrecord` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center">
		<?php if ($row['lx']==0){?><?=$weituo7?><?php }elseif($row['lx']==1){?><?=$weituo8?><?php }?></td>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=round($row['num'])?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['price']*$row['num']?></td>
        <td align="center"><?=$row['price']*$row['num']*0.1?></td>
        <td align="center"><?=$row['sdate']?></td>
		
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