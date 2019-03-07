<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
class Card extends Access{
	/**
	 * @var string
	 */
	protected $create_card_url='https://api.weixin.qq.com/card/create?access_token={ACCESS_TOKEN}';
	/** 
	 * 创建卡券
	 * @param string $user_id
	 * @return \LSYS\Wechat\Result
	 */
	public function create($card){
		$data=$this->_makeRun($this->create_card_url,array("card"=>$card));
		if (is_object($data)) return $data;
		return new Result(true, $data['card_id']);
	}
	
	protected $create_qrcode_url='https://api.weixin.qq.com/card/qrcode/create?access_token={ACCESS_TOKEN}';
	//一次领取一个
	const QR_CARD="QR_CARD";
	//一次领取多个
	const QR_MULTIPLE_CARD="QR_CARD";
	/**
	 * 创建卡券二维码,用于用户扫码领取券用
	 * 或者把二维码显示在页面,由用户识别二维码在把券放入用户的卡包
	 * @param string $user_id
	 * @return \LSYS\Wechat\Result
	 */
	public function qrcode($qr_card,$cart_data){
		//dome data
// 		$cart_data=array(
// 			"card_id"=>"pFS7Fjg8kV1IdDz01r4SQwMkuCKc",
// 			"code"=> "198374613512",
// 			"openid"=> "oFS7Fjl0WsZ9AMZqrI80nbIq8xrA",
// 			"is_unique_code"=> false ,
// 			"outer_str"=>"12b"
// 		);
		switch ($qr_card){
			case self::QR_CARD:
				$arr=array(
					"action_name"=>$qr_card,
					"action_info"=>array(
					"card"=>$cart_data
					)
				);
				if(isset($cart_data['expire_seconds'])){
					$arr['expire_seconds']=$cart_data['expire_seconds'];
					unset($arr['card']['expire_seconds']);
				}
			break;
			case self::QR_MULTIPLE_CARD:
				$mdata=func_get_args();
				array_shift($mdata);
				$arr=array(
						"action_name"=>$qr_card,
						"action_info"=>array(
							"multiple_card"=>array(
								'card_list'=>$mdata
							)
						)
				);
			break;
		}
		if (!isset($arr))return new Result(false,'qr wrong');
		$data=$this->_makeRun($this->create_qrcode_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
	protected $query_url='https://api.weixin.qq.com/card/code/get?access_token={ACCESS_TOKEN}';
	/**
	 * 查询指定领取卡券状态
	 * 返回  "user_card_status": "NORMAL" 为正常卡券
	 * @param string $card_id
	 * @param string $code
	 * @param string $check_consume 是否检测核销
	 * @return \LSYS\Wechat\Result
	 */
	public function codeGet($card_id,$code,$check_consume=true){
		$arr=array(
			"card_id" =>$card_id,
			"code" => $code,
			"check_consume" =>$check_consume
		);
		$data=$this->_makeRun($this->query_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
	protected $consume_url='https://api.weixin.qq.com/card/code/consume?access_token={ACCESS_TOKEN}';
	/**
	 * 核销指定卡券
	 * @param string $code
	 * @param string $card_id
	 * @return \LSYS\Wechat\Result
	 */
	public function codeConsume($card_id,$code){
		$arr=array(
			"code" => $code,
			"card_id" =>$card_id,
		);
		$data=$this->_makeRun($this->consume_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	
	
	
	//常用票 -- start --
	protected static function _baseInfo(array $data){
		extract($data);
		//dome...
		// 		$data=array(
		// 			'logo_url'=>'',
		// 			'brand_name'=>'xxxx',
		// 			'title'=>'xxxxx',
		// 			'phone'=>'13800138000',
		// 			'desp'=>'xxx',
		// 			'sub_title'=>'site name',
		// 		);
		if (!isset($code_type))$code_type="CODE_TYPE_TEXT";
		if (!isset($notice))$notice='';
		if (!isset($color))$color='Color010';
		if (!isset($start_time))$start_time=time();
		if (!isset($end_time))$end_time=time()+3600*24*7;
		if (!isset($get_limit))	$get_limit='1';//限制领取
		if (!isset($quantity))$quantity='5000';//库存
		if (!isset($url))$url=Utils::homeUrl();
		if (!isset($location_id))$location_id=array();//门店位置
		if (!isset($can_share))$can_share=false;
		if (!isset($can_give_friend))$can_give_friend=false;
		if (!isset($use_custom_code))$use_custom_code=true;
		if (!isset($bind_openid))$bind_openid=false;
		if (!isset($custom_url_name))$custom_url_name='查看更多';
		return array(
				"logo_url"=>$logo_url,
				"brand_name"=>$brand_name,
				"code_type"=>$code_type,
				"title"=>$title,
				"color"=> $color,
				"notice"=> $notice,
				"service_phone"=> $phone,
				"description"=> $desp,
				"date_info"=> array(
						"type"=> 1,
						"begin_timestamp"=> $start_time ,
						"end_timestamp"=> $end_time
				),
				"sku"=>array(
						"quantity"=>$quantity
				),
				"get_limit"=>$get_limit,
				"use_custom_code"=>$use_custom_code,
				"bind_openid"=>$bind_openid,
				"can_share"=> $can_share,
				"can_give_friend"=> $can_give_friend,
				"location_id_list" =>$location_id,
				"custom_url_name" =>$custom_url_name,
				"custom_url" =>$url,
				"custom_url_sub_title" => $sub_title,
			);
	}
	
	/**
	 * 会议门票数据
	 * @param array $data
	 * @return \LSYS\Wechat\Result
	 */
	public static function meetingTicket(array $data){
		$bf=self::_baseInfo($data);
		if (is_object($bf)) return $bf;
		// 		$data=array(
		// 			'detail'=>'',
		// 		);
		extract($data);
		if (!isset($detail))$detail='';
		$data= array(
			"card_type"=> "MEETING_TICKET",
			"meeting_ticket"=>array(
					"base_info"=>$bf,
					"meeting_detail" =>$detail
			),
		);
		return new Result(true, $data);
	}
	protected $meeting_update_url='https://api.weixin.qq.com/card/meetingticket/updateuser?access_token={ACCESS_TOKEN}';
	/**
	 * 门票更新
	 * @param string $card_id
	 * @param string $code
	 * @param string $seat_number 座位号
	 * @param string $zone
	 * @param string $entrance
	 * @return \LSYS\Wechat\Result
	 */
	public function meetingUpdate($card_id,$code,$seat_number,$zone='全场',$entrance='正门'){
		$arr=array(
			"code"=>$code,
			"card_id"=>$card_id,
			"zone" => $zone,
			"entrance" =>$entrance,
			"seat_number" =>$seat_number
		);
		$data=$this->_makeRun($this->meeting_update_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
	/**
	 * 景点门票数据创建
	 * @param array $data
	 * @return \LSYS\Wechat\Result
	 */
	public static function scenicTicket(array $data){
		$bf=self::_baseInfo($data);
		if (is_object($bf)) return $bf;
		// 		$data=array(
		// 			'ticket_class'=>'',
		// 			'sub_title'=>'site name',
		// 		);
		extract($data);
		if (!isset($ticket_class))$ticket_class="全日票";
		if (!isset($guide_url))$guide_url=Utils::homeUrl();
		$data=array(
			"card_type"=> "SCENIC_TICKET",
			"scenic_ticket"=>array(
				"base_info"=> $bf,
				"guide_url"=>$guide_url,
				"ticket_class"=> $ticket_class
			)
		);
		return new Result(true, $data);
	}
	
	/**
	 * 电影票数据创建
	 * @param array $data
	 * @return \LSYS\Wechat\Result
	 */
	public static function movieTicket(array $data){
		$bf=self::_baseInfo($data);
		if (is_object($bf)) return $bf;
		// 		$data=array(
	// 				'detail'=>'detail',
		// 		);
		extract($data);
		if (!isset($detail))$detail='暂无介绍';
		$data=array(
				"card_type"=> "MOVIE_TICKET",
				"movie_ticket"=>array(
					"base_info"=> $bf,
					"detail"=>$detail
				)
		);
		return new Result(true, $data);
	}
	
	protected $movie_update_url='https://api.weixin.qq.com/card/movieticket/updateuser?access_token={ACCESS_TOKEN}';
	/**
	 * 电影票更新
	 * @param string $card_id
	 * @param string $code
	 * @param string $show_time
	 * @param string $screening_room
	 * @param string $seat_number
	 * @param string $duration
	 * @param string $ticket_class
	 * @return \LSYS\Wechat\Result
	 */
	public function movieUpdate(
			$card_id,$code,$show_time,$screening_room,$seat_number,
			$duration='120',$ticket_class='3D'){
		if (is_string($seat_number))$seat_number=array($seat_number);
		$arr=array(
				"code"=>$code,
				"card_id"=>$card_id,
				"ticket_class"=>$ticket_class,
				"show_time"=>$show_time,
				"duration"=>$duration,
				"screening_room"=>$screening_room,
				"seat_number"=>$seat_number
		);
		$data=$this->_makeRun($this->movie_update_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}

	/**
	 * 飞机票数据创建
	 * @param array $data
	 * @return \LSYS\Wechat\Result
	 */
	public static function boardingTicket(array $data){
		$bf=self::_baseInfo($data);
		if (is_object($bf)) return $bf;
		// 		$data=array(
		// 				'from'=>'成都',
		// 				'to'=>'广州',
		// 				'flight'=>'CE123',
		// 				'departure_time'=>'1434507901',
		// 				'landing_time'=>'1434909901',
		// 				'air_model'=>'空客A380',
		// 		);
		extract($data);
		$data=array(
				"card_type"=> "BOARDING_PASS",
				"boarding_pass"=>array(
					"base_info"=> $bf,
					'from'=>$from,
					'to'=>$to,
					'flight'=>$flight,
					'departure_time'=>$departure_time,
					'landing_time'=>$landing_time,
					'air_model'=>$air_model,
				)
		);
		return new Result(true, $data);
	}
	
	protected $boarding_pass_url='https://api.weixin.qq.com/card/boardingpass/checkin?access_token={ACCESS_TOKEN}';
	/**
	 * 更新换取飞机票的数据
	 * @param string $card_id
	 * @param string $code
	 * @param string $passenger_name
	 * @param string $class
	 * @param string $seat
	 * @param string $etkt_bnr
	 * @param string $qrcode_data
	 * @param string $is_cancel
	 * @return \LSYS\Wechat\Result
	 */
	public function boardingPass(
		$card_id,$code,$passenger_name,$class,$seat,
		$etkt_bnr,$qrcode_data,$is_cancel=false){
		$arr=array(
			"code"=>$code,
			"card_id"=>$card_id,
			"passenger_name"=> $passenger_name,
			"class"=> $class,
			"seat"=> $seat,
			"etkt_bnr"=> $etkt_bnr,
			"qrcode_data"=> $qrcode_data,
			"is_cancel "=> $is_cancel
		);
		$data=$this->_makeRun($this->boarding_pass_url,$arr);
		if (is_object($data)) return $data;
		return new Result(true, $data);
	}
}