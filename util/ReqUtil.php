<?php
namespace util;

class ReqUtil
{

    function __construct()
    {}
    
    /**
     * 请求转发
     * @param string $url 转发资源路径
     * @param array $params 转发数据
     */
    public  function forward($url,array $params=null){
        $url =  FileUtil::getWebBasePath().$url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        
        if(isset($params)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_exec($ch);
        curl_close($ch);
    }
}

?>