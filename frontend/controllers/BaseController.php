<?php
namespace frontend\controllers;

use App\Services\Spider;
use backend\models\Member;
use yii\web\Controller;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class BaseController extends Controller
{
    public $mid;

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
                ],
                'actions' => [
                    'login' => [
                        'Access-Control-Allow-Credentials' => true,
                    ]
                ]
            ],
        ], parent::behaviors());
    }

    public function init()
    {
        parent::init();

        //蜘蛛存入
        Spider::getInstance()->store();

        $mid = \Yii::$app->session->get('mid', 47);
        $info = Member::findOne($mid);

        \Yii::$app->view->params['info'] = $info;
        \Yii::$app->view->params['keywords'] = '';
        $this->mid = $mid;
    }
}