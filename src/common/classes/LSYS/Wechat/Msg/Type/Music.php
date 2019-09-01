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
 * wechat 返回音乐元素类
 * @author User
 */
class Music implements Type{
	protected $title;
	protected $desp;
	protected $url;
	protected $hdurl;
	protected $media_id;
	public function __construct($title,$desp,$url,$hdurl=null,$media_id=null){
		$this->title=$title;
		$this->desp=$desp;
		$this->url=$url;
		if (empty($hdurl)) {
			$hdurl=$url;
		}
		$this->hdurl=$hdurl;
		$this->media_id=$media_id;
	}
	public function toXml($ToUserName, $FromUserName){
		$Tpl = "<xml>
					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[%s]]></MsgType>
					 <Music>
						 <Title><![CDATA[%s]]></Title>
						 <Description><![CDATA[%s]]></Description>
						 <MusicUrl><![CDATA[%s]]></MusicUrl>
						 <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
						<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
					 </Music>
				 </xml>";
		if (empty($hdurl)) {
			$url=$hdurl;
		}
		$time = time();
		$resultStr = sprintf($Tpl, $ToUserName, $FromUserName, $time,$this->toName(), $this->title, $this->desp,$this->url,$this->hdurl,$this->media_id);
		return  $resultStr;
	}
	public function toArray(){
		return array
		(
				"title"=>$this->title,
		      "description"=> $this->desp,
		      "musicurl"=>$this->url,
		      "hqmusicurl"=>$this->hdurl,
		      "thumb_media_id"=>$this->media_id
		);
	}
	public function toName(){
		return 'music';
	}
}