<?php

class response{
    const JSON ='json';
    /**
    *综合方式输出通信数据
    *@param integer $code  状态码
    *@param string $message 提示信息
    *@param array $data 数据
    *@param string $type 数据类型
    *return string
    */
    public static function show($code,$message = '',$data = array(),$type=self::JSON){
        if(!is_numeric($code)){
            return '';
        }

        $type = isset($_GET['format']) ? $_GET['format'] : self::JSON;        

        $result = array(
            'errno' => $code,                  
            'errmsg' => $message,          
            'data' => $data,                    
        );
        if($type == 'json'){
            self::json($code,$message,$data);                     //调用了前面的方法
            exit;
        }elseif($type == 'array'){
            var_dump($result);       //这是为了调试用
        }elseif($type == 'xml'){
            self::xmlRncode($code,$message,$data);       //调用了前面的方法
            exit;
        }else{
                //后续看功能加方法
        }
    }

    /**
    *按json方式输出通信数据
    *@param integer $code  状态码
    *@param string $message 提示信息
    *@param array $data 数据
    *return string
    */
    public static function json($code,$message="",$data=array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'errno' => $code,
            'errmsg' => $message,
            'data' => $data
        );
        echo json_encode($result);
        exit;
    }

    /**
    *按xml方式输出通信数据
    *@param integer $code  状态码
    *@param string $message 提示信息
    *@param array $data 数据
    *return string
    */
    public static function xmlRncode($code,$message='',$data=array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'errno' => $code,
            'errmsg' => $message,
            'data' => $data,
        );
        header("Content-Type:text/xml");    //在页面显示xml格式的数据   不设置就是显示 HTML的
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .="<root>\n";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>\n"; 

        echo $xml;
      }

    public static function xmlToEncode($data){
        $xml = "";$attr = "";
        foreach($data as $k=>$v){
            if(is_numeric($k)){                  //xml 节点不能为数字
                $arrt = "id='{$k}'";
                $k = "item";
            }
            $xml .= "<{$k}{$attr}>";
            $xml .= is_array($v) ? self::xmlToEncode($v) : $v;
            $xml .= "</{$k}>";
        }
        return $xml;
    }
}