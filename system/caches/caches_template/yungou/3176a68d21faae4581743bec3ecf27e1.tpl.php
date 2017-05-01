<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!-- 栏目页面顶部 -->
<div id="light" class="white_content" style="background: #fff;">
    <header class="header" style="width: 100%;z-index: 99999999;background: #edebeb;border-bottom: 1px solid #d8d8d8;">

        <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
            <div class="head_search b_red" style="position: relative;margin: 0 50px 0 30px;">
                <input style="background: #fff;margin-top: 9px;" id="txtSearch" class="init" placeholder="输入'购物卡'试一试" type="text">
                <!--
                <span style="">
            <a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/苹果">苹果</a>
            <a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/购物卡" style="width: 45px;">购物卡</a>
          </span>
          -->
                <a class="search_submit"href="#"> <i class="ico_search"></i>
            </a>
            </div>
            <a class="search_submit" id="butSearch" href="javascript:;" style="color: #22AAFF;line-height: 52px;font-size: 16px;display: block;float:right;margin-right: 15px;">搜&nbsp索
            </a>
        </h1>

        <a class="daohangguanbi" href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img width="30" height="30" src="<?php echo G_WEB_PATH; ?>/statics/templates/yungou/images/fanhui1.png"></a>
<!--
        <div class="fr head-r" style="position: absolute;right: 0px;top: 0px;">

            <a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
        
            <a href="<?php echo WEB_PATH; ?>/mobile/mobile/" class="z-shop" style="background-position: 12px -73px;"></a>

        </div>
-->
    </header>
            <script>
            document.onkeydown = function(event)

            {

                e = event ? event : (window.event ? window.event : null);

                ss = document.getElementById('txtSearch').value;

                if (e.keyCode == 13 && ss != "") {

                    window.location.href = "<?php echo WEB_PATH; ?>/mobile/mobile/search/" + $("#txtSearch").val();

                }

            }



            $(function() {

                $("#txtSearch").focus(function() {

                    $("#txtSearch").css({
                        background: "#fff"
                    });

                    $(this).attr("placeholder", "");

                });

                $("#txtSearch").blur(function() {

                    $("#txtSearch").css({
                        background: "#FFF"
                    });

                    $(this).attr("placeholder", "输入'购物卡'试一试");

                });

                $("#butSearch").click(function() {

                    var val1 = "购物卡"

                    if ($("#txtSearch").val() == "") {

                        window.location.href = "<?php echo WEB_PATH; ?>/mobile/mobile/search/" + val1;

                    } else

                    if ($("#txtSearch").val() == $("#txtSearch").val()) {

                        window.location.href = "<?php echo WEB_PATH; ?>/mobile/mobile/search/" + $("#txtSearch").val();

                    }

                });

            });
            </script>
            <style>
                .remen li{
                    width:23%;
                    margin: 10px 5%;
                    float: left;
                    height: 32px;
                    line-height: 32px;
                    text-align: center;
                    color: #666;
                    border: 1px solid #dcdcdc;

                }
                .remen li:hover{
                    background: #dcdcdc;
                    color:#666;

                }
            </style>
            <div style="height: 40px;line-height: 40px;font-size: 16px;background: #dcdcdc;border-bottom:1px solid #ccc;color: #666;text-align: center;clear: both;">热门搜索</div>
            <div class="remen">
                <ul>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E8%8B%B9%E6%9E%9C">苹果</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E5%B0%8F%E7%B1%B3">小米</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E5%B9%B3%E6%9D%BF">平板电脑</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E6%95%B0%E7%A0%81">数码</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E8%B4%AD%E7%89%A9%E5%8D%A1">购物卡</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/mobile/mobile/search/%E8%AF%9D%E8%B4%B9">话费</a></li>
                </ul>
            </div>
            <div style="height: 40px;line-height: 40px;font-size: 16px;background: #dcdcdc;border-bottom:1px solid #ccc;border-top:1px solid #ccc;color: #666;text-align: center;clear: both;">分类搜索</div>
<div class="daohangleft">
    <div class="dhbj">
        <div>
            <ul>
        <?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order` desc",array("type"=>1,"key"=>'',"cache"=>0)); ?>
            <?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>
                <li>
                    <a class="liebiao" href="<?php echo WEB_PATH; ?>/mobile/mobile/fen/<?php echo $categoryx['cateid']; ?>">
                        <img src="/statics/uploads/<?php echo $categoryx['pic_url']; ?>" alt="">
                        <span><?php echo $categoryx['name']; ?></span>
                    </a>
                </li>
            <?php  endforeach; $ln++; unset($ln); ?>
        <?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
            </ul>
        </div>
    </div>

</div>

</div>
<header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

<h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
    <span style="display: block;height: 49px;line-height: 49px;">
        <a style="" href="<?php echo WEB_PATH; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a>
    </span>

</h1>

<a class="cefenlei" href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"></a>

<div class="fr head-r" style="position: absolute;right: 6px;top: 10px;">

    <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
-->
<a href="<?php echo WEB_PATH; ?>/mobile/home" class="z-shop" style="background-position: -5px 0px;"></a>

</div>

</header>

<!-- 栏目导航 -->
<!--
<nav class="g-snav u-nav" style="position: relative;top: 49px;">

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/mobile/" <?php if($key=="首页" ): ?>class="nav-crt"<?php endif; ?>>首页</a>
<?php if($key=="首页" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist" <?php if($key=="所有商品" ): ?>class="nav-crt"<?php endif; ?>>所有商品</a>
<?php if($key=="所有商品" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery" <?php if($key=="最新揭晓" ): ?>class="nav-crt"<?php endif; ?>>最新揭晓</a>
<?php if($key=="最新揭晓" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/shaidan/" <?php if($key=="获奖晒单" ): ?>class="nav-crt"<?php endif; ?>>获奖晒单</a>
<?php if($key=="获奖晒单" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/home/userqiandao" <?php if($key=="签到" ): ?>class="nav-crt"<?php endif; ?>>签到</a>
<?php if($key=="签到" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

<div class="g-snav-lst">
<a href="<?php echo WEB_PATH; ?>/mobile/home/choujiang" <?php if($key=="抽奖" ): ?>class="nav-crt"<?php endif; ?>>抽奖</a>
<?php if($key=="抽奖" ): ?>
<s class="z-arrowh"></s>
<?php endif; ?>
</div>

</nav>
-->