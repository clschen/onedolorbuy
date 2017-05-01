<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header lr10">
        <a target="_blank" href="http://kf.oo17.cn/hc/kb/section/91924/">
            <b>唐唐cms插件作者：炸酱</b>
        </a>
    </div>

<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
        	<th align="center">订单号</th>
            <th align="center">商品标题</th>
            <th align="center">购买用户</th>
            <th align="center">购买次数</th>
            <th align="center">购买总价</th>
            <th align="center">购买日期</th>
            <th align="center">中奖</th>
            <th align="center">订单状态</th>
            <th align="center">管理</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($recordlist AS $v) {	?>		
            <tr>
                <td align="center"><?php echo $v['code'];?> <?php if($v['code_tmp'])echo " <font color='#ff0000'>[多]</font>"; ?></td>
                <td align="center">
                <a  target="_blank" href="<?php echo WEB_PATH.'/goods/'.$v['shopid']; ?>">
                第(<?php echo $v['shopqishu'];?>)期<?php echo _strcut($v['shopname'],0,25);?></a>
                </td>              
                 <td align="center">
                    <?php if ($v['auto_user'] >0) {?>
                                <font style="color:red"><?php echo $v['username']; ?></font>
                    <?php }else {
                                echo $v['username'];                                
                            }?>                
                 </td>
                <td align="center"><?php echo $v['gonumber']; ?>人次</td>
                <td align="center">￥<?php echo $v['moneycount']; ?>元</td>
                <td align="center"><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
                <td align="center"><?php  echo $v['huode'] ? "中奖" : '未中奖';?></td>
                <td align="center"><?php if ($v['status'] == "已付款,已发货,已完成") {?>
                                    <font style="color:red"><?php echo $v['status']; ?></font>
                                    <?php }else {
                                            echo $v['status'];
                                            }?></td>
                <td align="center"><a href="<?php echo WEB_PATH;?>/admin/dingdan/get_dingdan/<?php echo $v['id']; ?>">详细</a></td>
            </tr>
            <?php } ?>
  	</tbody>
</table>
<div class="btn_paixu"></div>
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div><!--table-list end-->

<script>
</script>
</body>
</html> 