<?php
class wxpay_web {

	private $config;


	public function config($config=null){
		if (empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'],'Windows Phone') === false ) {
			header('Location: '.WEB_PATH.'/pay/wxpay_web_url/payinfo/nowechat');
			die;
		}
		include_once dirname(__FILE__)."/wxpay/WxPayPubHelper.php";
		if (!$config ) {
			$pay = $this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'wxpay_web'");
			$config = array();
			$config['pay_type_data'] = unserialize($pay['pay_key']);
		}

		
		$jsApi = new JsApi_pub();
		if (!isset($_GET['code'])){
			$url = G_WEB_PATH.'/index.php/pay/wxpay_web_url/?money='.$config['money'].'&out_trade_no='.$config['code'];
			$url = $jsApi->createOauthUrlForCode(urlencode($url),123);
			header("Location: $url");
		}else{

			$jsApi->setCode($_GET['code']);
			$openid = $jsApi->GetOpenid();
			$temp = array();
			$temp['oid'] = $openid;
			$temp['out_trade_no'] = $config['code'];
			$temp['total_fee'] = $config['money']*100;
			$temp['url'] = $config['NotifyUrl'];
			$ps = serialize($temp);
			$a = '$b';
$data =<<<str
<?php
	$a = '$ps';
?>
str;


			file_put_contents('./pay/pay.php',$data);
			header("Location:".G_WEB_PATH.'/pay/demo/js_api_call.php');
		}

	}

}
