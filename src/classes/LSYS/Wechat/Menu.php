<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Menu extends Access{
	/**
	 * 菜单创建地址
	 * @var string
	 */
	protected $create_menu_url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token={ACCESS_TOKEN}';
	/**
	 *菜单删除地址
	 * @var string
	 */
	protected $delete_menu_url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={ACCESS_TOKEN}';
	/**
	 * 菜单获取地址
	 * @var string
	 */
	protected $get_menu_url='https://api.weixin.qq.com/cgi-bin/menu/get?access_token={ACCESS_TOKEN}';
	/**
	 * 创建菜单
	 $menu=array(
	 array(
	 'type' => 'click',
	 'name' => '按钮1',
	 'key' =>  'dd',
	 ),
	 array(
	 "type"=>"view",
	 "name"=>"歌手简介",
	 "url"=>"http://www.qq.com/"
	 ),
	 array(
	 "name"=>"歌手简介",
	 "sub_button"=>array(
	 array(
	 "type"=>"view",
	 "name"=>"歌手简介",
	 "url"=>"http://www.qq.com/"
	 ),
	 )
	 ),
	 );
	 */
	public function menuCreate(array $menu){
		$data=$this->_makeRun($this->create_menu_url,array(
			"button"=>$menu
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 删除自定义菜单
	 */
	public function menuDelete(){
		$data=$this->_makeRun($this->delete_menu_url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 得到已存在菜单
	 */
	public function menuGet(){
		$data=$this->_makeRun($this->get_menu_url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	//个性化菜单
// 	{
// 		"button":[
// 		{
// 			"type":"click",
// 			"name":"今日歌曲",
// 			"key":"V1001_TODAY_MUSIC"
// 		},
// 		{
// 			"name":"菜单",
// 			"sub_button":[
// 			{
// 				"type":"view",
// 				"name":"搜索",
// 				"url":"http://www.soso.com/"
// 			},
// 			{
// 				"type":"view",
// 				"name":"视频",
// 				"url":"http://v.qq.com/"
// 			},
// 			{
// 				"type":"click",
// 				"name":"赞一下我们",
// 				"key":"V1001_GOOD"
// 			}]
// 		}],
// 		"matchrule":{
// 		"tag_id":"2",
// 		"sex":"1",
// 		"country":"中国",
// 		"province":"广东",
// 		"city":"广州",
// 		"client_platform_type":"2",
// 		"language":"zh_CN"
// 		}
// 	}
	/**
	 * 个性菜单地址
	 * @var string
	 */
	protected $create_conditional_url='https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token={ACCESS_TOKEN}';
	/**
	 * 删除个性菜单地址
	 * @var string
	 */
	protected $del_conditional_url='https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token={ACCESS_TOKEN}';
	/**
	 * 测试个性菜单地址
	 * @var string
	 */
	protected $trymatch_url='https://api.weixin.qq.com/cgi-bin/menu/trymatch?access_token={ACCESS_TOKEN}';
	
	/**
	 * 创建个性化菜单
	 * @param array $menu
	 * @param array $matchrule
	 * @return \LSYS\Wechat\Result
	 */
	public function conditionalAdd(array $menu,array $matchrule){
		$data=$this->_makeRun($this->create_conditional_url,array("button"=>$menu,'matchrule'=>$matchrule));
		if (is_object($data)) return $data;
		return new Result(true, $data['menuid']);
	}
	/**
	 * 删除个性化菜单
	 * @param string $menuid
	 * @return \LSYS\Wechat\Result
	 */
	public function conditionalDel($menuid){
		$data=$this->_makeRun($this->del_conditional_url,array("menuid"=>$menuid));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/** 
	 * 测试个性化菜单匹配结果
	 * @param string $user_id
	 * @return \LSYS\Wechat\Result
	 */
	public function trymatch($user_id){
		$data=$this->_makeRun($this->trymatch_url,array("user_id"=>$user_id));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}