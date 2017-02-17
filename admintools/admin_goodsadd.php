<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="../xheditor/common.css" type="text/css" media="screen" />
<script type="text/javascript" src="../xheditor/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<title>添加商品</title>
<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
checkqx(4,12);
if ($_POST['button']){

		$goods['goodsname']=$_POST['goodsname'];
		$goods['price']=$_POST['price'];
		$goods['price2']=$_POST['price2'];
		$goods['pv']=$_POST['pv'];
		$goods['goodsimg']=$_POST['goodsimg'];
		$goods['lx']=$_POST['lx'];
		$goods['gdate']=now();
		$goods['goodscontent']=$_POST['goodscontent'];
		$goods['kucun']=$_POST['kucun'];
		$goods['shunxu']=$_POST['shunxu'];
		echo add_insert_cl('goods',$goods);
		echo "<script language=javascript>alert('添加商品成功.');window.location.href='admin_goodslist.php'</script>";	

}
?>
<script language="javascript">
<!--
function CheckForm(){
	goodsname=document.form1.goodsname.value;
	price=document.form1.price.value;
	goodscontent=document.form1.goodscontent.value;
	if(goodsname.length == 0){
		alert("温馨提示:\n请输入商品名称.");
		document.form1.goodsname.focus();
		return false;
	}
	if(price <= 0){
		alert("温馨提示:\n商品价格必须大于0.");
		document.form1.price.focus();
		return false;
	}
	if(goodscontent == ''){
		alert("温馨提示:\n请输入商品信息.");
		return false;
	}
	return true;
}
function GetImgName(){
	//根据iframe的id获取对象  
	var i1 = window.frames['UploadFiles'];   
	//获取iframe中的元素值  
	var imgname=i1.document.getElementById("imgname").value;
	document.getElementById("goodsimg").value = imgname;
}
-->
</script>
</head>
<body>
<form name="form1" method="post" action="?" onSubmit="return CheckForm();" > 
<table  width="90%" height="450" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
	<tr>
    <td height="21" colspan="2" align="center">添 加 商 品</td>
    </tr>
    <tr>
    <td height="22" align="right">上传图片：</td>
    <td align="left"><iframe ID="UploadFiles" src="UploadFiles.php" frameborder=0 scrolling=no height="35"></iframe>
</td>
  </tr>
   <tr>
    <td height="22" align="right">商品图片：</td>
    <td align="left" valign="top"><input name="goodsimg" type="text" id="goodsimg" size="20" maxlength="50">
      <input name="button" type="button" class="btn1" id="button" onClick="GetImgName()" value="获取图片"></td>
  </tr>
  <tr>
    <td height="22" align="right">商品类型：</td>
    <td align="left"><label for="select"></label>
      <select name="lx" id="lx">
        <option value="1">激活商品</option>
        <option value="2">升级商品</option>
        <option value="3">重消商品</option>
      </select></td>
  </tr>
  <tr>
    <td height="22" align="right">商品名称：</td>
    <td align="left"><input name="goodsname" type="text" id="goodsname" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right">商品价格：</td>
    <td align="left"><input name="price" type="text" id="price" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right">重消价格：</td>
    <td align="left"><input name="price2" type="text" id="price2" size="20" maxlength="50"></td>
  </tr>
  <tr style="display:none">
    <td height="22" align="right">商品积分：</td>
    <td align="left"><input name="pv" type="text" id="pv" value="0" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right">商品库存：</td>
    <td align="left"><input name="kucun" type="text" id="kucun" value="0" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right">显示顺序：</td>
    <td align="left"><input name="shunxu" type="text" id="shunxu" value="0" size="20" maxlength="50"></td>
  </tr>
  <tr>
    <td height="22" align="right" valign="top">商品信息：</td>
    <td align="left">
	<textarea id="goodscontent" name="goodscontent" class="xheditor-simple" rows="12" cols="80" style="width: 80%">
	</textarea></td>
  </tr>
<tr>
    <td colspan="2" align="center">
      <table align="center" height="22">
        <tr>
          <td><input name="button" id="button" type="submit" class="btn2" value="添加">&nbsp;&nbsp;<input type="button" class="btn1" onClick="javascript:history.back();" value="返回"></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
</body>
</html>