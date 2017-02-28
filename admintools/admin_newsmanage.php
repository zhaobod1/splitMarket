<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(5,16);
#搜索新闻
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and newstime>='".$TimeStart."' and newstime<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索新闻标题
			$_SESSION['Search']="and newstitle like '%".$SearchContent."%'";
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

#发布新闻
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$news['isedit']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('news',$news,$id);
	}
	echo "<script language=javascript>alert('新闻发布完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	$news['isedit']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('news',$news,$id);
	}
	echo "<script language=javascript>alert('新闻已停止发布.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('news',$id);
	}
	echo "<script language=javascript>alert('删除新闻完成.');window.location.href='?'</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>新闻管理</title>
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
        <td height="4" colspan="7" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">新闻标题</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索"></td>
      </tr>
      <tr>
        <td height="5" colspan="7" align="left">搜索时间范围：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <tr>
        <td height="10" colspan="7" align="center">新闻管理</td>
      </tr>
      <tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">新闻序号</td>
        <td align="center">新闻标题</td>
        <td align="center">发布人</td>
        <td align="center">发布时间</td>
        <td align="center">是否发布</td>
        <td align="center">操作</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `news` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `news` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['id']?></td>
        <td align="center"><?=$row['newstitle']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['newstime']?></td>
        <td align="center"><?php if ($row['isedit']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
        <td align="center">
        <input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='../member/newscontent.php?nid=<?=$row['id']?>'" />&nbsp;
          <input type="button" class="button" id="button5" name="button5" value="修改" onClick="window.location.href='admin_newsupdate.php?nid=<?=$row['id']?>'" />
        
        </td>
      </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="7" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left"><input name="button" type="submit" class="btn1" id="button" value="发布新闻" onClick="{if(confirm('您确定要发布新闻吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button2" type="submit" class="btn3" id="button2" value="停止发布" onClick="{if(confirm('您确定要停止发布新闻吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="btn3" id="button4" value="删除新闻" onClick="{if(confirm('您确定要删除新闻吗?')){this.document.selform.submit();return true;}return false;}">
            </td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>