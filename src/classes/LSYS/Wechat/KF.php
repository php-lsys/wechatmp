<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
use LSYS\Wechat\Msg\Type;

class KF extends Access{
	/**
	 * @var string
	 */
	protected $add_kfaccount_url='https://api.weixin.qq.com/customservice/kfaccount/add?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $update_kfaccount_url='https://api.weixin.qq.com/customservice/kfaccount/update?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $del_kfaccount_url='https://api.weixin.qq.com/customservice/kfaccount/del?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $uploadheadimg_url='http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token={ACCESS_TOKEN}&kf_account={KFACCOUNT}';
	/**
	 * @var string
	 */
	protected $get_kfaccount_url='https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $send_kfaccount_url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={ACCESS_TOKEN}';
	
	/**
	 * 创建客服
	 */
	public function kf_add($account,$nickname,$password){
		$data=$this->_make_run($this->add_kfaccount_url,array(
			"kf_account"=>$account,'nickname'=>$nickname,'password'=>$password
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 更新客服
	 */
	public function kf_update($account,$nickname,$password){
		$data=$this->_make_run($this->update_kfaccount_url,array(
			"kf_account"=>$account,'nickname'=>$nickname,'password'=>$password
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 删除客服
	 */
	public function kf_del($account,$nickname,$password){
		$data=$this->_make_run($this->del_kfaccount_url,array(
			"kf_account"=>$account,'nickname'=>$nickname,'password'=>$password
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 客服头像
	 */
	public function kf_avatar($account,$file){
		$url=str_replace('{KFACCOUNT}',$account, $this->uploadheadimg_url);
		$data=$this->_make_run($url,array(
			'file'=>new \CURLFile($file)
		),false);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取客服列表
	 */
	public function kf_get(){
		$data=$this->_make_run($this->get_kfaccount_url);
		if (is_object($data)) return $data;
		return new Result(true, $data['kf_list']);
	}
	/**
	 * 客服发送消息,消息格式参考type
	 * @param string $to_user
	 * @param Type $data
	 * @param string $kf_account 使用那个账号发送
	 * @return Result
	 */
	public function kf_send($to_user,Type $data,$kf_account=null){
		$arr=array(
				'touser'=>$to_user,
				'msgtype'=>$data->to_name(),
				$data->to_name()=>$data->to_array()
		);
		if ($kf_account) $arr['customservice']['kf_account']=$kf_account;
		$data=$this->_make_run($this->send_kfaccount_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}