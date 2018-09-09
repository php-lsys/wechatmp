<?php
/**
 * 资源管理
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Media;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$media=\LSYS\Wechat\DI::get()->wechat_media();

//上传临时资源
// $data=$media->upload(__DIR__."/aa.png",Media::TYPE_IMAGE);
// outresult($data);

//获取临时资源
// $data=$media->get($data->get_data());
// if (!strval($data)){
// 	die($data->get_msg());
// }else{
// 	//图片为图片内容
// 	//视频为地址
// 	print_r($data->get_data());
// }

//上传永久图片,文章用到
$data=$media->material_img(__DIR__."/aa.png");
if (!strval($data)){
	die($data->get_msg());
}else{
	//图片为图片内容
	//视频为地址
	print_r($data->get_data());
}


//上传永久文件,消息或其他用到
// $data=$media->material_upload(__DIR__."/aa.png",Media::TYPE_IMAGE);
// outresult($data);

//获取资源
// $data=$media->material_get("9Y7jscbgJYVNf_zz-dQ0Fyr-epZMmgYx6QJ-jnj_xno");
// if (!strval($data)){
// 	die($data->get_msg());
// }else{
// 	//图片为图片内容
// 	//视频为地址
// 	print_r($data->get_data());
// }

//删除资源
// $data=$media->material_del("9Y7jscbgJYVNf_zz-dQ0Fyr-epZMmgYx6QJ-jnj_xno");
//outresult($data);

//获取资源列表
// $data=$media->material_batchget(Media::TYPE_IMAGE);
// outresult($data);
//获取资源数量
// $data=$media->material_count();
// outresult($data);

//添加文章
// $data=$media->material_add_news(array(
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
// $data=$media->material_update_news('9Y7jscbgJYVNf_zz-dQ0F60YZ1VwxOaM_KUudG3aPRc',0,array(
//        "title"=> '标题1',
//        "thumb_media_id"=>'9Y7jscbgJYVNf_zz-dQ0F27rJMCMUN3jlNpdIlNrZdk',
//        "author"=> '作者',
//        "digest"=> '摘要',
//        "show_cover_pic"=> '',
//        "content"=> '内容',
//        "content_source_url"=>'https://segmentfault.com/a/1190000000725185'
//     ));
// outresult($data);
