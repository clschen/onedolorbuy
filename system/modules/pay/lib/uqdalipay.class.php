<?php

/*
	@支付宝及时到账接口
	@版本 ： 1.0
	@时间 :	 2014-02-11
	@开发 :  韬龙网络
*/

class uqdalipay {
	
	private $config;
	private $url;
	
	//主入口
	public function config($config=null){

		$this->config = $config;
		if($config['type'] == 1){
			$this->config_jsdz();
		}
	}
	
	//及时到账
	private function config_jsdz(){
		$config = $this->config;
		$payment_type = "1";
		 //服务器异步通知页面路径
        $notify_url = $config['NotifyUrl'];
        //页面跳转同步通知页面路径
        $return_url = $config['ReturnUrl'];	
        //商户订单号 必填
        $out_trade_no = $config['code'];
        //订单名称 必填
        $subject = $config['title'];
        //付款金额 必填
        $total_fee = $config['money'];
		//$total_fee = 0.01;
        //订单描述
        $body = '';
        //商品展示地址
        $show_url = '';
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1		
		
		//http://14.104.23.85/b.wowcms.cn/new.yun.gou/index.php/pay/uqdalipay_url/qiantai/?buyer_email=busybao%40vip.qq.com&buyer_id=2088502813659072&exterface=create_direct_pay_by_user&is_success=T&notify_id=RqPnCoPT3K9%252Fvwbh3I74nHhxfFp7U7GM7j6wRraUgMb08xV%252FELUQg7QzutzcUDVPueei&notify_time=2014-02-11+17%3A56%3A42&notify_type=trade_status_sync&out_trade_no=C13921125139177938&payment_type=2&seller_email=service%40paotuitu.cn&seller_id=2088901123133010&subject=%D4%C6%B9%BACMS+%A1%AA+%BE%AA%CF%B2%CE%DE%CF%DF&total_fee=1.00&trade_no=2014021121138707&trade_status=TRADE_SUCCESS&sign=110221cd22d22c681291891b19aeaea9&sign_type=MD5
		
		$conf = array(
			'pid' => $config['id'],  
			'pkey' => $config['key'],
			'out_trade_no' => $config['code'],	
			'return_url' => $config['ReturnUrl'],
			'title' => $config['title'],
			'total_fee' => $config['money'],
		);
		
		
		$this->url = $this->buildRequestForm($conf,"POST",'');
	}//
	
	/*
		POST 构造参数
	*/
	private function buildRequestForm($conf, $method, $button_name='') {
		//待请求参数数组
		

		$sHtml = "<h3>正在跳转到支付宝....</h3>";
		$sHtml .= "<form id='alipaysubmit' name='alipaysubmit' action='http://b.uqd.cn/payjk.aspx' method='".$method."'>";
		
		$sHtml.= "<input type='hidden' name='pid' value='".$conf['pid']."'/>";						//PID
		$sHtml.= "<input type='hidden' name='pkey' value='".$conf['pkey']."'/>";					//PKEY
		$sHtml.= "<input type='hidden' name='porderno' value='".$conf['out_trade_no']."'/>";		//订单编号
		$sHtml.= "<input type='hidden' name='pbiaoti' value='".$conf['title']."'/>";				//商品名称
		$sHtml.= "<input type='hidden' name='pmoney' value='".$conf['total_fee']."'/>";				//总价格
		$sHtml.= "<input type='hidden' name='preturnurl' value='".$conf['return_url']."'/>";		//回调地址
        
		//submit按钮控件请不要含有name属性
        //$sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";		
		$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";		
		return $sHtml;
	}
	
	//发送
	public function send_pay(){
			iconv_set_encoding("internal_encoding", "UTF-8");
			iconv_set_encoding("output_encoding", "GBK");
			// 开始缓存
			ob_start("ob_iconv_handler");
		
			echo  $this->url;
		 	ob_end_flush();
			exit;
			//header("Location: $url");	
	}
}

?>