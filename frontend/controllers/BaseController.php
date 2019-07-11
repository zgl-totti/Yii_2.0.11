<?php
namespace frontend\controllers;

use App\Services\Spider;
use backend\models\Member;
use yii\web\Controller;

class BaseController extends Controller
{
    public $mid;

    public function init()
    {
        parent::init();

        //蜘蛛存入
        Spider::getInstance()->store();

        $mid=\Yii::$app->session->get('mid',47);
        $info = Member::findOne($mid);

        \Yii::$app->view->params['info'] = $info;
        \Yii::$app->view->params['keywords'] = '';
        $this->mid = $mid;
    }
}