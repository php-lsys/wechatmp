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
 * wechat 返回声音元素类
 * @author User
 */
class Voice implements Type{
	protected  $body;
	public function __construct($media_id){
		$this->body=$media_id;
	}
	public function toXml($ToUserName, $FromUserName){
		$time = time();
		$Tpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Image>
			<MediaId><![CDATA[%s]]></MediaId>
			</Image>
			</xml>";
		$resultStr = sprintf($Tpl, $ToUserName, $FromUserName, $time,$this->toName(), $this->body);
		return  $resultStr;
	}
	public function toArray(){
		return array(
		  "media_id"=>$this->body
		);
	}
	public function toName(){
		return 'voice';
	}
}