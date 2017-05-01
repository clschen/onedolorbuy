<?php
defined('G_IN_SYSTEM')or exit("no");
class wxloginpc extends SystemAction {
	
	private $qc;
	private $db;
	private $conf;
	private $qq_openid;
	public function __construct(){	
		$this->conf = System::load_app_config("connect");
	}
	
	//wexin登录
	public function init(){
		$wxurl = "https://open.weixin.qq.com/connect/qrconnect?appid=".$this->conf['weixinpc']['id']."&redirect_uri=".WEB_PATH."/api/wxloginpc/callback&response_type=code&scope=snsapi_login&state=wechat12345#wechat_redirect";
		header("Location: $wxurl");
	}
	//wexin回调
	public function callback(){	
		$code = $_GET['code'];
		$state = $_GET['state'];
		if (empty($code)) $this->error('授权失败');
		$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->conf['weixinpc']['id'].'&secret='.$this->conf['weixinpc']['key'].'&code='.$code.'&grant_type=authorization_code';
		$token = json_decode(getCurl($token_url));
		$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$this->conf['weixinpc']['id'].'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
		//转成对象
		$access_token = json_decode(getCurl($access_token_url));
		$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
		//转成对象
		$user_info = json_decode(getCurl($user_info_url),true);
		$this->qc = $user_info;
		$weixin_openid = $user_info['openid'];
		if(empty($weixin_openid)) $this->error('获取信息失败，请联系管理员');
		$this->qq_openid = $weixin_openid;
		$this->db = System::load_sys_class("model");
		$go_user_info = $this->db->GetOne("select * from `@#_member_band` where `b_code` = '$weixin_openid' and `b_type` = 'weixin' LIMIT 1");
		if(!$go_user_info){
			$this->qq_add_member();
		}else{
			$uid = intval($go_user_info['b_uid']);
			$this->qq_set_member($uid,'login_bind');
		}
	}

	private function qq_add_member(){
		$go_user_info = $this->qc;
		$member_db=System::load_app_class('base','member');
		$memberone=$member_db->get_user_info();
		if($memberone){
			$go_user_id = $memberone['uid'];
			$qq_openid    = $this->qq_openid;
			$go_user_time = time();
			$this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$go_user_id', 'weixin', '$qq_openid', '$go_user_time')");
			_message("微信绑定成功",G_WEB_PATH);
			return;
		}
		
		$go_user_time = time();
		if(!$go_user_info)$go_user_info=array('nickname'=>'QU'.$go_user_time.rand(0,9));
		$go_y_user = $this->db->GetOne("select * from `@#_member` where `username` = '$go_user_info[nickname]' LIMIT 1");
		if($go_y_user)$go_user_info['nickname'] .= rand(0,9);
		$go_user_name = $go_user_info['nickname'];
		$go_user_img  = 'photo/member.jpg';
		$go_user_himg  = $go_user_info['headimgurl'];
		$go_user_pass = md5('123456');
		$qq_openid    = $this->qq_openid;
		$this->db->Autocommit_start();
		$q1 = $this->db->Query("INSERT INTO `@#_member` (`username`,`password`,`img`,`headimg`,`time`) VALUES ('$go_user_name','$go_user_pass','$go_user_img','$go_user_himg','$go_user_time')");
		$go_user_id = $this->db->insert_id();
		$q2 = $this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$go_user_id', 'weixin', '$qq_openid', '$go_user_time')");
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
			_message("该微信号已绑定！",WEB_PATH.'/login');
		}
		$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");		
		$_COOKIE['uid'] = null;
		$_COOKIE['ushell'] = null;
		$_COOKIE['UID'] = null;
		$_COOKIE['USHELL'] = null;	
		$s1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);			
		$s2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
		if($s1 && $s2){
			if(_is_mobile()){
				header("location:".WEB_PATH.'/mobile/home');
			}else{
				header("location:".WEB_PATH.'/member/home');
			}
		}else{
			_message("登录失败请检查cookie!",G_WEB_PATH);
		}		
	}
	
	public function wxpc_set_config(){
		System::load_app_class("admin",G_ADMIN_DIR,'no');
		$objadmin = new admin();		
		$config = System::load_app_config("connect");
		if(isset($_POST['dosubmit'])){
			$wx_off = intval($_POST['type']);
			$wx_id = $_POST['id'];
			$wx_key = $_POST['key'];
			$config['weixinpc'] = array("off"=>$wx_off,"id"=>$wx_id,"key"=>$wx_key);
			$html = var_export($config,true);
			$html = "<?php return ".$html."; ?>";
			$path =  dirname(__FILE__).'/lib/connect.ini.php';
			if(!is_writable($path)) _message('Please chmod  connect.ini.php  to 0777 !');
			$ok=file_put_contents($path,$html);
			_message("配置更新成功!");
		}
		$config = $config['weixinpc'];		
		include $this->tpl(ROUTE_M,'wxpc_set_config');
	}

	
}

?>