<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<div class="links_txt">
	<h3><b>文字链接</b></h3>
	<ul>
	<?php $ln=1;if(is_array($link_size)) foreach($link_size AS $size): ?>	
		<li><a href="<?php echo $size['url']; ?>" target="_blank"><?php echo $size['name']; ?></a></li>
	<?php  endforeach; $ln++; unset($ln); ?>	
	</ul>
</div>
<div class="links_txt">
	<h3><b>图片链接</b></h3>
	<ul>
	<?php $ln=1;if(is_array($link_img)) foreach($link_img AS $img): ?>	
		<li><a href="<?php echo $img['url']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/linkimg/<?php echo $img['logo']; ?>"/></a></li>
	<?php  endforeach; $ln++; unset($ln); ?>	
	</ul>
</div>  
<div class="links_exp">
	<h3 style="border: none;"><b>联系方式</b></h3>
	<p>
		电话：888-8888888<br>
	</p>                 
</div>
<script type="text/javascript">
	$(".yu_ff").mouseover(function(){
	  $(".h_1yyg_eject").show();
	})
	$(".yu_ff").mouseout(function(){
	  $(".h_1yyg_eject").hide();
	})

		     $("#m_all_sort").hide();
	     $(".m_menu_all").mouseenter(function(){
			    $(".m_all_sort").show();
	     })
		 $(".m_menu_all").mouseleave(function(){
			    $(".m_all_sort").hide();
	     })
		 $(".m_all_sort").mouseenter(function(){
			    $(this).show();
	     })
		 $(".m_all_sort").mouseleave(function(){
			    $(this).hide();
	     })
	     $(function(){
	       $(window).scroll(function() {	
	      		
	     		if($(window).scrollTop()>=130&&$(window).scrollTop()<=560){
	     			$(".head_nav").addClass("fixedNav");	
	     			$("#m_all_sort").fadeOut();
	     		}else if($(window).scrollTop()>560){
	     			$(".head_nav").addClass("fixedNav");
	     			$("#m_all_sort").fadeOut();
	     	} else if($(window).scrollTop()<130){
	     			$(".head_nav").removeClass("fixedNav");
	     	}
	           });
	     });
</script>
<?php include templates("index","footer");?>