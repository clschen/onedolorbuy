<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_class('response','apis','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
session_start();
class home extends base {
	public $uid;
	public function __construct(){
		parent::__construct();
		$_POST = [
		'uid'=>'6',
		'token'=>'111111'
		];
		if(empty($_POST['uid']) || empty($_POST['token'])){
			response::show(2001,'缺少参数');
		}
		$this->uid = $_POST['uid'];
		// $uid = $_POST['uid'];
		/*if($_SESSION['user'.$uid] != $_POST['token']){
			response::show(2003,'token不匹配');
		}	*/

		$this->db = System::load_sys_class('model');
	}

  	
	/*
	 *分享
	 */
	public function invite()
	{
		require_once("system/modules/apis/jssdk.php");
        $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");
        $jssdk = new JSSDK($wechat['appid'],$wechat['appsecret']);
        $signPackage = $jssdk->GetSignPackage();
	}
	

	/*public function shareinc(){
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
	}*/

	/*
 	 *云购记录
	 */
	public function userbuylist()
	{
		$mysql_model=System::load_sys_class('model');				
		$record=$mysql_model->GetList("select * from `@#_member_go_record` where `uid`='$uid' ORDER BY `time` DESC");
		if($record){
			response::show(2000,'获取信息成功',$record);
		}else{
			response::show(2004,'获取夺宝记录失败');
		}
	}
	
	/*
 	 *云购记录详情
	 */

	public function userbuydetail()
	{
	    if(empty($_POST['crodid'])){
			response::show(2001,'缺少参数');
		}
		$mysql_model=System::load_sys_class('model');

		$crodid=intval($_POST['crodid']);

		$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `id`='$crodid' and `uid`='$uid' LIMIT 1");		

		if($record){
			response::show(2000,'获取成功',$record);
		}else{
			response::show(2004,'获取夺宝记录失败');
		}

	}

	/*
	 *中奖记录
	 */

	public function orderlist()
	{
		$record=$this->db->GetList("select * from `@#_member_go_record` where `uid`='".$uid."' and `huode`>'10000000' ORDER BY id DESC");				
		if($record>0){
			response::show(2000,'获取成功',$record);
		}else{
			response::show(2004,'没有获奖记录');
		}

	}

	/*
	 *账户明细
	 */

	public function userbalance()
	{
		$account=$this->db->GetList("select * from `@#_member_account` where `uid`='$uid' and `pay` = '账户' ORDER BY time DESC");

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
		$data = ['czsum'=>$czsum,'xfsum'=>$xfsum];
		if($data){
			response::show(2000,'获取记录成功',$data);
		}else{
			response::show(2004,'获取记录失败');
		}

	}

	

	 
	// 充值
	public function userrecharge()
	{

		$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1' AND pay_mobile = 1");
		if($paylist){
			response::show(2000,'获取记录成功',$paylist);
		}else{
			response::show(2004,'获取记录失败');
		}
	}

	/*
	 *用户签到页面
	 */

	public function userqiandao()
	{
		$uid = $this->uid;
		$qiandao = $this->db->GetOne("SELECT * FROM `@#_qiandao` where  `uid` = $uid");
		if($qiandao){
			response::show(2000,'获取记录成功',$qiandao);
		}else{
			response::show(2004,'获取记录失败');
		}

	}

	/*
	 *用户签到
	 */

	public function qiandao()
	{
		$uid = $this->uid;
		$t = time();

		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));

		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));

		//查询上次签到时间信息

		$qiandao = $this->db->GetOne("SELECT * FROM `@#_qiandao` where  `uid` = $uid");

		if(empty($qiandao)){

			$this->db->Query("INSERT INTO `@#_qiandao` SET `time` = $t, `uid` = $uid,`sum` = 1, `lianxu` = 1");

			//签到送100福分，同时送1元钱

			$this->db->Query("UPDATE `@#_member` SET `score` = `score`+100, `money` =`money`+0 WHERE `uid` = $uid");

			response::show(2000,'签到成功，初次签到，系统会赠送您100福分！同时积分还可以兑换现金哦');

		}

		if($qiandao['time']>0){

			if($qiandao['time']>$start && $qiandao['time']<$end){

				response::show(2002,'今天已经签到过了');

			}else{

				$this->db->Query("UPDATE `@#_qiandao` SET `time` = $t, `uid` =$uid, `sum` =`sum`+1  where uid=$uid");

				$this->db->Query("UPDATE `@#_member` SET `score` = `score`+100 WHERE `uid` = $uid");

				//判断是否连续

				if($t - $qiandao['time']>2 && $t - $qiandao['time']<172798 &&  $qiandao['time']>($start-86400)){

					$this->db->Query("UPDATE `@#_qiandao` SET `lianxu`  =`lianxu` +1 where `uid` = $uid");

				}else{

					$this->db->Query("UPDATE `@#_qiandao` SET `lianxu` = 1 where `uid`= $uid");

				}
				response::show(2000,'签到成功，坚持签到有积分赠送的哦！同时积分还可以兑换现金哦');
			}
		}else{
			response::show(2004,'签到错误');
		}
	}

	/*
	 *新增用户地址
	 */
	public function useraddress()
	{
		/*$_POST = ['sheng'=>'sd','shi'=>'sd','xian'=>'sdf','qq'=>'123','jiedao'=>'sdsd','youbian'=>'11','shouhuoren'=>'sd','mobile'=>'sdf'];*/
		$t = time();
		$uids = $this->uid;
		// var_dump($uids);die;
		if($_POST){
			extract($_POST);
			if(empty($sheng) || empty($shi) || empty($xian)){
				response::show(2001,'地市信息不能为空');
			}
			
			$jiedao1 = preg_replace( "@<script(.*?)</script>@is", "", $jiedao );
			$jiedao = $jiedao1;
			if(empty($jiedao)){
				response::show(2002,'街道地址包含特殊字符');
			}
			if(empty($qq) || empty($youbian) || empty($shouhuoren) || empty($mobile)){
				response::show(2001,'qq 或者 邮编 收货人 电话 不能为空');
			}
			$q1 = $this->db->Query("INSERT INTO `@#_member_dizhi` SET `time` = $t, `uid` = '$uids', `sheng` = '$sheng', `shi` = '$shi', `xian` = '$xian', `jiedao` = '$jiedao',`youbian` = $youbian, `shouhuoren`= '$shouhuoren', `mobile`= '$mobile', `qq`= '$qq'");
			if($q1){
				$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = '$uids'");
				response::show(2000,'地址添加成功',$dizhi);
			}else{
				response::show(2004,'地址添加失败');
			}
		}else{
			response::show(2001,'参数缺失');
		}
	}

	/*
	 *用户地址列表
	 */

	public function address()
	{	
		$uid = $this->uid;
		$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = $uid");
		if($dizhi){
			response::show(2000,'获取地址列表成功',$dizhi);
		}else{
			response::show(2004,'没有地址信息');
		}
	}

	/*
	 *用户地址修改
	 */

	public function updateddress()
	{
		/*$_POST = ['address_id'=>'7','sheng'=>'sd','shi'=>'sd','xian'=>'sdf','qq'=>'123','jiedao'=>'sdsd','youbian'=>'11','shouhuoren'=>'sd','mobile'=>'123'];*/
		$uid = $this->uid;
		if(empty($_POST['address_id'])){
			response::show(2001,'缺少参数');
		}
		$id=intval($_POST['address_id']);

		$t = time();

		if($id){

			extract($_POST);

			if(empty($sheng) || empty($shi) || empty($xian)){

				response::show(2001,'地市信息不能为空');

			}

			$jiedao1 = preg_replace( "@<script(.*?)</script>@is", "", $jiedao );
			$jiedao = $jiedao1;
			if(empty($jiedao)){
				response::show(2002,'街道地址包含特殊字符');
			}

			if(empty($qq) || empty($youbian) || empty($shouhuoren) || empty($mobile)){

				response::show(2001,'qq 或者 邮编 收货人 电话 不能为空');
			}

			$q1 = $this->db->Query("UPDATE `@#_member_dizhi` SET `time` = $t, `sheng` = '$sheng', `shi` = '$shi', `xian` = '$xian', `jiedao` = '$jiedao',`youbian` = '$youbian', `shouhuoren`= '$shouhuoren', `mobile`= '$mobile', `qq`= '$qq' WHERE `id`= '$id'");

			if($q1){
				$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = '$uid'");
				response::show(2000,'地址修改成功',$dizhi);
			}else{
				response::show(2004,'地址修改失败');
			}

		}else{
			response::show(2004,'修改失败');
		}

	}

	/*
	 *用户地址删除
	 */

	public function deladdress()
	{
		// $_POST['address_id'] = 7;
		$uid = $this->uid;
		if(empty($_POST['address_id'])){
			response::show(2001,'缺少参数');
		}
		$id=intval($_POST['address_id']);

		if($id){

			$q1 = $this->db->Query("DELETE FROM `@#_member_dizhi`  WHERE `id`= '$id'");

			if($q1){
				$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = '$uid'");
				response::show(2000,'删除成功',$dizhi);
			}else{
				response::show(2004,'删除失败');
			}

		}else{
			response::show(2004,'删除失败');
		}

	}

	/*
	 *用户设置默认地址
	 */

	public function setaddress()
	{	
		// $_POST['address_id'] = 7;
		if(empty($_POST['address_id'])){
			response::show(2001,'缺少参数');
		}
		$id=intval($_POST['address_id']);
		$uid = $this->uid;
		if($id){

			$q1 = $this->db->Query("UPDATE `@#_member_dizhi` SET `default` = 'Y' WHERE `id`= $id");
			$q2 = $this->db->Query("UPDATE `@#_member_dizhi` SET `default` = 'N' WHERE `id` != $id and `uid` = $uid");

			if($q1 && $q2){
				$dizhi = $this->db->GetList("SELECT * FROM `@#_member_dizhi` where  `uid` = '$uid'");
				response::show(2000,'设置成功',$dizhi);
			}else{
				response::show(2004,'设置失败');
			}

		}else{
			response::show(2004,'设置失败');
		}

	}

	/*
	 *用户转账
	 */
	public function zhuanzhang()
	{
		
		$t = time();
		//查询用户余额
		$info= $this->db->GetOne("SELECT `money` FROM `@#_member` where  `uid` = $uid");
		if($_POST){
			if(empty($_POST['to_user'])){
				response::show(2001,'缺少被转入的用户信息！');
			}
			if($info['money']< $_POST['money']){
				response::show(2001,'账户余额超过转账金额了！');
			}
			if(empty($_POST['money']) || $_POST['money']<1){
				response::show(2001,'请输入转账金额，且不能小于1元');
			}
			// 查询数据库中用户信息
			$to_user = $_POST['to_user'];
			$to_info= $this->db->GetOne("SELECT * FROM `@#_member` where  `mobile` = '{$to_user}' OR `email` = '{$to_user}'");
			$cash = $_POST['money'];
			if(empty($to_info)){
				response::show(2002,'用户不存在！请核对后在操作');
			}
			$this->db->Autocommit_start();
				$up_q1= $this->db->Query("UPDATE `@#_member` SET `money` = `money`- {$_POST['money']}  where  `uid` = $uid");
				$up_q2= $this->db->Query("UPDATE `@#_member` SET `money` = `money`+{$_POST['money']}  where  `uid` = {$to_info['uid']}");
				$up_q3= $this->db->Query("INSERT INTO `@#_member_account`  SET `uid`= $uid, `type` = -1, `pay`= '账户', `content`= '给用户{$to_info['mobile']}转账{$cash}元', `money` = $cash ,`time` = $t");
				$up_q4= $this->db->Query("INSERT INTO `@#_member_account`  SET `uid`= {$to_info['uid']}, `type` = -1, `pay`= '账户', `content`= '获得用户{$member['mobile']}转账{$cash}元', `money` = $cash ,`time` = $t");
			if($up_q1 && $up_q2 && $up_q3 && $up_q4){
				$this->db->Autocommit_commit();
				$info= $this->db->GetOne("SELECT `money` FROM `@#_member` where  `uid` = $uid");
				response::show(2000,'转账成功',$info);
			}else{
				$this->db->Autocommit_rollback();
				$this->error = true;
				response::show(2004,'转账失败');
			}	
		}
	}
	/**
	 * 转盘抽奖
	 */
	public function choujiang()
	{
		$row =  $this->db->GetOne("SELECT * FROM `@#_member`  WHERE  `uid` = $uid");
		$score = $row['score'];
		if(intval($score/200)<1){
			response::show(2004,'您的抽奖次数已经使用完！');
		}else{
			//扣除积分
			$q1= $this->db->Query("UPDATE `@#_member` SET `score` = `score`- 200  where  `uid` = $uid");
			$lefts = $score - 200;
			if($q1){
				$left = intval($score/200)-1;
			response::show(2000,'真遗憾，您没有中奖哦！剩余福分'.$lefts,['lefts'=>$lefts]);
			}else{
				$left = intval($score/200);			
				response::show(2004,'抽奖出错！请联系管理员！');
			}
		}
	}

		
	/*
	 *添加晒单
	 */
	public function postsinglebk()
	{
		if(empty($_POST['recordid']) || empty($_POST['title']) || empty($_POST['content']) || empty($_POST['file_up'])){
			response::show(2001,'缺少参数');
		}
		
		$pic=$_POST['file_up'];
		$pics = explode(';',$pic);
		$src=trim($pics[0]);
		$size=getimagesize(G_UPLOAD_PATH."/".$src);
		$width=220;
		$height=$size[1]*($width/$size[0]);
		$thumbs=tubimg($src,$width,$height);				
		$sd_userid=$uid;
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

		if($this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_qishu`,`sd_ip`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES ('$sd_userid','$ids','$qs','$sd_ip','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')")){
			response::show(2000,'晒单成功');
		}else{
			response::show(2004,'页面错误');
		}
	}

	/*
	 *添加晒单2
	 */
	public function postsingle()
	{
		if(empty($_POST['recordid']) || empty($_POST['title']) || empty($_POST['content']) || empty($_POST['fileurl_tmp'])){
			response::show(2001,'缺少参数');
		}
		$recordid=intval($_POST['recordid']);
		$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `shopid`='$recordid' and `uid` = '$member[uid]'");
		if(!$shaidan){
			response::show(2003,'该商品您不可晒单!');
		}
		$ginfo=$this->db->GetOne("select * from `@#_shoplist` where `id`='$shaidan[shopid]' LIMIT 1");
		if(!$ginfo){
			response::show(2003,'该商品已不存在!');
		}
		$shaidanyn=$this->db->GetOne("select sd_id from `@#_shaidan` where `sd_shopid`='{$ginfo['id']}' and `sd_userid` = '$member[uid]'");
		if($shaidanyn){
			response::show(2003,'不可重复晒单!');
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
		$sd_userid=$uid;
		$sd_shopid=intval($ginfo['id']);
		$sd_title=safe_replace($_POST['title']);
		$sd_thumbs=$src;
		$sd_content=safe_replace($_POST['content']);
		$sd_photolist=$pic;
		$sd_time=time();

		if($this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES('$sd_userid','$sd_shopid','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')")){
			response::show(2000,'晒单成功');
		}else{
			response::show(2004,'页面错误');
		}
	}

	/*
	 *晒单上传图片
	 */
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
				response::show(2000,'上传成功',['pic_url' =>$uploadDir.$targetFilename]);
			} else {
				response::show(2004,'上传失败');
			}
		}else{
			response::show(2001,'缺少参数');
		}
	}
	/*//检查图片存在否
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
	}*/
	/*
	 *删除图片
	 */
	public function singoldimg(){
		if(empty($_POST['sd_id']) || empty($_POST['oldimg'])){
			response::show(2001,'缺少参数');
		}
		$sd_id=$_POST['sd_id'];
		$oldimg=$_POST['oldimg'];
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
		$sd_photolist=str_replace($oldimg.";","",$shaidan['sd_photolist']);
		if($this->db->Query("UPDATE `@#_shaidan` SET sd_photolist='".$sd_photolist."' where sd_id='".$sd_id."'")){
			response::show(2000,'删除成功');
		}else{
			response::show(2004,'删除失败');
		}
		
	}
	/*public function singphotoup(){
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
	}*/
	/*public function singdel(){
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
	}*/
	/*
	 *晒单删除
	 */
	public function shaidandel()
	{
		if(empty($_POST['sd_id'])){
			response::show(2001,'缺少参数');
		}
		$id=intval($_POST['sd_id']);
		$shaidan=$this->db->Getone("select * from `@#_shaidan` where `sd_userid`='$member[uid]' and `sd_id`='$id'");
		if($shaidan){
			$this->db->Query("DELETE FROM `@#_shaidan` WHERE `sd_userid`='$member[uid]' and `sd_id`='$id'");
			response::show(2000,'删除成功');
		}else{
			response::show(2004,'删除失败');
		}
	}	 

}