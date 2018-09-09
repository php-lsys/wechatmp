<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Qrcode extends Access{
/**
	 * 二维码请求地址
	 * @var string
	 */
	protected $qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={ACCESS_TOKEN}';
	/**
	 * 获取一个临时的QRCODE
	 * @param number $expire_seconds
	 * @param number $scene_id
	 */
	public function qrcode_tmp($scene_id=1,$expire_seconds=1800){
		$data=$this->_make_run($this->qrcode_url,array(
			"expire_seconds"=>$expire_seconds,
			"action_name"=>"QR_SCENE",
			"action_info"=>array(
				"scene"=>array(
					"scene_id"=>$scene_id
				)
			)
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['ticket']);
	}
	/**
	 * 获取一个长久的QRCODE
	 * @param number $scene_id
	 */
	public function qrcode($scene_id=1){
		$data=$this->_make_run($this->qrcode_url,array(
				"action_name"=>"QR_LIMIT_SCENE",
				"action_info"=>array(
						"scene"=>array(
							"scene_id"=>$scene_id
						)
				)
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['ticket']);
	}
	/**
	 * 得到QRCODE的地址
	 * @param string $ticket
	 * @return string
	 */
	public static function qrcode_link($ticket){
		if ($ticket instanceof Result) $ticket=$ticket->get_data();
		return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;
	}
}