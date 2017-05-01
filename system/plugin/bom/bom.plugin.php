<?php
  
//BOM插件, 检测windows下 UTF-8 编码保存
  
	  
  
	 //修改此行为需要检测的目录，点表示当前目录
	if(isset($_GET['dir'])){
		$basedir=$_GET['dir'];
	}else{
		$basedir=".";
	}
	
	//是否自动移除发现的BOM信息。1为是，0为否。
	if(isset($_GET['auto'])){
		$auto=0;
	}else{
		$auto=1;
	}
 
 
    if ($dh = opendir($basedir)) {

		while (($file = readdir($dh)) !== false) {
			if ($file!='.' && $file!='..' && !is_dir($basedir."/".$file)){
				echo "filename: $file ".checkBOM("$basedir/$file")." <br>";
			}
			if ($file!='.' && $file!='..' && is_dir($basedir."/".$file)){
				echo "<a href='?dir=".$basedir."/".$file."'>".$basedir."/".$file."</a><br>";
			}
		}
	
		closedir($dh);
    }
    
    function checkBOM ($filename){
		global $auto;
		$contents=file_get_contents($filename);
		$charset[1]=substr($contents, 0, 1);
		$charset[2]=substr($contents, 1, 1);
		$charset[3]=substr($contents, 2, 1);
		if(ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191) {
			if ($auto==1) {
				$rest=substr($contents, 3);
				rewrite($filename, $rest);
				return ("<font color=red>BOM found, automatically removed.</font>");
			} else {
				return ("<font color=red>BOM found.</font>");
			}
		}else{
			return ("BOM Not Found.");
		}
	}
   

   
  function rewrite ($filename, $data) {
	$filenum=fopen($filename,"w");
    flock($filenum,LOCK_EX);
    fwrite($filenum,$data);
    fclose($filenum);
  }
  
 ?>