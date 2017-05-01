function scrollFunc(e){
    e=e||window.event;
   if (e&&e.preventDefault){ 
        e.preventDefault();
        e.stopPropagation();
    }else{ 
     e.returnvalue=false;  
     return false;     
    }
}
// 检查密码
var chk_pwd = {
	"passwd":function(val,error){//检查密码是否符合规定，排除弱密码
		if(/[\w\W]{8,20}/.test(val)){
			if(!/^password|qwerasdf|iloveyou|(.)\1{7,19}/.test(val)){
				for(var i=1;i<val.length;i++){
					if(Math.abs(val.charCodeAt(i-1)-val.charCodeAt(i)) != 1){
						return true;
					}
				}
			}
			error.msg = "为保障您的账户安全，禁止使用弱密码";
		}
		return false;
	}
}
// 创建加载闭包
function lockCoverDivMOdel(fn){
	var resultDiv;
	return function(){
		return resultDiv = resultDiv ||(resultDiv = fn.apply(this,arguments));
	}
}
// 创建覆盖层
var creatDiv = lockCoverDivMOdel(function(){
	var dheight = window.innerHeight;
	var div = document.createElement("div");
		div.setAttribute("id","coverDiv");
		div.setAttribute("class","coverDiv");
		div.style.height = dheight;
		
	var str = "<span class='cover_loading_img'><img src="+Img_Path+"/touch/loading.gif width='32px' /></span><div class='cover_opacity_div'></div>";
		div.innerHTML = str ;
	return document.body.appendChild(div);
});
// 请求验证码
function getMvcode($mobile,$type,$channel,$time){
	$subdata = {
		"mobile"   : $mobile,
		"stype"    : ($type?$type:1),
		"deviceid" : localStorage.ssr_deviceid
	}
	$.extend($subdata,ssrTokendeviceid);
	delete $subdata.token;
	var $time = $time?$time:120;
	var $url  = $channel=="weixin"?"/weixin/common/mvcode":"/app/common/mvcode";
	$.post($url,$subdata,function(data){
		if(data.err==0){
			$("#gpc_btn").hide();
			$("#re_get").show();
			$(".form_errors").hide();
			countTime($("#re_get"),$("#gpc_btn"),$("#re_get em"),$time);
		}else{
			$("#error_tips var").html(data.msg);
			$("#error_tips").show();
		}
		if(data.ssid&&ssrTokendeviceid.ssid!=data.ssid){
			ssrTokendeviceid.ssid = data.ssid;
		}
	})
}
// ajax获取数据函数；
function getNewpage(url,$table){
	var $data;
	// 对接受的字段进行数组化处理；
	var strs = url.replace(/\?(.*)?$/,"");
		strs = strs.split("/");
	var $table = $table?$table:(strs.length>3?strs[2]+'_'+strs[3]:strs[2]);
	dataCollectionModel[$table] = dataCollectionModel[$table]||{};
	var $postData = ssrTokendeviceid?ssrTokendeviceid:{};
	$.ajax({
		type : "POST",
		url  : url,
		dataType:"json",
		data : $postData,
		async: false,
		beforeSend: function(){
			creatDiv();
			$("#coverDiv").show();
		},
		complete: function(){
			$("#coverDiv").hide();
		},
		success: function(data){
			$("#coverDiv").hide();
			if(data.err==0){
				for(r in data){
					switch(r){
						case 'msg': 
						case 'err':
						break;
						case 'ssid':
							dataCollectionModel['ssid'] = data['ssid']
						break;
						default:
						// 先判断当前字段和数据是否已经存在
						if(dataCollectionModel[$table][r]){
							if(dataCollectionModel[$table][r].constructor === Array){
								// 后加载的数据为数组，则2个数组合并
								dataCollectionModel[$table][r] = dataCollectionModel[$table][r].concat(data[r]);
							}else if(dataCollectionModel[$table][r].constructor === Object){
								// 后加载的数据为object，则2个对象合并
								$.extend(dataCollectionModel[$table][r], data[r]);
							}else{
								// 否则直接替换
								dataCollectionModel[$table][r] = data[r];
							}
						}else{
							// 不存在直接赋值
							dataCollectionModel[$table][r] = data[r];
						}
					}
				}
			}
			$data = data;
		},
		error : function($msg){
			$data = $msg
			$("#coverDiv").hide();
		}
	})
	return $data;
}

