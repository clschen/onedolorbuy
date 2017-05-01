<?php
include dirname(__FILE__).DIRECTORY_SEPARATOR."cbjpay".DIRECTORY_SEPARATOR."common".DIRECTORY_SEPARATOR."SignUtil.php";					
include dirname(__FILE__).DIRECTORY_SEPARATOR."cbjpay".DIRECTORY_SEPARATOR."common".DIRECTORY_SEPARATOR."DesUtils.php";				
include dirname(__FILE__).DIRECTORY_SEPARATOR."cbjpay".DIRECTORY_SEPARATOR."common".DIRECTORY_SEPARATOR."ConfigUtil.php";						
include dirname(__FILE__).DIRECTORY_SEPARATOR."cbjpay".DIRECTORY_SEPARATOR."api".DIRECTORY_SEPARATOR."cbjpay_submit.class.php";				
System::load_sys_fun('global');

class cbjpay{
	private $config;
	private $url;
	//主入口
	public function config($config=null){
		$this->config = $config;
		$this->config_jsdz();
	}

	//及时到账
	private function config_jsdz(){
		$this->db=System::load_sys_class('model');
		$system_config = System::load_sys_config('system');
		$param = array(
					//"serverUrl" 		 => ConfigUtil::get_val_by_key('serverPayUrl'),
					"version" 			 => "1.0",
					"token" 			 => "", 		
					"merchantNum" 		 => ConfigUtil::get_val_by_key('merchantNum'),
					"merchantRemark" 	 => $this->config['shouname'],
					"tradeNum" 			 => $this->config['code'],
					"tradeName" 		 => $this->config['title'],
					"tradeDescription" 	 => $this->config['title'],
					"tradeTime" 		 => date('Y-m-d H:i:s', time()),
					"tradeAmount" 		 => $this->config['money'] * 100,
					//"tradeAmount" 		 => "1",
					"currency" 			 => "CNY",
					// "notifyUrl" 		 => $this->config['NotifyUrl'],
					// "successCallbackUrl" => $this->config['ReturnUrl'],
					// "failCallbackUrl" 	 => $this->config['ReturnUrl'],
					"notifyUrl" 		 => "http://".$_SERVER['HTTP_HOST']."/".$system_config['index_name']."/pay/cbjpay_url/houtai/",
					"successCallbackUrl" => "http://".$_SERVER['HTTP_HOST']."/".$system_config['index_name']."/pay/cbjpay_url/qiantai/",
					"failCallbackUrl" 	 => "http://".$_SERVER['HTTP_HOST']."/".$system_config['index_name']."/pay/cbjpay_url/qiantai/",
			);

		$sign = SignUtil::sign($param);
		$param["merchantSign"] = $sign;


		
		
		if ($param["version"] == "1.0") {
			//敏感信息未加密
		} else if ($param["version"] == "2.0") {
			//敏感信息加密
			//获取商户 DESkey
			//对敏感信息进行 DES加密
			$desUtils  = new DesUtils();
			$key = ConfigUtil::get_val_by_key("desKey");
			$param["merchantRemark"] 	 = $desUtils->encrypt($param["merchantRemark"],$key);
			$param["tradeNum"] 			 = $desUtils->encrypt($param["tradeNum"],$key);
			$param["tradeName"] 		 = $desUtils->encrypt($param["tradeName"],$key);
			$param["tradeDescription"] 	 = $desUtils->encrypt($param["tradeDescription"],$key);
			$param["tradeTime"] 		 = $desUtils->encrypt($param["tradeTime"],$key);
			$param["tradeAmount"] 		 = $desUtils->encrypt($param["tradeAmount"],$key);
			$param["currency"] 			 = $desUtils->encrypt($param["currency"],$key);
			$param["notifyUrl"] 		 = $desUtils->encrypt($param["notifyUrl"],$key);
			$param["successCallbackUrl"] = $desUtils->encrypt($param["successCallbackUrl"],$key);
			$param["failCallbackUrl"] 	 = $desUtils->encrypt($param["failCallbackUrl"],$key);
			
		}
		
		$cbjpaySubmit = new CbjpaySubmit($param);
		$this->url = $cbjpaySubmit->buildRequestForm($param,'POST','submit');
	}

	//发送
	public function send_pay(){
		 echo  $this->url;
		 exit;
	}
}