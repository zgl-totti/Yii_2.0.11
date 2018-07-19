<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/14
 * Time: 9:13
 */

namespace app\common\services;


class PayApiService
{
    public $config;

    public function _initialize()
    {
        $this->config=config();
    }

    public function pay()
    {
        $url='https://api.mch.weixin.qq.com/pay/unifiedorder';
        $nonce_str=$this->createNoncestr();

    }

}