// 滚动加载
function getAjax(url,$table,$scroll){
	var data, Page=1,ajaxKey=false;
	if(!$scroll){
		data = getNewpage(url,$table);
	}else{
		data = getNewpage(url,$table);
		if(data.err==0){
			if(data.count>Page){
				ajaxKey = true;
			}
			page++;
		}
		$(window).scroll(function(){
			var sTop = $(window).scrollTop();
			var height = $(document.body).height();
			var cheight = $(window).height();
			var _url = url+"&page="+page;
			if(sTop+cheight>=height&&ajaxKey){
				getNewpage(_url,$table,true);
			}
		})
	}
}
// 提交数据
function ajaxPost($url,$data,$err){
	var $respons;
	var $err = $err?$err:false;
	$.ajax({
		type:'POST',
		url:$url,
		data:$data,
		dataType:"json",
		async:false,
		success: function($msg){
			if($msg.err!=0&&$err){
				$("#error_tips var").html($msg.msg);
				$("#error_tips").show();
			}
			$respons =$msg;
		},
		error:function(){
			$respons = {err:'fail'};
		}
	})
	return $respons;
}
// 格式化数字
function formatMoney(s, n){  
   n = n > 0 && n <= 20 ? n : 2;  
   s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";  
   var l = s.split(".")[0].split("").reverse(),  
   r = s.split(".")[1];  
   t = "";  
   for(i = 0; i < l.length; i ++ ){  
      t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");  
   }  
   return t.split("").reverse().join("") +(r&&parseInt(r)>0?"."+r:"");  
} 
// 为小于10的数字加0
function addZero(num){
	num = parseInt(num);
	var nums = num<10? "0"+num : num;
	return nums;
}
//验证码倒计时
function countTime(obj1,obj2,timeBox,time){
	$(timeBox).html(time);
	if(time==0){
		$(obj1).hide();
		$(obj2).show();
	}else if(time>0){
		time--;
		setTimeout(function(){countTime(obj1,obj2,timeBox,time)},1000);
	}
}
// 日期倒计时
function countRestTime(time){// 参数time:未来的某个时间点
	if(time===undefined){time=0}
	var restTime = new Date();
		restTime = restTime.getTime();
		restTime = time - parseInt(restTime/1000);
	
	var t_count = {
		minutes : 60,
		hours   : 60*60,
		day     : 60*60*24,
	}
	if(restTime>=0){
		var day 	 =  Math.floor(restTime/t_count.day);
		var hours    =  Math.floor((restTime%t_count.day)/t_count.hours);
		var minutes  =  Math.floor((restTime-day*t_count.day-hours*t_count.hours)/t_count.minutes);
		var seconds  =  Math.floor(restTime-day*t_count.day-hours*t_count.hours-minutes*t_count.minutes);
		// 时间格式化
		day     = addZero(day);
		hours   = addZero(hours);
		minutes = addZero(minutes);
		seconds = addZero(seconds);
	}else{
		var day="00",hours="00",minutes="00",seconds="00";
	}
	// 返回时间
	return {"day":day,"hours":hours,"minutes":minutes,"seconds":seconds}
}
// 格式化输出时间
function formatTime(time,mark,s,n){ 
	//time表示毫秒数 mark表示分隔标记如：“-”，“/”; s表示从哪个位置开始输出，0表示年，n：输出几个时间参数；
	var len = arguments.length;
	// 未输入时间：抓取当前时间
	var $time = len ==0 ? new Date() : new Date(time);
	// 将时间的各个参数组装成数组
	var time_err = [$time.getFullYear(),addZero(parseInt($time.getMonth())+1),addZero($time.getDate()),addZero($time.getHours()),addZero($time.getMinutes()),addZero($time.getSeconds())];
	var m ="-", st=0, end=6;
	// 参数缺省处理
	switch(len){
		case 4 :
			m = mark; st = s>= 5?5:s;end = n >= 6?6:n;
			break;
		case 3 :
			m 		= isNaN(arguments[1])? mark : "-";
			st 	 	= isNaN(arguments[1])? 0 : arguments[1]>=5?5:arguments[1];
			end 	= arguments[2]>=6?6:arguments[2];
			break;
		case 2 :
			m	 = isNaN(arguments[1])? mark : "-";
			st 	 = 0;
			end  = isNaN(arguments[1])? 6 : arguments[1]>=6?6:arguments[1];
			break;
		default:
			m = "-";st = 0; end = 6;
			break;
	}
	// 开始组装字符串
	var rstr = time_err[st];
	for(var i=st+1;i<st+end;i++){
		if(i<3){
			if(m=='w'){
				rstr += (i==1?"年":"月")
			}else{
				rstr += m
			}
		}else if(i==3){
			rstr += " "
		}else{
			// 从小时开始加":"
			rstr += ":"
		}
		rstr += time_err[i];
		if(i==2&&m=='w'){
			rstr += "日";
		}
	}
	return rstr;
}
function loadFiles($url,ele,files){
	// 创建一个iframe,然后在form中提交；
	var $iframe = document.createElement("iframe");
		$iframe.setAttribute("id","loadFiles");
		$iframe.style.display = "none";
	var form = document.createElement("form");
		form.setAttribute('id','upfilesForm');
		form.setAttribute('method','POST');
		form.setAttribute('action',$url);
		form.innerHTML = ele;	
		
		form.submit();
}
// 排序函数
function sortNum(a,b){
	return a - b;
}
// 数组最大值
Array.prototype.max = function(){
	var arr = this;
	var $num = arr[0];
	for(var i=1;i<arr.length;i++){
		if(arr[i]>$num){
			$num = arr[i]
		}
	}
	return $num;
} 
// 数组最小值
Array.prototype.min = function(){
	var arr = this;
	var $num = arr[0];
	for(var i=1;i<arr.length;i++){
		if(arr[i]<$num){
			$num = arr[i]
		}
	}
	return $num;
}
// 获取元素在数组中的下标，如果不存在，返回-1； 
Array.prototype.elIndex = function(str){
	var arr = this,i;
	if(str.constructor === Array){
		var ele = str,key = true;
		for(i=0;i<arr.length;i++){
			if(arr[i].constructor === Array){
				for(var j=0;j<arr.length;j++){
					if(arr[i][j]!=str[j])
					key =false;
				}
				return (key?i:-1);
			}
		}
		return -1; 
	}else{
		for(i=0;i<arr.length;i++){
			if(arr[i]==str){
				return i;
			}
		}
	}
	return -1;
}
// 监听回车键，提交
document.onkeydown = function(e){
	e = window.e || e;
	key = e.keyCode || e.keyChar || e.which;
	
	// 回车提交表单
	if(key == 13){
		$("#submit").click();
	}
}
