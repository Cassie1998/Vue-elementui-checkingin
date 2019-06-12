<?php
/**
 * Created by PhpStorm.
 * User: 胡小涂
 * Date: 2019/1/19
 * Time: 12:26
 */

namespace app\admin\controller;


class Qingjias extends ApiCommon
{
    public function index()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        if (!isset($param['keywords'])){
            $keywords='';
        } else {
            $keywords = empty($param['keywords'])? $param['keywords']: '';
        }

        $data = $qingjiaModel->getDataList($keywords);
        return resultArray(['data' => $data]);
    }

    public function read()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        //dump($request->param());
        $data = $qingjiaModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '添加成功']);
    }

    public function update()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '编辑成功']);
    }

    public function delete()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->delDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function deletes()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->delDatas($param['ids']);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    public function enables()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->enableDatas($param['ids'], $param['status']);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }

    public function pizhunqingjia()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->pizhunqingjia($param);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }

    public function bohuiqingjia()
    {
        $qingjiaModel = model('Qingjia');
        $param = $this->param;
        $data = $qingjiaModel->bohuiqingjia($param);
        if (!$data) {
            return resultArray(['error' => $qingjiaModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }

}
