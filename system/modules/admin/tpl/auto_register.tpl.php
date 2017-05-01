<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>

body{ background-color:#fff}

tr{ text-align:center;}
h3{display: inline-block; width: 150px; float: left; height: 38px; line-height: 38px;}
.box{
	position: relative;
	width: 166px;
	height: 38px;
	float: left;
	border: 1px solid #EBEBEB;
	line-height: 30px;
	font: 14px/39px 'MicroSoft Yahei','Simhei';
	background: none repeat scroll 0 0 #F3F3F3;
	color: #999999;
	cursor: pointer;
	text-align: center;
	margin-right: 20px;
}
.box span{
	line-height: 30px;
	height: 38px; 
	display: inline-block;
}
.box em{
	line-height: 38px;
	display: inline-block;
	height: 30px;
}
.btn_addPic{
display: inline-block;
position: relative;
height: 38px;
overflow: hidden;
padding: 0 30px;
line-height: 26px;
margin-left: 20px;
border: 1px solid #EBEBEB;
background: none repeat scroll 0 0 #F3F3F3;
color: #999999;
font: 14px/39px 'MicroSoft Yahei','Simhei';
cursor: pointer;
text-align: center;
line-height: 30px;
}
.btn{
	width: 200px;
	height: 30px;
	background:#3c8dbc;
	border-radius: 4px;
	color: #FFF;
	display: block;
	margin-top: 50px;
	margin-left: 40px;
	line-height: 30px;
	text-align: center;
}
.btn:hover{color: #FF0;}
.filePrew {
display: block;
position: absolute;
top: 0;
left: 0;
width: 166px;
height: 30px;
cursor: pointer;
opacity: 0;
filter:alpha(opacity: 0);
}
p{
	height: 20px;
	line-height: 20px;
}
</style>
</head>
<body>
<div style="margin-top:15px; margin-left:15px;">
	<form method="post" action="<?php echo G_ADMIN_PATH; ?>/auto_register/fileaction" enctype="multipart/form-data">
	         <h3>导入Excel表：</h3><div class="box"><em>+</em><span>添加excel文件</span><input id="file" name="file" type="file"  class="filePrew" /></div>
	         <input type="submit"  value="导入并批量注册" class="btn_addPic" />
	</form>
</div>
	<br/>
	<hr/>
	<a class="btn" href="<?php echo G_PLUGIN_PATH ?>/PHPexcel/piliangzhuce.xls">点击下载范例的excel表格</a>
	<div style="padding:15px; width:90%; border-radius:5px; margin-top:30px; border:1px solid #3c8dbc; margin-left:10px;">
		<p>注：</p>
		<p>用户名,密码,邮箱,手机</p>
		<p>用户名和密码可以不填写</p>
		<p>邮箱和手机必须填写其中一个，也可以两个都填写</p>
		<p style="color:red">重点说明：用户名和邮箱是不能重复的，如果重复，重复项会被过滤。</p>
		<p>密码不写默认为  111111   六个1</p>
		<p style="color:red">我们给定的示例excel格式请不要修改，直接在里面填写数据即可</p>
		
	</div>
</body>
</html> 