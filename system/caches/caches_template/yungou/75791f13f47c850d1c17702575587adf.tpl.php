<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title><?php echo $key; ?> - <?php echo $webname; ?>触屏版</title>
	<meta content="app-id=518966501" name="apple-itunes-app" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="black" name="apple-mobile-web-app-status-bar-style" />
	<meta content="telephone=no" name="format-detection" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/goods.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/main.css" rel="stylesheet" type="text/css">
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
-->
</head>

<body>
<!-- 栏目页面顶部 -->
<div id="loadingPicBlock" class="h5-1yyg-v1">
<?php include templates("mobile/index","header1");?>
<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/ajax.js"></script>
	<section class="goodsCon" style="position: relative;top: 49px;">
		<div class="goodsNav" style="color: #888;background: #f4f4f4;padding-left: 10px;">
			本分类下共有<em class="orange"><?php echo $list; ?></em>&nbsp个商品！
		</div>
		<div class="goodsList" style="border-top: 1px solid #ccc;">
			<?php if($shoplist!=null): ?>
				<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
					<ul>
						<li>
							<span id="<?php echo $shop['id']; ?>" class="z-Limg">
								<a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $shop['id']; ?>"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"></a>
							</span>
							<div id="<?php echo $shop['id']; ?>" class="goodsListR">
								<h2 id="<?php echo $shop['id']; ?>"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $shop['id']; ?>">(第<?php echo $shop['qishu']; ?>期)<?php echo $shop['title']; ?></a></h2>
								<div class="pRate">
								<a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $shop['id']; ?>">
									<div id="<?php echo $shop['id']; ?>" class="Progress-bar">
										<p style="background: #e7e7e7;border-radius: 3px;height: 5px;overflow: hidden;position: relative;" title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>"><span style="background: #22AAFF;border-radius: 3px;font-size: 0;height: 100%;position: absolute;width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],213); ?>px;"></span></p>
										<ul class="Pro-bar-li">
											<li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与</li>
											<li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
											<li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</li>
										</ul>
									</div>
								</a>
								<a class="add " href="javascript:;" codeid="<?php echo $shop['id']; ?>"><i></i></a>
								</div>
							</div>
						</li>
					</ul>
				<?php  endforeach; $ln++; unset($ln); ?>
			<?php  else: ?>

			<div style="" class="haveNot z-minheight" id="divNone">
            <s></s>
            <p>木有找到商品~~</p>
            <a href="/">
                <p class="guangguang">再去找</p>
            </a>
        	</div>
			<?php endif; ?>
		</div>
	</section>
</div>
<script type="text/javascript">

