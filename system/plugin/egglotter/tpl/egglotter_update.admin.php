<?php 
date_default_timezone_set("Asia/Shanghai");
$this->mysql_model=System::load_sys_class('model');
$this->db=$this->DB();

$curtime=date('Y-m-d',time());

//判断大于等于当前时间活动 只有一项才能选择启用
$sqlcount=$this->db->GetOne("select count(*) num from `@#_egglotter_rule` where `startusing`=1 and	`endtime`>='$curtime' ");


$sqlspoil_dj=0;

if(isset($_POST['submit'])){
    //奖品   
	
	 $option1=$_POST['option1'];
	 $option2=$_POST['option2'];
	 $option3=$_POST['option3'];	

	 if(count($option1)!=3)_message("奖品只能为3个,且最后一个为不中奖");
	
    //规则设置
	
	$sqlspoildj=trim(htmlspecialchars($_POST['sqlspoil_dj']));	 
	
	
	$rule_name=trim(htmlspecialchars($_POST['rule_name']));	 
	if(empty($rule_name)) _message("请填写活动期数");
	
	
    $starttime=trim(htmlspecialchars($_POST['starttime']));
	$starttime=strtotime($starttime);
	if(empty($starttime)) _message("请填写活动开始时间");
	
	$endtime=trim(htmlspecialchars($_POST['endtime']));
	$endtime=strtotime($endtime);
	if(empty($endtime)) _message("请填写活动结束时间");
	
	$lotterytype=trim(htmlspecialchars($_POST['lotterytype']));
	if(empty($lotterytype)) _message("请填写抽奖类型");
	
	$lotterjb=trim(htmlspecialchars($_POST['lotterjb']));
	if(empty($lotterjb)) _message("请填写消耗的积分或者金币");
	
	$ruledesc=trim(htmlspecialchars($_POST['ruledesc']));
	if(empty($ruledesc)) _message("请填写奖品规则");

	$startusing=trim(htmlspecialchars($_POST['startusing']));
	if(empty($startusing)) _message("请选择是否启用");

       
 

	$subtime=time();



//保存规则
	$this->db->Query("UPDATE `@#_egglotter_rule` SET `rule_name`='$rule_name',`starttime`='$starttime',`endtime`='$endtime',
	`subtime`='$subtime',`lotterytype`='$lotterytype',`lotterjb`='$lotterjb',`ruledesc`='$ruledesc',`startusing`='$startusing'
	where `rule_id`='$id'"); 
	
	
	
 //保存奖品表 
	for($i=0;$i<count($option1);$i++){
     if($sqlspoildj<$option3[$i]){
	    $this->db->Query("INSERT INTO `@#_egglotter_spoil`(rule_id,spoil_name,subtime,spoil_dj,spoil_jl)
	    VALUES('$id','$option1[$i]','$subtime','$option3[$i]','$option2[$i]')"); 	 
	 }else{	
	    $this->db->Query("UPDATE `@#_egglotter_spoil`set `spoil_name`='$option1[$i]',`subtime`='$subtime',`spoil_jl`='$option2[$i]'
	     where `rule_id`='$id' and `spoil_dj`='$option3[$i]'"); 
      }	  
	}
 
	if($this->db->affected_rows()){
			_message("修改成功");
	}else{
			_message("修改失败");
	}
}
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改--砸金蛋游戏</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>

</head>
<body>
<?php include "egglotter.admin.header.php"; ?>
<div class="bk10"></div>
<div class="table-list lr10">
<style type="text/css">
	.wid101{width:200px;}
</style>
<!--start-->
<form name="myform" action=""  method="post">
  <table width="100%" cellspacing="0">
    <tr>
		<td width="120" align="right">活动期数：</td>
		<td>	 
		    <input class="input-text wid100 "  type="text" name="rule_name"  size="40" id="rule_name" value="<?php echo $arr[0]['rule_name'];?>"/> 			 
			<font color="red">*期数不能为空*</font> 
		</div>
		</td>
	</tr>
  	<tr>
		<td width="120" align="right">奖品名称：</td>
		<td>
		<input type="button" id="addItem" value="增加奖品" class="button" onclick="add_option()">
		<font color="red">*奖品为3个,并且最后一个奖项必须设置为不中奖奖项*</font>
		<div id="option_list_1">
		<?php for($i=0;$i<count($spoilarr);$i++){?>	
		<div><br> 		   	    
		    <?php echo $spoilarr[$i]['spoil_dj'];?>等奖:<input class="input-text wid100 " class="option" type="text" name="option1[]"  size="40" require="true" id="opt1" value="<?php echo $spoilarr[$i]['spoil_name'];?>"/> 
			奖品中奖机率：<input class="input-text wid100 " class="option" type="text" name="option2[]"  size="40" require="true" id="opt2" value="<?php echo $spoilarr[$i]['spoil_jl'];?>"/>
			<input   type="hidden" name="option3[]"   id="opt3" value="<?php echo $spoilarr[$i]['spoil_dj'];?>"/>			
			</div>
           <?php $sqlspoil_dj=$spoilarr[$i]['spoil_dj']; }?>
		</div>
		<input type="hidden" name='sqlspoil_dj' value="<?php echo $sqlspoil_dj;?>">
		<div id="new_option"></div>
		</td>
	</tr>
	<tr>
	    <td width="120" align="right"><font color="red" >奖品设置注意项：</font></td>
	    <td><font color="red">该系统中统一所有奖项的机率加起来等于100，机率设置越高，<br/>被抽中的概率就越大；并且最后一个奖项必须设置为不中奖奖项。</font></td>
	</tr>
	<tr>
		<td width="120" align="right">活动开始时间：</td>
		<td><input  type="text" name="starttime" id="starttime" readonly class="input-text wid100 posttime" value="<?php echo date('Y-m-d',$arr[0]['starttime']);?>" ></td>
		<script type="text/javascript">
			date = new Date();
			Calendar.setup({
				inputField     :    "starttime",
				ifFormat       :    "%Y-%m-%d",
				showsTime      :    true,
				timeFormat     :    "24"
		});</script>
	</tr>
	<tr>
		<td width="120" align="right">活动结束时间：</td>
		<td><input type="text" name="endtime" id="endtime" readonly class="input-text wid100 posttime" value="<?php echo date('Y-m-d',$arr[0]['endtime']);?>"></td>
		<script type="text/javascript">
			date = new Date();
			Calendar.setup({
				inputField     :    "endtime",
				ifFormat       :    "%Y-%m-%d",
				showsTime      :    true,
				timeFormat     :    "24"
		});</script>
	</tr>
	<tr>
		<td width="120" align="right">抽奖类型：</td>
		<td><input type="radio" name="lotterytype" id="lotterytype1" value="1" class="input-text" <?php echo $arr[0]['lotterytype']==1?'checked':'';?>>积分
		<input type="radio" name="lotterytype" id="lotterytype3" value="3" class="input-text" <?php echo $arr[0]['lotterytype']==2?'checked':'';?>>会员免费
		<font color="red">*会员免费,就是会员登录后才能砸，一天只能砸一次*</font>
		</td>
	</tr>
	<tr>
		<td width="120" id="jbid1" align="right" style="<?php echo  $arr[0]['lotterytype']==3?'display:none':''?>">每次消耗：</td>
		<td id="jbid2" style="<?php echo  $arr[0]['lotterytype']==3?'display:none':''?>"><input type="text" name="lotterjb" id="jf" class="input-text wid100" value="<?php echo $arr[0]['lotterjb'];?>">(积分)</td>
	</tr>
	<tr>
		<td width="120" align="right">活动规则：</td>
		<td><textarea name="ruledesc" id="ruledesc" style="width:400px;height:100px"><?php echo $arr[0]['ruledesc'];?></textarea>(如：1等奖手机，2等奖50元，3等奖，很遗憾没中奖)</td>
	</tr>
	<tr>
		<td width="120" align="right">是否启用：</td>
		<td><input type="radio" name="startusing" id="startusing1" value="1" class="input-text" <?php echo $arr[0]['startusing']==1?'checked':'';?>>启用
		<input type="radio" name="startusing" id="startusing2" value="2" class="input-text" <?php echo $arr[0]['startusing']==2?'checked':'';?>>不启用
		</td>
	</tr>
	<tr>
		<td width="120" align="right"></td>
		<td><input type="submit" class="button" name="submit" id="submit" value=" 提交 " ></td>
	</tr>
</table>
</form>

</div><!--table-list end-->

<script type="text/javascript">
function trim(s){
	if(s.length>0){
		if(s.charAt(0)==" ")
		s=s.substring(1,s.length);
		if(s.charAt(s.length-1)==" ")
		s=s.substring(0,s.length-1);
		 
		if(s.charAt(0)==" "||s.charAt(s.length-1)==" ")
		return trim(s);
	}
	return s;
} 
$(function(){
    $('form').submit(function(){
   
    var optval=$('#opt1').val();
	var optjl=$('#opt2').val();		 
	var lotterytypeval=$("input[name=lotterytype]:radio:checked").val();
	var jfval=$('#jf').val();
	var ruledesval=$('#ruledesc').val();
	var rule_name=$('#rule_name').val();
	
	trim(optval);	
    trim(optjl);	
	trim(jfval);	
	trim(ruledesval);
	if(rule_name==false){
	   alert("活动标题不能为空");
	   return false;
	}else if(optval==false){
		alert("一等奖不能为空");
		return false;
	}else if(optjl==false || isNaN(optjl)){	 
	    alert("一等奖中奖机率不能为空并且必须是数字");
		return false;	  
	}else if(ruledesval==false){
	  alert("活动规则不能为空");
		return false;
	}else if($('#starttime').val()>$('#endtime').val()){
      alert("活动结束时间不能小于开始时间");
		return false;
	}else{    	
	  return true;
	}       
    }); 
    $('#lotterytype1').click(function(){	     
		$("#jbid1").show();
		$("#jbid2").show();	    	     
    });
    $('#lotterytype2').click(function(){	   
		$("#jbid1").show();
		$("#jbid2").show();	    	     
    });
    $('#lotterytype3').click(function(){	     
		$("#jbid1").hide();
		$("#jbid2").hide();    	     
    });   
    $('#startusing1').click(function(){	  
	    var sqlendtime="<?php echo $sqlcount['num'];?>";
		if(sqlendtime>0){
		    alert("现已有一个活动正在启用");
		    return false;
		}else{
		    return ture;
		}	  
	});   
 })
   

</script>
</body>
</html> 


<script type="text/javascript">
var i = <?php echo $sqlspoil_dj?>;
function add_option() {
	//var i = 1;
	if(i<3){
		var htmloptions = '';
		htmloptions += '<div id='+i+'><span><br>'+(i+1)+'等奖:<input type="text"  name="option1[]" size="40" msg="必填" value="" class="input-text wid100"/>&nbsp;奖品中奖机率：<input class="input-text wid100 "   type="text" name="option2[]" /><input  type="hidden" name="option3[]" value="'+(i+1)+'"/><input type="button" value="删除"  onclick="del('+i+')" class="button"/><br></span></div>';
		$(htmloptions).appendTo('#new_option'); 
		var htmloptions = '';
		i = i+1;
	}
}
function del(o){
 $("div [id=\'"+o+"\']").remove();	
    i=i-1;
}
</script>