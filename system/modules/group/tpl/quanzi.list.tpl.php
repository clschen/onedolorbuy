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
<script>
function quanzi(id){
	if(confirm("确定删除该圈子")){
		window.location.href="<?php echo G_MODULE_PATH;?>/quanzi/del/"+id;
	}
}
</script>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <table width="100%" cellspacing="0">
 	<thead>
	<tr align="center">
		<th width="5%" height="30">ID</th>
		<th width="10%">圈子名</th>
		<th width="20%">简介</th>
		<th width="20%">公告</th>
		<th width="5%">成员</th>
		<th width="10%">帖子数</th>
		<th width="10%">发帖权限</th>
		<th width="15%">管理</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($quanzi as $v) { ?>
	<tr align="center" class="mgr_tr">
		<td height="30"><?php echo $v['id'];?></td>
		<td><?php echo $v['title'];?></td>
		<td><?php echo _strcut($v['jianjie'],25);?></td>
		<td class="number"><?php echo _strcut($v['gongao'],25);?></td>
		<td><?php echo $v['chengyuan'];?></td>
		<td><?php echo $v['tiezi'];?></td>
		<td><?php echo $v['glfatie']=='Y'?'是':'否';?></td>
		<td class="action">
		<span>[<a href="<?php echo G_MODULE_PATH;?>/quanzi/quanzi_update/<?php echo $v['id'];?>">修改</a>]</span>
		<span>[<a onClick="quanzi(<?php echo $v['id'];?>)" href="javascript:;">删除</a>]</span></td>		
	</tr>
	<?php } ?> 
    </tbody>
</table>


</div><!--table_list end-->

</body>
</html> 
