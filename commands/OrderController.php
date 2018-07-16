<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/14
 * Time: 10:23
 */

namespace app\commands;


class OrderController extends BaseController
{
    /**
     * 释放30分钟前的订单
     * php yii order/index
     */
    public function actionIndex()
    {
        $time=time()-30*60;
        $orders=Order::find()->where(['type'=>1,'pay_status'=>0])
            ->andWhere('<=','add_time',$time)
            ->asArray()
            ->all();

        if(empty($orders)){
            return $this->log('not data');
        }

        //更改订单状态和释放库存
        foreach ($orders as $val){

        }

        return $this->log('success');
    }

    public function hello()
    {
        echo 'hello world';
    }
}