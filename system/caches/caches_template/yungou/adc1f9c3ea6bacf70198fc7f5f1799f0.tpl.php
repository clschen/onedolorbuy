<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>结算支付 - <?php echo $webname; ?>触屏版</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/cartList.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Payment.js" language="javascript" type="text/javascript"></script>
</head>
<body style="background: #fff;">
<div class="h5-1yyg-v1">
    
<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

    <header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
                结算支付
            </a>
        </span>

        <!--<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"/>
        -->
        <!--<img src="/statics/templates/yungou/images/sjlogo.png"/>
        -->
    </h1>

    <a id="fanhui" class="cefenlei" onclick="history.go(-1)" href="javascript:;">
        
        <img width="30" height="30" src="/statics/templates/yungou/images/mobile/fanhui.png">
    </a>

    <div class="fr head-r" style="position: absolute;right: 6px;top: 10px;">

        <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
    -->
    <a href="<?php echo WEB_PATH; ?>/mobile/mobile" class="z-shop" style="background-position: -5px 0px;"></a>

</div>

</header>

    <input name="hidShopMoney" type="hidden" id="hidShopMoney" value="<?php echo $MoenyCount; ?>" />
    <input name="hidBalance" type="hidden" id="hidBalance" value="<?php echo $Money; ?>" />
    <input name="hidPoints" type="hidden" id="hidPoints" value="<?php echo $member['score']; ?>" />
    <input name="shopnum" type="hidden" id="shopnum" value="<?php echo $shopnum; ?>" />
    <input name="pointsbl" type="hidden" id="pointsbl" value="<?php echo $fufen_dikou; ?>" />
    <section class="clearfix g-pay-lst"  style="padding-top:60px;">
    	<div style="border-radius: 5px;border: 1px solid #dcdcdc;margin-left: 10px;margin-right: 10px;margin-bottom: 10px;background: #fff;margin-bottom: 250px;">
		<ul>
		 <?php $ln=1; if(is_array($shoplist)) foreach($shoplist AS $key => $val): ?>
		  
			<li>
			    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $val['id']; ?>" class="gray6" style="line-height: 22px;">(第<?php echo $val['qishu']; ?>期)<?php echo $val['title']; ?>  (<?php echo $val['title2']; ?>)</a>
			    <span>
			        <em class="orange arial"><?php echo $val['cart_xiaoji']; ?></em>人次
			    </span>
			</li>
		 <?php  endforeach; $ln++; unset($ln); ?>
		
		</ul>
		<p class="g-pay-Total gray9">合计：<span class="orange arial Fb F16"><?php echo $MoenyCount; ?></span> 元</p>
		<!--<p class="g-pay-bline"></p>-->
		</div>
    </section>
    <section class="clearfix g-Cart" style="padding-bottom:10px;background: #fff;position:fixed;bottom: 0px;width: 100%;left: 0px;padding-top: 0px;">
    <div style="margin: 10px 10px 0px 10px;">
	    <article class="clearfix m-round g-pay-ment" style="border: 1px solid #dcdcdc;border-radius: 5px;box-shadow:1px 1px 1px #e7e7e7;overflow: hidden;">
		    <ul id="ulPayway">
			<?php if($fufen_dikou >= $MoenyCount): ?>
			    <li class="gray9 z-pay-ff z-pay-grayC" style="height: 40px;">
				<i id="spPoints" class="z-pay-ment" sel="0"></i>
				<span>您可以使用积分付款（您的积分：<?php echo $member['score']; ?>）</span>
				</li>
			<?php  else: ?>
			     <li class="gray6 z-pay-ff z-pay-grayC" style="height: 40px;">
				<span>您的积分不足（您的积分：<?php echo $member['score']; ?>）</span>
				</li>
			<?php endif; ?>
			
			<?php if($Money >= $MoenyCount): ?>			
				<li class="gray9 z-pay-ye z-pay-grayC"  style="height: 40px;"> 
				<i id="spBalance" class="z-pay-ment" sel="0"></i>
				<span>您可以使用余额付款（账户余额：<?php echo $Money; ?> 元）</span>
				</li>
			<?php  else: ?>
			    <li class="gray6 z-pay-ye z-pay-grayC" style="height: 40px;">
				<a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="z-pay-Recharge">去充值</a>
				<span>您的余额不足（账户余额：<?php echo $Money; ?> 元）</span>
				</li> 
			<?php endif; ?>
		    </ul>
	    </article>
	     <article id="bankList" class="clearfix mt10 m-round g-pay-ment g-bank-ct">
		    <ul>	
		    	<li class="gray6 z-pay-grayC" style="height:41px;"><s class="z-arrow"></s>选择支付方式支付</li> 
		    	<?php $ln=1;if(is_array($paylist)) foreach($paylist AS $pay): ?>
		    	<li class="gray9" urm="<?php echo $pay['pay_id']; ?>"><i class="z-bank-Round"><s></s></i> <?php echo $pay['pay_name']; ?></li>
		    	 <?php  endforeach; $ln++; unset($ln); ?>

		</ul>
	    </article>
	    <div style="margin-top: 10px;">
		    <a style="height: 45px;line-height: 45px;" id="btnPay" href="javascript:;" class="orgBtn">确认支付</a>
	    </div>
	</div>
    </section>
    
<script language="javascript" type="text/javascript">
var Path = new Object();
Path.Skin = "<?php echo G_WEB_PATH; ?>/statics/templates/yungou";
Path.Webpath = "<?php echo WEB_PATH; ?>";
Path.submitcode = '<?php echo $submitcode; ?>';

var Base = {
    head: document.getElementsByTagName("head")[0] || document.documentElement,
    Myload: function(B, A) {
        this.done = false;
        B.onload = B.onreadystatechange = function() {
            if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                this.done = true;
                A();
                B.onload = B.onreadystatechange = null;
                if (this.head && B.parentNode) {
                    this.head.removeChild(B)
                }
            }
        }
    },
    getScript: function(A, C) {
        var B = function() {};
        if (C != undefined) {
            B = C
        }
        var D = document.createElement("script");
        D.setAttribute("language", "javascript");
        D.setAttribute("type", "text/javascript");
        D.setAttribute("src", A);
        this.head.appendChild(D);
        this.Myload(D, B)
    },
    getStyle: function(A, B) {
        var B = function() {};
        if (callBack != undefined) {
            B = callBack
        }
        var C = document.createElement("link");
        C.setAttribute("type", "text/css");
        C.setAttribute("rel", "stylesheet");
        C.setAttribute("href", A);
        this.head.appendChild(C);
        this.Myload(C, B)
    }
}

function GetVerNum() {
    var D = new Date();
    return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1))
}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v=' + GetVerNum());
</script>
</div>
</body>
</html>