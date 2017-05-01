(function(){
	
	//立即购买
	var  gcartlist = {};
		 gcartlist.DOMS = {};
		 		 
	var _x,_y,m,allscreen=false;		 
	gcartlist.heredoc = function(fn) {
		 //return fn.toString().split('\n').slice(1,-1).join('\n') + '\n'
		  return fn.toString().match(/\/\*!?(?:\@preserve)?[ \t]*(?:\r\n|\n)([\s\S]*?)(?:\r\n|\n)\s*\*\//)[1];
	}

	gcartlist.strToDom = function (arg) {
	　　 var objE = document.createElement("div");
	　　 objE.innerHTML = arg;
	　　 return objE.childNodes;
	};
	var cartlist_shopid="";
	gcartlist.gocartlist = function(shopid,path,cookie_pre){
		var syrs='';
		var shopinfo='';
		$.get(path+"/member/cart/Fastpay/",{'shopid':shopid},function(cgoodsdata){
			var cgoodsinfo = jQuery.parseJSON(cgoodsdata);
			syrs=cgoodsinfo.zongrenshu-cgoodsinfo.canyurenshu;
			shopinfo={'shopid':shopid,'money':cgoodsinfo.price,'shenyu':syrs};
            			var carid='car_'+shopid;
			if(syrs!=0){
				if(Cartcookie(false)){
                				$('#'+carid).parent().parent().parent().find('.success .main').html(cgoodsinfo.tishi);
                				$('#'+carid).parent().parent().parent().find('.success').show(1500,function(){
                   				$('#'+carid).parent().parent().parent().find('.success').hide(1500);});
                			}else{
                				$('#'+carid).parent().parent().parent().find('.fail .main').html(cgoodsinfo.tishi);
                				$('#'+carid).parent().parent().parent().find('.fail').show(1500,function(){
                				$('#'+carid).parent().parent().parent().find('.fail').hide(1500);});
                			}
			  	
			}else{
                			$('#'+carid).parent().parent().parent().find('.fail .main').html(cgoodsinfo.tishi);
                			$('#'+carid).parent().parent().parent().find('.fail').show(1500,function(){
                   			$('#'+carid).parent().parent().parent().find('.fail').hide(1500);});
            }


function Cartcookie(cook){
	var info = {};
	var Cartlist = $.cookie('Cartlist');
	//判断是否已经存在
	// alert(shopid);
	var encoded = $.toJSON(Cartlist);
	eval("Cartlist123="+Cartlist);
	 for(x in Cartlist123){
	 	if(x == shopid){
	 		return false;
	 	}
   	 }  
	if(Cartlist){
		var info = $.evalJSON(Cartlist);
		if((typeof info) !== 'object'){
			var info = {};
		}
	}else{
		var info = {};
	}	
	if(!shopinfo[shopid]){
		var CartTotal=$("#sCartTotal").text();
		var CartTotal=$("#sCartTotalA").text();
		$("#sCartTotal").text(parseInt(CartTotal)+1);
		$("#sCartTotalA").text(parseInt(CartTotal)+1);
	}
	info[shopid]={};
	info[shopid]['num']=1;
	info[shopid]['shenyu']=shopinfo['shenyu'];
	info[shopid]['money']=shopinfo['money'];
	info['MoenyCount']='0.00';
	$.cookie('Cartlist',$.toJSON(info),{expires:7,path:'/'});	
	if(cook){
		window.location.href=path+"/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
	}
	return true;
}


});			
}
window.gcartlist = gcartlist;	
})();
