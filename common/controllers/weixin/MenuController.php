<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/5
 * Time: 23:25
 */

namespace common\controllers;


use app\common\services\RequestService;
use app\common\services\UriService;

class MenuController extends BaseController
{
    public function actionIndex()
    {
        $menu=[
            'button'=>[
                [
                    'name'=>'',
                    'type'=>'',
                    'url'=>UriService::buildWwwUrl('')
                ],

                [
                    'name'=>'',
                    'type'=>'',
                    'url'=>UriService::buildWwwUrl('')
                ]
            ],
        ];

        $config=\Yii::$app->params['weixin'];
        RequestService::setConfig($config['appid'],$config['token'],$config['sk']);
        $access_token=RequestService::getAccessToken();

        if($access_token){
            $url='menu/create?access_token='.$access_token;
            $ret=RequestService::send($url,json_encode($menu,JSON_UNESCAPED_UNICODE),'POST');

            print_r($ret);
        }
    }
}