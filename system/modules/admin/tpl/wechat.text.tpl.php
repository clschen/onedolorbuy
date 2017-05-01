<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>后台首页</title>

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">

<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

</head>
<style type="text/css">
	.bt{height: 30px; width: 200px;line-height: 30px; padding-left: 5px; padding-right: 5px}
</style>
<body>


<div class="header lr10">

	<?php echo $this->headerment();?>
</div>

<div class="bk10"></div>

<div class="table_form lr10">

<form method="post" action="">

	<table width="100%"  cellspacing="0" cellpadding="0">

	<tr>
		<td>规则名称：<input  class="bt" name="name" value="<?php if($id>0){echo $wechat['name'];} ?>"></td>                 
	</tr>
	
	<tr>
		<td>关键词值：<input class="bt" name="keyword" value="<?php if($id>0){echo $wechat['keyword'];} ?>"></td>                 
	</tr>

	<tr>
		<td>文字内容：<textarea style="height:250px; width:600px; resize:none;padding:15px;" name="contents" ><?php if($id>0){echo $wechat['contents'];} ?></textarea> </td>                 
	</tr>        
	<?php if($id>0){?><input type="hidden" name='id' value="<?php echo $id ?>"><?php }  ?>
        <tr height="60px">

			<td><input type="submit" name="dosubmit" class="button" value="提交内容" /></td>

		</tr>

	</table>

</form>

</div>

 <span id="title_colorpanel" style="position:absolute; left:568px; top:155px" class="colorpanel"></span>

</body>

</html> 