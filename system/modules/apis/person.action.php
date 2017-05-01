<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_class('response','apis','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
session_start();
class person extends base {
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
		/*if($_SESSION['user'.$uid] != $_POST['token']){
			response::show(2003,'token不匹配');
		}*/
		$this->db = System::load_sys_class('model');		
	}

	/*
	 *我的云购记录
	 */
	public function getUserBuyList()
	{
		// $_POST = ['page'=>1,'pagesize'=>3,'state'=>'-1'];
		if(empty($_POST['page']) || empty($_POST['pagesize']) || empty($_POST['state'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];
		$state=safe_replace($_POST['state']);
		$uid = $this->uid;
	   if($state==-1){
	     //参与云购的商品 全部...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid ");


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}elseif($state==1){
		  //参与云购的商品 进行中...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is null GROUP BY shopid  " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}else{
		  //参与云购的商品 已揭晓...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is not null GROUP BY shopid " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is not null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}

		if(!empty($shoplistall['listItems'])){
		   	$shoplistall['code']=0;
		   	$shoplistall['count']=count($shoplistall['listItems']);

		   	foreach($shoplistall['listItems'] as $key=>$val){

			  	$shoplistall['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
			  	$shoplistall['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
			  	$shoplistall['listItems'][$key]['q_end_times']=$val['q_end_time'];


			 	if($val['q_end_time']!=''){
				   	//商品已揭晓
				    $shoplistall['listItems'][$key]['codeState']=3;
					continue;

			 	}elseif($val['shenyurenshu']==0){
				 	//商品购买次数已满
				   	$shoplistall['listItems'][$key]['codeState']=2;
				    continue;
			 	}else{
				 	//进行中
				    $shoplistall['listItems'][$key]['codeState']=1;

			 	}
		   	}
		}else{
		  $shoplistall['code']=1;
		}
        $shoplistall['count']=count($shoplist);

		if($shoplistall['listItems']){
			response::show(2000,'获取云购记录成功',$shoplistall['listItems']);
		}else{
			response::show(2004,'没有云购记录');
		}
	}

	/*
	 *我的云购记录
	 */
	public function getUserBuyList_jf()
	{
		if(empty($_POST['page']) || empty($_POST['pagesize']) || empty($_POST['state'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];
		$state=safe_replace($_POST['state']);

	   if($state==-1){
	     //参与云购的商品 全部...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid ");


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}elseif($state==1){
		  //参与云购的商品 进行中...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is null GROUP BY shopid  " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}else{
		  //参与云购云购的商品 已揭晓...
		  $shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is not null GROUP BY shopid " );


		  $shoplistall['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_jf_record` a left join `@#_jf_shoplist` b on a.shopid=b.id where a.uid='$uid' and b.q_end_time is not null GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );
		}

		if(!empty($shoplistall['listItems'])){
		   $shoplistall['code']=0;
		   $shoplistall['count']=count($shoplistall['listItems']);

		   foreach($shoplistall['listItems'] as $key=>$val){

			  	$shoplistall['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
			  	$shoplistall['listItems'][$key]['q_end_time']=microt($val['q_end_time']);


			 	if($val['q_end_time']!=''){
			   		//商品已揭晓
			    	$shoplistall['listItems'][$key]['codeState']=3;
					continue;

			 	}elseif($val['shenyurenshu']==0){
			 		//商品购买次数已满
			   		$shoplistall['listItems'][$key]['codeState']=2;
			   	 	continue;
			 	}else{
			 		//进行中
			    	$shoplistall['listItems'][$key]['codeState']=1;

			 	}
		   }
		}else{
		  $shoplistall['code']=1;
		}
        $shoplistall['count']=count($shoplist);

		if($shoplistall){
			response::show(2000,'获取云购记录成功',$shoplistall);
		}else{
			response::show(2004,'没有云购记录');
		}

	}

	/*
	 *获取用户所有获得的商品
	 */
	public function getUserOrderList()
	{
		// $_POST = ['page'=>1,'pagesize'=>3];
		if(empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];

	   	$order=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$uid' " );

	   	$orderlist['listItems']=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$uid' and a.huode!=0 order by a.time desc limit $FIdx,$EIdx " );

		if(empty($orderlist['listItems'])){
		  $orderlist['code']=1;
		}else{
			foreach($orderlist['listItems'] as $key=>$val){
	        	$orderlist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
	    	}
		   	$orderlist['code']=0;

		}
		$orderlist['count']=count($order);

	  	if($orderlist['listItems']){
			response::show(2000,'获取定单记录成功',$orderlist['listItems']);
		}else{
			response::show(2004,'没有定单记录');
		}
	}

	/*
	 *获取已晒单
	 */
	public function getUserPostList()
	{
		// $_POST = ['page'=>1,'pagesize'=>3];
		if(empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];

	   	$post=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' order by a.sd_time desc" );

	   	$postlist['listItems']=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' order by a.sd_time desc limit $FIdx,$EIdx" );

		if(empty($postlist['listItems'])){
		  	$postlist['code']=1;
		}else{

		  	foreach($postlist['listItems'] as $key=>$val){
	        	$postlist['listItems'][$key]['sd_time']=date('Y-m-d H:i',$val['sd_time']);
	      	}

		   	$postlist['code']=0;
		}
		$postlist['postCount']=count($post);

	  	if($postlist['listItems']){
			response::show(2000,'获取已晒单记录成功',$postlist['listItems']);
		}else{
			response::show(2004,'没有已晒单记录');
		}
	}

	/*
	 *获取未晒单
	 */
	public function getUserUnPostList()
	{
		// $_POST = ['page'=>1,'pagesize'=>3];
		if(empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];

	    //获得的商品
	    $orderlist=$this->db->GetList("select * from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where b.q_uid='$uid' order by a.time desc" );

		//获取晒单
		$postlist=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' order by a.sd_time desc" );
		$huoid='';

		$sd_id = $r_id = array();
		foreach($postlist as $sd){
			$sd_id[]=$sd['sd_shopid'];
		}

		foreach($orderlist as $rd){
			if(!in_array($rd['shopid'],$sd_id)){
				$r_id[]=$rd['shopid'];
			}
		}
		if(!empty($r_id)){
			$rd_id=implode(",",$r_id);
			$rd_id = trim($rd_id,',');
		}else{
			$rd_id="0";
		}

		//未晒单
	   	$unpost=$this->db->GetList("select * from  `@#_shoplist`  where id in($rd_id) order by id" );

	   	$unpostlist['listItems']=$this->db->GetList("select * from  `@#_shoplist`  where id in($rd_id) order by id limit  $FIdx, $EIdx" );

		if(empty($unpostlist['listItems'])){
		   $unpostlist['code']=1;
		}else{
		  foreach($unpostlist['listItems'] as $key=>$val){
	        $unpostlist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
	      }
		   $unpostlist['code']=0;
		}
	    $unpostlist['unPostCount']=count($unpost);

	  	if($unpostlist['listItems']){
			response::show(2000,'获取未晒单记录成功',$unpostlist['listItems']);
		}else{
			response::show(2004,'没有未晒单记录');
		}

	}

	/*
	 *充值明细
	 */
	public function getUserRecharge()
	{
		// $_POST = ['page'=>1,'pagesize'=>3];
		if(empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];

	    $Rechargelist=$this->db->GetList("select * from `@#_member_account` where `uid`='$uid' and `pay` = '账户' and `type`='1'  ORDER BY time DESC");

	    $Recharge['listItems']=$this->db->GetList("select * from `@#_member_account` where `uid`='$uid' and `pay` = '账户' and `type`='1'  ORDER BY time DESC limit $FIdx,$EIdx ");

        if(empty($Recharge['listItems'])){
		    $Recharge['code']=1;
		}else{
		  foreach($Recharge['listItems'] as $key=>$val){
		    $Recharge['listItems'][$key]['time']=date("Y-m-d H:i:s",$val['time']);
		  }
		    $Recharge['code']=0;
		}
 		$Recharge['count']=count($Rechargelist);
		if($Recharge['listItems']){
			response::show(2000,'获取充值记录成功',$Recharge['listItems']);
		}else{
			response::show(2004,'没有充值记录');
		}

	}

	/*
	 *消费明细
	 */
	public function getUserConsumption()
	{ 
		$_POST = ['page'=>1,'pagesize'=>3];
		if(empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
	   	$EIdx=$_POST['pagesize'];
	   	$Consumptionlist=$this->db->GetList("select * from `@#_member_account` where `uid`='$uid' and `pay` = '账户' and `type`='-1' ");
	   	$Consumption['listItems']=$this->db->GetList("select * from `@#_member_account` where `uid`='$uid' and `pay` = '账户' and `type`='-1'  ORDER BY time DESC limit $FIdx,$EIdx ");
        if(empty($Consumption['listItems'])){
		    $Consumption['code']=1;
		}else{

			foreach($Consumption['listItems'] as $key=>$val){
		    	$Consumption['listItems'][$key]['time']=date("Y-m-d H:i:s",$val['time']);
		  	}
		    $Consumption['code']=0;
		}
 		$Consumption['count']=count($Consumptionlist);

		if($Consumption['listItems']){
			response::show(2000,'获取消费记录成功',$Consumption['listItems']);
		}else{
			response::show(2004,'没有消费记录');
		}
	}
}
