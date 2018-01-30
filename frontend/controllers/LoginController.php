<?php
namespace frontend\controllers;

use backend\models\Member;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller{
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;
    public function actions(){
        return [
            'captcha'=>[
                'class'=>'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width'=>100,
                'height'=>40,
                'maxLength'=>4,
                'minLength'=>2,
            ],
        ];
    }

    public function actionIndex(){
        if (\Yii::$app->request->isAjax) {
            $member= new Member();
            if($member->load(['data'=>\Yii::$app->request->post()],'data') && $member->validate()){
                $data['username']=$member->username;
                $data['password']=md5($member->password);
                $info=Member::findOne($data);
                if($info){
                    if($info['active']==1){
                        \Yii::$app->session->set('mid',$info['id']);
                        return Json::encode(['code'=>1,'body'=>'登录成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'账号已被禁用']);
                    }
                }else{
                    return Json::encode(['code'=>3,'body'=>'账号或密码错误']);
                }
            }else{
                return Json::encode(['code'=>4,'body'=>'必填项不能为空']);
            }
        } else {
            return $this->renderPartial('index');
        }
    }

    public function actionRegister(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            if($member->load(['data'=>\Yii::$app->request->post()],'data') && $member->validate()){
                $password=$member->password;
                $repwd=$member->repwd;
                if($password==$repwd) {
                    $member->password = md5($member->password);
                    $member->addtime = time();
                    if ($member->save()) {
                        return Json::encode(['code' => 1, 'body' => '注册成功']);
                    } else {
                        return Json::encode(['code' => 2, 'body' => '注册失败']);
                    }
                }else{
                    return Json::encode(['code'=>3,'body'=>'两次密码输入不一致']);
                }
            }else{
                return Json::encode(['code'=>4,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->renderPartial('register');
        }
    }

    public function actionLogin(){
        return $this->renderPartial('login');
    }

    public function actionLogout(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            if($id){
                \Yii::$app->session->remove('mid');
                return Json::encode(['code'=>1,'body'=>'退出成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'请先登录']);
            }
        }
    }
}