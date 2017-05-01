<?php

/**
 *  param.calss.php 	路由参数处理类
 *
 * @copyright			(C) 2005-2010 BUSY
 * @license				
 * @lastmodify			2012-6-1
 */

class param {				

	private $route_config;
	private $domain;
	private $expstr = '/';
	private $route_url=array();
	private $route=array();	
	private $param_url = '';
	public function __construct() {			
			$this->route_config = System::load_sys_config('param');		
			$this->domain = System::load_sys_config('domain');		
			$this->expstr = System::load_sys_config('system','expstr');		
			$this->prourl();		
			$this->sub_addslashes();
			System::load_sys_class('SystemAction','sys','no');
			SystemAction::set_route_url($this->route_url);
			global $_cfg;
			$_cfg['param_arr'] = $this->route_url;
			$_cfg['param_arr']['url'] = $this->param_url;
			
	
	}
		
	private function prourl(){		
	
		
		if(isset($_SERVER['PATH_INFO']) && ($_SERVER['PATH_INFO']!='/') && !empty($_SERVER['PATH_INFO'])){		
			$this->prourlexp('pathinfo');
			return;
		}
		
		if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){		
			$this->prourlexp('query');
			return;
		}		
		
		if(isset($this->domain[$_SERVER['HTTP_HOST']])){			
			$this->route_url[1] = $this->domain[$_SERVER['HTTP_HOST']]['m'];
			$this->route_url[2] = $this->domain[$_SERVER['HTTP_HOST']]['c'];
			$this->route_url[3] = $this->domain[$_SERVER['HTTP_HOST']]['a'];			
			return;
		}

		if(_is_mobile()){			
			foreach($this->domain as $key=>$v){
				if(isset($v['m']) &&  $v['m'] == 'mobile'){					
					header("location: ".dirname(G_HTTP.$key.$_SERVER['SCRIPT_NAME']));				
				}
			}
			return;
		}
		return;
	}
	
		
	private function prourlexp($type){
		
		switch($type){
			case 'pathinfo' :
				$path = ltrim($_SERVER['PATH_INFO'],'/');
				$path = preg_replace("/^index.php\//i",'',$path);
				$path = rtrim($path,$this->expstr);
			break;
			case 'query' :
				$path = $_SERVER['QUERY_STRING'];
				$path = ltrim($path,'/');
				$path = rtrim($path,$this->expstr);
				if(stripos($path,$this->expstr)===false){					
					$this->route_url[1]=$path;
				}	
			break;
			default :
			break;
		}				
		$this->param_url= $path;
		if(isset($this->route_config['routes'])){		
			if(isset($this->route_config['routes'][$path])){				
				$path=$this->route_config['routes'][$path];
			}else{
				foreach ($this->route_config['routes'] as $key => $val){			
					$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));	
					if (preg_match('#^'.$key.'$#', $path)){
						if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE){
							$val = preg_replace('#^'.$key.'$#', $val, $path);
						}
						$path=$val;
					}
				}				
			}
		}	
			
		$this->route_url=explode($this->expstr,trim($path,$this->expstr));
		array_unshift($this->route_url,NULL);	
		unset($this->route_url[0]);	
		
		$end=end($this->route_url);		
		if(stripos($end,'.')!==false){
			$end=explode('.',$end);
			$this->route_url[count($this->route_url)]=$end[0];
				
		}
		
		
		/*
			preg_match_all("/p(.*)/i", $path,$matches,PREG_SET_ORDER);	
			$this->route_url['p']=$matches[0][1];	
		*/

	}
	
	private function sub_addslashes(){	
		if(!get_magic_quotes_gpc()) {
				$_POST = new_addslashes($_POST);
				$_GET = new_addslashes($_GET);			
				$_REQUEST = new_addslashes($_REQUEST);
				$_COOKIE = new_addslashes($_COOKIE);
				$this->route_url = new_addslashes($this->route_url);
		}
		
	}
	
	/**
	 * 获取模型
	 */
	public function route_m() {		
	
		if(empty($this->route_url[1])){		
			$this->route_url[1]=$this->route_config['default']['m'];
		}		
		define('G_MODULE_PATH',WEB_PATH.'/'.$this->route_url[1]);		
		return $this->route_url[1];
	}

	/**
	 * 获取控制器
	 */
	public function route_c() {
		if(empty($this->route_url[2])){		
			$this->route_url[2]=$this->route_config['default']['c'];
			return $this->route_config['default']['c'];
		}return $this->route_url[2];
	
	}

	/**
	 * 获取事件
	 */
	public function route_a() {
		if(empty($this->route_url[3])){
			$this->route_url[3]=$this->route_config['default']['a'];
			return $this->route_config['default']['a'];
		}return $this->route_url[3];
	
	}	
}
?>