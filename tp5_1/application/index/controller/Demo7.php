<?php
/**
 * Created by PhpStorm.
 * User: qeeqe
 * Date: 2018/9/3
 * Time: 8:57
 */

namespace app\index\controller;


class Demo7 extends \think\Controller
{
    public function test1(){
        $content ='<h3 style="color: red;">你好</h3> ';
        return $this->display($content);
    }
    public function _list(){

    }


}