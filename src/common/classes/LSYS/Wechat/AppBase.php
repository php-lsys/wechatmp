<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
use \LSYS\Config;
abstract class AppBase{
	//appid 
	protected $_appid;
	/**
	 * @var Config
	 */
	protected $_config;
	public function __construct(Config $config){
		$this->_config=$config;
		$this->_appid=$config->get("app_id");
	}
	public function getAppid(){
		return $this->_appid;
	}
}