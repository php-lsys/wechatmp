<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\AccessCache;
use LSYS\Wechat\AccessCache;
class Redis implements AccessCache
{
	/**
	 * @var \LSYS\Redis
	 */
	protected $_redis;
	protected $_spoce;
	public function __construct(\LSYS\Redis $redis=null,$sopce='lsys_wechat_access_'){
	    $this->_redis=$redis?$redis:\LSYS\Redis\DI::get()->redis();
		$this->_spoce=$sopce;
	}
	protected function _key($appid){
		return $this->_spoce.'_'.$appid;
	}
	public function setAccess($appid,$access,$time){
	    $this->_redis->configConnect();
		return $this->_redis->setex($this->_key($appid),$time,$access);
	}
	public function getAccess($appid){
	    $this->_redis->configConnect();
		$key=$this->_key($appid);
		$data=$this->_redis->get($key);
		if ($data==null) return array(null,0);
		return array($data,$this->_redis->ttl($key)+time());
	}
}