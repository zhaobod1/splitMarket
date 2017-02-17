<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改新闻</title>
<link rel="stylesheet" href="../kindeditor-4.1.9/themes/default/default.css" />
<link rel="stylesheet" href="../kindeditor-4.1.9/plugins/code/prettify.css" />
<script charset="utf-8" src="../kindeditor-4.1.9/kindeditor.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/lang/zh_CN.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/plugins/code/prettify.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : '../kindeditor-4.1.9/plugins/code/prettify.css',
			uploadJson : '../kindeditor-4.1.9/php/upload_json.php',
			fileManagerJson : '../kindeditor-4.1.9/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<style type="text/css">
body,td,th {
	font-size: 12px;
	color: #666;
}
</style>
</head>

<script language="javascript">
<!--
function CheckForm(){
	newstitle=document.form1.newstitle.value;
	newscontent=document.form1.newscontent.value;
	if(newstitle.length == 0){
		alert("温馨提示:\n请输入新闻标题.");
		document.form1.newstitle.focus();
		return false;
	}
	if(newscontent == ''){
		alert("温馨提示:\n请输入新闻内容.");
		return false;
	}
	return true;
}
-->
</script>
<?php
include("admin_check.php");
include_once("../function.php");
session_start();

if ($_GET['nid']!=NULL){
	$nid=$_GET['nid'];
	$news=que_select_cl('news',$_GET['nid']);
}else{
	echo "<script language=javascript>alert('新闻不存在,可能已被删除.');window.location.href='../test.php?yid=11'</script>";	
}

if ($_POST['save']){
	if($_GET['nid']!=NULL){
		$nid=$_GET['nid'];
		$newstitle=$_POST['newstitle'];
		$newscontent=$_POST['content1'];
		$newstime=$_POST['newstime'];
		$news['newstitle']=$newstitle;
		$news['newscontent']=$newscontent;
		$news['newstime']=$newstime;
		edit_update_cl("news",$news,$nid);
		echo "<script language=javascript>alert('新闻修改成功.');window.location.href='?nid=".$nid."'</script>";
	}else{
		echo "<script language=javascript>alert('新闻修改失败.');window.location.href='../test.php?yid=11'</script>";
	}
}
?>
<body>
<table width="100%" height="420" border="0">
  <tr>
    <td valign="top"><form name="form1" method="post" action="?nid=<?=$nid?>" onSubmit="return CheckForm()">
标题： 
  <input name="newstitle" id="newstitle" type="text" maxlength="50" value="<?=$news['newstitle']?>"/>
<br />
<br />
时间：
  <input name="newstime" id="newstime" type="text" maxlength="50" value="<?=$news['newstime']?>" />
<br />
<br />
	内容：
    <br />
    <textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?=$news['newscontent']?></textarea>
    <br/>
	<input type="submit" name="save" class="btn1" value="修改" />&nbsp;&nbsp;
	<input type="reset" name="reset" class="btn1" value="重置" />
</form></td>
  </tr>
</table>
</body>
</html>