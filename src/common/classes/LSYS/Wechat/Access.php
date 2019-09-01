<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
/**
  * 用到配置:
 * 	"app_id"
 * 	"app_secret"
 */
abstract class Access extends AppKey{
	/**
	 * @var AccessShare
	 */
	protected static $share_access;
	public static function setShareAccess(AccessShare $share){
		self::$share_access=$share;
	}
	//access
	protected $_access;
	protected $_access_expires=0;
	public function __construct(\LSYS\Config $config){
	    parent::__construct($config);
	    if (self::$share_access)list($this->_access,$this->_access_expires)=self::$share_access->getAccess($this->_appid);
	}
	/**
	 * 换取授权地址
	 * @var string
	 */
	protected $client_url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={WEIXIN_APPID}&secret={WEIXIN_SECRET}';
	/**
     * 得到一个授权URL
	 */
	protected function _accessUrl($url=null){
		if (empty($this->_access)||$this->_access_expires<time()-2) {
			$_url=str_replace('{WEIXIN_APPID}', $this->_appid, $this->client_url);
			$_url=str_replace('{WEIXIN_SECRET}', $this->_secret, $_url);
			$data=$this->_makeRequest($_url);
			$data=$this->_checkReturn($data);
			if (is_object($data)) return $data;
			if (self::$share_access instanceof AccessCache){
				self::$share_access->setAccess($this->_appid,$data['access_token'],$data['expires_in']);
			}
			$this->_access=$data['access_token'];
			$this->_access_expires=$data['expires_in']+time();
		}
		if($url!==null) return str_replace('{ACCESS_TOKEN}',$this->_access, $url);
		return true;
	}
	/**
	 * 运行请求
	 * @param string $url
	 * @param array $param 请求参数
	 * @param string $is_json 请求参数是否是JSON
	 * @param string $check 是否检查返回结果
	 * @return Result
	 */
	protected function _makeRun($url,$param=array(),$is_json=true,$check=true){
		$url=$this->_accessUrl($url);
		if (is_object($url)) return $url;
		if ($is_json&&is_array($param)&&count($param)>0)$param=json_encode($param,JSON_UNESCAPED_UNICODE);
		$data=$this->_makeRequest($url,$param);
		if ($check) return $this->_checkReturn($data);
		return $data;
	}
	/**
	 * 检测ACCESS
	 * @return bool
	 */
	public function checkAccess(){
		return $this->_accessUrl()===true;
	}
	/**
	 * 得到access token
	 * @return string
	 */
	public function getAccess(){
		$this->_accessUrl();
		return $this->_access;
	}
	/**
	 * 得到access token过期时间
	 * @return string
	 */
	public function getAccessExpires(){
		$this->_accessUrl();
		return $this->_access_expires;
	}
}