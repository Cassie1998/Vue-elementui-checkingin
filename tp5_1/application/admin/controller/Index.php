<?php
/**
 * Created by PhpStorm.
 * User: qeeqe
 * Date: 2018/9/2
 * Time: 14:02
 */

namespace app\admin\controller;
use think\facade\Config;

class Index
{
    public function index(){
        dump(Config::get());
    }

}