<?php
include("check.php");
include_once("../function.php");
include_once("../class/system_class.php");
include_once("../class/txczzh_class.php");
session_start();
if ($_SESSION['language'] == 1) {
	include_once("../language/zh.php");
	$logo = "images/templatemo_logo.png";
} else {
	include_once("../language/en.php");
	$logo = "images/templatemo_logo2.png";
}
date_default_timezone_set('PRC');
$_system = new system_class();
$us = getMemberbyID($_SESSION['ID']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>会员管理系统</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="../js/jquery.min.js"></script>
    <script language="javascript">
      <!--
      function menuclickdo(ttt) {
        var tobj = document.getElementById('positiondiv');
        tobj.innerHTML = ttt;
      }
      function cks(id) {
        if (id == 1) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = 'hover';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = '';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 2) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = 'hover';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = '';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 3) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = 'hover';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = '';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 4) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = 'hover';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = '';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 5) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = 'hover';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = '';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 6) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = 'hover';
          document.getElementById('nav7').className = '';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = '';
          document.getElementById('menu7').style.display = 'none';
        } else if (id == 7) {
          document.getElementById('nav0').className = '';
          document.getElementById('nav1').className = '';
          document.getElementById('nav2').className = '';
          document.getElementById('nav3').className = '';
          document.getElementById('nav4').className = '';
          document.getElementById('nav5').className = '';
          document.getElementById('nav6').className = '';
          document.getElementById('nav7').className = 'hover';
          document.getElementById('menu1').style.display = 'none';
          document.getElementById('menu2').style.display = 'none';
          document.getElementById('menu3').style.display = 'none';
          document.getElementById('menu4').style.display = 'none';
          document.getElementById('menu5').style.display = 'none';
          document.getElementById('menu6').style.display = 'none';
          document.getElementById('menu7').style.display = '';
        }
      }
      function SetUrl(url) {

        if (url.charAt(url.length - 1) == "p") {
          parent.iframepage.location.href = url;
        } else {
          parent.iframepage.location.href = 'test.php?yid=' + url;
        }

      }
      function iFrameHeight() {
        var ifm = document.getElementById("iframepage");
        var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
        if (ifm != null && subWeb != null) {
          ifm.height = subWeb.body.scrollHeight;
        }
      }
      -->
    </script>
