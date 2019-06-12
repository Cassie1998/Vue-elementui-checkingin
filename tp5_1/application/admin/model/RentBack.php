<?php
/**
 * Created by PhpStorm.
 * User: JHEP
 * Date: 2018/12/9
 * Time: 15:51
 */

namespace app\admin\model;
use think\facade\Validate;
use think\facade\Request;

class RentBack extends Common
{
    protected $pk='id';
    protected $table="oa_admin_rentback";
    //public function find
    public function insert($id,$userId){//插入一条租借记录
        $this->eqp_id=$id;
        $this->user_id=$userId;
        $this->create_time=time();
        $this->save();
    }
    public function back($id,$userId){//归还时更新租借记录
        $time=time();
        $this->where('eqp_id','=',$id)->where('user_id','=',$userId)
            ->where('status','=',0)->order('create_time')
            ->limit(1)->update(['status'=>1,'update_time'=>$time]);
    }
    public function inserts($ids,$userId){
        $equ=[];
        for($i=0;$i<count($ids);$i++){
            $equ[]=['eqp_id'=>$ids[$i],'user_id'=>$userId,'create_time'=>time()];
        }
        $this->saveAll($equ);
    }
    public function selectRB($param){  //查询指定id装备的租借记录，默认返回五条记录
        $id=$param['id'];
        $num=2;
        if(isset($param['num'])){
            $num=$param['num'];
        }
        $data="";
        $data=$this->where('eqp_id','=',$id)->limit($num)
            ->order('create_time','desc')->select();
        if(!$data){
            $this->error="没有这个装备的租借记录";
        }
        return $data;
    }

}