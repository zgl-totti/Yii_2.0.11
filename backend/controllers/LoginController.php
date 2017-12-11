<?php
namespace backend\controllers;

use backend\models\Admin;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller{
    public $layout=false;

    public function actions(){
        return [
            'captcha'=>[
                'class'=>'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,  //刷新验证码
                'backColor'=> 0x000000,      //背景颜色
                'foreColor' => 0xffffff,     //字体颜色
                'width'=>100,
                'height'=>50,
                'maxLength'=>4,
                'minLength'=>3,
                'padding' => 4,
            ],
        ];
    }

    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            $admin= new Admin();
            if($admin->load(\Yii::$app->request->post()) && $admin->validate()) {
                $data['username']=$admin->username;
                //$data['password']=\Yii::$app->security->generatePasswordHash($admin->password);
                $data['password']=md5($admin->password);
                $info=Admin::findOne($data);
                if($info){
                    if($info['active'] != 0){

                        /*$update['logintime'] = time();
                        $update['loginip'] = \Yii::$app->request->getUserIP();
                        $info->load($update);
                        $info->save();*/

                        $info->logintime=time();
                        $info->loginip=\Yii::$app->request->getUserIP();
                        $info->save();

                        \Yii::$app->session->set('aid',$info['id']);
                        return Json::encode(['code'=>1,'body'=>'登录成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'账号已停权']);
                    }
                }else{
                    return Json::encode(['code'=>3,'body'=>'账号或密码错误']);
                }
            }else{
                return Json::encode(['code'=>4,'body'=>$admin->getErrors()]);
            }
        }else{
            $admin= new Admin();
            return $this->render('login',['info'=>$admin]);
        }
    }

    public function actionLogout(){
        if(\Yii::$app->request->isAjax){
            if(\Yii::$app->session->remove('aid')){
                return Json::encode(['code'=>1,'body'=>'成功退出']);
            }else{
                return Json::encode(['code'=>2,'body'=>'退出失败']);
            }
        }
    }

    public function actionRoma(){
        $a='admin';
        $data['username']=$a;
        $data['password']=md5($a);
        $info=Admin::findOne($data);
        if($info) {
            print_r($info);
        }
    }
}