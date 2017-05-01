<?php 



defined('G_IN_SYSTEM')or exit('No permission resources.');

define("MEMBER",true);

System::load_sys_fun("user");

class base extends SystemAction {

	protected $userinfo=NULL;	

	public function __construct(){

		$this->db = System::load_sys_class("model");

		$uid=intval(_encrypt(_getcookie("uid"),'DECODE'));		

		$ushell=_encrypt(_getcookie("ushell"),'DECODE');

		if(!$uid)$this->userinfo=false;

		if (!isset($_GET['wxid'])) {

			$this->userinfo=$this->db->GetOne("SELECT * from `@#_member` where `uid` = '$uid'");
		}else{
			$wxid = $_GET['wxid'];
			$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$wxid."'");
			$this->userinfo=$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");
			_setcookie("uid",_encrypt($member['uid']),60*60*24*7);
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
		}

		if(!$this->userinfo)$this->userinfo=false;

		$shell=md5($this->userinfo['uid'].$this->userinfo['password'].$this->userinfo['mobile'].$this->userinfo['email']);

		if($ushell!=$shell)$this->userinfo=false;



		global $_cfg;		

		$_cfg['userinfos']=$this->userinfo;

	}

	

	protected function checkuser($uid,$ushell){

		$uid=intval(_encrypt($uid,'DECODE'));

		$ushell=_encrypt($ushell,'DECODE');	

		if(!$uid)return false;

		if($ushell===NULL)return false;

		$this->userinfo=$this->db->GetOne("SELECT * from `@#_member` where `uid` = '$uid'");

		if(!$this->userinfo){

			$this->userinfo=false;

			return false;

		}

		$shell=md5($this->userinfo['uid'].$this->userinfo['password'].$this->userinfo['mobile'].$this->userinfo['email']);

		if($ushell!=$shell){

			$this->userinfo=false;

			return false;

		}else{

			return true;

		}

		

	}

	public function get_user_info(){

		if($this->userinfo){

			return $this->userinfo;

		}else{

			return false;

		}

	}

	protected function HeaderLogin(){

		_message("你还未登录，无权限访问该页！",WEB_PATH."/member/user/login");

	}

	

}

?>