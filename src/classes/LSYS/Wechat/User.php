<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class User extends Access{
	/**
	 * @var string
	 */
	protected $tag_add_url='https://api.weixin.qq.com/cgi-bin/tags/create?access_token={ACCESS_TOKEN}';
	protected $tag_get_url='https://api.weixin.qq.com/cgi-bin/tags/get?access_token={ACCESS_TOKEN}';
	protected $tag_update_url='https://api.weixin.qq.com/cgi-bin/tags/update?access_token={ACCESS_TOKEN}';
	protected $tag_del_url='https://api.weixin.qq.com/cgi-bin/tags/delete?access_token={ACCESS_TOKEN}';
	protected $tag_user_get_url='https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token={ACCESS_TOKEN}';
	protected $tag_user_batch_on_url='https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token={ACCESS_TOKEN}';
	protected $tag_user_batch_un_url='https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token={ACCESS_TOKEN}';
	protected $tag_get_ids_url='https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token={ACCESS_TOKEN}';
	protected $mark_url='https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token={ACCESS_TOKEN}';
	protected $user_info_url='https://api.weixin.qq.com/cgi-bin/user/info?access_token={ACCESS_TOKEN}&openid={OPENID}&lang=zh_CN';
	protected $user_batch_info_url='https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token={ACCESS_TOKEN}';
	protected $user_get_url='https://api.weixin.qq.com/cgi-bin/user/get?access_token={ACCESS_TOKEN}&next_openid={NEXT_OPENID}';
	protected $black_list_url='https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token={ACCESS_TOKEN}';
	protected $black_list_un_url='https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token={ACCESS_TOKEN}';
	protected $black_list_on_url='https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token={ACCESS_TOKEN}';
	/**
	 * 添加标签
	 * @param string $name
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_add($name){
		$data=$this->_make_run($this->tag_add_url,array(
			"tag" =>array("name" =>$name)
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['tag']);
	}
	/**
	 * 获取标签
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_get(){
		$data=$this->_make_run($this->tag_get_url);
		if (is_object($data)) return $data;
		return new Result(true, $data['tags']);
	}
	/**
	 * 修改标签
	 * @param string $id
	 * @param string $name
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_update($tag_id,$name){
		$data=$this->_make_run($this->tag_update_url,array(
			"tag" =>array('id'=>$tag_id,"name" =>$name)
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 删除标签
	 * @param string $id
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_del($tag_id){
		$data=$this->_make_run($this->tag_del_url,array(
			"tag" =>array('id'=>$tag_id)
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 根据标签获取用户
	 * @param string $id
	 * @param string $next_openid
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_user_get($tag_id,$next_openid=''){
		$data=$this->_make_run($this->tag_user_get_url,array(
			"tagid" =>$tag_id,
			"next_openid" =>$next_openid,
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 给用户打标签
	 * @param array $openid_list
	 * @param string $id
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_batchtagging($openid_list,$tag_id){
		if (is_string($openid_list))$openid_list=array($openid_list);
		$data=$this->_make_run($this->tag_user_batch_on_url,array(
			"openid_list" =>$openid_list,
			"tagid" => $tag_id
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 给用户去除标签
	 * @param array $openid_list
	 * @param string $id
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_batchuntagging($openid_list,$tag_id){
		if (is_string($openid_list))$openid_list=array($openid_list);
		$data=$this->_make_run($this->tag_user_batch_un_url,array(
			"openid_list" =>$openid_list,
			"tagid" => $tag_id
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取指定用户的标签
	 * @param string $openid
	 * @return \LSYS\Wechat\Result
	 */
	public function tag_get_user_tag($openid){
		$data=$this->_make_run($this->tag_get_ids_url,array(
			"openid" =>$openid,
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['tagid_list']);
	}
	/**
	 * 给用户打别名
	 * @param string $openid
	 * @param string $remark
	 * @return \LSYS\Wechat\Result
	 */
	public function remark($openid,$remark){
		$data=$this->_make_run($this->mark_url,array(
			"openid" =>$openid,
			"remark"=>$remark
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取用户资料
	 * @param string $openid
	 * @return \LSYS\Wechat\Result
	 */
	public function get_user($openid){
		$url=str_replace("{OPENID}", $openid,$this->user_info_url);
		$data=$this->_make_run($url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 批量获取用户资料
	 * @param array $openids
	 * @param string $lang
	 * @return \LSYS\Wechat\Result
	 */
	public function batchget_user(array $openids,$lang='zh-CN'){
		$user=array();
		foreach ($openids as $v){
			$user[]=array(
				"openid"=>$v,
				"lang"=>$lang
			);
		}
		$data=$this->_make_run($this->user_batch_info_url,array(
			"user_list"=>$user
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取用户列表
	 * @param string $next_openid
	 * @return \LSYS\Wechat\Result
	 */
	public function get_user_list($next_openid=''){
		$url=str_replace("{NEXT_OPENID}", $next_openid,$this->user_get_url);
		$data=$this->_make_run($url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取屏蔽用户
	 * @param string $begin_openid
	 * @return \LSYS\Wechat\Result
	 */
	public function get_blacklist($begin_openid=''){
		$data=$this->_make_run($this->black_list_url,array(
			'begin_openid'=>$begin_openid
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 屏蔽用户
	 * @param array $opened_list
	 * @return \LSYS\Wechat\Result
	 */
	public function batch_blacklist($opened_list){
		is_string($opened_list)&&$opened_list=array($opened_list);
		$data=$this->_make_run($this->black_list_un_url,array(
			'opened_list'=>$opened_list
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 取消屏蔽用户
	 * @param array $opened_list
	 * @return \LSYS\Wechat\Result
	 */
	public function batch_un_blacklist($opened_list){
		is_string($opened_list)&&$opened_list=array($opened_list);
		$data=$this->_make_run($this->black_list_on_url,array(
			'opened_list'=>$opened_list
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}