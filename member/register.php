<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
session_start();
if ($_SESSION['language']==1){
    include_once("../language/zh.php");
}else{
    include_once("../language/en.php");
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/table.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>会员注册</title>
    <script src='../js/ssjl_jquery.js'></script>
    <script src="../js/shengshixian/jquery.provincesCity.js" type="text/javascript"></script>
    <script src="../js/shengshixian/provincesdata.js" type="text/javascript"></script>
    <script>
        //调用插件
        $(function(){
            $("#test").ProvinceCity();
        });
    </script>
    <script language="javascript">
        <!--
        $(document).ready(function(){
            $("#classification").change(function(){
                var cid=$(this).val();
                $("#menuSpan").load("shengshijilian.php?cid="+cid);
            });
        })
        function GetNickName()
        {
            var rnd="";
            var aaa="";
            for(var i=0;i<5;i++)
                rnd+=Math.floor(Math.random()*10);
            aaa="CN"+rnd;
            document.form1.NickName.value=aaa;
            document.form1.UserID.value=aaa;
        }
        function checknickname(lx)
        {
            var iframe = document.getElementById("iframe");
            if(lx==1){
                var user =  document.getElementById("bdName");
                iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
            }else if(lx==2){
                var user =  document.getElementById("rName");
                iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
            }else if(lx==3){
                var user =  document.getElementById("FatherName");
                iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
            }else if(lx==4){
                var user =  document.getElementById("NickName");
                iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
            }
        }

        function Check(formName){
            bdName=document.form1.bdName.value;
            rName=document.form1.rName.value;
            FatherName=document.form1.FatherName.value;
            UserID=document.form1.UserID.value;
            NickName=document.form1.NickName.value;
            password1=document.form1.password1.value;
            password12=document.form1.password12.value;
            password2=document.form1.password2.value;
            password22=document.form1.password22.value;
            password3=document.form1.password3.value;
            password32=document.form1.password32.value;
            passQuestion=document.form1.passQuestion.value;
            passAnswer=document.form1.passAnswer.value;
            UserCard=document.form1.UserCard.value;
            UserName=document.form1.UserName.value;
            UserTel=document.form1.UserTel.value;
            UserAddress=document.form1.UserAddress.value;
            BankCard=document.form1.BankCard.value;
            BankUserName=document.form1.BankUserName.value;
            BankAddress=document.form1.BankAddress.value;
            useremail=document.form1.useremail.value;
            if(formName=="bdName"){
                if(bdName.length == 0){
                    document.getElementById('bdNamelabel').innerText="请输入服务中心编号";
                }else{
                    document.getElementById('bdNamelabel').innerText="";
                }
            }
            if(formName=="rName"){
                if(rName.length == 0){
                    document.getElementById('rNamelabel').innerText="请输入推荐人编号";
                }else{
                    document.getElementById('rNamelabel').innerText="";
                }
            }
            if(formName=="FatherName"){
                if(FatherName.length == 0){
                    document.getElementById('FatherNamelabel').innerText="请输入接点人编号";
                }else{
                    document.getElementById('FatherNamelabel').innerText="";
                }
            }
            if(formName=="NickName"){
                if(NickName.length == 0){
                    document.getElementById('NickNamelabel').innerText="请输入会员编号";
                }else{
                    document.getElementById('NickNamelabel').innerText="";
                }
            }
            if(formName=="password1"){
                if(password1.length == 0){
                    document.getElementById('password1label').innerText="请输入一级密码";
                }else{
                    if(password1.length <= 5){
                        document.getElementById('password1label').innerText="密码小于6位";
                    }else{
                        document.getElementById('password1label').innerText="";
                    }
                }

            }
            if(formName=="password12"){
                if(password12.length == 0){
                    document.getElementById('password12label').innerText="请确认一级密码";
                }else{
                    if(password12.length <= 5){
                        document.getElementById('password12label').innerText="密码小于6位";
                    }else{
                        if(password1 != password12){
                            document.getElementById('password12label').innerText="一级密码输入不一致";
                        }else{
                            document.getElementById('password12label').innerText="";
                        }
                    }
                }
            }
            if(formName=="password2"){
                if(password2.length == 0){
                    document.getElementById('password2label').innerText="请输入二级密码";
                }else{
                    if(password2.length <= 5){
                        document.getElementById('password2label').innerText="密码小于6位";
                    }else{
                        document.getElementById('password2label').innerText="";
                    }
                }
            }
            if(formName=="password22"){
                if(password22.length == 0){
                    document.getElementById('password22label').innerText="请确认二级密码";
                }else{
                    if(password22.length <= 5){
                        document.getElementById('password22label').innerText="密码小于6位";
                    }else{
                        if(password2 != password22){
                            document.getElementById('password22label').innerText="二级密码输入不一致";
                        }else{
                            document.getElementById('password22label').innerText="";
                        }
                    }
                }
            }
            if(formName=="password3"){
                if(password3.length == 0){
                    document.getElementById('password3label').innerText="请输入三级密码";
                }else{
                    if(password3.length <= 5){
                        document.getElementById('password3label').innerText="密码小于6位";
                    }else{
                        document.getElementById('password3label').innerText="";
                    }
                }
            }
            if(formName=="password32"){
                if(password32.length == 0){
                    document.getElementById('password32label').innerText="请确认三级密码";
                }else{
                    if(password32.length <= 5){
                        document.getElementById('password32label').innerText="密码小于6位";
                    }else{
                        if(password3 != password32){
                            document.getElementById('password32label').innerText="三级密码输入不一致";
                        }else{
                            document.getElementById('password32label').innerText="";
                        }
                    }
                }
            }
            if(formName=="passQuestion"){
                if(passQuestion.length == 0){
                    document.getElementById('passQuestionlabel').innerText="请输入密码安全问题";
                }else{
                    document.getElementById('passQuestionlabel').innerText="";
                }
            }
            if(formName=="passAnswer"){
                if(passAnswer.length == 0){
                    document.getElementById('passAnswerlabel').innerText="请输入密码安全答案";
                }else{
                    document.getElementById('passAnswerlabel').innerText="";
                }
            }
            if(formName=="UserCard"){
                if(UserCard.length == 0){
                    document.getElementById('UserCardlabel').innerText="请输入身份证号码";
                }else{
                    document.getElementById('UserCardlabel').innerText="";
                }
            }
            if(formName=="UserName"){
                if(UserName.length == 0){
                    document.getElementById('UserNamelabel').innerText="请输入会员姓名";
                }else{
                    document.getElementById('UserNamelabel').innerText="";
                }
            }
           /* if(formName=="UserTel"){
                if(UserTel.length == 0){
                    document.getElementById('UserTellabel').innerText="请输入联系电话";
                }else{
                    document.getElementById('UserTellabel').innerText="";
                }
            }*/
            if(formName=="UserAddress"){
                if(UserAddress.length == 0){
                    document.getElementById('UserAddresslabel').innerText="请输入联系地址";
                }else{
                    document.getElementById('UserAddresslabel').innerText="";
                }
            }
            /*if(formName=="BankCard"){
                if(BankCard.length == 0){
                    document.getElementById('BankCardlabel').innerText="请输入开户帐号";
                }else{
                    document.getElementById('BankCardlabel').innerText="";
                }
            }
            if(formName=="BankUserName"){
                if(BankUserName.length == 0){
                    document.getElementById('BankUserNamelabel').innerText="请输入开户姓名";
                }else{
                    document.getElementById('BankUserNamelabel').innerText="";
                }
            }
            if(formName=="BankAddress"){
                if(BankAddress.length == 0){
                    document.getElementById('BankAddresslabel').innerText="请输入开户地址";
                }else{
                    document.getElementById('BankAddresslabel').innerText="";
                }
            }
            if(formName=="useremail"){
                if(useremail.length == 0){
                    document.getElementById('useremaillabel').innerText="请输入电子邮箱";
                }else{
                    document.getElementById('useremaillabel').innerText="";
                }
            }
             */
        }

        function CheckForm(){
            bdName=document.form1.bdName.value;
            rName=document.form1.rName.value;
            FatherName=document.form1.FatherName.value;
            UserID=document.form1.UserID.value;
            NickName=document.form1.NickName.value;
            password1=document.form1.password1.value;
            password12=document.form1.password12.value;
            password2=document.form1.password2.value;
            password22=document.form1.password22.value;
            password3=document.form1.password3.value;
            password32=document.form1.password32.value;
            passQuestion=document.form1.passQuestion.value;
            passAnswer=document.form1.passAnswer.value;
            UserCard=document.form1.UserCard.value;
            UserName=document.form1.UserName.value;
            UserTel=document.form1.UserTel.value;
            UserAddress=document.form1.UserAddress.value;
            BankCard=document.form1.BankCard.value;
            BankUserName=document.form1.BankUserName.value;
            BankAddress=document.form1.BankAddress.value;
            useremail=document.form1.useremail.value;
            UserQQ = document.form1.UserQQ.value;
            zhifubao = document.form1.zhifubao.value;
            caifutong = document.form1.caifutong.value;


            if(bdName.length == 0){
                alert("温馨提示:\n请输入服务中心编号.");
                document.form1.bdName.focus();
                return false;
            }
            if(rName.length == 0){
                alert("温馨提示:\n请输入推荐人编号.");
                document.form1.rName.focus();
                return false;
            }
            if(FatherName.length == 0){
                alert("温馨提示:\n请输入接点人编号.");
                document.form1.FatherName.focus();
                return false;
            }
            if(UserID.length == 0){
                alert("温馨提示:\n请输入会员编号.");
                document.form1.UserID.focus();
                return false;
            }
            if(NickName.length == 0){
                alert("温馨提示:\n请输入会员编号.");
                document.form1.NickName.focus();
                return false;
            }
            if(password1.length == 0){
                alert("温馨提示:\n请输入一级密码.");
                document.form1.password1.focus();
                return false;
            }
            if(password1.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password1.focus();
                return false;
            }
            if(password12.length == 0){
                alert("温馨提示:\n请确认一级密码.");
                document.form1.password12.focus();
                return false;
            }
            if(password12.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password12.focus();
                return false;
            }
            if(password12 != password1){
                alert("温馨提示:\n一级密码输入不一致.");
                document.form1.password12.focus();
                return false;
            }
            if(password2.length == 0){
                alert("温馨提示:\n请输入二级密码.");
                document.form1.password2.focus();
                return false;
            }
            if(password2.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password2.focus();
                return false;
            }
            if(password22.length == 0){
                alert("温馨提示:\n请确认二级密码.");
                document.form1.password22.focus();
                return false;
            }
            if(password22.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password22.focus();
                return false;
            }
            if(password22 != password2){
                alert("温馨提示:\n二级密码输入不一致.");
                document.form1.password22.focus();
                return false;
            }
            if(password3.length == 0){
                alert("温馨提示:\n请输入三级密码.");
                document.form1.password3.focus();
                return false;
            }
            if(password3.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password3.focus();
                return false;
            }
            if(password32.length == 0){
                alert("温馨提示:\n请确认三级密码.");
                document.form1.password32.focus();
                return false;
            }
            if(password32.length <= 5){
                alert("温馨提示:\n密码小于6位.");
                document.form1.password32.focus();
                return false;
            }
            if(password32 != password3){
                alert("温馨提示:\n三级密码输入不一致.");
                document.form1.password32.focus();
                return false;
            }
            if(passQuestion.length == 0){
                alert("温馨提示:\n请输入密码安全问题.");
                document.form1.passQuestion.focus();
                return false;
            }
            if(passAnswer.length == 0){
                alert("温馨提示:\n请输入密码安全答案.");
                document.form1.passAnswer.focus();
                return false;
            }
          if(UserName.length == 0){
            alert("温馨提示:\n请输入会员姓名.");
            document.form1.UserName.focus();
            return false;
          }
            if(UserCard.length == 0){
                alert("温馨提示:\n请输入身份证号码.");
                document.form1.UserCard.focus();
                return false;
            }

            if(UserTel.length == 0){
                alert("温馨提示:\n请输入联系电话.");
                document.form1.UserTel.focus();
                return false;
            }
          if(UserQQ.length < 4){
            alert("温馨提示:\n请输入QQ号.");
            document.form1.UserQQ.focus();
            return false;
          }
          if (caifutong.length==0 && zhifubao.length == 0 && BankCard.length == 0) {
            alert("温馨提示:\n至少提供一种支付方式.");
            document.form1.zhifubao.focus();
            return false;
          }
            if(UserAddress.length == 0){
                alert("温馨提示:\n请输入联系地址.");
                document.form1.UserAddress.focus();
                return false;
            }
            /*if(BankCard.length == 0){
                alert("温馨提示:\n请输入开户帐号.");
                document.form1.BankCard.focus();
                return false;
            }
            if(BankUserName.length == 0){
                alert("温馨提示:\n请输入开户姓名.");
                document.form1.BankUserName.focus();
                return false;
            }
            if(BankAddress.length == 0){
                alert("温馨提示:\n请输入开户地址.");
                document.form1.BankAddress.focus();
                return false;
            }
            if(useremail.length == 0){
                alert("温馨提示:\n请输入电子信箱.");
                document.form1.useremail.focus();
                return false;
            }
             */
            if(classification.value == 0){
                alert("温馨提示:\n请选择所在省份.");
                return false;
            }
            if(menu.value == 0){
                alert("温馨提示:\n请选择所在城市.");
                return false;
            }
            return true;
        }
        -->
    </script>
    <style>
        #test select{
            width:100px;
        }
    </style>
