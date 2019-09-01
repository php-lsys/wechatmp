<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Result{
	protected $_status;
	protected $_data;
	protected $_msg;
	public function __construct($status,$data){
		$this->_status=$status;
		if ($this->_status){
			$this->_data=$data;
		}else $this->_msg=strval($data);
	}
	public function __toString(){
		return $this->_status?'1':'';
	}
	public function getMsg(){
		return $this->_msg;
	}
	public function getStatus(){
		return $this->_status;
	}
	public function getData(){
		return $this->_data;
	}
}