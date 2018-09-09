<?php
/**
 * 语义识别
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Utils;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));
//回答基本智障,不建议使用....
$data=\LSYS\Wechat\DI::get()->wechat_utils()->semproxy("有什么好的酒店","深圳","hotel","user_open_id");
outresult($data);