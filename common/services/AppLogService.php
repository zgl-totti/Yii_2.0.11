<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/1
 * Time: 16:03
 */

namespace app\common\services;


use app\models\AppAccessLog;

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

    public static function addAppAccessLog($uid=0){
        $get_params=\Yii::$app->request->get();
        $post_params=\Yii::$app->request->post();

        $target_url=$_SERVER['REQUEST_URI'] ?? '';
        $referer=$_SERVER['HTTP_REFERER'] ?? '';
        $ua=$_SERVER['HTTP_USER_AGENT'] ?? '';

        $access_log= new AppAccessLog();
        $access_log->uid=$uid;
        $access_log->refer_url=$referer;
        $access_log->target_url=$target_url;
        $access_log->ua=$ua;
        $access_log->query_params=json_encode(array_merge($get_params,$post_params));
        $access_log->ip=UriService::getIp();
        $access_log->created_time=date('Y-m-d H:i:s');

        return $access_log->save();
    }
}