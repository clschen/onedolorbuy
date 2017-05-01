<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin','','no');
System::load_app_fun('global');
class cache extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
	}
	
	public function init(){
		if(isset($_POST['dosubmit'])){
			$c_ok ='';
			if(isset($_POST['cache']['template'])){
				$c_ok .= $this->tempcache();					
			}
			if(isset($_POST['cache']['file_cache'])){			
				$c_ok .= $this->upfulecache();				
			}
			_message($c_ok);
			
		}
	
		include $this->tpl(ROUTE_M,'cache');
	}
	
	
	private function upfulecache(){
		$path = G_CACHES.'caches_upfile'.DIRECTORY_SEPARATOR;
		if(file_exists($path)){
			$ret = $this->tempdeldir($path);
			if($ret){
				mkdir($path,0777, true)or die("Not Dir");		
				chmod($path,0777);
				return "文件缓存更新成功,";
			}else{
				return "文件缓存更新失败,";
			}
		}
		
	}	
	
	
	private function tempcache(){
		$path = G_CACHES.'caches_template'.DIRECTORY_SEPARATOR.G_STYLE.DIRECTORY_SEPARATOR;
		if(file_exists($path)){
			$ret = $this->tempdeldir($path);
			if($ret){
				return "模板缓存更新成功,";
			}else{
				return "模板缓存更新失败,";
			}
		}
		
	}	
	
	//删除目录
	private function tempdeldir($dir){
		$dh = opendir($dir);
		while ($file = readdir($dh)){
			if ($file != "." && $file != ".."){
				 $fullpath = $dir . "/" . $file;
				 if (!is_dir($fullpath)){
					unlink($fullpath);
				 }else{
					$this->tempdeldir($fullpath);
				 }
			  }
		}
		closedir($dh);
		if(rmdir($dir)){
			  return true;
		}else{
			  return false;
		}
	}
	
	
}