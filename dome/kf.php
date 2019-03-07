<?php
/**
 * 客服接口
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\KF;
// use LSYS\Wechat\Msg\Type\Text;
// use LSYS\Wechat\Msg\Type\Card;
use LSYS\Wechat\Msg\Type\Image;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));


$kf=\LSYS\Wechat\DI::get()->wechatKF();
//添加
// $data=$kf->kfAdd("aaa@b.com","hi","123456");
// outresult($data);

//修改
// $data=$kf->kfUpdate("aaa@b.com","hi","123456");
// outresult($data);

//删除
// $data=$kf->kfDel("aaa@b.com","hi","123456");
// outresult($data);
//修改头像
// $data=$kf->kfAvatar("aaa@b.com","aa.png");
// outresult($data);

//获取
// $data=$kf->kfGet();
// outresult($data);

//发送消息
// $data=$kf->kfSend("oUCt-xAeVs7n5_WM5gYFV3WgJjbE",new Card("pUCt-xCoWlCe4V8qq7coE0yApdSc"));
// outresult($data);
$data=$kf->kfSend("oUCt-xAeVs7n5_WM5gYFV3WgJjbE",new Image("sq5NlF4CnD1q5lMek4EaGvMLPq6IgkidrP-ZEcV4C2y45IJLOMWNYSoThcf8rGBa"));
outresult($data);