</head>
<body>
<!--top start -->
<div id="topmain">
    <div id="top">
        <a href="?"><img src="<?= $logo ?>" alt="ecode" width="200" height="50" border="0" class="logo" title="ecode"/></a>
        <p class="topTxt" style="display:none"><span class="yellow">Imperdiet vulputate:</span> Nunc vel turpis sit amet
            leo accumsan varius. Duis nec tellus. Quisque <span class="red">dignissim</span> quam in felis.</p>
        <ul class="nav">
            <li><a href="?" id="nav0" class="hover"><?= $top1 ?></a></li>
            <li><a href="javascript:cks(1)" id="nav1"><?= $top2 ?></a></li>
            <li><a href="javascript:cks(2)" id="nav2"><?= $top3 ?></a></li>
            <li><a href="javascript:cks(3)" id="nav3"><?= $top4 ?></a></li>
            <li><a href="javascript:cks(4)" id="nav4"><?= $top5 ?></a></li> <!--财务管理-->
            <li><a href="javascript:cks(5)" id="nav5"><?= $top6 ?></a></li>
            <li><a href="javascript:cks(6)" id="nav6"><?= $top7 ?></a></li>
            <li><a href="javascript:cks(7)" id="nav7"><?= $top8 ?></a></li>
        </ul>
        <ul class="sub" id="menu1" style="display:none">
            <li><a href="javascript:SetUrl('newslist.php')" onclick="menuclickdo('<?= $menu1 ?>')"><?= $menu1 ?></a>
            </li>
            <li><a href="javascript:SetUrl('32')" onclick="menuclickdo('<?= $menu2 ?>')"><?= $menu2 ?></a></li>
            <li><a href="javascript:SetUrl('34')" onclick="menuclickdo('<?= $menu3 ?>')"><?= $menu3 ?></a></li>
            <li><a href="javascript:SetUrl('36')" onclick="menuclickdo('<?= $menu4 ?>')"><?= $menu4 ?></a></li>
        </ul>
        <ul class="sub" id="menu2" style="display:none">
            <li><a href="javascript:SetUrl('1')" onclick="menuclickdo('<?= $menu5 ?>')"><?= $menu5 ?></a></li>
            <li><a href="javascript:SetUrl('2')" onclick="menuclickdo('<?= $menu6 ?>')"><?= $menu6 ?></a></li>
            <li><a href="javascript:SetUrl('47')" onclick="menuclickdo('<?= $menu7 ?>')"><?= $menu7 ?></a></li>
			<?php if (1 == 2) { ?>
                <li><a href="javascript:SetUrl('45')" onclick="menuclickdo('申请升级')">申请升级</a></li>
			<?php } ?>
        </ul>
        <ul class="sub" id="menu3" style="display:none">
            <li><a href="javascript:SetUrl('register.php')" onclick="menuclickdo('<?= $menu8 ?>')"><?= $menu8 ?></a>
            </li>
            <li><a href="javascript:SetUrl('4')" onclick="menuclickdo('<?= $menu9 ?>')"><?= $menu9 ?></a></li>
			<?php if ($_system->system_tjt() == 1) { ?>
                <li><a href="javascript:SetUrl('5')" onclick="menuclickdo('<?= $menu10 ?>')"><?= $menu10 ?></a></li>
			<?php }
			if ($_system->system_wlt() == 1) {
				?>
                <li><a href="javascript:SetUrl('6')" onclick="menuclickdo('<?= $menu11 ?>')"><?= $menu11 ?></a></li>
			<?php } ?>
        </ul>
        <ul class="sub" id="menu4" style="display:none">
            <li><a href="javascript:SetUrl('37')" onclick="menuclickdo('<?= $menu12 ?>')"><?= $menu12 ?></a></li>
            <li><a href="javascript:SetUrl('48')" onclick="menuclickdo('<?= $menu13 ?>')"><?= $menu13 ?></a></li>
            <li><a href="javascript:SetUrl('12')" onclick="menuclickdo('<?= $menu14 ?>')"><?= $menu14 ?></a></li>
            <li><a href="javascript:SetUrl('16')" onclick="menuclickdo('<?= $menu15 ?>')"><?= $menu15 ?></a></li>
            <li><a href="javascript:SetUrl('18')" onclick="menuclickdo('<?= $menu16 ?>')"><?= $menu16 ?></a></li>

			<?php if (1 == 2) { ?>
                <li><a href="javascript:SetUrl('46')" onclick="menuclickdo('零售报单')">零售报单</a></li>
			<?php } ?>
        </ul>
        <ul class="sub" id="menu5" style="display:none">
            <li><a href="javascript:SetUrl('54')" onclick="menuclickdo('<?= $menu17 ?>')"><?= $menu17 ?></a></li>
            <li><a href="javascript:SetUrl('55')" onclick="menuclickdo('<?= $menu18 ?>')"><?= $menu18 ?></a></li>
            <li><a href="javascript:SetUrl('56')" onclick="menuclickdo('<?= $menu19 ?>')"><?= $menu19 ?></a></li>
            <li><a href="javascript:SetUrl('51')" onclick="menuclickdo('<?= $menu20 ?>')"><?= $menu20 ?></a></li>
            <!--<li><a href="javascript:SetUrl('52')" onclick="menuclickdo('我的委托')">我的委托</a></li>-->
            <li><a href="javascript:SetUrl('53')" onclick="menuclickdo('<?= $menu21 ?>')"><?= $menu21 ?></a></li>
            <!--<li><a href="javascript:SetUrl('30')" onclick="menuclickdo('激活购物')">激活购物</a></li>
			<li><a href="javascript:SetUrl('49')" onclick="menuclickdo('升级购物')">升级购物</a></li>
			<li><a href="javascript:SetUrl('50')" onclick="menuclickdo('重复购物')">重复购物</a></li>
			<li><a href="javascript:SetUrl('29')" onclick="menuclickdo('我的订单')">我的订单</a></li>
			<li><a href="javascript:SetUrl('kuaidi.php')" onclick="menuclickdo('物流查询')">物流查询</a></li>-->
        </ul>
        <ul class="sub" id="menu6" style="display:none">
            <li><a href="javascript:SetUrl('23')" onclick="menuclickdo('<?= $menu22 ?>')"><?= $menu22 ?></a></li>
            <li><a href="javascript:SetUrl('24')" onclick="menuclickdo('<?= $menu23 ?>')"><?= $menu23 ?></a></li>
            <li><a href="javascript:SetUrl('25')" onclick="menuclickdo('<?= $menu24 ?>')"><?= $menu24 ?></a></li>
        </ul>
        <ul class="sub" id="menu7" style="display:none">
            <li><a href="javascript:SetUrl('38')" onclick="menuclickdo('<?= $menu25 ?>')"><?= $menu25 ?></a></li>
            <li><a href="javascript:SetUrl('14')" onclick="menuclickdo('<?= $menu26 ?>')"><?= $menu26 ?></a></li>
            <li><a href="javascript:SetUrl('39')" onclick="menuclickdo('<?= $menu27 ?>')"><?= $menu27 ?></a></li>
            <li><a href="javascript:SetUrl('44')" onclick="menuclickdo('<?= $menu28 ?>')"><?= $menu28 ?></a></li>
			<?php if ($_SESSION['isbd'] == 2) { ?>
                <li><a href="javascript:SetUrl('40')" onclick="menuclickdo('<?= $menu29 ?>')"><?= $menu29 ?></a></li>

                <li><a href="javascript:SetUrl('20')" onclick="menuclickdo('<?= $menu30 ?>')"><?= $menu30 ?></a></li>
				<?php if ($_system->system_bdbonus() == 1) { ?>
                    <li style="display:none"><a href="javascript:SetUrl('41')" onclick="menuclickdo('奖金查询')">奖金查询</a>
                    </li>
				<?php } ?>
                <li style="display:none"><a href="javascript:SetUrl('42')" onclick="menuclickdo('会员提现')">会员提现</a></li>
                <li style="display:none"><a href="javascript:SetUrl('43')" onclick="menuclickdo('汇款通知')">汇款通知</a></li>
			<?php } ?>
        </ul>
    </div>
