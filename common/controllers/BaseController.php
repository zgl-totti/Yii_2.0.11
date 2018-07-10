<?php

namespace common\controllers;

use yii\web\Controller;
use yii\web\Cookie;

class BaseController extends Controller
{
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    protected $current_openid='taolu_openid';

    public function get($key,$value='')
    {
        return \Yii::$app->request->get($key,$value);
    }

    public function post($key,$value='')
    {
        return \Yii::$app->request->post($key,$value);
    }

    public function setCookie($name,$value,$expire=0)
    {
        $cookies=\Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name'=>$name,
            'value'=>$value,
            'expire'=>$expire
        ]));
    }

    public function getCookie($name,$value='')
    {
        $cookies=\Yii::$app->request->cookies;
        return $cookies->getValue($name,$value);
    }

    public function removeCookie($name)
    {
        $cookies=\Yii::$app->response->cookies;
        $cookies->remove($name);
    }

    public function renderJson($data=[],$msg='ok',$code=200)
    {
        header('Content-type:application/json');
        echo json_encode([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data,
            'req_id'=>uniqid()
        ]);
    }

    public function renderJs($msg,$url)
    {
        return $this->renderPartial('@web/common.js',[compact('msg','url')]);
    }
}