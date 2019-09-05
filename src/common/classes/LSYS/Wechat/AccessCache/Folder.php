<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat\AccessCache;
use LSYS\Wechat\AccessCache;
use LSYS\Wechat\Exception;

class Folder implements AccessCache
{
	//save dir
    protected $_folder;
    protected $_spoce;
    /**
     * @param string   $folder		   log folder
     */
    public function __construct($folder,$sopce='access')
    {
        $this->_folder = rtrim($folder,'/\\').'/';
        $this->_spoce=$sopce;
        if (!is_writable($this->_folder)) throw new Exception("can't be write to :".$this->_folder);
    }
    protected function _file($appid){
    	if (strpos($appid, '/')!==false||strpos($appid, '\\')!==false)$appid=md5($appid);
    	return $this->_folder.$this->_spoce."_".$appid.".cache";
    }
    public function setAccess($appid,$access,$time){
    	$filename=$this->_file($appid);
    	return @file_put_contents($filename, time()+$time."|".$access);
    }
    public function getAccess($appid){
    	$filename=$this->_file($appid);
    	if (!is_file($filename)) return array(null,0);
    	$data=file_get_contents($filename);
    	$p=strpos($data,"|");
    	return array(substr($data,$p+1),substr($data,0,$p));
    }
}