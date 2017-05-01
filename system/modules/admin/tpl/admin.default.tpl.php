<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<script src='http://www.ichartjs.com/ichart.latest.min.js'></script>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
	 body{ background-color:#fefeff; font:12px/1.5 arial,宋体b8b\4f53,sans-serif;}

	.width30{ width:25%; font-size:12px; border-radius:5px 2px 20px 2px;  }

	.title{ font-size:15px; font-weight:bold; color:#444; line-height:30px; border-bottom:1px solid #ccc;}

	.div-news{ height:50px; background-color:#fff}

	.div-user span{ display:block; font-size:12px; font: 12px/1.5 arial,宋体b8b\4f53,sans-serif; line-height:20px; color:#999}

	.div-user{ background-color:#fff; padding:20px;width:30%;float:left;  border-bottom:1px solid #eee }

	.div-button{float:left;background-color:#F2F2F2; float:left;  width:100%; height: 400px;margin-top: 10px; margin-left:10px;margin-right: 10px;}

	.div-button ul li{ float:left; margin:0px 25px;}

	.div-button li a{  cursor:pointer; text-decoration:none}

	.div-button li span{ display:block; width:60px; text-align:center; line-height:32px;} 

	.div-system{background-color:#fff; float:left; padding:20px; margin:0 10px;border:1px solid #ccc; box-shadow: 0px 0px 5px #888;}

	.div-webinfo{background-color:#fff; float:left; padding:20px; margin:0 10px; width:27%;border:1px solid #ccc; box-shadow: 0px 0px 5px #888;}

	.div-about{background-color:#fff; float:left; padding:20px; margin:0 10px; overflow:hidden;border:1px solid #ccc; box-shadow: 0px 0px 5px #888;}

	 li{font:12px/1.5 arial,宋体b8b\4f53,sans-serif;}

	.div-system ul li{height:30px; line-height:30px;color:#6b6b6b;border-bottom:1px dashed #ddd;}

	.div-system ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}

	.div-about ul li{height:30px; line-height:30px;color:#6b6b6b;border-bottom:1px dashed #ddd;}

	.div-about ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}
	
	.div-webinfo ul li{height:30px; line-height:30px;color:#6b6b6b;border-bottom:1px dashed #ddd;}

	.div-webinfo ul li i{width:90px;height:30px; line-height:30px; display:inline-block; color:#666;}

	.job{width: 100%; float: left; padding-bottom: 20px; border-bottom: 1px dashed #DDD;}
	.job .left{width: 200px;float: left; color: #3C8DBC;}
	.job .right{width: 100px;float: left; }
	.job span{font-weight: 700; font-size: 14px;}
	.div-button img{display: block;float: left;}
</style>

<div style="overflow:hidden">

<!------------>

    <div class="div-system width30">

        <div class="title">系统信息</div>

        	<div class="bk10"></div>

            <ul>        

                <li><i>操作系统: </i><?php echo $SysInfo['os'];?></li>

                <li><i>服务器版本: </i><?php echo $SysInfo['web_server'];?></li>

                <li><i>PHP版本: </i><?php echo $SysInfo['phpv'];?></li>

                <li><i>MYSQL版本: </i><?php echo $SysInfo['MysqlVersion'];?></li>

                <li><i>上传限制: </i><?php echo $SysInfo['fileupload'];?></li>

                <li><i>时区: </i><?php echo $SysInfo['timezone'];?></li>

                <li><i>GD库: </i><?php echo showResult('imageline');?></li>

                <li><i>POST限制: </i><?php echo get_cfg_var('post_max_size'); ?></li>

                <li><i>脚本超时时间: </i><?php echo ini_get('max_execution_time').'秒'; ?></li>

				<li><i>set_time_limit: </i><?php echo showResult('set_time_limit'); ?></li>

				<li><i>fsockopen: </i><?php echo showResult('fsockopen'); ?></li>

                <li style="border-bottom:none;"><i>ZEND支持: </i><?php echo showResult('zend_version'); ?> </li>

      

            </ul>      

    </div>

	<?php

	$tj_category=$this->db->GetList("SELECT cateid FROM `@#_category` WHERE `model` = '1'");

	$tj_brand=$this->db->GetList("SELECT id FROM `@#_brand`");

	$tj_article=$this->db->GetList("SELECT * FROM `@#_article`");

	$tj_shoplist=$this->db->GetList("SELECT id FROM `@#_shoplist`");	

	$time=time();

	$tj_shoplist_xsjx=$this->db->GetList("SELECT id FROM `@#_shoplist` where `xsjx_time`>'$time'");

	$tj_member=$this->db->GetList("SELECT uid FROM `@#_member`");

	

	$tm=time()-24*3600;

	$tj_member_new=$this->db->GetList("SELECT uid FROM `@#_member` where `time`>'$tm' ");

	$tj_shoplist_new=$this->db->GetList("SELECT id FROM `@#_shoplist` where `time`>'$tm' ");

	$tj_member_account=$this->db->GetList("SELECT money FROM `@#_member_account` where `pay`='账户' and `type`=1 and `time`>'$tm'");

	$today_money=0;

	foreach ($tj_member_account as $account){

		$today_money=$account['money']+$today_money;

	}

	?>

    <div class="div-webinfo width30">

        <div class="title">网站信息统计</div>

        <div class="bk10"></div>

        <ul>

           <li><i>栏目:</i><?php echo count($tj_category); ?></li>

           <li><i>品牌:</i><?php echo count($tj_brand); ?></li>

           <li><i>文章:</i><?php echo count($tj_article); ?></li>

           <li><i>商品数量:</i><?php echo count($tj_shoplist); ?></li>

           <li><i>限时揭晓:</i><?php echo count($tj_shoplist_xsjx); ?></li>

           <li style="border-bottom:none;"><i>会员人数:</i><?php echo count($tj_member); ?></li>

           <li class="bk30"></li>

           <li><i>今日新增会员:</i><?php echo count($tj_member_new); ?></li>

           <li><i>今日新增商品:</i><?php echo count($tj_shoplist_new); ?></li>

           <li style="border-bottom:none;"><i>今日账户收入:</i><?php echo $today_money; ?></li>

        </ul>

    </div>

    

    <div class="div-about width30">

        <div class="title">关于我们&版权</div>
	
	<div class="bk15"></div>
		
	<div class="job">
		<div class="right">
			<img src="<?php echo G_WEB_PATH ?>/statics/plugin/style/global/image/u93.png" >
		</div>
		<div class="left">
			<span><?php echo $info['username'] ;?></span><br><br>
	    		<span>所属角色: 超级管理员</span>
	    	</div>

	</div>
	<div class="job" style="padding-top:15px;">
		<p>上次登录时间: <?php echo date("Y-m-d H:i:s",$info['logintime']); ?></p><br>

	    	<p>上次登录IP: <?php echo $info['loginip']; ?></p>
			<p>官网论坛: <a href="http://bbs.52jscn.com" target="_blank">bbs.52jscn.com</a>

 </p>
	</div>
	<div class="job" style="padding-top:15px;color:#999;">
		
		

	</div>

        <div class="bk10"></div>

    </div>

<!------------>

</div>

</body>

</html> 

