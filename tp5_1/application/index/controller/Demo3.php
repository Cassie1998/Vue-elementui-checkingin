<?php

namespace app\index\controller;

use think\facade\Request;  //导入请求对象的静态代理



/**
 * 控制器输出用return。
 * 如果是复杂输出，用dump
 * 默认输出格式 为html，可以指定为其它格式如json
 *
 * 1、传统的new request
 * 2、静态代理 think/facede/Request
 * 3、依赖注入 test(Request $request)
 * 4、父类中的属性$this->request;
 */

class Demo3 extends \think\Controller
{
    public function test()
    {
        return json_encode($this->request->get());
    }
}