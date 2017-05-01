<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车 - <?php echo $webname; ?>触屏版</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/cartList.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
    <script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Cartindex.js" language="javascript" type="text/javascript"></script>
</head>

<body>
    <div class="h5-1yyg-v1" id="loadingPicBlock">
        <!-- 栏目页面顶部 -->
        <!-- 内页顶部 -->
       <header class="header" style="position: fixed;width: 100%;z-index: 99999999;">

    <h1 style="width: 100%;text-align: center;float: none;top: 0px;left: 0px;font-size: 25px;" class="fl">
        <span style="display: block;height: 49px;line-height: 49px;">
            <a style="font-size: 20px;line-height: 49px;" href="<?php echo WEB_PATH; ?>/mobile/mobile">
               购物车
            </a>
        </span>

        
    </h1>

    <a id="fanhui" class="cefenlei" onclick="history.go(-1)" href="javascript:;">
        
        <img width="30" height="30" src="/statics/templates/yungou/images/mobile/fanhui.png">
    </a>

    <div class="fr head-r" style="position: absolute;right: 6px;top: 10px;">

        <!--<a href="<?php echo WEB_PATH; ?>/mobile/user/login" class="z-Member"></a>
    -->
    <a href="<?php echo WEB_PATH; ?>/mobile/home" class="z-shop" style="background-position: -5px 0px;"></a>

</div>

