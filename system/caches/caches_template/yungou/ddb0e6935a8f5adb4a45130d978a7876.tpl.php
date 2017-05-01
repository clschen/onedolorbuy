<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<script>
function showh(){
var height=$("#ddBrandList").innerHeight();	
	if(height==78){
		$("#ddBrandList").css("height","auto");
		$(".list_classMore").addClass("MoreClick");
		$(".list_classMore").html("收起<i></i>");
	}else{
		$("#ddBrandList").css("height",78);
		$(".list_classMore").removeClass("MoreClick");
		$(".list_classMore").html("展开<i></i>");
	};
}

$("#m_all_sort").hide();
$(function(){	
	$(".list_classMore").click(showh);
});

$(".m_menu_all").mouseenter(function(){
$(".m_all_sort").show();
     })
$(".m_menu_all").mouseleave(function(){
$(".m_all_sort").hide();
     })
$(".m_all_sort").mouseenter(function(){
$(this).show();
     })
$(".m_all_sort").mouseleave(function(){
  $(this).hide();
})

$(function(){
  $(window).scroll(function() {	
 		
		if($(window).scrollTop()>=130&&$(window).scrollTop()<=560){
			$(".head_nav").addClass("fixedNav");	
			$("#m_all_sort").fadeOut();
		}else if($(window).scrollTop()>560){
			$(".head_nav").addClass("fixedNav");
			$("#m_all_sort").fadeOut();
	} else if($(window).scrollTop()<130){
			$(".head_nav").removeClass("fixedNav");
	}
      });
});

// $("#_click").find('li').eq(0).addClass('bg_red');

