<?php
/**
 * Created by PhpStorm.
 * User: qeeqe
 * Date: 2018/9/8
 * Time: 15:42
 */

namespace app\admin\model;
use app\admin\model\Common;

class Structure extends Common
{
    protected $name = 'admin_structure';
    /**
     * [getDataList 获取列表]
     * @linchuangbin
     * @DateTime  2017-02-10T21:07:18+0800
     * @return    [array]
     */
    public function getDataList()
    {
        $cat = new \com\Category('admin_structure', array('id', 'pid', 'name', 'title'));
        $data = $cat->getList('', 0, 'id');

        return $data;
    }
}
