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

<form method="post" action="" onSubmit="return CheckForm()">

	<table width="100%"  cellspacing="0" cellpadding="0">

        		<tr>
			<td align="right" style="width:120px"><font color="red">*</font>类型名称:</td>
			<td>
            		<input  type="text" id="title"  name="type_name" value="<?php if($id>0){ echo $wc['type_name']; } ?>" class="input-text wid400 bg">
			</td>
		</tr>
		<tr>
		<td align="right" style="width:120px">红包金额:</td>
		<td><input  type="text" id="title2" name="type_money" value="<?php if($id>0){ echo $wc['type_money']; } ?>" class="input-text wid400"></td>
		</tr>
        	<tr>
		<td align="right" style="width:120px">如何发放此类型红包:</td>
		<td>
			<input type="radio" name="send_type" value="1" checked="checked" />微信关注红包
			<!-- &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" value="3"/>线下发放的红包  -->
		</td>
	</tr>
	<tr>
		<td align="right" style="width:120px">红包总个数:</td>
		<td>
			<input type="text" name="total" value="<?php if($id>0){ echo $wc['total']; } ?>" class="input-text wid400"/>
		</td>
	</tr>
       	<tr>
             <td align="right" style="width:120px"> 发放起始日期：</td>
              <td><input name="send_start_date" type="text" id="xsjx_time" class="input-text posttime"  readonly="readonly" value="<?php if($id>0){ echo date('Y-m-d',$wc['send_start_date']); } ?>" />
		<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "xsjx_time",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
				</script>
            </td>        
	</tr>
	<tr>
	
	  <td align="right" style="width:120px"> 发放结束日期：</td>
	 <td><input name="send_end_date" type="text" id="xsjx_time1" class="input-text posttime"  readonly="readonly" value="<?php if($id>0){ echo date('Y-m-d',$wc['send_end_date']); } ?>" />
		<script type="text/javascript">
				date = new Date();
				Calendar.setup({
				inputField     :    "xsjx_time1",
				ifFormat       :    "%Y-%m-%d",
				showsTime      :    true,
				timeFormat     :    "24"
						});

		</script>
	</td>        
	</tr>
        <tr height="60px">

			<td align="right" style="width:120px"></td>

			<td><input type="submit" name="dosubmit" class="button" value="<?php if($id>0){ echo '确定修改'; }else{ echo '确定添加'; } ?>" /></td>

		</tr>

	</table>

</form>

</div>

 <span id="title_colorpanel" style="position:absolute; left:568px; top:155px" class="colorpanel"></span>

<script type="text/javascript">

    //实例化编辑器

    var ue = UE.getEditor('myeditor');



    ue.addListener('ready',function(){

        this.focus()

    });

    function getContent() {

        var arr = [];

        arr.push( "使用editor.getContent()方法可以获得编辑器的内容" );

        arr.push( "内容为：" );

        arr.push(  UE.getEditor('myeditor').getContent() );

        alert( arr.join( "\n" ) );

    }

    function hasContent() {

        var arr = [];

        arr.push( "使用editor.hasContents()方法判断编辑器里是否有内容" );

        arr.push( "判断结果为：" );

        arr.push(  UE.getEditor('myeditor').hasContents() );

        alert( arr.join( "\n" ) );

    }

	

	var info=new Array();

    function gbcount(message,maxlen,id){

		

		if(!info[id]){

			info[id]=document.getElementById(id);

		}			

        var lenE = message.value.length;

        var lenC = 0;

        var enter = message.value.match(/\r/g);

        var CJK = message.value.match(/[^\x00-\xff]/g);//计算中文

        if (CJK != null) lenC += CJK.length;

        if (enter != null) lenC -= enter.length;		

		var lenZ=lenE+lenC;		

		if(lenZ > maxlen){

			info[id].innerHTML=''+0+'';

			return false;

		}

		info[id].innerHTML=''+(maxlen-lenZ)+'';

    }

	

function set_title_color(color) {

	$('#title2').css('color',color);

	$('#title_style_color').val(color);

}

function set_title_bold(){

	if($('#title_style_bold').val()=='bold'){

		$('#title_style_bold').val('');	

		$('#title2').css('font-weight','');

	}else{

		$('#title2').css('font-weight','bold');

		$('#title_style_bold').val('bold');

	}

}



//API JS

//window.parent.api_off_on_open('open');

</script>

</body>

</html> 