<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
use LSYS\Wechat\Sns\State;
use LSYS\Wechat\Sns\State\Session;
class Sns extends AppKey{
	protected $_session;
	/**
	 * 设置或获取state保存的session
	 * @param State $session
	 * @return \LSYS\Wechat\Sns\State\Session
	 */
	public function session(State $session=null){
		if($session==null){
			if($this->_session==null)$this->_session=new Session();
			return $this->_session;
		}
		$this->_session=$session;
		return $this;
	}
	//創建一個state
	protected function _createState(){
		return $this->session()->create("__LSYS_WECHAT_SNS_STATE__");
	}
	//檢查state是否正確
	protected function _checkState($state){
	    return $this->session()->check("__LSYS_WECHAT_SNS_STATE__", $state);
	}
	/**
	 * 只能获取基本信息
	 * @var string
	 */
	const SCOPE_BASE="snsapi_base";
	/**
	 * 可以获取用户信息
	 * @var string
	 */
	const SCOPE_USERINFO="snsapi_userinfo";
	/**
	 * 扫码登陆SCOPE
	 * @var string
	 */
	const SCOPE_LOGIN="snsapi_login";
	protected $sns_access_url="https://open.weixin.qq.com/connect/oauth2/authorize?appid={WEIXIN_APPID}&redirect_uri={REDIRECT_URI}&response_type=code&scope={SCOPE}&state={STATE}";
	public function accessUrl($redirect_url=null,$scope=self::SCOPE_USERINFO){
		$state=$this->_createState();
		if($redirect_url==null) $redirect_url=Utils::homeUrl();
		$redirect_url=urlencode($redirect_url);
		$url=str_replace('{WEIXIN_APPID}', $this->_appid, $this->sns_access_url);
		$url=str_replace('{STATE}', $state, $url);
		$url=str_replace('{REDIRECT_URI}', $redirect_url, $url);
		$url=str_replace('{SCOPE}', $scope, $url);
		return $url;
	}
	
	protected $_sns_access_token;
	protected $sns_access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid={WEIXIN_APPID}&secret={WEIXIN_SECRET}&code={CODE}&grant_type=authorization_code";
	/**
	 * 获得授权token
	 */
	public function accessToken(){
		if (!isset($_GET['code'])||!isset($_GET['state'])) return new Result(false, 'not access');
		if (!$this->_checkState($_GET['state'])) return new Result(false, 'state not match');
		$url=str_replace('{WEIXIN_APPID}', $this->_appid, $this->sns_access_token_url);
		$url=str_replace('{WEIXIN_SECRET}', $this->_secret, $url);
		$url=str_replace('{CODE}', $_GET['code'], $url);
		$data=$this->_makeRequest($url);
		$json=$this->_checkReturn($data);
		if (is_object($json)) return $json;
		$this->_sns_access_token=$json;
		return new Result(true, $json);
	}
	/**
	 * 获得授权token
	 * @return mixed
	 */
	public function getAccessToken(){
		return $this->_sns_access_token;
	}
	/**
	 * 设置授权token
	 * @return mixed
	 */
	public function setAccessToken($access_token=null){
		$this->_sns_access_token=$access_token;
	}
	protected $sns_access_refresh_url="https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={WEIXIN_APPID}&grant_type=refresh_token&refresh_token={REFRESH_TOKEN}";
	/**
	 * 刷新授权token
	 */
	public function refreshToken(){
		if(empty($this->_sns_access_token)) return new Result(false, "can't refresh empty token"); 
		$url=str_replace('{WEIXIN_APPID}', $this->_appid, $this->sns_access_refresh_url);
		$url=str_replace('{REFRESH_TOKEN}', $this->_sns_access_token['refresh_token'], $url);
		$body=$this->_makeRequest($url);
		$json=$this->_checkReturn($body);
		if (is_object($json)) return $json;
		$this->_sns_access_token=$json;
		return new Result(true, $json);
	}
	//扫码登陆地址
	//open.weixin.qq.com 开放平台功能
	protected $qrcode_access_url="https://open.weixin.qq.com/connect/qrconnect?appid={WEIXIN_APPID}&redirect_uri={REDIRECT_URI}&response_type=code&scope={SCOPE}&state={STATE}#wechat_redirect";
	/**
	 * 微信扫码登陆
	 * @param string $scope
	 * @param string $redirect_url
	 * @return string
	 */
	public function qrcodeAccessUrl($redirect_url=null,$scope=self::SCOPE_LOGIN){
		$state=$this->_createState();
		if($redirect_url==null) $redirect_url=Utils::homeUrl();
		$redirect_url=urlencode($redirect_url);
		$url=str_replace('{WEIXIN_APPID}', $this->_appid, $this->qrcode_access_url);
		$url=str_replace('{STATE}', $state, $url);
		$url=str_replace('{REDIRECT_URI}', $redirect_url, $url);
		$url=str_replace('{SCOPE}', $scope, $url);
		return $url;
	}
	//用戶資料
	protected $sns_user_url="https://api.weixin.qq.com/sns/userinfo?access_token={ACCESS_TOKEN}&openid={OPENID}&lang=zh_CN";
	/**
	 * 获取用户信息
	 * @return mixed
	 */
	public function getUser(){
		if(empty($this->_sns_access_token)||empty($this->_sns_access_token['access_token'])) return new Result(false, "access not find");
		$url=str_replace('{ACCESS_TOKEN}', $this->_sns_access_token['access_token'], $this->sns_user_url);
		$url=str_replace('{OPENID}', $this->_sns_access_token['openid'], $url);
		$body=$this->_makeRequest($url);
		$json=$this->_checkReturn($body);
		if (is_object($json)) return $json;
		return new Result(true, $json);
	}
	/**
	 * 检测access token是否过期
	 * @var string
	 */
	protected $sns_access_check_url="https://api.weixin.qq.com/sns/auth?access_token={ACCESS_TOKEN}&openid={OPENID}";
	/**
	 * 检测access token 是否有效
	 * @param array $json
	 */
	public function checkAccess(){
		$json=$this->_sns_access_token;
		if(isset($json['access_token'])
			 &&isset($json['refresh_token'])
			 &&isset($json['openid'])
				){
					$url=str_replace('{ACCESS_TOKEN}', $json['access_token'], $this->sns_access_check_url);
					$url=str_replace('{OPENID}',$json['openid'], $url);
					$body=$this->_makeRequest($url);
					$body=json_decode($body,true);
					if($body['errcode']!=0) return false;
					return true;
		}else{
			return false;
		}
	}
}