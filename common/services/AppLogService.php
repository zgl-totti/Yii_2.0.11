<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/1
 * Time: 16:03
 */

namespace app\common\services;


class AppLogService
{
    public static function addErrorLog($app_name,$content)
    {
        $error=\Yii::$app->errorHandler->exception;

        $app_log= new Log();
        $app_log->app_name=$app_name;
        $app_log->app_content=$content;
        $app_log->ip=UriService::getIp();

        if(!empty($_SERVER['HTTP_USER_AGENT'])){
            $app_log->ua=$_SERVER['HTTP_USER_AGENT'];
        }
        
        if($error){
            $app_log->err_code=$error->getCode();

            if(isset($error->statusCode)){
                $app_log->http_code=$error->statusCode;
            }

            if(method_exists($error,'getName')){
                $app_log->err_name=$error->getName();
            }
        }

        $app_log->created_time=date('Y-m-d H:i:s');
        $app_log->updated_time=date('Y-m-d H:i:s');

        $app_log->save();
    }
}