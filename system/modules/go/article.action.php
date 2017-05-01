<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user');
System::load_sys_fun('user');
class article extends SystemAction {
	private $db;
	public function __construct(){
		$this->db=System::load_sys_class('model');
	}
	public function init(){}	
	//显示单篇文章
	public function show(){	
		$articleid=$this->segment(4);
		$article=$this->db->GetOne("SELECT * FROM `@#_article` where `id` = '$articleid' LIMIT 1");
		if(!$article){_message("参数错误!");}		
		include templates("help","help");
	}
	
	//显示单网页
	public function single(){
		$single=$this->segment(4);
		if(intval($single)){			
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `cateid` = '$single' LIMIT 1");
		}else{		
			$article=$this->db->GetOne("SELECT * FROM `@#_category` where `catdir` = '$single' LIMIT 1");
		}
		if(!$article){_message("参数错误!");}		
		
		$info=unserialize($article['info']);

		$article['thumb']=$info['thumb'];
		$article['des']=$info['des'];
		$article['content']= base64_decode($info['content']);
		$title=empty($info['meta_title']) ? $article['name'] : $info['meta_title'];
		$keywords=$info['meta_keywords'];
		$description=$info['meta_description'];
		$template=explode('.',$info['template']);
		include templates($template[0],$template[1]);
	}
}


?>