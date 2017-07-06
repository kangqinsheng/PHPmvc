<?php

  use util\FileUtil;
  require 'util/autoload.php';

  $control=null;$method=null;
  $mark = isset($_GET["mark"])?
  $_GET["mark"]:(isset($_POST["mark"])?$_POST["mark"]:"index");
  $jsonTxt =  file_get_contents(
    FileUtil::getBasePath()."composer.json");
  $context =  json_decode($jsonTxt);
  $arr = $context->urlpatterns->$mark;
  $control = $arr[0];
  $method = $arr[1];
  $co = new $control();
  $co->$method();