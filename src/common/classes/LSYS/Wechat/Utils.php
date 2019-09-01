<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Utils extends Access{
	/**
	 * 得到首页地址 
	 * @return string
	 */
	public static function homeUrl(){
		if (isset($_SERVER['HTTP_HOST'])){
			if (isset($_SERVER['HTTPS'])&&strtoupper($_SERVER['HTTPS']) == 'ON'){
				$p='https://';
			}else $p='http://';
			if(isset($_SERVER['SERVER_PORT'])&&$_SERVER['SERVER_PORT']!='80')$pr=':'.$_SERVER['SERVER_PORT'];
			else $pr='';
			return $p.$_SERVER['HTTP_HOST'].$pr;
		}else return '/';
	}
	/**
	 * 从定向URL
	 * @param string $uri
	 * @param number $code
	 */
	public static function redirect($uri = '', $code = 302)
	{
		$uri=str_replace(array("\n","\r","'",'"'), '', $uri);
		if (!headers_sent()){
			$code=intval($code);
			Header( "HTTP/1.1 {$code} Moved Permanently" );
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma:no-cache");
			header("location: ".$uri);
		}
		echo <<<EOT
		<html><head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-store, must-revalidate">
		<meta http-equiv="expires" content="wed, 26 feb 1997 08:21:57 gmt">
		<meta http-equiv=\"refresh\" content=\"0;url=$uri\">
		</head><script>window.location.href='{$uri}';</script><body></body></html>
EOT;
		flush();
		exit;
	}
	
	
	/**
	 * @var string
	 */
	protected $shorturl_url='https://api.weixin.qq.com/cgi-bin/shorturl?access_token={ACCESS_TOKEN}';
	/**
	 * 短网址生成
	 * @param string $long_url
	 * @return \LSYS\Wechat\Result
	 */
	public function shorturl($long_url){
		$data=$this->_makeRun($this->shorturl_url,array(
				'action'=>'long2short',
				'long_url'=>$long_url,
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['short_url']);
	}
	/**
	 * @var string
	 */
	protected $semproxy_url='https://api.weixin.qq.com/semantic/semproxy/search?access_token={ACCESS_TOKEN}';
	/**
	 * 短网址生成
	 * @param string $long_url
	 * @return \LSYS\Wechat\Result
	 */
	public function semproxy($query,$city,$category,$openid=null,$param=array()){
		$data=array(
			"query"=>$query,
			"city"=>$city,
			"category"=>$category,
			"appid"=>$this->_appid,
			"uid"=>$openid
		);
		extract($param);//$param 有以下参数
// 		$latitude=null,
// 		$longitude=null,
// 		$region=null
		if (isset($latitude)&&isset($longitude)){
			$data['latitude']=$latitude;
			$data['longitude']=$longitude;
		}else if (isset($region)){
			$data['region']=$region;
		}
		$data=$this->_makeRun($this->semproxy_url,$data);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
}