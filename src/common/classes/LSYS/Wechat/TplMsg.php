<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class TplMsg extends Access{
	/**
	 * @var string
	 */
	protected $set_industry_url='https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $get_industry_url='https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token={ACCESS_TOKEN}';
	/**
	 * set industry
	 * @param int $industry_id1
	 * @param int $industry_id2
	 * @return mixed
	 */
	public function setIndustry($industry_id1,$industry_id2){
		$data=$this->_makeRun($this->set_industry_url,array(
			"industry_id1"=>$industry_id1,'industry_id2'=>$industry_id2
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * get industry
	 * @return array
	 */
	public function getIndustry(){
		$data=$this->_makeRun($this->get_industry_url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
	//tpl
	/**
	 * @var string
	 */
	protected $add_template_url='https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $get_template_url='https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token={ACCESS_TOKEN}';
	/**
	 * @var string
	 */
	protected $del_template_url='https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token={ACCESS_TOKEN}';
	/**
	 * add template
	 * @param string $template_id_short
	 * @return mixed
	 */
	public function addTemplate($template_id_short){
		$data=$this->_makeRun($this->add_template_url,array(
			"template_id_short"=>$template_id_short
		));
		if (is_object($data)) return $data;
		return new Result(true, $data['template_id']);
	}
	/**
	 * get template
	 * @return mixed
	 */
	public function getTemplate(){
		$data=$this->_makeRun($this->get_template_url);
		if (is_object($data)) return $data;
		return new Result(true, $data['template_list']);
	}
	/**
	 * del template
	 * @param string $template_id
	 * @return mixed
	 */
	public function delTemplate($template_id){
		$data=$this->_makeRun($this->del_template_url,array("template_id"=>$template_id));
		if (is_object($data)) return $data;
		return new Result(true);
	}
	//send msg...
	/**
	 * @var string
	 */
	protected $send_url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={ACCESS_TOKEN}';
	/**
	 * send message to user
	 *
	 * @param string $touser openid
	 * @param string $name config name
	 * @param array $data array('key'=>'value')
	 * @param string $url url string
	 * @return \LSYS\Wechat\Result
	 */
	public function send($touser,$name,$data=array(),$url=null){
		$map=$this->_config->get("tpl_map",array());
		if (!isset($map[$name]))$map=array();
		else $map=$map[$name];
		$template_id=isset($map['template_id'])?$map['template_id']:'';
		if(!isset($map['colors'])||!is_array($map['colors'])) $color=array();
		else $color=$map['colors'];
		$_data=array();
		foreach ($data as $k=>$v){
			$_data[$k]=array(
					"value"=>$v,
					"color"=>isset($color[$k])?$color[$k]:"#173177"
			);
		}
		return $this->tplSend($touser, $template_id,$_data,$url);
	}
	/**
	 * send message to user form tpl
	 * @param string $touser
	 * @param string $template_id
	 * @param array $data
	 * @param string $url
	 * @return \LSYS\Wechat\Result
	 */
	public function tplSend($touser,$template_id,$data=array(),$url=null){
		if ($url==null)$url=Utils::homeUrl();
		$data=$this->_makeRun($this->send_url,array(
				"touser"=>$touser,
				"template_id"=>$template_id,
				"url"=>$url,
				"data"=>$data
		));
		if (is_object($data)) return $data;
		if (isset($data['msgid'])&&$data['msgid']>0){
			return new Result(true, $data['msgid']);
		}
		if (strtolower($data['Status'])!=='success'){
			return new Result(false, $data['Status']);
		}
		return new Result(true);
	}
	
}