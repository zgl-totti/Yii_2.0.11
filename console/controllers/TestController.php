<?php


namespace console\controllers;


use backend\models\Goods;
use backend\models\Order;
use backend\models\OrderGoods;
use yii\console\Controller;


//sh -c "cd /www/wwwroot/Yii_2.0.11;php yii test/index;"
//0 */1 * * * /home/crontab/Yii_2.0.11


class TestController extends Controller
{
    public function actionIndex()
    {
        //执行逻辑

        try {

            $where['order_status']=1;
            $condition=['<','addtime',time() - 72 * 3600];

            $order=Order::find()->where($where)->andWhere($condition)->select('id')->asArray()->all();

            $list=OrderGoods::find()->where(['in','oid',$order])
                ->select('gid,buynum')
                ->asArray()
                ->all();

            if ($list) {
                foreach ($list as $v) {
                    Goods::updateAllCounters(['num'=>$v['buynum']],['id'=>$v['gid']]);

                    $goods=Goods::findOne($v['gid']);
                    if (intval($goods['salenum']) >= intval($v['buynum'])) {
                        Goods::updateAllCounters(['salenum'=>-$v['buynum']],['id'=>$v['gid']]);
                    } else {
                        Goods::updateAllCounters(['salenum'=>0],['id'=>$v['gid']]);
                    }
                }
            }

            $row=Order::updateAll(['order_status'=>10],['and',$where,$condition]);

            if($row){
                \Yii::warning('command:success_' . time().'_条数：'.$row.';');
            }else{
                \Yii::warning('command:error_' . time().';');
            }
        }catch (\Exception $e){
            \Yii::error('command:warning_'.time().'_'.$e->getMessage().';');
        }
    }
}