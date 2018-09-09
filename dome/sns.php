<?php
/**
 * 微信内登录
 */
use LSYS\Wechat\Sns;
use LSYS\Wechat\Utils;
include_once __DIR__."/Bootstarp.php";

$url="http://192.168.2.210/lwxtplmsg/dome/sns_back.php";
Utils::redirect((\LSYS\Wechat\DI::get()->wechat_sns())->access_url($url));