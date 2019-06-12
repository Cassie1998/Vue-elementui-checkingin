<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/1/20
 * Time: 23:01
 */

namespace app\admin\validate;
use think\Validate;

class Qiandao extends Validate
{
    protected $rule=[
        'id|菜单id'=>'require',
        'name|装备名称'=>'require',
        'status|状态'=>'require',
    ];
}
