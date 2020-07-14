<?php

namespace api\controllers;

class AuthController extends BaseController
{
    public function actionIndex()
    {
        $username = \Yii::$app->request->post('name');
        $password = \Yii::$app->request->post('password');

        if ($username == "admin" && $password == "admin") {
            return ['success' => 1, 'msg' => '100-token'];
        }

        return ['success' => 0, 'msg' => \Yii::t('erp', 'Username or password error')];
    }
}