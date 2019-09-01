<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\AccessCache;
use LSYS\Wechat\AccessCache;
class Memcached implements AccessCache
{
	/**
	 * @var \LSYS\Memcached
	 */
	protected $_memcache;
	protected $_spoce;
	public function __construct(\LSYS\Memcached $memcached=null,$sopce='lsys_wechat_access_'){
	    $this->_memcache=$memcached?$memcached:\LSYS\Memcached\DI::get()->memcached();
		$this->_spoce=$sopce;
	}
	protected function _key($appid){
		return $this->_spoce.'_'.$appid;
	}
	public function setAccess($appid,$access,$time){
	    $this->_memcache->configServers();
		if ($time>=2592000)$timeout=time()+$time;
		else if ($time<=0)$timeout=0;
		else $timeout = $time;
		return $this->_memcache->set($this->_key($appid),array($access,time()+$time),$timeout);
	}
	public function getAccess($appid){
	    $this->_memcache->configServers();
		$data=$this->_memcache->get($this->_key($appid));
		if (!is_array($data))return array(null,0);
		return $data;
	}
}