</header>

    <input name="hidLogined" type="hidden" id="hidLogined" value="1" />
    <style type="text/css">
                            li:hover{color: #22AAFF;}
                            span:hover{color: #22AAFF;}
                            .tags li{
                                height: 28px;width: 50px;border-radius: 10px;float: left;margin: 0 6px;cursor: pointer;border: 1px solid #ccc;
                            }
                            .tags li:hover{
                                border:1px solid #22AAFF;
                            }
                        </style>
    <section class="clearfix g-Cart">
        <?php if($shop!=0): ?>
        <article class="clearfix m-round g-Cart-list">
            <ul id="cartBody">
                <?php  $buyshopmoney=0;  ?> <?php $ln=1; if(is_array($shoplist)) foreach($shoplist AS $key => $val): ?> <?php  $num = count($shoplist); $buyshopmoney+=$Mcartlist[$val['id']]['money']*$Mcartlist [$val ['id']] ['num'];  ?>
                <li style="border-bottom: 1px solid #dcdcdc;padding: 6px 0;">
                    <a class="fl u-Cart-img" href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $val['id']; ?>">
                        <img src="<?php echo G_TEMPLATES_IMAGE; ?>/loading.gif" src2="<?php echo G_UPLOAD_PATH; ?>/<?php echo $val['thumb']; ?>" border="0" alt="" />
                    </a>
                    <div class="u-Cart-r">
                        <p class="z-Cart-tt">
                            <a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $val['id']; ?>" class="gray6">(第<?php echo $val['qishu']; ?>期)<?php echo $val['title']; ?></a>
                        </p> <ins class="z-promo gray9">剩余 <em class="arial"><?php echo $val['zongrenshu']-$val['canyurenshu']; ?></em>
                            人次</ins> 
                        <p class="gray9">
                            总共参与： <em class="arial proce" id="arial<?php echo $val['id']; ?>" ids="<?php echo $val['id']; ?>"><?php echo $Mcartlist[$val['id']]['num']; ?></em>
                            人次/
                            

                            <em class="orange arial">￥<span  id="price<?php echo $val['id']; ?>" ids="<?php echo $val['id']; ?>" class='price'><?php echo $Mcartlist[$val['id']]['sun']; ?></span></em>
                        </p>
                        <p class="f-Cart-Other">
                            <input type="hidden" value="<?php echo $val['yunjiage']; ?>" class="yunjiage">

                            <a href="javascript:;" class="fr z-del" name="delLink" cid="<?php echo $val['id']; ?>"></a>

                            <a href="javascript:;" class="fl z-jian <?php if($Mcartlist[$val['id']]['num']==1): ?>z-jiandis<?php endif; ?>">-</a>

                            <input id="txtNum<?php echo $val['id']; ?>" name="num" type="text" maxlength="7" yunjiage="<?php echo $val['yunjiage']; ?>" value="<?php echo $Mcartlist[$val['id']]['num']; ?>" class="fl z-amount" />

                            <a href="javascript:;" class="fl z-jia <?php if($Mcartlist[$val['id']]['num']==$val['zongrenshu']): ?>z-jiadis<?php endif; ?>">+</a>

                            <input id="shuliang<?php echo $val['id']; ?>" type="hidden" value="<?php echo $Mcartlist[$val['id']]['num']; ?>" />

                            <input type="hidden" value="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>" />

                        </p>
                    </div>

                    <div style="float: left;color: #333;text-align: center;line-height: 28px;font-size: 14px;position: relative;margin-bottom: 5px;width: 100%;">
                        <style>
                            .tags #wy{
                                background: #dcdcdc;
                            }
                            .tags #wy:hover{
                                color: 999;
                                border: 1px solid #ccc;
                            }
                            .tags div{
                                border: 1px solid #ccc;
                                border-radius: 10px;
                                cursor: pointer;
                                float: left;
                                height: 28px;
                                margin: 0 6px;
                                width: 50px;
                            }
                        </style>
                        <ul class="tags" style="margin: 0 auto;width: 90%;">
                            <?php if($val['zongrenshu']-$val['canyurenshu']>199): ?>
                            <li id="Li1" data-id="<?php echo $val['id']; ?>" data-val="10">10</li>
                            <li id="Li2" data-id="<?php echo $val['id']; ?>" data-val="50">50</li>
                            <li id="Li3" data-id="<?php echo $val['id']; ?>" data-val="100">100</li>
                            <li id="Li4" data-id="<?php echo $val['id']; ?>" data-val="200">200</li>
                            <li id="Li5" data-id="<?php echo $val['id']; ?>" data-val="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>">包尾</li>
                            <?php elseif ($val['zongrenshu']-$val['canyurenshu']>99): ?>
                            <li id="Li1" data-id="<?php echo $val['id']; ?>" data-val="10">10</li>
                            <li id="Li2" data-id="<?php echo $val['id']; ?>" data-val="50">50</li>
                            <li id="Li3" data-id="<?php echo $val['id']; ?>" data-val="100">100</li>
                            <div id="wy">200</div>
                            <li id="Li4" data-id="<?php echo $val['id']; ?>" data-val="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>">包尾</li>
                            <?php elseif ($val['zongrenshu']-$val['canyurenshu']>49): ?>
                            <li id="Li1" data-id="<?php echo $val['id']; ?>" data-val="10">10</li>
                            <li id="Li2" data-id="<?php echo $val['id']; ?>" data-val="50">50</li>
                            <div id="wy">100</div>
                            <div id="wy">200</div>
                            <li id="Li3" data-id="<?php echo $val['id']; ?>" data-val="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>">包尾</li>
                            <?php elseif ($val['zongrenshu']-$val['canyurenshu']>9): ?>
                            <li id="Li1" data-id="<?php echo $val['id']; ?>" data-val="10">10</li>
                            <div id="wy">50</div>
                            <div id="wy">100</div>
                            <div id="wy">200</div>
                            <li id="Li2" data-id="<?php echo $val['id']; ?>" data-val="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>">包尾</li>
                            <?php elseif ($val['zongrenshu']-$val['canyurenshu']>0): ?>
                            <div id="wy">10</div>
                            <div id="wy">50</div>
                            <div id="wy">100</div>
                            <div id="wy">200</div>
                            <li id="Li1" data-id="<?php echo $val['id']; ?>" data-val="<?php echo $val['zongrenshu']-$val['canyurenshu']; ?>">包尾</li>
                            <?php endif; ?>
                            </ul>
                    </div>

                </li>
                <?php  endforeach; $ln++; unset($ln); ?>


                                        
            </ul>
        </article>
        <div id="divBtmMoney" class="g-Total-bt" style="height: 40px;width: 100%;">
            <p style="display: block;float: left;line-height: 45px;text-align: left;text-indent: 10px;">
                <!--<?php echo _cfg('web_name_two'); ?>-->
                共
                <span class="orange arial z-user" style="font-size: 12px;line-height: 45px;"><?php echo $num; ?></span>
                &nbsp件商品&nbsp&nbsp&nbsp合计&nbsp
                <span  id="total" class="orange arial" style="font-size: 14px;line-height: 45px;"><?php echo $buyshopmoney; ?>.00</span>
                &nbsp元
            </p>
            <a style="float: right;width: 20%;" href="javascript:;" class="orgBtn">去 结 算</a>

        </div>
        <?php endif; ?>
        <div id="divNone" class="haveNot z-minheight" style="display:none">
            <s></s>
            <p>购物车空空如也~~</p>
            <a href="/">
                <p class="guangguang">去逛逛</p>
            </a>
        </div>
    </section>
    <style type="text/css">
        .smailnav{bottom: 100px!important;}
    </style>
    <?php include templates("mobile/index","footer");?>
    <script language="javascript" type="text/javascript">
        var Path = new Object();
        Path.Skin = "<?php echo G_TEMPLATES_STYLE; ?>";
        Path.Webpath = "<?php echo WEB_PATH; ?>";

        var Base = {
            head: document.getElementsByTagName("head")[0] || document.documentElement,
            Myload: function(B, A) {
                this.done = false;
                B.onload = B.onreadystatechange = function() {
                    if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                        this.done = true;
                        A();
                        B.onload = B.onreadystatechange = null;
                        if (this.head && B.parentNode) {
                            this.head.removeChild(B)
                        }
                    }
                }
            },
            getScript: function(A, C) {
                var B = function() {};
                if (C != undefined) {
                    B = C
                }
                var D = document.createElement("script");
                D.setAttribute("language", "javascript");
                D.setAttribute("type", "text/javascript");
                D.setAttribute("src", A);
                this.head.appendChild(D);
                this.Myload(D, B)
            },
            getStyle: function(A, B) {
                var B = function() {};
                if (callBack != undefined) {
                    B = callBack
                }
                var C = document.createElement("link");
                C.setAttribute("type", "text/css");
                C.setAttribute("rel", "stylesheet");
                C.setAttribute("href", A);
                this.head.appendChild(C);
                this.Myload(C, B)
            }
        }

        function GetVerNum() {
            var D = new Date();
            return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1))
        }
        Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
        </script></div>
</body>

</html>