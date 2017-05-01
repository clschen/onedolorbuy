<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
	<?php echo $key; ?>
</title><meta content="app-id=518966501" name="apple-itunes-app" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" /><meta content="yes" name="apple-mobile-web-app-capable" /><meta content="black" name="apple-mobile-web-app-status-bar-style" /><meta content="telephone=no" name="format-detection" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=20150129" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/goods.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css" rel="stylesheet" type="text/css" />
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
<?php if($shopitem=='itemfun'): ?>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/goodsInfo.js" language="javascript" type="text/javascript"></script>
<?php  else: ?>
<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/LotteryDetail.js" language="javascript" type="text/javascript"></script>
<?php endif; ?>
</head>
<body>
<div class="h5-1yyg-v1" id="loadingPicBlock">

<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

<?php include templates("mobile/index","top");?>
<!-- 内页顶部 -->

    <input name="hidGoodsID" type="hidden" id="hidGoodsID" value="<?php if($itemlist): ?><?php echo $itemlist['0']['q_uid']; ?><?php endif; ?>"/>   <!--上期获奖者id-->
    <input name="hidCodeID" type="hidden" id="hidCodeID" value="<?php echo $item['id']; ?>"/>     <!--本期奖品id-->
    <section class="goodsCon pCon">
	    <!-- 导航 -->
        <div id="divPeriod" class="pNav">
            <div class="loading"><b></b>正在加载</div>
    	    <ul class="slides">
    	       <?php echo $loopqishu; ?>
            </ul>
        </div>

		<?php 
            $sysj=$item['xsjx_time']-time();
         ?>


        <!-- 揭晓信息 -->
        <?php if($item['q_end_time']!='' && $item['q_end_time'] <= time()): ?>
        <div class="pProcess pProcess2">
    	    <div class="pResults">
        	    <div class="pResultsL" onclick="location.href='<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $item['q_uid']; ?>'">
            	    <a>
            	        <img src="<?php if($zjtx['img'] !='photo/member.jpg'): ?>
                            <?php echo G_UPLOAD_PATH; ?>/<?php echo $zjtx['img']; ?>
                        <?php elseif ($zjtx['headimg'] !=''): ?>
                            <?php echo $zjtx['headimg']; ?>
                        <?php  else: ?>
                            <?php echo G_UPLOAD_PATH; ?>/<?php echo $zjtx['img']; ?>
                        <?php endif; ?>">
            	        <span><?php echo get_user_name($item['q_uid']); ?></span>
            	    </a>
                    <s></s>
                </div>
        	    <div class="pResultsR">
                    <div class="g-snav">
                        <div class="g-snav-lst">总共购买<br><dd><b class="orange"><?php echo $gorecode['gonumber']; ?></b><br>人次</dd></div>
                        <div class="g-snav-lst">揭晓时间<br><dd class="gray9"><span><?php echo str_replace(' ','<br>',microt($item['q_end_time'])); ?></span></dd></div>
                        <div class="g-snav-lst">购买时间<br><dd class="gray9"><span><?php echo str_replace(' ','<br>',microt($gorecode['time'])); ?></span></dd></div>
                    </div>
                </div>
        	    <p><a href="<?php echo WEB_PATH; ?>/mobile/mobile/calResult/<?php echo $item['id']; ?>" class="fr">查看计算结果</a>幸运码：<b class="orange"><?php echo $item['q_user_code']; ?></b></p>
            </div>
        </div>
        <input name="hidLineLink" type="hidden" id="hidLineLink" value="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $item['id']; ?>" />
<script>
  wx.config({
    debug: false,
    appId: "<?php  echo $wechat['appid']; ?>",
    timestamp: "<?php  echo $signPackage['timestamp']; ?>",
    nonceStr: '<?php  echo $signPackage["nonceStr"]; ?>',
    signature: '<?php  echo $signPackage["signature"]; ?>',
  jsApiList: ["checkJsApi", "onMenuShareAppMessage", "onMenuShareTimeline", "onMenuShareWeibo", "onMenuShareQQ"]
  });
