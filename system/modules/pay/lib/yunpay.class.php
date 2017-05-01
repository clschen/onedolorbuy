<?php 



class yunpay {

 

	private $config;

	/**

	*	支付入口

	**/

	

	public function config($config=null){

			$this->config = $config;

	}

	

	public function send_pay(){

			$config = $this->config;
			
			
			
			//合作身份者id
			$yun_config['partner']		= $config['id'];
			
			//安全检验码
			$yun_config['key']			= $config['key'];
			
			//云会员账户（邮箱）
			$seller_email               = $config['pay_type_data']['user']['val'];
			
			include dirname(__FILE__).DIRECTORY_SEPARATOR."yunpay".DIRECTORY_SEPARATOR."yun_md5.function.php";
			
			//商户订单号
			$out_trade_no = $config['code'];//商户网站订单系统中唯一订单号，必填
	
			//订单名称
			$subject = $config['title'];//必填
	
			//付款金额
			$total_fee = $config['money'];//必填 需为整数
	
			//订单描述
	
			$body = '';
			
		//服务器异步通知页面路径
        $nourl = $config['NotifyUrl'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $reurl = $config['ReturnUrl'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
			
			//print_r($config);
			//exit();
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"partner" => trim($yun_config['partner']),
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"total_fee"	=> $total_fee,
					"body"	=> $body,
					"nourl"	=> $nourl,
					"reurl"	=> $reurl
			);
			


			$html_text = i2e($parameter, "支付进行中...");
			echo $html_text;
			exit;

	

	}



 }



?>