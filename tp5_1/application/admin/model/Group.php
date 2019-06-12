<?php
/**
 * Created by PhpStorm.
 * User: qeeqe
 * Date: 2018/9/8
 * Time: 16:03
 */

namespace app\admin\model;
use app\admin\model\Common;

class Group extends Common
{
    protected $name = 'admin_group';

    public function getDataList(){
        $cat = new \com\Category('admin_group',array('id','pid','title','title'));
        $data = $cat->getList('',0,'id');
        return $data;
    }
}
