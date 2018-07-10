<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/1
 * Time: 14:38
 */

namespace common\controllers;


use app\common\services\UriService;

class LoginController extends CommonController
{
    public function actionIndex()
    {
        if(\Yii::$app->request->isGet){
            return $this->render('');
        }

        $login_name=trim($this->post('login_name',''));
        $login_pwd=trim($this->post('login_pwd',''));
        if(!$login_name || !$login_pwd){
            return $this->renderJs('请输入正确的用户名和密码',UriService::buildWwwUrl('login/index'));
        }

        $info=User::find()->where('login_name',$login_name)->one();
        if(!$info){
            return $this->renderJs('请输入正确的用户名和密码',UriService::buildWwwUrl('login/index'));
        }

        $auth_pwd=md5($login_pwd.md5($info['login_salt']));
        if($auth_pwd != $info['login_pwd']){
            return $this->renderJs('请输入正确的用户名和密码',UriService::buildWwwUrl('login/index'));
        }

        //$auth_token=md5($info['login_name'].$info['login_pwd'].$info['login_salt']);
        $auth_token=$this->getAuthToken($info);
        $this->setCookie('user_id',$auth_token.'#'.$info['user_id']);

        return $this->render('index');
    }

    public function actionLogout()
    {
        $this->removeCookie('user_id');
        return $this->redirect(UriService::buildWwwUrl('login/index'));
    }

    public function actionEdit()
    {
        if(\Yii::$app->request->isPost){
            $user_id=$this->post('user_id',0);
        }

        $userInfo=$this->userInfo;
        return $this->render('',compact('userInfo'));
    }

}