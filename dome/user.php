<?php
/**
 * 用户接口
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\User;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));


$user=(\LSYS\Wechat\DI::get()->wechat_user());
//添加标签
$data=$user->tag_add("a");
outresult($data);

//获取标签
$data=$user->tag_get();
outresult($data);

//修改标签
$data=$user->tag_update("102","asdafa");
outresult($data);

//删除标签
$data=$user->tag_del("101");
outresult($data);

//根据标签获取用户
$data=$user->tag_user_get("102");
outresult($data);

//给用户打标签
$data=$user->tag_batchtagging("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","102");
outresult($data);

//给用户去除标签
$data=$user->tag_batchuntagging("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","103");
outresult($data);

// 获取指定用户的标签
$data=$user->tag_get_user_tag("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//给用户打别名
$data=$user->remark("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","haha");
outresult($data);

//获取用户资料
$data=$user->get_user("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//批量获取用户资料
$data=$user->batchget_user(array("oUCt-xAeVs7n5_WM5gYFV3WgJjbE"));
outresult($data);

//获取用户列表
$data=$user->get_user_list();
outresult($data);

//获取屏蔽用户
$data=$user->get_blacklist();
outresult($data);

//屏蔽用户
$data=$user->batch_blacklist("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//取消屏蔽用户
$data=$user->batch_un_blacklist("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);