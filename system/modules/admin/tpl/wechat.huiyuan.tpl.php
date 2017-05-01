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

		<td width="220" align="right">选择关注送红包类型：&nbsp;</td>

	<td>
                      <select name="type_id">
                      		<option value="0" <?php if($type['type_id']==0){ ?> selected="selected" <?php } ?>>关闭红包功能</option>
                                <?php foreach ($wechat as $k => $v): ?>
                                            <option value="<?php echo $v['type_id']; ?>" <?php if($type['type_id']==$v['type_id']){ ?> selected="selected" <?php } ?>><?php echo $v['type_name'].'==>'.$v['type_money'].'元'; ?></option>
                                <?php endforeach ?>             
                     </select>
            </td>

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