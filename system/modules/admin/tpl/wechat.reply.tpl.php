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

<body>


<div class="header lr10">

	<?php echo $this->headerment();?>
</div>

<div class="bk10"></div>

<div class="table_form lr10">

<form method="post" action="">

	<table width="100%"  cellspacing="0" cellpadding="0">

	<tr>
		<td><textarea style="height:300px; width:700px; resize:none;padding:15px;" name="reply" ><?php echo $wechat; ?></textarea> </td>                 

		</tr>         

        <tr height="60px">

			<td><input type="submit" name="dosubmit" class="button" value="提交内容" /></td>

		</tr>

	</table>

</form>

</div>

 <span id="title_colorpanel" style="position:absolute; left:568px; top:155px" class="colorpanel"></span>

</body>

</html> 