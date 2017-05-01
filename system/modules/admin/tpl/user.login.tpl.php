<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>一元云购夺宝平台管理系统</title>

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/login.css" type="text/css">

</head>

<body>
<div id="div1"><img src="/statics/plugin/style/global/css/bj.jpg" /></div>
<div class="login_box">

    <div class="login">


        <div class="lh50 tac ft_yh ft20 bg_f63 white">后台登陆</div>

        <div class="login_ibox">

        <form action="#" method="post" id="form">
	<div class="input_box">
	    <div class="lf input_caption tac">
	        <img src="<?php echo G_WEB_PATH; ?>/statics/plugin/style/global/image/user.png" class="input_caption_img">
	    </div>
	    <div class="lf input_value">
	        <input type="text" id="input-u" class="input_input wid280" name="username" value="" placeholder="请输入帐号">
	    </div>
	    <div class="cl"></div>
	</div>
	
	<div class="input_box">
	    <div class="lf input_caption tac">
	        <img src="<?php echo G_WEB_PATH; ?>/statics/plugin/style/global/image/pwd.png" class="input_caption_img">
	    </div>
	    <div class="lf input_value">
	        <input type="password" id="input-p" class="input_input wid280" name="password" value="" placeholder="请输入登录密码">
	    </div>
	    <div class="cl"></div>
	</div>
	<div>
	
	<div class="input_box lf wid260" <?php if(!_cfg("web_verify")){ ?> style="filter:alpha(opacity=0);-moz-opacity:0; opacity:0;" <?php } ?>>
	                    <div class="lf input_caption tac">
	        <img src="<?php echo G_WEB_PATH; ?>/statics/plugin/style/global/image/yzm.png"  class="input_caption_img">
	    </div>
	    <div class="lf input_value">
	        <input type="text" id="input-c" class="input_input wid100" name="code" value="" <?php if(!_cfg("web_verify")){ ?> disabled="disabled"<?php } ?> placeholder="请输入验证码">
	    </div>
	    <div class="lf input_value">
	        <img id="checkcode" class="vam" src="<?php echo WEB_PATH; ?>/api/checkcode/image/80_27/"/>
	    </div>
	    <div class="cl"></div>
	</div>
	

	<div class="lf login_btn bg_f63 ft16 ft_yh" id="form_but">
	        登录
	</div>
	<div class="cl"></div>

	</div>
        </form>

        </div>

    </div><!--login end-->



<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>

<script src="<?php echo G_PLUGIN_PATH; ?>/layer/layer.min.js"></script>



<script type="text/javascript">
    var loading;
    var form_but;
    window.onload=function(){

        document.onkeydown=function(){
            if(event.keyCode == 13){
                ajaxsubmit();
            }
            return;
        }
        form_but=document.getElementById('form_but');
        form_but.onclick = ajaxsubmit;
        
                	
        var checkcode=document.getElementById('checkcode');
        checkcode.src = checkcode.src +"&"+ new Date().getTime();
        var src=checkcode.src;
        
        checkcode.onclick=function(){
            this.src=src+'&'+new Date().getTime();
        }
        
    }

    //$(document).ready(function(){$.alt("#input-u");$.alt("#input-p");$.alt("#input-c");});

    function ajaxsubmit(){		
        var name=document.getElementById('form').username.value;
        var pass=document.getElementById('form').password.value;
                var codes=document.getElementById('form').code.value;
                //document.getElementById('form').submit();
        $.ajaxSetup({
            async : false
        });		
        $.ajax({
            "url":window.location.href,
            "type": "POST",
            "data": ({username:name,password:pass,code:codes,ajax:true}),
            //"beforeSend":beforeSend, //添加loading信息
            "success":success//清掉loading信息
        });

    }
    function beforeSend(){    	
        form_but.value="登录中...";
        loading=$.layer({
            type : 3,
            time : 0,
            shade : [0.5 , '#000' , true],
            border : [5 , 0.5 , '#7298a6', true],
            loading : {type : 4}
        });        
    }

    function success(data){	
		console.log(data);
        //layer.close(loading);
        form_but.value="登录";		
        var obj = jQuery.parseJSON(data);
        if(!obj.error){
            window.location.href=obj.text;
        }else{
            $.layer({
                type :0,
                area : ['auto','auto'],
                title : ['信息',true],
                border : [5 , 0.5 , '#7298a6', true],
                dialog:{msg:obj.text}
            });
            var checkcode=document.getElementById('checkcode');
            var src=checkcode.src;
            checkcode.src='';
            checkcode.src=src;
        }
    }
</script>

</body>

</html> 

