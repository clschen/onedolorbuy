<?php 
defined('G_IN_SYSTEM')or exit('no');
ignore_user_abort(TRUE);
set_time_limit(0); 
System::load_sys_fun("send");
System::load_sys_fun("user");
System::load_app_class('admin',G_ADMIN_DIR,'no');

class dingdan extends admin {

	private $db;

	public function __construct(){		

		parent::__construct();		

		$this->db=System::load_sys_class('model');		

		$this->ment=array(

						array("lists","订单列表",ROUTE_M.'/'.ROUTE_C."/lists"),					

						array("lists","中奖订单",ROUTE_M.'/'.ROUTE_C."/lists/zj"),					

						array("lists","已发货",ROUTE_M.'/'.ROUTE_C."/lists/sendok"),

						array("lists","未发货",ROUTE_M.'/'.ROUTE_C."/lists/notsend"),						

						array("insert","已完成",ROUTE_M.'/'.ROUTE_C."/lists/ok"),

						array("insert","已作废",ROUTE_M.'/'.ROUTE_C."/lists/del"),

						array("insert","待收货",ROUTE_M.'/'.ROUTE_C."/lists/shouhuo"),

						array("genzhong","<b>快递跟踪</b>",ROUTE_M.'/'.ROUTE_C."/genzhong"),

		);

	}

	

	public function genzhong(){	

		include $this->tpl(ROUTE_M,'dingdan.genzhong');	

	}

	public function lists(){	

		

		/*

			已付款,未发货,已完成

			未付款,已发货,已作废

			已付款,未发货,待收货

		*/

		$where = $this->segment(4);

		if(!$where){

			$list_where = "where `status` LIKE  '%已付款%'";

		}elseif($where == 'zj'){

			//中奖		

			$list_where = "where `huode` != '0'";

		}elseif($where == 'sendok'){

			//已发货订单

			$list_where = "where `huode` != '0' and  `status` LIKE  '%已发货%'";

		}elseif($where == 'notsend'){

			//未发货订单

			$list_where = "where `huode` != '0' and `status` LIKE  '%未发货%'";

		}elseif($where == 'ok'){

			//已完成

			$list_where = "where `huode` != '0' and  `status` LIKE  '%已完成%'";

		}elseif($where == 'del'){

			//已作废		

			$list_where = "where `status` LIKE  '%已作废%'";

		}elseif($where == 'gaisend'){

			//该发货			

			$list_where = "where `huode` != '0' and `status` LIKE  '%未发货%'";

		}elseif($where == 'shouhuo'){

			//该发货			

			$list_where = "where `status` LIKE  '%待收货%'";

		}

		

		if(isset($_POST['paixu_submit'])){

			$paixu = $_POST['paixu'];

			if($paixu == 'time1'){

				$list_where.=" order by `time` DESC";

			}

			if($paixu == 'time2'){

				$list_where.=" order by `time` ASC";

			}

			if($paixu == 'num1'){

				$list_where.=" order by `gonumber` DESC";

			}

			if($paixu == 'num2'){

				$list_where.=" order by `gonumber` ASC";

			}

			if($paixu == 'money1'){

				$list_where.=" order by `moneycount` DESC";

			}

			if($paixu == 'money2'){

				$list_where.=" order by `moneycount` ASC";

			}

		

		}else{

			$list_where.=" order by `time` DESC";

			$paixu = 'time1';

		}

			

		$num=20;

	

		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_member_go_record` $list_where");

		$page=System::load_sys_class('page');

		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	

		$page->config($total,$num,$pagenum,"0");

		$recordlist=$this->db->GetPage("SELECT * FROM `@#_member_go_record` $list_where",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));	

		

		

		include $this->tpl(ROUTE_M,'dingdan.list');	

	}

	

	//订单详细

