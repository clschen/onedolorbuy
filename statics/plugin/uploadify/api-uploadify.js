/*
**************************
(C)2010-2013 phpMyWind.com
update: 2012-4-27 11:35:55
person: Feng
**************************
*/


/*
 * 获取上传窗口函数
 *
 * @access   public
 * @path	 string  网站主地址
 * @frame    string  调用iframeID
 * @title    string  弹出窗口标题
 * @type     string  可上传文件类型,可以是直接的类型或是image|soft|media
 * @dir     string  可上传文件夹
 * @num      string  可上传数量
 * @size     string  可上传文件大小
 * @input    string  处理后返回值写入input
 * @area     string  多附件时返回的内容区域
 */

function GetUploadify(path,frame,title,type,dir,num,size,input,area)
{	
	var iframe_str='<iframe frameborder="0" ';
		iframe_str=iframe_str+'id="'+frame+'" ';
		iframe_str=iframe_str+'src="'+path+'/api/uploadify/upload/';
		iframe_str=iframe_str+title+'/'+type+'/'+dir+'/'+num+'/'+size+'/'+frame+'/'+input+'/'+area+'"';
		iframe_str=iframe_str+'allowtransparency="true" class="uploadframe" scrolling="no">';
		iframe_str=iframe_str+'</iframe>';
	
	$("body").append(iframe_str);	
	$("#" + frame).css("height",$(document).height()).show();
	$(window).resize(function(){
		$("#" + frame).css("height",$(document).height()).show();
	});
}

/*
 * 删除组图input
 *
 * @access   public
 * @val      string  删除的图片input
 */

function ClearPicArr(val,path)
{
	$("li[rel='"+ val +"']").remove();
	$.get(
			path+'/api/uploadify/delupload/',
			{action:"del", filename:val},
			function(){}
	);
}