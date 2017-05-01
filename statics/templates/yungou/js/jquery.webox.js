


(function(){

	//立即购买
var  jwebox = {};
 jwebox.DOMS = {};
var _x,_y,m,allscreen=false;		 
jwebox.heredoc = function(fn) {
 	return fn.toString().match(/\/\*!?(?:\@preserve)?[ \t]*(?:\r\n|\n)([\s\S]*?)(?:\r\n|\n)\s*\*\//)[1];
}

	jwebox.strToDom = function (arg) {
	　　 var objE = document.createElement("div");
	　　 objE.innerHTML = arg;
	　　 return objE.childNodes;
};
	var jwebox_shopid="";

jwebox.goshopnow = function(shopid,path){
		if(jwebox_shopid&&jwebox_shopid==shopid&&jwebox.DOMS['goshopnow']){		 
			jwebox.DOMS['goshopnow'].show();return;		
		}else{
			var html = jwebox.heredoc(function(){/*	
				<style>
				.jwebox_showbox{z-index:999;}
				.jwebox_goshop{position: absolute;margin:314px;width: 300px;height: 200px;background: #22AAFF;z-index: 999;}
				*{margin:0;padding:0;list-style-type:none;}
				a,img{border:0;}
				.jwebox_mainlist{padding:10px;text-align:center;}
                .jwebox_mainlists{padding:10px;}
				.jwebox_mainlist li{height:28px;line-height:28px;font-size:12px;}
				.jwebox_mainlist li span{margin:0 5px 0 0;font-family:"宋体";font-size:12px;font-weight:400;color:#ddd;}
				.jwebox_webox{position:fixed;_position:absolute;z-index:9999;padding:8px;;_background:#777;background:#22AAFF;border-radius:5px;}
				.jwebox_webox .jwebox_inside{background-color:#FFFFFF;height:280px;z-index:999;}
				.jwebox_webox .jwebox_inside h1,.jwebox_locked h1{align:center;-moz-user-select:none;-webkit-user-select:none;position:relative;display:block;margin:0;padding:0;font-size:13px;line-height:25px;height:30px;padding-left:5px;font-family:Arial;background:#22AAFF;font-weight:normal;cursor:move;font-weight:800;color:#fff;}
				.jwebox_locked a{position:absolute;display:block;right:6px;margin-top:-4px;top:0px;font-size:25px;cursor:pointer;display:inline-block;color:#fff;}
				.jwebox_mainlist span a:hover{color:#fff;background-color:#f04900;}
				.jwebox_mainlist_uspecies span a:hover{color:#6F7070;}
				.jwebox_background{position:fixed;_position:absolute;z-index:998;top:0px;left:0px;width:100%;_width:expression(document.documentElement.clientWidth);height:100%;_height:expression(document.documentElement.clientHeight);background:rgb(50,50,50);background:rgba(0,0,0,0.5);}
				.jwebox_sum{width:200px;}
				.jwebox_shop_buttom{margin:13px 10px 0; height:50px;}
				.jwebox_shop_buttom_add{width:200px;margin:0px 10px;}
				.jwebox_Det_Shopnow{width:94px;height: 34px;background: #22AAFF;text-align: center;line-height: 32px;
				color: #fff;font-size: 14px;border-radius: 3px;display:block; float:left; margin-left:23px;}
				.jwebox_Det_Shopnow:hover{color:#fff;background:#f04900;}
				.jwebox_mainlist_uspecies1{margin-top:20px;display:block;width:260px;height:50px;line-height:50px;background-color:#22AAFF;border-radius:10px;color:#fff;font-size:16px;font-weight:600;}
				.buxianshi:hover{background-color:#fff!important;color:#22AAFF!important;}
				</style>
				<div class="jwebox_showbox">			
					<div class="jwebox_background"></div>
						<div class="jwebox_webox" style="width:400px;height:300px;">
						<div class="jwebox_inside" style="width:400px;height:300px;">
						<h1 class="jwebox_locked"  onselectstart="return false;">快捷支付——您将要云购的商品信息<a class="span" href="javascript:void(0);">×</a></h1>				
							<div class="jwebox_mainlist" style="height:35px;line-height:17px;padding:10px 20px;overflow:hidden;border-bottom:1px dashed #ccc;" ><span><a style="line-height:20px;" class="jwebox_goshopc buxianshi"   href="" target="_blank"></a></span></div>	
							
							<div class="jwebox_mainlist" style="padding:10px 60px;">
							<div style="margin-left:10px;">
							<div style="height:30px;width:85px;font-size:14px;line-height:30px;float:left;color:#6b6b6b;">我要参与</div>
							<div class="w-number w-number-inline" style="border:1px solid #e4e4e4;border-radius:18px;float:left;">
							<input class="w-number-input ynum_dig"  value="1" style="border:1px solid #e4e4e4;border-bottom:none;border-top:none;">
							<a class="w-number-btn w-number-btn-plus yshopadd" href="javascript:;" >+</a>
							<a class="w-number-btn w-number-btn-minus  yshopsub" href="javascript:;"  >-</a>                            
							</div>
							<div style="height:30px;width:70px;font-size:14px;text-align:center;line-height:35px;float:left;color:#6b6b6b;">人次</div>
							</div>
							<div style="clear:both;"></div>
							<span id="yshopchance" class="c_gray" style="display:block;padding-top:10px;">购买人次越多获得几率越大哦！</span>				
							<div class="jwebox_mainlist"><span>共计购买：<span class="jwebox_sum" ></span>人次</span></div>	
							<div class="jwebox_mainlist"><span class="jwebox_mainlist_uspecies">您的账户余额：<span class="jwebox_uspecies" ></span>云购币</span></div>	
							<div class="jwebox_shop_buttom" >
								<a href="javascript:;"  class="jwebox_Det_Shopnow"  id="jwebox_Det_Shopnow">立即支付</a>
								<a href="index.php/member/home/userrecharge"  class="jwebox_Det_Shopnow">去充值</a>
							</div>
							<div class="jwebox_shop_relog" id="sd_time" style="margin:10px 10px;color:#009999;font-size:14px;"></div>								
						</div>
                        <div class="jwebox_mainlists" style="color:#2af!important;"></div>
					</div>	
				</div>	
					 */});		
			

			var dom = jwebox.strToDom(html);
			$(document.body).append($(dom));
			jwebox.DOMS['goshopnow'] = $(".jwebox_showbox");		

			var left=parseInt(($(window).width() - 400) / 2);
			var top=parseInt(($(window).height() - 300) / 2.5);			
			$('.jwebox_webox').css({left:left,top:top});
			$(".jwebox_goshopc").attr("href",path+"/goods/"+shopid);					
			$('.jwebox_locked').mousedown(function(e){
				if(e.which){
					m=true;
					_x=e.pageX-parseInt($('.jwebox_webox').css('left'));
					_y=e.pageY-parseInt($('.jwebox_webox').css('top'));
				}
			}).dblclick(function(){
				if(allscreen){
					$('.jwebox_webox').css({height:height,width:width});
					$('.jwebox_webox').css({left:left,top:top});
					allscreen = false;
				}else{
					allscreen=true;
					var screenHeight = $(window).height();
					var screenWidth = $(window).width();
					$('.jwebox_webox').css({'width':screenWidth-18,'height':screenHeight-18,'top':'0px','left':'0px'});
				}
			}).mousemove(function(e){
				if(m && !allscreen){
					var x=e.pageX-_x;
					var y=e.pageY-_y;
					$('.jwebox_webox').css({left:x});
					$('.jwebox_webox').css({top:y});
				}
			}).mouseup(function(){
				m=false;
				});	
			$(window).resize(function(){
				if(allscreen){
					var screenHeight = $(window).height();
					var screenWidth = $(window).width();
					$('.jwebox_webox').css({'width':screenWidth-18,'height':screenHeight-18,'top':'0px','left':'0px'});
				}
			});	
			
			//商品信息获取	
			var syrs='';
			var shopinfo='';
			var shopnum = $(".ynum_dig");
			var jwebox_sum="";
			var umoney="";
			$.get(path+"/member/cart/Fastpay/",{'shopid':shopid},function(cgoodsdata){
			var cgoodsinfo = jQuery.parseJSON(cgoodsdata);

                if(cgoodsinfo.ustatus==2){
                    $('.jwebox_mainlist').hide();
                    $('.jwebox_mainlists').html(cgoodsinfo.umoney);
                    $('.jwebox_locked .span').click(function(){
                        window.location.reload();
                        // $('.jwebox_showbox').css({display:'none'});
                        //  if(jwebox_shopid&&jwebox_shopid==shopid){
                        //  $(".ynum_dig").val($(".ynum_dig").val());
                        //  }else{
                        //  $(".ynum_dig").val('1');
                        //  }		
                    });
                }else{
                    syrs=cgoodsinfo.zongrenshu-cgoodsinfo.canyurenshu;
                    shopinfo={'shopid':shopid,'price':cgoodsinfo.price,'shenyu':syrs,'zongrenshu':cgoodsinfo.zongrenshu,'canyurenshu':cgoodsinfo.canyurenshu};
                    $('.jwebox_goshopc').text(cgoodsinfo.cg_title);
                    jwebox_sum=cgoodsinfo.price*parseInt(shopnum.val());
                    $(".jwebox_sum").text(jwebox_sum);
                    $(".jwebox_uspecies").html("<span style='color:#22AAFF;font-weight:600;'>"+cgoodsinfo.umoney+"</span>");
                    
                    umoney=cgoodsinfo.umoney;
                    if(jwebox_sum>cgoodsinfo.umoney){
                        $(".jwebox_Det_Shopnow").hide();
                        $(".jwebox_Det_Shopnow_add").show();
                    }else{
                        $(".jwebox_Det_Shopnow").show();
                        $(".jwebox_Det_Shopnow_add").hide();
                    }
                    if(cgoodsinfo.ustatus==0){
                        $(".jwebox_mainlist_uspecies").html("<a class='jwebox_mainlist_uspecies1' href='"+path+"/login/'>请先登陆</a>");
                        $(".jwebox_mainlist_uspecies").css("color","#22AAFF");
                        $(".jwebox_shop_buttom").hide();
                        $('.jwebox_locked .span').click(function(){
                            window.location.reload();
                        });
                    }else if(cgoodsinfo.ustatus==1){
                        $('.jwebox_locked .span').click(function(){
                            $('.jwebox_showbox').hide();
                            $.cookie('fast_Cartlist', '', { expires: -1 }); 
                            window.location.reload();
                        });
                        $("#jwebox_Det_Shopnow").click(function(){
                            $(".jwebox_shop_buttom").hide();
                            var info = {};
                            var shopid=shopinfo['shopid'];
                            var shopnum =parseInt($(".ynum_dig").val());
		if(shopnum>3000){
			$(".jwebox_shop_relog").text('云购人次大于3000会产生多条购买记录！');
			setTimeout(function(){
			$(".jwebox_shop_relog").text();
			},3000);							
		}
                           $.post(path+"/member/cart/Fastpaysubmit/",{'shopid':shopid,'num':shopnum,'shenyu':shopinfo['shenyu'],'money':shopinfo['price'],'MoenyCount':shopinfo['price']*shopnum},function(cgoodsdata){
                                var cgoodsinfo = jQuery.parseJSON(cgoodsdata);
                                var i=3;
                                cgoodsinfo.error=cgoodsinfo.error;
                                $('.jwebox_locked .span').click(function(){
                                    window.location.reload();
                                });
                                $(".jwebox_shop_relog").text(cgoodsinfo.error);
                                var timer = setInterval(function(){
                                    if(i==1){
                                        clearInterval(timer);
                                        window.location.reload();
                                    }
                                    document.getElementById("sd_time").innerHTML = cgoodsinfo.error+(i--)+"秒后窗口将自行关闭";
                                },1000);
                            });
                        });
                    }
              }
});

function baifenshua(aa,n){
	n = n || 2;
	return ( Math.round( aa * Math.pow( 10, n + 2 ) ) / Math.pow( 10, n ) ).toFixed( n ) + '%';
}			


shopnum.keyup(function(){			
	if(shopnum.val()>syrs){
	shopnum.val(syrs);
	jwebox_sum=shopinfo['price']*syrs;
	$(".jwebox_sum").text(jwebox_sum);
	if(jwebox_sum>umoney){
		$(".jwebox_Det_Shopnow").hide();
		$(".jwebox_Det_Shopnow_add").show();
	}				
		}else{
	jwebox_sum=shopinfo['price']*shopnum.val();
	$(".jwebox_sum").text(jwebox_sum);	
	}
	var numshop=shopnum.val();
	if(numshop==shopinfo['zongrenshu']){
		var baifenbi='100%';
	}else{
		var showbaifen=numshop/shopinfo['zongrenshu'];
		var baifenbi=baifenshua(showbaifen,2);
	}
	$("#yshopchance").html("<span style='color:#22AAFF'>获得机率"+baifenbi+"</span>");   			
});			


$(".yshopadd").click(function(){ 		
		var shopnum = $(".ynum_dig");
		var resshopnump='';				
		var num = parseInt(shopnum.val());		
		if(num+1 >syrs){
		num=syrs;					
			shopnum.val(syrs);
			resshopnump = syrs;
		}else{
			num=parseInt(shopnum.val())+1;
			resshopnump=parseInt(shopnum.val())+1;
			shopnum.val(resshopnump);	
			if(shopnum.val()>=syrs){
				num=shopinfo['shenyu'];
				resshopnump=shopinfo['shenyu'];
				shopnum.val(resshopnump);
			}
		}	
	jwebox_sum=shopinfo['price']*num;
	$(".jwebox_sum").text(jwebox_sum);
	if(jwebox_sum>umoney){
		$(".jwebox_Det_Shopnow").hide();
		$(".jwebox_Det_Shopnow_add").show();
	}
     	if(resshopnump==shopinfo['zongrenshu']){
    		var baifenbi='100%';
    	}else{
    		var showbaifen=resshopnump/shopinfo['zongrenshu'];
    		var baifenbi=baifenshua(showbaifen,2);
    	}
    	$("#yshopchance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");                 						
});	


$(".yshopsub").click(function(){
		var shopnum = $(".ynum_dig");
		var num = parseInt(shopnum.val());
		if(num<2){
			num=1;
			shopnum.val(1);			
		}else{
			num=parseInt(shopnum.val())-1
			shopnum.val(parseInt(shopnum.val())-1);
		}
		jwebox_sum=shopinfo['price']*num;
		$(".jwebox_sum").text(jwebox_sum);	
		if(jwebox_sum>umoney){
	$("#jwebox_Det_Shopnow").hide();
             $(".jwebox_Det_Shopnow_add").show();
		}else{
             $("#jwebox_Det_Shopnow").show();
             $(".jwebox_Det_Shopnow_add").hide();
}
	var shopnums=parseInt(shopnum.val());
	if(shopnums==shopinfo['zongrenshu']){
		var baifenbi='100%';
	}else{
		var showbaifen=shopnums/shopinfo['zongrenshu'];
		var baifenbi=baifenshua(showbaifen,2);
	}
	$("#yshopchance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");   				
});


$(".jwebox_Det_Shopnow_add").click(function(){
		window.open(path+"/member/home/userrecharge/","_blank");
	});



	jwebox_shopid=shopid;			
}	
}
window.jwebox = jwebox;
	
})();

