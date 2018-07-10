<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/10
 * Time: 23:01
 */

namespace common\controllers;


use app\common\services\HttpClient;
use app\common\services\RequestService;

class JssdkController extends BaseController
{
    public function actionIndex()
    {
        $ticket=$this->getJsapiTicket();

        $url=$this->get('url');
        $timestamp=time();
        $noncestr=$this->createNoncestr();
        $str='jsapi_ticket='.$ticket.'&noncestr='.$noncestr.'&timestamp='.$timestamp.'&url='.$url;
        $signature=sha1($str);
        $config = \Yii::$app->params['wexin'];

        $data=[
            'appid'=>$config['appid'],
            'timestamp'=>$timestamp,
            'nonceStr'=>$noncestr,
            'signature'=>$signature
        ];

        return $this->renderJson($data);
    }

    public function getJsapiTicket()
    {
        $ticket=\Yii::$app->cache->get('js_ticket');

        if(empty($ticket)) {
            $config = \Yii::$app->params['wexin'];
            RequestService::setConfig($config['appid'], $config['token'], $config['sk']);
            $access_token = RequestService::getAccessToken();
            $res = RequestService::send('ticket/getticket?access_token=' . $access_token . '&type=jsapi');

            if (isset($res['errcode']) && $res['errcode'] == 0) {
                \Yii::$app->cache->set('js_ticket', $res['ticket'], $res['expires_in'] - 200);
                $ticket=$res['ticket'];
            }
        }

        return $ticket;
    }
}