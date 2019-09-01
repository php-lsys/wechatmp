<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg\Type;
use LSYS\Wechat\Msg\Type;
/**
 * wechat 返回视频元素类
 * @author User
 */
class Video implements Type{
	protected  $media_id;
	protected  $title;
	protected  $body;
	protected  $thumb_media_id;
	public function __construct($media_id,$title,$body,$thumb_media_id=null){
		$this->media_id=$media_id;
		$this->title=$title;
		$this->body=$body;
		$this->thumb_media_id=$thumb_media_id;
	}
	public function toXml($ToUserName, $FromUserName){
		$time = time();
		$Tpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Video>
		<MediaId><![CDATA[%s]]></MediaId>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		</Video>";
		$resultStr = sprintf($Tpl, $ToUserName, $FromUserName, $time,$this->toName(),$this->media_id,$this->title, $this->body);
		return  $resultStr;
	}
	public function toArray(){
		return array(
			"media_id"=>$this->media_id,
	      "thumb_media_id"=>$this->thumb_media_id,
	      "title"=>$this->title,
	      "description"=>$this->body
		);
	}
	public function toName(){
		return 'video';
	}
}