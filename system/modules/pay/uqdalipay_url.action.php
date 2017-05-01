<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
ini_set("display_errors","OFF");

class uqdalipay_url extends SystemAction {

	private $error = null;
	public function __construct(){			
		$this->db=System::load_sys_class('model');		
	} 	
	
	public function qiantai(){	
		
		
	
		$this->out_trade_no = $_GET['out_trade_no'];
		$this->qiantai_one();
		
		if($this->error == 'cok' || $this->error == 'gok'){	
			$this->qiantai_two();
		}else{
			$this->qiantai_two();
		}
	
	}
	public function qiantai_two(){	
		
		$out_trade_no = $this->out_trade_no;	//商户订单号
		$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no'");
		if(!$dingdaninfo || $dingdaninfo['status'] == '未付款'){
			_message("支付失败");			
		}else{
			if(empty($dingdaninfo['scookies'])){
				_message("充值成功!",WEB_PATH."/member/home/userbalance");
			}else{
				if($dingdaninfo['scookies'] == '1'){
					_message("支付成功!",WEB_PATH."/member/cart/paysuccess");
				}else{
					_message("商品还未购买,请重新购买商品!",WEB_PATH."/member/cart/cartlist");
				}
					
			}
		}
	}
	
	private function qiantai_one(){	
	
	
		
	   
  	    include G_SYSTEM."modules/pay/lib/alipay/alipay_notify.class.php";		
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'alipay' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$partner =  $pay_type_key['id']['val'];		//支付商号ID
		
		$alipay_config_sign_type = strtoupper('MD5');		//签名方式 不需修改
		$alipay_config_input_charset = strtolower('utf-8'); //字符编码格式		
		$alipay_config_cacert =  G_SYSTEM."modules/pay/lib/alipay/cacert.pem";	//ca证书路径地址
		$alipay_config_transport   = 'http';
		
		$alipay_config=array(
			"partner"      =>$partner,
			"key"          =>$key,
			"sign_type"    =>$alipay_config_sign_type,
			"input_charset"=>$alipay_config_input_charset,
			"cacert"       =>$alipay_config_cacert,
			"transport"    =>$alipay_config_transport
		);
		
		$alipay_config['partner'] ='M920ST';
		$alipay_config['key'] ='=S8910870';
		
		$_POST=$_GET;
		
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if(!$verify_result) {echo "fail";exit;} //验证失败		
		
		
		exit;
		
		
		if(!isset($_GET['notify_type']) && $_GET['notify_type'] != 'trade_status_sync'){		
			$this->error = true;
			return;
		}		
		if(!isset($_GET['seller_email']) && $_GET['seller_email'] != 'service@paotuitu.cn'){
			$this->error = true;
			return;
		}
		
		$out_trade_no = $_GET['out_trade_no'];	//商户订单号
		$trade_no = $_GET['trade_no'];			//支付宝交易号
		$trade_status = $_GET['trade_status'];	//交易状态
	
		//开始处理及时到账和担保交易订单
		if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS' || $trade_status == 'WAIT_SELLER_SEND_GOODS') {
			
			
			$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' and `status` = '未付款'");
			
			//没有该订单,失败
			if(!$dingdaninfo){	
				$this->error = true;
				return;
			}
			
			$c_money = intval($dingdaninfo['money']);			
			$uid = $dingdaninfo['uid'];
			$time = time();
			$this->db->Autocommit_start();
			$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '分润支付宝', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
			$up_q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money` + $c_money where (`uid` = '$uid')");				
			$up_q3 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$uid', '1', '账户', '充值', '$c_money', '$time')");
				
			if($up_q1 && $up_q2 && $up_q3){
				$this->db->Autocommit_commit();			
			}else{
				$this->db->Autocommit_rollback();
				$this->error = true;
				return;
			}			
			if(empty($dingdaninfo['scookies'])){					
					//echo "success";exit;	
					//充值完成		
					$this->error = 'cok';
					return;
			}			
			$scookies = unserialize($dingdaninfo['scookies']);			
			$pay = System::load_app_class('pay','pay');			
			$pay->scookie = $scookies;	

			$ok = $pay->init($uid,$pay_type['pay_id'],'go_record');	//云购商品	
			if($ok != 'ok'){
				_setcookie('Cartlist',NULL);
				//echo "fail";exit;	
				//商品购买失败	
				$this->error = true;
				return;
					
			}			
			$check = $pay->go_pay(1);
			if($check){
				$this->db->Query("UPDATE `@#_member_addmoney_record` SET `scookies` = '1' where `code` = '$out_trade_no' and `status` = '已付款'");
				_setcookie('Cartlist',NULL);
				//echo "success";exit;	
				//购买成功
				$this->error = 'gok';
				return;
			}else{
				$this->error = true;
				return;
			}
		
		}//开始处理订单结束
				

	}//function end
	
	

	public function houtai_tmp(){
	
		file_put_contents("alipay.txt",var_export($_POST,true));		
	   /*
  	    include G_SYSTEM."modules/pay/lib/alipay/alipay_notify.class.php";		
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'alipay' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$partner =  $pay_type_key['id']['val'];		//支付商号ID
		
		$alipay_config_sign_type = strtoupper('MD5');		//签名方式 不需修改
		$alipay_config_input_charset = strtolower('utf-8'); //字符编码格式		
		$alipay_config_cacert =  G_SYSTEM."modules/pay/lib/alipay/cacert.pem";	//ca证书路径地址
		$alipay_config_transport   = 'http';
		
		$alipay_config=array(
			"partner"      =>$partner,
			"key"          =>$key,
			"sign_type"    =>$alipay_config_sign_type,
			"input_charset"=>$alipay_config_input_charset,
			"cacert"       =>$alipay_config_cacert,
			"transport"    =>$alipay_config_transport
		);
		
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if(!$verify_result) {echo "fail";exit;} //验证失败		
		*/
		
		
		if(!isset($_POST['notify_type']) && $_POST['notify_type'] != 'trade_status_sync'){
			echo "fail";exit;
		}		
		if(!isset($_POST['seller_email']) && $_POST['seller_email'] != 'service@paotuitu.cn'){
			echo "fail";exit;
		}
		file_put_contents("alipay1.txt",'11');	
		$out_trade_no = $_POST['out_trade_no'];	//商户订单号
		$trade_no = $_POST['trade_no'];			//支付宝交易号
		$trade_status = $_POST['trade_status'];	//交易状态
		
		
		//开始处理及时到账和担保交易订单
		if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS' || $trade_status == 'WAIT_SELLER_SEND_GOODS') {
			
			
			$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' and `status` = '未付款'");
			if(!$dingdaninfo){	echo "fail";exit;}	//没有该订单,失败
			$c_money = intval($dingdaninfo['money']);			
			$uid = $dingdaninfo['uid'];
			$time = time();
			$this->db->Autocommit_start();
			$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '支付宝', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
			$up_q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money` + $c_money where (`uid` = '$uid')");				
			$up_q3 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$uid', '1', '账户', '充值', '$c_money', '$time')");
				
			if($up_q1 && $up_q2 && $up_q3){
				$this->db->Autocommit_commit();			
			}else{
				$this->db->Autocommit_rollback();
				echo "fail";exit;
			}			
			if(empty($dingdaninfo['scookies'])){					
					echo "success";exit;	//充值完成			
			}			
			$scookies = unserialize($dingdaninfo['scookies']);			
			$pay = System::load_app_class('pay','pay');			
			$pay->scookie = $scookies;	

			$ok = $pay->init($uid,$pay_type['pay_id'],'go_record');	//云购商品	
			if($ok != 'ok'){
				_setcookie('Cartlist',NULL);
				echo "fail";exit;	//商品购买失败			
			}			
			$check = $pay->go_pay(1);
			if($check){
				$this->db->Query("UPDATE `@#_member_addmoney_record` SET `scookies` = '1' where `code` = '$out_trade_no' and `status` = '已付款'");
				_setcookie('Cartlist',NULL);
				echo "success";exit;			
			}else{
				echo "fail";exit;
			}
		
		}//开始处理订单结束
				

	}//function end
	
}//

?>