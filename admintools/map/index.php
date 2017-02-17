﻿<?php
include("../admin_check.php");
include_once("../../function.php");
checkqx(3,10);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>全国地图</title>

<script> 
function launchwin(pid){ 
newwin = window.open("","robodemowin","fullscreen=1,scrollbars=0"); 
newwin.resizeBy(250,250); 
newwin.document.open(); 
newwin.document.location="xs.php?pid="+pid; 
newwin.document.close(); 
opener=null; 
self.close(); 
} 
</script>

<style type="text/css">
/* The group of people */
*{text-align:center;}
#gmap {display:block; width:550px; height:617px; background:url(images/map.jpg) no-repeat; position:relative; margin:0 auto 2em auto;}
#gmap a {color:#000; font-family:arial, sans-serif; font-size:1.2em; font-weight:bold; text-transform:uppercase;}

a#title2, a#title2:visited {display:block; width:550px; height:617px; padding-top:260px; position:absolute; left:0; top:0; cursor:default; text-decoration:none;}
* html a#title2 {height:617px; he\ight:0;}/*IE6.0以下中显示*/
#gmap a#title2:hover {background:transparent url(group_col.gif) no-repeat 0 0; overflow:visible; color:#c00;}

/*新疆*/
a#xj {display:block; width:206px; height:0; padding-top:156px; overflow:hidden; position:absolute; left:14px; top:63px;}
* html a#xj {height:156px; he\ight:0;text-indent:-9000px;}
a#xj:hover {background:transparent url(images/xj1.gif) no-repeat 0 0;overflow:visible;text-indent:-9000px;}

/*西藏*/
a#xz {display:block; width:200px; height:0; padding-top:124px; overflow:hidden; position:absolute; left:37px; top:207px;}
* html a#xz {height:124px; he\ight:0;}
a#xz:hover {background:transparent url(images/xz.gif) no-repeat  0 0;overflow:visible;text-indent:-9000px;}

/*青海*/
a#qh {display:block; width:132px; height:0; padding-top:96px; overflow:hidden; position:absolute; left:147px; top:184px;}
* html a#qh {height:96px; he\ight:0;}
a#qh:hover {background:transparent url(images/qh.gif) no-repeat 0 0; height:-20px; overflow:visible;text-indent:-9000px;}

