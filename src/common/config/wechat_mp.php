<?php
/**
 * lsys wechat api
 * 示例配置 未引入
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
return array(
	"default"=>array(
		"app_id"=>'wxa3f2202198fde906',
		"appkey_secret"=>'d8fbfe6912f602bdad41c5140f7a0326',//access 用到
		"msg_token"=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',//msg 用到
		"msg_aeskey"=>'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG',//msg 用到
		'tpl_map'=>array(//模板消息用到
				'reg_dome'=>array(
						'template_id'=>'HUjOa2TnKf6Vn5s7E_j29GRTEU9MkW-jc686jwVI6xQ',
						'colors'=>array(
								'title'=>'#161511',
								'body'=>'#663399'
						)
				)
		)
	),
);