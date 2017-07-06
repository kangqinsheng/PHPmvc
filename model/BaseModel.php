<?php
use util\DBUtil;
/**
 * 基础模型类
 * @author Administrator
 *
 */
 class BaseModel
{
    protected $db;
    function __construct()
    {
        $this->db = new DBUtil();
    }
}

?>