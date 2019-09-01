<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg\Type;
/**
 * wechat 返回新闻元素节点类
 * @author User
 */
class NewsChild{
	protected $title;
	protected $description;
	protected $picurl;
	protected $url;
	public function __construct($title,$description,$picurl,$url){
		$this->title=$title;
		$this->description=$description;
		$this->picurl=$picurl;
		$this->url=$url;
	}
	public function __toString(){
		$ItemTpl = "<item>
					 <Title><![CDATA[%s]]></Title>
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>";
		return  sprintf($ItemTpl, $this->title, $this->description, $this->picurl, $this->url);
	}
	public function getTitle(){
		return $this->title;
	}
	public function getDescription(){
		return $this->description;
	}
	public function getPicurl(){
		return $this->picurl;
	}
	public function getUrl(){
		return $this->url;
	}
	
}