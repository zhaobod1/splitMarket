<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(1,2);
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and sdate>='".$TimeStart."' and sdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}elseif($SearchType==2){
			#搜索推荐人
			$_SESSION['Search']="and rname='".$SearchContent."'";
		}elseif($SearchType==3){
			#搜索报单中心
			$_SESSION['Search']="and bdname='".$SearchContent."'";
		}elseif($SearchType==4){
			#搜索顶层会员
			$_SESSION['Search']="and fathername='顶层会员' and nickname='".$SearchContent."'";
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

if ($_GET['action']=="Revoke"){
	$stockbuy=que_select_cl('stockbuy',$_GET['id']);
	if ($stockbuy['isjs']==0){
		if($stockbuy['lx']==0){
			$yxb=$stockbuy['num']*$stockbuy['price'];
			edit_sql("update `member` set yxb=yxb+".$yxb." where id=".$stockbuy['uid']."");	
			edit_sql("update `stockbuy` set isjs=2 where id=".$stockbuy['id']."");	
		}else if ($stockbuy['lx']==1){
			edit_sql("update `member` set pe=pe+".$stockbuy['num']." where id=".$stockbuy['uid']."");	
			edit_sql("update `stockbuy` set isjs=2 where id=".$stockbuy['id']."");	
		}
	}
	echo "<script language=javascript>alert('撤消完成');window.location.href='?'</script>";	
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>委托卖出列表</title>
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
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
      <tr>
        <td height="10" colspan="10" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索"></td>
      </tr>
      <tr>
        <td height="5" colspan="10" align="left">搜索时间范围：
          <input type="text" name="TimeStart" id="TimeStart" style="width:100px" onFocus="HS_setDate(this)">
          至
          <input type="text" name="TimeEnd" id="TimeEnd" style="width:100px" onFocus="HS_setDate(this)"></td>
      </tr>
      <tr>
        <td height="10" colspan="10" align="center">委托卖出列表</td>
      </tr>
      <tr>
        <td align="center">时间</td>
        <td align="center">会员编号</td>
        <td align="center">委托价格</td>
        <td align="center">委托数量</td>
        <td align="center">剩余数量</td>
        <td align="center">操作</td>
    </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `stockbuy` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by sdate desc,id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['sdate']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['total']?></td>
        <td align="center"><?=$row['num']?></td>
        <td align="center"><?php if($row['isjs']==0){?><a href="?action=Revoke&id=<?=$row['id']?>" onClick="{if(confirm('您确定要撤消您的委托吗?')){return true;}return false;}">撤消委托</a><?php }elseif($row['isjs']==1){?>交易成功<?php }elseif ($row['isjs']==2){?>已撤消<?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="10" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="left">&nbsp;</td>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>