<?php
use LSYS\Wechat\DI;
include_once __DIR__."/../vendor/autoload.php";

//配置存放到文件,如果不想在文件中,实现Config接口
LSYS\Config\File::dirs(array(
		__DIR__."/config",
));
//设置使用的配置文件
DI::$config="wechat_mp.default";
//如果你的配置文件自定义存放位置[如存放到数据库],通过以下方法即可
// class mydi implements LSYS\Wechat\DI{//实现一个配置依赖
//     public function wechat_config(){
//         return new \LSYS\Config\Arr(array(
//             "app_id"=>'wxa3f2202198fde906',
//             //access 用到
//             "appkey_secret"=>'d8fbfe6912f602bdad41c5140f7a0326',
//             //msg 用到
//             "msg_token"=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
//             "msg_aeskey"=>'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG',
//             //模板消息用到
//             'tpl_map'=>array(
//                 'reg_dome'=>array(
//                     'template_id'=>'HUjOa2TnKf6Vn5s7E_j29GRTEU9MkW-jc686jwVI6xQ',
//                     'colors'=>array(
//                         'title'=>'#161511',
//                         'body'=>'#663399'
//                     )
//                 )
//             )
//         ));
//     }
// }
// DI::set(new mydi());

function outresult(LSYS\Wechat\Result $result){
	if (!$result->get_status()){
		echo "fail:".$result->get_msg()."\n";
	}else {
		$m=PHP_SAPI=='cli'?"\n":"<pre>";
		echo "success:".$m;
		print_r($result->get_data());
		echo $m;
	}
}