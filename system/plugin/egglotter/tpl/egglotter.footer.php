<div class="footer mt20">
	<div class="footer_center w1200">
		<div class="g-guide">

		<?php 
		$getlis= $this->mysql_model->GetList("select * from `@#_category` where `parentid`='1'");
		?>

		<?php foreach ($getlis as  $help) {  ?>

		   <dl>
		   	<dt><?php echo $help['name'] ?></dt>
			<?php  $article= $this->mysql_model->GetList("select * from `@#_article` where `cateid`= $help[cateid]" );  ?>
			<?php  foreach($article as $art){ ?>
			<dd><a href='<?php echo WEB_PATH; ?>/help/<?php echo $art['id'] ?>' target='_blank'><?php echo $art['title'] ?></a></dd>
			<?php } ?>			
		 </dl>   			
		<?php } ?>
		</div>
	<div class="g-service">
	<div class="m-ser u-ser1">
                <ul>
                    <li><s class="u-icons"></s></li>
                    <li>
                        <dl>
                            <dt>下载移动客户端</dt>
                            <dd><b class="u-icons"></b></dd>
                            <dd><a href="javascript:;" class="bg_red weixinload">立即下载</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
	<div class="yun_mobile">
                        	<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75">
            		<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75">
            		<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75">
            		<div style="margin-top:-8px;">
            		 <span>安卓下载</span>
            		 <span>IOS下载</span>
            		<span>WIN下载</span>
            	</div>
	<div class="yun_close">
	</div>
	</div>
            	<div class="m-ser u-ser2">
              <ul class="mt10 ml10">
              <li><a href="">
                            <img src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="75" width="75"></a></li>
              <li>
              <dl>
                           <dt><a href=""><i class="u-icons"></i>关注官方微信</a></dt>
                            <dd><a href=""><b class="u-icons"></b></a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
			<div class="m-ser u-ser3">
                <ul>
                    <li><s class="u-icons"></s></li>
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
                    <li><s class="u-icons"></s></li>
                    <li>
                        <dl>
                            <dt>云公益基金</dt>
                            <dd><a href="{<?php echo WEB_PATH; ?>}/single/fund" target="_blank" id="indexFundMoney">0000.00</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
	<div class="m-ser u-ser5">
                <ul>
                    <li><s class="u-icons"></s></li>
                    <li>
                        <dl>
                            <dt>服务热线</dt>
                            <dd class="c_red u-tel">525292105</dd>
                            <dd><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq") ?>&site=qq&menu=yes" target="_blank" class="service_img">在线客服</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>

		</div>
		<div class="g-special">
            <ul>
                <li>
                    <a>
                        <em class="u-spc-icon1"></em>
                        <span>100%公平公正</span>
                        参与过程公开透明，用户可随时查看
                    </a>
                </li>
                <li>
                    <a>
                        <em class="u-spc-icon2"></em>
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
				<?php  echo Getheader('foot') ?>
			</div>
			<div class="g-copyright"><?php echo _cfg('web_copyright') ?></div>
		</div>
	</div>
</div>
<!--<div style="right: 281.5px;" id="divRighTool" class="quickBack">
	
	<dl class="quick_But">
		<dd class="quick_service"><a id="btnRigQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq") ?>&site=qq&menu=yes" target="_blank" class="quick_serviceA"><b>在线客服</b><s></s></a></dd>
		<dd class="quick_Collection"><a id="btnFavorite" href="javascript:;" class="quick_CollectionA"><b>收藏本站</b><s></s></a></dd>
		<dd class="quick_Return"><a id="btnGotoTop" href="javascript:;" class="quick_ReturnA"><b>返回顶部</b><s></s></a></dd>
	</dl>
	
	
</div>-->







<script type="text/javascript">
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
	window.yungou_time(<?php echo time() ?>*1000);
				
})();

	$(".weixinload").click(function(){
		$(".yun_mobile").fadeIn();
	})
	$(".yun_close").click(function(){
		$(".yun_mobile").fadeOut();
	})
	
	
</script>

<script>

$("#divRighTool").show(); 
var wids=($(window).width()-1200)/2-70;
if(wids>0){
	$("#divRighTool").css("right",wids);
}else{
	$("#divRighTool").css("right",10);
}
$(function(){
	$("#btnGotoTop").click(function(){
		$("html,body").animate({scrollTop:0},1500);
	});
	$("#btnFavorite,#addSiteFavorite").click(function(){
		var ctrl=(navigator.userAgent.toLowerCase()).indexOf('mac')!=-1?'Command/Cmd': 'CTRL';
		if(document.all){
			window.external.addFavorite('<?php echo WEB_PATH; ?>','<?php echo _cfg("web_name") ?>');
		}
		else if(window.sidebar){
		   window.sidebar.addPanel('<?php echo _cfg("web_name") ?>','<?php echo WEB_PATH; ?>', "");
		}else{ 
			alert('您可以通过快捷键' + ctrl + ' + D 加入到收藏夹');
		}
    });
	$("#divRighTool a").hover(		
		function(){
			$(this).addClass("Current");
		},
		function(){
			$(this).removeClass("Current");
		}
	)
});
//云购基金
$.ajax({
	url:"<?php echo WEB_PATH; ?>/api/fund/get",
	success:function(msg){
		$("#indexFundMoney").text(msg);
	}
});
</script>


</body></html>