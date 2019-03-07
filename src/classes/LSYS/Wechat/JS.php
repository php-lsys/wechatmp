<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class JS extends Access{
	/**
	 * @var AccessShare
	 */
	protected static $share_jsapi_ticket;
	/**
	 * JS ticket 缓存接口
	 * @param AccessShare $share
	 */
	public static function setShareJsapiTicket(AccessShare $share){
		self::$share_jsapi_ticket=$share;
	}
	/**
	 * @var AccessShare
	 */
	protected static $share_api_ticket;
	/**
	 * api ticket 缓存接口
	 * @param AccessShare $share
	 */
	public static function setShareApiTicket(AccessShare $share){
		self::$share_api_ticket=$share;
	}
	/**
	 * @var string
	 */
	protected $jsapi_ticket_url='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={ACCESS_TOKEN}&type=jsapi';
	/**
	 * @var string
	 */
	protected $api_ticket_url='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={ACCESS_TOKEN}&type=wx_card';
	/**
	 * 获取js ticket
	 * @return Result
	 */
	public function getJsapiTicket(){
		if (self::$share_jsapi_ticket){
			list($ticket,$timeout)=self::$share_jsapi_ticket->getAccess($this->_appid);
			if ($ticket&&$timeout>time()-2) return new Result(true, $ticket);
		}
		$data=$this->_makeRun($this->jsapi_ticket_url);
		if (is_object($data)) return $data;
		if (self::$share_jsapi_ticket instanceof AccessCache){
			self::$share_jsapi_ticket->setAccess($this->_appid,$data['ticket'],$data['expires_in']-2);
		}
		return new Result(true, $data['ticket']);
	}
	/**
	 * 得到jsapi signature
	 * @param string $url 页面地址
	 * @param string|Result $ticket from get_jsapi_ticket
	 * @param int $time 当前时间
	 * @param string $rand 随机字符
	 * @return string
	 */
	public function getJsapiSignature($url,&$ticket=null,&$time=null,&$rand=null){
		if(empty($url))$url=Utils::homeUrl();
		$url=preg_replace("/#.*$/", "", $url);
		if ($rand==null) $rand=uniqid();
		$_rand='noncestr='.$rand;
		if ($ticket==null)$ticket=$this->getJsapiTicket();
		if ($ticket instanceof Result) $ticket=$ticket->getData();
		if ($time==null) $time=time();
		$timestamp='timestamp='.$time;
		$_url='url='.$url;
		$tmpArr = array($_rand, 'jsapi_ticket='.$ticket,$timestamp, $_url);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode("&",$tmpArr );
		return sha1( $tmpStr );
	}
	
	/**
	 * 获取 api ticket 卡券用到
	 * @return Result
	 */
	public function getApiTicket(){
		if (self::$share_api_ticket){
			list($ticket,$timeout)=self::$share_api_ticket->getAccess($this->_appid);
			if ($ticket&&$timeout>time()-2) return new Result(true, $ticket);
		}
		$data=$this->_makeRun($this->api_ticket_url);
		if (is_object($data)) return $data;
		if (self::$share_api_ticket instanceof AccessCache){
			self::$share_api_ticket->setAccess($this->_appid,$data['ticket'],$data['expires_in']-2);
		}
		return new Result(true, $data['ticket']);
	}
}