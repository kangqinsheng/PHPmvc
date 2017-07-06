<?php
namespace util;
use \PDO;
use \PDOException;


require_once 'autoload.php';

/**
 * 通用的数据库帮助类，用于封装
 * 数据库表的通用增删改查方法
 * <p>
 *    1.0版本创建于2016-3-10<br>
 *    提供的功能行为有：<br>
 * </p>
 * @author kqs
 * @version 1.0  
 *
 */
class DBUtil
{
    private $dsn;
    private $username;
    private $passwd;
    private $options=array(PDO::ATTR_ERRMODE=>
       PDO::ERRMODE_EXCEPTION);
    private $dbh;
    
    function __construct(){
        $path = dirname(__FILE__)."/db.xml";
        $parser = simplexml_load_file($path);
        foreach ($parser->database as $db){
            if($db["isuse"] == "true"){
                $this->dsn = $db->dsn;
                $this->username= $db->username;
                $this->passwd = $db->passwd;
                break;
            }
        }
        
    }
    
    
    /**
     * 释放资源
     * @param unknown $dbh
     * @param unknown $pstmt
     */
    public function release(&$dbh,&$pstmt){
        $pstmt = null;
        $dbh = null;
    }
    
    /**
     * 创建PDO对象
     */
    private function createPDO(){
        try {
            $this->dbh = new PDO($this->dsn,
                 $this->username, 
                $this->passwd, 
                $this->options);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
    /**
     * 通用的增删改方法
     * @param $sql : 预编译的SQL语句
     * @param $params:预编译SQL语句中占位符需要填充的数据值,默认值null
     * @return  返回增删改命令执行后受影响的行数，0表示失败
     */
    public function executeUpdate($sql,
        array $params=null,&$count=0){
        $result = 0;  
        try{   
          if($this->dbh==null){
            $this->createPDO();
          }
          $pstmt = $this->dbh->prepare($sql);
          
//           $result = $pstmt->execute($params);       
//           $result = $pstmt->rowCount();
          $result = $pstmt->execute($params);
          $count = $pstmt->rowCount();
//           echo "b=${b}&&result=${result} &&errorcode=".$pstmt->errorCode();
//           if($b && $result==0)
//               $result = 1;
          
          $this->release($this->dbh, $pstmt);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $result;
    }
    
    /**
     * 通用查询方法
     * @param string $sql 要执行的查询语句
     * @param string $returnType 查询返回的结果类型，
     * 如果为null表示返回默认混合数组，否则返回指定类对象的数组
     * @param array $params 查询语句中占位符对应的数据值
     * @param rows 输出参数，用于保存查询结果的行数
     * @return  查询结果数组，如果为null表示没有查询到数据信息
     */
    public function executeQuery($sql,
           $returnType=null,
           array $params=null,&$rows=null){
        $result = null;
        try{
          if($this->dbh == null)
            $this->createPDO();
          $pstmt = $this->dbh->prepare($sql);
          $pstmt->execute($params);
          $rows = $pstmt->rowCount();
          $count = 0;
          while($row = ($returnType?
                $pstmt->fetchObject($returnType):
                $pstmt->fetch()) ){
              $result[$count++] = $row;
          }
          $this->release($this->dbh, $pstmt);
        }catch(PDOException $e){
            echo $e->getMessage()."<br>";
        }
        return $result;
    }
    
    
    
    /**
     * 通用的分页查询方法
     * @param $sql :要执行的查询语句(此查询语句不需要添加limit)
     * @param $currentPage : 查询的当前页
     * @param $pageSize :每页显示的数据量
     * @param &$pages :分页查询的总页数，输出参数
     * @param $returnType :返回类型
     * @param $params : 占位符对应的数据
     * @return 当页的查询结果 
     */
    public function executeQueryByPage(
        $sql,$currentPage,$pageSize,
        &$pages = null,
        $returnType=null,array $params=null){
        $result = null; //返回的结果
        //算总行数
        $rows = $this->getCounts($sql,$params);
        //算总页数
        $pages = (int)($rows%$pageSize==0?
            $rows/$pageSize:$rows/$pageSize+1);
        $sql = $sql." limit "
            .($currentPage-1)*$pageSize.",".
            $pageSize;
        $result = 
           $this->executeQuery($sql,
               $returnType,$params);  
        return $result;
    }
    
    /**
     * 用于统计查询行数的方法
     * @param $sql :要执行的sql语句
     * @param $params :sql语句中占位符的参数值
     * @return 查询的行数
     */
    public function getCounts(
        $sql,array $params=null){
        $arr = explode(" ", $sql);
        $arr[1] = "count(*)";
        $sql = implode(" ", $arr);
        try{
            if($this->dbh == null)
                $this->createPDO();
            $pstmt = $this->dbh->prepare($sql);
            $pstmt->execute($params);
            $rows = $pstmt->fetch()[0];
            $this->release($this->dbh, $pstmt);
        }catch(PDOException $e){
            echo $e->getMessage()."<br>";
        }
        return $rows;
    }
}

?>