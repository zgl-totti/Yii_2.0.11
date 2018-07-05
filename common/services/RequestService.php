<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/5
 * Time: 21:42
 */

namespace app\common\services;


class RequestService
{
    private static $appid='';
    private static $app_token='';
    private static $app_secret='';

    private static $url='https://api.weixin.qq.com/cgi-bin/';

    public static function getAccessToken()
    {
        $date_now = date('Y-m-d H:i:s');
        $access_token_info = OauthAccessToken::find()->where(['>', 'expired_time', $date_now])->one();
        if ($access_token_info) {
            return $access_token_info['access_token'];
        }

        //调取接口获取
        $path='token?grant_type=client_credential&appid='.self::getAppid().'&secret='.self::getAppSecret();
        $res=self::send($path);

        if(empty($res)){
            return self::_err(self::getLastErrorMsg());
        }

        //存入数据库
        $model_access_token= new OauthAccessToken();
        $model_access_token->access_token=$res['access_token'];
        $model_access_token->expired_time=date('Y-m-d H:i:s',$res['expires_in']+time()-200);
        $model_access_token->created_time=$date_now;
        $model_access_token->save();

        return $res['access_token'];
    }

    public static function send($path,$data=[],$method='GET')
    {
        $request_url=self::$url.$path;
        if($method=='POST'){
            $res=HttpClient::post($request_url,$data);
        }else{
            $res=HttpClient::get($request_url,[]);
        }

        $ret=@json_decode($res,true);

        if(empty($ret) || (isset($ret['errcode']) && $ret['errcode'])){
            return self::_err($ret['errmsg']);
        }

        return $ret;
    }

    public static function setConfig($appid,$app_token,$app_secret)
    {
        self::$appid=$appid;
        self::$app_token=$app_token;
        self::$app_secret=$app_secret;
    }
    
    public static function getAppid(){
        return self::$appid;
    }

    public static function getAppToken()
    {
        return self::$app_token;
    }
    
    public static function getAppSecret()
    {
        return self::$app_secret;
    }



}