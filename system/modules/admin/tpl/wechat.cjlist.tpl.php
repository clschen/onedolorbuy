<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
body{ background-color:#fff}
tr{ text-align:center}
.button{border-radius: 3px; color: #FFF; background: #161e22; padding-left:15px; padding-right:15px; margin-right: 15px;float: right;}
.button:hover{background: #222d32;}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
	<a href="<?php echo G_MODULE_PATH; ?>/wechat/cjadd" style="float:right; margin-right:10px; background:#222d32; color:#FFF;height:30px;border-radius:3px;padding-left:10px; padding-right:10px;line-height:30px;margin-top:5px;">添加场景二维码</a>
</div>
<div class="bk10"></div>
<form action="#" method="post" name="myform">
<div class="table-list lr10">
		<table width="100%" cellspacing="0">
		<thead>
				<tr>
					<th width="3%">ID</th>                          
					<th width="20%">场景名称</th>  
					<th width="6%">场景码</th>             
					<th width="10%">场景关注数</th>
					<th width="15%">场景扫描数(已关注人扫描数)</th>
					<th width="10%">创建时间</th>
					<th width="25%">操作</th>
				</tr>
		</thead>
		<tbody>				
			<?php foreach($wechat as $v) { ?>
			<tr>
				<td><?php echo $v['id'];?></td>
				<td><?php echo $v['scenename'];?></td>
				<td><?php echo $v['code']; ?></a></td>
				<td><?php echo $v['total']; ?></a></td>
				<td><?php echo $v['nownum']; ?></a></td>
				<td><?php echo date('Y-m-d h:i',$v['time']);?></td>
				<td class="action">
				<a href="<?php echo G_ADMIN_PATH; ?>/wechat/cjadd/<?php echo $v['id'];?>">修改</a>
				<span class='span_fenge lr5'>|</span>
				[<a href="<?php echo G_ADMIN_PATH; ?>/wechat/cjdel/<?php echo $v['code'];?>">删除</a>]
				<span class='span_fenge lr5'>|</span>
				[<a href="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=<?php echo $v['ticket'];?>">查看二维码</a>]
	   			<span class='span_fenge lr5'>|</span>
				[<a href="<?php echo G_ADMIN_PATH; ?>/wechat/cjbaobiao1/<?php echo $v['code'];?>">查看关注报表</a>]
				<span class='span_fenge lr5'>|</span>
				[<a href="<?php echo G_ADMIN_PATH; ?>/wechat/cjbaobiao2/<?php echo $v['code'];?>">查看扫描报表</a>]
				</td>
			</tr>
			<?php } ?>
		</tbody>
	 </table>
	</tr>
</tbody>
</table>     
</form>
	<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div>
</body>
</html> 