//打开页面加载数据
window.onload=function(){
	glist_json("list/10");
	//购物车数量
	$.getJSON('<?php echo WEB_PATH; ?>/mobile/ajax/cartnum',function(data){
		if(data.num){
			$("#btnCart").append('<em>'+data.num+'</em>');
		}
	});
	
}
//获取数据
function glist_json(parm){
	$("#urladdress").val('');
	$("#pagenum").val('');
	$.getJSON('<?php echo WEB_PATH; ?>/mobile/mobile/glistajax/'+parm,function(data){
		$("#divGoodsLoading").css('display','none');		
		if(data[0].sum){
			var fg=parm.split("/");
			$("#urladdress").val(fg[0]+'/'+fg[1]);
			$("#pagenum").val(data[0].page);
			for(var i=0;i<data.length;i++){			
			var ul='<ul><li>';
				ul+='<span id="'+data[i].id+'" class="z-Limg"><img src="<?php echo G_UPLOAD_PATH; ?>/'+data[i].thumb+'"></span>';
				ul+='<div class="goodsListR">';
				ul+='<h2 id="'+data[i].id+'">'+data[i].title+'</h2>';
				ul+='<div class="pRate">';
				ul+='<div class="Progress-bar" id="'+data[i].id+'">';				
				ul+='<p class="u-progress"><span class="pgbar" style="width:'+(data[i].canyurenshu / data[i].zongrenshu)*100+'%;"><span class="pging"></span></span></p>';
				ul+='<ul class="Pro-bar-li">';
				ul+='<li class="P-bar01"><em>'+data[i].canyurenshu+'</em>已参与</li>';
				ul+='<li class="P-bar02"><em>'+data[i].zongrenshu+'</em>总需人次</li>';
				ul+='<li class="P-bar03"><em>'+data[i].shenyurenshu+'</em>剩余</li>';
				ul+='</ul></div>';
				ul+='<a class="add " codeid="'+data[i].id+'" href="javascript:;"><i></i></a>';
				ul+='</div></div></li></ul>';
				$("#divGoodsLoading").before(ul);			
			}
			if(data[0].page<=data[0].sum){
				$("#btnLoadMore").css('display','block');
				$("#btnLoadMore2").css('display','none');
				$("#btnLoadMore3").css('display','none');
			}else if(data[0].page>data[0].sum){
				$("#btnLoadMore").css('display','none');
				$("#btnLoadMore2").css('display','none');
				$("#btnLoadMore3").css('display','block');
			}
		}else{
			$("#btnLoadMore").css('display','none');
			$("#btnLoadMore2").css('display','block');	
			$("#btnLoadMore3").css('display','none');			
		}
	});
}
$(document).ready(function(){
	//即将揭晓,人气,最新,价格	
	$("#divGoodsNav li:not(:last)").click(function(){
		var l=$(this).index();
		$("#divGoodsNav li").removeClass().eq(l).addClass('current');
		var parm=$("#divGoodsNav li").eq(l).attr('order');
		$("#divGoodsLoading").css('display','block');
		$(".goodsList ul").remove();
		var glist=glist_json("list/"+parm);
	});
	
	//商品分类
	var dl=$("#divGoodsNav dl"),
		last=$("#divGoodsNav li:last"),
		first=$("#divGoodsNav dd:first");
	$("#divGoodsNav li:last a:first").click(function(){		
		if(dl.css("display")=='none'){
			dl.show();
			last.addClass("gSort");
			first.addClass("sOrange");			
		}else{
			dl.hide();
			last.removeClass("gSort");
			first.removeClass("sOrange");
		}
	});
	$("#divGoodsNav  dd").click(function(){
		var s=$(this).index();
		var t=$("#divGoodsNav .gSort dd a").eq(s).html();
		var id=$("#divGoodsNav .gSort dd a").eq(s).attr('id');
		$("#divGoodsNav .gSort a:first").html(t+'<s class="arrowUp"></s>');
		var l=$("#divGoodsNav .current").index(),
			parm=$("#divGoodsNav li").eq(l).attr('order');
		if(id){			
			$("#divGoodsLoading").css('display','block');
			$(".goodsList ul").remove();
			glist_json(id+'/'+parm);
		}else{
			glist_json("list/"+parm);
			$(".goodsList ul").remove();
		}	
		dl.hide();
		last.removeClass("gSort");
		first.removeClass("sOrange");
	});
	//加载更多
	$("#btnLoadMore").click(function(){		
		var url=$("#urladdress").val(),
			page=$("#pagenum").val();
		glist_json(url+'/'+page);
	});	
	//自动加载
	$(window).scroll(function () {        
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 1
                    && $('#btnLoadMore').css('display')!='none' ){
                var url=$("#urladdress").val(),
			page=$("#pagenum").val();
		glist_json(url+'/'+page);
            }
        });

	//返回顶部
	$(window).scroll(function(){
		if($(window).scrollTop()>50){
			$("#btnTop").show();
		}else{
			$("#btnTop").hide();
		}
	});
	$("#btnTop").click(function(){
		$("body").animate({scrollTop:0},10);
	});
	//添加到购物车
	$(document).on("click",'.add',function(){
		var codeid=$(this).attr('codeid');
		$.getJSON('<?php echo WEB_PATH; ?>/mobile/ajax/addShopCart/'+codeid+'/1',function(data){
			if(data.code==1){
				addsuccess('添加失败');
			}else if(data.code==0){
				addsuccess('添加成功');				
			}return false;
		});
	});
	function addsuccess(dat){
		$("#pageDialogBG .Prompt").text("");
		var w=($(window).width()-255)/2,
			h=($(window).height()-45)/2;
		$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
		$("#pageDialogBG").stop().fadeIn(1000);
		$("#pageDialogBG .Prompt").append('<s></s>'+dat);
		$("#pageDialogBG").fadeOut(1000);
		//购物车数量
		$.getJSON('<?php echo WEB_PATH; ?>/mobile/ajax/cartnum',function(data){
			$("#btnCart").append('<em>'+data.num+'</em>');
		});
	}
	//跳转页面
	var gt='.goodsList span,.goodsList h2,.goodsList .Progress-bar';
	$(document).on('click',gt,function(){
		var id=$(this).attr('id');
		if(id){
			window.location.href="<?php echo WEB_PATH; ?>/mobile/mobile/item/"+id;
		}			
	});

});

</script>

<?php include templates("mobile/index","footer");?>
</body>

</html>
<style>
#pageDialogBG{-webkit-border-radius:5px; width:255px;height:45px;color:#fff;font-size:16px;text-align:center;line-height:45px;}
</style>
<div id="pageDialogBG" class="pageDialogBG">
<div class="Prompt"></div>
</div>