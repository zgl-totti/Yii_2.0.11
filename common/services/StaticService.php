<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/3
 * Time: 23:31
 */

namespace app\common\services;

//加载静态资源类
class StaticService
{
    public function includeJsStatic($path,$depend)
    {
        self::includeAppStatic('js',$path,$depend);
    }

    public function includeCssStatic($path,$depend)
    {
        self::includeAppStatic('css',$path,$depend);
    }

    public static function includeAppStatic($type,$path,$depend)
    {
        $version=define('VERSION') ?? time();
        $path=$path.'?version='.$version;

        if($type=='css'){
            \Yii::$app->getView()->registerCss($path,['depends'=>$depend]);
        }else{
            \Yii::$app->getView()->registerJs($path,['depends'=>$depend]);
        }
    }
}