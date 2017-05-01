<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿ <?php  $f_home = ''; $f_whole = ''; $f_jiexiao = ''; $f_car = ''; $f_personal = ''; if( ROUTE_C == 'home' || ROUTE_C == 'user' ){ $f_personal = 'cur'; }else if( ROUTE_C == 'mobile' && ROUTE_A == 'init'){ $f_home = 'cur'; }else if( ROUTE_C == 'mobile' && ROUTE_A == 'glist'){ $f_whole = 'cur'; }else if( ROUTE_C == 'mobile' && ROUTE_A == 'lottery'){ $f_jiexiao = 'cur'; }else if( ROUTE_C == 'cart'){ $f_car = 'cur'; }  ?>
<p>
    <br />
</p>
<p>
    <br />
</p>
<p>
    <br />
</p>
<style>
.footerdi .f_home i.cur {
    background-position: 0 0 !important;
}

.footerdi .f_whole i.cur {
    background-position: 0 -52px !important;
}

.footerdi .f_jiexiao i.cur {
    background-position: 0 -222px !important;
}

.footerdi .f_car i.cur {
    background-position: 0 -105px !important;
}

.footerdi .f_personal i.cur {
    background-position: 0 -152px !important;
}

#btnGotoTop {
    padding: 0;
    width: 40px;
    height: 40px;
    border-top: 1px solid #4b4b4b;
}

#btnGotoTop1 {
    padding: 0;
    width: 40px;
    height: 40px;
}

#btnGotoTop .s1 {
    background: url(/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 -163px no-repeat;
    background-size: 21px auto;
    margin: 9px auto;
    display: block;
    width: 21px;
    height: 21px;
}

.smailnav {
    position: fixed;
    right: 0px;
    bottom: 55px;
    z-index: 99999999;
    height: auto;
}

#top_div {
    display: none;
    width: 40px;
    height: 80px;
    background: #242424;
    opacity: 0.8;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#top_div1 {
    display: block;
    width: 40px;
    height: 40px;
    background: #242424;
    opacity: 0.8;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#btnGotoTop1 .s2 {
    background: url(/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 -129px no-repeat;
    background-size: 21px auto;
    margin: 9px auto;
    display: block;
    width: 21px;
    height: 21px;
}

#btnGotoTop3 {
    display: none;
    width: 100px;
    position: absolute;
    right: 0;
    top: -209px;
    padding: 0 10px;
    background: #242424;
    opacity: 0.7;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

#btnGotoTop3 a {
    display: block;
    height: 40px;
    line-height: 40px;
    width: 100%;
    padding: 0;
    color: #fff;
    clear: both;
}

#btnGotoTop3 .xb {
    display: block;
    width: 10px;
    height: 10px;
    background: #242424;
    border-left: 1px solid #242424;
    border-top: 1px solid #242424;
    -webkit-transform: rotate(45deg);
    position: absolute;
    bottom: -5px;
    right: 10px;
}

#btnGotoTop3 a i {
    background: url(/statics/templates/yungou/images/mobile/fast-nav-new.png) 0 0px no-repeat;
    width: 20px;
    height: 20px;
    margin: 10px 5px 0 0;
    display: block;
    vertical-align: middle;
    float: left;
    position: relative;
    background-size: 25px;
    left: 2px;
}

#btnGotoTop3 a em {
    display: block;
    float: left;
    line-height: 42px;
}

#btnGotoTop3 .home {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .home i {
    background-position: 0 1px;
    background-size: 28px auto;
    height: 22px;
}

#btnGotoTop3 .glist {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .glist i {
    background-position: 0 -117px;
    background-size: 19px;
}

#btnGotoTop3 .lottry {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .lottry i {
    background-position: 0 -35px;
    left: 0;
}

#btnGotoTop3 .user {
    border-bottom: 1px solid #4b4b4b;
}

#btnGotoTop3 .user i {
    background-position: 0 -113px;
}

#btnGotoTop3 .sx i {
    background-position: 0 -213px;
    background-size: 22px auto;
}
</style>
<div class="footerdi" style="bottom: 0px;">
    <ul>
        <li class="f_home">
            <a title="首页" href="<?php echo WEB_PATH; ?>"> <i class="<?php echo $f_home; ?>">&nbsp;</i> 首页
            </a>
        </li>
        <li class="f_whole">
            <a title="所有商品" href="<?php echo WEB_PATH; ?>/mobile/mobile/glist"> <i class="<?php echo $f_whole; ?>">&nbsp;</i> 所有商品
            </a>
        </li>
        <li class="f_jiexiao">
            <a title="最新揭晓" href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery">
                <i class="<?php echo $f_jiexiao; ?>">&nbsp;</i> 最新揭晓
            </a>
        </li>
        <li class="f_car">
            <a title="首页" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist">
                <i id="btnCart" style="position: relative;" class="<?php echo $f_car; ?>">&nbsp;</i> 购物车
            </a>
        </li>
        <li class="f_personal">
            <a title="我的云购" href="<?php echo WEB_PATH; ?>/mobile/home">
                <i class="<?php echo $f_personal; ?>">&nbsp;</i> 我的云购
            </a>
        </li>
    </ul>
    <div class="smailnav">
        <div id="btnGotoTop3" class="smailgb">
            <a class="home" href="<?php echo WEB_PATH; ?>">
                <i></i> <em>首页</em>
            </a>
            <a class="glist" href="<?php echo WEB_PATH; ?>/mobile/mobile/glist">
                <i></i> <em>所有商品</em>
            </a>
            <a class="lottry" href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery">
                <i></i>
                <em>最新揭晓</em>
            </a>
            <a class="user" href="<?php echo WEB_PATH; ?>/mobile/home">
                <i></i>
                <em>我的云购</em>
            </a>
            <a id="shuaxin" class="sx" href="javascript:location.reload()">
                <i></i>
                <em>刷新</em>
            </a>
            <i class="xb"></i>
        </div>
        <div id="top_div1">
            <a id="btnGotoTop1" onclick="Show_Hidden(btnGotoTop3)">
                <i class="s2"></i>
            </a>
        </div>
        <div id="top_div">
            <a id="btnGotoTop1" onclick="Show_Hidden(btnGotoTop3)">
                <i class="s2"></i>
            </a>
            <a id="btnGotoTop" href="javascript:;">
                <i class="s1"></i>
            </a>
        </div>
    </div>
    <script type="text/javascript">
    //返回顶部
    $(function() {
        $("#btnGotoTop").click(function() {
            $("html,body").animate({
                scrollTop: 0
            }, 1500);
        });
    });

    window.onscroll = function() {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var top_div = document.getElementById("top_div");
        var s = document.documentElement.scrollTop || document.body.scrollTop;
        var top_div1 = document.getElementById("top_div1");
        if (t >= 200) {
            top_div.style.display = "block";
        } else {
            top_div.style.display = "none";
        }
        if (s >= 200) {
            top_div1.style.display = "none";
        } else {
            top_div1.style.display = "block";
        }

    }

    function Show_Hidden(btnGotoTop3) {
        if (btnGotoTop3.style.display == "block") {
            btnGotoTop3.style.display = 'none';
        } else {
            btnGotoTop3.style.display = 'block';
        }
    }
    </script>
</div>