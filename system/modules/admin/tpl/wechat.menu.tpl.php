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
td{padding:10px;}
tr{height:40px;line-height:40px}
th{
	height: 30px;
	background: #3C8DBC;
	font-weight: normal;
	color: #FFF;
	border-style: solid;
	border-color: #E2E2E2;
	-moz-border-top-colors: none;
	-moz-border-right-colors: none;
	-moz-border-bottom-colors: none;
	-moz-border-left-colors: none;
	border-image: none;
	border-width: 0px 1px 1px 0px;
	padding-left: 5px;

}
.wid100{width: 100px;}
.wid200{width: 300px;}
.h30{height: 30px;}
.h35{height: 35px;}
.h25{height: 25px;}
.h20{height: 20px;}
select{
	height: 34px;
	margin: 0px 10px 0px 0px;
	padding: 2px 5px 2px 5px;
	border: 1px solid #B4B4B4;
	font-size: 12px;
	line-height: 34px;
	border-radius: 3px;
}
</style>

</head>

<body>

<div class="header lr10">

	<?php echo $this->headerment();?>

</div>
<div class="header lr10" style="height:34px; font-size:14px;line-height:34px; background:#222d32; color:#FFF; font-weight:500;">
	<p>重要使用说明：<font style="color:#ff0;">如果您需要设置一级菜单的关键字或链接，则需要对二级菜单的所有设置留空，如果设置了2级菜单，则一级菜单的链接或者关键字将被过滤掉！设置时请注意哦</font></p>
</div>
<div class="bk10"></div>

<div class="table-list lr10">

<!--start-->

