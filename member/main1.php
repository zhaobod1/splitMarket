<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天欧会员管理系统</title>
<meta name="keywords" content="广西天欧,天欧直销软件,直销系统, 直销返点系统, 会员返点系统" />
<meta name="description" content="直销返点系统" />
<?php
include("check.php");
include_once("../function.php");
include_once("../class/system_class.php");
session_start();
$_system=new system_class();
?>
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
        $(function(){
            //样式
            $("#drag").css({"position":"absolute","top":"100px","left":"30px","border":"1px solid #789","width":"150px","height":"230px","background":"#33CCFF","cursor":"move","filter":"Alpha(opacity=80)"})

            /*+++++ 拖曳效果 ++++++
            *原理：标记拖曳状态dragging ,坐标位置iX, iY
            *         mousedown:fn(){dragging = true, 记录起始坐标位置，设置鼠标捕获}
            *         mouseover:fn(){判断如果dragging = true, 则当前坐标位置 - 记录起始坐标位置，绝对定位的元素获得差值}
            *         mouseup:fn(){dragging = false, 释放鼠标捕获，防止冒泡}
            */
            var dragging = false;
            var iX, iY;

            $("#drag").mousedown(function(e) {
                dragging = true;
                iX = e.clientX - this.offsetLeft;
                iY = e.clientY - this.offsetTop;
                this.setCapture && this.setCapture();
                return false;
            });

            document.onmousemove = function(e) {
                if (dragging) {
                var e = e || window.event;
                var oX = e.clientX - iX;
                var oY = e.clientY - iY;
                $("#drag").css({"left":oX + "px", "top":oY + "px"});
                return false;
                }
            };

            $(document).mouseup(function(e) {
                dragging = false;
                $("#drag")[0].releaseCapture();
                e.cancelBubble = true;
            })

        })

    </script>
<script language="javascript">
<!--
window.onerror = function() { return true; };
function CloseMenu()
{
	if(MenuLeft.style.display == "none")
	{
		MenuLeft.style.display = ""
	}
	else{
		MenuLeft.style.display = "none"
	}
}
function menuclickdo(ttt){
	var tobj=document.getElementById('positiondiv');
	tobj.innerHTML=ttt;
}
function cks(id){
	if (id == 1){
		document.getElementById('id1').style.display='';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 2){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 3){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 4){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 5){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 6){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='none';
	}else if(id == 7){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='';
		document.getElementById('id8').style.display='none';
	}else if(id == 8){
		document.getElementById('id1').style.display='none';
		document.getElementById('id2').style.display='none';
		document.getElementById('id3').style.display='none';
		document.getElementById('id4').style.display='none';
		document.getElementById('id5').style.display='none';
		document.getElementById('id6').style.display='none';
		document.getElementById('id7').style.display='none';
		document.getElementById('id8').style.display='';
	}
}
function SetUrl(url)
{
	
	if (url.charAt(url.length-1)=="p")
	{
		parent.iframepage.location.href = url;	
	}else{
		parent.iframepage.location.href = 'test.php?yid='+url;	
	}
	
}
function iFrameHeight() {
var ifm= document.getElementById("iframepage");
var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
if(ifm != null && subWeb != null) {
ifm.height = subWeb.body.scrollHeight;
}
}
-->
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
</style>
</head>
<body>

