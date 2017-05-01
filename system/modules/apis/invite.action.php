<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_class('response','apis','no');
System::load_app_class('QRcode','apis','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
session_start();
class invite extends base {
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
        }  */  	
		$this->db = System::load_sys_class('model');
	}
    /*
     *我的朋友的参与情况
     */
    public function friends()
    {   $uid = $this->uid;
        $mysql_model=System::load_sys_class('model');
        $notinvolvednum = 0;  //未参加云购的人数
        $involvednum = 0;     //参加预购的人数
        $involvedtotal = 0;   //邀请人数

        //查询邀请好友信息
        $invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$uid' ORDER BY `time` DESC");
        $involvedtotal=count($invifriends);

        for($i=0;$i<count($invifriends);$i++){
            $sqluid=$invifriends[$i]['uid'];
            $sqname=get_user_name($invifriends[$i]);
            $invifriends[$i]['sqlname']=	 $sqname;

            //查询邀请好友的消费明细
            $accounts[$sqluid]=$mysql_model->GetList("select * from `@#_member_account` where `uid`='$sqluid'  ORDER BY `time` DESC");

            //判断哪个好友有消费
            if(empty($accounts[$sqluid])){
                $notinvolvednum +=1;
                $records[$sqluid]='未参与云购';
            }else{
                $involvednum +=1;
                $records[$sqluid]='已参与云购';
            }
        }

        $data['invifriends'] = $invifriends;
        $data['notinvolvednum'] = $notinvolvednum;
        $data['involvednum'] = $involvednum;
        $data['involvedtotal'] = $involvedtotal;
        if($data){
            response::show(2000,'获取消息成功',$data);
        }else{
            response::show(2004,'获取消息失败');
        }
    }

    /*
     *转账
     */
	public function usertransfer()
    {
        if(empty($_POST['money']) || empty($_POST['txtBankName'])){
            response::show(2001,'缺少参数');
        }
		$tmoney=$_POST['money'];
        $tuser=$_POST['txtBankName'];
        $member = $this->db->GetOne("select * from `@#_member` where `uid`='$uid'");
        if($member['score']<1000){
            response::show(2002,'帐户云积分不得小与1000');
        }
        if($_POST['money']<1000){
            response::show(2002,'转帐云积分不得小于1000');
        }
        if(empty($tmoney)||empty($tuser)){
            response::show(2002,'转入用户和金额不得为空');
        }
        if($tmoney>$member['score']){
            response::show(2002,'转入云积分不得大于帐户云积分');
        }
        $user= $this->db->GetOne("SELECT * FROM `@#_member` where `email` = '$tuser' limit 1");    
        if(empty($user)){
            $user= $this->db->GetOne("SELECT * FROM `@#_member` where `mobile` = '$tuser' limit 1");    
        }
        if(empty($user)){
            response::show(2003,'转入用户不存在');
        }
        $uid=$member['uid'];
        $tuid=$user['uid'];
        if($uid==$tuid){
            response::show(2003,'不能给自己转帐');
        }
        $time=time();
        $cmoney=$member['score']-$tmoney;
        $ctmoney=$user['score']+$tmoney;
        $name=get_user_name($uid,'username','all');
        $tname=get_user_name($tuid,'username','all');
        $this->db->Autocommit_start();
        $up_q1 = $this->db->Query("update `@#_member` SET `score`='$cmoney' WHERE `uid`='$uid'");
        $up_q2 = $this->db->Query("update `@#_member` SET `score`='$ctmoney' WHERE `uid`='$tuid'");
        $up_q3 = $this->db->Query("insert into `@#_member_op_record` (`uid`,`username`,`deltamoney`,`premoney`,`money`,`time`) values ('$uid','$name','-$tmoney','$member[money]','$cmoney','$time')"); 
        $up_q4 = $this->db->Query("insert into `@#_member_op_record` (`uid`,`username`,`deltamoney`,`premoney`,`money`,`time`) values ('$tuid','$tname','$tmoney','$user[money]','$ctmoney','$time')");
        $up_q5 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$uid', '1', '账户', '转出到<$tname>', '$tmoney', '$time')");
        $up_q6 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$tuid', '1', '账户', '由<$name>转入', '$tmoney', '$time')"); 
        if($up_q1 && $up_q2 && $up_q3 && $up_q4 && $up_q5 && $up_q6){
                $this->db->Autocommit_commit();
                $info= $this->db->GetOne("SELECT `money` FROM `@#_member` where  `uid` = $uid");
                response::show(2000,'转账成功',$info);
            }else{
                $this->db->Autocommit_rollback();
                $this->error = true;
                response::show(2004,'转账失败');
            }
        response::show(2000,'给'.$tname."的".$tmoney."云积分冲值成功!");       
    }

    /*
     *佣金明细
     */
    function cashout()
    {   
        $uid = $this->uid;
        $mysql_model=System::load_sys_class('model');
        $total=0;
        $shourutotal=0;
        $zhichutotal=0;
        $cashoutdjtotal=0;
        $cashouthdtotal=0;
        //查询邀请好友id
        $invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$uid' ORDER BY `time` DESC");

        //查询佣金收入
        for($i=0;$i<count($invifriends);$i++){
            $sqluid=$invifriends[$i]['uid'];
            //查询邀请好友给我反馈的佣金
            $recodes[$sqluid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$sqluid' and `type`=1 ORDER BY `time` DESC");
        }

        //查询佣金消费(提现,充值)
        $zhichu=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$uid' and `type`!=1 ORDER BY `time` DESC");

        //查询被冻结金额
        $cashoutdj=$mysql_model->GetOne("select SUM(money) as summoney  from `@#_member_cashout` where `uid`='$uid' and `auditstatus`!='1' ORDER BY `time` DESC");

        if(!empty($recodes)){
            foreach($recodes as $key=>$val){
                foreach($val as $key2=>$val2){
                    $shourutotal+=$val2['money'];	 //总佣金收入
                }
            }
        }
        if(!empty($zhichu)){
            foreach($zhichu as $key=>$val3){
                $zhichutotal+=$val3['money'];	//总支出的佣金
            }
        }

        $total=$shourutotal-$zhichutotal;  //计算佣金余额
        $cashoutdjtotal= empty($cashoutdj['summoney'])?'0':$cashoutdj['summoney'];  //冻结佣金余额
        $cashouthdtotal= $total-$cashoutdj['summoney'];  //活动佣金余额
        $data['total'] = (string)$total;
        $data['shourutotal'] = (string)$shourutotal;
        $data['zhichutotal'] = (string)$zhichutotal;
        $data['cashoutdjtotal'] = (string)$cashoutdjtotal;
        $data['cashouthdtotal'] = (string)$cashouthdtotal;
        if($data){
            response::show(2000,'获取消息成功',$data);
        }else{
            response::show(2004,'获取消息失败');
        }
    }
    /*
     *申请提现
     */
    public function withdraw()
    {
        /*$_POST=['money'=>'200',
        'txtUserName'=>'sd',
        'txtBankName'=>'sdd',
        'txtSubBank'=>'dsdf',
        'txtBankNo'=>'sd',
        'txtPhone'=>'123'];*/
        if(empty($_POST['money']) || empty($_POST['txtUserName']) || empty($_POST['txtBankName']) || empty($_POST['txtSubBank']) || empty($_POST['txtBankNo']) || empty($_POST['txtPhone'])){
            response::show(2001,'缺少参数');
        }
        $uid = $this->uid;

        $money      = abs(intval($_POST['money']));
        $username   =htmlspecialchars($_POST['txtUserName']);
        $bankname   =htmlspecialchars($_POST['txtBankName']);
        $branch     =htmlspecialchars($_POST['txtSubBank']);
        $banknumber =htmlspecialchars($_POST['txtBankNo']);
        $linkphone  =htmlspecialchars($_POST['txtPhone']);
        $time       =time();
        $type       = -3;  //收取1/消费-1/充值-2/提现-3
        $mem=$this->db->GetOne("select * from `@#_member` where `uid`='$uid'");
        $total = $mem['money'];
        // var_dump($title);die;
        if($total<100){
            response::show(2002,'佣金金额大于100元才能提现！');
        }elseif($total<$money ){
            response::show(2002,'输入额超出总佣金金额！');
        }else{

            //插入提现申请表  这里不用在佣金表中插入记录 等后台审核才插入
            if($this->db->Query("INSERT INTO `@#_member_cashout`(`uid`,`money`,`username`,`bankname`,`branch`,`banknumber`,`linkphone`,`time`)VALUES
			('$uid','$money','$username','$bankname','$branch','$banknumber','$linkphone','$time')")){
                response::show(2000,'申请成功！请等待审核！');
            }else{
                response::show(2004,'申请失败！');
            }
        }
    }
    /*
     *账户充值
     */
    public function voucher()
    {
        $_POST['txtCZMoney'] = 1;
        if(empty($_POST['txtCZMoney'])){
            response::show(2001,'缺少参数');
        }
        $uid = $this->uid;
        $money      = abs(intval($_POST['txtCZMoney']));
        $type       = 1;
        $pay        ="佣金";
        $time       =time();
        $content    ="使用佣金充值到云购账户";

        if($money <= 0 ){
            response::show(2002,'佣金金额输入不正确！');
        }
        /*if($cashouthdtotal<$money){
           response::show(2002,'输入额超出活动佣金金额！');
        }*/

        //插入记录
        $account=$this->db->Query("INSERT INTO `@#_member_account`(`uid`,`type`,`pay`,`content`,`money`,`time`)VALUES
			('$uid','$type','$pay','$content','$money','$time')");
        $member=$this->db->GetOne("select * from `@#_member` where `uid`='$uid'");
        // 查询是否有该记录
        if($account){
            //修改剩余金额
            $leavemoney=$member['money']+$money;
            $mrecode=$this->db->Query("UPDATE `@#_member` SET `money`='$leavemoney' WHERE `uid`='$uid' ");
            //在佣金表中插入记录
            $recode=$this->db->Query("INSERT INTO `@#_member_recodes`(`uid`,`type`,`content`,`money`,`time`)VALUES
			('$uid','-2','$content','$money','$time')");

            response::show(2000,'充值成功！');
        }else{
            response::show(2004,'充值失败！');
        }
    }
    /*
     *获取提现记录
     */
    function record()
    {
        $mysql_model=System::load_sys_class('model');
        $uid = $this->uid;
        //查询提现记录
        //$recordarr=$mysql_model->GetList("select * from `@#_member_recodes` a left join `@#_member_cashout` b on a.cashoutid=b.id where a.`uid`='$uid' and a.`type`='-3' ORDER BY a.`time` DESC");

        $recordarr=$mysql_model->GetList("select * from  `@#_member_cashout`  where `uid`='$uid' ORDER BY `time` DESC limit 0,30");

        if(!empty($recordarr)){
            response::show(2000,'获取信息成功',$recordarr);
        }else{
            response::show(2004,'获取信息失败');
        }
    }
	
    /*
     *查看用户等级
     */
    public function level()
    {
        $mem = $this->db->GetOne("select * from `@#_member` where `uid`='$uid'");
        $memberdj=$this->db->GetList("select * from `@#_member_group`");
        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                   $member['yungoudj']=$val['name'];
                }
            }
        }
        if($member){
            response::show(2000,'获取信息成功',$member);
        }else{
            response::show(2004,'获取信息失败');
        }
        
    }
    /*
     *查看用户等级
     */
    public function mycode()
    {
        define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
        $uid = $this->uid;
        $uids = $uid*3;
        // 二维码数据 
        $data = '信息'; 
        $path = 'qrcode/';
        // 生成的文件名 
        $filename = BASE_PATH.$path.'onebuy'.$uids.'.png'; 
        // 纠错级别：L、M、Q、H 
        $errorCorrectionLevel = 'L';  
        // 点的大小：1到10 
        $matrixPointSize = 4;  
        //创建一个二维码文件 
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        //输入二维码到浏览器
        $paths = '/system/moludes/apis/';
        $url = G_WEB_PATH.$paths.$path.'onebuy'.$uids.'.png'; 
        if(true){
            response::show(2000,'获取信息成功',['code_url'=>$url]);
        }else{
            response::show(2004,'获取信息失败');
        }
        
    }
}
