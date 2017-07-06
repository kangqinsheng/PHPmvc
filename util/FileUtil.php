<?php
namespace  util;
class FileUtil
{
    
    function __construct()
    {}
    
    /**
     * 获取项目根目录在服务器计算器上的绝对路径
     * @return 绝对路径的字符串
     */
    public static function getBasePath(){
        $path = dirname(__FILE__);
        $path=str_replace("util", "", $path);
        return $path;
    }
    
    /**
     * 获取项目在互联网上的访问路径
     * @return 返回项目的路径字符串
     */
    public static function getWebBasePath(){
        $path = 
          $_SERVER["SERVER_NAME"].":".
        $_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        return dirname($path)."/";
    }
}

?>