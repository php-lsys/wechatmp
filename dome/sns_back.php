<?php
/**
 * 登录返回处理
 */
use LSYS\Wechat\Sns;
include_once __DIR__."/Bootstarp.php";
$sns=\LSYS\Wechat\DI::get()->wechatSNS();
$result=$sns->accessToken();
if (!$result->getStatus()){
	die($result->getMsg());
}
$user_info=$sns->getUser();
if (!$user_info->getStatus()){
	die($user_info->getMsg());
}
echo "<pre>";
print_r($user_info->getData());
