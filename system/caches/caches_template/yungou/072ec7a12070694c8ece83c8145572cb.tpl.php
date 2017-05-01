<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>

<!DOCTYPE html>
<html>
<head><title>
	帐户充值 - <?php echo $webname; ?>触屏版
</title>
<meta content="app-id=518966501" name="apple-itunes-app" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" />
      <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/login.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" />
<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/recharge.js" language="javascript" type="text/javascript"></script>
</head>
<body style="background: #fff;">
<div class="h5-1yyg-v1" id="loadingPicBlock">

<!-- 栏目页面顶部 -->

<header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
                账户充值
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

    <div class="fr head-r" style="position: absolute;right: 0px;top: 9px;">

        <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
    -->
    <a href="<?php echo WEB_PATH; ?>/mobile/home/userbalance" class="z-RCornerBtn" style="color: #fff;background: none;font-size: 14px;">帐户明细</a>

</div>

</header>

    <div class="g-Total gray9" style="padding-top: 55px;">您的当前余额：<span class="orange arial"><?php echo $member['money']; ?></span>元</div>
 <div>
    
            <!--section>
                <div class="registerCon">
                    <form action="<?php echo WEB_PATH; ?>/member/cart/card_addmoney" method="post">
                        <ul>
                            <li class="accAndPwd">
                                <dl><input id="txtAccount" type="text" placeholder="请输入卡号" class="lEmail" name="czknum" maxlength="20"><s class="rs4"></s></dl>
                                <dl>
                                    <input type="password" id="txtPassword" class="lPwd" placeholder="请输入卡密" name="password" maxlength="20">
                                    <s class="rs3"></s>
                                </dl>
                            </li>
                            <li><input type="submit" value=" 确认充值" /></li>
                    </form>
                    <li class="rSelect" style="width: 40%;">淘宝充值卡购买</li>
                    <li class="rSelect" style="width: 80%;"> 
                        <a href="http://item.taobao.com" hidefocus="true" target="_blank">1元充值卡购买</a> | 
                        <a href="http://item.taobao.com" hidefocus="true" target="_blank">10元充值卡购买</a>
                    </li><li class="rSelect" style="width: 80%;">
                        <a href="http://item.taobao.com" hidefocus="true" target="_blank">50元充值卡购买</a>  | 
                        <a href="http://item.taobao.com" hidefocus="true" target="_blank">100元充值卡购买</a>  
                    </li><li class="rSelect" style="width: 80%;">
                        <a href="http://item.taobao.com" hidefocus="true" target="_blank">500元充值卡购买</a></li>
                    </ul>
                </div>
            </section-->
     
     
    <section class="clearfix g-member">
        <div class="g-Recharge">
	        <ul id="ulOption">
		        <li money="10"><a href="javascript:;" class="z-sel">10元<s></s></a></li>
		        <li money="20"><a href="javascript:;">20元<s></s></a></li>
		        <li money="30"><a href="javascript:;">30元<s></s></a></li>
		        <li money="100"><a href="javascript:;">100元<s></s></a></li>
		        <li money="200"><a href="javascript:;">200元<s></s></a></li>
		        <li>
		            <b>
		                <input type="text" class="z-init" placeholder="输入金额" maxlength="8" />
		                <s></s>
		            </b>
		        </li>
	        </ul>
	    </div>
            <style>
                #zhifubao i, #weixin i, #yinlian i{
                    float: right;
                    margin-right: 10px;
                    margin-top: 17px;

                }
                .tishi .p1{font-size: 14px;color: #333;}
                .tishi .p2{font-size: 12px;color: #999;}
                .tishi{
                    line-height: 14px;
                    margin-top: 12px;
                    margin-left: 40px;
                    width: 70%;
                    float: left;
                    overflow: hidden;
                }
                .z-bank-Round{
                    box-shadow: none;
                }
                .z-bank-Roundsel{
                    border: 1px solid #22AAFF;
                }
                #zhifubao{
                    background: url(<?php echo G_WEB_PATH; ?>//statics/templates/yungou/images/mobile/zhifubao.png) 10px 10px no-repeat;
                    background-size: 30px auto;
                    max-height: 50px;
                    height: 50px;
                }
                #weixin{
                    background: url(<?php echo G_WEB_PATH; ?>//statics/templates/yungou/images/mobile/weixin.png) 10px 10px no-repeat;
                    background-size: 30px auto;
                    max-height: 50px;
                    height: 50px;
                }
                #yinlian{
                    background: url(<?php echo G_WEB_PATH; ?>//statics/templates/yungou/images/mobile/yinlian.png) 8px 9px no-repeat;
                    background-size: 35px auto;
                    max-height: 50px;
                    height: 50px;
                }
            </style>
	     <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
	        <ul id="ulBankList">
			     <li class="gray6"  style="height:36px;">选择平台充值<em class="orange">10.00</em>元</li>
			<?php $ln=1;if(is_array($paylist)) foreach($paylist AS $pay): ?>
			     <li class="gray9" urm="<?php echo $pay['pay_id']; ?>">
			         <i class="z-bank-Round"><s></s></i><?php echo $pay['pay_name']; ?><!-- CMBCHINA-WAP -->
			     </li>
			<?php  endforeach; $ln++; unset($ln); ?>
			    <!-- <li class="gray9" data-urm="ICBC-WAP"><i class="z-bank-Round"><s></s></i>工商银行</li>ICBC-WAP
			    <li class="gray9" data-urm="CCB-WAP"><i class="z-bank-Round"><s></s></i>建设银行</li>CCB-WAP -->
		    </ul>
	    </article>
	    <div class="mt10 f-Recharge-btn">
		    <a id="btnSubmit" href="javascript:;" class="orgBtn">确认充值</a>
	    </div>
    </section>

<?php include templates("mobile/index","footer");?>

<script language="javascript" type="text/javascript">
    var Path = new Object();
    Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";
    Path.Webpath = "<?php echo WEB_PATH; ?>";

    var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
    function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
    Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());
</script>

</div>
    </div>
</body>
</html>
