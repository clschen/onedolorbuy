<?php 



/**

*	V3.1.6	 time:2014-06-12

**/



class sendmobile {

	

	public $error = '';

	public $v = '';

	

	private $mobile;

	private $config;

	private $op;

	



	

	/**

	*	短信配置总入口

	*	config  @设置要发送的短信数组

	*	mobiles @短信总配置文件

	*	key 	@手动指定开启的短信接口,不指定调用配置文件

	**/

	public function init($config=null,$mobiles=null,$key=null){

		if(!$config){

			return false;

		}

		

		if($config['mobile']==NULL)return false;

		if($config['content']==NULL)return false;

		$this->config = $config;

		

		if(!$mobiles){

			$this->mobile = System::load_sys_config('mobile');

		}

		if(intval($key) && isset($this->mobile['cfg_mobile_'.$key]) && method_exists($this,"cfg_seting_".$key)){

			$op = $key;

			$func = "cfg_seting_".$key;		

		}else{

			$op = $this->mobile['cfg_mobile_on'];

			$func = "cfg_seting_".$this->mobile['cfg_mobile_on'];		

		}

		$this->op = $op; 

		return $this->$func();	

	}

	

	

	

	/**

	*	总发送入口	

	**/	

	public function send(){

		$func = "cfg_send_".$this->op;

		return $this->$func();	

	}

	

	

	/**********************************************************/

	/**********************************************************/

	/**********************************************************/

	
	/**
	 * 企信通短信配置设置
	 */
	private function cfg_seting_4(){
		return true;
	}

	/**
	 * 企信通短信发送
	 * User:rantianya
	 * Time:2016-03-31
	 */
	private function cfg_send_4(){
		$mobile = $this->mobile['cfg_mobile_4'];	
		$name = urlencode($mobile['mid']);
		$pwd  = $mobile['mpass'];
		$haoma = $this->config['mobile'];

		$post_data = array();
		$post_data['userid'] = $mobile['userid'];
		$post_data['account'] = $name;
		$post_data['password'] = $pwd;
		$post_data['content'] = $mobile['mqianming'].$this->config['content']; //短信内容需要用urlencode编码下
		$post_data['mobile'] = $haoma;
		$post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
		$url='http://120.26.244.194:8888/sms.aspx?action=send';
		$o='';

		foreach ($post_data as $k=>$v)
		{
		   $o.="$k=".urlencode($v).'&';
		}
		$post_data=substr($o,0,-1);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
		$result = curl_exec($ch);
		$errno = curl_errno($ch);
		curl_close($ch);

		/*xml*/
		$arr = _xml_to_array($result);
		/*xml*/

		if($arr['returnsms']['returnstatus']=='Success'){
			$this->v = "发送成功！";
			$this->error = 1;
		}else{
			$this->v = $arr['returnsms']['message'];
			$this->error = -1;
		}
		return $arr;
	}

	/**
	 * 企信通查询剩余条数 
	 * User:rantianya
	 * Time:2016-03-31
	 */
	public function cfg_getdata_4(){
		$this->mobile = System::load_sys_config("mobile");
		$mobile = $this->mobile['cfg_mobile_4'];	
		$name = urlencode($mobile['mid']);
		$pwd  = $mobile['mpass'];

		$post_data = array();
		$post_data['userid'] = $mobile['userid'];
		$post_data['account'] = $name;
		$post_data['password'] = $pwd;
		$url='http://120.26.244.194:8888/sms.aspx?action=overage';
		$o='';
		foreach ($post_data as $k=>$v)
		{
		    $o.="$k=".urlencode($v).'&';
		}
		$post_data=substr($o,0,-1);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		

		/*xml*/
		$arr = _xml_to_array($result);
		/*xml*/


		$this->error = $arr['returnsms']['returnstatus'];

		$this->v = $arr['returnsms']['overage'];

		return $arr;
		
		
		
	}

	/*郑州商讯短信配置设置*/

	private function cfg_seting_1(){

		return true;

	}

	

	/*郑州商讯短信发送*/

	private function cfg_send_1(){

	

		$mobile = $this->mobile['cfg_mobile_1'];		

		$name = urlencode($mobile['mid']);

		$pwd  = $mobile['mpass'];

		$haoma = $this->config['mobile'];

		

		$content = iconv( "UTF-8", "gb2312//IGNORE" ,$this->argv['content']);

		$content = urlencode($content);			

		

	

		$fp=fopen("http://203.81.21.34/send/gsend.asp?name=$name&pwd=$pwd&dst=$haoma&msg=$content","r");		

		if(!$fp){

			$fp=fopen("http://203.81.21.13/send/gsend.asp?name=$name&pwd=$pwd&dst=$haoma&msg=$content","r");

		}

		if(!$fp){

			fclose($fp);

			$this->error=-1;

			$this->v = "打开文件发送失败";

			return;

		}	

		$ret = '';

		while (!feof($fp)) {		

			$ret .= fgets($fp,1024);				

		}	

			

		if($ret){

			$ret = $this->exp_url($ret);

			$this->error=$ret['num'];

			$this->v = $ret['err'];

		}else{		

			$this->error=-1;

			$this->v = "未获取到返回值";

			return;

		}

		return $ret;

		

	}

	

