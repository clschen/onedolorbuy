<?php include "egglotter.header.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/cindex.css">
<link href="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/fixed.css" type="text/css" rel="stylesheet" />
<style type="text/css">
.egg{width:660px; position:absolute; margin:190px 0 0 -50px;}
.egg ul li{}
.eggList{padding:100px 0 0 0; position:relative; width:660px;}
.eggList li{float:left;background:url(<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-2.png) no-repeat bottom;width:158px;height:187px;cursor:pointer;position:relative;margin-left:35px;}
.eggList li span{position:absolute; width:30px; height:60px; left:68px; top:64px; color:#ff0; font-size:42px; font-weight:bold}
.eggList li.curr{background:url(<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-3.png) no-repeat bottom;cursor:default;z-index:300;}
.eggList li.curr sup{position:absolute;background:url(<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-4.png) no-repeat;width:232px; height:181px;top:-36px;left:-34px;z-index:800;}
.hammer{background:url(<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-6.png) no-repeat;width:74px;height:87px;position:absolute; text-indent:-9999px;z-index:150;left:168px;top:100px;}
.resultTip{position:absolute; background:#ffc ;width:148px;padding:6px;z-index:500;top:200px; left:40px; color:#f60; text-align:center;overflow:hidden;display:none;z-index:500;}
.resultTip b{font-size:12px;line-height:20px;}

.resultTip {
position: absolute;
font-weight: bold;
font-family: Arial, Helvetica, sans-serif;
font-size: 22px;
background: url(<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-5.gif) no-repeat;
width: 90px;
height: 50px;
z-index: 500;
color: #fff;
text-align: center;
overflow: hidden;
display: none;
top:100px;
}
.tip1{left:73px;_left:103px;}
.tip2{left:263px;_left:293px;}
.tip3{left:460px;_left:490px;}
</style>
<!--[IF IE 6]>
<style>
.eggList li{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=corp,src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-2.png"); _background:none;}
.eggList li.curr{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=corp,src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-3.png"); _background:none;}
.eggList li.curr sup{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=corp,src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-4.png"); _background:none;}
.hammer{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=corp,src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/img-6.png"); _background:none;}
</style>
<![ENDIF]-->
<script type="text/javascript" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/js/jquery1.9.1.min.js"></script>
<script type="text/javascript">
$(function(){
	var egglist = $(".eggList li");	
	$(".eggList li").click(function() {
		if(!<?php echo $user_id; ?>){
			FixedMesg("你未登录!",220,true,0);
		}else if(<?php echo $lotter_opportunity; ?>==0){
			FixedMesg("<?php echo $lotterdes; ?>",220,true,0);
		}else if(!egglist.hasClass("curr")){			
			$(this).children("span").hide();
			eggClick($(this));
		}
	});
	$(".eggList li").hover(function() {
		var posL = $(this).position().left + $(this).width();
		var posT = $(this).position().top;
		if(egglist.hasClass("curr")){
			$("#hammer").hide();
		}else{
			$("#hammer").show().css('left', posL).css("top",posT);
		}		
	})
});

function eggClick(obj){	
	var _this = obj;
	var linum=$(".eggList li").index(_this);
	var	num_one,num_two;
	
	$.getJSON("<?php echo WEB_PATH.'/api/plugin/get/egglotter/add/'?>",function(res){		  
		if(_this.hasClass("curr")){
			alert("蛋都碎了，别砸了！刷新再来.");
			return false;
		}
		$(".hammer").css({"top":_this.position().top-55,"left":_this.position().left+185});
		$(".hammer").animate({			 
			"top":_this.position().top-25,
			"left":_this.position().left+125
			},30,function(){				 
				_this.addClass("curr"); 	//蛋碎效果
				_this.find("sup").show();   //金花四溅
				$(".hammer").hide();
				if(linum==0){					
					num_one=1,num_two=2;
				}else if(linum==1){
					num_one=0,num_two=2;
				}else if(linum==2){
					num_one=0,num_two=1;
				}
				$('.resultTip').eq(linum).css({display:'block',opacity:0}).animate({opacity:1},300,function(){
					$(".resultTip b").eq(linum).html(res.prize);
				}).show(2000,function(){
					$('.resultTip').eq(num_one).css({display:'block',opacity:0}).animate({opacity:1},300,function(){
						$(".eggList li").eq(num_one).addClass("curr"); 
						$(".eggList li").eq(num_one).find("sup").show(); 
						$(".resultTip b").eq(num_one).html("奖品在这里<br/>"+res.prize1);
					});
					$('.resultTip').eq(num_two).css({display:'block',opacity:0}).animate({opacity:1},300,function(){
						$(".eggList li").eq(num_two).addClass("curr"); 
						$(".eggList li").eq(num_two).find("sup").show(); 
						$(".resultTip b").eq(num_two).html("奖品在这里<br/>"+res.prize2);
					});	
				});
			}
		);
	});
}
</script>
<body style="width: 100%;">
<div class="cen" style="width: 100%;">
	<div class="notice_open_content">
	<div class="wrapcont">
	<div class="cont1">	 
		<div class="egg">
			<ul class="eggList">
				<p class="hammer" id="hammer">锤子</p>
				<p class="resultTip tip1" ><b></b></p>
				<p class="resultTip tip2" ><b></b></p>
				<p class="resultTip tip3" ><b></b></p>
				<li><span></span><sup></sup></li>
				<li><span></span><sup></sup></li>
				<li><span></span><sup></sup></li>
			</ul>
		</div>
		<ul id="auctioned_list_1" class="gamesshow">
			<?php 
				foreach($award as $ad){
					echo '<li>';
					echo '<span>'.$ad['user_name'].'用户获得';
					foreach($slinfo as $linfo){
						if($linfo['spoil_id']==$ad['spoil_id']){
						echo '<b class="Red">'.$linfo['spoil_name'].'</b>';
						}
					}					
					echo '</span></li>';
				}
			?>
		</ul>
		<div class="download"><a target="_blank" href="<?php echo WEB_PATH."/api/plugin/get/egglotter/user/"; ?>">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/hall.jpg"></a>
			<div style="padding:20px 0 0 0; color:#fff;">
				<b>砸金蛋规则：</b>
				<?php echo $ruleinfo['ruledesc']; ?>
			</div>
			<!--<a class="full"  href="#">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/full.jpg"></a>
			<a class="full" href="#">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/kefu.jpg"></a>-->
		</div>
		
		<div class="zhuce" style="margin:150px 0 0 0;">
			
			<a class="zcbut" href="#"><img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/zcbut.gif"></a>		   
		</div>
					   
		<div class="lbcont">

		</div>
		<div class="bj">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/index-1.jpg">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/index-2.jpg">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/index-3.jpg">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/index-4.jpg">
			<img alt="" src="<?php echo G_PLUGIN_PATH; ?>/egglotter/images/index-5.jpg">
		</div>
	</div>
	</div>

	</div>
</div>
<?php include "egglotter.footer.php"; ?>
<script>
$(function(){
	$(window).resize(function(){
		Fixed();
	});
	/* $("#btnShow5").click(function(){
		FixedMesg('发表失败，请重试',220,true,0);
	}); */
})
//显示遮罩层
function Fixed(w,h){
	var bigheight=document.body.clientHeight,
	    bigwidth=document.body.clientWidth;
	var big=$("#foucs_big"),	
	    min=$("#foucs_min");
	var w3foucs=$("#w3foucs");
	if(w==null){
		if(w3foucs.text()!=null){
			w = w3foucs.width();
		}else{
			w = 200;
		}
	}	
	if(h==null){
		var h = w3foucs.height();
	}   
	big.height(bigheight);	
    big.width(bigwidth);    
	min.width(w+12); 
    min.height(h+12); 	
	w3foucs.css("height",h);
	w3foucs.width(w);
    var t = ($(window).height()/2) - (h/2);
    if(t < 0) t = 0;
	$("#foucs_close").css({display:"block"});
    var l = ($(window).width()/2) - (w/2);
    if(l < 0) l = 0;   
    $("#foucs_min").css({left: l-5+'px', top: t-5+'px'});
    w3foucs.css({left: l+'px', top: t+'px'});
}
function FixedStar(){
	var div='<div id="foucs_big" class="foucs_back"></div>';
		div+='<div id="foucs_min" class="foucs_back"></div>';
		div+='<div id="w3foucs">';
	return div;
}
function FixedEnd(){
	var div='</div>';
	return div;
}
//消息提示mesg
function FixedMesg(content,minwidth,close,prompt,time){	
	if(prompt=="0"){
		prompt="img_error";
	}else if(prompt=="1"){
		prompt="img_success";
	}
	var div=FixedStar();
		if(close==true)div+='<div id="foucs_close" ></div>';
		div+='<div id="foucs_main">';
		div+='<div class="content">';
		div+='<div class="PopMsgC"  style="display:black"><s class="'+prompt+'"></s>'+content+'</div>';
		div+='</div></div>';		
		div+=FixedEnd();	
	$("body").append(div);	
	Fixed(minwidth);
	if(close==true)FixedClose();
	else if(time==null) FixedCloseSettime(4);
	else FixedCloseSettime(time);
}
//关闭弹窗
function FixedClose(){
	$("#foucs_close,#page_close,#btnMsgCancel,#imgtmp").click(function(){		
		$("#foucs_big,#foucs_min,#w3foucs").fadeOut(200,function(){
			$("#foucs_big,#foucs_min,#w3foucs").remove();
		});		
	})
};
</script>