<div id="templatemo_body_wrapper">
  <div id="templatemo_wrapper">
		<div id="templatemo_header">
		  <div id="site_title_right"></div>
		</div>
      <div id="templatemo_menu">
            <ul>
            	<li><a href="main.php" onclick="menuclickdo('首页')">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></li>
                <li><a href="javascript:cks(1)">公司新闻</a></li>
                <li><a href="javascript:cks(2)">个人信息</a></li>
                <li><a href="javascript:cks(3)">团队信息</a></li>
                <li><a href="javascript:cks(4)">财务管理</a></li>
                <li><a href="javascript:cks(5)">订货管理</a></li>
                <li><a href="javascript:cks(6)">站内邮件</a></li>
                <li><a href="javascript:cks(7)">服务中心</a></li>
            </ul>    	
      </div> <!-- end of templatemo_menu -->
      <div id="templatemo_main">
        <table id="id1" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td><a href="javascript:SetUrl('newslist.php')" onclick="menuclickdo('新闻列表')">新闻列表</a></td>
    			<td><a href="javascript:SetUrl('32')" onclick="menuclickdo('公司简介')">公司简介</a></td>
    			<td><a href="javascript:SetUrl('34')" onclick="menuclickdo('奖金制度')">奖金制度</a></td>
                <td><a href="javascript:SetUrl('36')" onclick="menuclickdo('公司账户')">公司账户</a></td>
  			</tr>
		</table>
		<table id="id2" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td><a href="javascript:SetUrl('1')" onclick="menuclickdo('个人资料')">个人资料</a></td>
                <td><a href="javascript:SetUrl('2')" onclick="menuclickdo('修改资料')">修改资料</a></td>
                <td><a href="javascript:SetUrl('UpdatePassword.php')" onclick="menuclickdo('修改密码')">修改密码</a></td>
  			</tr>
		</table>
        <table id="id3" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td><a href="javascript:SetUrl('register.php')" onclick="menuclickdo('会员注册')">会员注册</a></td>
    			<td><a href="javascript:SetUrl('4')" onclick="menuclickdo('直推列表')">直推列表</a></td>
                <?php 
					if ($_system->system_tjt()==1){
				?>
                <td><a href="javascript:SetUrl('5')" onclick="menuclickdo('推荐结构')">推荐结构</a></td>
                <?php 
					}
				?>
                <?php 
					if ($_system->system_wlt()==1){
				?>
                <td><a href="javascript:SetUrl('6')" onclick="menuclickdo('网络结构')">网络结构</a></td>
                <?php 
					}
				?>
  			</tr>
		</table>
        <table id="id4" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
            	<td><a href="javascript:SetUrl('37')" onclick="menuclickdo('奖金明细')">奖金明细</a></td>
    			<td><a href="javascript:SetUrl('12')" onclick="menuclickdo('奖金提现')">奖金提现</a></td>
    			<td><a href="javascript:SetUrl('14')" onclick="menuclickdo('充值申请')">充值申请</a></td>
    			<td><a href="javascript:SetUrl('16')" onclick="menuclickdo('货币转换')">货币转换</a></td>
                <td><a href="javascript:SetUrl('18')" onclick="menuclickdo('会员转账')">会员转账</a></td>
                <td><a href="javascript:SetUrl('20')" onclick="menuclickdo('汇款通知')">汇款通知</a></td>
  			</tr>
		</table>
        <table id="id5" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td><a href="javascript:SetUrl('30')" onclick="menuclickdo('购物商城')">购物商城</a></td>
    			<td><a href="javascript:SetUrl('shoppingcart.php')" onclick="menuclickdo('购物车')">购物车</a></td>
                <td><a href="javascript:SetUrl('29')" onclick="menuclickdo('我的订单')">我的订单</a></td>
                <td><a href="javascript:SetUrl('kuaidi.php')" onclick="menuclickdo('物流查询')">物流查询</a></td>
  			</tr>
		</table>
        <table id="id6" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td><a href="javascript:SetUrl('23')" onclick="menuclickdo('发站内信')">发站内信</a></td></td>
    			<td><a href="javascript:SetUrl('24')" onclick="menuclickdo('收件箱')">收件箱</a></td>
    			<td><a href="javascript:SetUrl('25')" onclick="menuclickdo('发件箱')">发件箱</a></td>
  			</tr>
		</table>
        <table id="id7" cellpadding="10" cellspacing="1" border="0" style="display:none">
  			<tr>
    			<td ><a href="javascript:SetUrl('38')" onclick="menuclickdo('申请服务中心')">申请服务中心</a></td>
                <?php if ($_SESSION['isbd']==2){?>
    			<td><a href="javascript:SetUrl('39')" onclick="menuclickdo('激活会员')">激活会员</a></td>
                <td><a href="javascript:SetUrl('40')" onclick="menuclickdo('我的会员')">我的会员</a></td>
                <?php }?>
  			</tr>
		</table>
