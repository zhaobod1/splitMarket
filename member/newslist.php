<?php
include("check.php");
include_once("../function.php");

session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>新闻列表</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	font-family: Verdana, Geneva, sans-serif;
}
a:link {
	color: #00F;
	text-decoration: none;
}
a:hover {
	color: #F00;
	text-decoration: none;
}
a:visited {
	color: #00F;
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #F00;
}
body {
	margin-left: 50px;
}
</style>
</head>
<body>
<form name="form1" method="post" action="?">
<table width="100%" cellpadding="10" cellspacing="1" border="0" align="center" >
      <?php
	  	$pagesize = 15; //设置每页记录数 
	  	$sql = "SELECT * FROM `news` WHERE isedit=1";
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
      	$sql = "SELECT * FROM `news` WHERE isedit=1 order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      	<tr>
        <td width="70%" align="left"><a href="newscontent.php?nid=<?=$row['id']?>" style="text-decoration:none"><?=$row['newstitle']?></a></td>
        <td align="center"><?=$row['newstime']?></td>
    </tr>
      <?php
			}
		}
	  ?>
      <tr>
        <td height="21" colspan="8" align="right">
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