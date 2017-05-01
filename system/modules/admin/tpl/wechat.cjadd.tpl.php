<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<script type="text/javascript">
var editurl=Array();
editurl['editurl']='<?php echo G_PLUGIN_PATH; ?>/ueditor/';
editurl['imageupurl']='<?php echo G_ADMIN_PATH; ?>/ueditor/upimage/';
editurl['imageManager']='<?php echo G_ADMIN_PATH; ?>/ueditor/imagemanager';
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/ueditor/ueditor.all.min.js"></script>
<style>
	.bg{background:#fff url(<?php echo G_GLOBAL_STYLE; ?>/global/image/ruler.gif) repeat-x scroll 0 9px }
	.color_window_td a{ float:left; margin:0px 10px;}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table_form lr10">
<form method="post" action="">
	<table width="100%"  cellspacing="0" cellpadding="0">
        		<tr>
			<td align="right" style="width:120px"><font color="red">*</font>场景名称:</td>
			<td>
            		<input  type="text" id="title"  name="scenename" value="<?php if($id>0){ echo $wc['scenename']; } ?>" class="input-text wid400 bg">
			</td>
		</tr>
		<tr>
			<td align="right" style="width:120px">场景码:</td>
			<td><input  type="text" id="title2" name="code" value="<?php if($id>0){ echo $wc['code']; } ?>" class="input-text wid400">请输入：1-100000的整数</td>
		</tr>
        		<tr height="60px">
			<td align="right" style="width:120px"></td>
			<td><input type="submit" name="dosubmit" class="button" value="<?php if($id>0){ echo '确定修改'; }else{ echo '确定添加'; } ?>" /></td>
		</tr>
	</table>
</form>
</div>
</body>
</html> 