<?php
/**
 * Created by PhpStorm.
 * User: JHEP
 * Date: 2018/11/9
 * Time: 14:05
 */

namespace app\admin\model;
use think\facade\Validate;
use think\facade\Request;
use app\admin\model\RentBack;
//use app\admin\model\Common;

class Eqpindividual extends Common
{
    protected $pk='id';
    protected $table="oa_admin_eqpindividual";
    protected $createTime = 'create_time';
    protected $updateTime = false;
    protected $autoWriteTimestamp = true;
    protected $insert = [
        'status' => 0,
    ];

    public function findIdvd($param){//返回对应类别的装备个体

        $data="";
        $validate=Validate::make([
            'menuid|菜单id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $map=[];
            $menuid=$param['menuid'];
            $map=['menuid'=>$menuid];
            $data=$this->where($map)->field('id,name,brand,model,manufacture,price,detail,status,retailer,target')->select();
            if(!$data){
                $this->error='暂无该类别的装备型号';
            }
        }//else
        return $data;
    }//findIdvd

    public function rents($param){
        $data="";
        $validate=Validate::make([
            'ids|装备id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $ids=$param['ids'];
            $res=$this->where($this->getPk(),'in',$ids)
            ->where('status','=',0)
            ->setField('status',1);//get返回的是一个模型对象
            if(!$res){
                $this->error="这些会议暂时无法开始";
            }else{
                $data="会议开始";
                $userId=$param['userId'];
                $rentModel=Model('RentBack');
                //$ids=explode(",",$ids);  //explode用一个字符串分割另一个字符串返回一个数组。
                $rentModel->inserts($ids,$userId);
            }
            return $data;
        }
    }

    public function giveBackAll($param){
        $data="";
        $validate=Validate::make([
            'ids|装备id'=>'require',
            'userId|客户id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $ids=$param['ids'];
            $res=$this->where($this->getPk(),'in',$ids)
                ->where('status','=',1)
                ->setField('status',0);//get返回的是一个模型对象
            if(!$res){
                $this->error="这些会议都已结束";
            }else{
                $data="会议结束";
                $userId=$param['userId'];
                $rentModel=Model('RentBack');
                for($i=0;$i<count($ids);$i++){//不这么写就只能改变一个数据
                    $rentModel->back($ids[$i],$userId);
                }
            }
            return $data;
        }
    }

    public function rent($param){
        $data="";
        $validate=Validate::make([
            'id|装备id'=>'require',
            'userId|客户id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $id=$param['id'];
            $eqp=$this->get($id);//get返回的是一个模型对象
            if(!$eqp){
                $this->error="该会议不在数据库";
                return false;
            }else{
                if(($eqp->status)==1){
                    $this->error="该会议已开始";
                    return false;
                }elseif(($eqp->status)==3){
                    $this->error="该会议已结束";
                    return false;
                } else{
                    $eqp->status=1;//将是否租借状态设为1
                    $eqp->save();
                    $data="会议开始";
                    $userId=$param['userId'];
                    $rentModel=Model('RentBack');
                    $rentModel->insert($id,$userId);
                }
            }//else
            return $data;
        }
    }

    public function giveBack($param){  //归还
        $data="";
        $validate=Validate::make([
            'id|装备id'=>'require',
            'userId|客户id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $id=$param['id'];
            $eqp=$this->get($id);
            if(!$eqp){
                $this->error="该会议不在数据库";
                return false;
            }else{
                if(($eqp->status==0)||($eqp->status==2)){
                    $this->error="该会议未开始";
                    return false;
                } else{
                    $eqp->status=3;//将装备是否被借出状态设置为0
                    $eqp->save();
                    $data="会议结束";
                    $userId=$param['userId'];
                    $rentModel=Model('RentBack');
                    $rentModel->back($id,$userId);
                }
            }
        }
        return $data;
    }

    public function findDetail($param){//返回某一装备的具体信息
        $data="";
        $validate=Validate::make([
           'id|装备id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $id=$param['id'];
            $map=['id'=>$id];
            $data=$this->where($map)->find();
            if(!$data){
                $this->error="该会议不在数据表";
                return false;
            }
            return $data;
        }
    }

    public function enables($param){
        $validate=Validate::make([
            'id|装备id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
            return false;
        }else{
            $id=$param['id'];
            $res=$this->where($this->getPK(),'in',$id)->where('status','=',3)
                ->setField('status',0);//批量启用
            if($res!==false){
                return "批量开始成功";
            }else{
                $this->error="批量结束失败";
                return false;
            }
        }
    }

    public function forbiddens($param){
        $validate=Validate::make([
           'id|装备id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $id=$param['id'];
            $res=$this->where($this->getPK(),'in',$id)->setField('status',3);//批量禁用
            if($res!==false){
                return "批量禁用成功";
            }else{
                $this->error="批量禁用失败";
                return false;
            }
        }
    }

}
