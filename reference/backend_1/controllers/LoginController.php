<?php
namespace backend\controllers;

use backend\models\Admin;
use yii\helpers\Json;
use yii\web\Controller;

class LoginController extends Controller{
    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            $username=trim(\Yii::$app->request->post('user_name'));
            $password=trim(\Yii::$app->request->post('password'));
            if($username && $password){
                $data['user_name']=$username;
                $data['password']=md5($password);
                $admin=new Admin();
                $info=$admin->getOne($data);
                if(!$info){
                    $aid=\Yii::$app->session->get('aid');
                    if($aid!=$info['id']){
                        \Yii::$app->session->set('aid', $info['id']);
                        $condition['id'] = $info['id'];
                        $update['last_time'] = time();
                        $update['login_ip'] = \Yii::$app->request->getUserIP();
                        $admin->edit($condition, $update);
                        $res['status'] = 1;
                        $res['info'] = '登录成功！';
                        return Json::encode($res);
                    }else {
                        $res['status']=2;
                        $res['info']='账号已登录！';
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=3;
                    $res['info']='账号或密码错误！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=4;
                $res['info']='账号或密码不能为空！';
                return Json::encode($res);
            }
        }else{
            return $this->renderPartial('index');
        }
    }
}