<?php
namespace frontend\controllers;

use yii\rest\ActiveController;

class WechatController extends ActiveController{
    public $modelClass = '';

    public function actionValid(){
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        //valid signature , option
        if($this->checkSignature($signature,$timestamp,$nonce)){
            echo $echoStr;
        }
    }

    private function checkSignature($signature,$timestamp,$nonce){
        $token = \Yii::$app->params['wechat']['token'];
        if (!$token) {
            echo 'TOKEN is not defined!';
        } else {
            $tmpArr = array($token, $timestamp, $nonce);
            // use SORT_STRING rule
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode( $tmpArr );
            $tmpStr = sha1( $tmpStr );

            if( $tmpStr == $signature ){
                return true;
            }else{
                return false;
            }
        }
    }

    //获取用户信息
    public function getJSApiTicket(){
        $redis = \Yii::$app->redis;
        $redis_ticket = $redis->get('wechat:jsapi_ticket');
        if ($redis_ticket) {
            $ticket = $redis_ticket;
        } else {
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$accessToken;
            $res = json_decode(self::curlGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $redis->set('wechat:jsapi_ticket', $ticket);
                $redis->expire('wechat:jsapi_ticket', 7000);
            }
        }
        return $ticket;
    }

    //获取accessToken;
    public static function getAccessToken() {
        //使用Redis缓存 access_token
        $redis = \Yii::$app->redis;
        $redis_token = $redis->get('wechat:access_token');
        if ($redis_token) {
            $access_token = $redis_token;
        } else {
            $appid = \Yii::$app->params['wechat']['appid'];
            $appsecret = \Yii::$app->params['wechat']['appsecret'];
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
            $res = json_decode(self::curlGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $redis->set('wechat:access_token', $access_token);
                $redis->expire('wechat:access_token', 7000);
            }
        }
        return $access_token;
    }

    public static function curlGet($url = '', $options = array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function curlPost($url = '', $postData = '', $options = array()){
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function createNonceStr($length = 16){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i<$length; $i++){
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //获取config参数接口
    public function actionConfig(){
        if (isset($_REQUEST['url'])) {
            $url = $_REQUEST['url'];
            //微信支付参数
            $appid = \Yii::$app->params['wechat']['appid'];
            $mchid = \Yii::$app->params['wechat']['mchid'];
            $key = \Yii::$app->params['wechat']['key'];
            $wx_pay = new WechatPay($mchid, $appid, $key);
            $package = $wx_pay->getSignPackage($url);
            $result['error'] = 0;
            $result['msg'] = '获取成功';
            $result['config'] = $package;
        } else {
            $result['error'] = 1;
            $result['msg'] = '参数错误';
        }
        return $result;
    }
}