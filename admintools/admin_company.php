<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改公司账户</title>
<link rel="stylesheet" href="common.css" type="text/css" media="screen" />
<script type="text/javascript" src="../xheditor/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<style type="text/css">
body,td,th {
	font-size: 12px;
	color: #666;
}
</style>
</head>
<?php
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
checkqx(5,20);
$information=que_select_cl('information',1);
if ($_POST['save']){
    $information['company']=$_POST['company'];
    //edit_update_cl("information",$information,1);
    require_once "../include/initMysql.php";
    global $ecs_db;
    $sql = "UPDATE information SET company='" . $information["company"] . "' WHERE id=1";
    $ecs_db->query($sql);

    alert('公司账户修改成功','?');
}
?>
<body>
<table width="100%" height="420" border="0">f
  <tr>
    <td valign="top"><form name="form1" method="post" action="?" >
      公司账户<br />
	内容：
    <br />
	<textarea id="company" name="company" class="xheditor-simple" rows="12" cols="80" style="width: 80%">
    <?=$information['company']?>
	</textarea>
	<br/>
	<input type="submit" name="save" class="btn1" value="修改" />&nbsp;&nbsp;
	<input type="reset" name="reset" class="btn1" value="重置" />
</form></td>
  </tr>
</table>
</body>
</html>