/*甘肃*/
a#gs {display:block; width:148px; height:0; padding-top:123px; overflow:hidden; position:absolute; left:187px; top:149px;}
* html a#gs {height:123px; he\ight:0;}
a#gs:hover {background:transparent url(images/gsh.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*内蒙古*/
a#lmg {display:block; width:226px; height:0; padding-top:196px; overflow:hidden; position:absolute; left:234px; top:17px;}
* html a#lmg {height:196px; he\ight:0;}
a#lmg:hover {background:transparent url(images/lm.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*黑龙江*/
a#hlj {display:block; width:116px; height:0; padding-top:106px; overflow:hidden; position:absolute; left:420px; top:13px;}
* html a#hlj {height:106px; he\ight:0;}
a#hlj:hover {background:transparent url(images/hlj.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*宁夏*/
a#nx {display:block; width:34px; height:0; padding-top:47px; overflow:hidden; position:absolute; left:290px; top:191px;}
* html a#nx {height:47px; he\ight:0;}
a#nx:hover {background:transparent url(images/nx.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*吉林*/
a#jl {display:block; width:88px; height:0; padding-top:59px; overflow:hidden; position:absolute; left:436px; top:96px;}
* html a#jl {height:59px; he\ight:0;}
a#jl:hover {background:transparent url(images/jl.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*辽宁*/
a#ln {display:block; width:61px; height:0; padding-top:53px; overflow:hidden; position:absolute; left:423px; top:129px;}
* html a#ln {height:53px; he\ight:0;}
a#ln:hover {background:transparent url(images/ll.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*山东*/
a#sd {display:block; width:69px; height:0; padding-top:45px; overflow:hidden; position:absolute; left:396px; top:198px;}
* html a#sd {height:45px; he\ight:0;}
a#sd:hover {background:transparent url(images/sd.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*河北*/
a#hb {display:block; width:58px; height:0; padding-top:81px; overflow:hidden; position:absolute; left:377px; top:146px;}
* html a#hb {height:81px; he\ight:0;}
a#hb:hover {background:transparent url(images/heb.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*北京*/
a#bj {display:block; width:17px; height:0; padding-top:18px; overflow:hidden; position:absolute; left:394px; top:167px;}
* html a#bj {height:18px; he\ight:0;}
a#bj:hover {background:transparent url(images/bj.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*天津*/
a#tj {display:block; width:15px; height:0; padding-top:20px; overflow:hidden; position:absolute; left:406px; top:175px;}
* html a#tj {height:20px; he\ight:0;}
a#tj:hover {background:transparent url(images/tj.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*陕西*/
a#shx {display:block; width:55px; height:0; padding-top:93px; overflow:hidden; position:absolute; left:303px; top:188px;}
* html a#shx {height:93px; he\ight:0;}
a#shx:hover {background:transparent url(images/shx.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*山西*/
a#sx {display:block; width:37px; height:0; padding-top:73px; overflow:hidden; position:absolute; left:350px; top:173px;}
* html a#sx {height:73px; he\ight:0;}
a#sx:hover {background:transparent url(images/sx.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*河南*/
a#hn {display:block; width:62px; height:0; padding-top:56px; overflow:hidden; position:absolute; left:351px; top:224px;}
* html a#hn {height:56px; he\ight:0;}
a#hn:hover {background:transparent url(images/hl.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*江苏*/
a#js {display:block; width:56px; height:0; padding-top:50px; overflow:hidden; position:absolute; left:409px; top:232px;}
* html a#js {height:50px; he\ight:0;}
a#js:hover {background:transparent url(images/js.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*安徽*/
a#ah {display:block; width:52px; height:0; padding-top:63px; overflow:hidden; position:absolute; left:397px; top:239px;}
* html a#ah {height:63px; he\ight:0;}
a#ah:hover {background:transparent url(images/ah.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*上海*/
a#sh {display:block; width:10px; height:0; padding-top:7px; overflow:hidden; position:absolute; left:460px; top:273px;}
* html a#sh {height:7px; he\ight:0;}
a#sh:hover {background:transparent url(images/sh.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*浙江*/
a#zj {display:block; width:40px; height:0; padding-top:50px; overflow:hidden; position:absolute; left:433px; top:275px;}
* html a#zj {height:50px; he\ight:0;}
a#zj:hover {background:transparent url(images/zj.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*江西*/
a#jx {display:block; width:51px; height:0; padding-top:67px; overflow:hidden; position:absolute; left:388px; top:297px;}
* html a#jx {height:67px; he\ight:0;}
a#jx:hover {background:transparent url(images/jx.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*福建*/
a#hj {display:block; width:47px; height:0; padding-top:59px; overflow:hidden; position:absolute; left:414px; top:313px;}
* html a#hj {height:59px; he\ight:0;}
a#hj:hover {background:transparent url(images/hj.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*广东*/
a#gd {display:block; width:81px; height:0; padding-top:63px; overflow:hidden; position:absolute; left:350px; top:352px;}
* html a#gd {height:63px; he\ight:0;}
a#gd:hover {background:transparent url(images/gd.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*海南*/
a#hl {display:block; width:25px; height:0; padding-top:21px; overflow:hidden; position:absolute; left:338px; top:418px;}
* html a#hl {height:21px; he\ight:0;}
a#hl:hover {background:transparent url(images/hal.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*广西*/
a#gx {display:block; width:80px; height:0; padding-top:59px; overflow:hidden; position:absolute; left:294px; top:343px;}
* html a#gx {height:59px; he\ight:0;}
a#gx:hover {background:transparent url(images/gx.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*贵州*/
a#gz {display:block; width:62px; height:0; padding-top:52px; overflow:hidden; position:absolute; left:284px; top:312px;}
* html a#gz {height:52px; he\ight:0;}
a#gz:hover {background:transparent url(images/gz.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*云南*/
a#yn {display:block; width:92px; height:0; padding-top:92px; overflow:hidden; position:absolute; left:218px; top:313px;}
* html a#yn {height:92px; he\ight:0;}
a#yn:hover {background:transparent url(images/yn.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*四川*/
a#sc {display:block; width:111px; height:0; padding-top:96px; overflow:hidden; position:absolute; left:222px; top:250px;}
* html a#sc {height:96px; he\ight:0;}
a#sc:hover {background:transparent url(images/sc.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*重庆*/
a#cq {display:block; width:51px; height:0; padding-top:47px; overflow:hidden; position:absolute; left:299px; top:275px;}
* html a#cq {height:47px; he\ight:0;}
a#cq:hover {background:transparent url(images/chq.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*湖南*/
a#hun {display:block; width:56px; height:0; padding-top:65px; overflow:hidden; position:absolute; left:339px; top:298px;}
* html a#hun {height:65px; he\ight:0;}
a#hun:hover {background:transparent url(images/hn.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*湖北*/
a#hub {display:block; width:82px; height:0; padding-top:49px; overflow:hidden; position:absolute; left:332px; top:261px;}
* html a#hub {height:49px; he\ight:0;}
a#hub:hover {background:transparent url(images/hb.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

