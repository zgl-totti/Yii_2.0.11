<?php

namespace app\common\services;


use yii\helpers\Url;

class UriService
{
    /**
     * 构建WEB端链接
     */
    public static function buildWebUrl($path,$params=[])
    {
        $domain_config=\Yii::$app->params['domain'];
        $path=Url::toRoute(array_merge([$path],$params));
        return $domain_config['web'].$path;
    }

    /**
     * 构建WAP端链接
     */
    public static function buildWapUrl($path,$params=[])
    {
        $domain_config=\Yii::$app->params['domain'];
        $path=Url::toRoute(array_merge([$path],$params));
        return $domain_config['wap'].$path;
    }

    /**
     * 构建首页链接
     */
    public static function buildWwwUrl($path,$params=[])
    {
        $domain_config=\Yii::$app->params['domain'];
        $path=Url::toRoute(array_merge([$path],$params));
        return $domain_config['www'].$path;
    }

    /**
     * 构建空链接
     */
    public static function buildNullUrl()
    {
        return 'javascript:void(0);';
    }

    /**
     * 获取IP
     */
    public static function getIp()
    {
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }
}