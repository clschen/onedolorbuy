<?php
class JSSDK
{
	private $appId;
	private $appSecret;

	public function __construct($appId, $appSecret)
	{
		$this->appId = $appId;
		$this->appSecret = $appSecret;
	}

	public function getSignPackage()
	{
		$jsapiTicket = $this->getJsApiTicket();
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$timestamp = time();
		$nonceStr = $this->createNonceStr();
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
		$signature = sha1($string);
		$signPackage = array("appId" => $this->appId, "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "signature" => $signature, "rawString" => $string);
		return $signPackage;
	}

	private function createNonceStr($length = 16)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	private function getJsApiTicket(){
		$accessToken = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
		$res = json_decode($this->httpGet($url));
		$ticket = $res->ticket;
		return $ticket;
	}

	private function getAccessToken(){
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
		$res = json_decode($this->httpGet($url));
		$access_token = $res->access_token;
		return $access_token;
	}

	private function httpGet($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
}