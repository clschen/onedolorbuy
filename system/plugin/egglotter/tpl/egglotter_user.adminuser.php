<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>砸金蛋游戏</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<?php include "egglotter.admin.header.php"; ?>
<style type="text/css">
#pages{height:25px;line-height:25px;  margin:20px 0px;font: 12px/1.5 tahoma,arial,宋体b8b\4f53,sans-serif;}
#pages ul{ float:right}
#pages ul li{ float:left;display:block; line-height:25px;padding:0px 10px; background-color:#eef3f7; margin-left:1px;}
#pages ul li a{}
.zjiang{font-family:Microsoft Yahei; font-size:50px;text-align:center;padding:200px 0;}
</style>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<?php 
	if($total==0){ 
		echo '<p class="zjiang">还未有用户中奖</p>';
	}else{
?>
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="80px">id</th>
		<th width="200px" align="center">会员名</th>
		<th width="" align="center">奖品期数</th>
		<th width="300px" align="center">获得奖品</th>
		<th width="" align="center">中奖时间</th>
		<th width="30%" align="center">操作</th>
		</tr>
    </thead>
    <tbody> 
		<?php foreach($award as $v){ ?>
		<tr>
		    <td align="center"><?php echo $v['award_id']; ?></td>
			<?php
			foreach($member as $m){
				if($m['uid']==$v['user_id']){
					if($m['username']!=null){
						echo '<td align="center">'.$m['username'].'</td>';
					}else if($m['mobile']!=null){
						echo '<td align="center">'.$m['mobile'].'</td>';
					}else if($m['email']!=null){
						echo '<td align="center">'.$m['email'].'</td>';
					}						
				}
			}
			?>
			<?php 
			foreach($rule as $re){
				if($re['rule_id']==$v['rule_id']){
					echo '<td align="center">'.$re['rule_name'].'</td>';
				}
			}
			foreach($slinfo as $linfo){
				if($linfo['spoil_id']==$v['spoil_id']){
					echo '<td align="center">'.$linfo['spoil_name'].'</td>';
				}
			}
			?>
			<td align="center"><?php echo date("Y-m-d H:i",$v['subtime']); ?></td>
<!-- 			<td align="center"><?php 
			if($v['lotterytype']==1){
				echo '积分';
			}elseif($v['lotterytype']==2){
				echo '金币';
			}else{
				echo '会员一次机会';
			};
			?></td>	-->	 
			<td align="center">			     
				<a href="<?php echo WEB_PATH; ?>/api/plugin/admin/egglotter/awarddel/<?php echo $v['award_id']; ?>" onClick="return confirm('是否真的删除！');">删除</a>
			</td>	
		</tr>
		<?php } ?>
  	</tbody>
</table>
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
<?php  }?>
</div><!--table-list end-->


</body>
</html> 