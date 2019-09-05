<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
use LSYS\Wechat\Msg\Type;
//订阅号 1次 服务号 每个用户每周1次
class Mass extends Access{
	/**
	 * @var string
	 */
	protected $sendall_url='https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={ACCESS_TOKEN}';
	protected $send_url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={ACCESS_TOKEN}';
	protected $delete_url='https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token={ACCESS_TOKEN}';
	protected $preview_url='https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token={ACCESS_TOKEN}';
	protected $get_url='https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token={ACCESS_TOKEN}';
	/**
	 * 按TAG群发 TAG参阅 USER接口
	 * @param string $tagid
	 * @param Type $type
	 * @return \LSYS\Wechat\Result
	 */
	public function tagSendall($tagid,Type $type){
		$name=$type->toName();
		if ($name=='video')$name='mpvideo';//特殊
		$data=$this->_makeRun($this->sendall_url,array(
			"filter"=>array(
				"is_to_all"=>false,
				"tag_id"=>$tagid
			),
			$name=>$type->toArray(),
			"msgtype"=>$name
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['msg_id']);
	}
	/**
	 * 按OPENID群发
	 * @param string $openid
	 * @param Type $type
	 * @return \LSYS\Wechat\Result
	 */
	public function openidSend($openid,Type $type){
		if (is_string($openid))$openid=array($openid);
		$name=$type->toName();
		if ($name=='video')$name='mpvideo';//特殊
		$data=$this->_makeRun($this->send_url,array(
			"touser"=>$openid,
		 	$name=>$type->toArray(),
			"msgtype"=>$name,
		    "send_ignore_reprint"=>0
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['msg_id']);
	}
	/**
	 * 删除发送
	 * @param string $msgid
	 * @return \LSYS\Wechat\Result
	 */
	public function deleteSend($msgid){
		$data=$this->_makeRun($this->delete_url,array(
			"msg_id"=>$msgid
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 预览发送状态
	 * @param string $openid
	 * @param Type $type
	 * @return \LSYS\Wechat\Result
	 */
	public function preview($openid,Type $type){
		$name=$type->toName();
		if ($name=='video')$name='mpvideo';//特殊
		$data=$this->_makeRun($this->preview_url,array(
			"touser"=>$openid,
		 	$name=>$type->toArray(),
			"msgtype"=>$name,
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 查询发送状态
	 * @param string $msgid
	 * @return \LSYS\Wechat\Result
	 */
	public function get($msgid){
		$data=$this->_makeRun($this->get,array(
			"msg_id"=>$msgid
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}