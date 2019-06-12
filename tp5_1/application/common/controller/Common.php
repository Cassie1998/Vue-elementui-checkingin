<?php


namespace app\common\controller;
use think\Controller;

/**
 * 解决跨域问题,目前不用
 */
class Common extends Controller
{
    public $param;
    public function initialize()
    {
        parent::initialize();
        $this->param = $this->request->param();
    }

}