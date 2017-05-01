<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>邀请管理 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/invite.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/ShareListFun.js" language="javascript" type="text/javascript"></script>
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/BottomFun.js" language="javascript" type="text/javascript"></script>
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jweixin.js" language="javascript" type="text/javascript"></script>
</head>
<body style="background: #f4f4f4;">
<div class="h5-1yyg-v11">
    
<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

    <header class="header" style="position: fixed;width: 100%;z-index: 9;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
                邀请管理
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
    <a href="<?php echo WEB_PATH; ?>/mobile/home" class="z-shop" style="background-position: 2px -73px;"></a>

</div>

</header>
    <section class="clearfix g-member" style="padding-top: 60px;">
        <div class="clearfix m-round m-name">
			<div class="fl f-Himg" style="padding-top: 5px;">
                
				<a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $member['uid']; ?>" class="z-Himg">
                <?php 
                    $touxiang = get_user_key($member['uid'],'img')
                 ?>
					<img style="border-radius: 110px;" src="
                    <?php if($touxiang !='photo/member.jpg'): ?>
                        <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiang; ?>
                    <?php elseif ($member['headimg'] !=''): ?>
                        <?php echo $member['headimg']; ?>
                    <?php  else: ?>
                        <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiang; ?>
                    <?php endif; ?>" border=0>
				</a>
        

				<span class="<?php if($member['yungoudj']=='云购新手'): ?>
                    z-class-icon01
                <?php elseif ($member['yungoudj']=='云购小将'): ?>
                    z-class-icon02
                <?php elseif ($member['yungoudj']=='云购中将'): ?>
                    z-class-icon03
                <?php elseif ($member['yungoudj']=='云购上将'): ?>
                    z-class-icon04
                <?php elseif ($member['yungoudj']=='云购大将'): ?>
                    z-class-icon05
                <?php elseif ($member['yungoudj']=='云购将军'): ?>
                    z-class-icon06
                <?php endif; ?> gray02">
					<s></s>
					<?php echo $member['yungoudj']; ?>
				</span>
			</div>
			<div class="m-name-info">
				<p class="u-name"> 
				<b class="z-name gray01">
				<?php echo get_user_name($member['uid']); ?>
				</b>
					<?php if($member['mobile']): ?> 
					<em>
					(<?php echo $member['mobile']; ?>)
					</em>
					<?php  else: ?> 
					<em>
					<a href="<?php echo WEB_PATH; ?>/mobile/user/mobile" class="fr z-Recharge-btn" style="line-height:24px; margin-right:5px; margin-top:3px;">
					绑定手机
					</a>
					</em> 
					<?php endif; ?>
					<?php if($member['username']): ?>
					<em></em>
					<?php  else: ?> 
					<em>
					<a href="<?php echo WEB_PATH; ?>/mobile/user/profile" class="fr z-Recharge-btn" style="line-height:24px; margin-right:5px; margin-top:3px;">
					绑定昵称
					</a>
					</em> 
					<?php endif; ?>
					
				</p>
				<ul class="clearfix u-mbr-info">
					<li>
						可用积分
						<span class="orange"><?php echo $member['score']; ?></span>
					</li>
					<li>
						经验值
						<span class="orange"><?php echo $member['jingyan']; ?></span>
					</li>
					<li>
						可用余额
						<span class="orange">￥<?php echo $member['money']; ?></span>
						<a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="fr z-Recharge-btn">去充值</a>
					</li>
				</ul>
			</div>
		</div>
        <div class="shareCon m-round">
               <div class="m_banner"></div>
               <dl>
                     <dt>邀请好友成功参与云购后，即可获得高额佣金！</dt>
                       <dd><a style="background: #22AAFF;color:#fff;" id="btnShare" href="javascript:;" class="orangeBtn">立即赚钱</a></dd>  
               </dl>
           </div>
	<div class="m-round m-member-nav">
		    <ul id="ulFun">
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/friends"><b class="z-arrow xz"></b>邀请好友</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/commissions"><b class="z-arrow xz"></b>佣金明细</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/cashout"><b class="z-arrow xz"></b>申请提现</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/record"><b class="z-arrow xz"></b>提现记录</a></li>
                <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/mycode"><b class="z-arrow xz"></b>我的专属二维码</a></li>
		    </ul>
	    </div>
    </section>
    <!-- 弹出窗口 S-->
    <div class="m_popUp" id="m_popUp" style="display: none;">
                <div class="m_guide">
                    <span></span>
                    <div class="m_how">
                        <h4>怎么赚钱？</h4>
                        <p>1: 点击本页面右上角的三个点的图标</p>
                        <p>2: 选择[发送给朋友]或[分享到朋友圈]</p>
                        <p>3: 经您邀请的好友，成功参与云购后，您可获得好友消费额6%的佣金奖励</p>
                    </div>
                </div>
 </div>
<!-- 弹出窗口E -->
<input name="hidLineLink" type="hidden" id="hidLineLink" value="<?php echo WEB_PATH; ?>/mobile/user/register/<?php echo $uid; ?>" />
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
</script>
<script>
  wx.config({
    debug: false,
    appId: "<?php  echo $wechat['appid']; ?>",
    timestamp: <?php  echo $signPackage["timestamp"]; ?>,
    nonceStr: '<?php  echo $signPackage["nonceStr"]; ?>',
    signature: '<?php  echo $signPackage["signature"]; ?>',
  jsApiList: ["checkJsApi", "onMenuShareAppMessage", "onMenuShareTimeline", "onMenuShareWeibo", "onMenuShareQQ"]
  });
wx.ready(function () {
var n = $("#hidLineLink").val();
    wx.onMenuShareTimeline({
        title: "梦想还是要有的,万一实现了呢?", // 分享标题
        link: n, // 分享链接
        imgUrl: "<?php echo G_TEMPLATES_STYLE; ?>/images/mobile/app.png", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
    wx.onMenuShareAppMessage({
        title: "梦想还是要有的,万一实现了呢?", // 分享标题
        desc: "以前我们等待惊喜，现在我们发现惊喜就在这里！实现你的小梦想", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_TEMPLATES_STYLE; ?>/images/mobile/app.png", // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
         success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
    wx.onMenuShareQQ({
        title: "梦想还是要有的,万一实现了呢?", // 分享标题
        desc: "以前我们等待惊喜，现在我们发现惊喜就在这里！实现你的小梦想", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_TEMPLATES_STYLE; ?>/images/mobile/app.png", // 分享图标
        success: function () { 
           // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
           // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareWeibo({
        title: "梦想还是要有的,万一实现了呢?", // 分享标题
        desc: "以前我们等待惊喜，现在我们发现惊喜就在这里！实现你的小梦想", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_TEMPLATES_STYLE; ?>/images/mobile/app.png", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
});
</script>
</div>
</body>
</html>
