<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<style>
.busytime i{
	color: #fff;
	font-size: 15px;
	line-height: 30px;
	background: #ca1b38;
	border-radius: 3px;
	padding: 5px;
}
.b_pink span.shi {
width: 75px;
height: 20px;
float: left;
font-size: 16px;
font-weight: bold;
color: #ca1b38;
font-family: "宋体";
}
</style>
<div class="wrap w1200"style="overflow:hidden;margin-top:5px;">
<div class="Current_nav"><a href="<?php echo WEB_PATH; ?>">首页</a> &gt; 最新揭晓</div>
<!--开奖列表开始-->

<div class="Newpublish">
	<div class="W-left fl" style="padding:0;width: 100%;">
		<div id="current" class="publish_Curtit">
			<h1 class="fl c_red">最新揭晓</h1>
			<span id="spTotalCount" style="width: 300px;float: left;">(到目前为止共揭晓商品<em class="orange" style="color: #22AAFF;"><?php echo $total; ?></em>件)</span>
			<?php if($total>$num): ?>
					<div class="pagesx" style="margin: 5px 0;"><?php echo $page->show('two'); ?></div>
			<?php endif; ?>
		</div>
		<div class="publishBor">
			<div class="publishCen" id="listDivTitle" style="width: 100%;">
				<!-- <ul id="ProductList"> -->
				<ul id="b_pink">
					<style>
						.publishCen li{border: 1px solid #e4e4e4;}
					</style>
					<?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
                    <?php 
                    	$qishu['q_user'] = unserialize($qishu['q_user']);
                     ?>
                    <?php $tiezi=$this->DB()->GetList("select * from `@#_member` where `uid`=$qishu[q_uid]",array("type"=>1,"key"=>'',"cache"=>0)); ?>
                    <?php $ln=1;if(is_array($tiezi)) foreach($tiezi AS $tz): ?>
					<li class="Cursor b_pink" style="position: relative;">
						<a class="fl goodsimg" href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" >
						<img alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>">
						</a>
						<div class="publishC-Member gray02"><a style="position: absolute;right: 2px;top: 2px;" class="fl headimg" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>" target="_blank" >
							
							<img style="border-radius: 50px;" id="imgUserPhoto" src="<?php if($tz['img']!='photo/member.jpg'): ?>
								<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz['img']; ?>
							<?php elseif ($tz['headimg']!=''): ?>
								<?php echo $tz['headimg']; ?>
							<?php  else: ?>
								<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz['img']; ?>
							<?php endif; ?>" width="50" height="50" border="0"/>
							
							</a>
							<p style="margin-left: 0px;width: 195px;">获得者：<a class="blue Fb" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>" target="_blank"><?php echo get_user_name($qishu['q_user']); ?></a></p>
							<p style="margin-left: 0px;width: auto;">云购：<em class="c_red Fb"><?php echo get_user_goods_num($qishu['q_uid'],$qishu['id']); ?></em>人次</p>					
						</div>
						<div class="publishC-tit">
							<h3><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="gray01">(第<?php echo $qishu['qishu']; ?>期)<?php echo $qishu['title']; ?></a></h3>
							<p style="margin-bottom: 5px;" class="money">商品价值：<span class="rmb"><?php echo $qishu['money']; ?></span></p>
							<p class="Announced-time gray02">揭晓时间：<?php echo microt($qishu['q_end_time'],'r'); ?></p>
						</div>
						<div class="details bg_pink">
							<p class="fl details-Code">幸运云购码：<em class="c_red Fb"><?php echo $qishu['q_user_code']; ?></em></p>
							<a class="fl details-A c_red" href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" rel="nofollow" target="_blank">查看详情</a>
							
						</div>
					</li>	
					<?php  endforeach; $ln++; unset($ln); ?>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
			<?php if($total>$num): ?>
					<div class="pagesx"><?php echo $page->show('two'); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<!--
	<div class="W-right fr" style="width:235px;border:none">
		<div class="Newpublishbor b_gray">
			<div class="Rtitle gray01">TA们正在云购 </div>
			<div class="Rcenter buylistH">
				<ul id="buyList" style="margin-top: 0px;">
					<?php $ln=1;if(is_array($member_record)) foreach($member_record AS $record): ?>
					<li><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($record['uid']); ?>" target="_blank" class="pic">						
						<?php if(userid($record['uid'],'img')==null): ?>
						<img src="<?php echo G_TEMPLATES_STYLE; ?>/images/prmimg.jpg" width="50" height="50" />
						<?php  else: ?>
						<img id="imgUserPhoto" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo userid($record['uid'],'img'); ?>" width="50" height="50" border="0"/>
						<?php endif; ?>	
						</a>
						<p class="Rtagou"><a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($record['uid']); ?>" target="_blank"><?php echo userid($record['uid'],'username'); ?></a>刚刚夺得了</p>
						<p class="Rintro"><a class="gray01" href="<?php echo WEB_PATH; ?>/goods/<?php echo $record['shopid']; ?>" target="_blank"><?php echo _strcut($record['shopname'],28); ?></a></p>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
		</div>
		<div class="blank10"></div>
		<div class="Newpublishbor b_gray">
			<div class="Rtitle gray01">人气排行 </div>
			<div class="Rcenter RcenterPH">
				<ul class="RcenterH" id="RcenterH">						
					<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $list): ?>
					<li>
						<div name="simpleinfo">
							<span class="pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $list['id']; ?>" target="_blank">
							<?php if(shopimg($list['id'])!=''): ?>
								<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo shopimg($list['id']); ?>">
							<?php  else: ?>
								<img src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg_30.jpg">
							<?php endif; ?>
							</a></span>
							<p class="Rintro gray01"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $list['id']; ?>" target="_blank"><?php echo _strcut($list['title'],28); ?></a></p>
							<p><i>剩余人次</i><em><?php echo $list['zongrenshu']-$list['canyurenshu']; ?></em></p>
						</div>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
		</div>
	</div>
	-->
	<div class="clear"></div>
</div>
	</div>
<script type="text/javascript">
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
</script>
<?php include templates("index","footer");?>