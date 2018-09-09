<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg;
/**
 * wechat 返回元素接口
 * @author User
 */
interface Type{
	/**
	 * 返回XML数据
	 * @param string $ToUserName
	 * @param string $FromUserName
	 * @return string 
	 */
	public function to_xml($ToUserName,$FromUserName);
	/**
	 * 返回JSON数据
	 * @return array
	 */
	public function to_array();
	/**
	 * 获得类型名
	 */
	public function to_name();
}