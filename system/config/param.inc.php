<?php 
/*
	default  默认访问路由
	routes   自定义路由
*/
return array (
  'default' => array('m' => 'go','c' => 'index','a' => 'init'),  // go/index/init
  'routes' => array(		
			'login' => "member/user/login",
			'login/(:any)' => "member/user/login/$1",
			'admin' => "admin/user/login",
			'uname/(:any)' => 'member/us/uname/$1',
			'userbuy/(:any)' => 'member/us/userbuy/$1',
			'userraffle/(:any)' => 'member/us/userraffle/$1',
			'userpost/(:any)' => 'member/us/userpost/$1',			
			'register/(:any)' => 'member/user/register/$1',
			'register' => 'member/user/register',
			
			'goods/(:any)' => 'go/index/item/$1',
			'dataserver/(:any)' => 'go/index/dataserver/$1',
			'goods_list/(:any)' => 'go/index/glist/$1',
			'goods_list' => 'go/index/glist',
			'goods_lottery' => 'go/index/lottery',
			'goods_lottery/(:any)' => 'go/index/lottery/$1',
			
			'help/(:any)' => 'go/article/show/$1',
			'single/(:any)' => 'go/article/single/$1',
			'link' => 'link/link/init/$1',
			
			's_tag/(:any)' => 'search/index/tag/$1',
			'buyrecord' => 'go/databuyrecord/buyrecord',
			'buyrecordbai' => 'go/databuyrecord/buyrecordbai',
			'group_qq' => 'go/qq_qun',
			'group' => 'group/group/init',
			'group/show/(:any)' => 'group/group/show/$1',
			'group/nei/(:any)' => 'group/group/nei/$1',
			//一元夺宝的接口模块路由    http://域名/app_api/控制器/方法
			// 'apis'=>'apis/',
  )
);
?>