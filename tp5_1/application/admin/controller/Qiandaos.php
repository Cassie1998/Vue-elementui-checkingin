<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/1/20
 * Time: 22:45
 */

namespace app\admin\controller;


class Qiandaos extends ApiCommon{

    public function index()
    {
        cache('demo', '123');
        $qiandaoModel = model('Qiandao');
        $param=$this->param;
//        $keywords = !empty(Request::param('keywords')) ? Request::param('keywords'): '';
//        $page = !empty(Request::param('page')) ? Request::param('page'): '';
//        $limit = !empty(Request::param('limit')) ? Request::param('limit'): '';

        $data = $qiandaoModel->getDataList($param);
        if(!$data){
            return resultArray(['error'=>$qiandaoModel->getError()]);
        }
        return resultArray(['data'=>$data]);
    }

    public function qiandao(){//租借
        $userModel = model('User');

        $param = $this->param;
        $username = $param['username'];
        $password = $param['password'];
        $verifyCode = !empty($param['verifyCode'])? $param['verifyCode']: '';
        $isRemember = !empty($param['isRemember'])? $param['isRemember']: '';
        $data = $userModel->qiandao($username, $password, $verifyCode, $isRemember);
        if (!$data) {
            return resultArray(['error' => $userModel->getError()]);
        }
        return resultArray(['data' => $data]);
    }

    public function read($id)
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => '添加成功']);
    }

    public function update()
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => '编辑成功']);
    }

    public function delete()
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->delDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function deletes()
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->delDatas($param['ids']);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function enables()
    {
        $qiandaoModel = model('Qiandao');
        $param = $this->param;
        $data = $qiandaoModel->enableDatas($param['ids'], $param['status']);
        if (!$data) {
            return resultArray(['error' => $qiandaoModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }
}
