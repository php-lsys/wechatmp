<?php
/**
 * 短网址
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Utils;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));
$data=(\LSYS\Wechat\DI::get()->wechatUtils())->shorturl("http://www.baidu.com/ssss/sss/sss/sss/sss0");
outresult($data);