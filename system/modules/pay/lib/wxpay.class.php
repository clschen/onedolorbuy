<?php
header("Content-Type:text/html;charset=UTF-8");
include dirname(__FILE__) . DIRECTORY_SEPARATOR . "wxpay" . DIRECTORY_SEPARATOR . "WxPayPubHelper.php";

class wxpay
{
	private $config;
	var $parameters;

	public function config($config = null)
	{
		$this->config = $config;
	}

	public function send_pay()
	{
		session_start();
		$_SESSION['NotifyUrl'] = $this->config['NotifyUrl'];
		$_SESSION['paysignkey'] = $this->config['paysignkey'];
		$_SESSION['partnerkey'] = $this->config['partnerkey'];
		$_SESSION['body'] = $this->config['code'];
		$_SESSION['partner'] = $this->config['partner'];
		$_SESSION['totol_fee'] = $this->config['money'];
		$state = $this->config['code'] . '_' . $this->config['money'];
		$jsApi = new JsApi_pub();
		if (!isset($_GET['code'])) {
			$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL, $state);
			Header("Location: $url");
			exit;
		}
	}

	function setParameter($parameter, $parameterValue)
	{
		$this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
	}

	function trimString($value)
	{
		$ret = null;
		if (null != $value) {
			$ret = $value;
			if (strlen($ret) == 0) {
				$ret = null;
			}
		}
		return $ret;
	}

	function create_noncestr($changdugth = 16)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $changdugth; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	function check_cft_parameters()
	{
		if ($this->parameters["bank_type"] == null || $this->parameters["body"] == null || $this->parameters["partner"] == null || $this->parameters["out_trade_no"] == null || $this->parameters["total_fee"] == null || $this->parameters["fee_type"] == null || $this->parameters["notify_url"] == null || $this->parameters["spbill_create_ip"] == null || $this->parameters["input_charset"] == null) {
			return false;
		}
		return true;
	}

	protected function get_cft_package()
	{
		try {
			if (null == $this->parameters['wxpay_partnerkey'] || "" == $this->parameters['wxpay_partnerkey']) {
				throw new Exception("密钥不能为空！" . "<br>");
			}
			ksort($this->parameters);
			$unSignParaString = $this->formatQueryParaMap($this->parameters, false);
			$paraString = $this->formatQueryParaMap($this->parameters, true);
			return $paraString . "&sign=" . $this->sign($unSignParaString, $this->trimString($this->parameters['wxpay_partnerkey']));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	protected function get_biz_sign($bizObj)
	{
		foreach ($bizObj as $k => $v) {
			$bizParameters[strtolower($k)] = $v;
		}
		try {
			if ($this->parameters['wxpay_paysignkey'] == "") {
				throw new Exception("APPKEY为空！" . "<br>");
			}
			$bizParameters["appkey"] = $this->parameters['wxpay_paysignkey'];
			ksort($bizParameters);
			$bizString = $this->formatBizQueryParaMap($bizParameters, false);
			return sha1($bizString);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	function formatQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v) {
			if (null != $v && "null" != $v && "sign" != $k) {
				if ($urlencode) {
					$v = urlencode($v);
				}
				$buff .= $k . "=" . $v . "&";
			}
		}
		$reqPar;
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff) - 1);
		}
		return $reqPar;
	}

	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v) {
			if ($urlencode) {
				$v = urlencode($v);
			}
			$buff .= strtolower($k) . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff) - 1);
		}
		return $reqPar;
	}

	function sign($content, $key)
	{
		try {
			if (null == $key) {
				throw new Exception("财付通签名key不能为空！" . "<br>");
			}
			if (null == $content) {
				throw new Exception("财付通签名内容不能为空" . "<br>");
			}
			$signStr = $content . "&key=" . $key;
			return strtoupper(md5($signStr));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	function verifySignature($content, $sign, $md5Key)
	{
		$signStr = $content . "&key=" . $md5Key;
		$calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
		return $calculateSign == $tenpaySign;
	}

	function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key => $val) {
			if (is_numeric($val)) {
				$xml .= "<" . $key . ">" . $val . "</" . $key . ">";
			} else $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
		}
		$xml .= "</xml>";
		return $xml;
	}

	function create_biz_package()
	{
		try {
			if ($this->check_cft_parameters() == false) {
				throw new Exception("生成package参数缺失！" . "<br>");
			}
			$nativeObj["appId"] = 'wxae86b990f42188ed';
			$nativeObj["package"] = $this->get_cft_package();
			$nativeObj["timeStamp"] = strval(time());
			$nativeObj["nonceStr"] = $this->create_noncestr();
			$nativeObj["paySign"] = $this->get_biz_sign($nativeObj);
			$nativeObj["signType"] = $this->parameters['wxpay_signtype'];
			return json_encode($nativeObj);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


if (isset($_GET['code']) && isset($_GET['state'])) {
	$jsApi = new JsApi_pub();
	$state = $_GET['state'];
	$lines = array();
	$lines = explode("_", $state);
	$out_trade_no = $lines[0];
	$totol_fee = $lines[1];
	$code = $_GET['code'];
	$jsApi->setCode($code);
	$openid = $jsApi->getOpenId();
	$unifiedOrder = new UnifiedOrder_pub();
	$unifiedOrder->setParameter("openid", $openid);
	$unifiedOrder->setParameter("body", $out_trade_no);
	$unifiedOrder->setParameter("out_trade_no", $out_trade_no);
	$NotifyUrl = WxPayConf_pub::NOTIFY_URL;
	$unifiedOrder->setParameter("total_fee", $totol_fee * 100);
	$unifiedOrder->setParameter("notify_url", $NotifyUrl);
	$unifiedOrder->setParameter("trade_type", "JSAPI");
	$prepay_id = $unifiedOrder->getPrepayId();
	$jsApi->setPrepayId($prepay_id);
	$jsApiParameters = $jsApi->getParameters(); 
}

	


	include('shouji.php');
	ob_end_flush();
	exit;
}