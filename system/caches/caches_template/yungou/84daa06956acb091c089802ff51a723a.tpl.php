<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>邀请管理 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />

    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/invite.css?v=130726" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.js"></script>
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
                邀请管理
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
            <div class="member-t"><h2>邀请好友</h2></div>

            <div id="divInvited" class="success-invitation gray02"  >
                <p>复制链接邀请好友赚提成！<br>
                 <a target="_blank" href="" class="blue">详情请电脑端登录进行了解&gt;&gt;</a></p>
                <span><input id="txtInfo"  style="width:80%;height:20px; " value="1元就能买IPhone 6哦，快去看看吧！ <?php echo WEB_PATH; ?>/mobile/user/register/<?php echo $uid; ?>" onpaste="return false" type="text"><span id="d_clip_container"><!--button id="d_clip_button" class="">复制</button--></span></span>

            </div>

            <div id="divInviteInfo" class="get-tips gray01" style="">成功邀请 <span class="orange"><?php echo $involvedtotal; ?></span> 位会员注册，已有 <span class="orange"><?php echo $involvednum; ?></span> 位会员参与</div>
            <div id="divList" class="list-tab SuccessCon"><ul class="listTitle"><li class="w200">用户名</li><li class="w200">时间</li><li class="w200">邀请编号</li><li class="w200">消费状态</li></ul>
                <?php if($involvedtotal!=0): ?>
                <?php $ln=1; if(is_array($invifriends)) foreach($invifriends AS $key => $val): ?>
                <ul><li class="w200">  <a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $val['uid']; ?>" target="_blank" class="blue"><?php echo $val['sqlname']; ?></a></li>
                    <li class="w200"><?php echo date('Y.m.d H:i:s',$val['time']); ?></li>
                    <li class="w200"><?php echo idjia($val['uid']); ?></li>
                    <li class="w200"><?php echo $records[$val['uid']]; ?></li>
                </ul>
                <?php  endforeach; $ln++; unset($ln); ?>
                <?php  else: ?>
                <div class="tips-con"><i></i>您还未有邀请谁哦</div>
            </div>
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
<script>
    var clip = null;
    function copy(id){ return document.getElementById(id); }
    function initx(){
        clip = new ZeroClipboard.Client();
        clip.setHandCursor(true);
        ZeroClipboard.setMoviePath("<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.swf");
        clip.addEventListener('mouseOver',function (client){
            clip.setText(copy('txtInfo').value );
        });
        clip.addEventListener('complete',function(client,text){
            alert("邀请复制成功");
        });
        clip.glue('d_clip_button','d_clip_container');
    }
    $(function(){
        initx();
    })

</script>
</div>
</body>
</html>
