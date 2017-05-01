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

<div class="header-data lr10">
<a class="button" href="<?php echo G_ADMIN_PATH; ?>/wechat/keyword_add1/" >添加文本消息</a>
<a class="button" href="<?php echo G_ADMIN_PATH; ?>/wechat/keyword_add2/" >添加图文消息</a>
<div style="clear:both"></div>
</div>

<div class="bk10"></div>

<form action="#" method="post" name="myform">

<div class="table-list lr10">

        <table width="100%" cellspacing="0">

     	<thead>

        		<tr>

                    <th width="5%">ID</th>                          

                    <th width="25%">规则名称</th>  

                    <th width="8%">关键词</th>             

                    <th width="10%">消息类型</th>

                    <th width="5%">推送量</th>

                    <th width="10%">状态</th>

                    <th width="15%">管理</th>

				</tr>

        </thead>

        <tbody>				

        	<?php foreach($wechat as $v) { ?>

            <tr>
                <td><?php echo $v['id'];?></td>

                <td><?php echo $v['name'];?></td>

                <td><?php echo $v['keyword']; ?></a></td>

                <td><?php if($v['type'] == 1 ){ echo '文本';  }else{ echo '图文';}?></a></td>

                <td><?php echo $v['count'];?></td>

                <td><?php if($v['status'] == 0){echo '锁定';}else{ echo '正常';}?></td>
                <td class="action">
                <a href="<?php echo G_ADMIN_PATH; ?>/wechat/<?php if($v['type']==1){echo 'keyword_add1'; }elseif($v['type']==2){echo 'keyword_add2';}  ?>/<?php echo $v['id'];?>">修改</a>
                <span class='span_fenge lr5'>|</span>
                [<a href="<?php echo G_ADMIN_PATH; ?>/wechat/keyword_del/<?php echo $v['id'];?>">删除</a>]
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