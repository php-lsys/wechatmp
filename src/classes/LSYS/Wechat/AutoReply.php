<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class AutoReply extends Access{
	/**
	 * @var string
	 */
	protected $get_url='https://api.weixin.qq.com/cgi-bin/get_current_autoreply_info?access_token={ACCESS_TOKEN}';
	/**
	 * 获取自动回复规则
	 * 当没使用应答接口时,得到公众号后台设置的应答规则
	 * @return \LSYS\Wechat\Result
	 */
	public function get(){
		$data=$this->_make_run($this->get_url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}