	public function get_dingdan(){

		$code=abs(intval($this->segment(4)));

		$record=$this->db->GetOne("SELECT * FROM `@#_member_go_record` where `id`='$code'");

		if(!$record)_message("参数不正确!");

		

		if(isset($_POST['submit'])){
			$record_code =explode(",",$record['status']);
			$status = $_POST['status'];
			$company = $_POST['company'];
			$company_code = $_POST['company_code'];
			$company_money = floatval($_POST['company_money']);
			$code = abs(intval($_POST['code']));
			if(!$company_money){
				$company_money = '0.01';
			}else{
				$company_money = sprintf("%.2f",$company_money);
			}
			if($status == '未完成'){
				$status = $record_code[0].','.$record_code[1].','.'未完成';		
			}
			if($status == '已发货'){
				$status = '已付款,已发货,待收货';
			}
			if($status == '未发货'){
				$status = '已付款,未发货,未完成';
			}
			if($status == '已完成'){
				$status = '已付款,已发货,已完成';	
			}
			if($status == '已作废'){
				$status = $record_code[0].','.$record_code[1].','.'已作废';				
			}			
			$ret = $this->db->Query("UPDATE `@#_member_go_record` SET `status`='$status',`company` = '$company',`company_code` = '$company_code',`company_money` = '$company_money' where id='$code'");
			if($ret){
				//调用发货通知
				if(_cfg("sendmobile")){
					//如果没有中奖短信就强制在发送一遍--E
					$data = $this->send_wx_ship_code($record['shopid']);
					if($data){
						$wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");// 获取token
						$access_token= get_token($wechat['appid'],$wechat['appsecret']);
						$postUrl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
						$this->https_request($postUrl,$data);
					}
				}
				_message("更新成功");
			}else{
				_message("更新失败");
			}
		}
		System::load_sys_fun("user");
		$uid= $record['uid'];
		$user = $this->db->GetOne("select * from `@#_member` where `uid` = '$uid'");
		$user_dizhi = $this->db->GetOne("SELECT * FROM `@#_member_dizhi` where `uid` = '$uid' ORDER BY `default`  DESC LIMIT 1");
		$go_time = $record['time'];
		include $this->tpl(ROUTE_M,'dingdan.code');	
	}
	//订单搜索
	public function select(){
		$record = '';
		if(isset($_POST['codesubmit'])){
			$code = htmlspecialchars($_POST['text']);		
			$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `code` = '$code'");	
		}
		if(isset($_POST['usersubmit'])){	
			if($_POST['user'] == 'uid'){
				$uid = intval($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `uid` = '$uid'");	
			}
		}
		if(isset($_POST['shopsubmit'])){
			if($_POST['shop'] == 'sid'){
				$sid = intval($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `shopid` = '$sid'");
			}
			if($_POST['shop'] == 'sname'){
				$sname= htmlspecialchars($_POST['text']);
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `shopname` = '$sname'");
			}
		}
		if(isset($_POST['timesubmit'])){
				$start_time = strtotime($_POST['posttime1']) ? strtotime($_POST['posttime1']) : time();				
				$end_time   = strtotime($_POST['posttime2']) ? strtotime($_POST['posttime2']) : time();
				$record = $this->db->GetList("SELECT * FROM `@#_member_go_record` where `time` > '$start_time' and `time` < '$end_time'");
		}
		include $this->tpl(ROUTE_M,'dingdan.soso');	
	}
	//私有方法保存菜单
	private function https_request($url,$data = null){
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    if (!empty($data)){
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
	    return json_decode($output);
	}

	//发送发货通知
	private function send_wx_ship_code($gid=null){
		//查询模板消息id
		$template_id = $this->db->GetOne("SELECT * FROM `@#_wxch_cfg` WHERE `cfg_name` = 'template_fh'");
		if(empty($template_id['cfg_value'])){
			return false;
		}
		$info = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$gid'");
		$member_band = $this->db->GetOne("SELECT * FROM `@#_member_band` WHERE `b_uid` = '{$info['q_uid']}' AND `b_type` = 'weixin'");
		if(empty($member_band)){
			return false;
		}
		$orders = $this->db->GetOne("SELECT * FROM `@#_member_go_record` WHERE `uid` = '{$info['q_uid']}' AND `shopid` = '{$info['id']}'");
		if(!empty($member_band['b_code'])){
			//发送数据组合
			$data = array(
				"touser" => $member_band['b_code'],
				"template_id"=>$template_id['cfg_value'],
				"url"=>WEB_PATH."/mobile/mobile/dataserver/".$info['id'], 
				"data" => array(
					'first' =>array(
						"value"=>"您好，您的中奖商品已经发货，请注意查收！",
						"color"=>"#173177",
						),
					"keyword1"=>array(
						"value"=>$orders['company'],
						"color"=>"#173177",
						),
					"keyword2"=>array(
						"value"=>$orders['company_code'],
						"color"=>"#173177",
						),
					"keyword3"=>array(
						"value"=>$info['title'],
						"color"=>"#173177",
						),
					"keyword4"=>array(
						"value"=>_cfg("web_name"),
						"color"=>"#173177",
						),
					"keyword5"=>array(
						"value"=>_cfg("cell"),
						"color"=>"#173177",
						),
					"remark"=>array(
						"value"=>"本订单由"._cfg("web_name")."提供发货及售后服务,感谢您的支持",
						"color"=>"#173177",
						),
				),
			);
		}
		return json_encode($data);
	}

}