<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
.button1{color: #FFF; background: #161e22; padding:5px 15px 5px 15px;margin-right: 25px;float: right; margin-top: 10px; display: inline-block;border-radius: 5px; border: none; cursor: pointer;}
.button1:hover{background: #222d32; color:#ffff00;}
.btns{width: 30px; margin-right: 3px; border-radius: 3px; float: left; height: 30px; text-align: center; line-height: 30px; cursor: pointer;}
.wid100{width:100px;}
</style>
</head>
<body>
<div class="header lr10" style="height:42px; line-height:42px;">
	<b>自动刷人气设置</b>注：
  <font style="color:red; font-weight:700">1、点击关闭后,如果想再次开起,需至少等待上次设置的间隔时间段(秒)的最大秒数
  2、请不要更改本插件的源代码及文件名、否则后果自负
  3、请确保有批量注册用户后方可开启 </font>
<input id="start_auto_p" type="button" value="保存配置并开启" class="button1"/> &nbsp;
<input id="stop_auto_p" type="button" value="关闭" class="button1"/> </div>
</div>
<div class="bk10"></div>

<div class="table_form lr10">
	<table width="100%"  cellspacing="0" cellpadding="0">
	<tr>
	<td align="right" style="width:130px">间隔时间段(秒)：</td>
	<td><input id="times" type="text"   value="<?php echo $times; ?>" class="input-text wid100"/> 
	— <input id="endtimes" type="text" value="<?php echo $endtimes;?>" class="input-text wid100" />&nbsp;&nbsp;&nbsp;&nbsp;开始时间:大于等于1的正整数,结束时间：大于开始时间的正整数。</td>

	</tr>
	<tr>
		<td align="right" style="width:130px">指定用户id段：</td>
		<td><input  id="f_userid" type="text"  value="<?php echo $userid[0];?>" class="input-text wid100" /> — <input  id="l_userid" type="text"  value="<?php echo $userid[1];?>"  class="input-text wid100"/></td>
	</tr>
	<tr>
		<td align="right" style="width:120px">指定购买时段：</td>
		<td style="line-height:30px;">
		<?php for($i=0;$i<24;$i++){ ?>
				<?php if($i%6 ==0){ ?>
				<?php } ?>	
				
				<?php $x = -1; ?>	
				<?php foreach($tp as $k=>$v){?>	
						<?php if($v == $i){ ?>
							<?php $x = 1; break; ?>
						<?php }?>
				<?php }?>
				
				<?php if($x == 1){?>
					<div class="btns" style="background:#3c8dbc;"><?php echo $i;?></div>
				<?php }else{?>
					<div class="btns"><?php echo $i;?></div>
				<?php }?>
				
				<?php if(($i+1)%6 ==0){ ?>	
				<?php } ?>		
		<?php }?>
		&nbsp;&nbsp;&nbsp;&nbsp;指定购买小时段： <font style="color:red"><?php echo $timeperiod; ?></font></td>
	</tr>
	
	<tr>
	<td align="right" style="width:130px">自动进入下一期：</td>
	<td style="line-height:30px;">
	<input id="autoadd" type="checkbox"<?php if($autoadd == 1 ){ ?> checked="checked"<?php }?>/>
	<input type="hidden" id="autoadd_value" value="<?php echo $autoadd; ?>"/>
	</td>
	</tr>
	<tr>
	<td align="right" style="width:130px">随机购买多个商品：</td>
	<td>
	<input id="m_shop" type="checkbox" <?php if($mshop ==1){ ?>checked="checked"<?php } ?>/>
	<input type="hidden" id="m_shop_value" value="<?php echo $mshop; ?>"/>
	指定购买商品：&nbsp;&nbsp;&nbsp;&nbsp;<label id="shopid" style="color:red"><?php echo $shopid; ?></label>
	</td>

	</table>
	</div>
<div class="table-list lr10">
	 <table width="100%" cellspacing="0">
	 	<thead>
				<tr>
					<th width="30"><input id="cb_all" type="checkbox" /></th>
					<th width="60">ID</th>
					<th width="260">商品标题</th>
					<th width="130">所属栏目</th>
					<th width="120">已参与/总需</th>
					<th width="115">单价/元</th>
					<th width="120">期数/最大期数</th>
				</tr>
		</thead>
		<tbody>	
			<?php foreach($shoplist as $shop){?>
			<tr>
				<td width="30" align="center"><input class="cb" type="checkbox" <?php 
					$tem = -1;
					for($i=0;$i<count($shopidarray );$i++){
						if($shopidarray[$i] == $shop['id'] ){
							$tem =1;
						}
					}
					
					?><?php if($tem ==1) {?>checked="checked" <?php }?>/>
					<input class="cb_value" type="hidden" value="<?php echo $shop['id'] ?>"/></td>
					<td width="60" align="center"><?php echo $shop['id'] ?></td>
					<td align="center" width="260" title="<?php echo $shop['title']?>"><?php echo $shop['title']?></td>
					<td align="center" width="130"><?php echo $this->categorys[$shop['cateid']]['name']; ?></td>
					<td align="center" width="120"><?php echo $shop['canyurenshu'] ?>/<?php echo $shop['zongrenshu'] ?></td>
					<td align="center" width="115"><?php echo $shop['yunjiage']?></td>
					<td align="center" width="120"><?php echo $shop['qishu']?>/<?php echo $shop['maxqishu'] ?></td>
				</tr>
				<?php }?>
			</table>
</div>

<div id="pages">
<ul>
<li>共 <?php echo $total; ?> 条</li>
<li id='Page_Prev'><a href="<?php echo WEB_PATH.'/auto/auto_p/show/'.$o_p;?>">上一页</a></li>
<li id='Page_Next'><a href="<?php  echo WEB_PATH.'/auto/auto_p/show/'.$n_p;?>">下一页</a></li>
<li id='Page_One'><a href="<?php echo WEB_PATH.'/auto/auto_p/show/1';?>">首页</a></li>
</ul>
</div>

</body>
</html> 
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/css/jquery.min.js" type="text/javascript"></script>
<script>
var timeperiod = "<?php echo $timeperiod; ?>";
$(function(){
	$("#start_auto_p").click(function(){
		var times = $("#times").val();
		var endtimes = $("#endtimes").val();
		var f_userid = $("#f_userid").val();
		var l_userid = $("#l_userid").val();
		var shopid = $("#shopid").html();
		var autoadd = $("#autoadd_value").val();
		var m_shop_value = $("#m_shop_value").val();
		if(timeperiod == ""){
			alert("请设置购买时段");
		}
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/ajaxaction';?>",
			type:"POST",
			data:{times:times,f_userid:f_userid,l_userid:l_userid,shopid:shopid,autoadd:autoadd,endtimes:endtimes,m_shop_value:m_shop_value,timeperiod:timeperiod},
			success:function(data){
				alert(data);
			}
		});
		alert("成功开起");
	});
	
	$("#stop_auto_p").click(function(){
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/stop';?>",
			type:"POST",
			success:function(data){
				//alert(data);
			}
		});
		alert("已关闭");
	});
	
	$("#cb_all").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			//var aa = $(".cb_value").val();
			var shopid = null;
			$(".cb_value").each(function(){
				if(shopid == null){
					shopid = $(this).val();
				}else{
					shopid = shopid+"-"+$(this).val();
				}
			  });
			$("#shopid").html(shopid);
			$(".cb").attr("checked","checked");
		}else{
			$("#shopid").html('');
			$(".cb").attr("checked",false);
		}
	});
	
	$(".cb").click(function(){
		var c = $(this).attr("checked");
		var shopid = $.trim($("#shopid").html());
		var id = $(this).next().val();
		if(c == "checked" )
		{
			var sarray = shopid.split("-");
			if($.trim(shopid) == '' || $.trim(shopid) ==null  ){
				$("#shopid").html(id);
			}else{
				//判断里面是否有相同的值
				var tem = null;
				for(var i=0;i<sarray.length;i++){
					if(sarray[i] == id){
						tem = i;
					}
				}
				if(tem == null ){
					$("#shopid").html(shopid+"-"+id);
				}else{
					$("#shopid").html(shopid);
				}
			}
		}else{
			var sarray = shopid.split("-");
			var newsarray = new  Array();
			for(var i=0;i<sarray.length;i++){
				if(sarray[i] != id){
					newsarray[newsarray.length] = sarray[i];
				}
			}
			var aaa = newsarray.join("-");
			$("#shopid").html(aaa);
		}
		
	});
	//是否自动进入下一期
	$("#autoadd").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			$("#autoadd_value").val(1);
		}else{
			$("#autoadd_value").val(0);
		}
	});
	
	//程序是否运行正常
	var isstop = <?php echo $isstop;  ?>;
	if(isstop == 0){
		$.ajax({
			url:"<?php echo WEB_PATH.'/auto/auto_p/errorrestart/';?>",
			type:"POST",
			success:function(data){
			}
		});
		alert("重启成功");
	}
	//是否随机购买多个商品
	$("#m_shop").click(function(){
		var checked =  $(this).attr("checked");
		if(checked =="checked"){
			$("#m_shop_value").val(1);
		}else{
			$("#m_shop_value").val(0);
		}
	});
	
	
	//时间段点击
	$(".btns").click(function(){
		var t = $(this).html();
		if(timeperiod == ""){
			timeperiod = timeperiod+t;
			$(this).css({"background":"#0066FF","color":"red"});
		}else{
			var tparray = timeperiod.split("-");
			var newtparray = new Array();
			//判断已有数组是否有这个值,有就删除，并且改变颜色
			var iin = -1;
			var tdcss = 0;
			for(var i = 0;i<tparray.length;i++){
				if(t == tparray[i]){
					iin = i;
					tdcss = 1;
					 break;
				}
			}
			if(iin == -1){//没有相同的需要添加
				tparray[tparray.length] = t;
				timeperiod = tparray.join("-");
			}else{//有相同的  需要删除
				var s = 0;
				for(var x = 0;x<tparray.length;x++){
					if(iin != x){
						newtparray[s] = tparray[x];
						s++;
					}
				}
				timeperiod = newtparray.join("-");
			}
			if(tdcss == 0){
				$(this).css({"background":"#0066FF","color":"red"});
			}else{
				$(this).css("background","#C5D9EB");
			}
		}

	});
});
</script>