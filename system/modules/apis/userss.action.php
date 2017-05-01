<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('memberbase',null,'no');
System::load_app_class('response','apis','no');
System::load_app_fun('user','go');
System::load_app_fun('my','go');
System::load_sys_fun('send');
session_start();
class userss extends memberbase {
	private $conf;
	public function __construct(){
		parent::__construct();
		$this->db = System::load_sys_class("model");
		$this->conf = System::load_app_config("connect",'','api');
		$_POST = [
		'uid'=>'6',
		'token'=>'111111'
		];
		if(empty($_POST['uid']) || empty($_POST['token'])){
			response::show(2001,'缺少参数');
		}
		
		$uid = $_POST['uid'];
		if($_SESSION['user'.$uid] != $_POST['token']){
			response::show(2003,'token不匹配');
		}	
	}
	
	/*public function buydetail(){
	 	$webname=$this->_cfg['web_name'];
	 	$member=$this->userinfo;
	 	$itemid=intval($this->segment(4));

	 	$itemlist=$this->db->GetList("select *,a.time as timego,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.id='$itemid' group by a.id order by a.time" );
	 	if(!empty($itemlist)){
			if($itemlist[0]['q_end_time']!=''){
		   //商品已揭晓
				$itemlist[0]['codeState']='已揭晓...';
				$itemlist[0]['class']='z-ImgbgC02';
		    }elseif($itemlist[0]['shenyurenshu']==0){
			//商品购买次数已满
				$itemlist[0]['codeState']='已满员...';
				$itemlist[0]['class']='z-ImgbgC01';
			}else{
			//进行中
				$itemlist[0]['codeState']='进行中...';
				$itemlist[0]['class']='z-ImgbgC01';

			}
			$bl=($itemlist[0]['canyurenshu']/$itemlist[0]['zongrenshu'])*100;

			foreach ($itemlist as $k => $v) {
				$count += $v['gonumber'];
			}
		}

	 include templates("/mobile/user","userbuydetail");
	}*/

