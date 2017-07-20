<?php
namespace frontend\controllers;


use yii\web\Controller;

class ChatRoomController extends Controller{
    public $layout=false;
    public function actionIndex(){
        return $this->render('index');
    }
}