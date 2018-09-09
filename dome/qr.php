<?php
/**
 * 参数二维码
 */
use LSYS\Wechat\Qrcode;
use LSYS\Wechat\Access;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$qrcode=\LSYS\Wechat\DI::get()->wechat_qrcode();

//长久
$result=$qrcode->qrcode(1);
if (!strval($result)){
	echo $result->get_msg();
}

echo Qrcode::qrcode_link($result);

echo "\n";

//临时
$result=$qrcode->qrcode_tmp(2);
if (!strval($result)){
	echo $result->get_msg();
}

echo Qrcode::qrcode_link($result);