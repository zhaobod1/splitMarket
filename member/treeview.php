<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐关系图</title>
<?php

include_once("../function.php");
include_once("../class/system_class.php");
session_start();
if ($_SESSION['to_admin']){
	include("check.php");
	include("check2.php");	
}
if ($_SESSION['language']==1){
	include_once("../language/zh.php");
}else{
	include_once("../language/en.php");
}
$_system=new system_class();
if ($_system->system_tjt()!=1){
	echo "<script language=javascript>alert('您没有查看推荐结构的权限.');window.location.href='member.php'</script>";	
}
session_start();
?>
<link rel="stylesheet" href="treeview/jquery.treeview.css" />
<link rel="stylesheet" href="treeview/red-treeview.css" />
<link rel="stylesheet" href="treeview/screen.css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />

<script src="treeview/lib/jquery.js" type="text/javascript"></script>
<!--<script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>-->
<script src="treeview/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
	</script>

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
h1,h2,h3,h4,h5,h6 {
	font-family: "trebuchet ms", verdana, arial;
}
body {
	background-color: #E8E8D0;
}
</style>
</head>
<?php

if($_POST['submit']){
	$_nickname=$_POST['nickname'];
	if ($_nickname==""){ $_nickname=$_SESSION['nickname']; }
	if(checkisrepath($_SESSION['ID'],$_nickname)){
		$us=getMemberbyNickName($_nickname);
	}else{
		echo "<script language=javascript>alert('您的团队中不存在该成员.');window.location.href='?'</script>";	
	}
}else{
	if ($_GET['ID'] != ""){
		$us=getMemberbyID($_GET['ID']);	
	}else{
		$us=getMemberbyID($_SESSION['ID']);		
	}
}
?>

<body>
<div id="main" style="height:800px;">
<div id="sidetree">
<form id="form1" method="post" action="?">
<div class="treeheader"><?=$treeview1?>：
  <input name="nickname" id="nickname" type="text" />
  <input name="submit" type="submit" class="button_blue" id="submit" value="<?=$anniu4?>" />
</div>
</form>
<div id="sidetreecontrol"><a href="?#"><br />
  <?=$treeview2?></a> | <a href="?#"><?=$treeview3?></a><br />
  <br />
</div>
<ul id="tree">
	<li><strong><?=$us['nickname']?></strong>
    	<?php
			echo tree($us['id']);
		?>
	</li>
</ul>
</div>

</div>

</body>

</html>
