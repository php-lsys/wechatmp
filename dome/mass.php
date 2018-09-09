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
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$mass=\LSYS\Wechat\DI::get()->wechat_mass();

//按TAG群发
// $data=$mass->tag_sendall('102',new Text("ttt"));
// outresult($data);

//按ID群发,最少2人
$data=$mass->openid_send(array("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","oUCt-xAeVs7n5_WM5gYFV3WgJjbE"), new Text("ttt"));
outresult($data);

//预览
// $data=$mass->preview("oUCt-xAeVs7n5_WM5gYFV3WgJjbE", new Text("ttt"));
// outresult($data);

// //取消群发
// $data=$mass->delete_send("1000000003");
// outresult($data);

// //查询群发
// $data=$mass->get("1000000003");
// outresult($data);
