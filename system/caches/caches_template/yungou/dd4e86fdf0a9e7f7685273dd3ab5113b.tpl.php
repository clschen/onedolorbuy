<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>

<!--晒单-->

<div class="wrap w1200">

	<div class="Current_nav w1200">

		<a href="<?php echo WEB_PATH; ?>">刷单隐藏页</div>

	<div id="current" class="share_Curtit">

		<h1 id="demo" class="fl">这个单页是刷单隐藏页，刷单期间请不要关闭就可以了~</h1>

	</div>

	<div id="loadingPicBlock" class="share_list">

		<div class="goods_share_listC">

			<ul style="margin-top:100px; font-size:16px;">				
				<li style="width:50%;" id="kaishi">执行时间:</li>				
				<li id="suijishu">已经购买次数:0</li>
				<li style="width:50%;"><span>最大时间间隔：<?php echo $t1; ?></span> <input type="hidden" id= 'max' value="<?php echo $t1; ?>"></li>

				<li><span>最小时间间隔：<?php echo $t2; ?></span> <input type="hidden" id= 'min' value="<?php echo $t2; ?>"></li>			

			</ul>				

		</div>

	</div>

</div>

<script type="text/javascript">

$(".mobile").mouseover(function(){

	$(".h_mobile").show();

	$(".h_mobile  s").css("background","../images/headbg11.png").css("background-position","5px -64px");

})

$(".h_mobile").mouseout(function(){

	$(".h_mobile").hide();

})

	$(".yu_ff").mouseover(function(){

	  $(".h_1yyg_eject").show();

	})

	$(".yu_ff").mouseout(function(){

	  $(".h_1yyg_eject").hide();

	})



		     $("#m_all_sort").hide();

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

</script>

<script src="http://jq22.qiniudn.com/masonry-docs.min.js"></script>

<script type="text/javascript">

	var a = $('#max').val();
	var b = $('#min').val();
	var count = 0;
	var rand = selectfrom(parseInt(b),parseInt(a));	
	var timer = setInterval(time_rand,1000);
	document.getElementById("kaishi").innerHTML="执行时间:"+rand+"秒";
	function ajax(){
	    $.ajax({
	    	url:"<?php echo WEB_PATH; ?>/go/shua/xcaction",
	        type : 'post',
	        data : {sn:123}, 
	        success:function(data1){
	          	if(data1.trim() == '进入下一期并失败！' || data1.trim() == '所选用户不是批量注册用户' || data1.trim() == '刷单功能暂未开启，请点击后台开启后在开始刷单哦！' || data1.trim() == '目前不在刷单时间区间'){
	          		alert(data1);
	          	}	     
	        }
	    })
	    count = count+1;
		document.getElementById("suijishu").innerHTML="已经购买次数:"+count+"次";
	}
	function time_rand(){			
		rand = rand-1
		document.getElementById("kaishi").innerHTML="执行时间:"+rand+"秒";
		if(rand <= 0){
			ajax();
			rand = selectfrom(parseInt(b),parseInt(a));
		}
	}
	function selectfrom (lowValue,highValue){
		var choice=highValue-lowValue+1;
		return Math.floor(Math.random()*choice+lowValue);
	}

</script>

<?php include templates("index","footer");?>