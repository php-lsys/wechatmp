<?php
/**
 * 消息接口
 * 自动回复实现参考
 */
use LSYS\Wechat\Msg;
use LSYS\Wechat\Msg\CallbackCallable;
use LSYS\Wechat\Msg\Type\Text;
use LSYS\Wechat\Card;
include_once __DIR__."/Bootstarp.php";

// $_GET='{"signature":"341e976400f579d24d54e5f5c25d30a5cb11c09b","timestamp":"1483514069","nonce":"1742318273","openid":"oUCt-xAeVs7n5_WM5gYFV3WgJjbE"}';
// $_GET=json_decode($_GET,true);
// $GLOBALS["HTTP_RAW_POST_DATA"]='<xml><ToUserName><![CDATA[gh_c530a45c3207]]></ToUserName>
// <FromUserName><![CDATA[oUCt-xAeVs7n5_WM5gYFV3WgJjbE]]></FromUserName>
// <CreateTime>1483514069</CreateTime>
// <MsgType><![CDATA[text]]></MsgType>
// <Content><![CDATA[g]]></Content>
// <MsgId>6371644409986985072</MsgId>
// </xml>';


$msg=\LSYS\Wechat\DI::get()->wechatMsg();
$msg->setCallback(new CallbackCallable(function($msg,$data){
	switch ($msg){
		case 'event':
			switch (strtolower($data['Event'])){
				//关注公众号
				case 'subscribe':
					if (isset($data['EventKey'])){
						//带参数二维码关注微信
						$id=str_replace('qrscene_','', $data['EventKey']);//关注参数
					}else{
						//普通关注	
					}
				break;
				//取消关注公众号
				case 'unsubscribe':
					
				break;
				//上报位置
				case 'location':
					
				break;
				//已关注再次关注公众号
				case 'scan':
					if (isset($data['EventKey'])){
						//带参数二维码关注微信
						$id=$data['EventKey'];//关注参数
					}else{
						//普通关注
					}
				break;
				//单击菜单
				case 'click':
						
				break;
				//跳转菜单
				case 'view':
					
				break;
				//用户领取卡片
				case 'user_get_card':
					$card_id=$data['CardId'];
					$code="198374613512";//你的密码
					$openid=$data['FromUserName'];
					$card=LSYS\Wechat\DI::get()->wechatCard();
					$data=$card->qrcode(Card::QR_CARD,array(
						"card_id"=>$card_id,
						"code"=> $code,
						"openid"=> $openid,
						"outer_str"=>"MSG"//来源
					));
				break;
				//模板消息完成发送
				case 'templatesendjobfinish':
					if ($data['Status']!='success'){
						//发送失败
					}else{
						//成功
					}
				break;
				case 'qualification_verify_success':
					//微信认证成功
				break;
				case 'qualification_verify_fail':
					//微信认证失败
				break;
				case 'naming_verify_success':
					//微信认证失败
				break;
				case 'naming_verify_success':
					//名称认证成功（即命名成功）
				break;
				case 'naming_verify_fail':
					//名称认证失败（这时虽然客户端不打勾，但仍有接口权限）
				break;
				case 'annual_renew':
					//年审通知
				break;
				case 'verify_expired':
					//认证过期失效通知
				break;
				//群发消息完成发送
				case 'masssendjobfinish':
					if ($data['Status']!='send success'){
						//完成发送
					}elseif ($data['Status']!='send fail'){
						//发送失败
					}else{
						//其他失败.
// 						err(10001), //涉嫌广告 
// 						err(20001), //涉嫌政治 
// 						err(20004), //涉嫌社会 
// 						err(20002), //涉嫌色情 
// 						err(20006), //涉嫌违法犯罪 
// 						err(20008), //涉嫌欺诈 
// 						err(20013), //涉嫌版权 
// 						err(22000), //涉嫌互推(互相宣传) 
// 						err(21000), //涉嫌其他
// 						err(30001) // 原创校验出现系统错误且用户选择了被判为转载就不群发
// 						err(30002) // 原创校验被判定为不能群发
// 						err(30003) // 原创校验被判定为转载文且用户选择了被判为转载就不群发
					}
				break;
			}
		break;
		case 'text':
			//文本消息
		break;
		case 'image':
			//图
		break;
		case 'voice':
			//声音
		break;
		case 'video':
			//视频
		break;
		case 'shortvideo':
			//小视频
		break;
		case 'location':
			//位置
		break;
		case 'link':
			//链接
		break;
	}
	//自动回复返回 type 接口实现即可
	return new Text("fasd");
}))->listen();



