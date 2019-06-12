<?php
/**
 * Created by PhpStorm.
 * User: JHEP
 * Date: 2018/10/21
 * Time: 15:30
 */

namespace app\admin\controller;


class Eqptype extends ApiCommon
{
    public function index(){
        cache('demo', '123');
        $idvdModel=model('Eqpindividual');
        $param=$this->param;//返回对应的装备菜单id
        $data=$idvdModel->findIdvd($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>$data]);
    }

//    public function WriteQian(){
//        cache('demo', '123');
//        $idvdModel=model('Qiandao');
//        $param=$this->param;//返回对应的装备菜单id
//        $data=$idvdModel->getDataList($param);
//        $data=$idvdModel->createData($data);
//        if(!$data){
//            return resultArray(['error'=>$idvdModel->getError()]);
//        }
//        return resultArray(['data'=>$data]);
//    }

    public function selectRB(){  //查询指定装备的租借记录
        $rbModel=Model('RentBack');
        $param=$this->param;//装备id,[num可选传参，设定显示的租借记录条数]
        $data=$rbModel->selectRB($param);
        if(!$data){
            return resultArray(['error'=>$rbModel->getError()]);
        }
       // return $data;
        return resultArray(['data'=>$data]);
    }

    public function rents(){//批量租借
        $idvdModel=Model('Eqpindividual');
        $param=$this->param;//返回批量租借的装备id,和用户id
        $data=$idvdModel->rents($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>$data]);
    }

    public function giveBackAll(){//批量归还
        $idvdModel=Model('Eqpindividual');
        $param=$this->param;//返回批量归还的装备id,用户id
        $data=$idvdModel->giveBackAll($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>$data]);
    }

    public function rent(){//租借
        $idvdModel=Model('Eqpindividual');
        $param=$this->param;//获取要租借的装备id,用户id
        $data=$idvdModel->rent($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>$data]);
    }

    public function giveBack(){//归还
        $idvdModel=Model('Eqpindividual');
        $param=$this->param;//返回需要归还的装备id,用户id
        $data=$idvdModel->giveBack($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }else{
            return resultArray(['data'=>$data]);
        }
    }

    public function findDetail(){
        $idvdModel=Model('Eqpindividual');
        $param=$this->param;//返回需要查询详细信息的装备id
        $data=$idvdModel->findDetail($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }else{
            return resultArray(['data'=>$data]);
        }
    }

    public function save(){
        $idvdModel=model('Eqpindividual');
        $param=$this->param;//$param返回添加的设备的信息
        $data=$idvdModel->createData($param);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>'添加成功']);
    }

    public function delete(){//删除单个
        $idvdModel=model('Eqpindividual');
        $param=$this->param;//返回要删除装被种类的id
        $data=$idvdModel->delDataById($param['id']);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>'删除成功']);
    }

    public function deletes(){
        $idvdModel=model('Eqpindividual');
        $param=$this->param;//返回要删除的id们，也是个数组
        $data=$idvdModel->delDatas($param['ids']);
        if(!$data){
            return resultArray(['error'=>$idvdModel->getError()]);
        }
        return resultArray(['data'=>'批量删除成功']);

    }

    public function update(){
        $typeModel=model('Eqpindividual');
        $param=$this->param;//返回编辑后的装备id，以及其他信息
        $data=$typeModel->updateDataById($param,$param['id']);
        if(!$data){
            return resultArray(['error'=>$typeModel->getError()]);
        }
        return resultArray(['data'=>'编辑成功']);
    }


}
