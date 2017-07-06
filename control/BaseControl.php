<?php
namespace control;

use util\ReqUtil;
use util\RespUtil;
class BaseControl
{
    protected  $req;
    protected  $resp;
    function __construct()
    {
        $this->req = new ReqUtil();
        $this->resp = new RespUtil();
    }
}

?>