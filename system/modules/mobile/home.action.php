<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class home extends base {
	public function __construct(){
		parent::__construct();
		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo){
				if(!$uid && !$_GET['wxid']){
					if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
						header("Location: ".WEB_PATH."/api/wxlogin");exit;
					}
				}
				if(!isset($_GET['wxid'])){
					//_messagemobile("请登录",WEB_PATH."/mobile/user/login",3);
					header("Location: ".WEB_PATH."/mobile/user/login");exit;
				}else{
					$wxid = $_GET['wxid'];
					if (empty($wxid)){
						//_messagemobile("请登录",WEB_PATH."/mobile/user/login",3);
						header("Location: ".WEB_PATH."/mobile/user/login");exit;
					}
					$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$wxid."'");
					if (empty($mem)){
						//_messagemobile("请登录",WEB_PATH."/mobile/user/login",3);
						header("Location: ".WEB_PATH."/mobile/user/login");exit;
					}
					$this->userinfo=$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");
					_setcookie("uid",_encrypt($member['uid']),60*60*24*7);
					_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
				}
			}
		}
		/*
		if(!$this->userinfo['mobile']){
			header("location:".WEB_PATH."/mobile/user/mobile/");exit;
		}
		*/
		$this->db = System::load_sys_class('model');
	}

	
	public function init(){
		
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="我的用户中心";
		//$quanzi=$this->db->GetList("select * from `@#_quanzi_tiezi` order by id DESC LIMIT 5");
		if(!empty($member['headimg'])){
			$member['img'] = $member['headimg'];
		}else{
			$member['img'] = G_UPLOAD_PATH.'/'.$member['img'];
		}
	 //获取用户等级  用户新手  用户小将==
	  $memberdj=$this->db->GetList("select * from `@#_member_group`");
	  $jingyan=$member['jingyan'];
	  if(!empty($memberdj)){
	     foreach($memberdj as $key=>$val){
		    if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
		    		   $member['yungoudj']=$val['name'];

			}
		}
	}
	$uid=_getcookie('uid');
	require_once("system/modules/mobile/jssdk.php");

         $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");

        $jssdk = new JSSDK($wechat['appid'],$wechat['appsecret']);

        $signPackage = $jssdk->GetSignPackage();

	include templates("mobile/user","index");
}
public function invite(){

        $webname=$this->_cfg['web_name'];

        $member=$this->userinfo;

        $title="我的用户中心";

        $uid=_getcookie('uid');

        //$quanzi=$this->db->GetList("select * from `@#_quanzi_tiezi` order by id DESC LIMIT 5");

        //获取夺宝等级  夺宝新手  夺宝小将==

        $memberdj=$this->db->GetList("select * from `@#_member_group`");

        $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");

        $jingyan=$member['jingyan'];

        if(!empty($memberdj)){

            foreach($memberdj as $key=>$val){

                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){

                    $member['yungoudj']=$val['name'];

                }

            }

        }

        require_once("system/modules/mobile/jssdk.php");

         $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");

        $jssdk = new JSSDK($wechat['appid'],$wechat['appsecret']);

        $signPackage = $jssdk->GetSignPackage();
        include templates("mobile/user","invite");

    }	


	public function inviteshare(){

		$member=$this->userinfo;

		require_once("system/modules/mobile/jssdk.php");

		 $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");

		$jssdk = new JSSDK($wechat['appid'],$wechat['appsecret']);

		$signPackage = $jssdk->GetSignPackage();

		include templates("mobile/user","inviteshare");

	}

	public function shareinc(){

		$uid = empty($_POST['f']) ? 0 : $_POST['f'];

		$share=$this->db->GetList("select * from `@#_wxch_cfg`");

		if($uid<1){

			echo 5;die;

		}

		if(!$share[11]['cfg_value']){

			echo 1;die;

		}else{

			$info = $this->db->GetOne("SELECT * FROM `@#_share` WHERE `uid` ='$uid' LIMIT 1");

			if(empty($info)){

				$mon = empty($share[12]['cfg_value']) ? 0 : $share[12]['cfg_value'];

				$time = time();

				$q1 = $this->db->Query("UPDATE `@#_member` SET  `money` =`money`+$mon WHERE `uid` = $uid");

				$q2 = $this->db->Query("INSERT INTO `@#_share` SET  `time` ='$time' , `uid` ='$uid'");

				if($q1>0 && $q2>0){

					echo 2;die;

				}else{

					echo 3;die;

				}

			}else{

				echo 4;die;

			}
		}

	}

	//夺宝记录
	public function userbuylist(){
	   $webname=$this->_cfg['web_name'];
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$title="夺宝记录";					
		//$record=$mysql_model->GetList("select * from `@#_member_go_record` where `uid`='$uid' ORDER BY `time` DESC");
		$user_dizhi = $mysql_model->GetOne("select * from `@#_member_dizhi` where `uid` = '$uid'");
		include templates("mobile/user","userbuylist");
	}

	//夺宝记录详细

	public function userbuydetail(){

	    $webname=$this->_cfg['web_name'];

		$mysql_model=System::load_sys_class('model');

		$member=$this->userinfo;

		$title="夺宝详情";

		$crodid=intval($this->segment(4));

		$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `id`='$crodid' and `uid`='$member[uid]' LIMIT 1");		

		if($crodid>0){

			include templates("member","userbuydetail");

		}else{

			echo _messagemobile("页面错误",WEB_PATH."/member/home/userbuylist",3);

		}

	}

	//获得的商品

	public function orderlist(){

	    $webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$title="获得的商品";

		//$record=$this->db->GetList("select * from `@#_member_go_record` where `uid`='".$member['uid']."' and `huode`>'10000000' ORDER BY id DESC");				

		include templates("mobile/user","orderlist");

	}

	//账户管理

	public function userbalance(){

	    $webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$title="账户记录";

		$account=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' ORDER BY time DESC");

         		$czsum=0;

         		$xfsum=0;

		if(!empty($account)){ 

			foreach($account as $key=>$val){

			  if($val['type']==1){

				$czsum+=$val['money'];		  

			  }else{

				$xfsum+=$val['money'];		  

			  }		

			} 		

		}

		

		include templates("mobile/user","userbalance");

	}

	

	 

	public function userrecharge(){

	    $webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$title="账户充值";

		$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1' AND pay_mobile = 1");

		

		include templates("mobile/user","recharge");

	}

	public function userqiandao(){

		$webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$uid = $member['uid'];

		$qiandao = $this->db->GetOne("SELECT * FROM `@#_qiandao` where  `uid` = $uid");

		include templates("mobile/user","userqiandao");

	}



	public function qiandao(){

		$member=$this->userinfo;

		$uid = $member['uid'];

		$t = time();

		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));

		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));

		//查询上次签到时间信息

		$qiandao = $this->db->GetOne("SELECT * FROM `@#_qiandao` where  `uid` = $uid");

		if(empty($qiandao)){

			$this->db->Query("INSERT INTO `@#_qiandao` SET `time` = $t, `uid` = $uid,`sum` = 1, `lianxu` = 1");

			//签到送100福分，同时送1元钱

			$this->db->Query("UPDATE `@#_member` SET `score` = `score`+100, `money` =`money`+0 WHERE `uid` = $uid");

			_messagemobile("签到成功，初次签到，系统会赠送您100福分！同时积分还可以兑换现金哦",WEB_PATH."/mobile/home/userqiandao");

		}

		if($qiandao['time']>0){

			if($qiandao['time']>$start && $qiandao['time']<$end){

				_messagemobile("今天已经签到过了",WEB_PATH."/mobile/home/userqiandao");

			}else{

				$this->db->Query("UPDATE `@#_qiandao` SET `time` = $t, `uid` =$uid, `sum` =`sum`+1  where uid=$uid");

				$this->db->Query("UPDATE `@#_member` SET `score` = `score`+100 WHERE `uid` = $uid");

				//判断是否连续

				if($t - $qiandao['time']>2 && $t - $qiandao['time']<172798 &&  $qiandao['time']>($start-86400)){

					$this->db->Query("UPDATE `@#_qiandao` SET `lianxu`  =`lianxu` +1 where `uid` = $uid");

				}else{

					$this->db->Query("UPDATE `@#_qiandao` SET `lianxu` = 1 where `uid`= $uid");

				}
				_messagemobile("签到成功，坚持签到有积分赠送的哦！同时积分还可以兑换现金哦",WEB_PATH."/mobile/home/userqiandao");
			}
		}else{
			_messagemobile("签到错误",WEB_PATH."/mobile/home/userqiandao");
		}
	}

	public function useraddress(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$t = time();
		if($_POST['submit']){
			extract($_POST);
			if(empty($sheng) || empty($shi) || empty($xian)){
				_messagemobile("地市信息不能为空",WEB_PATH."/mobile/home/address");
			}
			$jiedao1 = preg_replace( "@<script(.*?)</script>@is", "", $jiedao );
			$jiedao = $jiedao1;
			if(empty($jiedao)){
				_messagemobile("街道地址包含特殊字符",WEB_PATH."/mobile/home/address");
			}
			if(empty($qq) || empty($youbian) || empty($shouhuoren) || empty($mobile)){
				_messagemobile("qq 或者 邮编 收货人 电话 不能为空",WEB_PATH."/mobile/home/address");
			}
			$q1 = $this->db->Query("INSERT INTO `@#_member_dizhi` SET `time` = $t, `uid` = $uid, `sheng` = '$sheng', `shi` = '$shi', `xian` = '$xian', `jiedao` = '$jiedao',`youbian` = $youbian, `shouhuoren`= '$shouhuoren', `mobile`= '$mobile', `qq`= '$qq', `shifoufahuo` = $shifoufahuo");
			if($q1){
				_messagemobile("地址添加成功",WEB_PATH."/mobile/home/address");
			}else{
				_messagemobile("地址添加失败",WEB_PATH."/mobile/home/address");
			}
		}else{
			_messagemobile("添加失败",WEB_PATH."/mobile/home/address");
		}
	}



	public function address(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = $uid");
		include templates("mobile/user","address");

	}
	public function updateddress(){
		$id=intval($this->segment(4));

		$t = time();

		if($id){

			extract($_POST);

			if(empty($sheng) || empty($shi) || empty($xian)){

				_messagemobile("地市信息不能为空",WEB_PATH."/mobile/home/address");

			}

			$jiedao1 = preg_replace( "@<script(.*?)</script>@is", "", $jiedao );
			$jiedao = $jiedao1;
			if(empty($jiedao)){
				_messagemobile("街道地址包含特殊字符",WEB_PATH."/mobile/home/address");
			}

			if(empty($qq) || empty($youbian) || empty($shouhuoren) || empty($mobile)){

				_messagemobile("qq 或者 邮编 收货人 电话 不能为空",WEB_PATH."/mobile/home/address");
			}

			$q1 = $this->db->Query("UPDATE `@#_member_dizhi` SET `time` = $t, `sheng` = '$sheng', `shi` = '$shi', `xian` = '$xian', `jiedao` = '$jiedao',`youbian` = $youbian, `shouhuoren`= '$shouhuoren', `mobile`= '$mobile', `qq`= '$qq', `shifoufahuo` = $shifoufahuo WHERE `id`= $id");

			if($q1){

				_messagemobile("地址修改成功",WEB_PATH."/mobile/home/address");

			}else{

				_messagemobile("地址修改失败",WEB_PATH."/mobile/home/address");

			}

			



		}else{

			_messagemobile("修改失败",WEB_PATH."/mobile/home/address");

		}

	}



	public function deladdress(){

		$id=intval($this->segment(4));

		if($id){

			$q1 = $this->db->Query("DELETE FROM `@#_member_dizhi`  WHERE `id`= $id");

			if($q1){

				_messagemobile("删除成功",WEB_PATH."/mobile/home/address");

			}else{

				_messagemobile("删除失败",WEB_PATH."/mobile/home/address");

			}

		}else{

			_messagemobile("删除失败",WEB_PATH."/mobile/home/address");

		}

	}



	//设为默认

	public function setaddress(){

		$id=intval($this->segment(4));

		if($id){

			$q1 = $this->db->Query("UPDATE `@#_member_dizhi` SET `default` = 'Y' WHERE `id`= $id");

			$q2 = $this->db->Query("UPDATE `@#_member_dizhi` SET `default` = 'N' WHERE `id` != $id");

			if($q1 && $q2){

				_messagemobile("设置成功",WEB_PATH."/mobile/home/address");

			}else{

				_messagemobile("设置失败",WEB_PATH."/mobile/home/address");

			}

		}else{
			_messagemobile("设置失败",WEB_PATH."/mobile/home/address");
		}

	}
	public function zhuanzhang(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$t = time();
		//查询用户余额
		$info= $this->db->GetOne("SELECT `money` FROM `@#_member` where  `uid` = $uid");
		if($_POST['submit1']){
			if($_POST['txtBankName'] != $_POST['txtBankName1']){
				_messagemobile("两次的用户信息不一致，请重新输入！",WEB_PATH."/mobile/home/zhuanzhang");
			}
			if($info['money']< $_POST['money']){
				_messagemobile("账户余额超过转账金额了！",WEB_PATH."/mobile/home/zhuanzhang");
			}
			if(empty($_POST['money']) || $_POST['money']<1){
				_messagemobile("请输入转账金额，且不能小于1元",WEB_PATH."/mobile/home/zhuanzhang");
			}
			// 查询数据库中用户信息
			$to_user = $_POST['txtBankName'];
			$to_info= $this->db->GetOne("SELECT * FROM `@#_member` where  `mobile` = '{$to_user}' OR `email` = '{$to_user}'");
			$cash = $_POST['money'];
			if(empty($to_info)){
				_messagemobile("用户不存在！请核对后在操作",WEB_PATH."/mobile/home/zhuanzhang");
			}
			$this->db->Autocommit_start();
				$up_q1= $this->db->Query("UPDATE `@#_member` SET `money` = `money`- {$_POST['money']}  where  `uid` = $uid");
				$up_q2= $this->db->Query("UPDATE `@#_member` SET `money` = `money`+{$_POST['money']}  where  `uid` = {$to_info['uid']}");
				$up_q3= $this->db->Query("INSERT INTO `@#_member_account`  SET `uid`= $uid, `type` = -1, `pay`= '账户', `content`= '给用户{$to_info['mobile']}转账{$cash}元', `money` = $cash ,`time` = $t");
				$up_q4= $this->db->Query("INSERT INTO `@#_member_account`  SET `uid`= {$to_info['uid']}, `type` = -1, `pay`= '账户', `content`= '获得用户{$member['mobile']}转账{$cash}元', `money` = $cash ,`time` = $t");
			if($up_q1 && $up_q2 && $up_q3 && $up_q4){
				$this->db->Autocommit_commit();
				_messagemobile("转账成功",WEB_PATH."/mobile/home/zhuanzhang");
			}else{
				$this->db->Autocommit_rollback();
				$this->error = true;
				_messagemobile("转账失败",WEB_PATH."/mobile/home/zhuanzhang");
			}	
		}
		include templates("mobile/user","zhuanzhang");
	}
	/**
	 * 转盘抽奖
	 */
	public function choujiang(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$name = $member['username'];
		include templates("mobile/user","choujiang");
	}
	public function submit(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$row =  $this->db->GetOne("SELECT * FROM `@#_member`  WHERE  `uid` = $uid");
		$score = $row['score'];
		if(intval($score/200)<1){
			$res = array(
				'ok' => true,
				'round'=>0,
				'left' => 0,
				'desc' =>'您的抽奖次数已经使用完！',
			);
			echo json_encode($res);die;	
		}else{
			//扣除积分
			$q1= $this->db->Query("UPDATE `@#_member` SET `score` = `score`- 200  where  `uid` = $uid");
			$lefts = $score - 200;
			if($q1){
				$left = intval($score/200)-1;
				$res = array(
					'ok' => true,
					'round'=>0,
					'left' => $left,
					'desc' =>'真遗憾，您没有中奖哦！剩余福分'.$lefts,
				);
			echo json_encode($res);die;	
			}else{
				$left = intval($score/200);
				$res = array(
					'ok' => true,
					'round'=>0,
					'left' => $left,
					'desc' =>'抽奖出错！请联系管理员',
			);
			echo json_encode($res);die;
			}
		}
	}
	/**
	 * 摇一摇红包
	 */
	public function yaohongbao(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$uid = $member['uid'];
		$name = $member['username'];
		include templates("mobile/user","yaohongbao");
	}
	//晒单
	public function singlelist(){
		 $webname=$this->_cfg['web_name'];
		include templates("mobile/user","singlelist");
	}	
	//添加晒单
	public function postsinglebk(){
		$member=$this->userinfo;
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		$title="添加晒单";		
		if(isset($_POST['submit'])){
			if($_POST['title']==null) _messagemobile("标题不能为空");	
			if($_POST['content']==null) _messagemobile("内容不能为空");	
			if(empty($_POST['file_up'])){
				_messagemobile("图片不能为空");
			}
			$pic=$_POST['file_up'];
			$pics = explode(';',$pic);
			$src=trim($pics[0]);
			$size=getimagesize(G_UPLOAD_PATH."/".$src);
			$width=220;
			$height=$size[1]*($width/$size[0]);
			$thumbs=tubimg($src,$width,$height);				
			$uid=$this->userinfo;
			$sd_userid=$uid['uid'];
			$sd_shopid=$_POST['shopid'];
			$sd_title=$_POST['title'];
			$sd_thumbs="shaidan/".$thumbs;
			$sd_content=$_POST['content'];
			$sd_photolist=$pic;
			$sd_time=time();			
			$sd_ip = _get_ip_dizhi();						
			$qishu= $this->db->GetOne("select `qishu`, `id` from `@#_shoplist` where `id`='$sd_shopid'");
			$qs = $qishu['qishu'];
			$ids = $qishu['id'];
			$this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_qishu`,`sd_ip`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES ('$sd_userid','$ids','$qs','$sd_ip','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')");
			_messagemobile("晒单分享成功",WEB_PATH."/mobile/home/singlelist");
		}
		$recordid=intval($this->segment(4));
		if($recordid>0){
			$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `id`='$recordid'");	
			$shopid=$shaidan['id'];
			include templates("mobile/user","postsingle");
		}else{
			_messagemobile("页面错误");
		}
	}

	public function postsingle(){
		$member=$this->userinfo;
		$uid=$member['uid'];
		$title="添加晒单";
		$recordid=intval($this->segment(4));
		$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `shopid`='$recordid' and `uid` = '$member[uid]'");
		if(!$shaidan){
			_messagemobile("该商品您不可晒单!");
		}
		$ginfo=$this->db->GetOne("select * from `@#_shoplist` where `id`='$shaidan[shopid]' LIMIT 1");
		if(!$ginfo){
			_messagemobile("该商品已不存在!");
		}
		$shaidanyn=$this->db->GetOne("select sd_id from `@#_shaidan` where `sd_shopid`='{$ginfo['id']}' and `sd_userid` = '$member[uid]'");
		if($shaidanyn){
			_messagemobile("不可重复晒单!");
		}
		if($_POST){

			if($_POST['title']==null)_messagemobile("标题不能为空");
			if($_POST['content']==null)_messagemobile("内容不能为空");
			if(!isset($_POST['fileurl_tmp'])){
				_messagemobile("图片不能为空");
			}
			System::load_sys_class('upload','sys','no');
			$img=explode(';', $_POST['fileurl_tmp']);
			$num=count($img);
			$pic="";
			for($i=0;$i<$num;$i++){
				$img[$i] = str_replace('http://', '', $img[$i]);
				$img[$i] = str_replace($_SERVER['HTTP_HOST'], '', $img[$i]);
				$img[$i] = str_replace('/statics/uploads/', '', $img[$i]);
				$pic.=trim($img[$i]).";";
			}

			$src=trim($img[0]);
			$size=getimagesize(G_UPLOAD_PATH."/".$src);
			$width=220;
			$height=$size[1]*($width/$size[0]);
			$thumbs=tubimg($src,$width,$height);
			$sd_userid=$uid;
			$sd_shopid=intval($ginfo['id']);
			$sd_title=safe_replace($_POST['title']);
			$sd_thumbs=$src;
			$sd_content=safe_replace($_POST['content']);
			$sd_photolist=$pic;
			$sd_time=time();
			$this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES
			('$sd_userid','$sd_shopid','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')");
			header("Location:".WEB_PATH."/mobile/home/singlelist");
		}

		if($recordid>0){
			$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `id`='$recordid'");
			$shopid=$shaidan['shopid'];
			include templates("mobile/user","postsingle");
		}else{
			_messagemobile("页面错误");
		}
	}
	// 晒单上传图片方法
	public function mupload(){
		$uploadDir =$_SERVER['DOCUMENT_ROOT'].'/statics/uploads/shaidan/'.date('Ymd',time()).'/';
		if(!is_dir($uploadDir)){
		 	mkdir($uploadDir,0777);				
		}
		$rand=rand(10,99).substr(microtime(),2,6).substr(time(),4,6);
		$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); 
		if (!empty($_FILES)) {
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$filetype = strtolower($fileParts['extension']);
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$targetFilename = $rand.'.'.$filetype;
			if (in_array($filetype, $fileTypes)) {
				move_uploaded_file($tempFile, $uploadDir.$targetFilename);
				echo 'shaidan/'.date('Ymd',time()).'/'.$targetFilename;
			} else {
				echo 'Invalid file type.';
			}
		}
	}
	//检查图片存在否
	public function check_exists(){
		$fileurl = $_SERVER['DOCUMENT_ROOT'].'/statics/uploads/shaidan/'.date('Ymd',time()).'/'.$_POST['filename'];
		if (file_exists($fileurl)){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function file_upload(){
		ini_set('display_errors', 0);
		// error_reporting(E_ALL);
		include dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."UploadHandler.php";
		$upload_handler = new UploadHandler();
	}
	public function singoldimg(){
		if($_POST['action']=='del'){
			$sd_id=$_POST['sd_id'];
			$oldimg=$_POST['oldimg'];
			$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
			$sd_photolist=str_replace($oldimg.";","",$shaidan['sd_photolist']);
			$this->db->Query("UPDATE `@#_shaidan` SET sd_photolist='".$sd_photolist."' where sd_id='".$sd_id."'");
		}
	}
	public function singphotoup(){
		$mysql_model=System::load_sys_class('model');
		if(!empty($_FILES)){
			$uid=isset($_POST['uid']) ? $_POST['uid'] : NULL;
			$ushell=isset($_POST['ushell']) ? $_POST['ushell'] : NULL;
			$login=$this->checkuser($uid,$ushell);
			if(!$login){_messagemobile("上传出错");}
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg','gif'),1000000,'shaidan');
			upload::go_upload($_FILES['Filedata']);
			if(!upload::$ok){
				echo _messagemobile(upload::$error,null,3);
			}else{
				$img=upload::$filedir."/".upload::$filename;
				$size=getimagesize(G_UPLOAD_PATH."/shaidan/".$img);
				$max=700;$w=$size[0];$h=$size[1];
				if($w>700){
					$w2=$max;
					$h2=$h*($max/$w);
					upload::thumbs($w2,$h2,1);
				}

				echo trim("shaidan/".$img);
			}
		}
	}
	public function singdel(){
		$action=isset($_GET['action']) ? $_GET['action'] : null;
		$filename=isset($_GET['filename']) ? $_GET['filename'] : null;
		if($action=='del' && !empty($filename)){
			$filename=G_UPLOAD_PATH.'shaidan/'.$filename;
			$size=getimagesize($filename);
			$filetype=explode('/',$size['mime']);
			if($filetype[0]!='image'){
				return false;
				exit;
			}
			unlink($filename);
			exit;
		}
	}
	//晒单删除
	public function shaidandel(){
		_messagemobile("不可以删除!");
		$member=$this->userinfo;
		//$id=isset($_GET['id']) ? $_GET['id'] : "";
		$id=$this->segment(4);
		$id=intval($id);
		$shaidan=$this->db->Getone("select * from `@#_shaidan` where `sd_userid`='$member[uid]' and `sd_id`='$id'");
		if($shaidan){
			$this->db->Query("DELETE FROM `@#_shaidan` WHERE `sd_userid`='$member[uid]' and `sd_id`='$id'");
			_messagemobile("删除成功",WEB_PATH."/mobile/home/singlelist");
		}else{
			_messagemobile("删除失败",WEB_PATH."/mobile/home/singlelist");
		}
	}



	 

}