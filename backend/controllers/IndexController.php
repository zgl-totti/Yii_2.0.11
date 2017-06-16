<?php
namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminNav;
use backend\models\Goods;
use backend\models\Member;

class IndexController extends BaseController{
    public $layout=false;

    public $info;

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
        $goods=Goods::find()->orderBy('salenum desc')->limit(10)->asArray()->all();
        $member=Member::find();
        $count['num1']=$member->where(['level'=>1])->count();
        $count['num2']=$member->where(['level'=>2])->count();
        $count['num3']=$member->where(['level'=>3])->count();
        $count['num4']=$member->where(['level'=>4])->count();
        $count['num5']=$member->where(['level'=>5])->count();
        return $this->render('main',['info'=>$this->info,'goods'=>$goods,'count'=>$count]);
    }

    public function actionFooter(){
        return $this->render('footer');
    }
}