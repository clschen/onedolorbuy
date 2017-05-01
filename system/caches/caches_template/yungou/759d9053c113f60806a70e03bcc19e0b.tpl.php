<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><div class="Progress-bar">

				<p title="已完成<?php echo percent($item['canyurenshu'],$item['zongrenshu']); ?>"><span class="jindu_t" style="width:<?php echo percent($item['canyurenshu'],$item['zongrenshu']); ?>; display:inline-block;"></span></p>

				<ul class="Pro-bar-li">

					<li class="P-bar01"><em><?php echo $item['canyurenshu']; ?></em>已参与人次</li>

					<li class="P-bar02"><em id="CodeQuantity"><?php echo $item['zongrenshu']; ?></em>总需人次</li>

					<li class="P-bar03"><em id="CodeLift"><?php echo $syrs; ?></em>剩余人次</li>

				</ul>

			</div>

		

			<?php if($item['shenyurenshu']=='0' && $item['xsjx_time']=='0' && empty($item['q_uid'])): ?>               

                <div class="Immediate">

                  <span style="left:10px;right:0px;">这个商品未揭晓成功,请联系客服手动揭晓！</span>  

                </div>             

			<?php endif; ?>

			

			 <!-- 限时揭晓 -->

            <?php if($item['xsjx_time']!='0'): ?>

            <div id="divAutoRTime" class="Immediate">

			            <span><a class="orange" target="_blank" href="#">限时揭晓的规则？</a></span>

                        <i id="timeall" endtime="<?php echo date("m-d-Y H:i:s",$item['xsjx_time']); ?>" lxfday="no"></i>		                           

			</div>

            <script type="text/javascript">			

			function lxfEndtime(xsjx_time_shop,this_time){	

				if(!this.xsjx_time_shop){

					this.xsjx_time_shop = xsjx_time_shop;	

					this.this_time		= this_time

				}

				this.this_time = this.this_time + 1000;

				lxfEndtime_setTimeout  = window.setTimeout("lxfEndtime()",1000);				

				var endtime = <?php echo $item['xsjx_time']; ?>000;

			    var youtime = endtime - this.this_time;	   	   //还有多久(毫秒值)

				

				var seconds = youtime/1000;

				var minutes = Math.floor(seconds/60);

				var hours = Math.floor(minutes/60);

				var days = Math.floor(hours/24);

				var CDay= days;

				var CHour= hours % 24;

				var CMinute= minutes % 60;

				var CSecond= Math.floor(seconds%60);//"%"是取余运算，可以理解为60进一后取余数，然后只要余数							

				this.xsjx_time_shop.html("<b>限时揭晓</b><p>剩余时间：<em>"+days+"</em>天<em>"+CHour+"</em>时<em>"+CMinute+"</em>分<em>"+CSecond+"</em>秒</p>");

				delete youtime,seconds,minutes,hours,days,CDay,CHour, CMinute, CSecond;

				if(endtime <= this.this_time){			

					lxfEndtime_setTimeout && clearTimeout(lxfEndtime_setTimeout);					

					this.xsjx_time_shop.html("<b>限时揭晓</b><p>正在计算中....</p>");//如果结束日期小于当前日期就提示过期啦	

					xsjx_time_shop = this.xsjx_time_shop;

					$.ajaxSetup({

						async : false

					});

					$.post("<?php echo WEB_PATH; ?>/go/autolottery/autolottery_ret_install",{"shopid":<?php echo $item['id']; ?>},function(data){		

						

						if(data == '-1'){

							xsjx_time_shop.html("<b>限时揭晓</b><p>没有这个商品!</p>");

							return;

						}

						if(data == '-2'){

							xsjx_time_shop.html("<b>限时揭晓</b><p>商品揭晓失败!</p>");

							return;

						}

						if(data == '-3'){							

							xsjx_time_shop.html("<b>限时揭晓</b><p>商品参与人数为0，商品不予揭晓!</p>");

							return;

						}

						if(data == '-4'){

							xsjx_time_shop.html("<b>限时揭晓</b><p>商品还未到揭晓时间!</p>");

							return;

						}

						if(data == '-5'){

							xsjx_time_shop.html("<b>限时揭晓</b><p>商品揭晓时间已过期!</p>");

							return;

						}if(data == '-6'){							

							 xsjx_time_shop.html("<b>限时揭晓</b>商品正在揭晓中!");								

							 window.location.href=location.href;

							 return;

						}else{							

							xsjx_time_shop.html("<b>限时揭晓</b><p>揭晓幸运码:<i style='color:#fff;background:#22AAFF; padding:3px 5px;'>"+data+"</i></p>");						

							return;

						}						

						

					});

				}							

			  }			  

			 $(function(){lxfEndtime($("#timeall"),<?php echo time(); ?>000);});

			</script>

            <?php endif; ?>			

			<!-- 限时揭晓end -->

			

			<!--
			<p class="Pro_Detsingle" style="font-size:14px;">云购价格111：<b style="color:#999;"><?php echo $item['yunjiage']; ?></b></p>
			-->
			<div id="divNumber" class="Pro_number" style="height: 30px;">
				<style type="text/css">
					#divNumber .label{
						border:1px solid #e4e4e4;
					}
					#divNumber .label:hover{
						border:1px solid #22AAFF;
					}
				</style>
				<div style="float: left;line-height: 30px;margin-right: 5px;">我要参与 </div>
				<div style="border-radius: 18px;float: left;width: 120px;border:1px solid #e4e4e4;height: 26px;margin-right: 10px;">
				<a style="text-indent: 5px;cursor:pointer;" href="javascript:;" class="num_del num_ban" id="shopsub">-</a>

				<input style="border:1px solid #e4e4e4;border-top: none;border-bottom: none;color: #333;font-weight: 400;" type="text" value="1" maxlength="7" onKeyUp="value=value.replace(/\D/g,'')" class="num_dig" id="num_dig"/>

				<a href="javascript:;" class="num_add" id="shopadd">+</a> 
				</div>
				
				<div class="biaoqianS" style="float: left;color: #333;text-align: center;line-height: 28px;font-size: 14px;position: relative;">
					<ul>
						<style type="text/css">
							li:hover{color: #22AAFF;}
							span:hover{color: #22AAFF;}
							.label{
								height: 28px;width: 50px;border-radius: 10px;float: left;margin: 0 6px;cursor: pointer;
								position: relative;
							}
							#baowei{
								border:none!important;
							}
							.baowei{
								left: 0px;
								top: -8px;
							}
							.wy{
								border-radius: 10px;
							    cursor: pointer;
							    float: left;
							    height: 28px;
							    margin: 0 6px;
							    position: relative;
							    width: 50px;
							    border: 1px solid #dcdcdc;
							    background: #ccc;
							}
						</style>
							<?php if($syrs>199 ): ?>
								<li class="label" data-val="10">10</li>
								<li class="label" data-val="50">50</li>
								<li class="label" data-val="100">100</li>
								<li class="label" data-val="200">200</li>
								<li class="label" data-val="<?php echo $syrs; ?>" id="baowei"><div class="baowei">包尾</div></li>
							<?php elseif ($syrs>99): ?>
								<li class="label" data-val="10">10</li>
								<li class="label" data-val="50">50</li>
								<li class="label" data-val="100">100</li>
								<div class="wy">200</div>
								<li class="label" data-val="<?php echo $syrs; ?>" id="baowei"><div class="baowei">包尾</div></li>
							<?php elseif ($syrs>49): ?>
								<li class="label" data-val="10">10</li>
								<li class="label" data-val="50">50</li>
								<div class="wy">100</div>
								<div class="wy">200</div>
								<li class="label" data-val="<?php echo $syrs; ?>" id="baowei"><div class="baowei">包尾</div></li>
							<?php elseif ($syrs>9): ?>
								<li class="label" data-val="10">10</li>
								<div class="wy">50</div>
								<div class="wy">100</div>
								<div class="wy">200</div>
								<li class="label" data-val="<?php echo $syrs; ?>" id="baowei"><div class="baowei">包尾</div></li>
							<?php elseif ($syrs>0): ?>
								<div class="wy">10</div>
								<div class="wy">50</div>
								<div class="wy">100</div>
								<div class="wy">200</div>
								<li class="label" data-val="<?php echo $syrs; ?>" id="baowei"><div class="baowei">包尾</div></li>
							<?php endif; ?>
						<script type="text/javascript">
							$(".biaoqianS li").on("click",function(){
							    var num = $(this).data("val");
							    $("#num_dig").val(num);
							});
						</script>
					</ul>
				</div>

			</div>

			<div style="display:none;" id="hqid"><?php echo $item['id']; ?></div>

			<div id="divBuy" class="Det_button">

				<a href="javascript:;" class="Det_Shopbut">立即1元云购</a>

				<a href="javascript:;" class="Det_Cart"><i></i>加入购物车</a>							

			</div>