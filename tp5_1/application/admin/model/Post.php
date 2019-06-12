<?php
/**
 * Created by PhpStorm.
 * User: qeeqe
 * Date: 2018/9/8
 * Time: 16:26
 */

namespace app\admin\model;

use think\facade\Request;

class Post extends Common
{
    protected $name = 'admin_post';
    protected $createTime = 'create_time';
    protected $updateTime = false;
    protected $autoWriteTimestamp = true;
    protected $insert = [
        'status' => 1,
    ];

    /**
     * [getDataList 获取列表]
     * @linchuangbin
     * @DateTime  2017-02-10T21:07:18+0800
     * @return    [array]
     */
    public function getDataList($keywords)
    {

        $map = [];
        $param= Request::param('keywords');
        if ($param) {
            $map['name'] = ['like', '%'.$keywords.'%'];
        }
        $data = $this->where($map)->select();
        return $data;
    }

    public function getDataList1()
    {
        $cat = new \com\Category('admin_post', array('id', 'pid', 'name'));
        $data = $cat->getList('', 0, 'id');

        return $data;
    }
}
