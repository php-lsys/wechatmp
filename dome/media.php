<?php
/**
 * 资源管理
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Media;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::setShareAccess(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$media=\LSYS\Wechat\DI::get()->wechatMedia();

//上传临时资源
// $data=$media->upload(__DIR__."/aa.png",Media::TYPE_IMAGE);
// outresult($data);

//获取临时资源
// $data=$media->get($data->getData());
// if (!strval($data)){
// 	die($data->getMsg());
// }else{
// 	//图片为图片内容
// 	//视频为地址
// 	print_r($data->getData());
// }

//上传永久图片,文章用到
$data=$media->materialImg(__DIR__."/aa.png");
if (!strval($data)){
	die($data->getMsg());
}else{
	//图片为图片内容
	//视频为地址
	print_r($data->getData());
}


//上传永久文件,消息或其他用到
// $data=$media->materialUpload(__DIR__."/aa.png",Media::TYPE_IMAGE);
// outresult($data);

//获取资源
// $data=$media->materialGet("9Y7jscbgJYVNf_zz-dQ0Fyr-epZMmgYx6QJ-jnj_xno");
// if (!strval($data)){
// 	die($data->getMsg());
// }else{
// 	//图片为图片内容
// 	//视频为地址
// 	print_r($data->getData());
// }

//删除资源
// $data=$media->materialDel("9Y7jscbgJYVNf_zz-dQ0Fyr-epZMmgYx6QJ-jnj_xno");
//outresult($data);

//获取资源列表
// $data=$media->materialBatchget(Media::TYPE_IMAGE);
// outresult($data);
//获取资源数量
// $data=$media->materialCount();
// outresult($data);

//添加文章
// $data=$media->materialAddNews(array(
//        "title"=> '标题',
//        "thumb_media_id"=>'9Y7jscbgJYVNf_zz-dQ0F27rJMCMUN3jlNpdIlNrZdk',
//        "author"=> '作者',
//        "digest"=> '摘要',
//        "show_cover_pic"=> '',
//        "content"=> '内容',
//        "content_source_url"=>'https://segmentfault.com/a/1190000000725185'
//     ));
// outresult($data);

//修改文章
// $data=$media->materialUpdateNews('9Y7jscbgJYVNf_zz-dQ0F60YZ1VwxOaM_KUudG3aPRc',0,array(
//        "title"=> '标题1',
//        "thumb_media_id"=>'9Y7jscbgJYVNf_zz-dQ0F27rJMCMUN3jlNpdIlNrZdk',
//        "author"=> '作者',
//        "digest"=> '摘要',
//        "show_cover_pic"=> '',
//        "content"=> '内容',
//        "content_source_url"=>'https://segmentfault.com/a/1190000000725185'
//     ));
// outresult($data);
