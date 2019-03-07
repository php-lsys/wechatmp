<?php
/**
 * 菜单管理
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Menu;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$menu=array(
	 array(
	 		'type' => 'click',
	 		'name' => '按钮1',
	 		'key' =>  'tt',
	 ),
	 array(
	 		"type"=>"view",
	 		"name"=>"歌手简介",
	 		"url"=>"http://www.qq.com/"
	 ),
	 array(
	 		"name"=>"歌手简介",
	 		"sub_button"=>array(
	 				array(
	 						"type"=>"view",
	 						"name"=>"歌手简介",
	 						"url"=>"http://www.qq.com/"
	 				),
	 		)
	 ),
);
//菜单创建
$obj=\LSYS\Wechat\DI::get()->wechatMenu();
$data=$obj->menuCreate($menu);
outresult($data);

//获取菜单
$data=$obj->menuGet();
outresult($data);

//参数菜单
$data=$obj->menuDelete();
outresult($data);

