<?php 
defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin','','no');
System::load_app_fun('global');
class template extends admin {

	private $templates=array();
	private $thistemp='';
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("init","模板管理",ROUTE_M.'/'.ROUTE_C."/init"),
		);
		$this->templates=System::load_sys_config("templates");
		$this->thistemp=System::load_sys_config("system","templates_name");
	}
	public function init(){
		$templates=array();
		$templates=$this->templates;
		$thistemp=$this->thistemp;
		
		include $this->tpl(ROUTE_M,'template.lists');
	}
	public function off(){
		$temp=$this->segment(4);
		if(!isset($this->templates[$temp]))_message("没有这个模板");
		EditConfig("system","templates_name",$temp);
		_message("操作成功!");
	}
	public function edit(){
		$temp=$this->segment(4);
		if(!isset($this->templates[$temp]))_message("没有这个模板");
		$template=$this->templates[$temp];		
		if(!is_writable(G_CONFIG.'templates.inc.php')) _message('Please chmod  templates  to 0777 !');
		if(isset($_POST['dosubmit'])){			
			$new_template['name']=htmlspecialchars($_POST['name']);
			$new_template['dir']=htmlspecialchars($_POST['dir']);
			$new_template['html']=htmlspecialchars($_POST['html']);
			$new_template['author']=htmlspecialchars($_POST['author']);			
			$temps=var_export($new_template,true);
			$this->templates[$temp]=$new_template;
			$html="<?php \n defined('G_IN_SYSTEM') or exit('No permission resources.');";
			$html.="\n return ".var_export($this->templates,true);
			$html.="\n ?>";			
			$ok=file_put_contents(G_CONFIG.'templates.inc.php',$html);
			if($template['html'] != $new_template['html']){				
				rename(G_TEMPLATES.$template['dir'].DIRECTORY_SEPARATOR.$template['html'],G_TEMPLATES.$template['dir'].DIRECTORY_SEPARATOR.$new_template['html']);
			}				
			if($ok){
				echo "<script>
				alert('修改成功');
				window.location.href='".G_MODULE_PATH.'/template/init'."';
				</script>";			
			}
		}
		include $this->tpl(ROUTE_M,'template.edit');
	}
	
	//模板列表
	public function see(){	
		$path=G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;		
		$html_arr=scandir($path);
		array_Shift($html_arr);
		array_Shift($html_arr);
		$thistemplate=G_STYLE;
		$temps=$this->db->GetList("SELECT * FROM `@#_template` where `template` = '$thistemplate'",array('key'=>'template_name'));
		if(count($temps) != count($html_arr)){
			foreach($html_arr as $html){
				if(!isset($temps[$html])){
					$temps[$html]['template_name']=$html;
					$temps[$html]['des']='';
					$temps[$html]['template']=$thistemplate;
				}
			}
			}
		unset($thistemplate);		
		include $this->tpl(ROUTE_M,'template.see');
	}
	//更新模板简介
	public function updatades(){
		if(isset($_POST['submit'])){			
			array_pop($_POST);		
			$thistemplate=G_STYLE;
			$temps=$this->db->GetList("SELECT * FROM `@#_template` where `template` = '$thistemplate'",array('key'=>'template_name'));
			foreach($_POST as $key=>$val){
				//替换POST name
				$key=base64_decode($key);
				$val=htmlspecialchars($val);
				if(isset($temps[$key])){
					$this->db->Query("UPDATE `@#_template` SET `des` = '$val' where `template` = '$thistemplate' AND `template_name` = '$key'");
				}else{					
					$this->db->Query("INSERT INTO `@#_template` (`template_name`, `template`, `des`) VALUES ('$key', '$thistemplate', '$val')");
				}
			}
			_message("更新成功");
		}
	}
	//修改模板内容
	public function update(){
		$path=G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;	
		$path.=base64_decode($this->segment(4));
		if(isset($_POST['submit'])){
			$content=stripslashes($_POST['content']);
			$ok=file_put_contents($path,$content);		
			if(gettype(file_put_contents($path,$content))!='integer'){			
				_message("模板修改不成功,请检查模板目录是否具有写入权限!");
			}
			_message("模板修改成功!",WEB_PATH.'/'.ROUTE_M.'/template/see');
		}
		if(file_exists($path)){
			$files=file_get_contents($path);
			$files=htmlspecialchars($files);
		}else{
			_message("模板不存在");
		}
		include $this->tpl(ROUTE_M,'template.update');
	}
	//新建模板 
	public function insert(){
		$path=G_TEMPLATES.G_STYLE.DIRECTORY_SEPARATOR.G_STYLE_HTML.DIRECTORY_SEPARATOR;
		$htmlcontent=<<<HTML
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
     <body>
        	<h1>模板内容</h1>
     </body>       
</html>
HTML;
		$htmlcontent=htmlspecialchars($htmlcontent);
		include $this->tpl(ROUTE_M,'template.update');
	}
	
	public function email_temp(){	
		//注册验资
		$temp_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_reg' LIMIT 1");	
	    //获奖
		$temp_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_email_shop' LIMIT 1");
		
		if(isset($_POST['dosubmit'])){
			$m_reg_temp = $_POST['m_reg_temp'];
			$m_shop_temp = $_POST['m_shop_temp'];
			$q_1 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_reg_temp]' WHERE (`key`='template_email_reg')");
			$q_2 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_shop_temp]' WHERE (`key`='template_email_shop')");
			if($q_1 && $q_2){
				_message("邮件模板更新成功！");
			}else{
				_message("邮件模板更新失败！");
			}
		}
		
		
		$temp_reg['value']=htmlspecialchars($temp_reg['value']);
		$temp_shop['value']=htmlspecialchars($temp_shop['value']);
		include $this->tpl(ROUTE_M,'template.email');	
	}
	
	public function mobile_temp(){
		$config = System::load_sys_config("mobile");
		//注册验资
		$temp_reg = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_reg' LIMIT 1");	
	    //获奖
		$temp_shop = $this->db->GetOne("select value from `@#_caches` where `key` = 'template_mobile_shop' LIMIT 1");
		
		if(isset($_POST['dosubmit'])){
			$m_reg_temp = $_POST['m_reg_temp'].$config['mqianming'];
			$m_shop_temp = $_POST['m_shop_temp'].$config['mqianming'];
			preg_match_all("/./us", $m_reg_temp, $match_reg);
			if(count($match_reg[0]) >=75){
				_message("注册验资短信模板不能超过75个字,请检查!");
			}
			preg_match_all("/./us", $m_shop_temp, $match_shop);
			if(count($match_shop[0]) >=75){
				_message("用户获奖短信模板不能超过75个字,请检查!");
			}
			
			$q_1 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_reg_temp]' WHERE (`key`='template_mobile_reg')");
			$q_2 = $this->db->Query("UPDATE `@#_caches` SET `value`='$_POST[m_shop_temp]' WHERE (`key`='template_mobile_shop')");
			if($q_1 && $q_2){
				_message("短信模板更新成功！");
			}else{
				_message("短信模板更新失败！");
			}
		}		

	
		include $this->tpl(ROUTE_M,'template.mobile');
	}
	
}
?>