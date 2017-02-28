<?php
if(!defined('InEmpireBak'))
{
	exit();
}
//系統信息
if (function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if ($onoff){
        $onoff="打開";
    }else{
        $onoff="關閉";
    }
    if (function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="可以";
    }else{
        $upload="不可以";
    }
//取得操作系統
function GetUseSys()
{
	$phpos=explode(" ",php_uname());
	$sys=$phpos[0]."&nbsp;".$phpos[1];
	if(empty($phpos[0]))
	{
	$sys="---";
	}
	return $sys;
}
//是否運行於安全模式
function GetPhpSafemod()
{
	$phpsafemod=get_cfg_var("safe_mode");
	if($phpsafemod==1)
	{
		$word="PHP運行於安全模式";
	}
	else
	{
		$word="正常模式";
	}
	return $word;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>帝國備份王</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">我的狀態</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="25"> <div align="left">登錄者:&nbsp;<b> 
                    <?=$loginin?>
                    </b></div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><a href="phpinfo.php" target="_blank"></a></strong> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" height="16"><strong><a href="phpinfo.php" target="_blank"><font color="#FFFFFF">系統信息</font></a></strong></td>
                <td><div align="right"></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="26">服務器軟件: 
                  <?=$_SERVER['SERVER_SOFTWARE']?>                </td>
                <td height="26">操作系統&nbsp;&nbsp;:
				<? echo GetUseSys();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">PHP版本&nbsp;&nbsp; : <? echo PHP_VERSION;?></td>
                <td height="25">MYSQL版本&nbsp;:
				<? echo @mysql_get_server_info();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">全局變量&nbsp;&nbsp;: 
                  <?=$onoff?>                </td>
                <td height="25">上傳文件&nbsp;&nbsp;: 
                  <?=$upload?>                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">登錄者IP&nbsp;&nbsp;:
				<? echo $_SERVER['REMOTE_ADDR'];?></td>
                <td height="25">當前時間&nbsp;&nbsp;:
				<? echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">&nbsp;</td>
                <td height="25">安全模式&nbsp;&nbsp;: 
                  <?=GetPhpSafemod()?>                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="32" valign="bottom"> 
      <div align="center"></div></td>
  </tr>
</table>
</body>
</html>