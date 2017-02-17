<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/system_class.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
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
	if($us['treeplace']==1){
		$quyu=$wlt17;	
	}elseif ($us['treeplace']==2){
		$quyu=$wlt18;	
	}elseif ($us['treeplace']==0){
		$quyu=$wlt12;		
	}
	
	$jibie=$ul['lvname'];
	if ($us['ispay']==0){
		$usispaycolor=$nopay;
		$ispay=$wlt11;
	}else{
		$usispaycolor=$ispay;	
		$ispay=$wlt10;	
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
			$p1ispay=$wlt11;
		}else{
			$p1ispaycolor=$ispay;	
			$p1ispay=$wlt10;
		}
	}else{
		$p1NickName="<a href='register.php?nickname=".$NickName."&tid=1'>".$wlt14."</a>";
		$p1jibie=$wlt13;
		$p1area1=0;
		$p1area2=0;
		$p1yarea1=0;
		$p1yarea2=0;
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
			$p2ispay=$wlt11;
		}else{
			$p2ispaycolor=$ispay;	
			$p2ispay=$wlt10;	
		}
	}else{
		$p2NickName="<a href='register.php?nickname=".$NickName."&tid=2'>".$wlt14."</a>";
		$p2jibie=$wlt13;
		$p2area1=0;
		$p2area2=0;
		$p2yarea1=0;
		$p2yarea2=0;
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
<table  width="100%" height="182" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" >
<form name="form1" method="post" action="?">
	<tr>
    <td height="22" colspan="8" class="ziti"><?=$wlt1?>：
      
        <input type="text" name="nickname" id="nickname">
      <input name="submin" type="submit" class="button_blue" id="submin" value="<?=$anniu4?>"> 
     <?php
     	if ($ID != $_SESSION['ID']){
	 ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?ID=<?=$_SESSION['ID']?>"><?=$wlt16?></a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1)"><?=$wlt15?></a>
     <?php
		}
	 ?> </td>
    </tr>
</form>
	<tr>
    <td width="100" height="36" align="center"><?=$wlt2?></td>
    <td height="36" align="center"><?=$wlt3?></td>
    <td align="center"><?=$wlt4?></td>
    <td align="center"><?=$wlt5?></td>
    <td align="center"><?=$wlt6?></td>
    <td height="36" align="center"><?=$wlt7?></td>
    <td height="36" align="center"><?=$wlt8?></td>
    <td height="36" align="center"><?=$wlt9?></td>
    </tr>
    <tr bgcolor="<?=$p1ispaycolor?>">
    <td height="36" align="center"><?=$NickName?></td>
    <td align="center"><?=$jibie?></td>
    <td align="center"><?=$quyu?></td>
    <td align="center"><?=$area1?></td>
    <td align="center"><?=$area2?></td>
    <td height="36" align="center"><?=$yarea1?></td>
    <td height="36" align="center"><?=$yarea1?></td>
    <td height="36" align="center"><?=$ispay?></td>
    </tr>
    <tr bgcolor="<?=$p1ispaycolor?>">
    <td height="36" align="center"><?=$p1NickName?></td>
    <td align="center"><?=$p1jibie?></td>
    <td align="center"><?=$wlt17?></td>
    <td align="center"><?=$p1area1?></td>
    <td align="center"><?=$p1area2?></td>
    <td height="36" align="center"><?=$p1yarea1?></td>
    <td height="36" align="center"><?=$p1yarea1?></td>
    <td height="36" align="center"><?=$p1ispay?></td>
    </tr>
    <tr bgcolor="<?=$p2ispaycolor?>">
    <td height="36" align="center"><?=$p2NickName?></td>
    <td align="center"><?=$p2jibie?></td>
    <td align="center"><?=$wlt18?></td>
    <td align="center"><?=$p2area1?></td>
    <td align="center"><?=$p2area2?></td>
    <td height="36" align="center"><?=$p2yarea1?></td>
    <td height="36" align="center"><?=$p2yarea1?></td>
    <td height="36" align="center"><?=$p2ispay?></td>
    </tr>
</table>
</body>
</html>