<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/1/20
 * Time: 22:46
 */

namespace app\admin\model;
use think\facade\Validate;

class Qiandao extends Common
{
    protected $name = 'admin_user';
    protected $createTime ='create_time';
    protected $updateTime = false;
    protected $autoWriteTimestamp= true;
    protected $insert =[
        'status' => 1,
    ];

    public function getDataList($param)
    {
        $data="";
        $validate=Validate::make([
            'id|菜单id'=>'require'
        ]);
        if(!$validate->check($param)){
            $this->error=$validate->getError();
        }else{
            $map=[];
//            $id=$param['id'];
//            $map=['id'=>$id];
//            $test='102001';
//            $map['post_id']=array('eq',$test);

            $list = $this
                ->alias('user')
                ->join('__ADMIN_EQPINDIVIDUAL__ eqpindividual', 'eqpindividual.retailer=user.structure_id', 'LEFT');

            $map=[];
            $id=$param['id'];
            $map=['eqpindividual.id'=>$id];
//            $map[] = ['eqpindividual.id','eq', $param];
            //$map[] = ['id','eq', 30];
            $list=$list
                ->where($map);

            $list = $list
                ->field('user.realname,user.username as user_id,user.post_id,eqpindividual.brand as s_name, eqpindividual.id as id,user.status')
                ->select();

//            $data=$this->where($map)->field('*')->select();
            $data['list'] = $list;

            if(!$data){
                $this->error='暂无该类别的装备型号';
            }
        }//else
        return $data;
    }

    public function login($username, $password, $verifyCode = '', $isRemember = false, $type = false)
    {
        if (!$username) {
            $this->error = '帐号不能为空';
            return false;
        }
        if (!$password){
            $this->error = '密码不能为空';
            return false;
        }
        if (config('IDENTIFYING_CODE') && !$type) {
            if (!$verifyCode) {
                $this->error = '验证码不能为空';
                return false;
            }
            $captcha = new HonrayVerify(config('captcha'));
            if (!$captcha->check($verifyCode)) {
                $this->error = '验证码错误';
                return false;
            }
        }

        $map['username'] = $username;
        $userInfo = $this->where($map)->find();
        if (!$userInfo) {
            $this->error = '帐号不存在';
            return false;
        }
        if (user_md5($password) !== $userInfo['password']) {
            $this->error = '密码错误'.user_md5($password);
            return false;
        }
        if ($userInfo['status'] === 0) {
            $this->error = '帐号已被禁用';
            return false;
        }
        // 获取菜单和权限
        $dataList = $this->getMenuAndRule($userInfo['id']);

        if (!$dataList['menusList']) {
            $this->error = '没有权限';
            return false;
        }

        if ($isRemember || $type) {
            $secret['username'] = $username;
            $secret['password'] = $password;
            $data['rememberKey'] = encrypt($secret);
        }

        // 保存缓存
        session_start();
        $info['userInfo'] = $userInfo;
        $info['sessionId'] = session_id();
        $authKey = user_md5($userInfo['username'].$userInfo['password'].$info['sessionId']);
        $info['_AUTH_LIST_'] = $dataList['rulesList'];
        $info['authKey'] = $authKey;
        cache('Auth_'.$authKey, null);
        cache('Auth_'.$authKey, $info, config('LOGIN_SESSION_VALID'));
        // 返回信息
        $data['authKey']		= $authKey;
        $data['sessionId']		= $info['sessionId'];
        $data['userInfo']		= $userInfo;
        $data['authList']		= $dataList['rulesList'];
        $data['menusList']		= $dataList['menusList'];
        return $data;
    }

//    public function qiandao($param){
//        $data="";
//        $validate=Validate::make([
//            'id|装备id'=>'require',
//            'userId|客户id'=>'require'
//        ]);
//        if(!$validate->check($param)){
//            $this->error=$validate->getError();
//        }else{
//            $id=$param['id'];
//            $eqp=$this->get($id);//get返回的是一个模型对象
//            if(!$eqp){
//                $this->error="该员工不在签到表中";
//                return false;
//            }else{
//                if(($eqp->status)==1){
//                    $this->error="该员工已到场";
//                    return false;
//                }elseif(($eqp->status)==2){
//                    $this->error="该员工请假";
//                    return false;
//                } else{
//                    $eqp->status=1;//将是否租借状态设为1
//                    $eqp->save();
//                    $data="签到成功";
//                    $userId=$param['userId'];
//                    $rentModel=Model('RentBack');
//                    $rentModel->insert($id,$userId);
//                }
//            }//else
//            return $data;
//        }
//    }

    public function getDataById($id = '')
    {
        $data = $this->get($id);
        if (!$data) {
            $this->error = '暂无此数据';
            return false;
        }
        $data['groups'] = $this->get($id)->groups;
        return $data;
    }
//    public function findall()
//    {
//
//        $sql = 'SELECT * FROM admin_user WHERE(structure_id==admin_eqpindividual.retailer)';
//
//        return $this->query($sql);
//    }
}
