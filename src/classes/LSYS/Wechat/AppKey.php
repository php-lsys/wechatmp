<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
abstract class AppKey extends AppBase{
	//app secret
	protected $_secret;
	public function __construct(\LSYS\Config $config){
	    parent::__construct($config);
	    $this->_secret=$config->get("appkey_secret");
	}
	/**
	 * 创建一个请求
	 */
	protected function _make_request($url,$post=array()){
		$curl = curl_init($url);
		$options = array();
		if ($post) {
			$options[CURLOPT_POST]=1;
			$options[CURLOPT_POSTFIELDS]=$post;
		}
		$options[CURLOPT_SSL_VERIFYPEER]=false;
		$options[CURLOPT_RETURNTRANSFER]=TRUE;
		$options[CURLOPT_HEADER]=FALSE;
		curl_setopt_array($curl, $options);
		$body = curl_exec($curl);
		if ($body===false&&curl_errno($curl)){
			$msg= curl_error($curl);
		}
		curl_close($curl);
		if (isset($msg)) throw new Exception($msg);
		return $body;
	}
	/**
	 * 检测结果返回
	 * @param string $body
	 */
	protected function _check_return($body){
		$json=json_decode($body,true);
		if(isset($json['errcode'])&&$json['errcode']!=0){
			if (isset($json['errmsg']))$msg=$json['errmsg'].":".$json['errcode'];
			else {
				$code=$json['errcode'];
				unset($json['errcode']);
				$msg=json_encode($json).":".$code;
			}
			return new Result(false,$msg);
		}
		return $json;
	}
}