wx.ready(function () {
var n = $("#hidLineLink").val();
    wx.onMenuShareTimeline({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
    wx.onMenuShareAppMessage({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "别人<?php echo $gorecode['gonumber']; ?>元中了<?php echo $item['title']; ?>,羡慕嫉妒恨...", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
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
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "别人<?php echo $gorecode['gonumber']; ?>元中了<?php echo $item['title']; ?>,羡慕嫉妒恨...", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
           // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareWeibo({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "别人<?php echo $gorecode['gonumber']; ?>元中了<?php echo $item['title']; ?>,羡慕嫉妒恨...", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
});
</script>
        <?php endif; ?>

		<!-- 揭晓倒计时 -->
		<?php if(( $item['q_end_time']!='' && $item['q_end_time'] > time() ) ): ?>
			<div id="divLotteryTime" class="pProcess clearfix" data-id="<?php echo $item['id']; ?>" data-endtime="<?php echo ceil($item['q_end_time']-time()); ?>">
				<div class="pCountdown">
					<div class="g-snav">
						<div class="g-snav-lst">揭晓<br>倒计时<s></s></div>
						<div class="g-snav-lst"><b class="minute">99</b><em>分</em></div>
						<div class="g-snav-lst"><b class="second">99</b><em>秒</em></div>
						<div class="g-snav-lst"><b class="millisecond">99</b><em>毫秒</em></div>
					</div>
				</div>
			</div>
            <input name="hidLineLink" type="hidden" id="hidLineLink" value="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $item['id']; ?>" />
<script>
  wx.config({
    debug: false,
    appId: "<?php  echo $wechat['appid']; ?>",
    timestamp: "<?php  echo $signPackage['timestamp']; ?>",
    nonceStr: '<?php  echo $signPackage["nonceStr"]; ?>',
    signature: '<?php  echo $signPackage["signature"]; ?>',
  jsApiList: ["checkJsApi", "onMenuShareAppMessage", "onMenuShareTimeline", "onMenuShareWeibo", "onMenuShareQQ"]
  });
wx.ready(function () {
var n = $("#hidLineLink").val();
    wx.onMenuShareTimeline({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        link: n, // 分享链接
        //imgUrl: "<?php echo G_TEMPLATES_STYLE; ?>/images/mobile/app.png", // 分享图标
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
    wx.onMenuShareAppMessage({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "正在为您揭晓最新一期[<?php echo $item['title']; ?>],快来看谁是幸运者！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
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
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "正在为您揭晓最新一期[<?php echo $item['title']; ?>],快来看谁是幸运者！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
           // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareWeibo({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "正在为您揭晓最新一期[<?php echo $item['title']; ?>],快来看谁是幸运者！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
});
</script>
        <?php endif; ?>

        <!-- 产品图 -->
        <div class="pPic pPicBor">
            <div class="pPic2">
    	        <div id="sliderBox" class="pImg">
                    <div class="loading"><b></b>正在加载</div>
                    <ul class="slides">
					<?php $ln=1;if(is_array($item['picarr'])) foreach($item['picarr'] AS $imgtu): ?>
					<li><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $imgtu; ?>" class="animClass" /></li>
					<?php  endforeach; $ln++; unset($ln); ?>
                    </ul>
                </div>
            </div>
			<?php if($item['q_end_time']=='' && $item['xsjx_time']!=0): ?>
            <span id="spAutoFlag" class="z-limit-tips">限时揭晓</span>
			 <?php endif; ?>
        </div>

        <!-- 条码信息 -->


        <div class="pDetails <?php if($item['q_end_time']!=''): ?>pDetails-end<?php endif; ?>">
                <b>(第<?php echo $item['qishu']; ?>期)<?php echo $item['title']; ?> <span></span></b>
                <p class="price">价值：<em class="arial gray">￥<?php echo $item['money']; ?></em></p>

			<?php if(empty($item['q_end_time'])): ?>
				<div class="Progress-bar">
					<p class="u-progress" title="已完成<?php echo percent($item['canyurenshu'],$item['zongrenshu']); ?>">
						<span class="pgbar" style="width:<?php echo $item['canyurenshu']/$item['zongrenshu']*100; ?>%;">
							<span class="pging"></span>
						</span>
					</p>
					<ul class="Pro-bar-li">
						<li class="P-bar01"><em><?php echo $item['canyurenshu']; ?></em>已参与</li>
						<li class="P-bar02"><em><?php echo $item['zongrenshu']; ?></em>总需人次</li>
						<li class="P-bar03"><em><?php echo $item['zongrenshu']-$item['canyurenshu']; ?></em>剩余</li>
					</ul>
				</div>
                <input name="hidLineLink" type="hidden" id="hidLineLink" value="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $item['id']; ?>" />
<script>
  wx.config({
    debug: false,
    appId: "<?php  echo $wechat['appid']; ?>",
    timestamp: "<?php  echo $signPackage['timestamp']; ?>",
    nonceStr: '<?php  echo $signPackage["nonceStr"]; ?>',
    signature: '<?php  echo $signPackage["signature"]; ?>',
  jsApiList: ["checkJsApi", "onMenuShareAppMessage", "onMenuShareTimeline", "onMenuShareWeibo", "onMenuShareQQ"]
  });
wx.ready(function () {
var n = $("#hidLineLink").val();
    wx.onMenuShareTimeline({
        title: "梦想还是要有的,万一实现了呢?", // 分享标题
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
    wx.onMenuShareAppMessage({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "最新一期【<?php echo $item['title']; ?>】招募进行中!强势插入！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
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
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "最新一期【<?php echo $item['title']; ?>】招募进行中!强势插入！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
           // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareWeibo({
        title: "分享一份来自\"夺宝乐吧\"的幸运礼物", // 分享标题
        desc: "最新一期【<?php echo $item['title']; ?>】招募进行中!强势插入！", // 分享描述
        link: n, // 分享链接
        imgUrl: "<?php echo G_UPLOAD_PATH; ?>/<?php echo $item['thumb']; ?>", // 分享图标
        success: function () { 
           alert('已分享');
        },
        cancel: function () { 
            alert('已取消');
        }
    });
});
</script>
			<?php endif; ?>
			<?php if($item['q_end_time'] !=''): ?>
				<?php if($item['q_end_time'] > time() ): ?>
				  <div class="pClosed">正在揭晓</div>
				<?php  else: ?>
				  <div class="pClosed">本期已揭晓</div>
				<?php endif; ?>
				<?php if($itemxq==1): ?>
				<div class="pOngoing" codeid="<?php echo $itemzx['id']; ?>"><div class="jiexiao" style="line-height: 35px;margin-left: 1%;width: 89%;height: 35px;">第<?php echo $itemzx['qishu']; ?>期(正在进行中……)</div><a  style="margin:0;width: 10%;height: 33px;" class="xiangxigw" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist"><i  style="margin: 6px auto;float: none;position: relative;" id="btnCart" class="<?php echo $f_car; ?>">&nbsp;</i></a></div>
				<?php endif; ?>
           	<?php elseif ($item['zongrenshu']==$item['canyurenshu']): ?>
			  <?php if($item['xsjx_time']!=0): ?>
               <div id="divAutoRTime" class="pSurplus" time="<?php echo $sysj; ?>" timeAlt="<?php echo date('Y-m-d-H',$item['xsjx_time']); ?>"><p><span>限时揭晓</span>剩余时间：<em>00</em>时<em>00</em>分<em>00</em>秒</p></div>
			   <?php endif; ?>
               <div class="pClosed">下手慢了！！ 被抢光啦！！</div>
		    <?php  else: ?>
               <?php if($item['xsjx_time']!=0): ?>
			  <div id="divAutoRTime" class="pSurplus" time="<?php echo $sysj; ?>" timeAlt="<?php echo date('Y-m-d-H',$item['xsjx_time']); ?>"><p><span>限时揭晓</span>剩余时间：<em>00</em>时<em>00</em>分<em>00</em>秒</p></div>
			  <?php endif; ?>
              <div id="btnBuyBox" class="pBtn" codeid="<?php echo $item['id']; ?>">
				<a style="width: 43%;margin-right: 2%;margin-left: 1%;" href="javascript:;" class="fl buyBtn">立即夺宝</a>
				<a style="width: 42%;" href="javascript:;" class="fl addBtn">加入购物车</a>
                
                <a style="margin:0;width: 10%;height: 33px;" class="xiangxigw" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist"><i style="margin: 6px auto;float: none;position: relative;" id="btnCart" class="<?php echo $f_car; ?>">&nbsp;</i></a>
                
			  </div>
			<?php endif; ?>
        </div>
        <!-- 参与记录，奖品详细，晒单导航 -->
        <div class="joinAndGet">
    	    <dl>
    	        

				<a href="<?php echo WEB_PATH; ?>/mobile/mobile/goodspost/<?php echo $item['sid']; ?>"><b class="fr z-arrow"></b>已有<span class="orange arial"><?php echo count($shaidan); ?></span>个幸运者晒单<strong class="orange arial"><?php echo $sum; ?></strong>条评论</a>
                                                    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/goodsdesc/<?php echo $item['id']; ?>"><b class="fr z-arrow"></b>图文详情<em>（建议WIFI下使用）</em> </a>
				<a style="border-color: #efefef;box-shadow:0px 0px 0px #e7e7e7;" href="<?php echo WEB_PATH; ?>/mobile/mobile/buyrecords/<?php echo $item['id']; ?>"><b class="fr z-arrow jilu"></b>所有夺宝记录</a>
            </dl>
        <!-- 上期获得者 
		<?php if($item['q_end_time'] !=''): ?>
			<?php if(( $item['q_end_time']!='' && $item['q_end_time'] > time() ) ): ?>
			<?php  else: ?>
				<ul id="prevPeriod" class="m-round" codeid="<?php echo $gorecode['shopid']; ?>" uweb="<?php echo $gorecode['uid']; ?>">
        	    <li class="fl"><s></s><img src="<?php echo G_TEMPLATES_IMAGE; ?>/mobile/loading.gif" src2="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($itemlist[0]['q_uid'],'img'); ?>"/></li>
                <li class="fr"><b class="z-arrow"></b></li>
                <li class="getInfo">
            	    <dd>
					<em class="blue"><?php echo get_user_name($itemlist[0]['q_uid']); ?></em>(<?php echo get_ip($gorecode['id'],'ipcity'); ?>) 
					</dd>
                    <dd>总共购买：<em class="orange arial"><?php echo $gorecode['gonumber']; ?></em>人次</dd>
                    <dd>幸运购买码：<em class="orange arial"><?php echo $gorecode['huode']; ?></em></dd>
                    <dd>揭晓时间：<?php echo microt($itemlist[0]['q_end_time']); ?></dd>								   
                    <dd>购买时间：<?php echo microt($gorecode['time']); ?></dd>
                </li>
            </ul>
			 <?php endif; ?>
			<?php endif; ?>
        -->
        </div>
                <div id="divRecordList" class="recordCon z-minheight" style="display:block; height:auto;margin-top: 0px;border-left: none;min-height: 0px;">
                <div class="goodsList" style="clear: both;overflow:visible;">
                    <div id="divGoodsLoading" class="loading" style="display:none;height: 80px;">
                    </div>
                </div>
                </div> 

                    <a id="btnLoadMore" class="loading" href="javascript:;" style="display:none;color: #999;border: none!important;margin-top: -1px;position: relative;top: -1px;"> <i style="position: relative;" class="jiazai"></i> 正在加载...
                    </a>
                    <a id="btnLoadMore2" class="loading" style="display:none; padding-top: 0px;color: #999;margin-top: -1px;position: relative;top: -1px;">~~木有更夺友参与了~~</a>
                    <a id="btnLoadMore3" class="loading" style="display:none; padding-top: 0px;color: #999;margin-top: -1px;position: relative;top: -1px;">~~木有更夺友参与了~~</a>
            <input id="urladdress" value="" type="hidden" />
            <input id="pagenum" value="" type="hidden" />
             <script type="text/javascript">
   //打开页面加载数据
window.onload=function(){
    init_json("<?php echo $item['id']; ?>/list/10");
}

    //打开页面加载数据
    function init_json(parm) {
        $("#urladdress").val('');
        $("#pagenum").val('');
        $.getJSON('<?php echo WEB_PATH; ?>/mobile/mobile/itemsajax/' + parm, function(data) {
            $("#divGoodsLoading").css('display', 'none');
            if (data[0].sum) {
                var fg = parm.split("/");
                $("#urladdress").val(fg[0] + '/' + fg[1]);
                $("#pagenum").val(data[0].page);
                for (var i = 0; i < data.length; i++) {
                    var ul = '<ul style="overflow:visible;border-top:none;border-bottom:1px solid #efefef;margin-top:0;width:100%;border-left:1px solid #efefef;"><li class="rBg" style="z-index:15;padding:0;top:13px;">';
                    ul += '<a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/'+data[i].uid+'">';
                    if (data[i].uphoto != 'photo/member.jpg') 
                    {
                        ul += '<img style="border-radius:100px;" src="<?php echo G_UPLOAD_PATH; ?>/' + data[i].uphoto + '">';
                    }else if(data[i].headimg != ''){
                        ul += '<img style="border-radius:100px;" src="' + data[i].headimg + '">';
                    }else{
                        ul += '<img style="border-radius:100px;" src="<?php echo G_UPLOAD_PATH; ?>/' + data[i].uphoto + '">';
                    }

                    ul += '</a>';
                    ul += '</li>';
                    ul += '<li class="rInfo" style="padding:0;">';
                    ul += '<a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/'+data[i].uid+'">'+data[i].username+'</a>';
                    ul += '<strong>('+data[i].ip+')</strong>';
                    ul += '<br/>';
                    ul += '<span>参与了<b class="orange">'+data[i].gonumber+'</b>人次</span>';
                    //ul += '<em class="arial">'+Year+'-'+Month+'-'+Day+'&nbsp&nbsp'+Hours+':'+Minutes+':'+Seconds+'</em>';
                    ul += '<em class="arial">'+data[i].time2+'</em>';
                    ul += '</li></ul>';
                    $("#divGoodsLoading").before(ul);
                }
                if (data[0].page <= data[0].sum) {
                    $("#btnLoadMore").css('display', 'block');
                    $("#btnLoadMore2").css('display', 'none');
                    $("#btnLoadMore3").css('display', 'none');
                } else if (data[0].page > data[0].sum) {
                    $("#btnLoadMore").css('display', 'none');
                    $("#btnLoadMore2").css('display', 'none');
                    $("#btnLoadMore3").css('display', 'block');
                }
            } else {
                $("#btnLoadMore").css('display', 'none');
                $("#btnLoadMore2").css('display', 'block');
                $("#btnLoadMore3").css('display', 'none');
            }
        });
    }

    $(document).ready(function() {
                
                //加载更多
                //自动加载
                $(window).scroll(function() {
                    if ($(document).height() - $(this).scrollTop() - $(this).height() < 1 && $('#btnLoadMore').css('display') != 'none') {
                        var url = $("#urladdress").val(),
                            page = $("#pagenum").val();
                        init_json(url + '/10/' + page);
                    }
                });
});
    </script>




    </section>
    <style type="text/css">


#btnGotoTop {
    padding: 0;
    width: 40px;
    height: 40px;
    border-top: 1px solid #4b4b4b;
    display: block;
    position: absolute;
    bottom: 0;
}

#btnGotoTop1 {
    padding: 0;
    width: 40px;
    height: 40px;
    display: block;
    position: absolute;
}

#btnGotoTop .s1 {
    background: url(<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 -163px no-repeat;
    background-size: 21px auto;
    margin: 9px auto;
    display: block;
    width: 21px;
    height: 21px;
}

.smailnav {
    position: fixed;
    right: 0px;
    bottom: 65px;
    z-index: 99999999;
    height: auto;
}

#top_div {
    display: none;
    width: 40px;
    height: 80px;
    background: #242424;
    opacity: 0.8;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#top_div1 {
    display: block;
    width: 40px;
    height: 40px;
    background: #242424;
    opacity: 0.8;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#btnGotoTop1 .s2 {
    background: url(<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 -129px no-repeat;
    background-size: 21px auto;
    margin: 9px auto;
    display: block;
    width: 21px;
    height: 21px;
}

#btnGotoTop3 {
    display: none;
    width: 100px;
    position: absolute;
    right: 0;
    top: -219px;
    padding: 0 10px;
    background: #242424;
    opacity: 0.7;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#btnGotoTop3 a {
    display: block;
    height: 40px;
    line-height: 40px;
    width: 100%;
    padding: 0;
    color: #fff;
    clear: both;
}

#btnGotoTop3 .xb {
    display: block;
    width: 10px;
    height: 10px;
    background: #242424;
    border-left: 1px solid #242424;
    border-top: 1px solid #242424;
    -webkit-transform: rotate(45deg);
    position: absolute;
    bottom: -5px;
    right: 10px;
}

#btnGotoTop3 a i {
    background: url(<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 0px no-repeat;
    width: 20px;
    height: 20px;
    margin: 10px 5px 0 0;
    display: block;
    vertical-align: middle;
    float: left;
    position: relative;
    background-size: 25px;
    left: 2px;
}

#btnGotoTop3 a em {
    display: block;
    float: left;
    line-height: 42px;
}

#btnGotoTop3 .home {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .home i {
    background-position: 0 1px;
    background-size: 28px auto;
    height: 22px;
}

#btnGotoTop3 .glist {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .glist i {
    background-position: 0 -117px;
    background-size: 19px;
}

#btnGotoTop3 .lottry {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .lottry i {
    background-position: 0 -35px;
    left: 0;
}

#btnGotoTop3 .user {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .user i {
    background-position: 0 -113px;
}

#btnGotoTop3 .sx i {
    background-position: 0 -213px;
    background-size: 22px auto;
}
    </style>
    <div class="smailnav">
        <div id="btnGotoTop3" class="smailgb">
            <a class="home" href="<?php echo WEB_PATH; ?>">
                <i></i> <em>首页</em>
            </a>
            <a class="glist" href="<?php echo WEB_PATH; ?>/mobile/mobile/glist">
                <i></i> <em>所有商品</em>
            </a>
            <a class="lottry" href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery">
                <i></i>
                <em>最新揭晓</em>
            </a>
            <a class="user" href="<?php echo WEB_PATH; ?>/mobile/home">
                <i></i>
                <em>我的夺宝</em>
            </a>
            <a id="shuaxin" class="sx" href="">
                <i></i>
                <em>刷新</em>
            </a>
            <i class="xb"></i>
        </div>
        <div id="top_div1">
            <a id="btnGotoTop1" onclick="Show_Hidden(btnGotoTop3)">
                <i class="s2"></i>
            </a>
        </div>
        <div id="top_div">
            <a id="btnGotoTop1" onclick="Show_Hidden(btnGotoTop3)">
                <i class="s2"></i>
            </a>
            <a id="btnGotoTop" href="javascript:;">
                <i class="s1"></i>
            </a>
        </div>
    </div>
    <script type="text/javascript">
    //返回顶部
    $(function() {
        $("#btnGotoTop").click(function() {
            $("html,body").animate({
                scrollTop: 0
            }, 1500);
        });
    });

    window.onscroll = function() {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var top_div = document.getElementById("top_div");
        var s = document.documentElement.scrollTop || document.body.scrollTop;
        var top_div1 = document.getElementById("top_div1");
        if (t >= 200) {
            top_div.style.display = "block";
        } else {
            top_div.style.display = "none";
        }
        if (s >= 200) {
            top_div1.style.display = "none";
        } else {
            top_div1.style.display = "block";
        }

    }

    function Show_Hidden(btnGotoTop3) {
        if (btnGotoTop3.style.display == "block") {
            btnGotoTop3.style.display = 'none';
        } else {
            btnGotoTop3.style.display = 'block';
        }
    }
    /*document.onclick = function() //发布微博刷新代码
        {
            var obj = event.srcElement;
            if (obj.id == "shuaxin") {
                window.location.reload();
            }
        }*/
    </script>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";
  Path.Webpath = "<?php echo WEB_PATH; ?>";

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
    return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0': D.getMinutes().toString().substring(0, 1))
}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');