</head>
<?php
$_system=new system_class();
$sys=$_system->system_information(1);
?>
<body onLoad="GetNickName();">
<form id="form1" name="form1" method="post" action="register2.php" onSubmit="return CheckForm();">
    <table  width="100%" height="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1">
        <tr>
            <td colspan="2" align="center"><?=$register2?><iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe></td>
        </tr>
        <tr>
            <td width="42%" align="right"><?=$register3?>
                ：</td>
            <td width="58%" align="left"><input name="bdName" type="text" id="bdName" value="<?=$_SESSION['bdname']?>" maxlength="15" />
                &nbsp;(*)&nbsp;<label id="bdNamelabel"/>
                <input name="button" type="button" class="button_blue" id="button" onclick='checknickname(1);' value="<?=$anniu6?>">
            </td>
        </tr>
        <tr>
            <td align="right"><?=$register4?>
                ：</td>
            <td align="left">
                <input name="rName" type="text" id="rName" value="<?=$_SESSION['nickname']?>" maxlength="15"/>
                &nbsp;(*)&nbsp;<label id=""/>
                <input name="button2" type="button" class="button_blue" id="button2" onclick='checknickname(2);' value="<?=$anniu6?>">
            </td>
        </tr>
        <tr>
            <td align="right"><?=$register5?>
                ：</td>
            <td align="left">
                <input name="FatherName" placeholder="必填，您的推荐人" type="text" id="FatherName"  value="<?=$_GET['nickname']?>" maxlength="15"/>
                &nbsp;(*)&nbsp;<label id="FatherNamelabel"/>
                <input name="button3" type="button" class="button_blue" id="button3" onclick='checknickname(3);' value="<?=$anniu6?>">
            </td>
        </tr>
        <tr>
            <td align="right"><?=$register6?>
                ：</td>
            <td align="left">
                <select name="TreePlace" id="TreePlace">
                    <option value="1" <?php if($_GET['tid']==1){?>selected<?php }?>>A区</option>
                    <option value="2" <?php if($_GET['tid']==2){?>selected<?php }?>>B区</option>
                </select></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><?=$register7?></td>
        </tr>
        <tr>
            <td align="right"><?=$register8?>
                ：</td>
            <td align="left"><input name="password1" type="password" id="password1" onBlur="Check('password1');" value="<?=$sys['password1']?>" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password1label"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register9?>
                ：</td>
            <td align="left"><input name="password12" type="password" id="password12" onBlur="Check('password12');" value="<?=$sys['password1']?>" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password12label"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register10?>
                ：</td>
            <td align="left"><input name="password2" type="password" id="password2" onBlur="Check('password2');" value="<?=$sys['password2']?>" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password2label"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register11?>
                ：</td>
            <td align="left"><input name="password22" type="password" id="password22" onBlur="Check('password22');" value="<?=$sys['password2']?>" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password22label"/></td>
        </tr>
        <tr style="display:none">
            <td align="right">三级密码：</td>
            <td align="left"><input name="password3" type="password" id="password3" onBlur="Check('password3');" value="333333" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password3label"/></td>
        </tr>
        <tr style="display:none">
            <td align="right">确认三级密码：</td>
            <td align="left"><input name="password32" type="password" id="password32" onBlur="Check('password32');" value="333333" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="password32label"/></td>
        </tr>
        <tr style="display:none">
            <td align="right">密码安全问题：</td>
            <td align="left"><input name="passQuestion" type="text" id="passQuestion" onBlur="Check('passQuestion');" value="china" maxlength="50"/>
                &nbsp;(*)&nbsp;<label id="passQuestionlabel"/></td>
        </tr>
        <tr style="display:none">
            <td align="right">密码安全答案：</td>
            <td align="left"><input name="passAnswer" type="text" id="passAnswer" onBlur="Check('passAnswer');" value="china" maxlength="50"/>
                &nbsp;(*)&nbsp;<label id="passAnswerlabel"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><?=$register12?></td>
        </tr>
        <tr>
            <td align="right"><?=$register13?>
                ：</td>
            <td align="left">
                <input name="UserID" type="text" id="UserID" maxlength="15" readonly="readonly"/>
                &nbsp;(*)&nbsp;
                <label id="FatherNamelabel"/>
                <input name="button4" type="button" class="button_blue" id="button4" onclick='checknickname(4);' value="<?=$anniu6?>"></td>
        </tr>
        <tr style="display:none">
            <td align="right">会员编号：</td>
            <td align="left"><input name="NickName" type="text" id="NickName" onBlur="Check('NickName');" maxlength="20" />
                &nbsp;(*)&nbsp;<label id="NickNamelabel"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register14?>
                ：</td>
            <td align="left"><input name="UserName" type="text" id="UserName" onBlur="Check('UserName');" value="" placeholder="请输入真实的姓名" maxlength="10"/>
                &nbsp;(*)&nbsp;<label id="UserNamelabel"/></td>
        </tr>

        <tr >
            <td align="right">身份证号码：</td>
            <td align="left"><input name="UserCard" type="text" id="UserCard" placeholder="请正确输入"  onblur="Check('UserCard');" value="" maxlength="20" onKeyUp="showBirthday(this)" />
                &nbsp;(*)&nbsp;<label id="UserCardlabel"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register15?>
                ：</td>
            <td align="left"><?=$register20?>
                <input name="sex" type="radio" id="sex" value="1" checked>
                <?=$register21?>
                <label for="radio">
                    <input type="radio" name="sex" id="sex" value="0">
                </label></td>
        </tr>
        <tr>
            <td align="right"><?=$register16?>
                ：</td>
            <td align="left"><label for="select"></label>
                <select name="nian" id="nian">
                    <?php for($i=1960;$i<=2030;$i++){?>
                        <option value="<?=$i?>"><?=$i?></option>
                    <?php }?>
                </select>
                <?=$register22?>
                <select name="yue" id="yue">
                    <?php for($i=1;$i<=12;$i++){?>
                        <option value="<?=$i?>"><?=$i?></option>
                    <?php }?>
                </select>
                <?=$register23?>
                <select name="ri" id="ri">
                    <?php for($i=1;$i<=31;$i++){?>
                        <option value="<?=$i?>"><?=$i?></option>
                    <?php }?>
                </select>
                <?=$register24?></td>
        </tr>
        <tr  style="display:none">
            <td align="right">学历：</td>
            <td align="left">
                <select name="xueli" id="xueli">
                    <option value="小学">小学</option>
                    <option value="初中">初中</option>
                    <option value="高中">高中</option>
                    <option value="中专">中专</option>
                    <option value="大学">大学</option>
                    <option value="本科">本科</option>
                </select>
            </td>
        </tr>
        <tr style="display:none">
            <td colspan="2" align="center">通讯地址</td>
        </tr>
        <tr>
            <td align="right"><?=$register17?>
                ：</td>
            <td align="left"><div id="test"></div></td>
        </tr>
        <tr style="display:none">
            <td align="right">收货详细地址：</td>
            <td align="left"><input name="UserAddress" type="text" id="UserAddress" onBlur="Check('UserAddress');" value="china" maxlength="50"/>
                &nbsp;(*)&nbsp;<label id="UserAddresslabel"/></td>
        </tr>
        <tr >
            <td align="right">联系电话：</td>
            <td align="left"><input name="UserTel" placeholder="输入11位电话号码" type="text" id="UserTel" onBlur="Check('UserTel');" value="" maxlength="20"/>
                &nbsp;(*)&nbsp;<label id="UserTellabel"/></td>
        </tr>
        <tr style="display:none">
            <td align="right">电子邮箱：</td>
            <td align="left"><input name="useremail" type="text" id="useremail" onBlur="Check('useremail');" value="china" maxlength="50"/>
                &nbsp;(*)&nbsp;
                <label id="useremaillabel"/></td>
        </tr>
        <tr>
            <td align="right">QQ号码：</td>
            <td align="left"><input name="UserQQ" type="text" id="UserQQ" placeholder="请正确输入"  value="" maxlength="12"/></td>
        </tr>
        <tr >
            <td colspan="2" align="center">支付方式</td>
        </tr>
        <tr style="display: none;">
            <td align="right">开户帐号：</td>
            <td align="left">
                <select name="bankname" id="bankname">
                    <option value="银行卡">银行卡</option>
                    <option value="支付宝">支付宝</option>
                    <option value="微信支付">微信支付</option>
                </select></td>
        </tr>
        <tr>
            <td align="right">银行卡号：</td>
            <td align="left"><input name="BankCard" placeholder="输入卡号，可以留空" type="text" id="BankCard" onBlur="Check('BankCard');" value="" maxlength="20"/>
                &nbsp;&nbsp;<label id="BankCardlabel"/></td>
        </tr>
        <tr >
            <td align="right">开户姓名：</td>
            <td align="left"><input name="BankUserName" placeholder="可以留空" type="text" id="BankUserName" onBlur="Check('BankUserName');" value="" maxlength="20"/>
                &nbsp;&nbsp;<label id="BankUserNamelabel"/></td>
        </tr>
        <tr >
            <td align="right">开户地址：</td>
            <td align="left"><input name="BankAddress" placeholder="可以留空" type="text" id="BankAddress" onBlur="Check('BankAddress');" value="" maxlength="50"/>
                &nbsp;&nbsp;<label id="BankAddresslabel"/></td>
        </tr>
        <tr >
            <td align="right">支付宝账号：</td>
            <td align="left"><input name="zhifubao" placeholder="可以留空" type="text" id="zhifubao" value="" maxlength="50"/></td>
        </tr>
        <tr >
            <td align="right">微信支付号：</td>
            <td align="left"><input name="caifutong" placeholder="可以留空" type="text" id="caifutong"  value="" maxlength="50"/></td>
        </tr>
        <tr>
            <td align="right"><?=$register19?>
                ：</td>
            <td align="left">
                <select name="uLevel" id="uLevel">
                    <?php
                    $_ulevel=new ulevel_class();
                    for($i=1;$i<=4;$i++){
                        $ul=$_ulevel->getulevelbyulevel($i);
                        ?>
                        <option value="<?=$i?>">[$<?=$ul['lsk']?>]</option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input name="submit" type="submit" class="button_green" value="<?=$anniu1?>" id="submit" onClick="javascript:return confirm('您确认注册吗？请确认信息填写完整正确.');">
            </td>
        </tr>
    </table>
</form>

</body>
</html>