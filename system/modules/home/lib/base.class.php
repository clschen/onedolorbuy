<?php 



defined('G_IN_SYSTEM')or exit('No permission resources.');



class base extends SystemAction {

	public function __construct(){

	

	}

	public function cook(){

		$mysql_model=System::load_sys_class('model');

		$uid=_encrypt(_getcookie('uid'),'DECODE');

		if (!isset($_GET['wxid'])) {
			$member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");
		}else{
			$wxid = $_GET['wxid'];

			$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$wxid."'");

			$this->userinfo=$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");

			_setcookie("uid",_encrypt($member['uid']),60*60*24*7);

			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
		}

		if(!$member){

			$lei=$this->segment(2);

			$funct=$this->segment(3);

			//echo $lei;

			header("location:".WEB_PATH."home/user/login?lei=".$lei."&funct=".$funct);

			exit;

		}else{

			return $member;

		}

	}

	// public function spcook(){

		// $mysql_model=System::load_sys_class('model');

		// $uid=_encrypt(_getcookie('uid'),'DECODE');

		// $member=$mysql_model->GetOne("select * from `@#_member` where `uid`='".$uid."'");	

		// return $member;

	// }

}

?>