<?php
/**
 * 参数二维码
 */
use LSYS\Wechat\Qrcode;
use LSYS\Wechat\Access;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$qrcode=\LSYS\Wechat\DI::get()->wechatQrcode();

//长久
$result=$qrcode->qrcode(1);
if (!strval($result)){
	echo $result->getMsg();
}

echo Qrcode::qrcodeLink($result);

echo "\n";

//临时
$result=$qrcode->qrcodeTmp(2);
if (!strval($result)){
	echo $result->getMsg();
}

echo Qrcode::qrcodeLink($result);