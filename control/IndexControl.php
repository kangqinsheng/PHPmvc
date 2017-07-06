<?php
namespace control;
/**
 * 首页控制器
 * @author Administrator
 *
 */
class IndexControl extends BaseControl
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 首页控制方法
     */
    public function index(){

        $this->req->forward("view/index.php");
    }
}

?>