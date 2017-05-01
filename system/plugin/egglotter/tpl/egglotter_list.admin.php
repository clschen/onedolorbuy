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
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="80px">id</th>
		
		<th width="300px" align="center">活动期数</th>
		<th width="100px" align="center">修改时间</th>
		<th width="" align="center">开始时间</th>
		<th width="" align="center">结束时间</th>
		<th width="" align="center">抽奖类型</th>
		 
		 
		<th width="30%" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($list as $v){ ?>
		<tr>
		    <td align="center"><?php echo $v['rule_id']; ?></td>
			<td align="center"><?php echo $v['rule_name']; ?></td>
			<td align="center"><?php echo date('Y-m-d',$v['subtime']); ?></td>
			<td align="center"><?php echo date('Y-m-d',$v['starttime']); ?></td>
			<td align="center"><?php echo date('Y-m-d',$v['endtime']); ?></td>
			<td align="center"><?php 
			if($v['lotterytype']==1){
				echo '积分';
			}elseif($v['lotterytype']==2){
				echo '金币';
			}else{
				echo '会员一次机会';
			};
			?></td>			 
			<td align="center">			     
				<a href="<?php echo WEB_PATH; ?>/api/plugin/admin/egglotter/update/<?php echo $v['rule_id']; ?>">修改</a>
                <span class='span_fenge lr5'>|</span>
				<a href="<?php echo WEB_PATH; ?>/api/plugin/admin/egglotter/del/<?php echo $v['rule_id']; ?>" onClick="return confirm('是否真的删除！');">删除</a>
			</td>	
		</tr>
		<?php } ?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 