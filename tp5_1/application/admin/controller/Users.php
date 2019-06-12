<?php
/**
 *
 */
namespace app\admin\controller;
use think\facade\Request;

class Users extends ApiCommon {
    /**
     * URL访问通过GET的方法将数据传到控制器的指定的方法中，但只能传递字符串，数值
     * 依赖注入解决了向类的方法中传递对象的问题
     */

//    public function index1()
//    {
//        cache('demo', '123');
//        $qiandaoModel = model('user');
//        $param=$this->param;
////        $keywords = !empty(Request::param('keywords')) ? Request::param('keywords'): '';
////        $page = !empty(Request::param('page')) ? Request::param('page'): '';
////        $limit = !empty(Request::param('limit')) ? Request::param('limit'): '';
//
//        $data = $qiandaoModel->getDataList1($param);
//        if(!$data){
//            return resultArray(['error'=>$qiandaoModel->getError()]);
//        }
//        return resultArray(['data'=>$data]);
//    }

    public function index()
    {
        $userModel = model('User');

        $keywords = !empty(Request::param('keywords')) ? Request::param('keywords'): '';
        $page = !empty(Request::param('page')) ? Request::param('page'): '';
        $limit = !empty(Request::param('limit')) ? Request::param('limit'): '';

        $data = $userModel->getDataList($keywords, $page, $limit);
        return resultArray(['data' => $data]);
    }
    public function read($id)
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => '添加成功']);
    }

    public function update()
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => '编辑成功']);
    }

    public function delete()
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->delDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function deletes()
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->delDatas($param['ids']);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function enables()
    {
        $userModel = model('User');
        $param = $this->param;
        $data = $userModel->enableDatas($param['ids'], $param['status']);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }

}