/*台湾*/
a#tw {display:block; width:17px; height:0; padding-top:40px; overflow:hidden; position:absolute; left:462px; top:347px;}
* html a#tw {height:40px; he\ight:0;}
a#tw:hover {background:transparent url(images/tw.gif) no-repeat 0 0; overflow:visible;text-indent:-9000px;}

</style>
</head>

<body>
<div>
	<dl id="gmap">
		<dt><a id="title2" href="#nogo"></a></dt>
		<dd><a id="xj" title="新疆" href="#" onclick="launchwin(650000)">新疆</a></dd>	
		<dd><a id="xz" title="西藏" href="#" onclick="launchwin(540000)">西藏</a></dd>
		<dd><a id="qh" title="青海" href="#" onclick="launchwin(630000)">青海</a></dd>		
		<dd><a id="gs" title="甘肃" href="#" onclick="launchwin(620000)">甘肃</a></dd>
		<dd><a id="lmg" title="内蒙古" href="#" onclick="launchwin(150000)">内蒙古</a></dd>
		<dd><a id="hlj" title="黑龙江" href="#" onclick="launchwin(230000)">黑龙江</a></dd>	
		<dd><a id="jl" title="吉林" href="#" onclick="launchwin(220000)">吉林</a></dd>
		<dd><a id="ln" title="辽宁" href="#" onclick="launchwin(210000)">辽宁</a></dd>
		<dd><a id="sd" title="山东" href="#" onclick="launchwin(370000)">山东</a></dd>
		<dd><a id="hb" title="河北" href="#" onclick="launchwin(130000)">河北</a></dd>
		<dd><a id="sx" title="山西" href="#" onclick="launchwin(140000)">山西</a></dd>
		<dd><a id="bj" title="北京" href="#" onclick="launchwin(110000)">北京</a></dd>
		<dd><a id="tj" title="天津" href="#" onclick="launchwin(120000)">天津</a></dd>
		<dd><a id="shx" title="陕西" href="#" onclick="launchwin(610000)">陕西</a></dd>		
		<dd><a id="nx" title="宁夏" href="#" onclick="launchwin(640000)">宁夏</a></dd>	
		<dd><a id="hn" title="河南" href="#" onclick="launchwin(410000)">河南</a></dd>	
		<dd><a id="js" title="江苏" href="#" onclick="launchwin(320000)">江苏</a></dd>
		<dd><a id="ah" title="安徽" href="#" onclick="launchwin(340000)">安徽</a></dd>
		<dd><a id="sh" title="上海" href="#" onclick="launchwin(310000)">上海</a></dd>
		<dd><a id="zj" title="浙江" href="#" onclick="launchwin(330000)">浙江</a></dd>	
		<dd><a id="jx" title="江西" href="#" onclick="launchwin(360000)">江西</a></dd>
		<dd><a id="hj" title="福建" href="#" onclick="launchwin(350000)">福建</a></dd>
		<dd><a id="gd" title="广东" href="#" onclick="launchwin(440000)">广东</a></dd>
		<dd><a id="hl" title="海南" href="#" onclick="launchwin(460000)">海南</a></dd>
		<dd><a id="gx" title="广西" href="#" onclick="launchwin(450000)">广西</a></dd>	
		<dd><a id="gz" title="贵州" href="#" onclick="launchwin(520000)">贵州</a></dd>
		<dd><a id="yn" title="云南" href="#" onclick="launchwin(530000)">云南</a></dd>	
		<dd><a id="sc" title="四川" href="#" onclick="launchwin(510000)">四川</a></dd>
		<dd><a id="cq" title="重庆" href="#" onclick="launchwin(500000)">>重庆</a></dd>
		<dd><a id="hun" title="湖南" href="#" onclick="launchwin(430000)">湖南</a></dd>		
		<dd><a id="hub" title="湖北" href="#" onclick="launchwin(420000)">湖北</a></dd>
		<dd><a id="tw" title="台湾" href="#" onclick="launchwin(710000)">台湾</a></dd>
		<!--<dd><a id="xg" title="香港" href="#">香港</a></dd>
		<dd><a id="am" title="澳门" href="#">澳门</a></dd>	
		-->		
	</dl>
</div>

</body>
</html>