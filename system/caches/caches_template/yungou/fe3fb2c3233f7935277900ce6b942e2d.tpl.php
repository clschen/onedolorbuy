<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>提现记录 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/invite.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="h5-1yyg-v11">
    
<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->

    <!-- 栏目页面顶部 -->
<header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
                提现记录
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

    <div class="fr head-r" style="position: absolute;right: 6px;top: 10px;">

        <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
    -->
    <a href="<?php echo WEB_PATH; ?>/mobile/mobile" class="z-shop" style="background-position: 2px -73px;"></a>

</div>

</header>

<!-- 栏目导航 -->


    <section class="clearfix g-member" style="padding-top: 60px;">
        <div class="clearfix m-round m-name">
            <div class="fl f-Himg" style="padding-top: 5px;">
                <a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $member['uid']; ?>" class="z-Himg">
                    <?php 
                    $touxiang = get_user_key($member['uid'],'img')
                 ?>
                    <img style="border-radius: 110px;" src="
                    <?php if($touxiang !='photo/member.jpg'): ?>
                        <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiang; ?>
                    <?php elseif ($member['headimg'] !=''): ?>
                        <?php echo $member['headimg']; ?>
                    <?php  else: ?>
                        <?php echo G_UPLOAD_PATH; ?>/<?php echo $touxiang; ?>
                    <?php endif; ?>" border=0>
                </a>
                <span class="<?php if($member['jingyan'] < 501): ?>
                    z-class-icon01
                <?php elseif ($member['jingyan'] < 1001): ?>
                    z-class-icon02
                <?php elseif ($member['jingyan'] < 3001): ?>
                    z-class-icon03
                <?php elseif ($member['jingyan'] < 6001): ?>
                    z-class-icon04
                <?php elseif ($member['jingyan'] < 2001): ?>
                    z-class-icon05
                <?php  else: ?>
                    z-class-icon06
                <?php endif; ?> gray02">
                    <s></s>
                    <?php if($member['jingyan'] < 501): ?> 
                        云购新手
                    <?php elseif ($member['jingyan'] < 1001): ?>
                        云购小将
                    <?php elseif ($member['jingyan'] < 3001): ?>
                        云购中将
                    <?php elseif ($member['jingyan'] < 6001): ?>
                        云购上将
                    <?php elseif ($member['jingyan'] < 20001): ?>
                        云购大将
                    <?php  else: ?>
                        云购将军
                    <?php endif; ?>
                </span>
            </div>
            <div class="m-name-info">
                <p class="u-name"> 
                <b class="z-name gray01">
                <?php echo get_user_name($member['uid']); ?>
                </b>
                    <?php if($member['mobile']): ?> 
                    <em>
                    (<?php echo $member['mobile']; ?>)
                    </em>
                    <?php  else: ?> 
                    <em>
                    <a href="<?php echo WEB_PATH; ?>/mobile/user/mobile" class="fr z-Recharge-btn" style="line-height:24px; margin-right:5px; margin-top:3px;">
                    绑定手机
                    </a>
                    </em> 
                    <?php endif; ?>
                    <?php if($member['username']): ?>
                    <em></em>
                    <?php  else: ?> 
                    <em>
                    <a href="<?php echo WEB_PATH; ?>/mobile/user/profile" class="fr z-Recharge-btn" style="line-height:24px; margin-right:5px; margin-top:3px;">
                    绑定昵称
                    </a>
                    </em> 
                    <?php endif; ?>
                    
                </p>
                <ul class="clearfix u-mbr-info">
                    <li>
                        可用积分
                        <span class="orange"><?php echo $member['score']; ?></span>
                    </li>
                    <li>
                        经验值
                        <span class="orange"><?php echo $member['jingyan']; ?></span>
                    </li>
                    <li>
                        可用余额
                        <span class="orange">￥<?php echo $member['money']; ?></span>
                        <a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="fr z-Recharge-btn">去充值</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="R-content">
            <div class="member-t"><h2>提现记录</h2></div>
            <div id="divMentionList" class="list-tab cash gray02">
                <ul class="listTitle"><li class="w20">时间</li><li class="w35">账户信息</li><li class="w15">金额</li><li class="w15">手续费</li><li class="w15">状态</li></ul>
                <?php if($recount==1): ?>
                <?php $ln=1;if(is_array($recordarr)) foreach($recordarr AS $val): ?>
                <ul><li class="w20"><?php echo date('m-d',$val['time']); ?>&nbsp;</li><li class="w35"><?php echo $val['banknumber']; ?></li><li class="w15">&nbsp;<?php echo $val['money']; ?></li><li class="w15">&nbsp;<?php echo $fufen['fufen_yongjintx']; ?></li><li class="w15">&nbsp;<?php if($val['auditstatus']==1): ?>通过<?php  else: ?>未通过<?php endif; ?></li><ul>
                    <?php  endforeach; $ln++; unset($ln); ?>
                    <?php  else: ?>
                    <div class="tips-con"><i></i>未有相应提现记录</div>
                    <?php endif; ?>
            </div>
            <div id="divPageNav" class="page_nav"></div>
        </div>
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
</script>
 
</div>
</body>
</html>