<form name="myform" action="" method="post">

  <table width="100%" cellspacing="0">
	<tr><th>序号</th><th>一级菜单</th><th>子菜单</th></tr>   
	 <tr>
	  <td width="80" align="center">菜单一</td>
	   <td width="680">
	    &nbsp;&nbsp;菜单名称：&nbsp;<input type="text" size="10" name="button_0" value="<?php echo  $we[0]['name'] ?>" class="input-text wid100" />-------
		<select name="type_0"> 
			<option value="url" <?php if(isset($we[0]['type']) && $we[0]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['type']) && $we[0]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>

	    值：<input type="text" name="urlkey_0" size="30" value="<?php if(isset($we[0]['type']) && $we[0]['type'] == 'click'){ echo $we[0]['key']; }elseif(isset($we[0]['type']) && $we[0]['type'] == 'view'){ echo $we[0]['url']; } ?>" class="input-text wid200"/>
	   </td>
	   <td style="padding-left:30px;padding-top:10px; padding-bottom:10px;">
	    <p>
	     子菜单名称1：<input type="text"  size="10"  name="sub_button_0_0" value="<?php if(isset($we[0]['sub_button']) && isset($we[0]['sub_button'][0]['name'])){ echo $we[0]['sub_button'][0]['name']; } ?>" class="input-text wid100 h20"/>
		<select name="type_0_0" class="h25">
			<option value="url"  <?php if(isset($we[0]['sub_button'][0]['type']) && $we[0]['sub_button'][0]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['sub_button'][0]['type']) && $we[0]['sub_button'][0]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_0_0" size="30"  value="<?php if(isset($we[0]['sub_button'][0]['type']) && $we[0]['sub_button'][0]['type'] == 'click'){ echo $we[0]['sub_button'][0]['key']; }elseif(isset($we[0]['sub_button'][0]['type']) && $we[0]['sub_button'][0]['type'] == 'view'){ echo $we[0]['sub_button'][0]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称2：<input type="text"  size="10"  name="sub_button_0_1" value="<?php if(isset($we[0]['sub_button']) && isset($we[0]['sub_button'][1]['name'])){ echo $we[0]['sub_button'][1]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_0_1" class="h25">
			<option value="url"  <?php if(isset($we[0]['sub_button'][1]['type']) && $we[0]['sub_button'][1]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['sub_button'][1]['type']) && $we[0]['sub_button'][1]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_0_1" size="30"  value="<?php if(isset($we[0]['sub_button'][1]['type']) && $we[0]['sub_button'][1]['type'] == 'click'){ echo $we[0]['sub_button'][1]['key']; }elseif(isset($we[0]['sub_button'][1]['type']) && $we[0]['sub_button'][1]['type'] == 'view'){ echo $we[0]['sub_button'][1]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称3：<input type="text"  size="10"  name="sub_button_0_2"  value="<?php if(isset($we[0]['sub_button']) && isset($we[0]['sub_button'][2]['name'])){ echo $we[0]['sub_button'][2]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_0_2" class="h25">
			<option value="url"  <?php if(isset($we[0]['sub_button'][2]['type']) && $we[0]['sub_button'][2]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['sub_button'][2]['type']) && $we[0]['sub_button'][2]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_0_2" size="30"  value="<?php if(isset($we[0]['sub_button'][2]['type']) && $we[0]['sub_button'][2]['type'] == 'click'){ echo $we[0]['sub_button'][2]['key']; }elseif(isset($we[0]['sub_button'][2]['type']) && $we[0]['sub_button'][2]['type'] == 'view'){ echo $we[0]['sub_button'][2]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称4：<input type="text"  size="10"  name="sub_button_0_3"  value="<?php if(isset($we[0]['sub_button']) && isset($we[0]['sub_button'][3]['name'])){ echo $we[0]['sub_button'][3]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_0_3" class="h25">
			<option value="url"  <?php if(isset($we[0]['sub_button'][3]['type']) && $we[0]['sub_button'][3]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['sub_button'][3]['type']) && $we[0]['sub_button'][3]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_0_3" size="30"  value="<?php if(isset($we[0]['sub_button'][3]['type']) && $we[0]['sub_button'][3]['type'] == 'click'){ echo $we[0]['sub_button'][3]['key']; }elseif(isset($we[0]['sub_button'][3]['type']) && $we[0]['sub_button'][3]['type'] == 'view'){ echo $we[0]['sub_button'][3]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称5：<input type="text"  size="10"  name="sub_button_0_4"  value="<?php if(isset($we[0]['sub_button']) && isset($we[0]['sub_button'][4]['name'])){ echo $we[0]['sub_button'][4]['name']; } ?>" class="input-text wid100 h20"/>
	   <select name="type_0_4" class="h25">
			<option value="url"  <?php if(isset($we[0]['sub_button'][4]['type']) && $we[0]['sub_button'][4]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[0]['sub_button'][4]['type']) && $we[0]['sub_button'][4]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_0_4" size="30"  value="<?php if(isset($we[0]['sub_button'][4]['type']) && $we[0]['sub_button'][4]['type'] == 'click'){ echo $we[0]['sub_button'][4]['key']; }elseif(isset($we[0]['sub_button'][4]['type']) && $we[0]['sub_button'][4]['type'] == 'view'){ echo $we[0]['sub_button'][4]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	   </td>
	   </tr>
	   <tr>
	   <td width="80" align="center">菜单二</td>
	   <td>
	    &nbsp;&nbsp;菜单名称：&nbsp;<input type="text" size="10" name="button_1"   value="<?php echo  $we[1]['name'] ?>" class="input-text wid100"/>-------
		<select name="type_1">
			<option value="url" <?php if(isset($we[1]['type']) && $we[1]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
		            <option value="key" <?php if(isset($we[1]['type']) && $we[1]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	    值：<input type="text" name="urlkey_1" size="30" value="<?php if(isset($we[1]['type']) && $we[1]['type'] == 'click'){ echo $we[1]['key']; }elseif(isset($we[1]['type']) && $we[1]['type'] == 'view'){ echo $we[1]['url']; } ?>" class="input-text wid200"/>
	   </td>
	   <td style="padding-left:30px;padding-top:10px; padding-bottom:10px;">
	    <p>
	     子菜单名称1：<input type="text"  size="10"  name="sub_button_1_0" value="<?php if(isset($we[1]['sub_button']) && isset($we[1]['sub_button'][0]['name'])){ echo $we[1]['sub_button'][0]['name']; } ?>" class="input-text wid100 h20"/>
	        <select name="type_1_0" class="h25">
			<option value="url"  <?php if(isset($we[1]['sub_button'][0]['type']) && $we[1]['sub_button'][0]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[1]['sub_button'][0]['type']) && $we[1]['sub_button'][0]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_1_0" size="30" value="<?php if(isset($we[1]['sub_button'][0]['type']) && $we[1]['sub_button'][0]['type'] == 'click'){ echo $we[1]['sub_button'][0]['key']; }elseif(isset($we[1]['sub_button'][0]['type']) && $we[1]['sub_button'][0]['type'] == 'view'){ echo $we[1]['sub_button'][0]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称2：<input type="text"  size="10"  name="sub_button_1_1" value="<?php if(isset($we[1]['sub_button']) && isset($we[1]['sub_button'][1]['name'])){ echo $we[1]['sub_button'][1]['name']; } ?>" class="input-text wid100 h20"/>
	       <select name="type_1_1" class="h25">
			<option value="url"  <?php if(isset($we[1]['sub_button'][1]['type']) && $we[1]['sub_button'][1]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[1]['sub_button'][1]['type']) && $we[1]['sub_button'][1]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_1_1" size="30" value="<?php if(isset($we[1]['sub_button'][1]['type']) && $we[1]['sub_button'][1]['type'] == 'click'){ echo $we[1]['sub_button'][1]['key']; }elseif(isset($we[1]['sub_button'][1]['type']) && $we[1]['sub_button'][1]['type'] == 'view'){ echo $we[1]['sub_button'][1]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称3：<input type="text"  size="10"  name="sub_button_1_2"  value="<?php if(isset($we[1]['sub_button']) && isset($we[1]['sub_button'][2]['name'])){ echo $we[1]['sub_button'][2]['name']; } ?>" class="input-text wid100 h20"/>
	      <select name="type_1_2" class="h25">
			<option value="url"  <?php if(isset($we[1]['sub_button'][2]['type']) && $we[1]['sub_button'][2]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[1]['sub_button'][2]['type']) && $we[1]['sub_button'][2]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_1_2" size="30" value="<?php if(isset($we[1]['sub_button'][2]['type']) && $we[1]['sub_button'][2]['type'] == 'click'){ echo $we[1]['sub_button'][2]['key']; }elseif(isset($we[1]['sub_button'][2]['type']) && $we[1]['sub_button'][2]['type'] == 'view'){ echo $we[1]['sub_button'][2]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称4：<input type="text"  size="10"  name="sub_button_1_3"  value="<?php if(isset($we[1]['sub_button']) && isset($we[1]['sub_button'][3]['name'])){ echo $we[1]['sub_button'][3]['name']; } ?>" class="input-text wid100 h20"/>
	      <select name="type_1_3" class="h25">
			<option value="url"  <?php if(isset($we[1]['sub_button'][3]['type']) && $we[1]['sub_button'][3]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[1]['sub_button'][3]['type']) && $we[1]['sub_button'][3]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_1_3" size="30" value="<?php if(isset($we[1]['sub_button'][3]['type']) && $we[1]['sub_button'][3]['type'] == 'click'){ echo $we[1]['sub_button'][3]['key']; }elseif(isset($we[1]['sub_button'][3]['type']) && $we[1]['sub_button'][3]['type'] == 'view'){ echo $we[1]['sub_button'][3]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称5：<input type="text"  size="10"  name="sub_button_1_4" value="<?php if(isset($we[1]['sub_button']) && isset($we[1]['sub_button'][4]['name'])){ echo $we[1]['sub_button'][4]['name']; } ?>" class="input-text wid100 h20"/>
	       <select name="type_1_4" class="h25">
			<option value="url"  <?php if(isset($we[1]['sub_button'][4]['type']) && $we[1]['sub_button'][4]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[1]['sub_button'][4]['type']) && $we[1]['sub_button'][4]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_1_4" size="30" value="<?php if(isset($we[1]['sub_button'][4]['type']) && $we[1]['sub_button'][4]['type'] == 'click'){ echo $we[1]['sub_button'][4]['key']; }elseif(isset($we[1]['sub_button'][4]['type']) && $we[1]['sub_button'][4]['type'] == 'view'){ echo $we[1]['sub_button'][4]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	   </td>
	            </tr>
	            <tr>
	  <td width="80" align="center">菜单三</td>
	   <td>
	    &nbsp;&nbsp;菜单名称：&nbsp;<input type="text" size="10" name="button_2"  value="<?php echo  $we[2]['name'] ?>" class="input-text wid100"/>-------
		<select name="type_2">
			<option value="url" <?php if(isset($we[2]['type']) && $we[2]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['type']) && $we[2]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	    值：<input type="text" name="urlkey_2" size="30" value="<?php if(isset($we[2]['type']) && $we[2]['type'] == 'click'){ echo $we[2]['key']; }elseif(isset($we[2]['type']) && $we[2]['type'] == 'view'){ echo $we[2]['url']; } ?>" class="input-text wid200"/>
	   </td>
	            <td style="padding-left:30px;padding-top:10px; padding-bottom:10px;">
	    <p>
	     子菜单名称1：<input type="text"  size="10"  name="sub_button_2_0" value="<?php if(isset($we[2]['sub_button'])  && isset($we[2]['sub_button'][0]['name'])){ echo $we[2]['sub_button'][0]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_2_0" class="h25">
			<option value="url"  <?php if(isset($we[2]['sub_button'][0]['type']) && $we[2]['sub_button'][0]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['sub_button'][0]['type']) && $we[2]['sub_button'][0]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_2_0" size="30" value="<?php if(isset($we[2]['sub_button'][0]['type']) && $we[2]['sub_button'][0]['type'] == 'click'){ echo $we[2]['sub_button'][0]['key']; }elseif(isset($we[2]['sub_button'][0]['type']) && $we[2]['sub_button'][0]['type'] == 'view'){ echo $we[2]['sub_button'][0]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称2：<input type="text"  size="10"  name="sub_button_2_1" value="<?php if(isset($we[2]['sub_button']) && isset($we[2]['sub_button'][1]['name'])){ echo $we[2]['sub_button'][1]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_2_1" class="h25">
			<option value="url"  <?php if(isset($we[2]['sub_button'][1]['type']) && $we[2]['sub_button'][1]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['sub_button'][1]['type']) && $we[2]['sub_button'][1]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_2_1" size="30" value="<?php if(isset($we[2]['sub_button'][1]['type']) && $we[2]['sub_button'][1]['type'] == 'click'){ echo $we[2]['sub_button'][1]['key']; }elseif(isset($we[2]['sub_button'][1]['type']) && $we[2]['sub_button'][1]['type'] == 'view'){ echo $we[2]['sub_button'][1]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称3：<input type="text"  size="10"  name="sub_button_2_2" value="<?php if(isset($we[2]['sub_button']) && isset($we[2]['sub_button'][2]['name'])){ echo $we[2]['sub_button'][2]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_2_2" class="h25">
			<option value="url"  <?php if(isset($we[2]['sub_button'][2]['type']) && $we[2]['sub_button'][2]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['sub_button'][2]['type']) && $we[2]['sub_button'][2]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_2_2" size="30" value="<?php if(isset($we[2]['sub_button'][2]['type']) && $we[2]['sub_button'][2]['type'] == 'click'){ echo $we[2]['sub_button'][2]['key']; }elseif(isset($we[2]['sub_button'][2]['type']) && $we[2]['sub_button'][2]['type'] == 'view'){ echo $we[2]['sub_button'][2]['url']; } ?>" class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称4：<input type="text"  size="10"  name="sub_button_2_3" value="<?php if(isset($we[2]['sub_button']) && isset($we[2]['sub_button'][3]['name'])){ echo $we[2]['sub_button'][3]['name']; } ?>" class="input-text wid100 h20"/>
	     <select name="type_2_3" class="h25">
			<option value="url"  <?php if(isset($we[2]['sub_button'][3]['type']) && $we[2]['sub_button'][3]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['sub_button'][3]['type']) && $we[2]['sub_button'][3]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_2_3" size="30" value="<?php if(isset($we[2]['sub_button'][3]['type']) && $we[2]['sub_button'][3]['type'] == 'click'){ echo $we[2]['sub_button'][3]['key']; }elseif(isset($we[2]['sub_button'][3]['type']) && $we[2]['sub_button'][3]['type'] == 'view'){ echo $we[2]['sub_button'][3]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	    <p>
	     子菜单名称5：<input type="text"  size="10"  name="sub_button_2_4"  value="<?php if(isset($we[2]['sub_button']) && isset($we[2]['sub_button'][4]['name'])){ echo $we[2]['sub_button'][4]['name']; } ?>" class="input-text wid100 h20"/>
	   <select name="type_2_4" class="h25">
			<option value="url"  <?php if(isset($we[2]['sub_button'][4]['type']) && $we[2]['sub_button'][4]['type'] == 'view'){ ?> selected="selected" <?php } ?>>链接url</option>
			<option value="key" <?php if(isset($we[2]['sub_button'][4]['type']) && $we[2]['sub_button'][4]['type'] == 'click'){ ?> selected="selected" <?php } ?>>关键字</option>
		</select>
	     <input type="text" name="urlkey_2_4" size="30" value="<?php if(isset($we[2]['sub_button'][4]['type']) && $we[2]['sub_button'][4]['type'] == 'click'){ echo $we[2]['sub_button'][4]['key']; }elseif(isset($we[2]['sub_button'][4]['type']) && $we[2]['sub_button'][4]['type'] == 'view'){ echo $we[2]['sub_button'][4]['url']; } ?>"  class="input-text wid200 h20"/>
	    </p>
	   </td>
	             </tr>
	  
	

	         <td><input type="submit" class="button" name="tijiao"  value=" 提交 " ></td>





</table>

</form>



</div><!--table-list end-->



<script>

	

</script>

</body>

</html> 