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

tr{height:40px;line-height:40px}
select{
	height: 34px;
	margin: 0px 10px 0px 0px;
	padding: 2px 15px 2px 15px;
	border: 1px solid #B4B4B4;
	font-size: 12px;
	line-height: 34px;
	border-radius: 3px;
	height: 30px;
}
</style>

</head>

<body>

<div class="header lr10">

	<?php echo $this->headerment();?>

</div>

<div class="bk10"></div>

<div class="table-list lr10">

<!--start-->

<form name="myform" action="" method="post">

  <table width="100%" cellspacing="0">

  	<tr>

		<td width="220" align="right">手机站路径：&nbsp;</td>

		<td><input type="text" value="<?php echo $wechat[0]['cfg_value']; ?>"  name="murl"  class="input-text wid200"></td>

	</tr>

    	<tr>

		<td width="220" align="right">手机版网址：&nbsp;</td>

		<td><input type="text" value="<?php echo $wechat[1]['cfg_value']; ?>" name="baseurl" class="input-text wid200"></td>
	</tr>

  	 <tr>

		<td width="220" align="right">图片路径：&nbsp;</td>

		<td><input type="text" value="<?php echo $wechat[2]['cfg_value']; ?>" name="imgpath" class="input-text wid200"></td>

	</tr>
  	 <tr>
		<td width="220" align="right">搜索推荐：&nbsp;</td>
		<td>
			<select name="plustj"> 
				<option value="true" <?php if($wechat[3]['cfg_value']=='true'){ ?> selected="selected" <?php } ?>>是</option>
				<option value="false" <?php if($wechat[3]['cfg_value']=='false'){ ?> selected="selected" <?php } ?>>否</option>
			</select>
		</td>

	</tr>
	<tr>

		<td width="220" align="right">微信关注默认密码：&nbsp;</td>

		<td><input type="text" value="<?php echo $wechat[4]['cfg_value']; ?>" name="userpwd" class="input-text wid200">*留空的话系统将随机生成密码给用户</td>

	</tr>
	<tr>
		<td width="220" align="right">发货提醒模板id：&nbsp;</td>
		<td><input type="text" value="<?php echo $wechat[13]['cfg_value']; ?>" name="template_fh" class="input-text wid200"><font style="color:red;">说明:如果开启了发货微信提醒，那么此选项一定要配置且正确！！</font></td>
	</tr>
	<tr>
		<td width="220" align="right">中奖微信通知模板id：&nbsp;</td>
		<td><input type="text" value="<?php echo $wechat[12]['cfg_value']; ?>" name="template_zj" class="input-text wid200"><font style="color:red;">说明:如果开启了中奖微信提醒，那么此选项一定要配置且正确！！</font></td>
	</tr>
    <tr>

        	<td width="220" align="right"></td>

            <td><input type="submit" class="button" name="dosubmit"  value=" 提交 " ></td>

   </tr>

</table>

</form>



</div><!--table-list end-->



<script>

	

</script>

</body>

</html> 