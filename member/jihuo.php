<?php
include("check.php");
include_once("../class/system_class.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
session_start();
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
header("Content-Type: text/html;charset=utf-8");
$_member=new member_class();
$my=$_member->getMemberbyID($_SESSION['ID']);
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}elseif($SearchType==2){
			#搜索姓名
			$_SESSION['Search']="and username='".$SearchContent."'";
		}
	}else{
		$_SESSION['Search']=NULL;	
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#删除会员
if ($_POST['button2']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
	{
		if ($_member->checkfman($id)){
    		edit_delete_cl('member',$id);
		}else{
			$us=$_member->getMemberbyID($id);
			echo "<script language=javascript>alert('会员".$us['nickname']."下方已经安置了会员,删除失败.');window.location.href='?'</script>";	
		}
	}
	echo "<script language=javascript>alert('删除会员完成.');window.location.href='?'</script>";
}

//激活会员 zane123
if($_POST['button3']){
	$cheuid_arr = $_POST['UID'];
	$_member=new member_class();
	$bonus_cl=new bonus_class();
	foreach ((array)$cheuid_arr as $id)
	{
    	if($us=$_member->getMemberbyID($id)){
			if($me=$_member->getMemberbyID($_SESSION['ID'])){
				//if ($us['bdid']==$me['id']){
					if ($us['ispay']==0){
						//ispay=0,1激活，2空单

						if ($me['zsq']>=$us['lsk']){



							/* 青岛火一五信息科技有限公司huo15.com 日期：2017/1/7 */
							include_once "../include/config.inc.php";
							include_once   "../uc_client/client.php";
							$GLOBALS['db'] = uc_api_mysql("user","ReturnDb");

							list($uid, $username, $password, $email) = uc_get_user($us['userid']);

							$sql = "SELECT * FROM `centre_config` WHERE `code`='points_rule'";
							$sRes = $GLOBALS['db']->fetch_first($sql);
							$oPointsRule = uc_unserialize($sRes['value']);
							$oPointsRule = $oPointsRule[0];

							$res = uc_credit_exchange_request($uid,$oPointsRule['creditsrc'], $oPointsRule['creditdesc'],$oPointsRule['appiddesc'],intval($us['lsk'])*7);
							if (!$res) {
								echo "<script language=javascript>alert('同步积分出错！请联系管理员解决。.');</script>";
								die;
							}
							/* 青岛火一五信息科技有限公司huo15.com 日期：2017/1/7 end */

							$_member->jihuomember($us['id']);
							$me_update['zsq']=$me['zsq']-$us['lsk'];
							//$_ulevel_class=new ulevel_class();
							//$_ul=$_ulevel_class->getulevelbyulevel($me['ulevel']);
							//$b5=0.02*$us['lsk'];
							//$me_update['b5']=$me['b5']+$b5;




							edit_update_cl('member',$me_update,$me['id']);					
							$_member->addbdrecord($us,$me,$us['lsk']);
							$bonus_cl->b2bonus();
							$bonus_cl->b0bonus();




						}else{
							echo "<script language=javascript>alert('您的激活币币余额不足,激活失败.');window.location.href='?'</script>";
						}
					}
				//}else{
					//echo "<script language=javascript>alert('您不是该会员的服务中心,无法激活该会员.');window.location.href='?'<123312/script>";	
				//}	
			}
		}else{
			alert("找不到当前会员信息,可能已被删除,请检查后再试.");		
		}
	}
	echo "<script language=javascript>alert('会员激活完成.');window.location.href='?'</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>服务中心</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
		<tr>
        <td height="10" colspan="9" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1"><?=$jihuo1?></option>
            <option value="2"><?=$jihuo3?></option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="button_blue" value="<?=$anniu4?>"></td>
      </tr>
      <tr>
        <td height="10" colspan="9" align="center"><?=$jihuo2?>：<?=$my['zsq']?></td>
      </tr>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center"><?=$jihuo1?></td>
        <td align="center"><?=$jihuo3?></td>
        <td align="center"><?=$jihuo4?></td>
        <td align="center"><?=$jihuo5?></td>
        <td align="center"><?=$jihuo6?></td>
        <td align="center"><?=$jihuo7?></td>
        <td align="center"><?=$jihuo8?></td>
        <td align="center"><?=$jihuo9?></td>
    </tr>
       <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` WHERE (bdid=".$_SESSION['ID']." or reid=".$_SESSION['ID'].") and ispay=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` WHERE (bdid=".$_SESSION['ID']." or reid=".$_SESSION['ID'].") ".$_SESSION['Search']." and ispay=0 ".$_SESSION['SearchTime']." order by isbd,id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><input name="id" type="hidden" value="<?=$row['id']?>"><?=$row['nickname']?></td>
        <td  align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['lsk']?></td>
        <td align="center"><?=$ul['lvname']?></td>
        <td align="center"><?=$row['rname']?></td>
        <td align="center"><?=$row['fathername']?></td>
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['userqq']?></td>
      </tr>
      
      <?php
			}
		}
	  ?>
       
      
    </table>
    <table width="100%" border="0" class="ziti">
  <tr>
        <td colspan="4" align="left"><input name="button3" type="submit" class="button_green" id="button3" value="<?=$anniu1?>" onClick="{if(confirm('您确定要激活该会员吗?')){this.document.selform.submit();return true;}return false;}">          <input name="button2" type="submit" class="button_red" id="button" value="<?=$anniu3?>" onClick="{if(confirm('您确定要删除该会员吗?')){this.document.selform.submit();return true;}return false;}"></td>
        <td colspan="3" align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
    </tr>
</table>

</form>
</body>
</html>