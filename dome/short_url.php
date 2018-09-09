<?php
/**
 * 短网址
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Utils;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));
$data=(\LSYS\Wechat\DI::get()->wechat_utils())->shorturl("http://www.baidu.com/ssss/sss/sss/sss/sss0");
outresult($data);