</script>
<script>
$(function(){
	<?php if($itemlist): ?>
  $(".blue").click(function(){
	 window.location.href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $itemlist['0']['q_uid']; ?>";
  });

  $(".orange.arial").click(function(){
	 window.location.href="<?php echo WEB_PATH; ?>/mobile/mobile/dataserver/<?php echo $itemlist['0']['id']; ?>";
  });
  <?php endif; ?>

	// 揭晓倒计时
	var divLotteryTime = $('#divLotteryTime');
	if ( divLotteryTime.size() > 0 ) {
		var id = divLotteryTime.attr('data-id');
		var minute = divLotteryTime.find('b.minute');
		var second = divLotteryTime.find('b.second');
		var millisecond = divLotteryTime.find('b.millisecond');
		var tips = minute.parent().prev();
		var times = (new Date().getTime()) + 1000 * divLotteryTime.attr('data-endtime');
		var timer = setInterval(function(){
			var time = times - (new Date().getTime());
			if ( time < 1 ) {
				clearInterval(timer);
				tips.css('line-height', '35px').css('color','#FF5152').html('刷新下，幸运者就是你！');
				minute.parent().remove();
				second.parent().remove();
				millisecond.parent().remove();

				var checker = function(){
					$.getJSON(Gobal.Webpath+"/api/getshop/lottery_shop_huode/"+new Date().getTime(),{'test':true,'gid':id},function(info){
						if ( info.error ) {
							tips.html('刷新下，幸运者就是你');
							setTimeout(checker,1000);
						} else {
							tips.html('揭晓成功！');
							setTimeout(function(){
								location.reload();
							},200);
						}
					});
				};
				setTimeout(checker,750);
				return;
			}

			i =  parseInt((time/1000)/60);
			s =  parseInt((time/1000)%60);
			ms =  String(Math.floor(time%1000));
			ms = parseInt(ms.substr(0,2));
			if(i<10)i='0'+i;
			if(s<10)s='0'+s;
			if(ms<10)ms='0'+ms;
			minute.html(i);
			second.html(s);
			millisecond.html(ms);
		}, 41);

	}

})

</script>

</div>
</body>
</html>
