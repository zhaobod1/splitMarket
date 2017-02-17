<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/system_class.php");

if ($_GET['action']=="admin"){
	$ID=$_GET['ID'];
}else{
	$_system=new system_class();
	if ($_system->system_wlt()!=1){
		echo "<script language=javascript>alert('您没有查看网络结构的权限.');window.location.href='member.php'</script>";	
	}
	
	if ($_POST['submin']){
		if ($chaus=getMemberbyNickName($_POST['nickname'])){
			if(checkisppath($_SESSION['ID'],$chaus['id'])){
				$ID=$chaus['id'];
			}else{
				echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";		
			}
		}else{
			echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";	
		}
	}else{
		if ($_GET['ID'] == null){
			$ID=$_SESSION['ID'];
		}elseif($_GET['ID'] == $_SESSION['ID']){
			$ID=$_SESSION['ID'];
		}else{
			if(checkisppath($_SESSION['ID'],$_GET['ID'])){
				$ID=$_GET['ID'];
			}else{
				echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";		
			}
		}	
	}
}



	$ispay="#1B6DA2";
	$nopay="#FFFF00";
	$nore="#A3CDF8";
	session_start();
	$us=getMemberbyID($ID);
	$UserID=$us['userid'];
	$NickName=$us['nickname'];
	$UserName=$us['username'];
	$uLevel=$us['ulevel'];
	$area1=$us['area1'];
	$area2=$us['area2'];
	$yarea1=$us['yarea1'];
	$yarea2=$us['yarea2'];
	$rname=$us['rname'];
	$ul=ulevel($uLevel);
	$jibie=$ul['lvname'];
	if ($us['ispay']==0){
		$usispaycolor=$nopay;	
	}else{
		$usispaycolor=$ispay;		
	}
	//A区
	if ($p1=getFatherManbyFidAndTreeplace($ID,1)){
		$p1NickName="<a href='?ID=".$p1['id']."'>".$p1['nickname']."</a>";
		$ul=ulevel($p1['ulevel']);
		$p1jibie=$ul['lvname'];
		$p1rname=$p1['rname'];
		$p1area1=$p1['area1'];
		$p1area2=$p1['area2'];
		$p1yarea1=$p1['yarea1'];
		$p1yarea2=$p1['yarea2'];
		if ($p1['ispay']==0){
			$p1ispaycolor=$nopay;	
		}else{
			$p1ispaycolor=$ispay;		
		}
	}else{
		$p1NickName="<a href='register.php?nickname=".$NickName."&tid=1'>注册</a>";
		$p1jibie="空位";
		$p1area1=0;
		$p1area2=0;
		$p1yarea1=0;
		$p1yarea2=0;
	}
	//AA区
	if ($p11=getFatherManbyFidAndTreeplace($p1['id'],1)){
		$p11NickName="<a href='?ID=".$p11['id']."'>".$p11['nickname']."</a>";
		$ul=ulevel($p11['ulevel']);
		$p11jibie=$ul['lvname'];
		$p11rname=$p11['rname'];
		$p11area1=$p11['area1'];
		$p11area2=$p11['area2'];
		$p11yarea1=$p11['yarea1'];
		$p11yarea2=$p11['yarea2'];
		if ($p11['ispay']==0){
			$p11ispaycolor=$nopay;	
		}else{
			$p11ispaycolor=$ispay;		
		}
	}else{
		if ($p1['id']==null){
			$p11NickName="注册";	
		}else{
			$p11NickName="<a href='register.php?nickname=".$p1['nickname']."&tid=1'>注册</a>";	
		}	
		$p11jibie="空位";
		$p11area1=0;
		$p11area2=0;
		$p11yarea1=0;
		$p11yarea2=0;
	}
	//AB区
	if ($p12=getFatherManbyFidAndTreeplace($p1['id'],2)){
		$p12NickName="<a href='?ID=".$p12['id']."'>".$p12['nickname']."</a>";
		$ul=ulevel($p12['ulevel']);
		$p12jibie=$ul['lvname'];
		$p12rname=$p12['rname'];
		$p12area1=$p12['area1'];
		$p12area2=$p12['area2'];
		$p12yarea1=$p12['yarea1'];
		$p12yarea2=$p12['yarea2'];
		if ($p12['ispay']==0){
			$p12ispaycolor=$nopay;	
		}else{
			$p12ispaycolor=$ispay;		
		}
	}else{
		if ($p1['id']==null){
			$p12NickName="注册";	
		}else{
			$p12NickName="<a href='register.php?nickname=".$p1['nickname']."&tid=2'>注册</a>";	
		}	
		$p12jibie="空位";
		$p12area1=0;
		$p12area2=0;
		$p12yarea1=0;
		$p12yarea2=0;
	}
	//B区
	if ($p2=getFatherManbyFidAndTreeplace($ID,2)){
		$p2NickName="<a href='?ID=".$p2['id']."'>".$p2['nickname']."</a>";
		$ul=ulevel($p2['ulevel']);
		$p2jibie=$ul['lvname'];
		$p2rname=$p2['rname'];
		$p2area1=$p2['area1'];
		$p2area2=$p2['area2'];
		$p2yarea1=$p2['yarea1'];
		$p2yarea2=$p2['yarea2'];
		if ($p2['ispay']==0){
			$p2ispaycolor=$nopay;	
		}else{
			$p2ispaycolor=$ispay;		
		}
	}else{
		$p2NickName="<a href='register.php?nickname=".$NickName."&tid=2'>注册</a>";
		$p2jibie="空位";
		$p2area1=0;
		$p2area2=0;
		$p2yarea1=0;
		$p2yarea2=0;
	}
	//BA区
	if ($p21=getFatherManbyFidAndTreeplace($p2['id'],1)){
		$p21NickName="<a href='?ID=".$p21['id']."'>".$p21['nickname']."</a>";
		$ul=ulevel($p21['ulevel']);
		$p21jibie=$ul['lvname'];
		$p21rname=$p21['rname'];
		$p21area1=$p21['area1'];
		$p21area2=$p21['area2'];
		$p21yarea1=$p21['yarea1'];
		$p21yarea2=$p21['yarea2'];
		if ($p21['ispay']==0){
			$p21ispaycolor=$nopay;	
		}else{
			$p21ispaycolor=$ispay;		
		}
	}else{
		if ($p2['id']==null){
			$p21NickName="注册";	
		}else{
			$p21NickName="<a href='register.php?nickname=".$p2['nickname']."&tid=1'>注册</a>";	
		}	
		$p21jibie="空位";
		$p21area1=0;
		$p21area2=0;
		$p21yarea1=0;
		$p21yarea2=0;
	}
	//BB区
	if ($p22=getFatherManbyFidAndTreeplace($p2['id'],2)){
		$p22NickName="<a href='?ID=".$p22['id']."'>".$p22['nickname']."</a>";
		$ul=ulevel($p22['ulevel']);
		$p22jibie=$ul['lvname'];
		$p22rname=$p22['rname'];
		$p22area1=$p22['area1'];
		$p22area2=$p22['area2'];
		$p22yarea1=$p22['yarea1'];
		$p22yarea2=$p22['yarea2'];
		if ($p22['ispay']==0){
			$p22ispaycolor=$nopay;	
		}else{
			$p22ispaycolor=$ispay;		
		}
	}else{
		if ($p2['id']==null){
			$p22NickName="注册";	
		}else{
			$p22NickName="<a href='register.php?nickname=".$p2['nickname']."&tid=2'>注册</a>";	
		}	
		$p22jibie="空位";
		$p22area1=0;
		$p22area2=0;
		$p22yarea1=0;
		$p22yarea2=0;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>个人资料</title>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}

