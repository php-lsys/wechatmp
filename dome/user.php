<?php
/**
 * 用户接口
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\User;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));


$user=(\LSYS\Wechat\DI::get()->wechatUser());
//添加标签
$data=$user->tagAdd("a");
outresult($data);

//获取标签
$data=$user->tagGet();
outresult($data);

//修改标签
$data=$user->tagUpdate("102","asdafa");
outresult($data);

//删除标签
$data=$user->tagDel("101");
outresult($data);

//根据标签获取用户
$data=$user->tagUserGet("102");
outresult($data);

//给用户打标签
$data=$user->tagBatchtagging("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","102");
outresult($data);

//给用户去除标签
$data=$user->tagBatchuntagging("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","103");
outresult($data);

// 获取指定用户的标签
$data=$user->tagGetUserTag("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//给用户打别名
$data=$user->remark("oUCt-xAeVs7n5_WM5gYFV3WgJjbE","haha");
outresult($data);

//获取用户资料
$data=$user->getUser("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//批量获取用户资料
$data=$user->batchgetUser(array("oUCt-xAeVs7n5_WM5gYFV3WgJjbE"));
outresult($data);

//获取用户列表
$data=$user->getUserList();
outresult($data);

//获取屏蔽用户
$data=$user->getBlacklist();
outresult($data);

//屏蔽用户
$data=$user->batchBlacklist("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);

//取消屏蔽用户
$data=$user->batchUnBlacklist("oUCt-xAeVs7n5_WM5gYFV3WgJjbE");
outresult($data);