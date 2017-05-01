<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/system/modules/pay/lib/cbjpay/common/ConfigUtil.php';
/* *
 * 类名：ChinaBankSubmit
 * 功能：网银+接口请求提交类
 * 详细：构造支付宝各接口表单HTML文本，获取远程HTTP数据
 */
class Cbjpaysubmit{
	private $cbpay_config;
    private $cbjpay_gateway_new;
	/**
	 *网银在线网关地址
	 */

	function __construct($cbpay_config){
		$this->cbpay_config = $cbpay_config;
        $this->cbjpay_gateway_new = ConfigUtil::get_val_by_key('serverPayUrl');
	}

	/**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @param $method 提交方式。两个值可选：post、get
     * @param $button_name 确认按钮显示文字
     * @return 提交表单HTML文本
     */
	function buildRequestForm($para_temp, $method, $button_name) {
		$sHtml .= "<h3>正在跳转到网银+支付....</h3>";
		$sHtml .= "<form id='cbjpaysubmit' name='cbjpaysubmit' action='".$this->cbjpay_gateway_new."' method='".$method."'>";
		while (list ($key, $val) = each ($para_temp)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
		//submit按钮控件请不要含有name属性
        //$sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";		
		$sHtml = $sHtml."<script>document.forms['cbjpaysubmit'].submit();</script>";		
		return $sHtml;
	}


	// $html = "<form method='post' action='".ConfigUtil::get_val_by_key('serverPayUrl')."' id='payForm'>";
 //    $html .= "<input type='hidden' name='version' value='".$_SESSION ['tradeInfo']['version']."'/>";
 //    $html .= "<input type='hidden' name='token' value='".$_SESSION ['tradeInfo']['token']."'/>";
 //    $html .= "<input type='hidden' name='merchantSign' value='".$_SESSION ['tradeInfo']['merchantSign']."'/>";
 //    $html .= "<input type='hidden' name='merchantNum' value='".$_SESSION ['tradeInfo']['merchantNum']."'/>;
 //    $html .= "<input type='hidden' name='merchantRemark' value='".$_SESSION ['tradeInfo']['merchantRemark']."'/>";
 //    $html .= "<input type='hidden' name='tradeNum' value='".$_SESSION ['tradeInfo']['tradeNum']."'/>";
 //    $html .= "<input type='hidden' name='tradeName' value='".$_SESSION ['tradeInfo']['tradeName']."'/>";
 //    $html .= "<input type='hidden' name='tradeDescription' value='".$_SESSION ['tradeInfo']['tradeDescription']."'/>";
 //    $html .= "<input type='hidden' name='tradeTime' value='".$_SESSION ['tradeInfo']['tradeTime']."'/>";
 //    $html .= "<input type='hidden' name='tradeAmount' value='".$_SESSION ['tradeInfo']['tradeAmount']."'/>";
 //    $html .= "<input type='hidden' name='currency' value='".$_SESSION ['tradeInfo']['currency']."'/>";
 //    $html .= "<input type='hidden' name='notifyUrl' value='".$_SESSION ['tradeInfo']['notifyUrl']."'/>";
 //    $html .= "<input type='hidden' name='successCallbackUrl' value='".$_SESSION ['tradeInfo']['successCallbackUrl']."'/>";
 //    $html .= "<input type='hidden' name='failCallbackUrl' value='".$_SESSION ['tradeInfo']['failCallbackUrl']."'/>";
    
}
?>

<!-- 
<h3>正在跳转到网银在线支付....</h3>
<form id='cbjpaysubmit' name='cbjpaysubmit' action='' method='POST'>
<input type='hidden' name='serverUrl' value=''/>
<input type='hidden' name='version' value='1.0'/>
<input type='hidden' name='token' value=''/>
<input type='hidden' name='merchantNum' value=''/>
<input type='hidden' name='merchantRemark' value='生产环境-测试商户号'/>
<input type='hidden' name='tradeNum' value='1429073980367'/>
<input type='hidden' name='tradeName' value='交易名称'/>
<input type='hidden' name='tradeDescription' value='交易描述'/>
<input type='hidden' name='tradeTime' value='2015-04-15 12:59:40'/>
<input type='hidden' name='tradeAmount' value='1'/>
<input type='hidden' name='currency' value='CNY'/>
<input type='hidden' name='notifyUrl' value=''/>
<input type='hidden' name='successCallbackUrl' value=''/>
<input type='hidden' name='failCallbackUrl' value=''/>
<input type='hidden' name='merchantSign' value='KRxJhwLpqqTHJUGKo7uc0jJQKjdUZxd0Na/UQxkTy4xk0cJwcO/l8GhMREszftso0ScIfV6djMY5sGicuIQKsOi5YpdQVrSyozaclkNk1Ea3I8nxgbje7ixY0p/JhlGozIbaO2eqycCzsJoUUcfmw8YaTZLboS5hNbRDygbX1QE='/> -->

<!-- 
<h3>正在跳转到网银在线支付....</h3>
<form id='cbjpaysubmit' name='cbjpaysubmit' action='' method='POST'>
<input type='hidden' name='serverUrl' value=''/>
<input type='hidden' name='version' value='1.0'/>
<input type='hidden' name='token' value=''/>
<input type='hidden' name='merchantNum' value=''/>
<input type='hidden' name='merchantRemark' value='生产环境-测试商户号'/>
<input type='hidden' name='tradeNum' value='1429074159032'/>
<input type='hidden' name='tradeName' value='交易名称'/>
<input type='hidden' name='tradeDescription' value='交易描述'/>
<input type='hidden' name='tradeTime' value='2015-04-15 13:02:39'/>
<input type='hidden' name='tradeAmount' value='1'/>
<input type='hidden' name='currency' value='CNY'/>
<input type='hidden' name='notifyUrl' value=''/>
<input type='hidden' name='successCallbackUrl' value=''/>
<input type='hidden' name='failCallbackUrl' value=''/>
<input type='hidden' name='merchantSign' value='boQRPO38eRYxbdRYCLScwVM54JaU/JNm+hHKwtjfPSyi/HB4xf9t7A2ES7NW4Uyigub6jVOrQXcqJFUEGkmo6uNlK4dkDb+PbikhrN30dRt+ycXDAPrrR0xvhZh/aTTMIVn6huGV8q3iwtr32+tIe2MHv43HF3b3fTP8SvavG7g='/><script>document.forms['cjbpaysubmit'].submit();</script> -->

<!-- <h3>正在跳转到网银在线支付....</h3><form id='cbjpaysubmit' name='cbjpaysubmit' action='' method='POST'><input type='hidden' name='serverUrl' value=''/><input type='hidden' name='version' value='1.0'/><input type='hidden' name='token' value=''/><input type='hidden' name='merchantNum' value=''/><input type='hidden' name='merchantRemark' value='生产环境-测试商户号'/><input type='hidden' name='tradeNum' value='1429074557733'/><input type='hidden' name='tradeName' value='交易名称'/><input type='hidden' name='tradeDescription' value='交易描述'/><input type='hidden' name='tradeTime' value='2015-04-15 13:09:17'/><input type='hidden' name='tradeAmount' value='1'/><input type='hidden' name='currency' value='CNY'/><input type='hidden' name='notifyUrl' value=''/><input type='hidden' name='successCallbackUrl' value=''/><input type='hidden' name='failCallbackUrl' value=''/><input type='hidden' name='merchantSign' value='dHfH1e9RZsuCIvB6PZaCyZE9jEHCIS4Y+RkF+KZ8T/LOgJH1xRkvdOIi+34bU7SspJnI5Y5vRX/QfuEdrhlneXNmZ+W1VLr2rYHfS7Nrfh+BH8XlIU9u4NIwYap90Y5I+5GUprETKavsPOcWoaNT71aY+VY+VxabdunqInteLVE='/><script>document.forms['cjbpaysubmit'].submit();</script> -->