<?php 

class shan {
	
	private $config;
	private $url;
	//主入口
	public function config($config=null){

		$this->config = $config;
		$this->config_jsdz();
		
		
		
	}
	
	//及时到账
	private function config_jsdz(){
		include dirname(__FILE__).'/shanpay/lib/shan_md5.function.php';
		$config = $this->config;
		/**************************请求参数**************************/

        //商户订单号
        $out_order_no = $config['code'];//商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $config['title'];//必填

        //付款金额
        $total_fee = $config['money'];//必填 需为整数

        //订单描述

        $body ='';
		
		
		//服务器异步通知页面路径
        $notify_url = $config['NotifyUrl'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = $config['ReturnUrl'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"partner" => trim($config['id']),
		        "user_seller"  => $config['pay_type_data']['seller_id']['val'],
				"out_order_no"	=> $out_order_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url
		);
		$key = $config['key'];
		//建立请求
		$this->url  = buildRequestFormShan($parameter, $key);
		
	}	
	
	//发送
	public function send_pay(){
		 echo  $this->url;
		 exit;
		//header("Location: $url");	
	}
}

?>
