<?php
/**
 * Created by PhpStorm.
 * User: JHEP
 * Date: 2018/11/10
 * Time: 9:43
 */

namespace app\admin\validate;
use think\Validate;

class Eqpindividual extends Validate
{
    protected $rule=[
        'menuid|菜单id'=>'require',
        'name|装备名称'=>'require',
        'status|状态'=>'require',
    ];
}