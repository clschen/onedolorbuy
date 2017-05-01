<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_fun('global',G_ADMIN_DIR);
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_app_class("base","member","no");
System::load_sys_fun('user');
class shua extends base {
	private $db;
	private $categorys;
	private $pay;
	private $autodir = "auto";#模块文件名
	public function __construct(){	
		$this->db = System::load_sys_class("model");
		$this->categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));		
		$this->pay = System::load_app_class("pay","pay");
	}


		public function shua(){
			$data  = $this->db->GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE  `cfg_name` = 'auto'  LIMIT 1");
			$data = unserialize($data['cfg_value']);
			$t1= $data['maxtime'];
			$t2= $data['mintime'];
			include templates("index","shaidan123");
		}
		//购买商品
		public function buyshop($id,$shopinfo,$member){
			//购买商品数量
			$shopnum = rand(1,5);
			$user_id = $member['uid'];
			$shopid = $shopinfo['id'];
			$time = time();
			//判断商品是否购买完
			if($shopinfo['zongrenshu'] > $shopinfo['canyurenshu']){
				if((intval($shopinfo['yunjiage'])*$shopnum) > $member['money']){//商品价格大于用户金钱---给用户充值
					$m = intval($shopinfo['yunjiage'])*$shopnum+5;
					$this->db->Query(" UPDATE `@#_member` SET  `money` = '$m' WHERE `uid` = '$user_id' ");
				}
				//设置IP
				$_SERVER['HTTP_CLIENT_IP'] = $this->randip($member);
				// 查询剩余可购买人数
				$shengyu = $shopinfo['zongrenshu']-$shopinfo['canyurenshu'];
				if($shopnum>=$shengyu){
					$shopnum=$shengyu;
				}
				//调用购买商品接口
				$rs  = $this->pay->pay_user_go_shop($user_id,$shopid,$shopnum);
			}else{#如果已经购买完，就删除配置
				$data  = $this->db->GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE  `cfg_name` = 'auto'  LIMIT 1");
				$data = unserialize($data['cfg_value']);
				$shopidarray = explode('-',$data['shopid']);
				if(count($shopidarray) == 1){
					$data['shopid'] = '';
				}else{
					//如果存在在数组总就删除并从新组成字符串
					foreach($shopidarray as $k=>$v)
					{
					    if ($v== $id)
					     unset($shopidarray[$k]);
					}

					$data['shopid'] = implode('-',$shopidarray);
				}
				
				$autoadd = intval($data['autoadd']);
				#判断是否进入下一期数
				if($autoadd == 1){
					#需要进入下一期 #添加下一期的商品ID值
					$shoptem  = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$shopid'  LIMIT 1");
					$nextshopsid = $shoptem['sid'];
					$nextshopinfo  = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `sid` = '$nextshopsid' ORDER BY  `qishu` DESC LIMIT 1");
					if($nextshopinfo['qishu'] < $nextshopinfo['maxqishu']){
					if($data['shopid'] == ""){
						$data['shopid'] = $nextshopinfo['id'];
					}else{
						$data['shopid'] = $data['shopid'].'-'.$nextshopinfo['id'];
						}
					}
					// 最后存储到数据库
					$temp = serialize($data);
					$rs = $this->db->Query("UPDATE `@#_wxch_cfg` SET `cfg_value` = '$temp' WHERE `cfg_name` = 'auto'");
					if(!$rs){
						echo '进入下一期并失败！';exit;
					}

				}
			}
		}

		#线程主体

		public function xcaction(){
			set_time_limit(0);
			$data  = $this->db->GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE  `cfg_name` = 'auto'  LIMIT 1");
			$data = unserialize($data['cfg_value']);
			if($data['on']==0){
				echo '刷单功能暂未开启，请点击后台开启后在开始刷单哦！';
				exit;
			}
			$t = -1;
			$timeperiod_arr = explode("-",$data['timeperiod']);
			$tp_tmp = -1; #时间判断
			foreach($timeperiod_arr as $k=>$v){
				if(intval($v) == date("G")){
					$tp_tmp = 1;
					break;
				}
			}
			// $times = intval($data['mintime']);#最小间隔时间
			// $endtimes =  intval($data['maxtime']);#最大间隔时间
			// sleep(rand($times,$endtimes));
			
			if($tp_tmp == 1){
				#生成一个用户  $user_id
				$user_id = rand(intval($data['uf' ]),intval($data['ul' ]));
				#查询用户是否是批量注册的用户
				$member = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid` = '$user_id' and `auto_user` = '1' LIMIT 1");
				if(is_array($member)){
					#是否购买多个商品
					$mshop = intval($data['mshop']);
					if($mshop == 1){
						#是购买多个商品#生成商品ID数组
						$shopid = $this->getshopid($data['shopid']);
						for($i=0;$i<count($shopid);$i++){
							$id = $shopid[$i];
							#查询商品信息
							$shopinfo = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$id' LIMIT 1");
							$this->buyshop($id,$shopinfo,$member);
						}
					}else{
						$shopid = $this->getshopid($data['shopid'],0);
						$id = $shopid[0];
						$shopinfo = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id` = '$id' LIMIT 1");
						$this->buyshop($id,$shopinfo,$member);
					}
				}else{
					echo '所选用户不是批量注册用户';
				}
			}else{
				echo '目前不在刷单时间区间';
			}

		}
		/*
			获取商品id
			返回商品id一维数组
		*/
		public function getshopid($shopids,$mshop=1){
			$shopidarray = explode("-",$shopids);#配置文件商品ID    数组
			$shopid = array();
			#生成商品ID数组 #随机生成购买商品个数  多少个不同商品
			$shopnum = rand(0,count($shopidarray)-1);
			if($mshop == 0){
				$shopid[] = $shopidarray["$shopnum"];
			}else{	
				$j= 5;
				if(count($shopidarray)>50){
					$j= 10;
				}elseif(count($shopidarray)<5){
					$j=1;
				}elseif(count($shopidarray)<20){
					$j = 3;
				}elseif(count($shopidarray)<50){
					$j=6;
				}
				for($i=0;$i< $j;$i++){
					$rand = rand(0,count($shopidarray)-1);
					$tm = $shopidarray["$rand"];
					if(!in_array($tm,$shopid)){
						$shopid[] = $tm;
					}
				}
			}
			return $shopid;
		}
		
		#随机生成IP 中国区
		public function randip($member){
			if($member['user_ip']){
				$ip = explode(',',$member['user_ip']); 
				return $ip[1];
			}else{
				$ip_1 = -1;
				$ip_2 = -1;
				$ip_3 = rand(0,255);
				$ip_4 = rand(0,255);
				$ipall = array(
				array(array(58,14),array(58,25)),
				array(array(58,30),array(58,63)),
				array(array(58,66),array(58,67)),
				array(array(60,200),array(60,204)),
				array(array(60,160),array(60,191)),
				array(array(60,208),array(60,223)),
				array(array(117,48),array(117,51)),
				array(array(117,57),array(117,57)),
				array(array(121,8),array(121,29)),
				array(array(121,192),array(121,199)),
				array(array(123,144),array(123,149)),
				array(array(124,112),array(124,119)),
				array(array(125,64),array(125,98)),
				array(array(222,128),array(222,143)),
				array(array(222,160),array(222,163)),
				array(array(220,248),array(220,252)),
				array(array(211,163),array(211,163)),
				array(array(210,21),array(210,22)),
				array(array(125,32),array(125,47))		
				);
				$ip_p = rand(0,count($ipall)-1);#随机生成需要IP段
				$ip_1 = $ipall[$ip_p][0][0];
				if($ipall[$ip_p][0][1] == $ipall[$ip_p][1][1]){
					$ip_2 = $ipall[$ip_p][0][1];
				}else{
					$ip_2 = rand(intval($ipall[$ip_p][0][1]),intval($ipall[$ip_p][1][1]));
				}
				return $ip_1.'.'.$ip_2.'.'.$ip_3.'.'.$ip_4;
			}
		}

			

}
