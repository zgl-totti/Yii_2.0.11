<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/5
 * Time: 7:29
 */

namespace common\weixin\controllers;


use common\controllers\BaseController;

class WeixinController extends BaseController
{
    public function actionIndex()
    {
        if(!$this->checkSignature()){
            return 'error signature';
        }

        //用于微信第一次认证
        if(array_key_exists('echostr',$_GET) && $_GET['echostr']){
            return $_GET['echostr'];
        }
    }

    public function checkSignature()
    {
        $signature=trim($this->get('signature',''));
        $timestamp=trim($this->get('timestamp',''));
        $nonce=trim($this->get('nonce',''));
        $tmpArr=array(\Yii::$app->params['weixin']['token'],$timestamp,$nonce);
        sort($tmpArr);
        $tmpStr=implode('&',$tmpArr);
        $tmpStr=sha1($tmpStr);
        if($tmpStr==$signature){
            return true;
        }else{
            return false;
        }
    }

}