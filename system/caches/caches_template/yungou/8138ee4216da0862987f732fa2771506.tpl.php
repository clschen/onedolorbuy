<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><div style="clear:both" ></div>
<div class="footer mt20">
	<div class="footer_center w1200">
		<div class="g-guide">
			<?php $category=$this->DB()->GetList("select * from `@#_category` where `parentid`='1'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
		<?php $ln=1;if(is_array($category)) foreach($category AS $help): ?>
			<dl>
				<dt><?php echo $help['name']; ?></dt>
				<?php $article=$this->DB()->GetList("select * from `@#_article` where `cateid`='$help[cateid]'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
			<?php 
			foreach($article as $art){
			echo "
				<dd>
					<a href='".WEB_PATH.'/help/'.$art['id']."' target='_blank'>".$art['title'].'</a>
				</dd>
				';}
			 ?>
			</dl>
			<?php  endforeach; $ln++; unset($ln); ?>
		           	 <?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		</div>
		<div class="g-service">
			<div class="m-ser u-ser1">
				<ul>
					<li>
						<s class="u-icons"></s>
					</li>
					<li>
						<dl>
							<dt>下载移动客户端</dt>
							<dd> <b class="u-icons"></b>
							</dd>
							<dd>
								<a href="javascript:;" class="bg_red weixinload">立即下载</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="yun_mobile">
				<a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75"></a>
				<a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75"></a>
				<a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75"></a>
				<div style="margin-top:-8px;">
					<span><a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html">安卓下载</a></span>
					<span><a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html">IOS下载</a></span>
					<span><a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html">WIN下载</a></span>
				</div>
				<div class="yun_close"></div>
			</div>
			<div class="m-ser u-ser2">
				<ul class="mt10 ml10">
					<li>
						<a target="_blank" href="<?php echo G_WEB_PATH; ?>/weixin/index.html">
							<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/qrcode_for_gh_83e2ad3c77a9_344.jpg" height="75" width="75"></a>
					</li>
					<li>
						<dl>
							<dt>
								<a href=""> <i class="u-icons"></i>
									关注官方微信
								</a>
							</dt>
							<dd>
								<a href=""> <b class="u-icons"></b>
								</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="m-ser u-ser3">
				<ul>
					<li>
						<s class="u-icons"></s>
					</li>
					<li>
						<dl>
							<dt>服务器时间</dt>
							<dd id="pServerTime">15:40:27</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="m-ser u-ser4">
				<ul>
					<li>
						<s class="u-icons"></s>
					</li>
					<li>
						<dl>
							<dt>云购益基金</dt>
							<dd>
								<?php $gongyi=$this->DB()->GetList("select * from `@#_fund` limit 1",array("type"=>1,"key"=>'',"cache"=>0)); ?>
								<?php $ln=1;if(is_array($gongyi)) foreach($gongyi AS $jijin): ?>
								<a href="<?php echo WEB_PATH; ?>/single/fund" target="_blank" id="indexFundMoney"><?php echo $jijin['fund_count_money']; ?></a>
								<?php  endforeach; $ln++; unset($ln); ?>
								<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
							</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="m-ser u-ser5" style="width: 248px;">
				<ul>
					<li>
						<s class="u-icons"></s>
					</li>
					<li>
						<dl>
							<dt>服务热线</dt>
							<dd class="c_red u-tel"><?php echo _cfg('cell'); ?></dd>
							<dd>
								<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank" class="service_img">在线客服</a>
							</dd>
						</dl>
					</li>
				</ul>
			</div>

		</div>
		<div class="g-special">
			<ul>
				<li>
					<a> <em class="u-spc-icon1"></em>
						<span>100%公平公正</span>
						参与过程公开透明，用户可随时查看
					</a>
				</li>
				<li>
					<a> <em class="u-spc-icon2"></em>
						<span>100%正品保证</span>
						精心挑选优质商家，100%品牌正品
					</a>
				</li>
				<li>
					<a>
						<em class="u-spc-icon3"></em>
						<span>全国免运费</span>
						全场商品全国包邮（港澳台地区除外）
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="g-copyrightCon">
		<div class="w1190">
			<!-- //底部短连接 -->
			<div class="g-links">
				<?php echo Getheader('foot'); ?>
				<script src="http://s22.cnzz.com/stat.php?id=4535640&web_id=4535640" language="JavaScript"></script>
			</div>
			<a href="http://webscan.360.cn/index/checkwebsite/url/<?php echo G_WEB_PATH; ?>" name="24d69b6a8438f6f4d5f1da1d2010e20b" >360网站安全检测平台</a>
			<div class="g-copyright"><?php echo _cfg('web_copyright'); ?></div>
		</div>
	</div>
</div>
<style>
	#top_div{
		display: none;
	}
</style>
<div id="top_div">
<div id="divRighTool" class="quickBack">
	<div class="dingbu"></div>
	<ul>
		<li class="gouwuche">
			<div class="mini_mycart" id="sCart">
				<a href="<?php echo WEB_PATH; ?>/member/cart/cartlist" class="cart c_red" target="_blank" id="sCartNavi">
					<s></s>
					<em>购物车</em>
					<span id="sCartTotalA" class="c_red"></span>

				</a>
			</div>

		</li>
			<li class="fenxianga">

		<div  onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="color: #fff;height: 32;line-height: 16px;width: 25px;padding-top:12px;display: block;padding-left: 6px;" id="btnRigQQ" href="#" target="_blank" class="quick_serviceA">好友分享</a>
				<div style="position: absolute;left:-152px;background: #fff;border: 1px solid #dcdcdc;width: 150px;height: 56px;text-align: center;top:0px;">
					<div class="jiathis_style">
					<style>
						.jiathis_style .jtico{
							padding: 0px!important;
							display: block!important;
							margin: 14px 5px !important;
							width: 17px!important;
							height: 17px!important;
						}
						.jtico_tsina:hover{
							opacity: 1;
							background-position: 0 -26px!important;
						}
						.jiathis_style .jtico_weixin{
							background-position: -27px 0!important;
						}
						.jtico_weixin:hover{
							background-position: -27px -26px!important;
						}
						.jiathis_style .jtico_qzone{
							background-position: -54px 0!important;
						}
						.jtico_qzone:hover{
							background-position: -54px -26px!important;
						}
						.jiathis_style .jtico_tqq{
							background-position: -81px 0!important;
						}
						.jtico_tqq:hover{
							background-position: -81px -26px!important;
						}
						.jiathis_style .jtico_cqq{
							background-position: -108px 0!important;
						}
						.jtico_cqq:hover{
							background-position: -108px -26px!important;
						}
						.jiathis_button_tsina .jtico_tsina{margin-left: 10px!important;}
					</style>
					<a class="jiathis_button_tsina"></a>
					<a class="jiathis_button_weixin"></a>
					<a class="jiathis_button_qzone"></a>
					<a class="jiathis_button_tqq"></a>
					<a class="jiathis_button_cqq"></a>
					
				</div>
					<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
				</div>

			</div>
		</div>
		</li>
		<li class="app">

		<div onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="color: #fff;height: 32;line-height: 16px;width: 25px;padding-top:12px;display: block;padding-left: 6px;" id="btnRigQQ" href="<?php echo G_WEB_PATH; ?>/app/index.html" target="_blank" class="quick_serviceA">手机APP</a>
				<div style="position: absolute;left:-99px;background: #fff;border: 1px solid #dcdcdc;width: 97px;height: 113px;text-align: center;top: -57px;">
					<a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html"><img style="width: 75px;height: 75px;padding:5px 5px 10px 5px;" src="<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/code.jpg" alt="客户端"></a>
					<a style="text-align: center;line-height: 10px;" target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html">下载客户端</a>
				</div>

			</div>
		</div>
		</li>
		<li class="weixin">

		<div onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="color: #fff;height: 32;line-height: 16px;width: 25px;padding-top:12px;display: block;padding-left: 6px;" id="btnRigQQ" href="<?php echo G_WEB_PATH; ?>/weixin/index.html" target="_blank" class="quick_serviceA">官方微信</a>
				<div style="position: absolute;left:-99px;background: #fff;border: 1px solid #dcdcdc;width: 97px;height: 113px;text-align: center;top: -57px;">
					<a target="_blank" href="<?php echo G_WEB_PATH; ?>/weixin/index.html"><img style="width: 75px;height: 75px;padding:5px 5px 10px 5px;" src="<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/qrcode_for_gh_83e2ad3c77a9_344.jpg" alt="微信">
					</a>
					<a style="text-align: center;line-height: 10px;" target="_blank" href="<?php echo G_WEB_PATH; ?>/weixin/index.html">关注官方微信</a>
				</div>

			</div>
		</div>
		</li>


		<li class="qq">
		<div onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="color: #fff;height: 32;line-height: 16px;width: 25px;padding-top:12px;display: block;padding-left: 6px;" id="btnRigQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank" class="quick_serviceA">在线客服</a>
			</div>
		</div>
		</li>
		<li class="fankui">
		<div onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="color: #fff;height: 32;line-height: 16px;width: 25px;padding-top:12px;display: block;padding-left: 6px;" id="btnRigQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank" class="quick_serviceA">意见反馈</a>
			</div>
		</div>
		</li>

		<li class="zhiding" style="background: none;">
			<div onmouseover="MM_over(this)" onmouseout="MM_out(this)" style="position:relative;width: 37px;height: 56px;">
			<i></i>
			<div style="width:37px;display:none;position:absolute;height: 56px;">
				<a style="width: 37px;height: 56px;line-height: 56px;color: #fff;text-align: center;display:block;" id="btnGotoTop" href="javascript:;" class="quick_ReturnA">置顶</a>
			</div>
			</div>
			

		</li>
	</ul>

</div>
</div>
<script type="text/javascript">
window.onscroll = function(){
    var t = document.documentElement.scrollTop || document.body.scrollTop; 
    var top_div = document.getElementById( "top_div" );
    if( t >= 300 ) {
        top_div.style.display = "block";
    } else {
        top_div.style.display = "none";
    }
}



function MM_over(mmObj) {
	var mSubObj = mmObj.getElementsByTagName("div")[0];
	mSubObj.style.display = "block";
	mSubObj.style.backgroundColor = "#9f948d";
}
function MM_out(mmObj) {
	var mSubObj = mmObj.getElementsByTagName("div")[0];
	mSubObj.style.display = "none";
	
}


function guanbi3(){
var display=$("#MaCenter1").css("display");
	if(display=="block"){
		$("#MaCenter1").css("display","none");
	}else{
		$("#MaCenter1").css("display","block");
	};
}
$(function(){	
	$(".guanbi3").click(guanbi3);
});




(function(){				
		var week = '日一二三四五六';
		var innerHtml = '{0}:{1}:{2}';
		var dateHtml = "{0}月{1}日 &nbsp;周{2}";
		var timer = 0;
		var beijingTimeZone = 8;				
				function format(str, json){
					return str.replace(/{(\d)}/g, function(a, key) {
						return json[key];
					});
				}				
				function p(s) {
					return s < 10 ? '0' + s : s;
				}			

				function showTime(time){
					var timeOffset = ((-1 * (new Date()).getTimezoneOffset()) - (beijingTimeZone * 60)) * 60000;
					var now = new Date(time - timeOffset);
					document.getElementById('pServerTime').innerHTML = format(innerHtml, [p(now.getHours()), p(now.getMinutes()), p(now.getSeconds())]);				
					//document.getElementById('date').innerHTML = format(dateHtml, [ p((now.getMonth()+1)), p(now.getDate()), week.charAt(now.getDay())]);
				}				
				
				window.yungou_time = 	function(time){						
					showTime(time);
					timer = setInterval(function(){
						time += 1000;
						showTime(time);
					}, 1000);					
				}
	window.yungou_time(<?php echo time(); ?>*1000);
				
})();

	$(".weixinload").click(function(){
		$(".yun_mobile").fadeIn();
	})
	$(".yun_close").click(function(){
		$(".yun_mobile").fadeOut();
	})
	
	
</script>

<script>
/*
$("#divRighTool").show(); 
var wids=($(window).width()-1200)/2-70;
if(wids>0){
	$("#divRighTool").css("right",wids);
}else{
	$("#divRighTool").css("right",10);
}
*/
$(function(){
	$("#btnGotoTop").click(function(){
		$("html,body").animate({scrollTop:0},1500);
	});
	$("#btnFavorite,#addSiteFavorite").click(function(){
		var ctrl=(navigator.userAgent.toLowerCase()).indexOf('mac')!=-1?'Command/Cmd': 'CTRL';
		if(document.all){
			window.external.addFavorite('<?php echo G_WEB_PATH; ?>','<?php echo _cfg("web_name"); ?>');
		}
		else if(window.sidebar){
		   window.sidebar.addPanel('<?php echo _cfg("web_name"); ?>','<?php echo G_WEB_PATH; ?>', "");
		}else{ 
			alert('您可以通过快捷键' + ctrl + ' + D 加入到收藏夹');
		}
    });
    /*
	$("#divRighTool a").hover(		
		function(){
			$(this).addClass("Current");
		},
		function(){
			$(this).removeClass("Current");
		}
	)
	*/
});
//云购基金
//$.ajax({
//	url:"<?php echo WEB_PATH; ?>/api/fund/get",
//	success:function(msg){
//		$("#indexFundMoney").text(msg);
//	}
//});
</script>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"<?php echo _cfg("web_name"); ?>，收获惊喜的网站！1元就购iphone6S","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

</body>
</html>