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
</div>

<div class="bk10"></div>

<form action="#" method="post" name="myform">

<div class="table-list lr10">

        <table width="100%" cellspacing="0">

     	<thead>
        	<tr>
                    <th width="10%">用户id</th>  
                    <th width="10%">用户昵称</th>
                    <th width="10%">邮箱</th>    
                    <th width="10%">手机号</th>                 
                    <th width="8%">账户余额</th>
                    <th width="8%">场景来源</th>
                    <th width="8%">关注次数</th>   
                    <th width="10%">关注时间</th>
                </tr>
        </thead>
        <tbody>				
        	<?php foreach($list as $v) { ?>
            <tr>
                <td><?php echo $v['uinfo']['uid'];?></td>
                <td><?php echo $v['uinfo']['username']; ?></a></td>
                <td><?php echo $v['uinfo']['email']; ?></a></td>
                <td><?php echo $v['uinfo']['mobile']; ?></a></td>
                <td><?php echo $v['uinfo']['money']; ?></a></td>
                <td><?php if($v['come']==0){ echo '关注';}else{ echo '扫描';}; ?></a></td>
                <td><?php echo $v['sum']; ?></a></td>
                <td><?php echo date('Y-m-d H:i:s',$v['time']); ?></a></td>
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