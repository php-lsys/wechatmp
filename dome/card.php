<?php
/**
 * 卡券管理
 */
use LSYS\Wechat\Access;
use LSYS\Wechat\Card;
use LSYS\Wechat\KF;
use LSYS\Wechat\Media;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
Access::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));

$card=\LSYS\Wechat\DI::get()->wechat_card();

$media=\LSYS\Wechat\DI::get()->wechat_media();

$logo_url=$media->material_img("a.png")->get_data();

$mcard_data=card::meeting_ticket(array(
			'logo_url'=>'http://mmbiz.qpic.cn/mmbiz_png/xj7LAW0azJ53t3O6iaIwK2sjCMm0nv0YHWhktEYsVd7PNjkmjWYXkt0UGiaIIxpogfJ5ibImU1Yl08ibwBkCbYBE4g/0',
			'url'=>'http://mmbiz.qpic.cn/',//门票详情或订单页
			'brand_name'=>'商家名',
			'title'=>'某某门票数据',
			'phone'=>'13800138000',
			'desp'=>'门票介绍',
			'sub_title'=>'网站名',
			'detail'=>'会议时间：xxx;地点：xxx',
			//可选
			'code_type'=>'CODE_TYPE_QRCODE',//条码类型
			'notice'=>'门票提示',
			'start_time'=>time(),//开始
			'end_time'=>time()+3600*24,//结束
			'get_limit'=>1,//限制领取
			'quantity'=>1,//库存
		)
);
if (!$mcard_data->get_status()){
	die('fail');
}
//创建会议门票
$data=$card->create($mcard_data->get_data());
outresult($data);
$card_id=$data->get_data();

//生成二维码,放置在网页上,识别二维码后可加入卡包
$data=$card->qrcode(Card::QR_CARD,array(
			"card_id"=>$card_id,
			"code"=> "198374613512",
// 			'expire_seconds'=>1800,//卡券过期时间,默认1年
			"openid"=> "oUCt-xAeVs7n5_WM5gYFV3WgJjbE",
			"outer_str"=>""
		));
outresult($data);


//加入卡包后会收到信息 event:user_get_card
//在信息中修改票信息
$data=$card->meeting_update(
		$card_id,
		"198374613512",
		"座位03",
		"东区",
		"东门"
);
outresult($data);


//消费卡券时,先查询指定卡券状态
$data=$card->code_get($card_id, "198374613512");
outresult($data);

//核销卡券
$data=$card->code_consume($card_id, "198374613512");
outresult($data);



//景点门票--------------------

$scenic_data=card::scenic_ticket(array(
		'logo_url'=>'http://mmbiz.qpic.cn/mmbiz_png/xj7LAW0azJ53t3O6iaIwK2sjCMm0nv0YHWhktEYsVd7PNjkmjWYXkt0UGiaIIxpogfJ5ibImU1Yl08ibwBkCbYBE4g/0',
		'url'=>'http://mmbiz.qpic.cn/',//门票详情或订单页
		'brand_name'=>'商家名',
		'title'=>'某某门票数据',
		'phone'=>'13800138000',
		'desp'=>'门票介绍',
		'sub_title'=>'网站名',
		'detail'=>'会议时间：xxx;地点：xxx',
		//可选
		'code_type'=>'CODE_TYPE_QRCODE',//条码类型
		'notice'=>'门票提示',
		'start_time'=>time(),//开始
		'end_time'=>time()+3600*24,//结束
		'get_limit'=>1,//限制领取
		'quantity'=>1,//库存
)
		);
if (!$scenic_data->get_status()){
	die('fail');
}
//创建景点门票
$data=$card->create($mcard_data->get_data());
outresult($data);

$card_id=$data->get_data();

//景点门票二维码
$data=$card->qrcode(Card::QR_CARD,array(
		"card_id"=>$card_id,
		"code"=> "198374613512",
		// 			'expire_seconds'=>1800,//卡券过期时间,默认1年
		"openid"=> "oUCt-xAeVs7n5_WM5gYFV3WgJjbE",
		"outer_str"=>""
));
outresult($data);




//电影票,飞机票 示例参考以上示例即可
//电影票特殊数据:
// detail'=>'影片信息',
//飞机票特殊数据
// 'from'=>'起点',
// 'to'=>'终点',
// 'flight'=>'航班',
// 'departure_time'=>'触发时间',
// 'landing_time'=>'到达时间',
// 'air_model'=>'机型:如A380',



//以下测试临时用..
$kf=\LSYS\Wechat\DI::get()->wechat_kf();
//发送消息
$data=$kf->kf_send("oUCt-xAeVs7n5_WM5gYFV3WgJjbE",new \LSYS\Wechat\Msg\Type\Card($card_id));
outresult($data);