<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Media extends Access{
	const TYPE_IMAGE="image";
	const TYPE_VOICE="voice";
	const TYPE_VIDEO="video";
	const TYPE_THUMB="thumb";
	/**
	 * @var string
	 */
	protected $upload_url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token={ACCESS_TOKEN}&type={TYPE}';
	protected $upload_get_url='https://api.weixin.qq.com/cgi-bin/media/get?access_token={ACCESS_TOKEN}&media_id={MEDIA_ID}';
	
	public static $upload_type_rule=array(
		self::TYPE_IMAGE=>array(
			'jpg','jpeg','png','gif'
		),
		self::TYPE_THUMB=>array(
			'jpg'
		),
		self::TYPE_VIDEO=>array(
			'amr','mp3'
		),
		self::TYPE_VOICE=>array(
			'mp4'
		),
	);
	
	/**
	 * 上传临时资源[3天]
	 */
	public function upload($file,$type=null){
		if ($type==null){
			$ext=substr(strrchr($file, '.'), 1);
			foreach (self::$upload_type_rule as $k=>$v){
				if (in_array($ext, $v)){
					$type=$k;break;
				}
			}
		}
		$url=str_replace('{TYPE}',$type, $this->upload_url);
		$data=$this->_makeRun($url,array("media"=>new \CURLFile($file)),false);
		if (is_object($data)) return $data;
		return new Result(true, $data['media_id']);
	}
	/**
	 * 获取临时资源路径
	 */
	public function get($media_id){
		$url=str_replace('{MEDIA_ID}',$media_id, $this->upload_get_url);
		$data=ltrim($this->_makeRun($url,array(),true,false));
		if (substr($data,0,2)=='{"'){
			$data=$this->_checkReturn($data);
			if (is_object($data)) return $data;
			if (isset($data['video_url']))$data=$data['video_url'];
			return new Result(true, $data);
		}else{
			return new Result(true, $data);
		}
	}
	
	/**
	 * @var string
	 */
	protected $upload_img_url='https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token={ACCESS_TOKEN}';
	protected $upload_news_url='https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token={ACCESS_TOKEN}';
	protected $upload_add_material_url='https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={ACCESS_TOKEN}&type={TYPE}';
	protected $upload_material_del_news_url='https://api.weixin.qq.com/cgi-bin/material/del_material?access_token={ACCESS_TOKEN}';
	protected $upload_material_get_news_url='https://api.weixin.qq.com/cgi-bin/material/get_material?access_token={ACCESS_TOKEN}';
	public static $upload_material_type_rule=array(
			self::TYPE_IMAGE=>array(
					'bmp','jpg','jpeg','png','gif'
			),
			self::TYPE_THUMB=>array(
					'jpg'
			),
			self::TYPE_VIDEO=>array(
					'wma','wav','amr','mp3'
			),
			self::TYPE_VOICE=>array(
					'mp4'
			),
	);
	/**
	 * 上传图片
	 */
	public function materialImg($file){
		$data=$this->_makeRun($this->upload_img_url,array("media"=>new \CURLFile($file)),false);
		if (is_object($data)) return $data;
		return new Result(true, $data['url']);
	}
	/**
	 * 上传文章[同:material_add_news,参数一致]
	 */
	public function materialNews(array $data){
		$data=$this->_makeRun($this->upload_news_url,array('articles'=>func_get_args()));
		if (is_object($data)) return $data;
		return new Result(true, $data['url']);
	}
	/**
	 * 添加永久资源
	 * 当type 为视频时,需要 $title $introduction
	 */
	public function materialUpload($file,$type=null,$title=null,$introduction=null){
		if ($type==null){
			$ext=substr(strrchr($file, '.'), 1);
			foreach (self::$upload_material_type_rule as $k=>$v){
				if (in_array($ext, $v)){
					$type=$k;break;
				}
			}
		}
		$url=str_replace('{TYPE}',$type, $this->upload_add_material_url);
		$json= array("media"=>new \CURLFile($file));
		if ($type==self::TYPE_VIDEO){
			$json['description']=json_encode(array(
					"title"=>$title, "introduction"=>$introduction
			),JSON_UNESCAPED_UNICODE);
		}
		$data=$this->_makeRun($url,$json,false);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 删除文章
	 * @param string $media_id
	 * @return \LSYS\Wechat\Result
	 */
	public function materialDel($media_id){
		$data=$this->_makeRun($this->upload_material_del_news_url,array(
			'media_id'=>$media_id,
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 得到文章
	 * @param string $media_id
	 * @return \LSYS\Wechat\Result
	 */
	public function materialGet($media_id){
		$data=$this->_makeRun($this->upload_material_get_news_url,array(
				'media_id'=>$media_id,
		),true,false);
		if (substr($data,0,2)=='{"'){
			$data=$this->_checkReturn($data);
			if (is_object($data)) return $data;
			if (isset($data['video_url']))$data=$data['video_url'];
			return new Result(true, $data);
		}else{
			return new Result(true, $data);
		}
	}
	
	//批量获取
	protected $batchget_material_url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token={ACCESS_TOKEN}';
	//资源数量
	protected $get_materialcount_url='https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token={ACCESS_TOKEN}';
	/**
	 * 获取资源列表
	 * @param string $type
	 * @param number $offset
	 * @param number $limit
	 * @return \LSYS\Wechat\Result
	 */
	public function materialBatchget($type,$offset=0,$limit=10){
		$data=$this->_makeRun($this->batchget_material_url,array(
			"type"=>$type,
			"offset"=>$offset,
			"count"=>$limit
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 获取资源数量
	 * @return \LSYS\Wechat\Result
	 */
	public function materialCount(){
		$data=$this->_makeRun($this->get_materialcount_url);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
	//文章增删改查
	protected $upload_material_add_news_url='https://api.weixin.qq.com/cgi-bin/material/add_news?access_token={ACCESS_TOKEN}';
	protected $upload_material_update_news_url='https://api.weixin.qq.com/cgi-bin/material/update_news?access_token={ACCESS_TOKEN}';
	/**
	 * 添加文章
	 $data=array(
       "title"=> '标题',
       "thumb_media_id"=>'缩略图ID[必须 add_material 添加]',
       "author"=> '作者',
       "digest"=> '摘要',
       "show_cover_pic"=> '封面',
       "content"=> '内容',
       "content_source_url"=>'来源地址'
    );
	 */
	public function materialAddNews(array $data){
		$data=$this->_makeRun($this->upload_material_add_news_url,array('articles'=>func_get_args()));
		if (is_object($data)) return $data;
		return new Result(true, $data['media_id']);
	}
	/**
	 * 更新文章
	 * @param string $media_id
	 * @param string $index 0开始
	 * @param array $data
	 * @return \LSYS\Wechat\Result
	 */
	public function materialUpdateNews($media_id,$index,array $data){
		$data=$this->_makeRun($this->upload_material_update_news_url,array(
			'media_id'=>$media_id,
			'index'=>$index,
			'articles'=>$data
		));
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}