<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>

<html>

<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<title><?php echo $key; ?></title>

<meta content="app-id=518966501" name="apple-itunes-app" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" /><meta content="yes" name="apple-mobile-web-app-capable" /><meta content="black" name="apple-mobile-web-app-status-bar-style" /><meta content="telephone=no" name="format-detection" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/goods.css" rel="stylesheet" type="text/css" /><script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script><script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/BuyRecord.js" language="javascript" type="text/javascript"></script></head>

<body>

<div class="h5-1yyg-v1" id="loadingPicBlock">

    

<!-- 栏目页面顶部 -->





<!-- 内页顶部 -->



    <header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
                所有云购记录
            </a>
        </span>

        <!--<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"/>
        -->
        <!--<img src="/statics/templates/yungou/images/sjlogo.png"/>
        -->
    </h1>

    <a id="fanhui" class="cefenlei" onclick="history.go(-1)" href="javascript:;">
        
        <img width="30" height="30" src="/statics/templates/yungou/images/mobile/fanhui.png">
    </a>

    <div class="fr head-r" style="position: absolute;right: 0px;top: 0px;">

        <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
    -->
    <a href="<?php echo WEB_PATH; ?>/mobile/mobile" class="z-shop" style="background-position: 12px -73px;"></a>

</div>

</header>




    <input name="hidCodeID" type="hidden" id="hidCodeID" value="18101" />

    <input name="hidIsEnd" type="hidden" id="hidIsEnd" value="1" />



    <!-- 梦想购记录 -->

    <section id="buyRecordPage" class="goodsCon">

        

	<?php if($co < 1): ?>
		<div id="divNone" class="haveNot z-minheight" style="margin-top: 0;padding-top: 100px;"><s></s><p>抱歉，暂时还没有记录！</p><a href="<?php echo G_WEB_PATH; ?>"><p class="guangguang">我去云购</p></a>

		</div>

	  <?php  else: ?>
		<div id="divRecordList" class="recordCon z-minheight" style="display:block; height:auto;padding-top: 49px;margin-top: 0px;">
            <?php $ln=1;if(is_array($cords)) foreach($cords AS $c): ?>
           
			<ul>

				<li class="rBg"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $c['uid']; ?>">
                    <?php 
                        $touxiangq=get_user_key($c['uid'],'img');
                        $touxianga=get_user_key($c['uid'],'headimg');
                     ?>
					<img style="border-radius: 110px;" id="imgUserPhoto" src="
                        <?php if($touxiangq!='photo/member.jpg'): ?>
                            <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiangq; ?>
                        <?php elseif ($touxianga!=''): ?>
                            <?php echo $touxianga; ?>
                        <?php  else: ?>
                            <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiangq; ?>
                        <?php endif; ?>"   border="0"/>
                        </a>

				</li>

				<li class="rInfo"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $c['uid']; ?>"><?php echo $c['username']; ?></a>

					<strong><?php if($c['ip']): ?>

							(<?php echo get_ip($c['id'],'ipcity'); ?> IP:<?php echo get_ip($c['id'],'ipmac'); ?>)

							<?php endif; ?></strong><br>

					<span>云购了<b class="orange"><?php echo $c['gonumber']; ?></b>人次</span><em class="arial"><?php echo date("Y-m-d H:i:s",$c['time']); ?></em>

				</li><i></i>

			</ul>
		   <?php  endforeach; $ln++; unset($ln); ?>

	<?php endif; ?>

        </div>

    </section>



    




</div>

</body>

</html>

