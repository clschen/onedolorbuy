<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title><?php if(isset($title)): ?><?php echo $title; ?><?php  else: ?><?php echo _cfg("web_name"); ?><?php endif; ?></title> 

	<meta name="keywords" content="<?php if(isset($keywords)): ?><?php echo $keywords; ?><?php  else: ?><?php echo _cfg("web_key"); ?><?php endif; ?>" />

	<meta name="description" content="<?php if(isset($description)): ?><?php echo $description; ?><?php  else: ?><?php echo _cfg("web_des"); ?><?php endif; ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/comm.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/register.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/color.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/css.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/mycart.css"/>

	<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>

	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/cloud-zoom.min.js"></script>

	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.webox.js"></script>

	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cartlist.js"></script>

	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/koala.min.1.5.js"></script>

</head>

<body>

	<div id="loadingtime"></div>

	<div class="header">

		<div class="site_top">

			<div class="head_top w1200">

				<ul class="collect fr">

					<li class="fr">
						<a style="text-indent: 25px;margin-right: 0 !important;" class="service_img" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank">离线留言</a>
					</li>
					<li class="fr">
						<a href="<?php echo WEB_PATH; ?>/help/1">帮助</a>
						<span>|</span>
					</li>

					<li class="fr">
						<a href="<?php echo WEB_PATH; ?>/member/home/userrecharge">快速充值</a>
						<span>|</span>
					</li>

					<li class="fr yu_ff">

						<a  href="<?php echo WEB_PATH; ?>/home/member">我的云购</a>
						<span>|</span>

						<div class="h_1yyg_eject">

							<dl>

								<dd>
									<a  href="<?php echo WEB_PATH; ?>/member/home">我的云购</a>
								</dd>

								<dd>
									<a  href="<?php echo WEB_PATH; ?>/member/home/userbuylist">云购记录</a>
								</dd>

								<dd>
									<a  href="<?php echo WEB_PATH; ?>/member/home/orderlist">获得商品</a>
								</dd>

								<dd>
									<a  href="<?php echo WEB_PATH; ?>/member/home/userrecharge">帐户充值</a>
								</dd>

								<dd>
									<a  href="<?php echo WEB_PATH; ?>/member/home/modify">个人设置</a>
								</dd>

							</dl>

						</div>

					</li>
					<?php if(get_user_arr()): ?>
					<li class="fr">
						欢迎您:
						<a  href="<?php echo WEB_PATH; ?>/member/home" ><?php echo get_user_name(get_user_arr(),'username'); ?></a>

						<span>|</span>

						<a href="<?php echo WEB_PATH; ?>/member/user/cook_end">[退出]</a>

						<span>|</span>

					</li>
					<?php  else: ?>
					<li class="fr">
						<a href="<?php echo WEB_PATH; ?>/register">注册</a>
						<span>|</span>
					</li>

					<li class="fr">
						<a href="<?php echo WEB_PATH; ?>/login">登录</a>
						<span>|</span>
					</li>
					<?php endif; ?>
				</ul>

				<ul class="collect fl">
					<li class="fl">
						<a style="margin-right: 3px;" href="javascript:;" onclick="AddFavorite(window.location,document.title)">收藏</a>
						<span>|</span>
					</li>
					<li class="fl mobile" style="position:relative;width: 50px;padding:0 25px;">
						<a target="_blank" style="margin:0;" href="<?php echo G_WEB_PATH; ?>/app/index.html">手机云购</a>
						<s style="left: 80px;"></s>
						<span  class="shouji"></span>
						<div class="h_mobile" style="padding:0 25px;width: 50px;height: 140px;z-index: 9999;">
							<dl>
								<li class="fl mobile">
									<a target="_blank"  style="margin:0;color: #22AAFF;" href="<?php echo G_WEB_PATH; ?>/app/index.html">手机云购</a>
									<s style="left: 80px;"></s>
									<span class="shouji" style="background-position: -45px -34px;"></span>
								</li>
							</dl>
							<a target="_blank" href="<?php echo G_WEB_PATH; ?>/app/index.html">
								<img style="position: absolute;left: 5px;top: 30px;" src="<?php echo G_TEMPLATES_STYLE; ?>/images/code.jpg" height="90" width="90">
							</a>
							<span style="line-height: 15px;color: #22AAFF!important;display: block;position: absolute;top: 120px;left: 20px;"><a target="_blank" style="line-height: 18px;margin: 0;" href="<?php echo G_WEB_PATH; ?>/app/index.html">下载客户端</a></span>
						</div>
					</li>
				</ul>

			</div>

		</div>

		<div class="head_mid">

			<div class="head_mid_bg w1200">

				<h1 class="logo_yungou fl">

					<a class="logo_1yyg_img" href="<?php echo G_WEB_PATH; ?>/" title="<?php echo _cfg('web_name'); ?>">

						<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a>

				</h1>
					<style>
						.head_search span{
							position: absolute;display: block;top: 0;right: 40px;text-align: center;
						}
						.head_search span a{
							height: 20px;width: 35px;display: block;background: #eee;color: #666;
							margin: 8px 7px 0 0;float: left;line-height: 20px;
							border-radius: 2px;
						}
						.head_search span a:hover{
							background: #ccc;
						}
					</style>
				<div class="head_search b_red fl" style="position: relative;">

					<input style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;" id="txtSearch" class="init" placeholder="输入'小米手机'试一试" type="text">
					<span style="">
						<a href="<?php echo G_WEB_PATH; ?>/index.php/s_tag/苹果">苹果</a>
						<a href="<?php echo G_WEB_PATH; ?>/index.php/s_tag/购物卡" style="width: 45px;">购物卡</a>
					</span>
					<a class="search_submit" id="butSearch" href="javascript:;"> <i class="ico_search"></i>

					</a>

				</div>

				<div class="m-joinNum r">
					<?php 

			$return = go_count_renci();

		 ?>
					<a href="<?php echo WEB_PATH; ?>/buyrecord" target="_blank">

						<span class="qian text">累计参与</span>
						<?php $ln=1;if(is_array($return)) foreach($return AS $slide): ?>
						<!-- <span class="tnum" id="spBuyCount"><?php echo go_count_renci(); ?></span>
					-->
					<span class="tnum" id="spBuyCount"><?php echo $slide; ?></span>
					<?php  endforeach; $ln++; unset($ln); ?>
					<span class="hou text">人次></span>

				</a>

			</div>

		</div>

	</div>

