<?php 

defined('G_IN_SYSTEM') or exit('No permission resources.');

class up_file_140306 extends SystemAction {

	public function init(){
		$mobile = System::load_sys_config("mobile");		
		
		if(!isset($mobile['cfg_mobile_2']) || !isset($mobile['cfg_mobile_on'])){
					$mobiles = array();
					$mobiles['cfg_mobile_1'] = $mobiles['cfg_mobile_2'] = array(); 
					$mobiles['cfg_mobile_2']['mid'] 		= $mobile['mid'];
					$mobiles['cfg_mobile_2']['mpass'] 		= $mobile['mpass'];;
					$mobiles['cfg_mobile_2']['mqianming']	= $mobile['mqianming'];
					$mobiles['cfg_mobile_1']['mid'] 		= '';
					$mobiles['cfg_mobile_1']['mpass'] 		= '';
					$mobiles['cfg_mobile_on'] = 2;			

					if(!is_writable(G_CONFIG.'mobile.inc.php')) _message('Please chmod  mobile.ini.php  to 0777 !');
				
					$html  = var_export($mobiles,true);
					$html  = "<?php \n return ".$html."; \n?>";
					$ok=file_put_contents(G_CONFIG.'mobile.inc.php',$html);
					if($ok){
						_message("升级成功！");
					}
		}else{
			@unlink(__FILE__);
			_message("无需升级!");
		}
		
			
	}


}	

?>