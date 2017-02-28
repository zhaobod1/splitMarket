<?php
include("check.php");
include("check2.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$us=GetMemberbyID($_SESSION['ID']);
if ($_POST['submit']){
	if ($sus=GetMemberbyNickname($_POST['nickname'])){
		if ($sus['ulevel']<$_POST['uplv']){
			$sql="select count(*) from `ulevelup` where sid=".$sus['id']." and issh=0";
			$query = mysql_query($sql);
			$upcount=mysql_fetch_array($query);
				if($upcount[0] >= 1){
					echo "<script language=javascript>alert('该会员的申请尚未通过审核,请耐心等待.');window.location.href='?'</script>";	
				}else{
					$_yul=ulevel($sus['ulevel']);
					$_uul=ulevel($_POST['uplv']);
					$ulevelup['cha']=$_uul['lsk']-$_yul['lsk'];
					if($us['zsq']>=$ulevelup['cha']){
						$ulevelup['uid']=$_SESSION['ID'];
						$ulevelup['nickname']=$us['nickname'];
						$ulevelup['username']=$us['username'];
						$ulevelup['ylevel']=$sus['ulevel'];
						$ulevelup['uplevel']=$_POST['uplv'];
						$ulevelup['bdid']=$us['bdid'];
						$ulevelup['bdname']=$us['bdname'];
						$ulevelup['sid']=$sus['id'];
						$ulevelup['snickname']=$sus['nickname'];
						$ulevelup['susername']=$sus['username'];
						$ulevelup['udate']=now();
						$us_update['zsq']=$us['zsq']-$ulevelup['cha'];
						add_insert_cl('ulevelup',$ulevelup);
						edit_update_cl('member',$us_update,$us['id']);
						echo "<script language=javascript>alert('申请完成,请耐心等待管理员审核.');window.location.href='?'</script>";	
					}else{
						echo "<script language=javascript>alert('您的激活币余额不足.');window.location.href='?'</script>";	
					}
			}
			
		}else{
			echo "<script language=javascript>alert('申请级别错误,该会员的级别已经超过所申请级别.');window.location.href='?'</script>";		
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
<title>升级申请</title>
<script language="javascript">
<!--
function checknickname(lx)
{
	var iframe = document.getElementById("iframe");
	var user =  document.getElementById("nickname");
	iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
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
  <td align="right">升级会员编号:</td>
  <td><input name="nickname" id="nickname" type="text">
    <input name="button4" type="button" class="button_blue" id="button4" onclick='checknickname(6);' value="验  证"><iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe></td>
  </tr>
  <tr>
    <td width="46%" height="22" align="right">申请升级：</td>
    <td width="54%" align="left">
      <select name="uplv" id="uplv">
      	<?php
        	$ul2=ulevel(2);
			$ul3=ulevel(3);
			$ul4=ulevel(4);
			$ul5=ulevel(5);
		?>
        <option value="2"><?=$ul2['lvname']?></option>
        <option value="3"><?=$ul3['lvname']?></option>
        <option value="4"><?=$ul4['lvname']?></option>
        <option value="5"><?=$ul5['lvname']?></option>
      </select></td>
  </tr>
</table>
<table align="center" class="ziti">
        <tr>
          <td><input name="submit" id="submit" type="submit" class="button_green" value="申 请 升 级" onClick="javascript:return confirm('您确认申请升级吗？');"></td>
        </tr>
      </table>
<br>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
        <td height="20" colspan="9" align="center"> 申 请 记 录</td>
      </tr>
      <tr>
     	
        <td align="center">升级会员编号</td>
        <td align="center">升级会员姓名</td>
        <td align="center">原级别</td>
        <td align="center">申请级别</td>
        <td align="center">补单金额</td>
        <td align="center">申请时间</td>
        <td align="center">操作人编号</td>
      	<td align="center">操作人姓名</td>
        <td align="center">审核状态</td>
    </tr>
      <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `ulevelup` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']."";
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
      	$sql = "SELECT * FROM `ulevelup` WHERE uid=".$_SESSION['ID']." or sid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$yul=ulevel($row['ylevel']);
			$uul=ulevel($row['uplevel']);
	  ?>
      <tr>
        
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=$row['susername']?></td>
        <td align="center"><?=$yul['lvname']?></td>
        <td align="center"><?=$uul['lvname']?></td>
        <td align="center"><?=$row['cha']?></td>
        <td align="center"><?=$row['udate']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?php if ($row['issh']==1){?>通过审核<?php }else{?> <font color="#FF0000">未审核</font><?php }?></td>
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