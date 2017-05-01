<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="header-title lr10">
	<b>短信模板配置</b><span style=" padding-left:30px;"></span>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
    <tr>
    	<td width="150">用户短信验证短信模板：</td> 
   		<td><textarea name="m_reg_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_reg['value']; ?></textarea>
        <font color="red">000000</font> 是发送的验证码！请不要超过75个字,超过按照2条短信发送</td>
    </tr>
    <tr>
    	<td width="150">用户云购获奖短信模板：</td> 
   		<td><textarea name="m_shop_temp" style=" height:50px; width:450px" class="input-text"><?php echo $temp_shop['value']; ?></textarea>
        <font color="red">00000000</font> 是发送的云购码！,请不要超过75个字,超过按照2条短信发送
        </td>
    </tr>
      <tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
   	 </tr>
</table>
</form>
<style>
	.mb_tishi{ width:100%; margin-top:100px;}
	.mb_tishi h1,.mb_tishi span{color:red; font-size:14px;}
	.mb_tishi p{border:1px solid #ccc; padding:10px; margin-bottom:10px;}
</style>
<div class="mb_tishi">
	<h1>中奖通知模版示例（红色字可改动）：</h1>
	<p>模板一：恭喜您参与云购的商品已获奖！<span>云购码</span>：000000，赶快登录账户查看吧！</p>
	<p>模板二：亲，您运气好极了，您已获得云购的商品，<span>云购码</span>：000000，赶快联系网站客服吧！</p>
	<p>模板三：恭喜您获得了云购商品，<span>云购码</span>：000000。请登录账户完善个人信息哟！<span>客服电话：xxxxxx</span></p>
	<p>模板四：恭喜获奖，<span>云购号</span>：000000。坐等快递小哥给你送过来！<span>客服QQ：xxxxxx</span></p>
	<p>模板五：恭喜您云购成功！成为商品获得者,<span>幸运码</span>为：00000000，请您及时登陆会员中心补全收货地址,商品会在<span>一周</span>内发出！</p>
</div>
</div><!--table-list end-->
</body>
</html> 