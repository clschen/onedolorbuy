<?php
if(!isset($system_path) || !isset($statics_path)){
	$system_path = 'system';
	$statics_path = 'statics';
}

require_once(dirname(dirname(__FILE__)) . '/config/global.php');
//require_once(dirname(dirname(__FILE__)) . '/libs/mysql.class.php');
//require_once(dirname(dirname(__FILE__)) . '/libs/model.class.php');
$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
	$wechatObj->responseMsg();
}else{
	$wechatObj->valid();
}
final class mysql {

	/**
	 * 数据库配置信息
	 */
	private $config;

	/**
	 * 数据库连接资源句柄
	 */
	private $link;

	/**
	 *	最后一次查询的资源句柄
	 */
	public $lastresult;

	/**
	 *  统计数据库查询次数
	 */
	public $querycount = 0;

	/**
	 * 数据类实例
	 */
	static private $mysqlobj=array();

	private function __construct($configs){

		$this->config=$configs;
		$this->connect();
	}

	public function __destruct(){
		$this->close();
	}


	private function mysql($configs){
		$this->config=$configs;
		$this->connect();
	}

	private function __clone(){
	}

	private function connect(){

		$func = $this->config['pconnect'] == 1 ? 'mysql_pconnect' : 'mysql_connect';
		if(!$this->link = $func($this->config['hostname'], $this->config['username'], $this->config['password'], 1)) {
			$this->DisplayError('Can not Connect to MySQL server',"hook_mysql_install");
		}
		if($this->GetVersion(true) > '4.1') {
			$charset = isset($this->config['charset']) ? $this->config['charset'] : '';
			$serverset = $charset ? "character_set_connection='$charset',character_set_results='$charset',character_set_client=binary" : '';
			$serverset .= $this->GetVersion() > '5.0.1' ? ((empty($serverset) ? '' : ',')." sql_mode='' ") : '';
			$serverset && mysql_query("SET $serverset", $this->link);
		}
		if($this->config['database'] && !@mysql_select_db($this->config['database'], $this->link)) {
			$this->DisplayError('Cannot use database "'.$this->config['database'].'"');
		}
	}
	public function DisplayError($message='',$hook=''){
		if(!empty($hook)){$hook($message);}
		if($this->config['debug']){
			$html ='<b>MySQL Error: </b>'.$this->GetError().'<br/>';
			$html.='<b>MySQL Errno: </b>'.$this->GetErrno().'<br/>';
			$html.='<b>MySQL Message: </b>'.$message;
			echo "<div style='border:1px dotted #ccc; padding:5px; font-size:12px; clear:both;width:100%;height:auto;'>".$html."</div>";
			exit;
		}else{
			return false;
		}
	}



	final static public function GetObject($configs=array('hostname'=>'','database'=>'')){
		$db=$configs['hostname'].$configs['database'];

		if(!isset(self::$mysqlobj[$db])){
			if(!is_array($configs)){
				$this->DisplayError("The configuration file is not an array");
			}
			$C=__CLASS__;

			self::$mysqlobj[$db]=new $C($configs);
		}
		return self::$mysqlobj[$db];
	}

	public function close() {
		if (is_resource($this->link)) {
			@mysql_close($this->link);
		}
	}

	public function GetVersion($version=false) {
		if(!is_resource($this->link)) {
			$this->connect();
		}
		$mysql_version= mysql_get_server_info($this->link);
		$mysql_version = explode(".",trim($mysql_version));
		if($version){
			return $mysql_version[0].'.'.$mysql_version[1];
		}else{
			return $mysql_version[0].'.'.$mysql_version[1].'.'.$mysql_version[2];
		}

	}
	public function GetError(){
		return @mysql_error($this->link);
	}
	public function GetErrno(){
		return intval(@mysql_errno($this->link));
	}

	/**
	 * 获取最后一次添加记录的主键号
	 * @return int
	 */
	public function insert_id() {
		return mysql_insert_id($this->link);
	}


	/**
	 * 数据库查询执行方法
	 * @param $sql 要执行的sql语句
	 * @return 查询资源句柄
	 */
	public function execute($sql) {
		if(!is_resource($this->link)) {
			$this->Connect();
		}
		$this->lastresult = mysql_query($sql,$this->link) or $this->displayerror($sql);
		$this->querycount++;
		return $this->lastresult;
	}


	/**
	 * 释放查询资源
	 * @return void
	 */
	public function free_result() {
		if(is_resource($this->lastresult)) {
			mysql_free_result($this->lastresult);
			$this->lastresult = null;
		}
	}

	/**
	 * 检查表是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function table_exists($table) {
		$tables = $this->list_tables();
		return in_array($table, $tables) ? 1 : 0;
	}
	/*
    * 列表
    */
	public function list_tables() {
		$tables = array();
		$this->execute("SHOW TABLES");
		while($r = mysql_fetch_assoc($this->lastresult)) {
			$tables[] = $r['Tables_in_'.$this->config['database']];
		}
		return $tables;
	}

	//数据总数查询，需要一个结果集
	public function num_rows($lastresult)
	{
		return mysql_num_rows($lastresult);
	}

	//数据总数查询

