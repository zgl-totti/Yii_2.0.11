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
                'width'=>300,
                'height'=>40,
                'maxLength'=>4,
                'minLength'=>4
            ],
        ];
    }

    /**清除公共布局
     * (non-PHPdoc)
     *  * @see \yii\web\Controller::beforeAction()
     *  */
    /*public function beforeAction($action){
        if(!parent::beforeAction($action)){
            return false;
        }
        if($action->id=='login' or $action->id=='reset'){
            $this->layout=false;
        }
        return true;
    }*/

    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            $admin= new Admin();
            if($admin->load(\Yii::$app->request->post()) && $admin->validate()) {
                $data['username']=$admin->username;
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