</div>
<!--top end -->
<!--bodyMain start -->
<div id="bodyMain">
    <!--body start -->
    <div id="body">
        <!--left start -->
        <div id="left">
            <h2><span><?= $main1 ?></span></h2>
            <ul>
                <li><a href="#"><?= $main2 ?>
                        ：<font color="#FF0000">
							<?= $_SESSION['nickname'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main3 ?>
                        ：<font color="#FF0000">
							<?= $us['maxmey'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main4 ?>
                        ：<font color="#FF0000">
							<?= $us['mey'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main5 ?>
                        ：<font color="#FF0000">
							<?= $us['zsq'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main16 ?>
                        ：<font color="#FF0000">
							<?= $us['shop_coin'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main6 ?>
                        ：<font color="#FF0000">
							<?= $us['yxb'] ?>
                        </font></a></li>
                <li><a href="#">
						<?= $main7 ?>
                        ：<font color="#FF0000">
							<?= round($us['pe']) ?>
                        </font></a></li>
                <!--<li><a href="shoppingcart.php" target="iframepage">购物车</a></li>-->
				<?php if (checknewmail($_SESSION['ID'])) { ?>
                    <li><a href="javascript:SetUrl('24')"><img src="images/new.gif" width="20" height="12" border="0"/>您有新的未读邮件</a>
                    </li>
				<?php } ?>
                <!--<li><a href="../admin/index.php" target="_blank">管理员后台登录</a></li>-->
                <li>
                    <a href="../index.php">
						<span style="color:#1ca362">
							<?= $main8 ?>
						</span>
                    </a>
                </li>
            </ul>
            <h2><span><?= $main9 ?></span></h2>
            <ul>
                <li><a href="http://shop.zh852.hk" target="_blank">购物</a></li>
                <li><a href="javascript:SetUrl('20')" onclick="menuclickdo('<?= $main10 ?>')"><?= $main10 ?></a></li>
                <li><a href="javascript:SetUrl('register.php')"
                       onclick="menuclickdo('<?= $main11 ?>')"><?= $main11 ?></a></li>
				<?php if ($_SESSION['isbd'] == 2) { ?>
                    <!--<li><a href="javascript:SetUrl('39')" onclick="menuclickdo('激活会员')">激活会员</a></li>-->
				<?php } ?>
                <li><a href="javascript:SetUrl('37')" onclick="menuclickdo('<?= $main12 ?>')"><?= $main12 ?></a></li>
                <li><a href="javascript:SetUrl('12')" onclick="menuclickdo('<?= $main13 ?>')"><?= $main13 ?></a></li>
            </ul>
            <h2><span><?= $main14 ?></span></h2>
            <ul>
				<?php
				$txczzh_cl = new txczzh_class();
				if ($array = $txczzh_cl->getnewstopnum(10)) {
					foreach ($array as $row) {
						echo "<li>";
						echo "<a href='newscontent.php?nid=" . $row['id'] . "' target='iframepage'>" . $row['newstitle'] . "</a>";
						echo "</li>";
					}
				}
				?>
            </ul>
            <h2>
                <span>企业备用金</span>
            </h2>
            <ul>
                <li><a id="pettyCash" href="#"></a></li>
            </ul>
            <script>

                var timeInterval = null;
                $.post(
                  "h15ajax.php?act=getPettyCash",
                  {},
                  function (res) {
                    $("#pettyCash").text(res);
                    console.log(res);
                  },
                  "json"
                );

                $(function () {
                    timeInterval = setInterval(intervalPost, 5000);

                });
                function intervalPost() {
                    $.post(
                      "h15ajax.php?act=getPettyCash",
                      {},
                      function (res) {
                        $("#pettyCash").text(res);
                        console.log(res);
                      },
                      "json"
                    );
                }
            </script>
            <!--<h2><span>最新提现名单</span></h2>
<marquee id="mar1" direction="up" scrolldelay="1" scrollamount="1">
    <?php
			if ($array = $txczzh_cl->gettixiantop50()) {
				foreach ($array as $value) {
					echo "<font color='#FF0000'>会员:" . $value . "</font>";
					echo "<br>";
					echo "<br>";
				}
			}
			?>
</marquee>-->
            <br class="spacer"/>
            </form>
        </div>
        <!--left end -->
        <!--right start -->
        <div id="right">
            <div style=" width:200px; margin:0 0 0 0;"><span style="font-size:12px;"><?= $main15 ?>:</span> <span
                        id="positiondiv" style="font-size:12px"><?= $top1 ?></span></div>
            <iframe id="iframepage" style="Z-INDEX: 1; WIDTH: 695px;" name="iframepage" src="right.php" frameborder=0
                    scrolling="auto" onLoad="javascript:iFrameHeight();"></iframe>
            <br>
            <div id="flash" style="display:none">

                <img src="images/flash_pic.gif" alt=""/>
                <ul>
                    <li class="redBg">condimentum</li>
                    <li class="blackBg">neque varius risus magna</li>
                </ul>
                <p>Fusce mauris neque, tempor ut, <span>(imperdiet ut)</span>, auctor a, nuncut rhoncusconm vulputate
                    magna. Fusce pede libero, malesuada non, condimentum eget, rutm nec, dolor donec aliquam elit a pede
                </p>
                <a href="#">Read More</a>

                <br class="spacer"/>
            </div>
        </div>
        <!--right end -->
        <br class="spacer"/>
    </div>
    <!--body end -->
    <br class="spacer"/>
</div>
<!--bodyMain end -->
<!--footer start -->
<div id="footerMain">
    <div id="footer">
        <ul>
            <li><a href="?"><?= $top1 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(1);"><?= $top2 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(2);"><?= $top3 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(3);"><?= $top4 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(4);"><?= $top5 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(6);"><?= $top7 ?></a>|</li>
            <li><a href="#" onclick="javascript:cks(7);"><?= $top8 ?></a></li>
        </ul>
        <p class="copyright" style="display:none">© 2013 版权所有 <a href="http://www.gxtianou.com/" target="_blank"
                                                                 class="link">天欧直销软件</a></p>
    </div>
</div>
<!--footer end -->
<script type="text/javascript" src="qqkefu1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="qqkefu1/lrkf_blue1.css">
<script src="qqkefu1/lrkf.js"></script>

<?php
$system = $_system->system_information(1);
?>
<!--<script>
$(function(){
	/*皮肤编号 lrkf_blue1 无图版，lrkf_blue2 图片版，更多皮肤敬请期待 懒人qq客服 - http://www.51xuediannao.com/qqkefu/*/
	$("#lrkfwarp").lrkf({
		kftop:'140',				//距离顶部距离
		btntext:'<? /*=$right1*/ ?>',			//默认为 客服在线 四个字，如果你了解css可以使用图片代替
		defshow:false,			//如果想默认折叠，将defshow:false,的注释打开，默认为展开
		//position:'absolute',		//如果为absolute所有浏览器在拖动滚动条时均有动画效果，如果为空则只有IE6有动画效果，其他浏览器
		qqs:[
			{'name':'<? /*=$right2*/ ?>','qq':'<? /*=$system['qq1']*/ ?>'},			//注意逗号是英文的逗号
			{'name':'<? /*=$right2*/ ?>','qq':'<? /*=$system['qq2']*/ ?>'},
			{'name':'<? /*=$right2*/ ?>','qq':'<? /*=$system['qq3']*/ ?>'},
			{'name':'<? /*=$right2*/ ?>','qq':'<? /*=$system['qq4']*/ ?>'}			//注意最后一个{}不要英文逗号
		],
		tel:[
			{'name':'24小时热线','tel':'400-400-4000'},	//注意逗号是英文的逗号
			{'name':'售后','tel':'18976633669'}
		],
	});
		
});
</script>-->

<style>
    #left ul li a#pettyCash {
        color:red;
    }

</style>
</body>
</html>
