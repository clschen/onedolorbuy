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

	<b style="height:42px; line-height:42px;">已指定中奖人列表</b>&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:red">说明：中奖人只能从购买的人中指定，所以在指定前，请先用中奖人账号购买商品一次，然后再指定！以实现不同期次的中奖人不同的效果。
                </font>(<b>别家的指定中奖人所有期次中奖人都一样，过于虚假！本店的则可以单独指定期次</b>)
</div>
<div class="header lr10">
    <a href="<?php echo WEB_PATH; ?>/admin/fund/specify" style="float:right; margin-right:10px; background:#222d32; color:#FFF;height:30px;border-radius:3px;padding-left:10px; padding-right:10px;line-height:30px;margin-top:5px;">添加指定中奖人</a>
</div>
<div class="bk10"></div>

<form action="#" method="post" name="myform">

<div class="table-list lr10">

        <table width="100%" cellspacing="0">

     	<thead>

        		<tr>

                    <th width="3%">ID</th>                          

                    <th width="20%">指定的商品</th>

                    <th width="20%">查看指定的商品</th>

                    <th width="6%">指定的中奖人</th>             

                    <th width="10%">指定时间</th>

                    <th width="15%">操作</th>

				</tr>

        </thead>
        <tbody>				

        	<?php foreach($res as $v) { ?>

            <tr>
                <td><?php echo $v['id'];?></td>

                <td><?php echo $v['shopid'];?></td>
                <td><a target="_blank" href="<?php echo WEB_PATH; ?>/goods/<?php echo $v['shopid'];?>">查看</a></td>
                <td><?php echo $v['userid']; ?></a></td>

                <td><?php echo date('Y-m-d H:i:s',$v['time']); ?></a></td>

                <td class="action">
                [<a href="<?php echo G_ADMIN_PATH; ?>/fund/zddel/<?php echo $v['id'];?>">删除</a>]
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