</script>
<div class="wrap w1200" id="loadingPicBlock">
	<div class="Current_nav w1200"><a href="<?php echo WEB_PATH; ?>">首页</a> &gt; <?php echo $daohang_title; ?></div>
	<div id="current" class="list_Curtit b_gray">
		<h1 class="fl c_red"><?php echo $daohang_title; ?></h1> 
		<span id="spTotalCount">(共<em class="c_red"><?php echo $total; ?></em>件相关商品)</span>
	</div>
	<div class="list_class">
	<dl>
		<dt>分类</dt>
		<dd>
		<ul id="_click">
		<?php if(!$fen1): ?>            
			<li><a href="<?php echo WEB_PATH; ?>/goods_list/0" class="ClassCur">全部</a></li>
		<?php  else: ?>
			<li><a href="<?php echo WEB_PATH; ?>/goods_list/0">全部</a></li>
		<?php endif; ?>
               		<?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order` DESC",array("type"=>1,"key"=>'',"cache"=>0)); ?>
               		<?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>

               		<?php if($categoryx['cateid']==$fen1): ?>
			<li><a  class="ClassCur" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>"><?php echo $categoryx['name']; ?></a></li>
			<?php  else: ?>
			<li><a  href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>"><?php echo $categoryx['name']; ?></a></li>
			<?php endif; ?>
			<?php  endforeach; $ln++; unset($ln); ?>

			<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		</ul>
		</dd>
	</dl>
	</div>	
	<div class="list_class">
	<dl>
		<dt>品牌</dt>
		<?php if(count($brand)>17): ?>
		<dd id="ddBrandList" style="height:78px">
		<?php  else: ?>
		<dd id="ddBrandList">
		<?php endif; ?>
			<ul>
            	<?php if(!$fen2): ?>
				<li><a href="<?php echo WEB_PATH; ?>/goods_list" class="ClassCur" >全部</a></li>
                <?php  else: ?>
                <li><a href="<?php echo WEB_PATH; ?>/goods_list">全部</a></li>
                <?php endif; ?>
				<?php $ln=1;if(is_array($brand)) foreach($brand AS $brand2): ?>
                <?php if($brand2['id']==$fen2): ?>
				<li><a class="ClassCur"  href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $brand2['cateid']; ?>e<?php echo $brand2['id']; ?>" title="<?php echo $brand2['name']; ?>"><?php echo $brand2['name']; ?></a></li>
                <?php  else: ?>
                <li><a  href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $brand2['cateid']; ?>e<?php echo $brand2['id']; ?>" title="<?php echo $brand2['name']; ?>"><?php echo $brand2['name']; ?></a></li>
                 <?php endif; ?>
				<?php  endforeach; $ln++; unset($ln); ?>
			</ul>
		</dd>
	</dl>

	<?php if(count($brand)>17): ?>	
	<a class="list_classMore" href="javascript:;">展开<i></i></a>
	<?php endif; ?>	
	</div>
	 <div class="list_Sort">
		    <dl>
			    <dt>排序</dt>
			    <dd>
                <a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/10" <?php if($select=='10'): ?>class="SortCur"<?php endif; ?>>即将揭晓</a>
                <a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/20" <?php if($select=='20'): ?>class="SortCur"<?php endif; ?>>人气</a>
                <a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/30" <?php if($select=='30'): ?>class="SortCur"<?php endif; ?>>剩余人次</a>
                <a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/40" <?php if($select=='40'): ?>class="SortCur"<?php endif; ?>>最新</a>
                <?php if($select=='50'): ?>
                <a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/60" class="Price_Sort SortCur">价格 <i></i></a>
                <?php  else: ?>
                    <?php if($select=='60'): ?>
                   		<a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/50" class="Price_Sort SortCur">价格 <s></s></a>
                    <?php  else: ?>
                    	<a style="font-size: 14px;" href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $cate_band; ?>/50" class="Price_Sort">价格 <s></s></a>
                    <?php endif; ?>
                <?php endif; ?>
                </dd>
		    </dl>
		    <?php if($total>$num): ?>
	<div style="height: 48px;  width: 670px; float: left;">
		<div class="pagesx" style="margin-top: 10px!important;margin: 0px;"><?php echo $page->show('two'); ?></div>
	</div>
	
	<?php endif; ?>
	    </div>
	<div class="get_ready w1200">
	<ul>		
		<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
		<li class="list-block">
			<div class="pic">
				<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?> ">
					<?php if(isset($shop['t_new_goods'])): ?>						
					<i class="goods_xp"></i>					
					<?php endif; ?>					
					<?php if(isset($shop['t_max_qishu'])): ?>							
					<i class="goods_rq"></i>							
					<?php endif; ?>
					<?php if($shop['pos']!='0'): ?>
					<i class="goods_tj"></i>
					<?php endif; ?>
					<img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>">
				</a>
				<p name="buyCount" style="display:none;"></p>
			</div>
			<p class="name">
				<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?> "><?php echo $shop['title']; ?></a>
			</p>
			<p class="money">价值：<span class="rmb"><?php echo $shop['money']; ?></span></p>
			<div class="Progress-bar">
				<p style="height: 5px;" title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>"><span style="width:<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>;height: 6px;"></span></p>
				<ul class="Pro-bar-li">
					<li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
					<li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
					<li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
				</ul>
			</div>
			<div class="w-goods-ing" style="width: 215px;margin-top: 3px;">
				<div class="shop_buttom bg_red b_red1" style="margin:0 10px;width:115px;height:35px;">
					<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" style="line-height:35px;font-size:14px;" class="Det_Shopnow">立即1元云购</a>
				</div>
				<div class="shop_buttom1 bg_pink b_pink c_red" style="margin:0px 10px;width:60px;height:35px;">
					<a href="javascript:;" onclick="gcartlist.gocartlist(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>','wc_')" class="c_red" style="line-height:30px;font-size:14px;" id="car_<?php echo $shop['id']; ?>"></a>
				</div>
			</div>
			<div class="fail" style="display:none">
			    <div class="main" style="text-indent:4em">购物车已存在！加入失败</div>
			    <div class="arrow"><em>◆</em><s>◆</s></div>
			</div>
			<div class="success" style="display:none">
				<div class="main" style="text-indent:4em">恭喜您,加入购物车成功</div>
			    <div class="arrow"><em>◆</em><s>◆</s></div>
			</div>	
		</li>
		<?php  endforeach; $ln++; unset($ln); ?>
	</ul>
	<?php if($total>$num): ?>
	<div style="height: 80px;  width: 1200px; float: left;">
		<div class="pagesx"><?php echo $page->show('two'); ?></div>
	</div>
	
	<?php endif; ?>
	</div>	  
</div>
<script type="text/javascript">

$(function(){
	$("#ulGoodsList li a.go_cart").click(function(){ 
		var sw = $("#ulGoodsList li a.go_cart").index(this);
		var src = $("#ulGoodsList li .pic a img").eq(sw).attr('src');				
		var $shadow = $('<img id="cart_dh" style="display:none; border:1px solid #aaa; z-index:99999;" width="200" height="200" src="'+src+'" />').prependTo("body");  			
		var $img = $("#ulGoodsList li .pic").eq(sw);
		$shadow.css({ 
			'width' : 200, 
			'height': 200, 
			'position' : 'absolute',      
			"left":$img.offset().left+16, 
			"top":$img.offset().top+9,
			'opacity' : 1    
		}).show();
		var $cart = $("#btnMyCart");
		$shadow.animate({   
			width: 1, 
			height: 1, 
			top: $cart.offset().top,    
			left: $cart.offset().left, 
			opacity: 0
		},500,function(){
			Cartcookie(sw,false);
		});	
		
	});
	$("#ulGoodsList li a.go_Shopping").click(function(){	
		var sw = $("#ulGoodsList li a.go_Shopping").index(this);

		Cartcookie(sw,true); 
	});	
});
//存到COOKIE
function Cartcookie(sw,cook){
	var shopid = $(".Curbor_id").eq(sw).text(),
		shenyu = $(".Curbor_yunjiage").eq(sw).text(),
		money = $(".Curbor_shenyu").eq(sw).text();
	var Cartlist = $.cookie('Cartlist');
	if(!Cartlist){
		var info = {};
	}else{
		var info = $.evalJSON(Cartlist);
	}
	if(!info[shopid]){
		var CartTotal=$("#sCartTotal").text();
			$("#sCartTotal").text(parseInt(CartTotal)+1);
			$("#btnMyCart em").text(parseInt(CartTotal)+1);
	}	
	info[shopid]={};
	info[shopid]['num']=1;
	info[shopid]['shenyu']=shenyu;
	info[shopid]['money']=money;
	info['MoenyCount']='0.00';
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	if(cook){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
	}
}  

</script>
<?php include templates("index","footer");?>