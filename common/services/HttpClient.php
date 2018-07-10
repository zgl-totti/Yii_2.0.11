<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/5
 * Time: 22:12
 */

namespace app\common\services;


class HttpClient
{
    private static $headers=[];

    private static $cookie=null;

    public static function get($url,$param=[])
    {
        return self::curl($url,$param,'get');
    }

    public static function post($url,$param=[])
    {
        return self::curl($url,$param,'post');
    }

    public static function curl($url,$param,$method='post')
    {
        $calculate_time1=microtime(true);

        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_CERTINFO,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);

        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);

        if(isset(\Yii::$app->params['curl']) && isset(\Yii::$app->params['curl']['timeout'])){
            curl_setopt($curl,CURLOPT_TIMEOUT,\Yii::$app->params['curl']['timeout']);
        }else{
            curl_setopt($curl,CURLOPT_TIMEOUT,5);
        }

        if(array_key_exists('HTTP_USER_AGENT',$_SERVER)){
            curl_setopt($curl,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
        }

        if(!empty(self::$headers)){
            $headerArr=[];
            foreach (self::$headers as $n=>$v){
                $headerArr[]=$n.':'.$v;
            }
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArr);
        }

        if(self::$cookie){
            curl_setopt($curl,CURLOPT_COOKIE,self::$cookie);
        }

        if($method=='post'){
            curl_setopt($curl,CURLOPT_POST,true);
            if(is_array($param)){
                $param=http_build_query($param);
            }
            curl_setopt($curl,CURLOPT_POSTFIELDS,$param);
        }else{
            curl_setopt($curl,CURLOPT_POST,false);
        }

        //执行输出
        $info=curl_exec($curl);

        $_errno=curl_errno($curl);
        $_error='';
        if($_errno){
            $_error=curl_error($curl);
        }

        curl_close($curl);
        $calculate_time_span=microtime(true)-$calculate_time1;
        $log=\Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'curl.log';

        file_put_contents($log,date('Y-m-d H:i:s')."[time:{$calculate_time_span}]url:{$url}
        method:{$method}data:".json_encode($param)."result:{$info}errno:{$_errno}error:{$_error}",FILE_APPEND);

        if($_error){
            return self::_err($_error);
        }

        return $info;
    }

    public static function setHeader($header)
    {
        self::$headers=$header;
    }
}