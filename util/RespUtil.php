<?php
namespace util;

class RespUtil
{

    function __construct()
    {}
    
    /**
     * 重定向方法
     * @param string $url 重定向url
     * @param array $params 传递参数
     */
    public  function sendRedirect($url,array $params=null){
        if(isset($params)){
            $url.="?";
            foreach ($params as $key=>$value){
                $url.=($key."=".$value."&");
            }
            $url[strlen($url)-1]='';
        }
        header("location:${url}");
    }
}

?>