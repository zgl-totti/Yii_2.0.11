<?php
namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminNav;

class IndexController extends BaseController{
    public $layout=false;

    public function init(){
        parent::init();
        $aid=\Yii::$app->session->get('aid');
        $this->info=Admin::findOne($aid);
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionTop(){
        return $this->render('top',['info'=>$this->info]);
    }

    public function actionLeft(){
        $list=AdminNav::find()->where(['pid'=>0])->orderBy('priority')->all();
        return $this->render('left',['list'=>$list]);
    }

    public function actionMain(){
        return $this->render('main',['info'=>$this->info]);
    }

    public function actionFooter(){
        return $this->render('footer');
    }
}