	/*郑州商讯短信其他操作*/

	public function cfg_getdata_1(){

			$this->mobile = System::load_sys_config("mobile");

			/*获取剩余条数 GetBalance_new*/

			$mobile = $this->mobile['cfg_mobile_1'];			

			$name = urlencode($mobile['mid']);

			$pwd  = $mobile['mpass'];			

			

			$fp=fopen("http://203.81.21.34/send/getfee.asp?name=$name&pwd=$pwd","r");

			if(!$fp){

				$fp=fopen("http://203.81.21.13/send/getfee.asp?name=$name&pwd=$pwd","r");

			}

			if(!$fp){

				$fp=fopen("http://www.139000.com/send/getfee.asp?name=$name&pwd=$pwd","r");

			}

			

			if(!$fp){

				fclose($fp);	

				return array("-1","打开文件发送失败");

			}			

			

			$ret = '';

			while (!feof($fp)) {				

				$ret .= fgets($fp,1024);				

			}									

			

			if($ret){				

				$ret = $this->exp_url($ret);			

			}else{

				return array("-1","未获取到返回值");

			}

			

			if($ret['id'] == '-9999' || $ret['id'] == '0'){

				$ret['id'] = 0;

			}else{

				$ret['id'] = (intval($ret['id']) / 10);

			}

			

		

			$this->v = $ret['id'];

			$this->error = $ret['errid'];

			return $ret;		

	}

	

		

	/**********************************************************/

	/**********************************************************/

	/**********************************************************/

	

	

	/*短信宝短信配置设置*/

	private function cfg_seting_2(){

		$mobile = $this->mobile['cfg_mobile_2'];

		$this->config['content'] = $this->config['content'].$mobile['mqianming'];

		return true;

	}

	

	/*短信宝短信发送*/

	private function cfg_send_2(){
		$mobile = $this->mobile['cfg_mobile_2'];
		$config = $this->config;
		$url = "http://www.smsbao.com/sms?u=".$mobile["mid"]."&p=".md5($mobile["mpass"])."&m=".$config["mobile"]."&c=".$config['content'];
		$ch2 = curl_init($url);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		$html = curl_exec($ch2);
		$errno = curl_errno($ch2);
		curl_close($ch2);
		if($html>0){
			$errorArray = array(30=>"密码错误",40=>"账号不存在",41=>"余额不足",42=>"帐号过期",43=>"IP地址限制",50=>"内容含有敏感词",51=>"手机号码不正确");
			$error = $errorArray[$html];
			if(empty($error)){
				$error = "发送失败";
			}
			$this->v=$error;
			$this->error=-1;
		}else{
			$this->v="发送成功";
			$this->error=1;
		}
	}

	

	/*短信宝短信其他操作*/

	public function cfg_getdata_2(){
		$this->mobile = System::load_sys_config("mobile");
		$flag = 0; 
		$mobile = $this->mobile['cfg_mobile_2'];	
		if($mobile['mid']==null || $mobile['mpass']==null){
			$this->error=-2;
			$this->v="短信账户或者密码不能为空!";
			return;
		}
		$url = "http://www.smsbao.com/query?u=".$mobile["mid"]."&p=".md5($mobile["mpass"]);
		$ch2 = curl_init($url);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		$html = curl_exec($ch2);
		curl_close($ch2);
		$htmls = split(",",$html);	
		$this->v=$htmls[1];
		$this->error=1;
	 	return array($this->error,$this->v);
}

	

		

	/**********************************************************/

	/**********************************************************/

	/**********************************************************/

	

	

	/*互亿无线短信配置设置*/

	private function cfg_seting_3(){

		return true;

	}

	

	/*互亿无线短信发送*/

