<?php
namespace frontend\controllers;

use backend\models\Member;
use yii\web\Controller;

class BaseController extends Controller{
    public $mid;
    public function init(){
        parent::init();
        //$mid=\Yii::$app->session->get('mid');
        $mid=47;
        $info=Member::findOne($mid);
        \Yii::$app->view->params['info']=$info;
        \Yii::$app->view->params['keywords']='';
        $this->mid=$mid;
    }
}