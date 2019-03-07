<?php
/**
 * 模板消息示例
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\TplMsg;
include_once __DIR__."/Bootstarp.php";
// 共享其他微信接口的授权 access 当你有其他微信接口时,可通过此方法共享 access ,来保证全局 access 唯一
// Access::setShareAccess(new class implements LSYS\Wechat\AccessCache{
// 	public function getAccess($appid){
// 		//这里实现共享的access
// 	}
// 	public function setAccess($appid,$access,$time){
// 		//这里access 存储
// 	}
// });

// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

// 获取使用redis缓存 access
// Access::setShareAccess(new LSYS\Wechat\AccessCache\Redis());

//模板列表
// $data=(new TplMsg)->getTemplate();
//outresult($data);
//刪除模板
// $data=(new TplMsg)->delTemplate("_HQXSfL6NaiWim4J6l9iY7T4y1CIxWw5T6IzMhKl2es");
// outresult($data);

//设置行业
// $data=(new TplMsg)->setIndustry(1, 2);
// outresult($data);

// 获取行业
// $data=(new TplMsg)->getIndustry();
//outresult($data);


//模板创建,需设置行业
// $data=(new TplMsg)->addTemplate("TM00015");
// if (strval($data)){
// 	//success
// 	echo $tpl_id=$data->getData();//模板ID
// 	//
// }else echo "fail:".$data->getMsg()."\n";


// 通过模板ID发送消息
// $tpl_id='HUjOa2TnKf6Vn5s7E_j29GRTEU9MkW-jc686jwVI6xQ';
// $data=(new TplMsg)->tplSend(
// 		"oUCt-xAeVs7n5_WM5gYFV3WgJjbE",
// 		$tpl_id,
// 		array("title"=>array(
// 			"value"=>uniqid(),
// 			"color"=>"#173177"
// 		)),
// 		"http://baidu.com"
// 		);
// if (strval($data)){
// 	//success
// 	echo $msgid=$data->getData();//消息ID
// }else echo "fail:".$data->getMsg()."\n";


//通过配置名发送消息
$data=(\LSYS\Wechat\DI::get()->wechatTplmsg())->send(
	"oUCt-xAeVs7n5_WM5gYFV3WgJjbE", 
	"reg_dome",
	array("title"=>"2010-11-11 11:11:11","body"=>"fasdf"),
	"http://192.168.2.210/lwxtplmsg/dome/sns.php"
);
if (strval($data)){
	//success
	echo $msgid=$data->getData();//消息ID
}else echo "fail:".$data->getMsg()."\n";