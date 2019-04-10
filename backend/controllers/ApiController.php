<?php


namespace backend\controllers;


use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // 禁用"put"动作
        unset($actions['put']);

        return $actions;
    }

    public function actionIndex()
    {
        $res=[];

        return $res;
    }
}