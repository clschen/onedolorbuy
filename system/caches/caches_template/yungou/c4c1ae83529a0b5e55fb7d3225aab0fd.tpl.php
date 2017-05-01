<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header1");?> 
<?php if($ad_area): ?> 
    <?php include templates("ad","couplet");?> 
<?php endif; ?>
<!--banner 开始-->
<div class="banner w1200">
    <div class="banner_box b_gray" style="border-top:0;">
        <div style="width: 700px; margin-left: 0px; height: 460px; float: left;">
            <?php $slides=$this->DB()->GetList("select * from `@#_slide` where 1",array("type"=>1,"key"=>'',"cache"=>0)); ?>
            <div id="fsD1" class="focus" style="height: 300px;">
                <div id="D1pic1" class="fPic">
                    <?php $ln=1;if(is_array($slides)) foreach($slides AS $slide): ?> <?php if($ln == 1): ?>
                    <div class="fcon">
                        <a href="<?php echo $slide['link']; ?>" target="_blank">
                            <img style="opacity: 1;" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a>
                    </div>
                    <?php  else: ?>
                    <div class="fcon" style="display: none;">
                        <a href="<?php echo $slide['link']; ?>" target="_blank">
                            <img style="opacity: 1;" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a>
                    </div>
                    <?php endif; ?> <?php  endforeach; $ln++; unset($ln); ?>
                </div>
                <div class="fbg">
                    <div class="D1fBt" id="D1fBt">
                        <a href="javascript:void(0)" hidefocus="true" target="_self" class="current"></a>
                        <a href="javascript:void(0)" hidefocus="true" target="_self" class=""></a>
                        <a href="javascript:void(0)" hidefocus="true" target="_self" class=""></a>
                        <a href="javascript:void(0)" hidefocus="true" target="_self" class=""></a>
                        <a href="javascript:void(0)" hidefocus="true" target="_self" class=""></a>
                    </div>
                </div>
                <span class="prev"></span>
                <span class="next"></span>
            </div>
            <div class="lb_x2">
                <?php $ln=1;if(is_array($tj_shop)) foreach($tj_shop AS $new1): ?>
                <li class="list-block1" style="position: relative;">
                    <div class="pic" style="height: 120px;width: 120px;float:left;">
                        <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new1['id']; ?>" target="_blank">
                            <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $new1['thumb']; ?>"></a>
                    </div>
                    <p class="name" style="width: 180px;margin-bottom: 10px;margin-top: 10px;line-height: 20px;overflow: hidden;height: 40px;">
                        <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new1['id']; ?>" target="_blank"><?php echo $new1['title']; ?></a>
                    </p>
                    <p class="money" style="margin-bottom: 10px;">
                        已参与：
                        <span class="rmb" style="color: ##22AAFF;"><?php echo $new1['canyurenshu']; ?></span>
                    </p>
                    <p class="money">
                        剩余：
                        <span class="rmb" style="color: ##22AAFF;"><?php echo $new1['shenyurenshu']; ?></span>
                    </p> <i class="sy_tj">推荐</i>
                </li>
                <?php  endforeach; $ln++; unset($ln); ?>
               
				<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
					<div class="list-block1">
				<ul>
					<li class="fr1" style="float:right; position:relative;">
						<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" title="<?php echo $renqi['title']; ?>"  target="_blank">
							<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" alt="<?php echo $renqi['title']; ?>"></a>
						<span id="tuijian">推荐</span>
					</li>
					<li class="fr2">
						<span class="span">
							<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank"><?php echo $renqi['title']; ?></a>
						</span>
						<div class="Progress-bar" style="margin-left: 10px;">
							<!--<p title="已完成<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>">
								<span style="width:<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>"></span>
							</p>-->
							<ul class="Pro-bar-li">
								<li class="P-bar01">
								<span style="float:left;padding-right:10px;">已参与</span>
								<em class="c_red" style=" margin-top:-2px;"><?php echo $renqi['canyurenshu']; ?></em>
									
								</li>
								<!--<li class="P-bar02"> <em><?php echo $renqi['zongrenshu']; ?></em>
									总需
								</li>-->
								<li class="P-bar03" style="float:left; margin-top:30px; margin-left:-62px;">
								<span style="float:left;padding-right:10px;">剩余</span>
									<em style=" margin-top:-2px; color:##22AAFF">
									<?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>
									
								</li>
							</ul>
						</div>
						<!--<div class="duobao">
							<a style="color: #fff;" href="javascript:;" class="Det_Shopnow" onclick="jwebox.goshopnow(<?php echo $renqi['id']; ?>,'<?php echo WEB_PATH; ?>')">立即一元云购</a>
						</div>-->

					</li>
				</ul>
			</div>
			<?php  endforeach; $ln++; unset($ln); ?>
			
            </div>
        </div>
        <div class="banner_boxR fr">
            <div class="m_login bb_gray">
                <a href="<?php echo WEB_PATH; ?>/single/newbie" target="_blank">
                    <img src="<?php echo G_TEMPLATES_STYLE; ?>/images/index-come.gif" height="108" width="208"></a>
            </div>
            <div class="m_app bb_gray">
                <ul>
                    <li> <i class="i1"></i> 诚信网站
                    </li>
                    <li>
                        <i class="i2"></i> 可信网站
                    </li>
                    <li>
                        <i class="i3"></i> 电商诚信
                    </li>
                    <li>
                        <i class="i4"></i> 安信宝
                    </li>
                    <li>
                        <i class="i5"></i> 监督管理局
                    </li>
                    <li>
                        <i class="i6"></i> 更多
                    </li>
                </ul>
            </div>
            <div class="m_news">
                <div class="m_newsT bb_gray">
                    <p class="notice c_red">官方公告</p>
                </div>
                <?php $tiezi=$this->DB()->GetList("select * from `@#_article` where 1 AND cateid = 142 order by posttime DESC limit 0,4",array("type"=>1,"key"=>'',"cache"=>0)); ?>
                <div class="m_newsM">
                    <div class="m_newsML">
                        <?php $ln=1;if(is_array($tiezi)) foreach($tiezi AS $tz): ?>
                        <a href="<?php echo WEB_PATH; ?>/help/<?php echo $tz['id']; ?>" target="_blank"><?php echo $tz['title']; ?></a> <?php  endforeach; $ln++; unset($ln); ?>
                    </div>
                    <div class="m_newsMR">
                        <?php $ln=1;if(is_array($tiezi)) foreach($tiezi AS $tz): ?>
                        <p><?php echo date("m月d日",$tz['posttime']); ?></p>
                        <?php  endforeach; $ln++; unset($ln); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<!--prin_pp 开始-->
