<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);
class auto_register extends admin {
	private $db;
	private $categorys;
	public function __construct(){		
		parent::__construct();		
		$this->db=System::load_app_model('admin_model');
	}
	
	public function show(){
		include $this->tpl(ROUTE_M,'auto_register');
	}
	public function fileaction(){
	set_time_limit(0);
	ignore_user_abort(true);//检测用户断开
	if (!empty ( $_FILES ['file'] ['name'] )){
	    $tmp_file = $_FILES ['file'] ['tmp_name'];
	    $file_types = explode ( ".", $_FILES ['file'] ['name'] );
	    $file_type = $file_types [count ( $file_types ) - 1];
	     /*判别是不是.xls文件，判别是不是excel文件*/
	     if ($file_type !== "xls"){
	          _message( '不是Excel文件，重新上传');
	     }
	     $savePath = './statics/uploads/excel/';
	     $str = date ( 'Ymdhis' );
	     $file_name = $str . "." . $file_type;
	     /*是否上传成功*/
	     if (!move_uploaded_file($_FILES['file']['tmp_name'],$savePath.$file_name)){
	         _message( '上传失败！');
	      }
	      $res = $this->read($savePath . $file_name);
	      unset($res[1]);
	}else{
		 _message( '附件不能为空！');
	}
	$tems  = 0;     
	foreach ($res as $k => $v) {
		$username = $v[0];//用户名
		$password = $v[1];//密码
		$email = isset($v[2])?$v[2]:-1;//邮箱
		$mobile = isset($v[3])?$v[3]:-1;//手机
		if(!$password){
			$password =md5('111111');
		}else{
			$password =md5($password);
		}
		$member_e = array();
		$member_m = array();
		$time = time();
		if($email != -1 ){
			if( _checkemail($email)){
				$member_e=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `email` = '$email' LIMIT 1");	
			}
		}
		if($mobile != -1 ){
			if(_checkmobile($mobile)){
				$member_m=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$mobile' LIMIT 1");
			}
		}
		if(is_array($member_e)){
			if(!is_array($member_m)){
				$this->db->Query("INSERT INTO `@#_member`(username,password,mobile,img,emailcode,mobilecode,time,auto_user)VALUES('$username','$password','$mobile','photo/member.jpg','-1','1','$time','1')");
				$tems++;
			}
		}else{
			if(is_array($member_m)){
				$this->db->Query("INSERT INTO `@#_member`(username,password,email,img,emailcode,mobilecode,time,auto_user)VALUES('$username','$password','$email','photo/member.jpg','1','-1','$time','1')");
			}else{
				$this->db->Query("INSERT INTO `@#_member`(username,password,email,mobile,img,emailcode,mobilecode,time,auto_user) VALUES ('$username','$password','$email','$mobile','photo/member.jpg','1','1','$time','1')");
			}
			
			$tems++;
		}
	}
	//输出自动注册成功条数
	_message("批量执行成功了：".$tems."条");
}	

public function read($filename,$encode='utf-8'){
	include_once(dirname(dirname(dirname(dirname(__FILE__)))).'/statics/plugin/PHPexcel/PHPExcel.php');
          $objReader = PHPExcel_IOFactory::createReader('Excel5');
          $objReader->setReadDataOnly(true);
          $objPHPExcel = $objReader->load($filename);
          $objWorksheet = $objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow();
           	$highestColumn = $objWorksheet->getHighestColumn();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	$temp  = array();
	for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
	    for ($column = 0; $column < $highestColumnIndex; $column++) {//列数是以A列开始
	       $temp[$row][] =$objWorksheet->getCellByColumnAndRow($column,$row)->getValue();
	    }
	}
        return $temp;
 }    



}