<?php

namespace common\controllers;

use app\common\services\AppLogService;
use yii\log\FileTarget;
use yii\web\Controller;

class ErrorController extends Controller
{
    public function actionError()
    {
        $error=\Yii::$app->errorHandler->exception;

        if($error){
            $file=$error->getFile();
            $line=$error->getLine();
            $message=$error->getMessage();
            $code=$error->getCode();

            $log= new FileTarget();
            $log->logFile=\Yii::$app->getRuntimePath().'/logs/error.log';

            $err_msg=$message." [file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}][POST_DATA:".http_build_str($_POST)."]";

            $log->messages[]=[
                $err_msg,
                1,
                'application',
                strtotime(true)
            ];

            $log->export();
            //todo 写入到数据库

            AppLogService::addErrorLog(\Yii::$app->id,$err_msg);
        }

        return $this->render('');
    }
}