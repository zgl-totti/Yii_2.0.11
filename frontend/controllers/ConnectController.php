<?php
namespace frontend\controllers;


class ConnectController extends BaseController{
    //联系我们展示页
    public function actionIndex(){
        return $this->render('index');
    }
}