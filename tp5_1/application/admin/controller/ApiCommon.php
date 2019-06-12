<?php

namespace app\admin\controller;

use think\Db;
use app\common\controller\Common;
use app\common\adapter\AuthAdapter;

class ApiCommon extends Common
{
    /**
     * 对Restful API接口进行安全性验证
     *
     */
    public function initialize()
    {
        parent::initialize();
        //获取头部信息
        $header = $this->request->header();
        $authKey = $header['authkey'];
        $sessionId = $header['sessionid'];
        $cache = cache('Auth_'.$authKey);

        // 校验sessionid和authKey
        if (empty($sessionId)||empty($authKey)||empty($cache)) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>101, 'error'=>'登录已失效']));
        }
        // 检查账号有效性
        $userInfo = $cache['userInfo'];
        $map['id'] = $userInfo['id'];
        $map['status'] = 1;
        if (!Db::name('admin_user')->where($map)->value('id')) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>103, 'error'=>'账号已被删除或禁用']));
        }
        // 更新缓存
        cache('Auth_'.$authKey, $cache, config('LOGIN_SESSION_VALID'));
        $authAdapter = new AuthAdapter($authKey);

        $ruleName = $this->request->module().'-'.$this->request->controller() .'-'.$this->request->action();
        if (!$authAdapter->checkLogin($ruleName, $cache['userInfo']['id'])) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>102,'error'=>'没有权限']));
        }
        $GLOBALS['userInfo'] = $userInfo;

    }
}