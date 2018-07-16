<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/14
 * Time: 11:01
 */

namespace common\services;


use app\common\services\HttpClient;

class TemplateService
{
    public static function notice($order_id)
    {
        $order=Order::findOne($order_id);
        if(empty($order)){
            return false;
        }

        $openid='';
        $template_id='';

        if(empty($openid)){
            return false;
        }

        $data=[
            'first'=>[
                'value'=>'',
                'color'=>''
            ],
            'keyword1'=>[
                'value'=>'',
                'color'=>''
            ],
            'remark'=>[
                'value'=>'',
                'color'=>''
            ]
        ];
        $template=[
            'touser'=>$openid,
            'template_id'=>$template_id,
            'url'=>'',
            'data'=>$data
        ];

        $ret=self::send($template);

    }

    public static function send($template=[])
    {
        $url='';
        $res=HttpClient::curl($url,'post',$template);
        return $res;
    }

}