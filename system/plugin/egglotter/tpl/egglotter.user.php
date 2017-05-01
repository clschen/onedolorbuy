<?php include "egglotter.header.php"; ?>
<style type="text/css">
@charset "utf-8";
/* CSS Document */
html,body,div,span,h1,h2,h3,h4,h5,h6,p,pre,a,code,em,img,small,strong,sub,sup,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}
a{color:#007bc4/*#424242*/; text-decoration:none;}
a:hover{text-decoration:underline}
ol,ul{list-style:none}
table{border-collapse:collapse;border-spacing:0}
body{height:100%; font:12px/18px "Microsoft Yahei", Tahoma, Helvetica, Arial, Verdana, "\5b8b\4f53", sans-serif; color:#51555C; background:#162934 url(../images/body_bg.gif) repeat-x}
img{border:none}

table {border-spacing:0}
.fullwidth{width:100%;}
.block{margin:15px auto;width:1200px; _height:500px; min-height:500px; background:#fff;}
.table_solid {border-bottom:1px solid #999;border-right:1px solid #999;margin-bottom:0px;}
.table_solid th,.table_solid td{border-left:1px solid #999;border-top:1px solid #999;color:#333333;padding:0.5em;}
.table_solid th{background-color:#B8CCE4;}

#pages{height:25px;line-height:25px;  margin:20px 0px;font: 12px/1.5 tahoma,arial,宋体b8b\4f53,sans-serif;}
#pages ul{ float:right}
#pages ul li{ float:left;display:block; line-height:25px;padding:0px 10px; background-color:#eef3f7; margin-left:1px;}
#pages ul li a{}
.zjiang{font-family:Microsoft Yahei; font-size:50px;text-align:center;padding:200px 0;}
</style>
<div class="block"> 
	<?php 
		if($total==0){ 
			echo '<p class="zjiang">你还未中奖</p>';
		}else{
	?>
	<table class="fullwidth table_solid">
		<tr>
			<th align="center">中奖用户名</th>
			<th align="center" width="285px" >中奖期数</th>
			<th align="center" width="285px" >奖品</th>
			<th align="center" width="185px" class="txt_c">中奖时间</th>
			<!--<th width="185px">奖品是否发放</th>-->
		</tr>
		<?php 
			foreach($award as $ad){
				echo '<tr>';
				foreach($member as $m){
					if($m['uid']==$ad['user_id']){
						if($m['username']!=null){
							echo '<td align="center">'.$m['username'].'</td>';
						}else if($m['mobile']!=null){
							echo '<td align="center">'.$m['mobile'].'</td>';
						}else if($m['email']!=null){
							echo '<td align="center">'.$m['email'].'</td>';
						}						
					}
				}
				foreach($rule as $re){
					if($re['rule_id']==$ad['rule_id']){
						echo '<td align="center">'.$re['rule_name'].'</td>';
					}
				}
				foreach($slinfo as $linfo){
					if($linfo['spoil_id']==$ad['spoil_id']){
					echo '<td align="center">'.$linfo['spoil_name'].'</td>';
					}
				}		
				echo '<td align="center">'.date("Y-m-d H:i",$ad['subtime']).'</td>';
				//echo '<td>'.$ad['user_name'].'</td>';
				echo '</tr>';
			}
			
		?>	 
	</table>
	<div id="pages">
	<a style="padding:0 0 0 10px;" href="<?php echo WEB_PATH."/api/plugin/get/egglotter" ?>">返回砸金蛋游戏</a>
	<ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
	<?php  }?>
</div>

<script>
$(function(){
	$(".h_1yyg").mouseover(function(){
		$(".h_1yyg_eject").show();
	});
	$(".h_1yyg").mouseout(function(){
		$(".h_1yyg_eject").hide();
	});
	$(".h_news").mouseover(function(){
		$(".h_news_down").show();
	});
	$(".h_news").mouseout(function(){
		$(".h_news_down").hide();
	});
});
$(function(){
	$("#txtSearch").focus(function(){
		$("#txtSearch").css({background:"#FFFFCC"});
		var va1=$("#txtSearch").val();
		if(va1=="iPhone5"){
			$("#txtSearch").val("");
		}
	});
	$("#txtSearch").blur(function(){
		$("#txtSearch").css({background:"#FFF"});
		var va2=$("#txtSearch").val();
		if(va2==""){
			$("#txtSearch").val("iPhone5");
		}			
	});
	$("#butSearch").click(function(){
		window.location.href="<?php echo WEB_PATH;?>/search/index/tag/"+$("#txtSearch").val();
	});
});

$(document).ready(function(){
	$.get("<?php echo WEB_PATH;?>/member/cart/getnumber",{},function(data){
		$("#sCartTotal").text(data);											
	});
});
</script>
<?php include "egglotter.footer.php"; ?>