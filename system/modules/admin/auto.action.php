<?php 
defined('G_IN_SYSTEM')or exit('no');
// if (ini_get('display_errors')) {
//     ini_set('display_errors', '0');
// }
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);
class auto extends admin {	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
	}
	/****************微信基本设置****************/
	public function show(){
		$p = $this->segment(4);
		if($p == null ){
			$p = 1;
		}
		$num=50;
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_shoplist` WHERE `q_uid` is null  order by `id` DESC"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,1,"0");
		$shoplist=$this->db->GetPage("SELECT * FROM `@#_shoplist` WHERE `q_uid` is null  order by `id` DESC ",array("num"=>$num,"page"=>$p,"type"=>1,"cache"=>0));
		$data  = $this->db->GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE  `cfg_name` = 'auto'  LIMIT 1");
		$data = unserialize($data['cfg_value']);
		$times = intval($data['mintime']);  //最小间隔时间
		$endtimes = intval($data['maxtime']);  //最大间隔时间
		$shopid = $data['shopid'];//商品ID 以“-” 分割
		$shopidarray = explode("-",$shopid);
		$oo = $data['on'];//开启或关闭状态
		$runtime =$data['runtime'];//运行时间
		$autoadd = $data['autoadd'];//是否自动进入下一期
		$mshop = $data['mshop'];//是否购买多个商品
		$timeperiod = $data['timeperiod'];//时间段
		$tp = explode("-",$timeperiod);
		//页码
		if($p == 1){
			$o_p =1;
			$n_p = 2;
		}else{
			$o_p = $p-1;
			$n_p = $p+1;
		}
		/*----------判断线程是否死掉----------*/

		include $this->tpl(ROUTE_M,'auto.show');

	}
		//关闭
	public function stop(){
			$data  = $this->db->GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE  `cfg_name` = 'auto'  LIMIT 1");
			$data = unserialize($data['cfg_value']);
			$data['on'] = 0;
			$data = serialize($data);
			$rs = $this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value` = '$data' WHERE `cfg_name` = 'auto'");
			if($rs){
				echo "设置关闭成功";exit;
			}else{
				echo "设置关闭失败";exit;
			}
	}
		//保存配置----并开起

	public function ajaxaction(){
			$m_shop_value = isset($_POST['m_shop_value'])?$_POST['m_shop_value']:-1;//随机购买多个商品
			$times = isset($_POST['times'])?intval($_POST['times']):-1;//最小间隔时间
			$endtimes = isset($_POST['endtimes'])?intval($_POST['endtimes']):-1;//最大间隔时间
			$f_userid = isset($_POST['f_userid'])?intval($_POST['f_userid']):-1;//用户段---开始IP  （包含此IP） 
			$l_userid = isset($_POST['l_userid'])?intval($_POST['l_userid']):-1;//用户段----结束IP （包含此IP） 
			$autoadd = isset($_POST['autoadd'])?intval($_POST['autoadd']):-1;//是否自动进入下一期
			$shopid = isset($_POST['shopid'])?$_POST['shopid']:-1;//商品ID群	
			$timeperiod = isset($_POST['timeperiod'])?$_POST['timeperiod']:0;
			if((!@eregi('^[0-9]*$',$times)) || $times <= 0 || $endtimes <=0 || $endtimes <= $times ){
				echo  '时间参数错误';return;
			} 

			if($f_userid <= 0 || $l_userid <= 0 ||  $l_userid <= $f_userid){
				echo "用户段参数错误";return;
			}
			if($shopid <= 0){
				echo "商品信息错误";return;
			}
			$tp = explode("-",$timeperiod);
			if(count($tp) != 0){
				foreach($tp as $k=>$v){
					if(intval($v)>23 && intval($v)<0){
						echo "时间区间错误";exit;
					}
				}
			}else{
				echo "时间区间错误";exit;
			}
			$temp = array();
			$temp['on'] = 1;   //是否开启
			$temp['uf' ] = $f_userid;  //开始的用户id
			$temp['ul' ] = $l_userid;   //结束的用户id
			$temp['mintime'] = $times;
			$temp['maxtime'] = $endtimes;
			$temp['shopid'] = $shopid;   //购买的商品数
			$temp['autoadd'] = $autoadd;  //自动进入下一期
			$temp['mshop'] = $m_shop_value; //是否购买多个商品
			$temp['timeperiod'] = $timeperiod;    //购买时段
			$temp["runtime"] = time();
			$temp = serialize($temp);
			$rs = $this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value` = '$temp' WHERE `cfg_name` = 'auto'");
			if($rs){
				echo "配置成功，请打开指定触发页面开始";exit;
			}else{
				echo "配置失败";exit;
			}
		}

}