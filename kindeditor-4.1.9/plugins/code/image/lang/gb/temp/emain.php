<?php
if(!defined('InEmpireBak'))
{
	exit();
}
//ϵͳ��Ϣ
if (function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if ($onoff){
        $onoff="��";
    }else{
        $onoff="�ر�";
    }
    if (function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="����";
    }else{
        $upload="������";
    }
//ȡ�ò���ϵͳ
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
//�Ƿ������ڰ�ȫģʽ
function GetPhpSafemod()
{
	$phpsafemod=get_cfg_var("safe_mode");
	if($phpsafemod==1)
	{
		$word="PHP�����ڰ�ȫģʽ";
	}
	else
	{
		$word="����ģʽ";
	}
	return $word;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���ݹ���</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">�ҵ�״̬</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="25"> <div align="left">��¼��:&nbsp;<b> 
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
                <td width="50%" height="16"><strong><a href="phpinfo.php" target="_blank"><font color="#FFFFFF">ϵͳ��Ϣ</font></a></strong></td>
                <td><div align="right"></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="26">���������: 
                  <?=$_SERVER['SERVER_SOFTWARE']?>                </td>
                <td height="26">����ϵͳ&nbsp;&nbsp;:
				<? echo GetUseSys();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">PHP�汾&nbsp;&nbsp; : <? echo PHP_VERSION;?></td>
                <td height="25">MYSQL�汾&nbsp;:
				<? echo @mysql_get_server_info();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">ȫ�ֱ���&nbsp;&nbsp;: 
                  <?=$onoff?>                </td>
                <td height="25">�ϴ��ļ�&nbsp;&nbsp;: 
                  <?=$upload?>                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">��¼��IP&nbsp;&nbsp;:
				<? echo $_SERVER['REMOTE_ADDR'];?></td>
                <td height="25">��ǰʱ��&nbsp;&nbsp;:
				<? echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">&nbsp;</td>
                <td height="25">��ȫģʽ&nbsp;&nbsp;: 
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