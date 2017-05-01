<?php
defined('G_IN_SYSTEM')or exit("no");

class checkcode extends SystemAction {
	public function image(){	

		$style = $this->segment(4);		

		$style = explode("_",$style);		

		$width = isset($style[0]) ? intval($style[0]) : '';

		$height = isset($style[1]) ? intval($style[1]) : '';

		$color = isset($style[2]) ? $style[2] : '';

		$bgcolor = isset($style[3]) ? $style[3] : '';

		$lenght = isset($style[4]) ? intval($style[4]) : '';

		$type = isset($style[5]) ? intval($style[5]) : '';

		$checkcode=System::load_app_class("checkcodeimg");

		$checkcode->config($width,$height,$color,$bgcolor,$lenght,$type);

		$checkcode->dian(100,$color);

		_setcookie("checkcode",md5(strtolower($checkcode->code)));

		$checkcode->image();

		

		

	}



}



?>