<?php
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

if ($_GET['did']==""){
	$did=$_SESSION['did'];
}else{
	$did=$_GET['did'];
	$_SESSION['did']=$_GET['did'];	
}
if ($did=="") alert('查询错误','admin_bonustime.php');

#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	$SearchType=$_POST['SearchType'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and b.bdate>='".$TimeStart."' and b.bdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and m.nickname='".$SearchContent."'";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

if ($_GET['action']=="send"){
	$bid=$_GET['bid'];
	$_bonus['isff']=1;
	edit_update_cl('bonus',$_bonus,$bid);
	alert("发放完成.","?did=".$_GET['did']."");
}

if ($_GET['action']=="allsend"){
	$sql="SELECT * FROM `bonus` WHERE did=".$_GET['did']."";
	if ($query=mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$_bonus['isff']=1;
			edit_update_cl('bonus',$_bonus,$row['id']);
		}
	}
	alert("全部发放完成.","?did=".$_GET['did']."");
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="../js/calendar.js"></script>
<title>奖金查询</title>
<script language="javascript"> 
<!--     
//导出excel
function exportExcel(DivID){
 //先声明Excel插件、Excel工作簿等对像
 var jXls, myWorkbook, myWorksheet;
 
 try {
  //插件初始化失败时作出提示
  jXls = new ActiveXObject('Excel.Application');
 }catch (e) {
  alert("无法启动Excel!\n\n如果您确信您的电脑中已经安装了Excel，"+"那么请调整IE的安全级别。\n\n具体操作：\n\n"+"工具 → Internet选项 → 安全 → 自定义级别 → 对没有标记为安全的ActiveX进行初始化和脚本运行 → 启用");
  return false;
 }
 
 //不显示警告 
 jXls.DisplayAlerts = false;
 
 //创建AX对象excel
 myWorkbook = jXls.Workbooks.Add();
 //myWorkbook.Worksheets(3).Delete();//删除第3个标签页(可不做)
 //myWorkbook.Worksheets(2).Delete();//删除第2个标签页(可不做)
 
 //获取DOM对像
 var curTb = document.getElementByIdx_x(DivID);
 
 //获取当前活动的工作薄(即第一个)
 myWorksheet = myWorkbook.ActiveSheet; 
 
 //设置工作薄名称
 myWorksheet.name="NP统计";
 
 //获取BODY文本范围
 var sel = document.body.createTextRange();
 
 //将文本范围移动至DIV处
 sel.moveToElementText(curTb);
 
 //选中Range
 sel.select();
 
 //清空剪贴板
 window.clipboardData.setData('text','');
 
 //将文本范围的内容拷贝至剪贴板
 sel.execCommand("Copy");
 
 //将内容粘贴至工作簿
 myWorksheet.Paste();
 
 //打开工作簿
 jXls.Visible = true;
 
 //清空剪贴板
 window.clipboardData.setData('text','');
 jXls = null;//释放对像
 myWorkbook = null;//释放对像
 myWorksheet = null;//释放对像
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?did=<?=$did?>">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
	  <tr>
	    <td colspan="9" align="center">奖金查询</td>
	    <td align="center"><input name="fafang2" type="button" class="button_green" value="全部发放" onClick="window.location.href='?action=allsend&did=<?=$did?>'"></td>
	  </tr>
      <tr>
        <td height="4" colspan="10" align="left">
          <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="button_blue" value="搜  索">
        <input name="input" type="button" class="button_red" value="返  回" onClick="javascript:history.go(-1);"></td>
      </tr>
      <div id="daochu">
      <tr>
      	<td height="25" align="center">会员编号</td>
        <td align="center">开户银行</td>
        <td align="center">开户姓名</td>
        <td align="center">银行账户</td>
        <td align="center">开户点</td>
        <td align="center"><?=bonusname(1)?></td>
        <td align="center"><?=bonusname(2)?></td>
        <td align="center"><?=bonusname(3)?></td>
        <td align="center"><?=bonusname(0)?></td>
        <td align="center">操作</td>
        </tr>
      <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by b.bdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['bankname']?></td>
        <td align="center"><?=$row['bankusername']?></td>
        <td align="center"><?=$row['bankcard']?></td>
        <td align="center"><?=$row['bankaddress']?></td>
        <td align="center"><?=$row['b1']?></td>
        <td align="center"><?=$row['b2']?></td>
        <td align="center"><?=$row['b3']?></td>
        <td align="center"><?=$row['b0']?></td>
        <td align="center">
        <?php if ($row['isff']==0){?>
        <input name="fafang" type="button" class="button_green" value="发 放" onClick="window.location.href='?action=send&bid=<?=$row['id']?>&did=<?=$did?>'"><?php }else{?>已发放<?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
      </div>
      <tr>
        <td height="21" colspan="10" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="right"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </form>
</body>
</html>