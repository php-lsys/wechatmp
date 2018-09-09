<?php
/**
 * 登录返回处理
 */
use LSYS\Wechat\Sns;
include_once __DIR__."/Bootstarp.php";
$sns=\LSYS\Wechat\DI::get()->wechat_sns();
$result=$sns->access_token();
if (!$result->get_status()){
	die($result->get_msg());
}
$user_info=$sns->get_user();
if (!$user_info->get_status()){
	die($user_info->get_msg());
}
echo "<pre>";
print_r($user_info->get_data());