	public function num_count($lastresult){
		$data=$this->get_one($lastresult,MYSQL_NUM);
		return $data[0];
	}

	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */

	public function affected_rows(){
		return mysql_affected_rows($this->link);
	}

	/**
	 * 返回一条查询结果集
	 * $lastresult      外部的结果集，如果没有就调用内部的结果集
	 * @param $type		返回结果集类型
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @return array
	 */
	final public function get_one($lastresult=null,$type=MYSQL_ASSOC){
		if(!$type)$type=MYSQL_ASSOC;
		if(is_resource($lastresult)){
			$datalist=mysql_fetch_array($lastresult,$type);
			$this->free_result();
			return $datalist;
		}
		if(!is_resource($this->lastresult)){
			$this->free_result();
			return false;
		}
		$datalist=mysql_fetch_array($this->lastresult,$type);
		$this->free_result();
		return $datalist;

	}

	/**
	 * 遍历查询结果集
	 * @param $type		返回结果集类型
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @param $type		按照键名排序
	 * @return array
	 */
	final public function &get_fetch_type($type=1,$key=''){

		if(!is_resource($this->lastresult)){
			$this->free_result();
			return false;
		}
		$datalist = $data = array();
		if(!$key){
			while($data=mysql_fetch_array($this->lastresult,$type)){
				$datalist[]=$data;
			}
		}else{
			while($data=mysql_fetch_array($this->lastresult,$type)){
				$datalist[$data[$key]]=$data;
			}
		}
		$this->free_result();
		return $datalist;
	}



	final public  function sqls($where, $font = ' AND ',$op='=') {
		if (is_array($where)) {
			$sql = '';
			foreach ($where as $key=>$val){
				$sql .= $sql ? " $font `$key` $op '$val' " : " `$key` $op '$val'";
			}
			return $sql;
		} else {
			return $where;
		}
	}

	/////
}
class model {
	//数据库配置
	protected $db_config = array (
		'default' =>
			array (
				'hostname' => 'localhost',   //数据库地址
				'database' => 'you',      //数据库名称
				'username' => 'root',      //数据库账户
				'password' => '',      //数据库密码
				'tablepre' => 'go_',
				'charset' => 'utf8',
				'type' => 'mysql',
				'debug' => false,
				'pconnect' => 0,
				'autoconnect' => 0,
			)
	);
	//数据库连接
	protected $db = '';
	//调用数据库的配置项
	protected $db_setting = 'default';
	//数据表名
	protected $tablename = '';
	//表前缀
	public  static $db_tablepre = '';
	public  static $strtablepre = '';
	public $Autocommit = '';
	public $sql_log = array();

	public function __construct() {


		if (!isset($this->db_config[$this->db_setting])) {
			$this->db_setting = 'default';
		}

		self::$strtablepre=System::load_sys_config('system','tablepre');
		self::$strtablepre=base64_decode(self::$strtablepre);
		self::$db_tablepre = $this->db_config[$this->db_setting]['tablepre'];
		$this->table_name=$this->db_config[$this->db_setting]['database'];
		$this->db = mysql::GetObject($this->db_config[$this->db_setting]);
	}



	//获取数据列表
	final public function GetList($sql,$info=array('type'=>1,'key'=>'')){
		if(empty($sql))return false;
		if(!is_array($info))return false;
		$sql=self::replacesql($sql);
		$this->db->execute($sql);
		$type=isset($info['type']) ? $info['type'] : 1;
		$key=isset($info['key']) ? $info['key'] : '';
		return $this->db->get_fetch_type($type,$key);

	}

	//获取单条数据
	final public function GetOne($sql,$info=array('type'=>1)){
		if(empty($sql))return false;
		if(!is_array($info))return false;
		$type=isset($info['type']) ? $info['type'] : 1;
		$sql=self::replacesql($sql);
		$this->db->execute($sql);
		return $this->db->get_one(NULL,$type);

	}

	//获取分页数据
	final public function GetPage($sql,$info=array('type'=>1,'key'=>'')){
		if(empty($sql))return false;
		if(!is_array($info))return false;
		$page=intval($info['page']) ? intval($info['page']) : 1;
		if($page<=0){$page=1;}
		$sql=self::replacesql($sql);
		$num=(!empty($info['num'])) ? intval($info['num']) : 20;
		$sql=str_ireplace('limit','limit',$sql);
		$sql=explode('limit',$sql);
		$sql=trim($sql[0]);
		$limit=" LIMIT ".($page-1)*$num.",".$num;
		$sql=$sql.$limit;
		$this->db->execute($sql);
		$type=isset($info['type']) ? $info['type'] : 1;
		$key=isset($info['key']) ? $info['key'] : '';
		return $this->db->get_fetch_type($type,$key);
	}
	//获取数据总数1
	final public function GetCount($sql){
		if(empty($sql))return false;
		$sql=self::replacesql($sql);
		$sql = preg_replace ("/^SELECT (.*) FROM/i", "SELECT COUNT(*) FROM",$sql);
		$lastresult=$this->db->execute($sql);
		return $this->db->num_count($lastresult);
	}
	//获取数据总数2
	final public function GetNum($sql){
		if(empty($sql))return false;
		$sql=self::replacesql($sql);
		$lastresult=$this->db->execute($sql);
		return $this->db->num_rows($lastresult);
	}

