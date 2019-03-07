<?php
/**
 * 群发 
 * 订阅号 每天1次 服务号 每个用户每周1次,每天100次
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Mass;
use LSYS\Wechat\Msg\Type\Text;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$mass=\LSYS\Wechat\DI::get()->wechatMass();

//按TAG群发
// $data=$mass->tagSendall('102',new Text("ttt"));
// outresult($data);

//按ID群发,最少2人
$data=$mass->openidSend(array("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","oUCt-xAeVs7n5_WM5gYFV3WgJjbE"), new Text("ttt"));
outresult($data);

//预览
// $data=$mass->preview("oUCt-xAeVs7n5_WM5gYFV3WgJjbE", new Text("ttt"));
// outresult($data);

// //取消群发
// $data=$mass->deleteSend("1000000003");
// outresult($data);

// //查询群发
// $data=$mass->get("1000000003");
// outresult($data);