</div>

<!--导航 header_nav 开始-->

<div class="head_nav">

	<div class="nav_center bg_red b_red w1200">

		<div class="m_menu br_red">

			<div class="m_menu_all">

				<h3>
					<a class="c_red" href="<?php echo WEB_PATH; ?>/goods_list/">全部商品分类</a> <em></em>
				</h3>

			</div>

			<div class="m_all_sort b_gray" id="m_all_sort" style="border:1px solid #2af;">

				<ul>
					<?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order` desc limit 0,8",array("type"=>1,"key"=>'',"cache"=>0)); ?>

	<?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>
					<li>

						<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>" target="_blank">

							<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $categoryx['pic_url']; ?>" height="49" width="44"></a>

						<a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>" target="_blank"><?php echo $categoryx['name']; ?></a>

					</li>
					<?php  endforeach; $ln++; unset($ln); ?>

	<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
				</ul>

				<a class="more" href="<?php echo WEB_PATH; ?>/goods_list">查看更多</a>

			</div>

		</div>

		<ul class="nav_list">

			<li class="sort-all-shouye">
				<a href="<?php echo G_WEB_PATH; ?>">首页</a>
			</li>
			<?php echo Getheader('index'); ?>
		</ul>

		<div class="mini_mycart" id="sCart">

			<a href="<?php echo WEB_PATH; ?>/member/cart/cartlist" class="cart c_red" target="_blank" id="sCartNavi">

				<s></s>
				购物车(
				<span id="sCartTotal" class="c_red">0</span>
				)
			</a>

		</div>

	</div>

</div>

<div class="clear"></div>

<style>

.fixedNav{

	position:fixed;

	top:0px;

	left:0px;

	width:100%;

	z-index:100000;

	_position:absolute;

	_top:expression(eval(document.documentElement.scrollTop));

}

</style>

<!--导航 header_nav 结束-->

<script>

$(document).ready(function(){
		$.get("<?php echo WEB_PATH; ?>/member/cart/getnumber/"+new Date().getTime(),function(data){
			$("#sCartTotal").text(data);
			$("#sCartTotalA").text(data);
		});

	});



document.onkeydown=function(event)

{ 

	e = event ? event :(window.event ? window.event : null);

	ss= document.getElementById('txtSearch').value;

	if(e.keyCode==13 && ss!=""){

	 window.location.href="<?php echo WEB_PATH; ?>/s_tag/"+$("#txtSearch").val();

	}

}



$(function(){

	$("#txtSearch").focus(function(){

		$("#txtSearch").css({background:"#fff"});

		$(this).attr("placeholder","");

	});

	$("#txtSearch").blur(function(){

		$("#txtSearch").css({background:"#FFF"});

		$(this).attr("placeholder","输入'小米手机'试一试");	

	});

	$("#butSearch").click(function(){

		var val1="小米手机"

	    if($("#txtSearch").val()==""){

			window.location.href="<?php echo WEB_PATH; ?>/s_tag/"+val1;

		}else

		if($("#txtSearch").val()==$("#txtSearch").val()){

			window.location.href="<?php echo WEB_PATH; ?>/s_tag/"+$("#txtSearch").val();

		}

	});

});



	$(".yu_ff").mouseover(function(){

	  $(".h_1yyg_eject").show();

	})

	$(".yu_ff").mouseout(function(){

	  $(".h_1yyg_eject").hide();

	})



		

	//收藏

	function AddFavorite(sURL, sTitle){

		try

		{

			window.external.addFavorite(sURL, sTitle);

		}

		catch (e)

		{

			try

			{

				window.sidebar.addPanel(sTitle, sURL, "");

			}

			catch (e)

			{

				alert("您可以通过快捷键Ctrl+D进行添加");

			}

		}

	}

	

	$(".mobile").mouseover(function(){

		$(".h_mobile").show();

		$(".h_mobile  s").css("background","../images/headbg11.png").css("background-position","5px -64px");

	})

	$(".h_mobile").mouseout(function(){

		$(".h_mobile").hide();

	})



	

</script>