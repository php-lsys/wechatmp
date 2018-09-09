<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg;
class CallbackCallable implements Callback{
	protected $_callable;
	public function __construct(callable $callable){
		$this->_callable=$callable;
	}
	public function call($type, $msg){
		return call_user_func_array($this->_callable, func_get_args());
	}
}