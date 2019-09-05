<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg\Type;
use LSYS\Wechat\Msg\Type;
use LSYS\Wechat\Exception;

/**
 * wechat 返回图片元素类
 * @author User
 */
class Card implements Type{
	protected  $body;
	public function __construct($card_id){
		$this->body=$card_id;
	}
	public function toXml($ToUserName, $FromUserName){
		throw new Exception("not support to xml");
	}
	public function toArray(){
		return array
	    (
    		"card_id"=>$this->body
	    );
	}
	public function toName(){
		return 'wxcard';
	}
}