<TABLE width="100%" border="0" align="center" cellPadding="0" cellSpacing="0">
        <TBODY>
          <TR>
            <TD height="400" vAlign="top">
			<DIV align="center">
                <TABLE cellSpacing="0" cellPadding="0" align="center" border="0">
                  <TBODY>
                    <TR>
                      <TD valign="top">
                        <DIV align="right" id="MenuLeft">
                        <?php
            				$us=getMemberbyID($_SESSION['ID']);
						?>
                         <TABLE height="123" cellSpacing="0" cellPadding="0" width="200" border="0">
                              <TBODY>
                                <TR>
                                  <TD vAlign="top" >
                                  
                                  <DIV align="center">
                                  <table width="200" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #A3CDF8;">
                                    <tr>
                                      <td align="center" background="images/title.jpg"><font color="#FFFFFF">会员信息</font></td>
                                    </tr>
                                    <tr>
                                      <td align="left">&nbsp;<font color="#0000FF">会员编号：</font><font color="#FF0000"><?=$_SESSION['nickname']?></td>
                                    </tr>
                                    <tr>
                                      <td align="left">&nbsp;<font color="#0000FF">奖金累计：</font><font color="#FF0000"><?=$us['maxmey']?></font></td>
                                    </tr>
                                    <tr>
                                      <td align="left">&nbsp;<font color="#0000FF">剩余奖金：</font><font color="#FF0000"><?=$us['mey']?></font></td>
                                    </tr>
                                    <tr>
                                      <td align="left">&nbsp;<font color="#0000FF">报单币：</font><font color="#FF0000"><?=$us['zsq']?></font></td>
                                      <td align="left">&nbsp;<font color="#0000FF">商城币：</font><font color="#FF0000"><?="0"?></font></td>
                                    </tr>
                                    <tr>
                                      <td align="left">&nbsp;<font color="#0000FF">购物币：</font><font color="#FF0000"><?=$us['gwb']?></font></td>
                                    </tr>
                                    <?php
                                    	if($_SESSION['ID']==1){
									?>
                                    <tr >
                                      <td align="left">&nbsp;<a href="../admin/index.php" target="_blank">后台登录</a></td>
                                    </tr>
                                    <?php }?>
                                     <tr >
                                      <td align="left">&nbsp;<a href="shoppingcart.php" target="iframepage">购物车</a></td>
                                    </tr>
                                    <?php
										if (checknewmail($_SESSION['ID'])){
    								?>
    								 <tr >
                                      <td align="left">&nbsp;<a href="javascript:SetUrl('24')"><img src="images/new.gif" width="20" height="12" />您有新的未读邮件</a></td>
                                    </tr>
                                    <?php 
										}
									?>
                                    <tr >
                                      <td align="left">&nbsp;<font color="#0000FF"><a href="../index.php">退出系统</a></td>
                                    </tr>
                                  </table>
                                  <br>
                                  <table width="200" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #A3CDF8;">
                                    <tr>
                                      <td colspan="2" align="center" background="images/title.jpg"><font color="#FFFFFF">快捷服务</font></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><a href="javascript:SetUrl('register.php')" onclick="menuclickdo('会员注册')">会员注册</a></td>
                                      <td align="center"><a href="javascript:SetUrl('12')" onclick="menuclickdo('奖金提现')">奖金提现</a></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><a href="javascript:SetUrl('20')" onclick="menuclickdo('汇款通知')">汇款通知</a></td>
                                      <td align="center"><a href="javascript:SetUrl('14')" onclick="menuclickdo('充值申请')">充值申请</a></td>
                                    </tr>
                                    <?php
										if (checknewmail($_SESSION['ID'])){
    								?>
                                    <?php 
										}
									?>
                                  </table>
                                  <br>
                                  <br>
                               
                                  </DIV>
                                  </TD>
                                </TR>
                              </TBODY>
                          </TABLE>
                        </DIV>
                      </TD>
                       <TD height="350" valign="middle">
                                <img src="images/s.gif" alt="打开/关闭" width="13" height="74" border="0" title="" onClick="JavaScript:CloseMenu();" style="cursor:hand">
                      </TD>
                    </TR>
                  </TBODY>
                </TABLE>
            </DIV>
            </TD>
            <TD width="100%" vAlign=top>
            
            <div class="BreadCrumb" style="font-size:12px"><div style=" width:250px; float:left"><strong>&nbsp;当前位置:</strong> <span id="positiondiv" style="font-size:12px">首页</span></div>
            
            </TD>
          </TR>
        </TBODY>
      </TABLE>
      </div> 
        <!-- end of templatemo main -->
    </div>
</div>

<div id="templatemo_footer_wrapper">
    <div id="templatemo_footer">
      <p>&nbsp;</p>
      <p>技术支持：天欧科技</p>
    </div> <!-- end of templatemo_footer -->
</div>
<div id="drag" style="display:none"> 
  <table border="0" cellpadding="3" cellspacing="1" >
  <tr >
    <td align="left"><font color="#df802e">会员编号：</font></td>
    <td align="left"><font color="#df802e"><?=$_SESSION['userid']?></font></td>
  </tr>
  <tr >
    <td align="left"><font color="#df802e">会员编号：</font></td>
    <td align="left"><font color="#df802e"><?=$_SESSION['nickname']?></font></td>
  </tr>
  <tr>
    <td align="left"><font color="#df802e">奖金累计：</font></td>
    <td align="left"><font color="#df802e"><?=$us['maxmey']?></font></td>
  </tr>
  <tr>
    <td align="left"><font color="#df802e">剩余奖金：</font></td>
    <td align="left"><font color="#df802e"><?=$us['mey']?></font></td>
  </tr>
  <tr>
    <td align="left"><font color="#df802e">激活币：</font></td>
    <td align="left"><font color="#df802e"><?=$us['zsq']?></font></td>
  </tr>
  <tr>
    <td align="left"><font color="#df802e">购物币：</font></td>
    <td align="left"><font color="#df802e"><?=$us['gwb']?></font></td>
  </tr>
  <tr >
  	<td align="center" colspan="2"><a href="shoppingcart.php" target="iframepage">购物车</a></td>
    </tr>
    <tr>
    <td colspan="2" align="center">
	<?php
		if (checknewmail($_SESSION['ID'])){
    ?><a href="javascript:SetUrl('24')"><img src="images/new.gif" width="20" height="12" />您有新的未读邮件</a><?php }?></td>
    </tr>
    <tr>
    <td align="center" colspan="2"><a href="../index.php">退出系统</a></td>
    </tr>
</table></div>
</body>
</html>