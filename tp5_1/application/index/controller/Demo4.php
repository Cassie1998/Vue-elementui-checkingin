<?php


namespace app\index\controller;
use think\db;

/**
 *   1、连接数据库 全局配置
 *   2、动态配置 \think\db\query中的
 * 3、DSN连接：数据库类型://用户名：密码@数据库地址：端口号//数据库名称#字符集
 *
 */
class Demo4
{
    public function conn1(){
        //dump(db::table('wp_area')->where('title','eq','上海')->select());

    }
    public function conn2(){
       dump( db::connect([
           'type'=>'mysql',
            'database' =>'weiphp',
            'hostname' =>'127.0.0.1',
           'username'=>'root',
           'password'=>'123',
        ])->table('wp_area')->where('title','eq','上海')->value('id'));
    }
}