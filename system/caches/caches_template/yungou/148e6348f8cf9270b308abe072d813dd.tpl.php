<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录-<?php echo _cfg("web_name"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/index.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/color.css"/>
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/JQuery.js"></script>
<link href="<?php echo G_TEMPLATES_STYLE; ?>/js/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_STYLE; ?>/js/demo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/jquery.Validform.min.js"></script>
</head>
<body style="background: #fff;">
<!--
<script>
$(function(){
    var select_form = $('input:text,textarea'); //选择需要添加提示文字的表单
    for(i=0;i<select_form.length;i++){          
        select_form.eq(i).val(select_form.eq(i).attr('fs')).css('color','#999');//设置表单的值为一个属性值为“fs”的值    
    }  
    select_form.focus(function(){   //获得焦点
        if($(this).val()==$(this).attr('fs')){
          $(this).val('');
          $(this).css('color','#333');
        }    
    })
    select_form.blur(function(){    //失去焦点  
        if($(this).val()==''){
           $(this).val($(this).attr('fs'));
           $(this).css('color','#999');
        }
    })
})
</script>
-->



 <script type="text/javascript">
$(function(){		
	var demo=$(".registerform").Validform({
		tiptype:2,
	});	
})
</script>
<div class="login">

	<div class="login_header">
		<div class="login_top">
			<h1><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a></h1>
			<p><a rel="nofollow" href="<?php echo G_WEB_PATH; ?>" class="back_home">返回首页</a><a href="<?php echo WEB_PATH; ?>/help/1" target="_blank" class="help">帮助中心</a></p>
		</div>
	</div>
	<div class="login_bg">
		<!--
		<div id="loadingPicBlock" class="login_banner"><img src="<?php echo G_TEMPLATES_STYLE; ?>/images/20120628180933540.jpg" width="542" height="360"></div>-->
		<div class="login_box" id="LoginForm">
		<div class="login_box_guding">
		<div class="login_box_guding1"></div>
		<form class="registerform" method="post" action="">
			<h3><span style="display:block;float: left;">用户登录</span><a id="hylinkRegisterPage" style="padding:0px 10px;display: block;float: right;font-size: 16px;color: #22AAFF;" tabindex="4" class="reg" href="<?php echo WEB_PATH; ?>/register">免费注册>></a></h3>
			<ul>				
				<li class="click">
					<input style="color: #666;" placeholder="手机号码/邮箱地址" class="text_password" name="username" type="text"  />
					<b class="passport-icon"></b>
				</li>
				<li class="click1">				
					<input style="color: #666;" class="text_password" name="password" type="password" placeholder="密码" />
					<b class="passport-icon" style="top:31px;height: 20px;background-position: 0 -25px;"></b>
				</li>
				<li class="fog" style="height: 25px;line-height: 25px;text-align:right;width: 300px;"><a href="<?php echo WEB_PATH; ?>/member/finduser/findpassword">忘记密码？</a></li> 								
				</li>
				 <li class="yanzheng">
				     <input style="color: #666;" class="text_verify" ajaxurl="<?php echo WEB_PATH; ?>/member/user/codeCheck"
				            name="captcha" type="text" />
				     <span class="fog"><img id="checkcode" src="<?php echo WEB_PATH; ?>/api/checkcode/image/80_27/"/></span>
				 </li>
	
				<li class="end">
				<span><input name="submit" type="submit" value="登&nbsp&nbsp录" class="login_init" ></span>
				 

				</li>

			<div style="height: 40px;"></div>
			</ul>
			<?php 
				$conn_cfg = System::load_app_config("connect",'','api');
             ?>
            <?php if($conn_cfg['qq']['off']): ?>
 			<div class="loginQQ">
 				<span id="qq_login_btn">
 					使用其它方式快捷登录：
 				</span>
 				<a class="qqdenglu" href="<?php echo G_WEB_PATH; ?>/index.php/api/qqlogin/"><b class="passport-icon1 transparent-png"></b></a>
 				<a class="weixindenglu" href="<?php echo G_WEB_PATH; ?>/index.php/api/wxloginpc/"><b style="background-position: 8px -149px!important;" class="passport-icon1 transparent-png"></b></a>
 			</div>

            <?php endif; ?>			
			<input value="<?php echo G_HTTP_REFERER; ?>" name="hidurl" type="hidden">
		</form>
	</div>
		</div>
	</div>
</div>
<!--login 结束-->
<div class="g-copyrightCon" style="padding-top: 50px;">
	<div class="w1190">
		<div class="g-links">
			<a href="<?php echo WEB_PATH; ?>">首页</a>
			<s></s>
				<?php echo Getheader('foot'); ?>
  		</div>
  		<div class="g-copyright"><?php echo _cfg("web_copyright"); ?></div>
	</div>
</div>

<script type="text/javascript">

$("#registerform").Validform({
		tiptype:function(msg,o,cssctl){
			//msg：提示信息;
			//o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
			//cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
			if(!o.obj.is("form")){//验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
				//var objtip=o.obj.siblings(".Validform_checktip");
				var objtip=o.obj.parent().next().find(".Validform_checktip");
				cssctl(objtip,o.type);
              		  if(o.type==3){
                   			 $("#checkcode").click();
              		}
		objtip.text(msg);
			}else{
				var objtip=o.obj.find("#msgdemo");
				cssctl(objtip,o.type);
				objtip.text(msg);
			}
		},
		callback:function(data){
			if(data.status == -1){
				alert(data.msg);
			}else{
				window.location.href='<?php echo WEB_PATH; ?>/member/home/userindex';
			}
		},
		ajaxPost:true
});

$("#checkcode").attr("data",$("#checkcode").attr("src"));
$("#checkcode").click(function(){
	$(this).attr("src",$(this).attr("data")+"&="+new Date().getTime());
});
</script>
</body>
</html>