<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/18
 * Time: 22:42
 */

namespace common\controllers;


class MsgController extends BaseController
{
    private function parseEvent($dataObj)
    {
        $resType='text';
        $resData=$this->defaultTip();
        $event=$dataObj ->Event;
        switch ($event){
            case 'subscribe':
                $resData=$this->subscribeTips();
                $event_key=$dataObj->EventKey;
                if($event_key){
                    $qrcode=str_replace('qrscene','',$event_key);
                    $qrcode_info=MarketQrcode::findOne($qrcode->qrcode_key);

                    if($qrcode_info){

                    }
                }
                break;
            case 'CLICK':
                break;
        }
    }
}