<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>

<div class="table_form lr10">
<?php if(ROUTE_A=='edit'){ ?>
<table width="100%"  cellspacing="0" cellpadding="0">
<form name="form" action="" method="post">
	<tr>
    		<td align="right" class="wid100">所属栏目：</td>
			<td><select name="cateid" class="wid100">
				<?php echo $categoryshtml; ?>
    			</select>
    		</td>
    </tr>
    <tr>
			<td align="right">品牌名称：</td>
			<td><input type="text"  name="name" class="input-text wid100" value="<?php echo $brands['name'] ; ?>"></td>
	</tr>
    <tr>
			<td align="right">排序：</td>
			<td><input type="text"  name="order" onKeyUp="value=value.replace(/[^\d]/ig,'')" class="input-text wid100" value="<?php echo $brands['order'] ; ?>">
            <span>数值越大,排序越靠前</span>
            </td>
	</tr>
    <tr height="60px">
			<td align="right"></td>
			<td><input class="button" type="submit" name="dosubmit" value=" 修改 " /></td>
	</tr>
</form>
</table>
<?php } ?>
<?php if(ROUTE_A=='insert'){ ?>
<table width="100%"  cellspacing="0" cellpadding="0">
<form name="form" action="" method="post">
	<tr>
    		<td align="right" class="wid100">所属栏目：</td>
			<td><select name="cateid">
            	<option selected>≡ 请选择分类 ≡</option>
				<?php echo $categoryshtml; ?>
    			</select>
    		</td>
    </tr>
    <tr>
			<td align="right">品牌名称：</td>
			<td><input type="text"  name="name" class="input-text wid100"></td>
	</tr>
    <tr>
			<td align="right">排序：</td>
			<td><input type="text"  name="order" onKeyUp="value=value.replace(/[^\d]/ig,'')" class="input-text wid100">
            <span>数值越大,排序越靠前</span>
            </td>
	</tr>
    <tr height="60px">
			<td align="right"></td>
			<td><input class="button" type="submit" name="dosubmit" value=" 添加 " /></td>
	</tr>
</form>
</table>
<?php } ?>
</div>
</body>
</html> 
