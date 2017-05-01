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

		<td width="220" align="right">Token :&nbsp;</td>

		<td><input type="text" name="token" value="<?php echo $wechat['token']; ?>"  class="input-text wid200"></td>

	</tr>

    	<tr>

		<td width="220" align="right">AppId :&nbsp;</td>

		<td><input type="text" value="<?php echo $wechat['appid']; ?>" name="appid" class="input-text wid200"></td>
	</tr>

  	 <tr>

			<td width="220" align="right">AppSecret :&nbsp;</td>

			<td><input type="text" value="<?php echo $wechat['appsecret']; ?>" name="appsecret" class="input-text wid200"></td>

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