</style>
</head>
<body>
<table  width="100%" height="600" cellpadding="3" cellspacing="1" border="0" align="center" >
<form name="form1" method="post" action="?">
	<tr>
    <td height="22" colspan="3" class="ziti">查询会员：
      
        <input type="text" name="nickname" id="nickname">
      <input name="submin" type="submit" class="button_blue" id="submin" value="查  询"> 
     <?php
     	if ($ID != $_SESSION['ID']){
	 ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?ID=<?=$_SESSION['ID']?>">返回顶层</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1)">返回上一层</a>
     <?php
		}
	 ?>
     </td>
    <td style="background:<?=$ispay?>" align="center" class="ziti" >已激活</td>
    <td style="background:<?=$nopay?>" align="center" class="ziti">未激活</td>
    </tr>
	<tr>
  </form>
	  <td height="120" colspan="6" align="center"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" >
	    <tr>
	      <td style="background:<?=$usispaycolor?>"  colspan="2" align="center"><?=$NickName?></td>
        </tr>
        <tr>
	      <td  colspan="2" align="center"><?=$rname?></td>
        </tr>
	    <tr>
	      <td  colspan="2" align="center"><?=$jibie?></td>
        </tr>
	    <tr >
	      <td colspan="2" align="center" >总计</td>
        </tr>
	    <tr >
	      <td  align="center"><?=$area1?></td>
	      <td  align="center"><?=$area2?></td>
        </tr>
	    <tr>
	      <td colspan="2" align="center" >结余</td>
        </tr>
	    <tr >
	      <td  align="center"><?=$yarea1?></td>
	      <td  align="center"><?=$yarea2?></td>
        </tr>
      </table></td>
    </tr>
	<tr>
    <td height="36" colspan="6" align="center"><img src="images/t_tree_bottom_l.gif"  height="30"><img src="images/t_tree_line.gif"  width="180" height="30"><img src="images/t_tree_top.gif"  height="30"><img src="images/t_tree_line.gif"  width="180" height="30"><img src="images/t_tree_bottom_r.gif" height="30"></td>
  </tr>
  <tr>
    <td width="50%" height="103" colspan="2"  align="center"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p1ispaycolor?>" colspan="2" align="center"><?=$p1NickName?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p1rname?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p1jibie?></td>
      </tr>
      <tr >
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p1area1?></td>
        <td  align="center"><?=$p1area2?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p1yarea1?></td>
        <td  align="center"><?=$p1yarea2?></td>
      </tr>
    </table></td>
    <td width="50%" colspan="4" align="center"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p2ispaycolor?>" colspan="2" align="center"><?=$p2NickName?></td>
        </tr>
        <tr>
        <td colspan="2" align="center"><?=$p2rname?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p2jibie?></td>
        </tr>
      <tr>
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p2area1?></td>
        <td  align="center"><?=$p2area2?></td>
        </tr>
      <tr >
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p2yarea1?></td>
        <td  align="center"><?=$p2yarea1?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="36" colspan="2" align="center"><img src="images/t_tree_bottom_l.gif" alt=""  height="30"><img src="images/t_tree_line.gif" alt=""  width="80" height="30"><img src="images/t_tree_top.gif" alt=""  height="30"><img src="images/t_tree_line.gif" alt=""  width="80" height="30"><img src="images/t_tree_bottom_r.gif" alt="" height="30"></td>
    <td colspan="4" align="center"><img src="images/t_tree_bottom_l.gif" alt=""  height="30"><img src="images/t_tree_line.gif" alt=""  width="80" height="30"><img src="images/t_tree_top.gif" alt=""  height="30"><img src="images/t_tree_line.gif" alt=""  width="80" height="30"><img src="images/t_tree_bottom_r.gif" alt="" height="30"></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p11ispaycolor?>" colspan="2" align="center"><?=$p11NickName?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p11rname?></td>
      </tr>
      <tr>
        <td  colspan="2" align="center"><?=$p11jibie?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p11area1?></td>
        <td  align="center"><?=$p11area2?></td>
      </tr>
      <tr >
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p11yarea1?></td>
        <td  align="center"><?=$p11yarea2?></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p12ispaycolor?>" colspan="2" align="center"><?=$p12NickName?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p12rname?></td>
      </tr>
      <tr>
        <td  colspan="2" align="center"><?=$p12jibie?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p12area1?></td>
        <td  align="center"><?=$p12area2?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p12yarea1?></td>
        <td  align="center"><?=$p12yarea2?></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p21ispaycolor?>" colspan="2" align="center"><?=$p21NickName?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p21rname?></td>
      </tr>
      <tr>
        <td  colspan="2" align="center"><?=$p21jibie?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p21area1?></td>
        <td  align="center"><?=$p21area2?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p21yarea1?></td>
        <td  align="center"><?=$p21yarea2?></td>
      </tr>
    </table></td>
    <td colspan="3" align="center" valign="top"><table width="120" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td style="background:<?=$p22ispaycolor?>" colspan="2" align="center"><?=$p22NickName?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p22rname?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?=$p22jibie?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >总计</td>
        </tr>
      <tr>
        <td  align="center"><?=$p22area1?></td>
        <td  align="center"><?=$p22area2?></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >结余</td>
        </tr>
      <tr >
        <td  align="center"><?=$p22yarea1?></td>
        <td  align="center"><?=$p22yarea2?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>