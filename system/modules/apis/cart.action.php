<?php
defined ('G_IN_SYSTEM') or exit ( 'No permission resources.' );
System::load_app_class ( 'base', 'member', 'no' );
System::load_app_class('response','apis','no');
System::load_app_fun ( 'user', 'go' );
session_start();
class cart extends base 
{
	private $Cartlist;
	private $Cartlist_jf;
	public function __construct() {
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
		$this->Cartlist = $_SESSION['Cartlist'];
		$this->Cartlist_jf = $_SESSION['Cartlist_jf'];
		$this->db = System::load_sys_class("model");
  
	}
  
  
	/*
	 *购物车商品列表
	 */
	public function cartlist() 
	{
		$Mcartlist = json_decode ( stripslashes ( $this->Cartlist ), true );
		  
		$shopids = '';
		if (is_array ( $Mcartlist )) {
			foreach ( $Mcartlist as $key => $val ) {
				$shopids .= intval ( $key ) . ',';
			}
			$shopids = str_replace ( ',0', '', $shopids );
			$shopids = trim ( $shopids, ',' );
		}
		  
		$shoplist = array ();
		if ($shopids != NULL) {
			$shoparr = $this->db->GetList ( "SELECT * FROM `@#_shoplist` where `id` in($shopids)", array ("key" => "id" ) );}
		if (! empty ( $shoparr )) {
			foreach ( $shoparr as $key => $val ) {
				if ($val ['q_end_time'] == '' || $val ['q_end_time'] == NULL) {
					$shoplist [$key] = $val;
					$Mcartlist [$val ['id']] ['num'] = $Mcartlist [$val ['id']] ['num'];
					$Mcartlist [$val ['id']] ['shenyu'] = $val ['shenyurenshu'];
					$Mcartlist [$val ['id']] ['money'] = $val ['yunjiage'];
					$Mcartlist [$val ['id']] ['sun'] = $val ['yunjiage']*$Mcartlist [$val ['id']] ['num'];
				}
			}
		}
		  
		$MoenyCount = 0;
		if (count ( $shoplist ) >= 1) {
			foreach ( $Mcartlist as $key => $val ) {
				$key = intval ( $key );
				if (isset ( $shoplist [$key] )) {
					$shoplist [$key] ['cart_gorenci'] = $val ['num'] ? $val ['num'] : 1;
					$MoenyCount += $shoplist [$key] ['yunjiage'] * $shoplist [$key] ['cart_gorenci'];
					$shoplist [$key] ['cart_xiaoji'] = substr ( sprintf ( "%.3f", $shoplist [$key] ['yunjiage'] * $val ['num'] ), 0, - 1 );
					$Cartshopinfo[$key]['shenyu'] = = $shoplist [$key] ['zongrenshu'] - $shoplist [$key] ['canyurenshu'];
					$Cartshopinfo[$key]['num'] = $val ['num'];
					$Cartshopinfo[$key]['money'] = $shoplist [$key] ['yunjiage'];
					
				}
			}
		}
		  
		$shop = 0;
		  
		if (! empty ( $shoplist )) {
			$shop = 1;
		}
		);
		$Cartshopinfo['MoenyCount'] = substr ( sprintf ( "%.3f", $MoenyCount ), 0, - 1 );
		$data = compact($Mcartlist,$Cartshopinfo);
		if($data){
			response::show(2000,'获取信息成功',$data);
		}else{
			response::show(2004,'获取信息失败');
		}
		
	}
	/*
	 *购物车商品列表 积分
	 */
	public function jf_cartlist()
	{
		$Mcartlist=json_decode(stripslashes($this->Cartlist_jf),true);
		$shopids='';
		if(is_array($Mcartlist)){
			foreach($Mcartlist as $key => $val){
				$shopids.=intval($key).',';
			}
			$shopids=str_replace(',0','',$shopids);
			$shopids=trim($shopids,',');

		}
		$shoplist=array();
		if($shopids!=NULL){
			$shoparr=$this->db->GetList("SELECT * FROM `@#_jf_shoplist` where `id` in($shopids)",array("key"=>"id"));
		}
		if(!empty($shoparr)){
		  foreach($shoparr as $key=>$val){
		    if($val['q_end_time']=='' || $val['q_end_time']==NULL){
			   $shoplist[$key]=$val;
			   $Mcartlist[$val['id']]['num']=$Mcartlist[$val['id']]['num'];
			   $Mcartlist[$val['id']]['shenyu']=$val['shenyurenshu'];
			   $Mcartlist[$val['id']]['money']=$val['yunjiage'];
			}
		  }
		}

		$MoenyCount=0;
		$Cartshopinfo='{';
		if(count($shoplist)>=1){
			foreach($Mcartlist as $key => $val){
					$key=intval($key);
					if(isset($shoplist[$key])){
						$shoplist[$key]['cart_gorenci']=$val['num'] ? $val['num'] : 1;
						$MoenyCount+=$shoplist[$key]['yunjiage']*$shoplist[$key]['cart_gorenci'];
						$shoplist[$key]['cart_xiaoji']=substr(sprintf("%.3f",$shoplist[$key]['yunjiage']*$val['num']),0,-1);
						$Cartshopinfo[$key]['shenyu'] = $shoplist[$key]['zongrenshu']-$shoplist[$key]['canyurenshu'];
						$Cartshopinfo[$key]['num'] = $val['num'];
						$Cartshopinfo[$key]['money'] = $shoplist[$key]['yunjiage'];
					}
			}
		}

		$shop=0;

		if(!empty($shoplist)){
		   $shop=1;
		}
		$Cartshopinfo['MoenyCount']=substr(sprintf("%.3f",$MoenyCount),0,-1);
		$data = compact($Mcartlist,$Cartshopinfo);
		if($data){
			response::show(2000,'获取信息成功',$data);
		}else{
			response::show(2004,'获取信息失败');
		}
	}
	  
	/*
	 *支付界面
	 */
	public function pay() 
	{
		if(empty($_POST['uid']) || empty($_POST['token'])){
			response::show(2001,'缺少参数');
		}  
		$Mcartlist = json_decode ( stripslashes ( $this->Cartlist ), true );
		$shopids = '';
		if (is_array ( $Mcartlist )) {
			foreach ( $Mcartlist as $key => $val ) {
				$shopids .= intval ( $key ) . ',';
			}
			$shopids = str_replace ( ',0', '', $shopids );
			$shopids = trim ( $shopids, ',' );
		
		}
		  
		$shoplist = array ();
		if ($shopids != NULL) {
			$shoplist = $this->db->GetList ( "SELECT * FROM `@#_shoplist` where `id` in($shopids)", array ("key" => "id") );
		}
		$MoenyCount = 0;
		if (count ( $shoplist ) >= 1) {
			foreach ( $Mcartlist as $key => $val ) {
				$key = intval ( $key );
				if (isset ( $shoplist [$key] )) {
					$shoplist [$key] ['cart_gorenci'] = $val ['num'] ? $val ['num'] : 1;
					$MoenyCount += $shoplist [$key] ['yunjiage'] * $shoplist [$key] ['cart_gorenci'];
					$shoplist [$key] ['cart_xiaoji'] = substr ( sprintf ( "%.3f", $shoplist [$key] ['yunjiage'] * $val ['num'] ), 0, - 1 );
					$shoplist [$key] ['cart_shenyu'] = $shoplist [$key] ['zongrenshu'] - $shoplist [$key] ['canyurenshu'];
				}
			}
		} else {
			$_SESSION( 'Cartlist', NULL );
			response::show(2003,'没有商品');
		}
		  
		// 总支付价格
		$MoenyCount = substr ( sprintf ( "%.3f", $MoenyCount ), 0, - 1 );
		$member = $this->db->GetOne ( "select * from `@#_member` where `uid` = '"$uid"' " );
		// 会员余额
		$Money = $member ['money'];
		// 商品数量
	 	$shoplen = count ( $shoplist );
		  
		$fufen = System::load_app_config ( "user_fufen", '', 'member' );
		if ($fufen ['fufen_yuan']) {
			$fufen_dikou = intval ( $member ['score'] / $fufen ['fufen_yuan'] );
		} else {
			$fufen_dikou = 0;
		}
		$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1' AND pay_mobile = 1");
		
		$_SESSION ['submitcode'] = $submitcode = uniqid ();
		$data = array();
		$data = array(
			'shoplist'=>$shoplist,
			'money'=>$Money,
			'moneycount'=>$MoneyCount,
			'shoplen'=>$shoplen,
			'fufen'=>$fufen_dikou,
			'submitcode'=>$submitcode
			);
		if (!empty($data)) {
			response::show(2000,'获取信息成功',$data);
		}else{
			response::show(2004,'获取信息失败');
		}
	}
	  
	//支付界面
	/*public function jf_pay(){
        $webname=$this->_cfg['web_name'];
		parent::__construct();
		if(!$member=$this->userinfo){
		  header("location: ".WEB_PATH."/mobile/user/login");
		}
		$Mcartlist=json_decode(stripslashes($this->Cartlist_jf),true);
		$shopids='';
		if(is_array($Mcartlist)){
			foreach($Mcartlist as $key => $val){
				$shopids.=intval($key).',';
			}
			$shopids=str_replace(',0','',$shopids);
			$shopids=trim($shopids,',');

		}

		$shoplist=array();
		if($shopids!=NULL){
			$shoplist=$this->db->GetList("SELECT * FROM `@#_jf_shoplist` where `id` in($shopids)",array("key"=>"id"));
		}
		$MoenyCount=0;
		if(count($shoplist)>=1){
			foreach($Mcartlist as $key => $val){
					$key=intval($key);
					if(isset($shoplist[$key])){
						$shoplist[$key]['cart_gorenci']=$val['num'] ? $val['num'] : 1;
						$MoenyCount+=$shoplist[$key]['yunjiage']*$shoplist[$key]['cart_gorenci'];
						$shoplist[$key]['cart_xiaoji']=substr(sprintf("%.3f",$shoplist[$key]['yunjiage']*$val['num']),0,-1);
						$shoplist[$key]['cart_shenyu']=$shoplist[$key]['zongrenshu']-$shoplist[$key]['canyurenshu'];
					}
			}
			$shopnum=0;  //表示有商品
		}else{
			_setcookie('Cartlist_jf',NULL);
			//_message("购物车没有商品!",WEB_PATH);
			$shopnum=1; //表示没有商品
		}

		//总支付价格
		$MoenyCount=substr(sprintf("%.3f",$MoenyCount),0,-1);
		//会员余额
		$Money=$member['money'];
		//商品数量
		$shoplen=count($shoplist);

		$fufen = System::load_app_config("user_fufen",'','member');
		if($fufen['fufen_yuan']){
			$fufen_dikou = intval($member['score'] / $fufen['fufen_yuan']);
		}else{
			$fufen_dikou = 0;
		}
		$paylist = $this->db->GetList("select * from `@#_pay` where `pay_start` = '1'");

		session_start();
		$_SESSION['submitcode'] = $submitcode = uniqid();
		include templates("mobile/cart","jf_payment");
	}*/
	  
	/*
	 *确认支付
	 */
	public function paysubmit() 
	{
		header ( "Cache-control: private" );
		parent::__construct ();
		if(empty($_POST['checkpay']) || empty($_POST['banktype']) || empty($_POST['money']) || empty($_POST['uid']) || empty($_POST['submitcode'])){
			response::show(2001,'缺少参数');
		}

		$checkpay = $_POST['checkpay']; // 获取支付方式 fufen money bank
		$banktype = $_POST['banktype']; // 获取选择的银行 CMBCHINA ICBC CCB
		$money = $_POST['money']; // 获取需支付金额
		$fufen = isset($_POST['fufen'])?$_POST['fufen']:0; // 获取积分
		$uid = $_POST['uid'];
		$submitcode1 = $_POST['submitcode']; // 获取SESSION
		    
		if (isset ( $_SESSION ['submitcode'] )) {
			$submitcode2 = $_SESSION ['submitcode'];
		} else {
			$submitcode2 = null;
		}
		if ($submitcode1 == $submitcode2) {
			unset ( $_SESSION ["submitcode"] );
		} else {
			response::show(2003,'请不要重复提交');
		}
		
		$zhifutype = $this->db->GetOne ( "select * from `@#_pay` where `pay_class` = 'alipay' " );
		if (! $zhifutype) {
			response::show(2003,'手机支付只支持易宝,请联系站长开通！');
		}
		  
		$pay_checkbox = false;
		$pay_type_bank = false;
		$pay_type_id = false;
		  
		if ($checkpay == 'money') {
			$pay_checkbox = true;
		}
		  
		if ($banktype != 'nobank') {
			$pay_type_id = $banktype;
		}
		  
		if (! empty ( $zhifutype )) {
			$pay_type_bank = $zhifutype ['pay_class'];
		}else{
			response::show(2003,'不支持该种支付方式');
		}
		  
		 
		if (! $pay_type_id) {
			if ($checkpay != 'fufen' && $checkpay != 'money')
				response::show(2003,'选择支付方式');
		}
		  
		$pay=System::load_app_class('pay','pay');
		$pay->fufen = $checkpay=='fufen'?$fufen:0;
		$pay->pay_type_bank = $pay_type_bank;
		$ok = $pay->init($uid,$pay_type_id,'go_record');	//云购商品
		if($ok != 'ok'){
			$_SESSION('Cartlist',NULL);
			response::show(2003,'购物车没有商品');
		}
		  
		$check = $pay->go_pay ( $pay_checkbox );
		if (! $check) {
			response::show(2003,'订单添加失败');
		}
		if ($check) {
			response::show(2000,'支付成功');
		} else {
			response::show(2004,'支付失败');
		}
	}
	  
	
	
	  
	/*
	 *充值
	 */
	public function addmoney() 
	{
		parent::__construct ();
		if(empty($_POST['money']) || empty($_POST['pay_id']) || empty($_POST['uid'])){
			response::show(2001,'缺少参数');
		}
		$money = intval($_POST['money']); // 获取充值金额
		$pay_id = $_POST['pay_id']; // 获取选择的支付方式
 
		$payment = $this->db->GetOne ( "select * from `@#_pay` where `pay_id` = ".$pay_id );
	  
		if (! $payment) {
			response::show(2002,'对不起，没有您所选择的支付方式！');
		}
		  
		if (! empty ( $payment )) {
			$pay_type_bank = $payment ['pay_class'];
		}
		$pay_type_id = $pay_id;
		$uid = $_POST['uid'];
		$pay = System::load_app_class ( 'pay', 'pay' );
		$pay->pay_type_bank = $pay_type_bank;
		$ok = $pay->init ( $uid, $pay_type_id, 'addmoney_record', $money );
  
		if ($ok === 'not_pay') {
			response::show(2002,'未选择支付平台');
		}else{
			response::show(2000,'充值成功');
		}
	}
}
