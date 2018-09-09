<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
use LSYS\Wechat\Msg\Callback;
use LSYS\Wechat\Msg\Type;
/**
 * wechat 返回回调类
 * 用到配置:
 * 	"app_id"
 * 	"token"
 *	"aeskey
 * @author User
 */
class Msg extends AppBase
{
	protected $_token;
	/**
	 * @var Callback
	 */
	protected $_aeskey;
	public function __construct(\LSYS\Config $config){
	    parent::__construct($config);
	    $this->_token=$this->_config->get("msg_token");
	    $this->_aeskey=$this->_config->get("msg_aeskey");
	}
	/**
	 * 事件回调
	 * $callback 是回调函数,参数有 $msgtype $msgdata
	 * 返回IwechatCallbackItem
	 */
	public function set_callback(Callback $callback){
		$this->_callback=$callback;
		return $this;
	}
	/**
	 * 是否是事件请求
	 */
	public function is_callback(){
		if ($this->_is_request()&&$this->checkSignature()&&strlen($this->_post_data())>0) {
			return true;
		}
		return false;
	}
	/**
	 * 是否是校验请求
	 */
	protected function _is_request(){
		if (isset($_GET["signature"])&&
				isset($_GET["timestamp"])&&
				isset($_GET["nonce"])
				) {
					return true;
				}
	}
	//get post data
	protected function _post_data(){
		if (isset($GLOBALS["HTTP_RAW_POST_DATA"])&&strlen($GLOBALS["HTTP_RAW_POST_DATA"])>0) return $GLOBALS["HTTP_RAW_POST_DATA"];
		if (strlen(file_get_contents("php://input"))>0) return file_get_contents("php://input");
		return null;
	}
	/**
	 * 是否是校验请求
	 */
	public function is_valid(){
		if ($this->_is_request()&&
				isset($_GET["echostr"])
				) {
					return true;
				}
	}
	/**
	 * 获得signature
	 * @param string $signature
	 * @param string $timestamp
	 * @param string $nonce
	 * @param string $token
	 * @return string
	 */
	protected function signature($signature,$timestamp,$nonce,$token){
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		return $tmpStr;
	}
	/**
	 * 获得的请求的 signature
	 * @return string
	 */
	protected function get_request_signature(){
		return isset($_GET["signature"])?$_GET["signature"]:'';
	}
	/**
	 * 校验完成输出
	 */
	public static function valid_echo(){
		echo isset($_GET["echostr"])?$_GET["echostr"]:'';
		exit();
	}
	/**
	 * 校验请求
	 */
	protected function checkSignature()
	{
		$signature = $this->get_request_signature();
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$token = $this->_token;
		$tmpStr=$this->signature($signature, $timestamp, $nonce, $token);
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	public function listen(Callback $callback=null){
		if($this->is_valid())Msg::valid_echo();
		if (!$this->is_callback()) return false;
		$postStr = $this->_post_data();
		if (empty($postStr)) return false;
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		$postObj=json_decode(json_encode($postObj),true);
		if (isset($postObj['Encrypt'])){
			include_once __DIR__."/../../../libs/wxBizMsgCrypt.php";
			$pc = new \WXBizMsgCrypt($this->_token, $this->_aeskey, $this->_appid);
			$msg_sign = $postObj['MsgSignature'];
			$timeStamp= $postObj['TimeStamp'];
			$nonce= $postObj['Nonce'];
			// 第三方收到公众号平台发送的消息
			$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $postStr, $msg);
			if ($errCode == 0) {
				$postObj = simplexml_load_string($msg, 'SimpleXMLElement', LIBXML_NOCDATA);
				$postObj=json_decode(json_encode($postObj),true);
			} else {
				return false;
			}
		}
		if ($this->_callback!=null){
			$r = $this->_callback->call($postObj['MsgType'], $postObj);
		}else if ($callback!=null)$r=$callback->call($postObj->MsgType, $postObj);
		if (isset($r)&&$r instanceof Type)  $r=$r->to_xml($postObj['FromUserName'], $postObj['ToUserName']);
		if(isset($r)){
			if (!isset($pc))die($r);
			$errCode = $pc->encryptMsg($r, time(), uniqid(), $encryptMsg);
			if ($errCode == 0) {
				die($encryptMsg);
			} else {
				return false;
			}
		}
	}
}