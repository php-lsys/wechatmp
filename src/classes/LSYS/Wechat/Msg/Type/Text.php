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
 * wechat 返回文本元素类
 * @author User
 */
class Text implements Type{
	public $text;
	public function __construct($msg){
		$this->text=$msg;
	}
	public function to_Xml($ToUserName, $FromUserName){
		$time = time();
		$Tpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
		$resultStr = sprintf($Tpl, $ToUserName, $FromUserName, $time,$this->to_name(), $this->text);
		return  $resultStr;
	}
	public function to_array(){
		return array(
			 "content"=>$this->text
		);
	}
	public function to_name(){
		return 'text';
	}
}