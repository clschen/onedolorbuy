<?php 
defined('G_IN_SYSTEM')or exit('no');
// if (ini_get('display_errors')) {
//     ini_set('display_errors', '0');
// }
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);
class wechat extends admin {	

	public function __construct(){

		parent::__construct();

		$this->db=System::load_sys_class("model");

		$this->ment=array(

						array("webcfg","微信接口",ROUTE_M.'/'.ROUTE_C."/wechatcfg"),

						array("config","微信菜单",ROUTE_M.'/'.ROUTE_C."/menu"),

						array("upload","微信设置",ROUTE_M.'/'.ROUTE_C."/cfg"),

						array("watermark","关注回复设置",ROUTE_M.'/'.ROUTE_C."/reply"),

						array("email","关键词回复设置",ROUTE_M.'/'.ROUTE_C."/keywordlists"),

						array("mobile","互动积分设置",ROUTE_M.'/'.ROUTE_C."/hdcfg"),

						array("payset","红包设置",ROUTE_M.'/'.ROUTE_C."/huiyuan"),	

						array("domain","红包列表",ROUTE_M.'/'.ROUTE_C."/hblist"),

						array("send","红包添加",ROUTE_M.'/'.ROUTE_C."/hbadd"),

						array("cjlist","场景列表",ROUTE_M.'/'.ROUTE_C."/cjlist"),

						array("cjadd","场景添加",ROUTE_M.'/'.ROUTE_C."/cjadd"),

		);

	

	}
	/****************微信基本设置****************/
	public function wechatcfg(){

		if(isset($_POST['dosubmit'])){
			$token=trim($_POST['token']);

			$appid=trim($_POST['appid']);

			$appsecret=trim($_POST['appsecret']);

			if(empty($token) || empty($appid) || empty($appsecret)){
				_message("信息填写不能为空");
			}

			$this->db->Query("UPDATE `@#_wechat_config` SET `token`='$token' WHERE (`id`= 1)");

			$this->db->Query("UPDATE `@#_wechat_config` SET `appid`='$appid' WHERE (`id`=1)");

			$this->db->Query("UPDATE `@#_wechat_config` SET `appsecret`='$appsecret' WHERE (`id`=1)");	

			if($this->db->affected_rows()){
				_message("设置失败");

			}else{
				_message("设置成功");

			}

		}

		$wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");	

		include $this->tpl(ROUTE_M,'wechat.wechatcfg');

	}	
	
