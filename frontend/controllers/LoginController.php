<?php
namespace frontend\controllers;

use backend\models\Member;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller{
    public function actions(){
        return [
            'captcha'=>[
                'class'=>'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width'=>100,
                'height'=>40,
                'maxLength'=>2,
                'minLength'=>2
            ],
        ];
    }

    public function actionIndex(){
        if (\Yii::$app->request->isAjax) {

        } else {
            return $this->renderPartial('login');
        }
    }

    public function actionRegister(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            if($member->load(['data'=>\Yii::$app->request->post()],'data') && $member->validate()){
                $member->password=md5($member->password);
                $member->addtime=time();
                if($member->save()){
                    return Json::encode(['code'=>1,'body'=>'注册成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'注册失败']);
                }
            }else{
                return Json::encode(['code'=>3,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->renderPartial('register');
        }
    }
}