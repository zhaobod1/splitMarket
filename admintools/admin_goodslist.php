<?php
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
checkqx(4,13);
#搜索商品
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and gdate>='".$TimeStart."' and gdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索商品名称
			$_SESSION['Search']="and goodsname like '%".$SearchContent."%'";
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
	$goods['isdisplay']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('goods',$goods,$id);
	}
	echo "<script language=javascript>alert('商品发布完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	$goods['isdisplay']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('goods',$goods,$id);
	}
	echo "<script language=javascript>alert('商品已停止发布.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('goods',$id);
	}
	echo "<script language=javascript>alert('删除商品完成.');window.location.href='?'</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>商品管理</title>
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
<style type="text/css">
*{margin:0; padding:0; font-size:12px;}
#tablit {margin:0px;width:100%; height:400; border:#BCE2F3 1px solid;padding-top:10px;background:#E4F2FB;}
#tablit dl{ float:left; width:100%;}
#tablit dl dt{float:left;border-bottom:#64B8E4 1px solid; width:15px; height:31px; line-height:30px;}
#tablit dl dd{float:left;width:110px;height:30px; line-height:30px; text-align:center;}
#tablit .on{
	border:#64B8E4 1px solid;
	border-bottom:#FFF 1px solid;
	color:#FF6600;
	background:#FFF;
	font-weight: bold;
}
#tablit .out{
	border:#64B8E4 1px solid;
	color:#000;
	background:#64B8E4;
	font-weight: bold;
}
.tabcon{width:100%; height:100%; background: #FFF; clear:both;}
.dis{display:none;}
</style>
</head>
<body>
<form name="form1" method="post" action="?">
<div class="ziti"> <select name="SearchType" id="SearchType">
            <option value="1">商品名称</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">搜索时间范围：
           <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索"></div>

    
    <div id="tablit">
    <dl>
        <dt></dt>
        <dd class="on">商品信息</dd>
        <dt></dt>
        <dd style="display:none" class="out">首购商品</dd>
        <dt></dt>
    </dl>
 <div class="tabcon"><table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="10" align="center">商品管理</td>
      </tr>
      <tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">商品名称</td>
        <td align="center">商品价格</td>
        <td align="center">重消价格</td>
        <td align="center">商品类型</td>
        <td align="center">库存</td>
        <td align="center">销量</td>
        <td align="center">发布时间</td>
        <td align="center">是否发布</td>
        <td align="center">操作</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `goods` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `goods` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['goodsname']?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['price2']?></td>
        <td align="center"><?php if ($row['lx']==1){?>激活商品<?php }else if($row['lx']==2){?>升级商品<?php }else if($row['lx']==3){?>重消商品<?php }?></td>
        <td align="center"><?=$row['kucun']?></td>
        <td align="center"><?=$row['sales']?></td>
        <td align="center"><?=$row['gdate']?></td>
        <td align="center"><?php if ($row['isdisplay']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
        <td align="center">
          <input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='../member/goodscontent.php?id=<?=$row['id']?>'" />&nbsp;
          <input type="button" class="button" id="button5" name="button5" value="修改" onClick="window.location.href='admin_goodsupdate.php?id=<?=$row['id']?>'" /></td>
      </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="10" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left"><input name="button" type="submit" class="btn1" id="button" value="发布商品" onClick="{if(confirm('您确定要发布商品吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button2" type="submit" class="btn3" id="button2" value="停止发布" onClick="{if(confirm('您确定要停止发布商品吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="btn3" id="button4" value="删除商品" onClick="{if(confirm('您确定要删除商品吗?')){this.document.selform.submit();return true;}return false;}">
            </td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table></div>
    <div class="tabcon dis"><table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="9" align="center">商品管理</td>
      </tr>
      <tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">商品名称</td>
        <td align="center">商品价格</td>
        <td align="center">商品类型</td>
        <td align="center">库存</td>
        <td align="center">销量</td>
        <td align="center">发布时间</td>
        <td align="center">是否发布</td>
        <td align="center">操作</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `goods` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `goods` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['goodsname']?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?php if ($row['lx']==1){?>首购商品<?php }else{?>重购商品<?php }?></td>
        <td align="center"><?=$row['kucun']?></td>
        <td align="center"><?=$row['sales']?></td>
        <td align="center"><?=$row['gdate']?></td>
        <td align="center"><?php if ($row['isdisplay']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
        <td align="center"><input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='../member/goodscontent.php?id=<?=$row['id']?>'" />&nbsp;
          <input type="button" class="button" id="button5" name="button5" value="修改" onClick="window.location.href='admin_goodsupdate.php?id=<?=$row['id']?>'" /></td>
      </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="9" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left"><input name="button" type="submit" class="btn1" id="button" value="发布商品" onClick="{if(confirm('您确定要发布商品吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button2" type="submit" class="btn3" id="button2" value="停止发布" onClick="{if(confirm('您确定要停止发布商品吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="btn3" id="button4" value="删除商品" onClick="{if(confirm('您确定要删除商品吗?')){this.document.selform.submit();return true;}return false;}">
            </td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table></div>
</div>
    
    </form>
</body>

<script type="text/javascript">

var mDD = document.getElementById("tablit").getElementsByTagName("dd");
var mDIV= document.getElementById("tablit").getElementsByTagName("div");


for (var i=0;i<mDD.length;i++){
 (function(index) {
  mDD[index].onmouseover = function() {
   if (mDD[index].className == 'out') {
    for (var j = 0; j < mDD.length; j++) {
     mDD[j].className = 'out';
     mDIV[j].style.display = 'none';
    }
    mDD[index].className = 'on';
    mDIV[index].style.display = 'block';
   }
  }

 })(i);
}

</script>
</html>