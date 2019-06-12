<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/*
Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];*/


Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::group('admin', [
    // 【基础】登录
    'base/login' => ['admin/base/login', ['method' => 'POST|OPTIONS']],
    // 【基础】记住登录
    'base/relogin'	=> ['admin/base/relogin', ['method' => 'POST|OPTIONS']],
    // 【基础】修改密码
    'base/setInfo' => ['admin/base/setInfo', ['method' => 'POST|OPTIONS']],
    // 【基础】退出登录
    'base/logout' => ['admin/base/logout', ['method' => 'POST|OPTIONS']],
    // 【基础】获取配置
    'base/getConfigs' => ['admin/base/getConfigs', ['method' => 'POST|GET|OPTIONS']],
    // 【基础】获取验证码
    'base/getVerify' => ['admin/base/getVerify', ['method' => 'GET']],
    // 【基础】上传图片
    'upload' => ['admin/upload/index', ['method' => 'POST|OPTIONS']],
    // 保存系统配置
    'systemConfigs' => ['admin/systemConfigs/save', ['method' => 'POST|OPTIONS']],
    // 【规则】批量删除
    'rules/deletes' => ['admin/rules/deletes', ['method' => 'POST|OPTIONS']],
    // 【规则】批量启用/禁用
    'rules/enables' => ['admin/rules/enables', ['method' => 'POST|OPTIONS']],
    // 【用户组】批量删除
    'groups/deletes' => ['admin/groups/deletes', ['method' => 'POST|OPTIONS']],
    // 【用户组】批量启用/禁用
    'groups/enables' => ['admin/groups/enables', ['method' => 'POST|OPTIONS']],
    // 【用户】批量删除
    'users/deletes' => ['admin/users/deletes', ['method' => 'POST|OPTIONS']],
    // 【用户】批量启用/禁用
    'users/enables' => ['admin/users/enables', ['method' => 'POST|OPTIONS']],
    'users/index1' => ['admin/users/index1', ['method' => 'POST|OPTIONS']],
    // 【菜单】批量删除
    'qiandaos/index' => ['admin/qiandaos/index', ['method' => 'POST|OPTIONS']],
    // 【用户】批量启用/禁用
    'qiandaos/read' => ['admin/qiandaos/read', ['method' => 'POST|OPTIONS']],
    // 【用户】批量启用/禁用
    'qiandaos/deletes' => ['admin/qiandaos/deletes', ['method' => 'POST|OPTIONS']],
    // 【用户】批量启用/禁用
    'qiandaos/enables' => ['admin/qiandaos/enables', ['method' => 'POST|OPTIONS']],
    // 【菜单】批量删除
    'menus/deletes' => ['admin/menus/deletes', ['method' => 'POST|OPTIONS']],
    // 【菜单】批量启用/禁用
    'menus/enables' => ['admin/menus/enables', ['method' => 'POST|OPTIONS']],
    // 【组织架构】批量删除
    'structures/deletes' => ['admin/structures/deletes', ['method' => 'POST|OPTIONS']],
    // 【组织架构】批量启用/禁用
    'structures/enables' => ['admin/structures/enables', ['method' => 'POST|OPTIONS']],
    // 【部门】批量删除
    'posts/deletes' => ['admin/posts/deletes', ['method' => 'POST|OPTIONS']],
    // 【部门】批量启用/禁用
    'posts/enables' => ['admin/posts/enables', ['method' => 'POST|OPTIONS']],
    // 【设备】设备租借
    'eqptype/rent' => ['admin/eqptype/rent', ['method' => 'POST|OPTIONS']],
    // 【设备】设备归还
    'eqptype/giveback' => ['admin/eqptype/giveback', ['method' => 'POST|OPTIONS']],
    // 【设备】设备详细信息
    'eqptype/findDetail' => ['admin/eqptype/findDetail', ['method' => 'POST|OPTIONS']],
    // 【设备】批量删除
    'eqptype/deletes' => ['admin/eqptype/deletes', ['method' => 'POST|OPTIONS']],
    // 【设备】批量租借
    'eqptype/rents' => ['admin/eqptype/rents', ['method' => 'POST|OPTIONS']],
    // 【设备】批量归还
    'eqptype/giveBackAll' => ['admin/eqptype/giveBackAll', ['method' => 'POST|OPTIONS']],
    // 【设备】设备租借信息
    'eqptype/selectRB' => ['admin/eqptype/selectRB', ['method' => 'POST|OPTIONS']],
    'eqptype/WriteQian' => ['admin/eqptype/WriteQian', ['method' => 'POST|OPTIONS']],
])->header('Access-Control-Allow-Credentials', 'true')
    ->header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, sessionId, authKey')
    ->allowCrossDomain();

/**
 * allowCrossDomain();方法被使用时，会带上不需要自己定义OPTIONS请求的路由，系统会自动加上。跨域请求系统会默认带上一些Header，包括：
 * Access-Control-Allow-Origin:*
 * Access-Control-Allow-Methods:GET, POST, PATCH, PUT, DELETE
 * Access-Control-Allow-Headers:Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With
 */



Route::allowCrossDomain()->header(
    [
        'Access-Control-Allow-Origin'=>'*',
        'Access-Control-Allow-Credentials'=> 'true',
        'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, DELETE',
        'Access-Control-Allow-Headers'=> 'Origin, X-Requested-With, Content-Type, Accept, sessionId, authKey ',
    ]
);

return [
// 定义资源路由
    '__rest__'=>[
        'admin/rules'		   =>'admin/rules',
        'admin/groups'		   =>'admin/groups',
        'admin/users'		   =>'admin/users',
        'admin/menus'		   =>'admin/menus',
        'admin/structures'	   =>'admin/structures',
        'admin/posts'          =>'admin/posts',
        'admin/eqptype'        =>'admin/eqptype',
        'admin/upload'         =>'admin/upload',
        'admin/qiandaos'         =>'admin/qiandaos',
    ],

    // MISS路由
    '__miss__'  => 'admin/base/miss',
    ];
