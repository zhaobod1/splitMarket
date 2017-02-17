<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>php+mysql+jquery二级关联菜单</title>
</head>
<?php 
	include_once("../function.php");
	if(!isset($_GET['cid'])){//未选择一级目录
	$sql="select * from province";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
		$classification[]=$row;
	}
	
?>

<script src='../js/ssjl_jquery.js'></script>
<script>
	$(document).ready(function(){
		$("#classification").change(function(){
			var cid=$(this).val();
			$("#menuSpan").load("shengshijilian.php?cid="+cid);
		});
	})
</script>

<select id="classification" name="classification">
<option value='0' >请选择省份</option>
<?php 
	foreach($classification as $k=>$v){
?>
<option value='<?php echo $v['provinceid']?>'><?php echo $v['province']?></option>
<?php 
	}
	}else{

	$sql="select * from city where fatherid=".$_GET['cid'];
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
	$menu[]=$row;
	}
		}
?>
</select>


<span id="menuSpan">
<select id="menu" name="menu">
	<option value="0">请选择城市</option>
	<?php 
		foreach($menu as $k=>$v){
	?>
		<option value='<?php echo $v['cityid']?>'><?php echo $v['city']?></option>
	<?php 
		}
	?>
</select>
</span>
