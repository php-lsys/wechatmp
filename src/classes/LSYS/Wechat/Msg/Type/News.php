<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\Msg\Type;

use LSYS\Wechat\Msg\Type;
/**
 * wechat 返回新闻元素类
 * @author User
 */
class News implements Type{
	protected $wechat_callback_item_new_articles_items=array();
	public function addItem(NewsChild $newitem){
		array_push($this->wechat_callback_item_new_articles_items, $newitem);
		return $this;
	}
	public function to_Xml($ToUserName, $FromUserName){
		$count=0;
		$item_str='';
		foreach ($this->wechat_callback_item_new_articles_items as $v){
			if ($v instanceof NewsChild) {
				$count++;
				$item_str.=$v->__toString();
			}
		}
		$time = time();
		$Tpl = "<xml>
				 <ToUserName><![CDATA[%s]]></ToUserName>
				 <FromUserName><![CDATA[%s]]></FromUserName>
				 <CreateTime>%s</CreateTime>
				 <MsgType><![CDATA[%s]]></MsgType>
				 <ArticleCount>%s</ArticleCount>
				 <Articles>
					 %s
				 </Articles>
				 </xml>";
		$resultStr = sprintf($Tpl, $ToUserName, $FromUserName, $time,$this->to_name(), $count, $item_str);
		return  $resultStr;
	}
	public function to_array(){
		$items=array();
		foreach ($this->wechat_callback_item_new_articles_items as $v){
			if ($v instanceof NewsChild) {
				$items[]=array(
					"title"=>$v->get_title(),
					"description"=>$v->get_description(),
					"url"=>$v->get_url(),
					"picurl"=>$v->get_picurl()
				);
			}
		}
		return array(
       		"articles"=> $items
	    );
	}
	public function to_name(){
		return 'news';
	}
}