<?php
namespace backend\controllers;

use backend\models\Admin;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller{
    public $layout=false;

    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            //$admin= new Admin();
            return Json::encode(['code'=>3,'body'=>'账号或密码错误']);

            /*if($admin->load(\Yii::$app->request->post()) && $admin->validate()) {
                $username = trim(\Yii::$app->request->post('username'));
                $password = trim(\Yii::$app->request->post('password'));
                $data['username']=$username;
                $data['password']=md5($password);
                $info=Admin::find()->where($data)->one();
                if($info){
                    if($info['active'] != 0){
                        $update['last_time'] = time();
                        $update['login_ip'] = \Yii::$app->request->getUserIP();
                        Admin::findOne($info['id'])->save($update);
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
            }*/
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
}