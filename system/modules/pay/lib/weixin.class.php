<?php
header("Content-Type:text/html;charset=UTF-8");

include dirname(__FILE__) . DIRECTORY_SEPARATOR . "weixin" . DIRECTORY_SEPARATOR . "WxPayPubHelper.php";

class weixin
{
	private $config;

	public function config($config = null)
	{
		$this->config = $config;
	}

	public function send_pay()
	{
		$unifiedOrder = new UnifiedOrder_pub();
		$amount = trim($this->config['money']) * 100;
		$notify_url = $this->config['NotifyUrl'];
		$unifiedOrder->setParameter("body", $this->config['title']);
		$out_trade_no = $this->config['code'];
		$unifiedOrder->setParameter("out_trade_no", $out_trade_no);
		$unifiedOrder->setParameter("total_fee", $amount);
		$unifiedOrder->setParameter("notify_url", $notify_url);
		$unifiedOrder->setParameter("trade_type", "NATIVE");
		$unifiedOrder->setParameter("attach", "111");
		$unifiedOrderResult = $unifiedOrder->getResult();
		if ($unifiedOrderResult["return_code"] == "FAIL") {
			echo "通信出错：" . $unifiedOrderResult['return_msg'] . "<br>";
		} elseif ($unifiedOrderResult["result_code"] == "FAIL") {
			echo iconv("utf-8", "gb2312//IGNORE", "错误代码：" . $unifiedOrderResult['err_code'] . "<br>");
			echo iconv("utf-8", "gb2312//IGNORE", "错误代码描述：" . $unifiedOrderResult['err_code_des'] . "<br>");
		} elseif ($unifiedOrderResult["code_url"] != NULL) {
			$qrcode = "/system/modules/pay/lib/qrcode.js";
			$code_url = $unifiedOrderResult["code_url"];
			if ($unifiedOrderResult["code_url"] != NULL) {
				$hehe = 'var url = "' . $code_url . '";
				var qr = qrcode(10, "M");
				qr.addData(url);
				qr.make();
				var code=document.createElement("DIV");	
				code.innerHTML = qr.createImgTag();
				var element=document.getElementById("qr_box");
				element.appendChild(code);';
			}
			$def_url = '<html><head>
    <title>微信扫码支付</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <meta name="decorator" content="template_footer" />
    <link rel="stylesheet" type="text/css" href="/statics/templates/yungou/css/weixinpay.css" />
  </head><body><div class="wx_header">
        <div class="wx_logo">
            <img src="/statics/templates/yungou/images/wxlogo_pay.png" alt="微信支付标志" title="微信支付"></div>
    </div>
			<div align="center" id="qrcode"></div>

			<div class="weixin">
			    <div class="weixin2">
			        <b class="wx_box_corner left pngFix"></b><b class="wx_box_corner right pngFix"></b>
			        <div class="wx_box pngFix">
			            <div class="wx_box_area">
			                <div class="pay_box qr_default">
			                    <div class="area_bd">
			                    <span id="qr_box" class="wx_img_wrapper">
			 
			                        <img id="guide" alt="" src="/statics/templates/yungou/images/wxwebpay_guide.png" class="guide pngFix" />
			                    
			                    
			                    </span>
			                    
			                        <div class="msg_default_box"><i class="icon_wx pngFix"></i>
			                            <p>
			                                请使用微信扫描<br />
			                                                                                                        二维码以完成支付
			                            </p>
			                        </div>
			                    
			                        <div class="msg_box"><i class="icon_wx pngFix"></i>
			                            <p><strong>扫描成功</strong>请在手机确认支付</p>
			                        </div>
			                    </div>
			                </div>
			            </div>

				<div class="wx_hd">
				    <div class="wx_hd_img icon_wx"></div>
				</div>
				<div class="wx_money"><span>￥</span>'.$this->config['money'].'元</div>
				<div class="wx_pay">
				    <p><span class="wx_left">支付订单号</span><span class="wx_right">'.$out_trade_no.'</span></p>
				</div>
				
				<div class="wx_kf">
				    <div class="wx_kf_img icon_wx"></div>
				    <div class="wx_kf_wz">
				        <p>工作时间：8:00-24:00</p>
				    </div>
				</div>
			            <div class="wx_hd">
			                <div class="wx_hd_img icon_wx"></div>
			            </div>  
			        </div>
			    </div>
			</div>



			</body><script src="' . $qrcode . '"></script>
			<script>' . $hehe . '</script>
			</html>';
			echo $def_url;
			exit;
		}
	}
}