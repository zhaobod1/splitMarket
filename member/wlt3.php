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
	$area3=$us['area3'];
	$yarea1=$us['yarea1'];
	$yarea2=$us['yarea2'];
	$yarea3=$us['yarea3'];
	$rname=$us['rname'];
	$pdt=$us['pdt'];
	$ul=ulevel($uLevel);
	$jibie=$ul['lvname'];
	if ($us['ispay']==0){
		$usispaycolor=$nopay;	
	}else{
		$usispaycolor=$ispay;		
	}
	//A区
	if ($p1=getFatherManbyFidAndTreeplace($ID,1)){
		
	}
	
	//B区
	if ($p2=getFatherManbyFidAndTreeplace($ID,2)){
		
	}
	
	//C区
	if ($p3=getFatherManbyFidAndTreeplace($ID,3)){
		
	}
	
	
	function getwlttable($id,$fathername,$tp){
		$ispay="#1B6DA2";
		$nopay="#FFFF00";
		if ($p=getFatherManbyFidAndTreeplace($id,$tp)){
			$pNickName="<a href='?ID=".$p['id']."'>".$p['nickname']."</a>";
			$ul=ulevel($p['ulevel']);
			$pjibie=$ul['lvname'];
			$prname=$p['rname'];
			$parea1=$p['area1'];
			$parea2=$p['area2'];
			$parea3=$p['area3'];
			$ppdt=$p['pdt'];
			if ($p['ispay']==0){
				$pispaycolor=$nopay;	
			}else{
				$pispaycolor=$ispay;		
			}
		}else{
			if ($fathername!=""){
				$pNickName="<a href='register.php?nickname=".$fathername."&tid=".$tp."'>注册</a>";
			}else{
				$pNickName="空位";
			}
			$pjibie="空位";
			$parea1=0;
			$parea2=0;
			$parea3=0;
		}
		$tab="<table width='150' cellpadding='3' cellspacing='1' border='0' align='center' class='table1'>";
		$tab=$tab."<tr>";
		$tab=$tab."<td style='background:".$pispaycolor."' colspan='3' align='center'>".$pNickName."</td>";
		$tab=$tab."</tr>";
		$tab=$tab."<tr>";
		$tab=$tab."<td colspan='3' align='center'>".$pjibie."</td>";
		$tab=$tab."</tr>";
		$tab=$tab."<tr>";
		$tab=$tab."<td align='center'>A区</td>";
		$tab=$tab."<td align='center'>B区</td>";
		$tab=$tab."<td align='center'>C区</td>";
		$tab=$tab."</tr>";
		$tab=$tab."<tr>";
		$tab=$tab."<td align='center'>".$parea1."</td>";
		$tab=$tab."<td align='center'>".$parea2."</td>";
		$tab=$tab."<td align='center'>".$parea3."</td>";
		$tab=$tab."</tr>";
		$tab=$tab."</table>";
		return $tab;
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
<table  width="100%" height="400px"  cellpadding="3" cellspacing="1" border="0" align="center" >
<form name="form1" method="post" action="?">
	<tr>
	  <td height="22" class="ziti">查询会员：
	    
	    <input type="text" name="nickname" id="nickname">
	    <input name="submin" type="submit" class="button_blue" id="submin" value="查  询"> 
	    <?php
     	if ($ID != $_SESSION['ID']){
	 ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?ID=<?=$_SESSION['ID']?>">返回顶层</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1)">返回上一层</a>
	    <?php
		}
	 ?>
      </td>
	  <td width="12%" align="center" class="ziti" style="background:<?=$ispay?>" >已激活</td>
	  <td width="12%" align="center" class="ziti" style="background:<?=$nopay?>">未激活</td>
    </tr>
  </form>
	  <td height="120" colspan="9" align="center"><br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <table width="150" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" >
	    <tr>
	      <td style="background:<?=$usispaycolor?>"  colspan="3" align="center"><?=$NickName?></td>
        </tr>
        <tr style="display:none">
	      <td  colspan="3" align="center"><?=$rname?></td>
        </tr>
	    <tr>
	      <td  colspan="3" align="center"><?=$jibie?></td>
        </tr>
	    <tr >
	      <td align="center" >A区</td>
	      <td align="center" >B区</td>
	      <td align="center" >C区</td>
        </tr>
	    <tr >
	      <td  align="center"><?=$area1?></td>
	      <td  align="center"><?=$area2?></td>
	      <td  align="center"><?=$area3?></td>
        </tr>
	    <tr style="display:none">
	      <td  align="center"><?=$yarea1?></td>
	      <td  align="center"><?=$yarea2?></td>
	      <td  align="center"><?=$yarea3?></td>
        </tr>
        <tr style="display:none">
	      <td colspan="3" align="center" ><?=$pdt?></td>
        </tr>
      </table></td>
    </tr>
	<tr>
    <td height="36" colspan="3" align="center"><img src="images/t_tree_bottom_l.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_top.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_bottom_r.gif" height="30"></td>
  </tr>
  <tr>
    <td height="103" colspan="3" align="center"><table width="100%" border="0">
      <tr>
        <td colspan="3"><?=getwlttable($ID,$NickName,1)?></td>
        <td colspan="3"><?=getwlttable($ID,$NickName,2)?></td>
        <td colspan="3"><?=getwlttable($ID,$NickName,3)?></td>
      </tr>
      <tr>
    <td height="36" colspan="3" align="center"><img src="images/t_tree_bottom_l.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_top.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_bottom_r.gif" height="30"></td>
    <td colspan="3" height="36" align="center"><img src="images/t_tree_bottom_l.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_top.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_bottom_r.gif" height="30"></td>
    <td colspan="3" height="36" align="center"><img src="images/t_tree_bottom_l.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_top.gif"  height="30"><img src="images/t_tree_line.gif" alt=""  width="180" height="30"><img src="images/t_tree_bottom_r.gif" height="30"></td>
      </tr>
      <tr>
    <td align="center"><?=getwlttable($p1['id'],$p1['nickname'],1)?></td>
    <td align="center"><?=getwlttable($p1['id'],$p1['nickname'],2)?></td>
    <td align="center"><?=getwlttable($p1['id'],$p1['nickname'],3)?></td>
    <td align="center"><?=getwlttable($p2['id'],$p2['nickname'],1)?></td>
    <td align="center"><?=getwlttable($p2['id'],$p2['nickname'],2)?></td>
    <td align="center"><?=getwlttable($p2['id'],$p2['nickname'],3)?></td>
    <td align="center"><?=getwlttable($p3['id'],$p3['nickname'],1)?></td>
    <td align="center"><?=getwlttable($p3['id'],$p3['nickname'],2)?></td>
    <td align="center"><?=getwlttable($p3['id'],$p3['nickname'],3)?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>