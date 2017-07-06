<?php
use util\FileUtil;
//   require 'DBUtil.php';
//   use util\DBUtil;
//   $db = new DBUtil();
  
//   require 'FileUtil.php';
require 'autoload.php';

  FileUtil::getBasePath();
//   $db->executeUpdate(
//       "update student set sname='aaa' where sid=?",
//       array(99));
  
//   echo $db->executeUpdate(
//       "delete from student where sid in (?,?,?)",
//       array(50,51,49),$rows);
//   echo $rows;
//   echo $db->executeUpdate("update student set sname=?,sex=?,age=?,headimg=? where sid=?",
//       array('jack','女',23,'../imgs/headimgs/stu_1458551701.png',48));
  
//   $n=$db->executeUpdate(
//       "insert into `user`(uname,usex,uage) values(?,?,?)",
//       array("张三","男",19));
//   echo "<br>行数是$n";

//   $users = $db->executeQuery(
//       "select * from `user`","po\\User");
//   echo $rows."<br>";
//   print_r($users);
//    echo $users[0] instanceof User;
//      $users=
//       $db->executeQueryByPage("select * from `user`",
//           2, 3,$cont,"po\\User");
//      print_r($users);
//      echo "<br>$cont";

  
//      $sql = "select * from xxx";
//      $sql1 = "select a,b,c from xxx";
//      $str1 = preg_replace(
//          "/^select.+from/", "select count(*) from", $sql);
//      $str2 = preg_replace(
//          "/^select.+from/", "select count(*) from", $sql1);
     
//      echo $str1."<br>".$str2."<br>";
     
//      $arr = explode(" ", $sql);
//      $arr[1] = "count(*)";
//      $str = implode($arr, " ");
//      echo $str;
     
//   echo $db->getCounts(
//       "select uname from user where usex=?",array("男"));
  
  
  
     
     