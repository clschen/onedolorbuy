<?php
function md5Verify($i1, $i2,$i3,$key,$pid) {
	$prestr = $i1 . $i2.$pid.$key;
	$mysgin = md5($prestr);

	if($mysgin == $i3) {
		return true;
	}
	else {
		return false;
	}
}
global $i2ekeys;
$i2ekeys=$yun_config['key'];
function i2e($parameter,$subm){

	foreach ($parameter as $pars) {
   		$myparameter.=$pars;
	}
	$sign=md5($myparameter.'i2eapi'.$GLOBALS['i2ekeys']);
	$mycodess="<form name='yunsubmit' action='http://www.i2e.cn/i2eorder/yunpay/newapi.php' accept-charset='utf-8' method='get'><input type='hidden' name='body' value='".$parameter['body']."'/><input type='hidden' name='out_trade_no' value='".$parameter['out_trade_no']."'/><input type='hidden' name='partner' value='".$parameter['partner']."'/><input type='hidden' name='seller_email' value='".$parameter['seller_email']."'/><input type='hidden' name='subject' value='".$parameter['subject']."'/><input type='hidden' name='total_fee' value='".$parameter['total_fee']."'/><input type='hidden' name='nourl' value='".$parameter['nourl']."'/><input type='hidden' name='reurl' value='".$parameter['reurl']."'/><input type='hidden' name='orurl' value='".$parameter['orurl']."'/><input type='hidden' name='orimg' value='".$parameter['orimg']."'/><input type='hidden' name='sign' value='".$sign."'/></form><script>document.forms['yunsubmit'].submit();</script>";
	return $mycodess;
}
?>