	/****************微信菜单设置********************/
	public function menu(){
	if (isset($_POST['tijiao'])) {
	      // 因为菜单最多有3个，所以进行循环
	      for($i=0;$i<3;$i++){
	          // 指定下标
	        $button=  "button_".$i;
	        $sub_button="sub_button_".$i."_0";
	        $type="type_".$i;
	        $urlkey="urlkey_".$i;  
	            // 如果有子菜单
	              if(trim($_POST[$sub_button])!==""){
	                  for($j=0;$j<5;$j++){
	                      $sub_button="sub_button_{$i}_{$j}";
	                      $type="type_{$i}_{$j}";
	                      $urlkey="urlkey_{$i}_{$j}";  
	                        if(trim($_POST[$sub_button])!==""){
	                            $menuarr['button'][$i]['name']=$_POST[$button];
	                              if($_POST[$type]=="key"){
	                                               $menuarr['button'][$i]['sub_button'][$j]['type']="click";
	                                               $menuarr['button'][$i]['sub_button'][$j]['name']=$_POST[$sub_button];
	                                               $menuarr['button'][$i]['sub_button'][$j]['key']=$_POST[$urlkey];
	                                   }else if($_POST[$type]=="url"){
	                                        $menuarr['button'][$i]['sub_button'][$j]['type']="view";
	                                        $menuarr['button'][$i]['sub_button'][$j]['name']=$_POST[$sub_button];
	                                        $menuarr['button'][$i]['sub_button'][$j]['url']=$_POST[$urlkey];
	                                   }
	                        }

	                  }
	              }else{            
	                        if(trim($_POST[$button])!==""){
	                                        if($_POST[$type]=="key"){
	                                                   $menuarr['button'][$i]['type']="click";
	                                                   $menuarr['button'][$i]['name']=$_POST[$button];
	                                                   $menuarr['button'][$i]['key']=$_POST[$urlkey];
	                                         }else if($_POST[$type]=="url"){
	                                                    $menuarr['button'][$i]['type']="view";
	                                                    $menuarr['button'][$i]['name']=$_POST[$button];
	                                                    $menuarr['button'][$i]['url']=$_POST[$urlkey];
	                                         }
	                                }
	                        }

	      }
	      // 对数组进行转json格式
	       $post=my_json_encode($menuarr);
	       $wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");
	      // 获取token
	      $token= get_token($wechat['appid'],$wechat['appsecret']);
	      //提交内容
	      $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}"; //查询地址 
	       $result = $this->https_request($url, $post);
	      if($result->errmsg == 'ok'){
	      	// 保存数据库
	      	$this->db->Query("UPDATE `@#_wechat_config` SET `menu`='$post' WHERE (`id`= 1)");
	      	$this->db->Query("UPDATE `@#_wechat_config` SET `access_token`='$token' WHERE (`id`= 1)");
	      	_message("菜单设置成功");
	      }else{
	      	_message("菜单设置失败");
	      }
	}
	$wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");
	$we = json_decode($wechat['menu'],true);
	$we = $we['button'];
	  include $this->tpl(ROUTE_M,'wechat.menu');
}

	/**************微信路径设置*********************/

	public function cfg(){	

		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			if(empty($_POST['murl']) || empty($_POST['baseurl']) || empty($_POST['imgpath']) || empty($_POST['userpwd']) || empty($_POST['template_zj']) || empty($_POST['template_fh'])){
				_message("所有选项均不能为空，请从新填写！");
			}
			$murl = htmlspecialchars(trim($_POST['murl']));
			$baseurl = htmlspecialchars(trim($_POST['baseurl']));
			$imgpath = htmlspecialchars(trim($_POST['imgpath']));
			$plustj = htmlspecialchars(trim($_POST['plustj']));
			$userpwd = htmlspecialchars(trim($_POST['userpwd']));
			$template_zj = htmlspecialchars(trim($_POST['template_zj']));
			$goods = htmlspecialchars(trim($_POST['goods']));
			$template_fh = htmlspecialchars(trim($_POST['template_fh']));
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$murl' WHERE (`cfg_name`= 'murl')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$baseurl' WHERE (`cfg_name`= 'baseurl')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$imgpath' WHERE (`cfg_name`= 'imgpath')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$plustj' WHERE (`cfg_name`= 'plustj')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$userpwd' WHERE (`cfg_name`= 'userpwd')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$cxbd' WHERE (`cfg_name`= 'cxbd')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$template_zj' WHERE (`cfg_name`= 'template_zj')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$goods' WHERE (`cfg_name`= 'goods')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$template_fh' WHERE (`cfg_name`= 'template_fh')");
			_message("设置更新成功");

		}
		$wechat= $this->db->GetList("select * from `@#_wxch_cfg`");
		include $this->tpl(ROUTE_M,'wechat.cfg');
	}

	public function share(){	

		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$money = htmlspecialchars(trim($_POST['money']));
			$share = htmlspecialchars(trim($_POST['share']));
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$share' WHERE (`cfg_name`= 'share')");
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$money' WHERE (`cfg_name`= 'money')");
			_message("设置更新成功");

		}
		$wechat= $this->db->GetList("select * from `@#_wxch_cfg`");
		include $this->tpl(ROUTE_M,'wechat.share');
	}
	

	//关键字回复设置

	public function reply(){
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$reply = htmlspecialchars(trim($_POST['reply']));
			$this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value`='$reply' WHERE (`cfg_name`= 'reply')");
			_message("设置成功");
		}		
		
		$wechat= $this->db->GetOne("select * from `@#_wxch_cfg` WHERE `cfg_name` ='reply'");
		$wechat = htmlspecialchars_decode($wechat['cfg_value']);
		include $this->tpl(ROUTE_M,'wechat.reply');
	}

	//关键词回复列表

	public function keywordlists(){
		$num=20;	

		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_weixin_keywords`");

		$page=System::load_sys_class('page');

		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	

		$page->config($total,$num,$pagenum,"0");


		$wechat= $this->db->GetPage("SELECT `id`, `name`, `keyword`, `type`, `count`, `status` FROM `@#_weixin_keywords` ORDER BY id DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include $this->tpl(ROUTE_M,'wechat.keywordlists');

	}
	/**关键词删除**/

	public function keyword_del(){
		$id=intval($this->segment(4));		
		$this->db->Query("DELETE FROM `@#_weixin_keywords` WHERE (`id`='$id') LIMIT 1");
			if($this->db->affected_rows()){			
				_message("删除失败");
			}else{
				_message("删除成功");
			}
	}
	/*****添加关键词*文本****/

	public function keyword_add1(){
		$id=intval($this->segment(4));
		if($id>0){
			$wechat = $this->db->GetOne("SELECT * FROM `@#_weixin_keywords` WHERE (`id`='$id') LIMIT 1");
		}
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$id = isset($_POST['id']) ? $_POST['id'] : 0;
			$name = trim($_POST['name']);
			$keyword = trim($_POST['keyword']);
			$contents = htmlspecialchars(trim($_POST['contents']));
			if(empty($name) || empty($keyword) || empty($contents)){
				_message("关键字，关键词，内容内容不能为空");
			}
			if($id>0){
				$this->db->Query("UPDATE `@#_weixin_keywords` SET `name`='$name', `keyword`='$keyword', `contents`='$contents' WHERE (`id`= '$id')");
				if($this->db->affected_rows()){			
					_message("修改成功",G_ADMIN_PATH.'/wechat/keywordlists/');
				}else{
					_message("修改失败",G_ADMIN_PATH.'/wechat/keywordlists/');
				}
			}else{
				$this->db->Query("INSERT INTO `@#_weixin_keywords` SET `name`='$name', `keyword`='$keyword', `contents`='$contents'");
				if($this->db->affected_rows()){			
					_message("添加成功",G_ADMIN_PATH.'/wechat/keywordlists/');
				}else{
					_message("添加失败",G_ADMIN_PATH.'/wechat/keywordlists/');
				}
			}
		}
		include $this->tpl(ROUTE_M,'wechat.text');
	}
	/*****添加关键词*图文****/

	public function keyword_add2(){
		$id=intval($this->segment(4));
		if($id>0){
			$wechat = $this->db->GetOne("SELECT * FROM `@#_weixin_keywords` WHERE (`id`='$id') LIMIT 1");
		}
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$id = isset($_POST['id']) ? $_POST['id'] : 0;
			$type = $_POST['type'];
			$name = trim($_POST['name']);
			$keyword = trim($_POST['keyword']);
			$desc = htmlspecialchars(trim($_POST['desc']));
			$pic_url = htmlspecialchars(addslashes($_POST['pic_url']));
			$pic = addslashes($_POST['pic']);
			$pic_tit =trim($_POST['pic_tit']);
			if(empty($name) || empty($keyword) || empty($desc) || empty($pic_url) || empty($pic_tit)){
				_message("关键字，关键词，内容内容, 图片地址，链接地址，图片标题不能为空");
			}
			if($id>0){
				$this->db->Query("UPDATE `@#_weixin_keywords` SET `name`='$name', `keyword`='$keyword', `type` = '$type', `desc`='$desc' ,`pic_url` ='$pic_url', `pic`= '$pic',  `pic_tit`= '$pic_tit' WHERE (`id`= '$id')");
				if($this->db->affected_rows()){			
					_message("修改成功",G_ADMIN_PATH.'/wechat/keywordlists/');
				}else{
					_message("修改失败",G_ADMIN_PATH.'/wechat/keywordlists/');
				}
			}else{
				$this->db->Query("INSERT INTO `@#_weixin_keywords` SET `name`='$name', `keyword`='$keyword', `type` = '$type', `desc`='$desc', `pic_url` ='$pic_url', `pic`= '$pic', `pic_tit`= '$pic_tit' ");
				if($this->db->affected_rows()){			
					_message("添加成功",G_ADMIN_PATH.'/wechat/keywordlists/');
				}else{
					_message("添加失败",G_ADMIN_PATH.'/wechat/keywordlists/');
				}
			}
		}

		include $this->tpl(ROUTE_M,'wechat.pic');
	}

	//互动积分设置
	public function hdcfg(){
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$data = $_POST;
			unset($_POST['dosubmit']);
			if(!empty($data)){
				foreach ($data as $k => $v) {
					$this->db->Query("UPDATE `@#_weixin_point` SET `autoload`='$v[0]', `point_value`='$v[1]' WHERE (`point_name`= '$k')");
				}
			}
			if($this->db->affected_rows()){
				_message("设置失败");
			}else{
				_message("设置成功");
			}
			
		}		
		
		$wechat= $this->db->GetList("SELECT * from `@#_weixin_point` ");
		include $this->tpl(ROUTE_M,'wechat.hdcfg');
	}
	/***微信会员列表****/
	public function huiyuan(){
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$v = $_POST['type_id'];
			$this->db->Query("UPDATE `@#_weixin_bonus` SET `type_id`='$v' WHERE (`id`= 1)");
			if($this->db->affected_rows()){
				_message("设置成功");
			}else{
				_message("设置失败");
			}
		}
		$wechat= $this->db->GetList("SELECT * from `@#_weixin_bonus_type` ");
		$type = $this->db->GetOne("SELECT * from `@#_weixin_bonus` ");
		include $this->tpl(ROUTE_M,'wechat.huiyuan');
	}
	//微信红包列表
	public function hblist(){
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$v = $_POST['type_id'];
			$this->db->Query("UPDATE `@#_weixin_bonus` SET `type_id`='$v' WHERE (`id`= 1)");
			if($this->db->affected_rows()){
				_message("设置成功");
			}else{
				_message("设置失败");
			}
		}

		$num=20;	

		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_weixin_keywords`");

		$page=System::load_sys_class('page');

		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	

		$page->config($total,$num,$pagenum,"0");


		$wechat= $this->db->GetPage("SELECT * from `@#_weixin_bonus_type` ORDER BY type_id DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include $this->tpl(ROUTE_M,'wechat.hblist');
	}
	//场景二维码
	public function cjlist(){
		$num=20;	
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_cjcode`");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$wechat= $this->db->GetPage("SELECT * from `@#_cjcode` ORDER BY `id` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include $this->tpl(ROUTE_M,'wechat.cjlist');
	}
	//场景二维码添加
	public function cjadd(){
		$id=intval($this->segment(4));
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$code   = !empty($_POST['code']) ? trim($_POST['code']) : 0;
			$scenename     = !empty($_POST['scenename']) ? $_POST['scenename'] : '';
			$time = time();
			if($code > 100000 || $code <= 0) _message("场景码必须是1-100000的整数哦！");
			if(empty($scenename)) _message("场景名称不能为空");
			if($id<=0){
				$wechat = $this->db->GetOne("SELECT * FROM `@#_cjcode` WHERE `code`='$code'");
				if (!empty($wechat)){
			   	_message("场景码已经存在，请修改后重新添加");
				}
			}
			$data = array(
				'action_name' => 'QR_LIMIT_SCENE',
				'action_info'=>array(
					'scene'=>array(
						'scene_id'=>$code,
						),
					),
				);
			$wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");// 修改场景码
			$token= get_token($wechat['appid'],$wechat['appsecret']);
			if(empty($token)) _message("token信息获取失败，请检查您的服务器设置");
			$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}"; //查询地址 
			$result = $this->https_request($url, json_encode($data));
			$ticket = $result->ticket;
			if(empty($ticket)) _message("二维码ticket获取失败，请检查配置");
			if($id>0){
				$res = $this->db->Query("UPDATE `@#_cjcode` SET `code`='$code', `scenename`='$scenename',`ticket`='$ticket',`time`= '$time' WHERE (`id`= $id)");
				if($res>0){
					_message("场景二维码修改成功",G_ADMIN_PATH.'/wechat/cjlist/');
				}else{
					_message("场景二维码修改失败",G_ADMIN_PATH.'/wechat/cjlist/');
				}

			}else{
				$res = $this->db->Query("INSERT INTO `@#_cjcode` (`code`, `scenename`,`ticket`,`time`) VALUES ('$code', '$scenename', '$ticket', '$time')");
				if($res>0){
					_message("场景二维码添加成功",G_ADMIN_PATH.'/wechat/cjlist/');
				}else{
					_message("场景二维码添加失败",G_ADMIN_PATH.'/wechat/cjlist/');
				}
			}
		}
		if($id>0){
			$wc = $this->db->GetOne("SELECT * FROM `@#_cjcode` WHERE `id`='$id'");
		}
		include $this->tpl(ROUTE_M,'wechat.cjadd');

	}
	//场景二维码删除
	public function cjdel(){
		$id=intval($this->segment(4));
		$re1 = $this->db->Query("DELETE FROM `@#_cjcode` WHERE (`code`='$id') LIMIT 1");
		$re2 = $this->db->Query("DELETE FROM `@#_cjlist` WHERE (`codeid`='$id')");
			if($re1  && $re2){			
				_message("删除成功");
			}else{
				_message("删除失败");
			}
	}
	//二维码场关注报表
	public function cjbaobiao1(){
		$id=intval($this->segment(4));
		$num=20;	
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_cjlist`  WHERE `codeid`='$id' AND `come` = 0");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total['total'],$num,$pagenum,"0");
		$list = $this->db->GetPage("SELECT * from `@#_cjlist` WHERE (`codeid`='$id' AND `come` = 0) ORDER BY `time` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		foreach ($list as &$v) {
			$v['uinfo'] = $this->get_in($v['uid']);
		}
		include $this->tpl(ROUTE_M,'wechat.cjbaobiao1');
	}
	//二维码场景扫描
	public function cjbaobiao2(){
		$id=intval($this->segment(4));
		$num=20;	
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_cjlist`  WHERE `codeid`='$id' AND `come` = 1");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total['total'],$num,$pagenum,"0");
		$list = $this->db->GetPage("SELECT * from `@#_cjlist` WHERE (`codeid`='$id' AND `come` = 1) ORDER BY `time` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		foreach ($list as &$v) {
			$v['uinfo'] = $this->get_in($v['uid']);
		}
		include $this->tpl(ROUTE_M,'wechat.cjbaobiao2');
	}
	/******添加微信红包类型****/
	public function hbadd(){
		$id=intval($this->segment(4));
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] != 'del'){
			$type_name   = !empty($_POST['type_name']) ? trim($_POST['type_name']) : '';
			$type_money     = !empty($_POST['type_money'])    ? intval($_POST['type_money'])    : 0;
			$send_type  = !empty($_POST['send_type']) ? intval($_POST['send_type']) : 0;
			$total = $_POST['total'] > 0 ? intval($_POST['total']) : 0;
			if($id<=0){
				$wechat = $this->db->GetOne("SELECT * FROM `@#_weixin_bonus_type` WHERE `type_name`='$type_name'");
				if (!empty($wechat)){
			   	_message("红包已经存在了，请修改后重新添加");
				}
			}
			/* 获得日期信息 */
			$send_startdate = strtotime($_POST['send_start_date']);
			$send_enddate   = strtotime($_POST['send_end_date']);
			if($id>0){
				$res = $this->db->Query("UPDATE `@#_weixin_bonus_type` SET `type_name`='$type_name', `type_money`='$type_money',`send_type`='$send_type',`send_start_date`= '$send_startdate',`send_end_date`='$send_enddate',`total`='$total' WHERE (`type_id`= $id)");
				if($res>0){
					_message("红包修改成功",G_ADMIN_PATH.'/wechat/hblist/');
				}else{
					_message("红包修改失败",G_ADMIN_PATH.'/wechat/hblist/');
				}

			}else{
				/* 插入数据库。 */
				$sql = "INSERT INTO `@#_weixin_bonus_type` (`type_name`, `type_money`,`send_type`,`send_start_date`,`send_end_date`,`total`)
				VALUES ('$type_name',
				        '$type_money',
				        '$send_type',
				        '$send_startdate',
				        '$send_enddate',
				        '$total')";
				$res = $this->db->Query($sql);
				if($res>0){
					_message("红包添加成功",G_ADMIN_PATH.'/wechat/hblist/');
				}else{
					_message("红包添加失败",G_ADMIN_PATH.'/wechat/hblist/');
				}
			}
		}
		if($id>0){
			$wc = $this->db->GetOne("SELECT * FROM `@#_weixin_bonus_type` WHERE `type_id`='$id'");
		}

		include $this->tpl(ROUTE_M,'wechat.hbadd');

	}
	//删除红包
	public function hbdel(){
		$id=intval($this->segment(4));
		$this->db->Query("DELETE FROM `@#_weixin_bonus_type` WHERE (`type_id`='$id') LIMIT 1");
			if($this->db->affected_rows()){			
				_message("删除成功");
			}else{
				_message("删除失败");
			}
	}
	//红包报表
	public function baobiao(){
		$id=intval($this->segment(4));

		$num=20;	

		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_weixin_sign`  WHERE (`typeid`='$id')");
		$page=System::load_sys_class('page');

		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total['total'],$num,$pagenum,"0");

		$list = $this->db->GetPage("SELECT * from `@#_weixin_sign` WHERE (`typeid`='$id') ORDER BY `input_time` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		foreach ($list as &$v) {
			$v['uinfo'] = $this->get_in($v['uid'],$id);
		}
		include $this->tpl(ROUTE_M,'wechat.baobiao');
	}


	private function get_in($nic=0,$id=0){
		$arr = array();
		$arr = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid`='$nic'");
		if($id>0){
			$arr['usertotal'] = $this->db->GetCount("SELECT COUNT(*) FROM `@#_weixin_sign`  WHERE `typeid`='$id' AND `uid`='$nic'");
		}
		return $arr;
	}

	//私有方法保存菜单
	private function https_request($url,$data = null){
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    if (!empty($data)){
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
	    return json_decode($output);
	}


}