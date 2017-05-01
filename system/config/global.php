<?php 
global $_cfg; 
define('G_IN_SYSTEM', true); 
define('G_START_TIME', microtime()); 
define('G_HTTP_HOST', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '')); 
define('G_HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''); 
define('G_HTTP',isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');
 if(!defined('G_APP_PATH')){
	define('G_APP_PATH', dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR);} 
	define('G_SELF', pathinfo(__FILE__, PATHINFO_BASENAME)); define("G_SYSTEM",G_APP_PATH.$system_path.DIRECTORY_SEPARATOR); $_cfg['system_dir'] = $system_path; 
	define("G_STATICS",G_APP_PATH.$statics_path.DIRECTORY_SEPARATOR); $_cfg['sstatics_dir'] = $statics_path; define("G_UPLOAD",G_STATICS.'uploads'.DIRECTORY_SEPARATOR); 
	define("G_CONFIG",G_SYSTEM.'config'.DIRECTORY_SEPARATOR); define("G_CACHES",G_SYSTEM.'caches'.DIRECTORY_SEPARATOR); 
	define("G_PLUGIN",G_SYSTEM.'plugin'.DIRECTORY_SEPARATOR); define("G_TEMPLATES",G_STATICS.'templates'.DIRECTORY_SEPARATOR); 
	define("G_WEB_PATH",dirname(G_HTTP.G_HTTP_HOST.$_SERVER['SCRIPT_NAME'])); 
	require G_SYSTEM.'libs/system.class.php'; 
	if(System::load_sys_config('system','index_name') == NULL){
		define("WEB_PATH",G_WEB_PATH); 
	}else{ 
		define("WEB_PATH",G_WEB_PATH.'/'.System::load_sys_config('system','index_name')); 
} 
define("G_UPLOAD_PATH",G_WEB_PATH.'/'.$statics_path.'/uploads'); 
define("G_PLUGIN_PATH",G_WEB_PATH.'/'.$statics_path.'/plugin'); 
define("G_PLUGIN_APP",G_SYSTEM.'plugin'.DIRECTORY_SEPARATOR); 
define('G_GLOBAL_STYLE',G_PLUGIN_PATH.'/style'); $templates=System::load_sys_config('templates',System::load_sys_config('system','templates_name')); 
define("G_STYLE",$templates['dir']); define("G_STYLE_HTML",$templates['html']); 
define("G_TEMPLATES_PATH",G_WEB_PATH.'/'.$statics_path.'/templates'); 
define("G_TEMPLATES_STYLE",G_TEMPLATES_PATH.'/'.G_STYLE); 
define("G_TEMPLATES_CSS",G_TEMPLATES_PATH.'/'.G_STYLE.'/css'); 
define("G_TEMPLATES_MOBILESHAI",G_TEMPLATES_PATH.'/'.G_STYLE.'/css/mobile/shai'); 
define("G_TEMPLATES_JS",G_TEMPLATES_PATH.'/'.G_STYLE.'/js'); 
define("G_TEMPLATES_IMAGE",G_TEMPLATES_PATH.'/'.G_STYLE.'/images'); 
require(dirname(__FILE__)."/class.php");
System::load_sys_fun('global'); 
if(System::load_sys_config('system','error')){_error_handler();} function_exists('date_default_timezone_set') && date_default_timezone_set(System::load_sys_config('system','timezone')); 
$_cfg = System::load_sys_config("system"); 
define('G_ADMIN_DIR',System::load_sys_config("system",'admindir')); 
define('WC_VERSION', System::load_sys_config("version",'version')); 
if(!is_php('5.3')) { set_magic_quotes_runtime(0); } 
$code = strtolower(System::load_sys_config("code",'code')); 
$jstime='';
$yuming = '';
$codes =strrev(substr($code,0,42)); 
for($i=3;$i<=42;$i+=4){$jstime.=substr($codes,$i,1);} for($i=0;$i<=40;$i+=4){$yuming.=substr($codes,$i,3);} 
if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0) { set_time_limit(100); } define('G_CHARSET',System::load_sys_config('system','charset')); 
header('Content-type: text/html; charset='.G_CHARSET); 
unset($templates); 
if(System::load_sys_config('system','gzip') && function_exists('ob_gzhandler')) { 
	ob_start('ob_gzhandler'); 
}else { ob_start();}
?>