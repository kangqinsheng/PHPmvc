<?php
  
  

  spl_autoload_register(function($className){
     
      //获取当前文件的绝对路径
      //echo __FILE__."<br>";
      //获取当前文件autoload.php的绝对路径，并去掉该路径
      //中文件部分，保留目录
      $path = dirname(__FILE__);
      
      //echo $path."<br>";
      //查找(从后往前)$path中最后一个\util的位置
      $index = strrpos($path,"\\util");
      //从$path中截取字符串(从开头截取到最后一个\为止)，并
      //和传入的类名进行拼接,最后再拼接文件后缀".php"
      if($className == "BaseModel")
          $className = "model\\".$className;
      $newPath = substr($path, 0,$index+1)
          .$className.".php";
      
      //echo "c=${className} p=".$newPath."<br>";
      //echo $newPath;
      require_once $newPath;

  });
  
  