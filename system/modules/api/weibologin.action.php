<?php

defined('G_IN_SYSTEM')or exit("no");
include dirname(__FILE__).'/lib/qq/qqConnectAPI.php';
class  weibologin extends SystemAction {
	
	private $qc;
	private $db;
	private $qq_openid;
	public function __construct(){
		$this->qc = new QC();
	}
	
	//qq登录
	public function init(){
		$this->qc->qq_login(); 
	}
	//qq回调
	public function callback(){	
		$qq_asc = $this->qc->qq_callback();
		$qq_openid = $this->qc->get_openid();		
		$this->qc = new QC($qq_asc,$qq_openid);
		$this->db = System::load_sys_class("model");
		if(empty($qq_openid)){
			header("Location:".G_WEB_PATH);exit;
		}
		p($this->qc);
		$this->qq_openid = $qq_openid;		
		p($this->qq_openid);die;
		$go_user_info = $this->db->GetOne("select * from `@#_member_band` where `b_code` = '$qq_openid' and `b_type` = 'qq' LIMIT 1");
		if(!$go_user_info){
			$this->qq_add_member();
		}else{
			$uid = intval($go_user_info['b_uid']);
			$this->qq_set_member($uid,'login_bind');
		}
	}

	private function qq_add_member(){
		$go_user_info = $this->qc->get_user_info();
		$member_db=System::load_app_class('base','member');
		$memberone=$member_db->get_user_info();
		if($memberone){
			$go_user_id = $memberone['uid'];
			$qq_openid    = $this->qq_openid;
			$go_user_time = time();
			$this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$go_user_id', 'qq', '$qq_openid', '$go_user_time')");
			_message("QQ绑定成功",G_WEB_PATH);
			return;
		}
		
		$go_user_time = time();
		if(!$go_user_info)$go_user_info=array('nickname'=>'QU'.$go_user_time.rand(0,9));
		$go_y_user = $this->db->GetOne("select * from `@#_member` where `username` = '$go_user_info[nickname]' LIMIT 1");
		if($go_y_user)$go_user_info['nickname'] .= rand(0,9);
		$go_user_name = $go_user_info['nickname'];
		$go_user_img  = 'photo/member.jpg';
		$go_user_pass = md5('123456');
		$qq_openid    = $this->qq_openid;
		$this->db->Autocommit_start();
		$q1 = $this->db->Query("INSERT INTO `@#_member` (`username`,`password`,`img`,`time`) VALUES ('$go_user_name','$go_user_pass','$go_user_img','$go_user_time')");
		$go_user_id = $this->db->insert_id();
		$q2 = $this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$go_user_id', 'qq', '$qq_openid', '$go_user_time')");
		if($q1 && $q2){
			$this->db->Autocommit_commit();
			$this->qq_set_member($go_user_id,'add');

		}else{
			$this->db->Autocommit_rollback();
			_message("登录失败!",G_WEB_PATH);
		}
		
	}

	private function qq_set_member($uid=null,$type='bind_add_login'){	
		
		$member_db=System::load_app_class('base','member');
		$memberone=$member_db->get_user_info();
		if($memberone){
			_message("该QQ号已经被其他用户所绑定！",WEB_PATH.'/login');
		}
		$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");		
		$_COOKIE['uid'] = null;
		$_COOKIE['ushell'] = null;
		$_COOKIE['UID'] = null;
		$_COOKIE['USHELL'] = null;	
		$s1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);			
		$s2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
	
		
		if($s1 && $s2){
			if(!$member['email'] || !$member['mobile']){
				_message("登录成功，请绑定邮箱或手机号和及时修改默认密码!",WEB_PATH.'/member/home/modify');
			}
				_message("登录成功!",G_WEB_PATH);
		}else{
			_message("登录失败请检查cookie!",G_WEB_PATH);
		}		
	}
	
	public function weibo_set_config(){
		System::load_app_class("admin",G_ADMIN_DIR,'no');
		$objadmin = new admin();		
		$config = System::load_app_config("connect");
		if(isset($_POST['dosubmit'])){
			$qq_off = intval($_POST['type']);
			$qq_id = $_POST['id'];
			$qq_key = $_POST['key'];
			$config['weibo'] = array("off"=>$qq_off,"id"=>$qq_id,"key"=>$qq_key);
			$html = var_export($config,true);
			$html = "<?php return ".$html."; ?>";
			$path =  dirname(__FILE__).'/lib/connect.ini.php';
			if(!is_writable($path)) _message('Please chmod  connect.ini.php  to 0777 !');
			$ok=file_put_contents($path,$html);
			_message("配置更新成功!");
		}	
	
		$config = $config['weibo'];		
		include $this->tpl(ROUTE_M,'weibo_set_config');
	}

	
}

?>