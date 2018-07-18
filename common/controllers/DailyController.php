<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/18
 * Time: 23:40
 */

namespace common\controllers;


class DailyController extends BaseController
{
    public function actionSite($data='now')
    {
        $data=date('Y-m-d',strtotime($data));
        $time_start=$data.'00:00:00';
        $time_end=$data.'23:59:59';

        $this->echoLog('date:'.$data);

        $info=Order::find()->select(['SUM(pay_price) as total_money'])
            ->where('status',1)
            ->andWhere(['between',$time_start,$time_end])
            ->asArray()
            ->one();

        $total_user=User::find()->where(['>=','created_at',$time_start])->count();
        $total_new_user=User::find()->where(['between','created_at',$time_start,$time_end])->count();

    }
}