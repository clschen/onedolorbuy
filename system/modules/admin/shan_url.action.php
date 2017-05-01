<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
ini_set("display_errors","OFF");
class shan_url extends SystemAction {
	public function __construct(){			
		$this->db=System::load_sys_class('model');		
	} 	
	
	public function qiantai(){	
		sleep(3);
		$out_trade_no = $_GET['out_order_no'];	//商户订单号
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
	
	public function houtai(){
		

		//file_put_contents("alipay.txt",var_export($_POST,true));		
	    // include dirname(__FILE__).'/shanpay/lib/shan_md5.function.php';	
	    include G_SYSTEM."modules/pay/lib/shanpay/lib/shan_md5.function.php";	
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'shan' and `pay_start` = '1'");

		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$partner =  $pay_type_key['id']['val'];		//支付商号ID
		//计算得出通知验证结果
		
		$yunNotify = md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$key,$partner);
		if($yunNotify) {//验证成功
			if($_REQUEST['trade_status']=='TRADE_SUCCESS'){
				    /*
					加入您的入库及判断代码;
					判断返回金额与实金额是否想同;
					判断订单当前状态;
					完成以上才视为支付成功
					*/
					//商户订单号
					$out_trade_no = $_REQUEST['out_order_no'];
					//闪付交易号
					$trade_no = $_REQUEST['trade_no'];
					//价格
					$price=$_REQUEST['total_fee'];
					// var_dump($_REQUEST);
					$this->db->Autocommit_start();
					$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' and `status` = '未付款' for update");
					if(!$dingdaninfo){	echo "fail";exit;}	//没有该订单,失败
					$c_money = intval($dingdaninfo['money']);			
					$uid = $dingdaninfo['uid'];
					$time = time();			
					$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '闪付', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
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
				}
				echo 'success';

		}else {
		   //验证失败
		    echo "fail";//请不要修改或删除
		}		

	}//function end
	
}//

?>