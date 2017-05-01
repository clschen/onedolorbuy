<?php 

final class System { 

	public static function &load_sys_class($class_name='',$module='sys',$new='yes'){ 

		static $classes = array(); 

		$path=self::load_class_file_name($class_name,$module); 

		$key=md5($class_name.$path.$new); 

		if (isset($classes[$key])) { return $classes[$key]; } 

		if(file_exists($path)){ 

			include_once $path; 

			if($new=='yes'){ 

				$classes[$key] = new $class_name; 

			}else{ $classes[$key]=true; } return $classes[$key]; 

		}else{ _error('load system class file','The file does not exist'); } 

} 

public static function &load_app_class($class_name='',$module='',$new='yes'){ 

	if(empty($module)){ $module=ROUTE_M; } 

	return self::load_sys_class($class_name,$module,$new); 

} 

public static function load_class_file_name($class_name='',$module='sys'){ 

	static $filename = array(); 

	if(isset($filename[$module.$class_name])) return $filename[$module.$class_name]; 

	if($module=='sys'){ $filename[$module.$class_name]=G_SYSTEM.'libs'.DIRECTORY_SEPARATOR.$class_name.'.class.php'; }

	else if($module!='sys')

	{ $filename[$module.$class_name]=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR.$class_name.'.class.php'; 

	}else{ return $filename[$module.$class_name]; } 

	return $filename[$module.$class_name]; 

} 

public static function load_sys_config($filename,$keys=''){ 

	static $configs = array(); 

	if(isset($configs[$filename]))

		{ 

		if (empty($keys)) { return $configs[$filename]; 

		} 

		else if (isset($configs[$filename][$keys])) { return $configs[$filename][$keys]; }

		else{ return $configs[$filename]; } 

	} 

	if (file_exists(G_CONFIG.$filename.'.inc.php')){ 

		$configs[$filename]=include G_CONFIG.$filename.'.inc.php'; 

		if(empty($keys)){ return $configs[$filename]; }

		else{ return $configs[$filename][$keys]; }

	} 

	_error('load system config file','The file does not exist'); 

} 

public static function load_app_config($filename,$keys='',$module=''){ 
	static $configs = array(); 

	if(isset($configs[$filename])){ 

		if (empty($keys)) { return $configs[$filename]; } 

		else if (isset($configs[$filename][$keys])) { return $configs[$filename][$keys]; }

		else{ return $configs[$filename]; } 

	} 

	if(empty($module)) $module=ROUTE_M; $path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$filename.'.ini.php';
	if (file_exists($path)){ 

		$configs[$filename]=include $path; 

		if(empty($keys)){ return $configs[$filename]; }

		else{ return $configs[$filename][$keys]; } 

	} 

	_error('load app config file','The file does not exist'); 

} 

public static function load_sys_fun($fun_name){ 

	static $funcs = array(); 

	$path=G_SYSTEM.'funcs'.DIRECTORY_SEPARATOR.$fun_name.'.fun.php'; 

	$key = md5($path); 

	if (isset($funcs[$key])) return true; 

	if (file_exists($path)){ 

		$funcs[$key] = true; return include $path; 

		}

	else{ 

	$funcs[$key] = false; 

	_error('load system function file','The file does not exist'); 

	} 

} 

public static function load_app_fun($fun_name,$module=null){ 

	static $funcs = array(); 

	if(empty($module)){ $module=ROUTE_M; } $path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$fun_name.'.fun.php'; 

	$key = md5($path); 

	if (isset($funcs[$key])) return true; 

	if (file_exists($path)){ $funcs[$key] = true; return include $path; }

	else{ _error('load app function file','The file does not exist'); } 

} 

public static function &load_app_model($model_name='',$module='',$new='yes'){ 

	static $models=array(); 

	if(empty($module)){ $module=ROUTE_M; } $key=md5($module.$model_name.$new); 

	if(isset($models[$key])){ return $models[$key]; } $path=G_SYSTEM.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$model_name.'.model.php'; 

	if (file_exists($path)){ 

		include $path; 

		if($new=='yes'){ 

			$models[$key]=new $model_name; 

		}else if($new=='no'){ 

			$models[$key]=true; 

		} return $models[$key]; 

    } 

    _error('load app model file','The file does not exist'); 

} 

public static function CreateApp(){ return self::load_sys_class('application'); } }

?>