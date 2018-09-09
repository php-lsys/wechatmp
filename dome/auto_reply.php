<?php
/**
 * 公众号后台自动回复设置
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\AutoReply;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

//公众号后台自动回复设置
print_r((\LSYS\Wechat\DI::get()->wechat_auto_reply())->get());