<style>
.bs:hover {
    text-decoration: underline;
}
</style>
<div style="height: 36px;line-height: 36px;padding: 10px 0;font-size: 22px;width: 1201px;margin: 0 auto;">
    <i style="height: 22px;line-height: 22px;border-left: 4px solid ##22AAFF;margin-right: 7px;"></i> 最新揭晓
    <span style="color: #999;line-height: 36px;font-size: 14px;display: inline-block;padding-left: 5px;top: 2px;position: relative;">
	截至目前共揭晓商品
	<em style="color: ##22AAFF;"><?php echo $total; ?></em>
	个
</span>
    <div style="float: right;color: ##22AAFF;font-size: 14px;">
        <em class="gzwx_wx"></em>
        <a class="bs" href="<?php echo G_WEB_PATH; ?>/weixin/index.html" style="color: ##22AAFF;">关注<?php echo _cfg("web_name"); ?>官方微信，随时随地云购！</a>
    </div>
</div>
<div class="prin_pp w1222" style="margin-top:10px;height: 334px;overflow: hidden;text-align: center;">
    <ul id="prin_pp">
        <?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $sq): ?>
        <li class="b_gray">
            <div style="border: 4px solid #ffe9c7;height: 324px;overflow: hidden;">
                <div style="padding:10px;height: 304px;position: relative;">
                    <div class="w_goods_pic">
                        <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $sq['id']; ?>" target="_blank">
                            <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sq['thumb']; ?>"></a>
                    </div>
                    <div class="print">
                        <p>
                            恭喜用户：
                            <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sq['q_user']['uid']); ?>" target="_blank" class="c_red">
							<?php if($sq['q_user']['username']!=null): ?>
						<?php echo $sq['q_user']['username']; ?>
					<?php elseif ($sq['q_user']['mobile']!=null): ?>
						<?php echo $sq['q_user1']; ?>
					<?php  else: ?>
						<?php echo $sq['q_user2']; ?>
					<?php endif; ?>
						</a>
                        </p>
                        <p>
                            花费：
                            <span class="c_red"><?php echo $sq['touzi']; ?></span> 云购币，价值:￥
                            <span class="c_red"><?php echo $sq['jiazhi']; ?></span>
                        </p>
                        <a style="display: block;overflow: hidden;height: 35px;" href="<?php echo WEB_PATH; ?>/goods/<?php echo $sq['id']; ?>" target="_blank">
                            <p class="c_black">(第<?php echo $sq['qishu1']; ?>期)<?php echo _strcut($sq['title'],56); ?></p>
                        </a>
                        <a class="cydb_ca" href="<?php echo WEB_PATH; ?>/goods/<?php echo $sq['id']; ?>" target="_blank"></a>
                        <!--
                        <p class="mt30" style="margin-top:5px;">
                            回报率：
                            <span class="c_red t18"><?php echo $sq['rate']; ?></span> 倍
                        </p>
                        -->
                    </div>
                </div>
            </div>
        </li>
        <?php  endforeach; $ln++; unset($ln); ?>
    </ul>
    <script>
    var APP = {
        WEB_PATH: '<?php echo WEB_PATH; ?>',
        G_WEB_PATH: '<?php echo G_WEB_PATH; ?>',
        G_PARAM_URL: '<?php echo G_PARAM_URL; ?>'
    };
    </script>
    <script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery.BusyTime.js"></script>
    <script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery.cmsapi.js"></script>
    <style>
    .busytime i {
        color: #fff;
        font-size: 15px;
        line-height: 31px;
        background: #ca1b38;
        border-radius: 3px;
        padding: 2px;
    }
    .b_gray{
        position:relative;
    }
    .zd_1{border: 4px solid #ffe9c7;height: 304px;overflow: hidden;padding:10px;}
    .zd_2{display: block;height: 18px;overflow: hidden;}
    </style>
   <script>
    $.YunCmsApi.Loop({
        "timer"   : 15000,
        "callback": function(data){
            var path='<?php echo WEB_PATH; ?>';
            var html= '';   
            html+= '<li class="b_gray" style="position:relative;" id="timeloop'+data.id+'">';   
            html+= '<div style="border: 4px solid #ffe9c7;height: 304px;overflow: hidden;padding:10px;">';  
            
            html+= '<div class="w_goods_pic">'; 
            html+= '<a href="'+path+'/dataserver/'+data.id+'" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/'+data.thumb+'"></a>';
            html+= '</div>';
            html+= '<div class="print" style="margin:0;">';      
            html+= '<p>用户：<a  href="'+path+'/dataserver/'+data.id+'" target="_blank" class="c_red">马上揭晓</a></p>';       
            html+= '<p>花费：<a  href="'+path+'/dataserver/'+data.id+'" target="_blank" class="c_red">马上揭晓</a></p>';   
            html+= '<a style="display: block;height: 18px;overflow: hidden;" href="'+path+'/dataserver/'+data.id+'" target="_blank"><p class="c_black">(第'+data.qishu+'期)'+data.title+'</p></a>'; 
            html+= '<p style="margin-top:5px;background-color:#22AAFF;color:#fff;text-align:center;" class="mt30"><span style="font-size:14px;line-height:30px;">揭晓倒计时：</span><span class="shi"><span class="busytime" pattern="<i>mm</i><em>&nbsp:&nbsp</em><i>ss</i><em>&nbsp:&nbsp</em><i>ms</i>" time="'+(new Date().getTime() + (data.times * 1000)) +'">99 : 99 : 99</span></p>';    
                                    
            html+= '</div>';
            html+= '</div>';
            html+= '<div class="zzjx_110"></div>';
            html+= '</li>'; 
            var divl = $("#prin_pp").find('li');
            var len = divl.length;          
            if(len==3 && len  >0){
                var this_len = len - 1;
                divl.eq(this_len).remove();
            }           
            $("#prin_pp").prepend(html);
            $("#timeloop"+data.id+" .busytime").busytime({
                callback:function($dom){
                    $dom.find(".shi").html('<span class="minute">正在计算,请稍后…</span>');
                    setTimeout(function(){
                    $.post(path+'/api/getshop/lottery_shop_getjson/',{gid:data.id},function(info){
                        var uhtml = '';     
                        uhtml+= '<div style="border: 4px solid #ffe9c7;height: 324px;overflow: hidden;">';
                        uhtml+= '<div style="padding:10px;height: 304px;position: relative;">';
                        uhtml+= '<div class="w_goods_pic">';    
                        uhtml+= '<a href="'+path+'/dataserver/'+info.id+'" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/'+info.thumb+'"></a>';
                        uhtml+= '</div>';
                        uhtml+= '<div class="print">';
                        	uhtml+= '<p>恭喜用户：<a href="'+path+'/uname/'+(1000000000 + parseInt(info.uid))+'"  target="_blank" class="c_red">'+info.user+'</a></p>';
                        uhtml+= '<p>花费：<span class="c_red">'+info.huafei+'</span>云购币，价值:￥&nbsp<span class="c_red"><?php echo $sq['jiazhi']; ?></span></p>';    
                        uhtml+= '<a style="display: block;height: 35px;overflow: hidden;" href="'+path+'/dataserver/'+info.id+'" target="_blank"><p class="c_black">'+info.qishu+info.title+'</p></a>' ;   
                        uhtml+='<a class="cydb_ca" href="<?php echo WEB_PATH; ?>/goods/<?php echo $sq['id']; ?>" target="_blank"></a>';
                        uhtml+= '<p class="mt30" style="margin-top:5px;display: none;">回报率：<span class="c_red t18">'+info.huibaolv+'</span> 倍</p>';
                                
                        uhtml+= '</div>';
                        uhtml+= '</div>';
                        html+= '</div>';
                        $("#timeloop"+data.id).html(uhtml);                 
                    },'json');
                    },5000);
                }
            }).start();     
            
        }
    });
    </script>  
</div>
<!--prin_pp 结束-->
<div class="clear"></div>
<!--goods_hot 开始-->
<div class="goods_hot bt2_red w1200" style="margin-top:10px;">
    <div class="goods_hotL fl b_gray" style="border-top:0;margin-right:-1px;">
        <div class="title bb_gray br_gray" style="width:249px;">
            <p class="c_red">如何开始？</p>
        </div>
        <ul class="step">
            <li>
                <h1 class="c_red">首先</h1>
                <p>注册账号，挑选喜欢的奖品</p>
            </li>
            <li>
                <h1 class="c_red">然后</h1>
                <p>支付云购币参与云购，每一个云购币可参与一次云购</p>
            </li>
            <li>
                <h1 class="c_red">最后</h1>
                <p>等待开奖，系统根据规则计算出一个幸运号码，持有该号码的用户，直接获得奖品</p>
            </li>
        </ul>
        <a href="<?php echo WEB_PATH; ?>/help/1" class="more c_red" target="_blank">更多新手指南&gt;&gt;</a>
        <div class="title bb_gray bt_red">
            <p class="c_red">正在云购</p>
        </div>
        <ul class="user">
            <?php $ln=1;if(is_array($go_record)) foreach($go_record AS $gorecord): ?>
            <?php $tiezi1=$this->DB()->GetList("select * from `@#_member` where `uid`=$gorecord[uid]",array("type"=>1,"key"=>'',"cache"=>0)); ?>
                    <?php $ln=1;if(is_array($tiezi1)) foreach($tiezi1 AS $tz1): ?>
            <li class="bb_gray" style="margin: 8px 0 0;">
                
                <a class="fl" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" target="_blank">
				<?php if($tz1['img']!='photo/member.jpg'): ?>
				<img style="border-radius: 50px;margin-bottom: 5px;margin-top: 5px;" class="mt10 mb10" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz1['img']; ?>"  height="58" width="58" />
				<?php elseif ($tz1['headimg']!=''): ?>
				<img style="border-radius: 50px;margin-bottom: 5px;margin-top: 5px;" class="mt10 mb10" src="<?php echo $tz1['headimg']; ?>"  height="58" width="58" />
                <?php  else: ?>
                <img style="border-radius: 50px;margin-bottom: 5px;margin-top: 5px;" class="mt10 mb10" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz1['img']; ?>"  height="58" width="58" />
				<?php endif; ?>
			</a>
                <p style="margin-top: 0;margin-left: 65px;">
                    <a style="color: #2af;font-weight: normal;" class="c_yellow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" target="_blank"><?php echo get_user_name($gorecord); ?></a> <!--&nbsp;于<?php echo _put_time($gorecord['time']); ?>-->
                </p>
                <div class="fl li_r"  style="margin-top: 5px;margin-left: 7px;">
                    <!--<p>
				花费
				<span class="c_red"><?php echo $gorecord['gonumber']; ?></span>
				人次
			</p>
			-->
                    <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>" target="_blank">
                        <span style="color: #6b6b6b; font-weight: normal;" class="c_red"><?php echo $gorecord['shopname']; ?></span>
                    </a>
                    <!--<p style="margin-top:-2px;">总需：<?php echo $gorecord['zongrenshu']; ?> 人次</p>
		-->
                </div>
            </li>
            <?php  endforeach; $ln++; unset($ln); ?>

            <?php  endforeach; $ln++; unset($ln); ?>
        </ul>
        <a href="<?php echo WEB_PATH; ?>/goods_lottery" class="more" target="_blank" style="line-height: 46px;">看看还有谁中奖了！</a>
    </div>
    <div class="goods_hotR fl">
        <div class="title bb_gray br_gray">
            <p>热门推荐</p>
        </div>
        <ul class="hot_list">
            <?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
            <li class="list-block">
                <div class="pic">
                    <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" title="<?php echo $renqi['title']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" alt="<?php echo $renqi['title']; ?>"></a>
                </div>
                <p class="name">
                    <a "<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank"><?php echo $renqi['title']; ?></a>
                </p>
                <p class="money">
                    价值：
                    <span class="rmb"><?php echo $renqi['money']; ?></span> 云购币
                </p>
                <div class="Progress-bar" style="">
                    <p style="height: 5px;" title="已完成<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>">
                        <span style="height:6px;width:<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>"></span>
                    </p>
                    <ul class="Pro-bar-li">
                        <li class="P-bar01">
                            <em class="c_red"><?php echo $renqi['canyurenshu']; ?></em> 已参与人次
                        </li>
                        <li class="P-bar02">
                            <em><?php echo $renqi['zongrenshu']; ?></em> 总需人次
                        </li>
                        <li class="P-bar03">
                            <em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em> 剩余人次
                        </li>
                    </ul>
                </div>
                <div class="w-goods-ing">
                    <div class="shop_buttom bg_red b_red1">
                        <!--
						<a href="javascript:;" class="Det_Shopnow" onclick="jwebox.goshopnow(<?php echo $renqi['id']; ?>,'<?php echo WEB_PATH; ?>')">立即1元云购</a>
		-->
                        <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" title="<?php echo $renqi['title']; ?>" target="_blank" class="Det_Shopnow">立即1元云购</a>
                    </div>
                </div>
            </li>
            <?php  endforeach; $ln++; unset($ln); ?>
        </ul>
        <div class="catalog b_gray" style="border-left:0;float:left;width:950px;height:87px;margin-top:-1px;">
            <div class="fr" style="height: 35px;overflow: hidden;margin-top: 28px;">
                <?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order` ASC",array("type"=>1,"key"=>'',"cache"=>0)); ?> <?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>
                <a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>"><?php echo $categoryx['name']; ?></a> <?php  endforeach; $ln++; unset($ln); ?> <?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
            </div>
        </div>
    </div>
</div>
<!--goods_hot 结束-->
<div class="clear"></div>
<!--即将揭晓 get_ready 开始-->
<div class="get_ready w1200" style="margin-top:10px;">
    <div class="title br_gray bl_gray bb_gray bt2_red">
        <p class="c_red t16">即将揭晓</p>
    </div>
    <ul>
        <?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
        <li class="list-block">
            <div class="pic">
                <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank">
                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"></a>
            </div>
            <p class="name">
                <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank"><?php echo $shop['title']; ?></a>
            </p>
            <p class="money">
                价值：
                <span class="rmb"><?php echo $shop['money']; ?></span>
            </p>
            <div class="Progress-bar" style="">
                <p style="height: 5px;border-radius:5px;" title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>">
                    <span style="height:6px;border-radius:6px;width:<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>;"></span>
                </p>
                <ul class="Pro-bar-li">
                    <li class="P-bar01">
                        <em class="c_red"><?php echo $shop['canyurenshu']; ?></em> 已参与人次
                    </li>
                    <li class="P-bar02">
                        <em><?php echo $shop['zongrenshu']; ?></em> 总需人次
                    </li>
                    <li class="P-bar03">
                        <em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em> 剩余人次
                    </li>
                </ul>
            </div>
            <div class="w-goods-ing" style="margin: 5px auto; width: 84%;">
                <div class="shop_buttom bg_red b_red1" style="">
                    <!--
					<a href="javascript:;" style="font-size:14px;" class="Det_Shopnow" onclick="jwebox.goshopnow(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>')">立即1元云购</a>
-->
                    <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" style="font-size:14px;" class="Det_Shopnow">立即1元云购</a>
                </div>
                <div class="shop_buttom1 bg_pink b_pink c_red" style="width:60px;height:35px;margin-left: 10px;">
                    <a class="c_red" href="javascript:;" onclick="gcartlist.gocartlist(<?php echo $shop['id']; ?>,'<?php echo WEB_PATH; ?>','wc_')" style="line-height:30px;font-size:14px;"></a>
                </div>
            </div>
        </li>
        <?php  endforeach; $ln++; unset($ln); ?>
    </ul>
</div>
<!--即将揭晓 get_ready 结束-->
<div class="clear"></div>
<!--新品上架 new_goods 开始-->
<div class="new_goods w1200" style="margin-top:10px;">
    <div class="title br_gray bl_gray bb_gray bt2_green">
        <p class="c_green t16">新品上架</p>
    </div>
    <ul>
        <?php $ln=1;if(is_array($new_shop)) foreach($new_shop AS $new): ?>
        <li class="list-block">
            <div class="pic">
                <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new['id']; ?>" target="_blank">
                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $new['thumb']; ?>"></a>
            </div>
            <p class="name">
                <a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new['id']; ?>" target="_blank"><?php echo $new['title']; ?></a>
            </p>
            <p class="money">
                价值：
                <span class="rmb"><?php echo $new['money']; ?></span>
            </p>
        </li>
        <?php  endforeach; $ln++; unset($ln); ?>
    </ul>
    <div class="check_out b_gray">
        <a href="<?php echo WEB_PATH; ?>/goods_list" target="_blank">查看更多</a>
    </div>
</div>
<!--新品上架 new_goods 结束-->
<div class="clear"></div>
<!--lottery_show 晒单分享-->
<div class="lottery_show w1200" style="margin-top:10px;display: none;">
    <div class="title br_gray bl_gray bt2_orange">
        <p class="c_orange t16">晒单管理</p>
    </div>
    <div class="share_show">
        <?php $ln=1;if(is_array($shaidan)) foreach($shaidan AS $sd): ?>
        
        <div class="singleL">
            <dl>
                <dt>
                    <a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a>
                </dt>
                <dd class="u_user">
                    <p class="u_head">
                        <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($sd['sd_userid']); ?>">
                        
        <?php $tiezi=$this->DB()->GetList("select * from `@#_member` where `uid`=$sd[sd_userid]",array("type"=>1,"key"=>'',"cache"=>0)); ?>
                    <?php $ln=1;if(is_array($tiezi)) foreach($tiezi AS $tz): ?>
		          <?php if($tz['img']!='photo/member.jpg'): ?>
        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz['img']; ?>" />
        <?php elseif ($tz['headimg']!='' ): ?>
        <img id="imgUserPhoto" src="<?php echo $tz['headimg']; ?>"  border="0"/>
        <?php  else: ?>
        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $tz['img']; ?>" />
        <?php endif; ?>
        <?php  endforeach; $ln++; unset($ln); ?>
	</a>
                    </p>
                    <p class="u_info">
                        <span>
		<a style="max-width: 150px;" href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank"><?php echo get_user_name($sd['sd_userid']); ?></a>
		&nbsp;&nbsp;
		<em><?php echo _put_time($sd['sd_time']); ?></em>
	</span>
                        <cite>
                            <a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo _strcut($sd['sd_title'],30); ?></a>
                        </cite>
                    </p>
                </dd>
                <dd class="m_summary">
                    <cite>
                        <a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank">
                            <p><?php echo _strcut($sd['sd_content'],135); ?></p>
                        </a>
                    </cite> <b><s></s></b>
                </dd>
            </dl>
        </div>
        <?php  endforeach; $ln++; unset($ln); ?>
        <div class="singleR">
            <ul id="ul_PostList">
                <?php $ln=1;if(is_array($shaidan_six)) foreach($shaidan_six AS $sd_six): ?>
                <li>
                    <a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd_six['sd_id']; ?>" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd_six['sd_thumbs']; ?>">
                        <p><?php echo _strcut($sd_six['sd_title'],30); ?></p>
                    </a>
                </li>
                <?php  endforeach; $ln++; unset($ln); ?>
            </ul>
        </div>
    </div>
    <div class="check_out b_gray">
        <a href="<?php echo WEB_PATH; ?>/go/shaidan" target="_blank">查看更多</a>
    </div>
</div>
<!--lottery_show 晒单分享end-->
<div class="clear"></div>
<!--
<?php $res=$this->DB()->GetList("select img,link from `@#_recom` where 1 order by `id` ASC",array("type"=>1,"key"=>'',"cache"=>0)); ?>
-->
<!--topic 开始-->

<div class="topic w1200" style="margin-top:10px;">
    <div class="line bg_red"></div>
    <div class="topicAll">
        <script language="JavaScript">
       var bannerAD=new Array();
    var bannerADlink=new Array();
    var adNum=0;
    bannerAD[0]="<?php echo G_UPLOAD_PATH; ?>/<?php echo $res['0']['img']; ?>";
    bannerADlink[0]="<?php echo WEB_PATH; ?>/<?php echo $res['0']['link']; ?>";
    bannerAD[1]="<?php echo G_UPLOAD_PATH; ?>/<?php echo $res['1']['img']; ?>";
    bannerADlink[1]="<?php echo WEB_PATH; ?>/<?php echo $res['1']['link']; ?>";

var preloadedimages=new Array();
    for (i=1;i<bannerAD.length;i++){
    preloadedimages[i]=new Image();
    preloadedimages[i].src=bannerAD[i];
}

function setTransition(){
    if (document.all){
    bannerADrotator.filters.revealTrans.Transition=Math.floor(Math.random()*23);
    bannerADrotator.filters.revealTrans.apply();
    }
}

function playTransition(){
    if (document.all)
    bannerADrotator.filters.revealTrans.play()
}

function nextAd(){
    if(adNum<bannerAD.length-1)adNum++ ;
    else adNum=0;
    setTransition();
    document.images.bannerADrotator.src=bannerAD[adNum];
    playTransition();
    theTimer=setTimeout("nextAd()", 4000);
}

function jump2url(){
    jumpUrl=bannerADlink[adNum];
    jumpTarget='_blank';
    if (jumpUrl != ''){
    if (jumpTarget != '')window.open(jumpUrl,jumpTarget);
    else location.href=jumpUrl;
    }
}
function displayStatusMsg() {
    status=bannerADlink[adNum];
    document.returnValue = true;
    }

        </script>
        <div class="topicAllL fl">
            <ul class="column fl b_gray">
                <a href="javascript:jump2url()"><li onmouseover="displayStatusMsg();return document.returnValue" href="javascript:jump2url()">
                    <img src="" name="bannerADrotator" border="0" height="165" width="280" align="middle">
                  </li></a>
                <script language="JavaScript">nextAd()</script>
                <li>
                    <h1>推荐话题</h1> <?php $ln=1;if(is_array($tiezi_tuijian)) foreach($tiezi_tuijian AS $tiezi): ?>
                    <a href="<?php echo WEB_PATH; ?>/group/nei/<?php echo $tiezi['id']; ?>">•  <?php echo $tiezi['title']; ?></a> <?php  endforeach; $ln++; unset($ln); ?>
                </li>
                <li style="margin-left:10px;">
                    <h1>最新话题</h1> <?php $ln=1;if(is_array($tiezi_new)) foreach($tiezi_new AS $tiezi): ?>
                    <a href="<?php echo WEB_PATH; ?>/group/nei/<?php echo $tiezi['id']; ?>">•  <?php echo $tiezi['title']; ?></a> <?php  endforeach; $ln++; unset($ln); ?>
                </li>
            </ul>
            <ul class="columns fl b_gray" style="border-top:0">
                <?php $ln=1;if(is_array($quanzi)) foreach($quanzi AS $v): ?>
                <li>
                    <?php if($v['img']==null): ?>
                    <a href="<?php echo WEB_PATH; ?>/group/show/<?php echo $v['id']; ?>">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/quanzi/prmimg.jpg" title="<?php echo $v['title']; ?>" border="0" width="80px" height="80px"></a>
                    <?php  else: ?>
                    <a href="<?php echo WEB_PATH; ?>/group/show/<?php echo $v['id']; ?>">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $v['img']; ?>" title="<?php echo $v['title']; ?>" border="0" width="80px" height="80px"></a>
                    <?php endif; ?>
                    <div class="idea fl mt10">
                        <p><?php echo $v['title']; ?></p>
                        <p>
                            <span class="people fl"></span>
                            <span class="number fl"><?php echo $v['chengyuan']; ?></span>
                            <span class="message fl"></span>
                            <span class="number fl"><?php echo $v['tiezi']; ?></span>
                        </p>
                        <a href="<?php echo WEB_PATH; ?>/group/show/<?php echo $v['id']; ?>">申请加入</a>
                    </div>
                </li>
                <?php  endforeach; $ln++; unset($ln); ?>
            </ul>
        </div>
        <div class="topicAllR fl bb_gray br_gray">
            <h1>圈子活跃用户</h1>
            <ul>
                <?php $ln=1;if(is_array($hueifu)) foreach($hueifu AS $hf): ?>
                <?php $quanzi=$this->DB()->GetList("select * from `@#_member` where `uid`=$hf[hueiyuan]",array("type"=>1,"key"=>'',"cache"=>0)); ?>
                    <?php $ln=1;if(is_array($quanzi)) foreach($quanzi AS $qz): ?>
                <li>
                    <p>
                        <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($hf['hueiyuan']); ?>">
		<?php if($qz['img']!='photo/member.jpg'): ?>
		<img src=" <?php echo G_UPLOAD_PATH; ?>/<?php echo $qz['img']; ?>" />
		<?php elseif ($qz['headimg']!=''): ?>
		<img id="imgUserPhoto" src="<?php echo $qz['headimg']; ?>"  border="0"/>
        <?php  else: ?>
        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qz['img']; ?>" />
		<?php endif; ?>
	</a>
                    </p>
                </li>
                 <?php  endforeach; $ln++; unset($ln); ?>
                <?php  endforeach; $ln++; unset($ln); ?>
            </ul>
        </div>
    </div>
</div>


<!--topic 结束-->
<div class="clear"></div>
<script type="text/javascript">
Qfast.add('widgets', {
    path: "<?php echo G_TEMPLATES_JS; ?>/terminator2.2.min.js",
    type: "js",
    requires: ['fx']
});
Qfast(false, 'widgets', function() {
    K.tabs({
        id: 'fsD1', //焦点图包裹id
        conId: "D1pic1", //** 大图域包裹id
        tabId: "D1fBt",
        tabTn: "a",
        conCn: '.fcon', //** 大图域配置class
        auto: 1, //自动播放 1或0
        effect: 'fade', //效果配置
        eType: 'mouseover', //** 鼠标事件
        pageBt: true, //是否有按钮切换页码
        bns: ['.prev', '.next'], //** 前后按钮配置class
        interval: 3000 //** 停顿时间
    })
})
</script>
<script type="text/javascript">
$(function() {
    $(window).scroll(function() {

        if ($(window).scrollTop() >= 520) {
            $(".head_nav").addClass("fixedNav");
            $("#m_all_sort").hide();
            $(".m_menu_all").mouseenter(function() {
                $(".m_all_sort").show();
            })
            $(".m_menu_all").mouseleave(function() {
                $(".m_all_sort").hide();
            })
            $(".m_all_sort").mouseenter(function() {
                $(this).show();
            })
            $(".m_all_sort").mouseleave(function() {
                $(this).hide();
            })
        } else if ($(window).scrollTop() < 520) {
            $(".head_nav").removeClass("fixedNav");
            $("#m_all_sort").show();
            $(".m_menu_all").mouseenter(function() {
                $("#m_all_sort").show();
            })
            $(".m_menu_all").mouseleave(function() {
                $("#m_all_sort").show();
            })
            $(".m_all_sort").mouseenter(function() {
                $(this).show();
            })
            $(".m_all_sort").mouseleave(function() {
                $(this).show();
            })
        }
    });
});
$(".b_gray").mouseenter(function() {
    $(this).find(".w_goods_pic").find("img").stop().animate({
        left: "-10px"
    });
})
$(".b_gray").mouseleave(function() {
    $(this).find(".w_goods_pic").find("img").stop().animate({
        left: "0px"
    });
})
</script>
<!--晒单分享end-->
<?php if(get_user_arr()): ?> <?php  else: ?>

<?php endif; ?> <?php include templates("index","footer");?>