	final static private function replacesql($sql){
		static $sqllist=array();
		$key=md5($sql);
		if(isset($sqllist[$key])){
			return $sqllist[$key];
		}
		$sqllist[$key]=str_ireplace(self::$strtablepre,self::$db_tablepre,trim($sql));
		$sqllist[$key]=preg_replace("/\s(?=\s)/","\\1",$sqllist[$key]);
		return $sqllist[$key];
	}


	//返回查询资源结果集
	public function Query($sql){
		if(empty($sql))return false;
		$sql=self::replacesql($sql);
		$this->db->execute($sql);
		if(defined("G_IN_ADMIN")){
			preg_match("/^UPDATE|^INSERT|^DELETE/i",$sql,$matches,PREG_OFFSET_CAPTURE);
			if(isset($matches[0][0])){
				$this->sql_log[] = $sql;
			}
		}
		return $this->db->lastresult;
	}

	//返回插入最后一次的ID
	final public function insert_id(){
		return $this->db->insert_id();
	}

	//影响的行数
	final public function affected_rows($link=null){
		if(empty($link))
			return $this->db->affected_rows();
		else
			return mysql_affected_rows($link);
	}
	/*
    *	bool 为真,返回段版本号
    */
	public function GetVersion($bool=false){
		return $this->db->GetVersion($bool);
	}

	public function __destruct(){
		//mysql_close();
	}


	final public function Autocommit_off(){
		$this->Query('SET AUTOCOMMIT=1');
	}
	final public function Autocommit_no(){
		$this->Query('SET AUTOCOMMIT=0');
	}
	//开启事务
	final public function Autocommit_start(){
		$this->Query('START TRANSACTION');
		$this->Autocommit = 'start';
	}
	//成功执行
	final public function Autocommit_commit(){
		$this->Query('COMMIT');
		$this->Autocommit = 'commit';
	}
	//回滚事务
	final public function Autocommit_rollback(){
		$this->Query('ROLLBACK');
		$this->Autocommit = 'rollback';
	}

}
class wechatCallbackapiTest
{
	private $db;
	public function __construct() {
		$this->db = new model();
	}
	//验证签名
	public function valid()
	{
		$echoStr = $_GET["echostr"];
		if($this->_checkSignature()){
			echo $echoStr;
			exit;
		}
	}

