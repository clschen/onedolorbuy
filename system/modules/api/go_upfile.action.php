<?php 

defined('G_IN_SYSTEM') or exit('No permission resources.');

System::load_sys_fun("user");
class go_upfile extends SystemAction {

	public function init(){
			$db = System::load_sys_class("model");
			$version = System::load_sys_config('version');	
			$v_time = $version['release'];
			$v_version = $version['version'];
					
			$ret = $db->GetOne("Describe `@#_shaidan_hueifu` sdhf_username");
		
			if(!$ret){
				return;
			}
			
			$hflist = $db->GetList("select * from `@#_shaidan_hueifu` where `sdhf_img` is null or `sdhf_img` = ''");
		
			
			foreach($hflist as $key=>$val){
				$user = $db->GetOne("select uid,username,email,mobile,img from `@#_member` where `uid` = '$val[sdhf_userid]'");
				$username = get_user_name($user);
				$db->Query("UPDATE `@#_shaidan_hueifu` SET `sdhf_img` = '$user[img]',`sdhf_username` = '$username' where `id` = '$val[id]'");
			}
			
			unlink(__FILE__);
			_message("数据库升级成功",G_WEB_PATH);
	}


}	

?>