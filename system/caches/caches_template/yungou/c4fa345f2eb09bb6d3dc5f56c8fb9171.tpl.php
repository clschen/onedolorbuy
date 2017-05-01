<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>佣金管理 - <?php echo $webname; ?>触屏版</title>
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
                佣金管理
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
            <div class="member-t"><h2>佣金明细</h2></div>
            <div class="total">
                <dl>
                <dd>累计收入：<b class="orange"><?php echo $shourutotal; ?></b>元</dd>
                    <dd>累计(提现/充值)：<b class="orange"><?php echo $zhichutotal; ?></b>元</dd>
                    <dd>佣金余额：<b class="orange"><?php echo $total; ?></b>元</dd>
                    <dd><a href="<?php echo WEB_PATH; ?>/mobile/invite/cashout" title="申请提现" class="bluebut">申请提现</a>
                        <a href="<?php echo WEB_PATH; ?>/mobile/invite/cashout" title="充值到账户" class="orangebut">充值账户</a></dd>
                    <dt class="gray02">佣金余额可实时充值到您的<?php echo _cfg('web_name_two'); ?>帐户，满100元时才可申请提现。</dt>
                </dl>

            </div>
            <!--             <div class="record-tit">
                            <div class="record-tab">
                                <a href="javascript:void();" class="record-cur">全部</a><a href="javascript:void();">今天</a><a href="javascript:void();">本周</a><a href="javascript:void();">本月</a><a href="javascript:void();">最近三个月</a>
                            </div>

                        </div> -->
            <div id="divCommissionList" class="list-tab commission gray02"><ul class="listTitle"><li class="w20">用户</li><li class="w20">时间</li><li class="w40">描述</li><li class="w10">金额</li><li class="w10">佣金</li></ul>
                <?php if($recodetotal!=0): ?>
                    <?php $ln=1; if(is_array($recodearr)) foreach($recodearr AS $key => $val): ?>
                    <ul>
                        <li class="w20"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($val['uid']); ?>" target="_blank" class="blue"><?php echo $username[$val['uid']]; ?></a></li>
                        <li class="w20"><?php echo date('Y-m-d H:i:s',$val['time']); ?></li><li class="w40"><?php if($uid==$val['uid']): ?><?php echo $val['content']; ?><?php  else: ?><a target="_blank" href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $val['shopid']; ?>" title="<?php echo $val['content']; ?>" class="blue"><?php echo $val['content']; ?></a><?php endif; ?></li><li class="w10"><?php echo $val['ygmoney']; ?></li><li class="w10 orange"><?php if($uid==$val['uid']): ?>-<?php  else: ?>+<?php endif; ?><?php echo $val['money']; ?></li>
                    </ul>
                    <?php  endforeach; $ln++; unset($ln); ?>
                <?php  else: ?>
                    </div>
                    <div class="tips-con">您还未有邀请谁哦</div></div>
                <?php endif; ?>
                <div id="divPageNav" class="page_nav"></div>
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_WEB_PATH; ?>/statics/templates/{wc:fun_cfg('template_name')}";
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
</script>
 
</div>
</body>
</html>