	public function responseMsg(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		// 把接收的消息写入日志
		$this->log("R\n".$postStr,"./log/log.xml");
		if (!empty($postStr)){
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim($postObj->Content);
			if(empty($keyword)){
				$keyword = $_GET['keyword'];
			}
			if(empty($fromUsername)){
				$fromUsername = 'opSicjigYKxue3QWHbWEGAd8VKPA';
			}
			$time = time();
			$base_ret = $this->db -> GetOne("SELECT * FROM  `@#_wxch_cfg` WHERE `cfg_name` = 'baseurl'");
			if(!empty($base_ret['cfg_value'])){
				$base_url = $base_ret['cfg_value'];
			}
			$base_img = $this->db -> GetOne("SELECT * FROM  `@#_wxch_cfg` WHERE `cfg_name` = 'imgpath'");
			if(!empty($base_img['cfg_value'])){
				$img_url = $base_img['cfg_value'];
			}
			//  查询用户信息
			$retuser = $this->db -> GetOne("SELECT `b_uid` FROM `@#_member_band` WHERE `b_code` ='$fromUsername' LIMIT 1");
			$user_id = $retuser['b_uid'];
			$textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";
			$imageTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<ArticleCount>%s</ArticleCount>
				<Articles>
				%s
				</Articles>
				<FuncFlag>0</FuncFlag>
				</xml>";
			$newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<ArticleCount>%s</ArticleCount>
				<Articles>
				%s
				</Articles>
				<FuncFlag>0</FuncFlag>
				</xml>";
			//如果是关注事件
			if ($postObj->MsgType == 'event') {
				$Eventkeyword = $postObj->EventKey;
				if ($postObj->Event =="subscribe"){
					$msgType = "text";
					//查询回复语言
					$lang = $this->db -> GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE `cfg_name` = 'reply'");
					if(empty($retuser)){  //如果用户不存在
						$contentgz = htmlspecialchars_decode($lang['cfg_value']);
						//查询设置的默认密码
						$pwd = $this->db -> GetOne("SELECT `cfg_value` FROM `@#_wxch_cfg` WHERE `cfg_name` = 'userpwd'");
						$cfgv = trim($pwd['cfg_value']);
						if(!empty($cfgv)){
							$password = $cfgv;
						}else{
							$ychar="0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
							$list=explode(",",$ychar);
							for($i=0;$i<6;$i++){
								$randnum=rand(0,35);
								$password.=$list[$randnum];
							}
						}
						//此处得到随机密码--E
						// 自动登陆----S
						$wechat= $this->db->GetOne("select * from `@#_wechat_config` where id = 1");
						// 获取token
						$token= get_token($wechat['appid'],$wechat['appsecret']);
						$user_info_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$fromUsername;
						$user_info = json_decode(getCurl($user_info_url),true);
						$uopenid = $user_info['openid'];
						if(empty($uopenid)){
							$contentStr = '信息获取失败，请取消關注后再重新关注';
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;die;
						}
						// 自动登陆----E
						$password2 = md5($password);
						$headimg  = $user_info['headimgurl'];
						$nickname = $user_info['nickname'];
						//因为不存在用户信息，所以就进行写入操作
						$this->db -> Query("INSERT INTO `@#_member` (`username`, `password`, `time`, `img`, `headimg`, `wxid`) VALUES ('$nickname', '$password2','$time','photo/member.jpg','$headimg','$fromUsername');");
						$b_uid = $this->db->insert_id();
						$this->db -> Query("INSERT INTO `@#_member_band` SET `b_uid` = '$b_uid' , `b_time` = '$time', `b_type`='weixin', `b_code`='$fromUsername'");
						$contentreg = "\n\n恭喜您注册成功!\n您的用户名为:".$nickname."\n密码为:".$password."\n\n<a href='".$base_url."index.php/mobile/home'>进入会员中心</a>";
						//如果是二维码关注场景--S
						if (isset($postObj->EventKey)){
							$Eventkeyword = substr($Eventkeyword,8,7);
							$this->db -> Query("UPDATE `@#_cjcode` SET `total` = total+1  WHERE `code` = $Eventkeyword");
							$view = $this->db->GetOne( "SELECT * FROM `@#_cjlist` WHERE `uid`= $b_uid AND `codeid` = '$Eventkeyword' AND `come` = 0 LIMIT 1");
							if(empty($view)){
								$this->db -> Query("INSERT INTO `@#_cjlist` SET `codeid` = '$Eventkeyword', `time`=$time, `wxid`='$fromUsername', `uid`='$b_uid',`sum` = 1");
							}else{
								$this->db -> Query("UPDATE `@#_cjlist` SET `sum` = sum+1, `time`=$time WHERE `uid`='$b_uid' AND `codeid` = '$Eventkeyword' AND `come` = 0");
							}
						}
						//如果是二维码关注场景--E
						$contentStr = $contentgz.$contentreg;
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						$this->autologin($fromUsername);
						echo $resultStr;exit;
					}else{
						//如果是二维码关注场景--S
						if (isset($postObj->EventKey)){
							$Eventkeyword = substr($Eventkeyword,8,7);
							$this->db -> Query("UPDATE `@#_cjcode` SET `total` = total+1  WHERE `code` = $Eventkeyword");
							$view = $this->db->GetOne( "SELECT * from `@#_cjlist` WHERE `uid`= $user_id AND `codeid` = '$Eventkeyword' AND `come` = 0 LIMIT 1");
							if(empty($view)){
								$this->db -> Query("INSERT INTO `@#_cjlist` SET `codeid` = '$Eventkeyword', `time`=$time, `wxid`='$fromUsername', `uid`='$user_id',`sum` = 1");
							}else{
								$this->db -> Query("UPDATE `@#_cjlist` SET `sum` = sum+1, `time`=$time WHERE `uid`='$user_id' AND `codeid` = '$Eventkeyword' AND `come` = 0");
							}
						}
						//如果是二维码关注场景--E
						//接下来是用户已经绑定的情况
						$retuser = $this->db -> GetOne( "SELECT `username` from `@#_member` WHERE `uid`= $user_id");
						//$gzshb = $this->coupon($fromUsername);   //关注送红包
						$contentStr = htmlspecialchars_decode($lang['regmsg']['cfg_value']);
						$contentStr .="尊敬的".$retuser['username']."您好！\n\n您已经关注成功,如果您没有修改过密码,那么您的默认密码是 123456，建议您及时修改并绑定手机号，以便我们及时与您取得联系！"."\n\n<a href='".$base_url."index.php/mobile/home'>进入会员中心</a>";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
						$this->autologin($fromUsername);
						exit;
					}
				}elseif($postObj->Event =="SCAN"){
					$this->db -> Query("UPDATE `@#_cjcode` SET `nownum` = nownum+1  WHERE `code` = $Eventkeyword");
					$view = $this->db->GetOne( "SELECT * from `@#_cjlist` WHERE `uid`= $user_id AND `codeid` = '$Eventkeyword' AND `come` = 1 LIMIT 1");
					if(empty($view)){
						$this->db -> Query("INSERT INTO `@#_cjlist` SET `codeid` = '$Eventkeyword', `time`=$time, `wxid`='$fromUsername', `uid`='$user_id', `come` = 1, `sum` = 1");
					}else{
						$this->db -> Query("UPDATE `@#_cjlist` SET `sum` = sum+1, `time`=$time WHERE `uid`='$user_id' AND `codeid` = '$Eventkeyword' AND `come` = 1");
					}

				}else{
					$keyword = $postObj->EventKey;
				}

			}
		}
		$auto_res = $ret = $this->db -> GetList("SELECT * FROM `@#_weixin_keywords`");
		if(count($auto_res) > 0){
			foreach($auto_res as $k => $v){
				$res_ks = explode(' ', $v['keyword']);
				if($v['type'] == 1){
					$msgType = "text";
					foreach($res_ks as $kk => $vv){
						if($vv == $keyword){
							$contentStr = $v['contents'];
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;
							$this->db -> Query("UPDATE `@#_weixin_keywords` SET `count` = `count`+1 WHERE `id` =$v[id]");
						}
					}
				}
				if($v['type'] == 2){
					$msgType = "news";
					foreach($res_ks as $kk => $vv){
						if($vv == $keyword){
							$ArticleCount = 1;
							$v['images'] = $img_url.'/'.$v['pic'];
							$items .= "<item>
						<Title><![CDATA[" . $v['pic_tit'] . "]]></Title>
						<Description><![CDATA[" . $v['desc'] . "]]></Description>
						<PicUrl><![CDATA[" . $v['images'] . "]]></PicUrl>
						<Url><![CDATA[" . $v['pic_url'] . "]]></Url>
						</item>";
							$resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
							echo $resultStr;
							$this->db -> Query("UPDATE `@#_weixin_keywords` SET `count` = `count`+1 WHERE `id` =$v[id]");
						}
					}
				}
			}
		}
		// 关键字回复
		if($keyword == 'debug'){
			$msgType = "text";
			$contentStr = "Welcome to here!";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		}elseif($keyword == 'member'){
			$msgType = "text";
			$contentStr = "<a href='".$base_url."index.php/mobile/home'>进入会员中心</a>";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			$this->autologin($fromUsername);
			exit;
		} elseif ($keyword == 'qiandao') {
			$jf_state = $this->db->GetOne("SELECT `autoload` FROM `@#_weixin_point` WHERE `point_name` = '$keyword'");
			$jf_state = $jf_state['autoload'];
			$msgType = "text";
			if ($jf_state == 'yes') {
				$qd_jf = $this->db->getOne("SELECT `point_value` FROM `@#_weixin_point` WHERE `point_name` = '$keyword'");
				$res = $this->plusPoint($uname, $keyword, $fromUsername);
				if ($res['errmsg'] == 'ok') {
					$contentStr = $res['contentStr'] . $qd_jf['point_value'];
				}else{
					$contentStr = $res['contentStr'];
				}
			}elseif($jf_state == 'no'){
				$contentStr = '签到送福分已停止使用';
			}
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		}elseif ($keyword == 'zj') {
			$msgType = "text";
			// 查询用户是否已经使用微信登陆过
			$bind = $this->db -> GetOne("SELECT * FROM `@#_member_band`  WHERE `b_code`= '$fromUsername' LIMIT 1");
			if(empty($bind)){
				$contentStr = "信息获取失败！快捷登录或绑定您的微信账号到网站（建议您先用微信快捷登陆或者重新关注微信公众号），然后再操作。";
			}else{
				$uid = $bind['b_uid'];
				if($uid<1){
					$contentStr = "用户信息错误！";
				}else{
					$contentStr= $this->coupon($uid);
				}
			}
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		}elseif ($keyword == 'jfcx') {
			$ret = $this->db -> GetOne("SELECT `b_uid` FROM `@#_member_band` WHERE `b_code` ='$fromUsername' LIMIT 1");
			$uid = $ret['b_uid'];
			$ret = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid` = '$uid'");
			if(empty($ret)){
				$contentStr = "用户信息错误，建议您取消关注后从新关注哦！";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
				exit;
			}
			$pay_points = $ret['score'];
			$money = $ret['money'];
			$jingyan = $ret['jingyan'];
			$msgType = "text";
			$contentStr = "尊敬的".$ret['username']."您好：\r\n账户余额：$money\r\n福分：$pay_points\r\n经验：$jingyan";
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		}elseif($keyword == 'new'){
			$ret = $this->db -> GetList("SELECT * FROM  `@#_shoplist` WHERE `q_user` = '' AND `qishu` < 5 ORDER BY `time`  DESC LIMIT 0 , 5");
			$ArticleCount = count($ret);
			if($ArticleCount >= 1){
				foreach($ret as $v){
					$v['thumbnail_pic'] = $img_url .'/'. $v['thumb'];
					$goods_url = $base_url . '/?/mobile/mobile/item/'. $v['id'];
					$items .= "<item>
					<Title><![CDATA[" . $v['title'] . "]]></Title>
					<PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
					<Url><![CDATA[" . $goods_url . "]]></Url>
					</item>";
				}
				$msgType = "news";
			}
			$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
			$this->plusPoint($uname, $keyword, $fromUsername);
			$this->autologin($fromUsername);
			echo $resultStr;
			exit;
		}elseif($keyword == 'renqi'){
			$ret = $this->db -> GetList("SELECT * FROM  `@#_shoplist` WHERE `q_user` = '' AND `renqi` = 1 ORDER BY `time` DESC LIMIT 0 , 5");
			$ArticleCount = count($ret);
			if($ArticleCount >= 1){
				foreach($ret as $v){
					$v['thumbnail_pic'] = $img_url .'/'. $v['thumb'];
					$goods_url = $base_url . '/?/mobile/mobile/item/'. $v['id'];
					$items .= "<item>
				<Title><![CDATA[" . $v['title'] . "]]></Title>
				<PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
				<Url><![CDATA[" . $goods_url . "]]></Url>
				</item>";
				}
				$msgType = "news";
			}
			$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
			$this->plusPoint($uname, $keyword, $fromUsername);
			$this->autologin($fromUsername);
			echo $resultStr;
			exit;
		}elseif($keyword == 'tuijian'){
			$ret = $this->db -> GetList("SELECT * FROM  `@#_shoplist` WHERE `q_user` = '' AND `pos` = 1 ORDER BY `time` DESC LIMIT 0 , 5");
			$ArticleCount = count($ret);
			if($ArticleCount >= 1){
				foreach($ret as $v){
					$v['thumbnail_pic'] = $img_url .'/'. $v['thumb'];
					$goods_url = $base_url . '/?/mobile/mobile/item/'. $v['id'];
					$items .= "<item>
				<Title><![CDATA[" . $v['title'] . "]]></Title>
				<PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
				<Url><![CDATA[" . $goods_url . "]]></Url>
				</item>";
				}
				$msgType = "news";
			}
			$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
			$this->plusPoint($uname, $keyword, $fromUsername);
			$this->autologin($fromUsername);
			echo $resultStr;
			exit;
		}elseif($keyword == 'ddcx') {
			$orders = $this->db->GetList("SELECT * FROM `@#_member_go_record` WHERE `uid` = '$user_id' AND `huode` > 100 ORDER BY `id` DESC LIMIT 1");
			if (!empty($orders)) {
				$msgType = "news";
				$ArticleCount = count($orders);
				if($ArticleCount >= 1){
					foreach($orders as $v){
						$title = '最近订单：' . $v['shopname'];
						$url = $base_url . '/?/mobile/mobile/dataserver/' . $v['shopid'];
						$description = "用户名：" . $v['username'] ."\r\n商品信息：" . $v['shopname'] . "\r\n总金额：" . $v['moneycount'] . "\r\n中奖码：" . $v['huode'] ."\r\n订单状态：" . $v['status'] . "\r\n快递公司：" . $v['company'] . "\r\n物流单号：" . $v['company_code']. "\r\n快递费用：" . $v['company_money'].'元';
						$items = "<item>
					<Title><![CDATA[" . $title . "]]></Title>
					<Description><![CDATA[" . $description . "]]></Description>
					<PicUrl><![CDATA[]]></PicUrl>
					<Url><![CDATA[" . $url . "]]></Url>
					</item>";
					}
					$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
					$this->plusPoint($uname, $keyword, $fromUsername);
					$this->autologin($fromUsername);
					echo $resultStr;
				}
			} else {
				$msgType = "text";
				$contentStr = "您还没有订单";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
			}
			exit;
		}elseif ($keyword == 'kdcx') {
			if (!empty($user_id)) {
				$orders = $this->db->GetOne("SELECT * FROM `@#_member_go_record` WHERE `uid` = '$user_id' AND `huode` > 100 ORDER BY `id` DESC LIMIT 1");
			}else{
				$ret = $this->db-> GetOne("SELECT `uid` FROM `@#_member` WHERE `username` ='$fromUsername'");
				$user_id = $ret['uid'];
				$orders = $db->GetOne("SELECT * FROM `@#_member_go_record` WHERE `uid` = '$user_id' ORDER BY `id` DESC");
			}
			if (empty($orders)) {
				$msgType = "text";
				$contentStr = '您还没有订单，无法查询快递';
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
				exit;
			}
			if (empty($orders['company_code'])) {
				$msgType = "text";
				$contentStr = '中奖订单：' . $orders['shopname'] . '还没有快递单号，不能查询';
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
				exit;
			}
			$k_arr = $this->kuaidi($orders['company_code'], $orders['company']);
			$contents = '';
			if ($k_arr['message'] == 'ok') {
				$count = count($k_arr['data']) - 1;
				for ($i = $count; $i >= 0; $i--) {
					$contents.= "\r\n" . $k_arr['data'][$i]['time'] . "\r\n" . $k_arr['data'][$i]['context'];
				}
				$msgType = "text";
				$contentStr = "快递信息" . $contents;
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				$this->plusPoint($db, $uname, $keyword, $fromUsername);
				echo $resultStr;
				exit;
			}
		}elseif(!empty($keyword)){
			$goods_name = $keyword;
			$ret = $this->db -> GetList("SELECT * FROM  `@#_shoplist` WHERE  `title` LIKE '%$goods_name%' AND `q_user` = '' LIMIT 0,5");
			$ArticleCount = count($ret);
			if($ArticleCount >= 1){
				foreach($ret as $v){
					$v['thumbnail_pic'] = $img_url .'/'. $v['thumb'];
					$goods_url = $base_url . '/?/mobile/mobile/item/'. $v['id'];
					$items .= "<item>
				<Title><![CDATA[" . $v['title'] . "]]></Title>
				<PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
				<Url><![CDATA[" . $goods_url . "]]></Url>
				</item>";
				}
				$msgType = "news";
			}else{
				$msgType = "text";
				$tj_str = $this -> plusTj($base_url,$fromUsername);
				$contentStr = '没有搜索到"' . $goods_name . '"的商品' . $tj_str;
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
				$this->autologin($fromUsername);
				exit;
			}
			$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
			echo $resultStr;
			$this->autologin($fromUsername);
			exit;
		}else{
			echo "";
			exit;
		}

	}
	/*****获取推荐商品********/
	protected function plusTj($base_url,$fromUsername){
		$ret = $this->db -> GetList("SELECT * FROM  `@#_shoplist` WHERE  `q_user` = ''");
		$tj_count = count($ret);
		$tj_key = mt_rand(0, $tj_count);
		$tj_goods = $ret[$tj_key];
		return $tj_str = "\r\n我们为您推荐:" . '<a href="' . $base_url . '/?/mobile/mobile/item/' . $tj_goods['id'] . '&wxid='.$fromUsername.'">' . $tj_goods['title'] . '</a>';
	}
	/*****************获取新闻**************/
	protected function getNews($db, $base_url){
		$ret = $this->db -> GetList("SELECT * FROM  `@#_article` ORDER BY `posttime` LIMIT 0 , 5");
		$ArticleCount = count($ret);
		if($ArticleCount >= 1){
			foreach($ret as $v){
				$v['thumbnail_pic'] = $base_url . $v['goods_img'];
				$goods_url = $base_url . 'goods.php?id=' . $v['goods_id'];
				$items .= "<item>
		 <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
		 <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
		 <Url><![CDATA[" . $goods_url . "]]></Url>
		 </item>";
			}
		}
		$this->autologin($fromUsername);
		$data = array();
		$data['ArticleCount'] = $ArticleCount;
		$data['items'] = $items;
		return $data;
	}
	/****************回复关键字送红包活动**********/
	protected function coupon($uid) {
		$time = time();
		//查询领取过没
		$res = $this->db->GetOne("SELECT `status`,`input_time` FROM `@#_weixin_sign` WHERE `uid` = $uid");
		if($res['status']>0){
			return $contentStr = "您已经领取过现金了,不能重复领取的哦！\r\n领取时间".date('Y-m-d H:i:s',$res['input_time']);
		}
		//查询设置的红包类型
		$ret = $this->db->GetOne("SELECT * FROM `@#_weixin_bonus` WHERE `id` = 1");
		$type_id = $ret['type_id'];
		if($type_id == 0){
			return '领红包功能暂时没有开启，请联系管理员！';
		}
		$rets = $this->db->GetOne("SELECT * FROM `@#_weixin_bonus_type` WHERE `type_id` =$type_id ");
		$type_money = $rets['type_money'];
		//开始红包操作流程
		if (($time >= $rets['send_start_date']) && ($time <= $rets['send_end_date'])) {
			if ($rets['total']>0 && ($rets['total']-$rets['getnum']) >0) {
				//更新微信红包是否领取以及领取的那个红包
				$q1=$this->db->Query("INSERT INTO `@#_weixin_sign` SET `uid` = $uid, `status`=1, `input_time`= $time, `typeid` = $type_id");
				//更新用户金额
				$q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money`+ $type_money WHERE `uid` ='$uid'");
				//组合内容
				$pay_type = '微信关注送现金红包'.$type_money.'元';
				//增加我的充值记录报
				$q3 =  $this->db->Query("INSERT INTO  `@#_member_account` SET `uid` = $uid, `type`=1, `pay`='账户', `content`='$pay_type', `money`=$type_money,`time`=$time");

				$q4 = $this->db->Query("INSERT INTO `@#_member_addmoney_record` (`money`,`uid`,`pay_type`,`status`,`time`) VALUES ('$type_money', '$uid','$pay_type','已付款','$time')");
				//更新红包剩余总数
				$q5 = $this->db->Query("UPDATE `@#_weixin_bonus_type` SET `getnum` = `getnum`+1 WHERE `type_id`=$type_id");

				$contentStr = "很高兴地通知您，您获得了本站赠送的". $type_money . "元现金红包\r\n现在已经存入到您的账户\r\n可以用来购买商品哦！";
			} else {
				$contentStr = "真是遗憾！您来晚了哦！\r\n本次活动红包已送完!";
			}
		}else{
			$contentStr = "真是遗憾！您来晚了哦！\r\n不在活动时段或者活动时间已经过期，具体请咨询管理员处理!";
		}
		return $contentStr;
	}