	private function cfg_send_3($post_data=null,$target=null,$get_key=null){	

		//cf_tlwl

		//BPPKNes	

		$config = $this->config;

		

		$account = $this->mobile['cfg_mobile_3']['mid'];

		$password = $this->mobile['cfg_mobile_3']['mpass'];

		

		//"您的验证码是：9707。请不要把验证码泄露给其他人。"

		$config['content'] = rawurlencode($config['content']);		

		/*发送短信*/

		if(!$get_key){

			$post_data = "account={$account}&password={$password}&mobile=".$config['mobile']."&content=".$config['content'];

			$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";		

		}

			

		

		

		/*curl*/

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $target);

		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($curl, CURLOPT_NOBODY, true);

		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);

		$return_str = curl_exec($curl);

		curl_close($curl);

		/*curl*/

		

	

		/*xml*/

				$arr = _xml_to_array($return_str);

		/*xml*/

	

		if($get_key){	

			$this->error = $arr['GetNumResult']['code'];

			$this->v = $arr['GetNumResult']['num'];

			return $arr;		

		}

	

	

		/*成功*/

		if($arr['SubmitResult']['code']==2){

			$this->v = $arr['SubmitResult']['msg'];

			$this->error = 1;

		}else{

			$this->v = $arr['SubmitResult']['msg'];

			$this->error = -1;

		}		

		return $arr;

	}

	

	/*互亿无线短信其他操作*/

	public function cfg_getdata_3(){

		

		/*获取条数*/

		$this->mobile = System::load_sys_config("mobile");

		

		$account = $this->mobile['cfg_mobile_3']['mid'];

		$password = $this->mobile['cfg_mobile_3']['mpass'];

		

		$post_data = "account={$account}&password={$password}";

		$target = "http://106.ihuyi.cn/webservice/sms.php?method=GetNum";		

		return	$this->cfg_send_3($post_data,$target,true);		

	}

	

	

	

	/* 郑州商讯短信内容检测 */

	private function mobile_con_check($content=null){

		$this->mobile = $mobile = System::load_sys_config('mobile');

		$mobile = $this->mobile['cfg_mobile_1'];	

		$name = urlencode($mobile['mid']);

		$pwd  = $mobile['mpass'];

		$content = iconv( "UTF-8", "gb2312//IGNORE" ,$content);

		$content = urlencode($content);	

		

		$con_check=fopen("http://www.139000.com/send/checkcontent.asp?name=$name&pwd=$pwd&content=$content","r");

		if(!$con_check){

			fclose($con_check);				

		}

		

		$rets = '';

		while (!feof($con_check)) {				

			$rets .= fgets($con_check,1024);				

		}

					

		if($rets){

				$rets = $this->exp_url($rets);

				if($rets['errid']=='0'){

					return array("1","新短信接口内容合法");

				}else{

					return array("-1","内容检测失败,不能包含:【".$rets['err'].'】');

				}

		}else{

			return array("-1","检测失败");

		}

	

	}

	

	/*URL转数组*/

	private function exp_url($url=''){

		if(!empty($url)){

			$ret = iconv("GB2312","UTF-8",$url);

			$ret = explode("&",$ret);

				foreach($ret as $k=>$v){

					$v = explode("=",$v);

					$ret[$v[0]] = $v[1];

				}

			return $ret;

		}else{

			return false;

		}

		

	}

	/**********************************************************/

	

	

	/*八米短信配置设置*/

	private function cfg_seting_5(){

		$mobile = $this->mobile['cfg_mobile_5'];

		$this->config['content'] = $this->config['content'].$mobile['mqianming'];

		return true;

	}

	

	/*八米短信发送*/

	private function cfg_send_5(){
		$mobile = $this->mobile['cfg_mobile_5'];
		$config = $this->config;
		$url = "http://sms.bamikeji.com:8890/mtPort/mt/normal/send?uid=".$mobile["mid"]."&passwd=".$mobile["mpass"]."&phonelist=".$config["mobile"]."&content=".$config['content'];
		// $ch2 = curl_init($url);
		// curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		// $html = curl_exec($ch2);
		// $errno = curl_errno($ch2);
		// curl_close($ch2);
		$html = '{"bacthseq":"7de089d2829343179d22b81b995a7d34","code":"-1","msg":"提交成功非发送成功~","success":true}';
		$html = json_decode($html);
		if($html->code<0){
			$errorArray = array('-1'=>'uid为空','-2'=>'content为空','-3'=>'passwd','-4'=>'phonelist为空','-5'=>'提交过快','-6'=>'内容过长','-7'=>'号码列表过长','-8'=>'用户id或密码错误','-9'=>'请绑定ip','-10'=>'密码错误请核实','-11'=>'余额不足','-16'=>'短信签名不正确或未签名','-17'=>'手机号码错误');
			$error = $errorArray[$html->code];
			if(empty($error)){
				$error = "发送失败";
			}
			$this->v=$error;
			$this->error=-1;
		}else{
			$this->v="发送成功";
			$this->error=1;
		}
	}

	

	/*八米短信其他操作*/

	public function cfg_getdata_5(){
		$this->mobile = System::load_sys_config("mobile");
		$flag = 0; 
		$mobile = $this->mobile['cfg_mobile_2'];	
		if($mobile['mid']==null || $mobile['mpass']==null){
			$this->error=-2;
			$this->v="短信账户或者密码不能为空!";
			return;
		}
		$url = "http://sms.bamikeji.com:8890/mtPort/account/info?uid=".$mobile["mid"]."&passwd=".$mobile["mpass"];
		$ch2 = curl_init($url);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		$html = curl_exec($ch2);
		curl_close($ch2);
		$htmls = json_decode($html);
		// $htmls = split(",",$html);	
		$this->v=$htmls['availableAmt'];
		$this->error=1;
	 	return array($this->error,$this->v);
	}
	

}