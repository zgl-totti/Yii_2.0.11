<?php
namespace backend\controllers;

use yii\web\Controller;

class BaseController extends Controller{
    public function __construct(){
        $aid=\Yii::$app->session->get('aid');
        if(!$aid){
            $this->redirect('Login/index');
        }
    }
}