	/*
	 *wexin登录绑定
	 */
	public function wxinit(){
	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->conf['weixin']['id'].'&redirect_uri='.WEB_PATH.'/apis/userss/wxcallback&response_type=code&scope=snsapi_userinfo&state=wechat123&connect_redirect=1#wechat_redirect';
		header("location:$url");
	}
	//wexin回调
	public function wxcallback(){
		$time = time();
		//$uid = 1;//session中获得
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid`=$uid");
		$code = $_GET['code'];
		$state = $_GET['state'];
		if (empty($code)) $this->error('授权失败');
		$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->conf['weixin']['id'].'&secret='.$this->conf['weixin']['key'].'&code='.$code.'&grant_type=authorization_code';
		$token = json_decode(getCurl($token_url));
		$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$this->conf['weixin']['id'].'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
		//转成对象
		$access_token = json_decode(getCurl($access_token_url));
		$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
		//转成对象
		$user_info = json_decode(getCurl($user_info_url),true);
		$weixin_openid = $user_info['openid'];
		$go_user_himg  = $user_info['headimgurl'];
		if(empty($weixin_openid)){
			response::show(2004,'信息获取失败，请返回刷新后重新操作');
		}
		$info = $this->db->GetOne("SELECT * FROM `@#_member_band` WHERE `b_code` = '$weixin_openid'");
		if(!empty($info)){
			response::show(2002,'该微信号已经被绑定，您的操作失败');
		}else{
			$uid = $member['uid'];
			$nickname = empty($member['username']) ? $user_info['nickname'] : $member['username'];
			$q1 = $this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$uid', 'weixin', '$weixin_openid', '$time')");
			$q2 = $this->db->Query("UPDATE  `@#_member` SET `wxid` = '$weixin_openid', `headimg`= '$go_user_himg', `username`='$nickname' WHERE `uid`=$uid");
			if($q1 && $q2){
				$user = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid`=$uid");
				response::show(2000,'微信账号绑定成功',$user);
			}
		}
	}
	/*
	 *修改密码
	 */
	public function setpassword()
	{
		if(empty($_POST['oldpassword']) || empty($_POST['newpassword'])){
			response::show(2001,'缺少参数');
		}
		$mysql_model=System::load_sys_class('model');
		$oldpassword= md5(base64_decode($_POST['oldpassword']));
		$newpassword= md5(base64_decode($_POST['newpassword']));
		$password = $this->db->GetOne("select password from `@#_member` where `uid`='$uid'");
		if($password['password'] != $oldpassword){
			response::show(2001,'原始密码错误');
		}else{
			if($mysql_model->Query("UPDATE `@#_member` SET password='".$newpassword."' where uid='".$uid."'")){
				response::show(2000,'修改密码成功');
			}else{
				response::show(2004,'修改密码失败');
			}
		}
			
	}
	/*
	 *修改头像
	 */
	public function headimg()
	{
		if(!empty($_FILES)){	
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg'),500000,'touimg');
			upload::go_upload($_FILES['Filedata']);
			
			if(!upload::$ok){
				response::show(2002,upload::$error); 
			}else{
				$img=upload::$filedir."/".upload::$filename;				
				$size=getimagesize(G_UPLOAD."/touimg/".$img);
				$max=300;$w=$size[0];$h=$size[1];				
				if($w>300 or $h>300){
					if($w>$h){
						$w2=$max;
						$h2 = intval($h*($max/$w));
						upload::thumbs($w2,$h2,true);					
					}else{
						$h2=$max;
						$w2 = intval($w*($max/$h));
						upload::thumbs($w2,$h2,true);
					}
				}
			$tname="touimg/".$img;
			$this->db->Query("UPDATE `@#_member` SET img='$tname' where uid={$uid}");
			$u_pic = G_UPLOAD_PATH.'/'.$tname;
			response::show(2000,'修改头像成功',['u_pic'=>$u_pic]);
			}					
		}else{
			response::show(2001,'缺少参数');
		}
	}

	/*
	 *修改资料
	 */
	public function profilechange()
	{
		if(empty($_POST['username']) || empty($_POST['qianming'])){
			response::show(2001,'缺少参数');
		}
		$mysql_model=System::load_sys_class('model');
		if($_POST){			
			$username=_htmtocode(trim($_POST['username']));
			$qianming=_htmtocode(trim($_POST['qianming']));
			$reg_user_str = $this->db->GetOne("select value from `@#_caches` where `key` = 'member_name_key' limit 1");
			$reg_user_str = explode(",",$reg_user_str['value']);
			if(is_array($reg_user_str) && !empty($username)){
				foreach($reg_user_str as $rv){
					if($rv == $username){
						response::show(2002,'此昵称禁止使用!');
					}
				}
			
			}			
			//积分、经验添加
			$isset_user=$this->db->GetOne("select `uid` from `@#_member_account` where (`content`='手机认证完善奖励' or `content`='完善昵称奖励') and `type`='1' and `uid`='$member[uid]' and (`pay`='经验' or `pay`='积分')");	
			// if(!$isset_user){			
			// 	$config = System::load_app_config("user_fufen");//积分/经验
			// 	$time=time();
			// 	$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','积分','完善昵称奖励','$config[f_overziliao]','$time')");
			// 	$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','经验','完善昵称奖励','$config[z_overziliao]','$time')");			
			// 	$mysql_model->Query("UPDATE `@#_member` SET username='".$username."',qianming='".$qianming."',`score`=`score`+'$config[f_overziliao]',`jingyan`=`jingyan`+'$config[z_overziliao]' where uid='".$member['uid']."'");
			// }	
			if($mysql_model->Query("UPDATE `@#_member` SET username='".$username."',qianming='".$qianming."' where uid='".$uid."'")){
				response::show(2000,'修改资料成功');
			}else{
				response::show(2004,'修改资料失败');
			}
			
		}
		
	}
	/*
	 *查看是否绑定微信扣扣
	 */
	public function profile()
	{
		$wxinfo = $this->db->GetOne("SELECT * FROM `@#_member_band` WHERE `b_uid` = '$uid' AND `b_type`='weixin' LIMIT 1");
		$qqinfo = $this->db->GetOne("SELECT * FROM `@#_member_band` WHERE `b_uid` = '$uid' AND `b_type`='qq' LIMIT 1");
		$data['wx'] = empty($wxinfo)?'0':'1';
		$data['qq'] = empty($qqinfo)?'0':'1';
		if($data){
			response::show(2000,'获取消息成功',$data);
		}else{
			response::show(2004,'获取消息失败');
		}
	}

	/*
	 *手机绑定
	 */
	public function mobilecheckband()
	{
		if(empty($_POST['mobile']) || empty($_POST['code'])){
			response::show(2001,'缺少参数');
		}	
		$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
		$checkcodes=isset($_POST['code']) ? $_POST['code'] : '';	
			
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid` = '$uid' LIMIT 1");
		$usercode=explode("|",$member['mobilecode']);
		if($checkcodes!=$usercode[0]){
			response::show(2004,'绑定失败，请重新操作');
		}
		$this->db->Query("UPDATE `@#_member` SET `mobilecode`='1',`mobile` = '$mobile' where `uid`='$uid'");
		$this->db->Query("DELETE FROM `@#_member` WHERE `mobile` = '$mobile' AND `username`=''");
		response::show(2000,'绑定成功');
	}

	/*
	 *找回密码
	 */
	public function step3chk()
	{
		if(empty($_POST['mobile']) || empty($_POST['password'])){
			response::show(2001,'缺少参数');
		}
		$mobile = $_POST['mobile'];
		$pwd2= base64_decode($_POST['password']);
		
		if($this->db->Query("UPDATE `@#_member` SET password='".md5($pwd2)."' WHERE `mobile`='".$mobile."'")){
			response::show(2000,'找回成功');
		}else{
			response::show(2004,'找回失败，重新找回');
		}
		
	}

}