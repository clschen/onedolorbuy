<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
.on{color:#fff;background:#0c0;padding:3px 6px;}
.off{color:#f00;background:#eee;padding:3px 6px;}
.msgs{float:left; overflow:hidden; width:100%;}
table.meg_table{border:10px solid #d5dfe8; width:480px; height:370px; float:left; display:inline-block;padding:10px;}
table.meg_table:hover{ background:#f1f1f1}
table.meg_table tr { display:block;}
form{float: left; height: 400px; padding: 10px;}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>短信接口设置</b>
	<span class="lr10"> | </span>
	<b><a href="<?php echo G_MODULE_PATH; ?>/template/mobile_temp">短信发送模板配置</a><b>
    <span class="lr10"> | </span>
    <b><a href="javascript:;" onClick="mobile_check();">测试短信发送</a><b>
	<span class="lr10"> | </span>
    <b><a href="http://www.smsbao.com/reg?r=10425" target="_blank" >短信购买</a><b>
</div>
<div class="bk10"></div>
<div class="lr10" id="div_top_block" style="display:block; width:100px; height:0px;background:#d5dfe8;">

</div>
<div class="table_form lr10 msgs">

<form action="" method="post" id="myform">
<table width="100%" class="meg_table">
	<tr>
    	<td width="100"><b>互亿无线</b><em> </em></td> 
   		<td key="3" class="mobile_on_off"></td>
    </tr>    
    <tr>
    	<td width="100">短信接口用户名：</td> 
   		<td><input type="text" name="mid" class="input-text wid150" value="<?php echo $mobiles['cfg_mobile_3']['mid']; ?>"></td>
    </tr>
    <tr>
    	<td width="100">短信接口密码：</td> 
   		<td><input type="password" name="mpass" class="input-text wid150"  value="******"></td>
    </tr>
	 <tr>
	 <td width="100">短信信息：</td>
	 <td>
     <span><?php echo $mobiles['cfg_mobile_3']['mobile_text']; ?></span>
     </td>
     </tr>
     
    <tr>
    	<td width="100" height="50"><input type="hidden" name="interface" value="3" /></td> 
   		<td> <input type="submit" value=" 提交并启用该接口 " name="dosubmit" class="button"></td>
    </tr>
     <tr>
    	<td width="100" height="20px;" style="border:0px;"></td> 
   		<td style="border:0px;"></td>
     </tr> 
    </table> 
    </form>
     

<form action="" method="post">
<table width="100%" class="meg_table">
     <tr>
    	<td width="100"><b>短信宝</b></td> 
   		<td key="2" class="mobile_on_off"></td>
     </tr>      
    <tr>
    	<td width="100">短信接口mid：</td> 
   		<td><input type="text" name="mid" class="input-text wid150"  value="<?php echo $mobiles['cfg_mobile_2']['mid']; ?>"></td>
    </tr>
    <tr>
    	<td width="100">短信接口pass：</td> 
   		<td><input type="password" name="mpass" class="input-text wid150"  value="******">
		请到短信宝报备短信模板，格式请联系客服获取！
    </tr>
	<tr>
    	<td width="100">短信签名：</td>
   		<td><input type="text" name="mqianming" class="input-text wid150"  value="<?php echo $mobiles['cfg_mobile_2']['mqianming']; ?>">
		 可为空! 格式为: <font color="red">【你的签名】</font>
		</td>
    </tr>
     <tr>
	 <td width="100">短信信息：</td>
	 <td>
     <span><?php echo $mobiles['cfg_mobile_2']['mobile_text']; ?></span>
     </td>
     </tr>     
     
     <tr>
    	<td width="100" height="50"><input type="hidden" name="interface" value="2" /></td>
   		<td><input type="submit" value=" 提交并启用该接口 " name="dosubmit" class="button"><b><a href="http://www.smsbao.com/reg?r=10425" target="_blank" >短信购买</a><b></td>
    </tr>
</table>
</form>

     



</div><!--table-list end-->

<!--支付弹出框-->
<style>
#paywindow{position:absolute;z-index:999; display:none}
#paywindow_b{width:372px;height:442px;background:#2a8aba; filter:alpha(opacity=60);opacity: 0.6;position:absolute;left:0px;top:0px; display:block}
#paywindow_c{width:360px;height:430px;background:#fff;display:block;position:absolute;left:6px;top:6px;}
.p_win_title{ line-height:40px;height:40px;background:#f8f8f8;}
.p_win_title b{float:left}
.p_win_title a{float:right;padding:0px 10px;color:#f60}
.p_win_content h1{font-size:25px;font-weight:bold;}
.p_win_but,.p_win_mes,.p_win_ctitle,.p_win_text{ margin:20px 20px;}
.p_win_ctitle{overflow:hidden;}
.p_win_x_b{float:left; width:73px;height:68px;background-repeat:no-repeat;}
.p_win_x_t{ font-size:18px; font-weight:bold;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma;color:#f00; text-align:center}
.p_win_but{ height:40px; line-height:40px;}
.p_win_but a{ padding:8px 15px; background:#f60; color:#fff;border:1px solid #f50; margin:0px 15px;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma; font-size:15px; }
.p_win_but a:hover{ background:#f50}
.p_win_text a{ font-size:13px; color:#f60}
.pay_window_quit:hover{ color:#f00;}
</style>
<div id="paywindow">
	<div id="paywindow_b"></div>
	<div id="paywindow_c">
		<div class="p_win_title"><a href="javascript:void();" class="pay_window_quit">[关闭]</a><b></b></div>
		<div class="p_win_content">
			<div class="p_win_ctitle">			
				<li class="p_win_x_t">：：：短信测试：：：</li>
			</div>
			<div class="p_win_mes">
            	 <input type="text" id="ceshi_haoma" class="input-text" style="width:280px;" value="输入测试手机号码..."/>    		
            </div>
            <div class="p_win_mes">             	    	
                 	<textarea id="ceshi_con" style="width:280px; height:150px;">输入测试内容...(只能检测到新短信接口的内容是否合法)</textarea><br/>
    			 	<input type="button" value=" 测试短信功能与内容 " class="button" id="ceshi_form">              
            </div>	
		</div>
	</div>
</div>
<script>
$(function(){
	var width = ($(window).width()-372)/2;
	var height = ($(window).height()-442)/2;
	$("#paywindow").css("left",width);
	$("#paywindow").css("top",height);
		
	$(".pay_window_quit").click(function(){
		$("#paywindow").hide();								 
	});

	var mobile = '<?php echo $mobiles['cfg_mobile_on']; ?>';
	
	$("td.mobile_on_off").each(function(i){
		if($(this).attr("key") == mobile){
			$(this).html("<span class=\"on\">开启中...</span>");
		}else{
			$(this).html("<span class=\"off\">关闭中...</span>");
		}
	});
	
});
</script>
<!--支付弹出框-->


<script type="text/javascript">
function mobile_check(){
	$("#paywindow").show();
	return true;
}

$("#ceshi_form").click(function(){
		$.ajaxSetup({
			async : false
		});	
		var ceshi_haoma=document.getElementById('ceshi_haoma').value;
		var ceshi_con=document.getElementById('ceshi_con').value;	
		if(ceshi_con == ''){
			window.parent.message("内容不能为空!",8,2);
			return;
		}
		$.post("<?php echo WEB_PATH.'/'.ROUTE_M; ?>/setting/mobile",{"ceshi_haoma":ceshi_haoma,"ceshi_con":ceshi_con,"ceshi_submit":true},function(data){
		
			data = jQuery.parseJSON(data);	
			if(data[0]==-1){
				window.parent.message(data[1],8,3);
			}else{
				window.parent.message(data[1],1,2);
			}
		});			
});   
</script>
</body>
</html> 