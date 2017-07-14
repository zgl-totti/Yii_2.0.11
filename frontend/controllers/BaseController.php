<?php
namespace frontend\controllers;

use backend\models\Member;
use yii\web\Controller;

class BaseController extends Controller{
    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid');
        $info=Member::findOne($mid);
        \Yii::$app->view->params['info']=$info;
    }
}