<?php

namespace api\controllers;

use yii\filters\auth\HttpBearerAuth;
use Yii;

class IndexController extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            $behaviors['authenticator'] = [
                'class' => HttpBearerAuth::className(),
            ];
        }

        return $behaviors;
    }

    public function actionIndex()
    {
        return ['success' => 1, 'msg' => 'hello'];
    }
}