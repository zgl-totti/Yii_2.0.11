<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/1
 * Time: 15:33
 */

namespace common\controllers;


use app\common\services\AppLogService;
use app\common\services\UriService;

class CommonController extends BaseController
{
    public $userInfo=null;

    public $allowActions=[
        'login/index',
    ];

    public function beforeAction($action)
    {
        $is_login=$this->checkLogin();

        if(in_array($action->getUniqueId(),$this->allowActions)){
            return true;
        }

        if(!$is_login){
            if(\Yii::$app->request->isAjax){
                $this->renderJson([],'未登录',401);
            }else{
                $this->redirect(UriService::buildWwwUrl('login/index'));
            }
            return false;
        }

        //记录所有用户访问
        AppLogService::addAppAccessLog($this->userInfo['user_id']);

        return true;
    }

    private function checkLogin()
    {
        $auth_cookie=$this->getCookie('user_id','');
        if(!$auth_cookie){
            return false;
        }

        list($auth_token,$uid)=explode('#',$auth_cookie);
        if(!$auth_token || !$uid){
            return false;
        }

        if(!preg_match("/^\d$/",$uid)){
            return false;
        }

        $info=User::findOne($uid);
        if(!$info || $info->status != 1){
            return false;
        }

        //$auth_token_md5=md5($info['login_name'].$info['login_pwd'].$info['login_salt']);
        if($auth_token != $this->getAuthToken($info)){
            return false;
        }

        $this->userInfo=$info;
        return true;
    }

    public function getAuthToken($info)
    {
        return md5($info['login_name'].$info['login_pwd'].$info['login_salt']);
    }
}