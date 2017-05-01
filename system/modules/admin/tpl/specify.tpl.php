<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title></title>

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">

<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">

<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

<script src="<?php echo G_PLUGIN_PATH; ?>/uploadify/api-uploadify.js" type="text/javascript"></script> 

<style>

td{height:40px;line-height:40px; padding-left:20px;}

.span_1{

	float:left;

	margin-left:0px;

	height:130px;

	line-height:130px;

}

ul{

}

li{

	border:1px solid #CCC;

	height:40px;

	padding:0px 10px;

	margin-left:-1px;

	margin-top:-1px;

	line-height:40px;

}

</style>

</head>

<body>

<div class="bk10"></div>

<div class="table-list lr10 lr10">

<!--start-->

<form name="myform" action="" method="post">

  <table width="100%" cellspacing="0" >

		<tr class="watermark_image">

			<td width="120">指定中奖的商品ID:</td>

			<td>

            <input type="text" name="shopid" value="<?php echo $upload_set['watermark_condition']['width']; ?>"  class="input-text">商品ID请从<font style="color:red">（商品管理》商品列表）</font>的id选择，已开奖项目不能添加！

            </td>

		</tr>	 

		<tr class="watermark_image">

			<td width="120">请填写中奖人ID:</td>

			<td><input type="text" name="userid" value="<?php echo $upload_set['watermark_good'];?>"  class="input-text"><span> 会员ID从 <font style="color:red">（用户管理》会员列表）</font>中 选择</span></td>

		</tr>	

		<tr>

        	<td width="120"></td>

            <td>

            <input type="submit" class="button" name="dosubmit"  value=" 提交 " >

            </td>

		</tr>

</table>

</form>

<div clear="clear:both;"></div>

</div><!--table-list end-->

<script type="text/javascript">



function show_div(t){

	if(t=='text'){

		$(".watermark_text").show();

		$(".watermark_image").hide();

	}else{

		$(".watermark_text").hide();

		$(".watermark_image").show();

	}

}



$(function(){

	$("#sel_<?php echo $upload_set['watermark_position']; ?>").attr("checked","checked");  

		   

});

<?php if($upload_set['watermark_type'] == 'text'): ?>

	show_div('text');

<?php else: ?>

	show_div('image');

<?php endif; ?>

</script>

</body>

</html> 