	private function _checkSignature(){
		$info=$this->db->GetOne("select * from `@#_wechat_config`");
		define("TOKEN", $info['token']);
		if (!defined("TOKEN")) {
			throw new Exception('TOKEN is not defined!');
		}
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	/******增加菜单点击事件*********/
	public function plusPoint($uname, $keyword, $fromUsername) {
		$res_arr = array();
		$record = $this->db->GetOne("SELECT * FROM `@#_weixin_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'");
		$num = $this->db->GetOne("SELECT `point_num` FROM `@#_weixin_point` WHERE `point_name` = 'qiandao'");
		$num = $num['point_num'];
		$lasttime = time();
		if (empty($record)) {
			$dateline = time();
			$potin_name = $this->db->GetOne("SELECT `point_name` FROM `@#_weixin_point` WHERE `point_name` = '$keyword'");
			$potin_name=$potin_name['point_name'];
			if (!empty($potin_name)) {
				$this->db->Query("INSERT INTO `@#_weixin_point_record` (`wxid`, `point_name`, `num`, `lasttime`, `datelinie`,`total`) VALUES ('$fromUsername', '$keyword' , 1, $lasttime, $dateline, 1);");
			}
		} else {
			$time = time();
			$db_lasttime = $this->db->GetOne("SELECT `lasttime` FROM `@#_weixin_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'");
			if (($time - $db_lasttime['lasttime']) > (60 * 60 * 24)) {
				$this->db->Query("UPDATE `@#_weixin_point_record` SET `num` = 0,`lasttime` = '$lasttime' WHERE `wxid` ='$fromUsername';");
			}
			$record_num = $this->db->GetOne("SELECT `num`,`total`,`lasttime` FROM `@#_weixin_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'");
			if ($record_num['num'] < 1) {
				$this->db->Query("UPDATE `@#_weixin_point_record` SET `num` = `num`+1, `total` = `total`+1,`lasttime` = '$lasttime' WHERE `point_name` = '$keyword' AND `wxid` ='$fromUsername';");
			} else {
				$res_arr['errmsg'] = 'no';
				$res_arr['contentStr'] = '今天签到过啦，明天继续哦！';
				return $res_arr;
			}
		}
		$wxch_points = $this->db->GetList("SELECT * FROM  `@#_weixin_point`");
		foreach ($wxch_points as $k => $v) {
			if ($v['point_name'] == $keyword) {
				if ($v['autoload'] == 'yes') {
					$points = $v['point_value'];
					$this->db->Query("UPDATE `@#_member` SET `score` = `score`+$points WHERE `username` ='$uname'");
				}
			}
		}
		$res_arr['errmsg'] = 'ok';
		if($record_num['total']==0){
			$res_arr['contentStr'] = "签到成功,\r\n共计签到1天 , 福分+";
		}
		if($record_num['total']>0){
			$totals = $record_num['total']+1;
			$res_arr['contentStr'] ="您共签到".$totals."天\r\n上次签到时间：".date('Y-m-d H:i:s',$record_num['lasttime']) ."\r\n本次签到成功,福分+";
		}
		return $res_arr;
	}

	public function kuaidi($invoice_no, $shipping_name) {
		switch ($shipping_name) {
			case '中国邮政':
				$logi_type = 'ems';
				break;

			case '申通快递':
				$logi_type = 'shentong';
				break;

			case '圆通速递':
				$logi_type = 'yuantong';
				break;

			case '顺丰速运':
				$logi_type = 'shunfeng';
				break;

			case '韵达快递':
				$logi_type = 'yunda';
				break;

			case '天天快递':
				$logi_type = 'tiantian';
				break;

			case '中通速递':
				$logi_type = 'zhongtong';
				break;

			case '增益速递':
				$logi_type = 'zengyisudi';
				break;
		}
		$kurl = 'http://www.kuaidi100.com/query?type=' . $logi_type . '&postid=' . $invoice_no;
		$ret = $this->curl_get_contents($kurl);
		$k_arr = json_decode($ret, true);
		return $k_arr;
	}
	public function curl_get_contents($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
		curl_setopt($ch, CURLOPT_REFERER, _REFERER_);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}
	public function curl_grab_page($url, $data, $proxy = '', $proxystatus = '', $ref_url = ''){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_TIMEOUT, 40);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		if ($proxystatus == 'true'){
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(!empty($ref_url)){
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_REFERER, $ref_url);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		ob_start();
		return curl_exec ($ch);
		ob_end_clean();
		curl_close ($ch);
		unset($ch);
	}

	// get方法请求
	function getCurl($url){//get https的内容
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$result= curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	// 获取token
	function get_token($appid,$appsecret){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$json=$this->getCurl($url);
		$arr=json_decode($json,true);
		return $arr['access_token'];
	}


	// 检查用户登陆状态的
	private function _login($uname, $password){
		$userinfo = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `username` ='$uname'");
		if($userinfo['password'] == md5($password)){
			return true;
		}else{
			return false;
		}
	}
	// 写日志，私有化(需要写入的数据，文件名-非必须)
	private function log($data,$log_filename){
		// 如果文件夹不存在则创建文件夹
		is_dir(dirname($log_filename)) || mkdir(dirname($log_filename),0777,true);
		// 日志大小
		$max_size=10000;
		// 判断文件大小做自动删除动作
		if(file_exists($log_filename) && abs(filesize($log_filename))>$max_size){
			// 删除文件
			unlink($log_filename);
		}else{
			// 写日志(第三个参数是系统函数，可以连续写文件不覆盖)
			file_put_contents($log_filename, date("H:i:s")." ".$data."\n", FILE_APPEND);
		}
	}
	//写入自动登录方法
	private function autologin($wxid){
		$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$wxid."'");
		$this->userinfo=$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");
		_setcookie("uid",_encrypt($member['uid']),60*60*24*7);
		_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
	}
}
?>