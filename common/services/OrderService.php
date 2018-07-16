<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/13
 * Time: 21:45
 */

namespace app\common\services;



use common\services\TemplateService;
use yii\base\Exception;

class OrderService
{
    public static function createOrder($user_id,$items=[],$params=[])
    {
        $total_price=0;
        $continue_cn=0;
        foreach ($items as $item){
            if($item['price']<0){
                $continue_cn++;
                continue;
            }
            $total_price+=$item['price'];
        }
        
        if($continue_cn>=count($items)){
            return false;
        }

        $discount=$params['discount'] ?? 0;
        $total_price=sprintf('%.2f',$total_price);
        $discount=sprintf('%.2f',$discount);
        $pay_price=sprintf('%.2f',$total_price-$discount);
        $created_time=date('Y-m-d H:i:s');

        $transaction=\Yii::$app->db->beginTransaction();
        try{
            //并发控制：(1)第一种方案：select for update（悲观锁,非高并发）
            //(2)第二种方案：update goods set goods_number = 2 where id = 1 and goods_number = 5;（乐观锁）

            $table_goods=Goods::tableName();
            $goods_ids=array_column($items['goods_id'],'goods_id');
            $sql="SELECT id,goods_number FROM {$table_goods} WHERE id in (".implode(',',$goods_ids).") FOR UPDATE";
            $goods=\Yii::$app->db->createCommand($sql)->queryAll();

            $list=[];
            foreach ($list as $val){
                $list[$val['id']]=$val['goods_number'];
            }

            $order= new Order();
            $order->user_id=$user_id;
            $order->order_sn='';
            $order->total_price=$total_price;
            $order->discount=$discount;
            $order->pay_price=$pay_price;
            $order->created_time=$created_time;
            $order->order_status='';
            $order->shipping_id='';

            $row1=$order->save();
            if(empty($row1)){
                throw new Exception('下单失败');
            }

            foreach ($items as $item){
                $goods_number=$list[$item['id']];
                if($goods_number<$item['goods_number']){
                    throw new Exception('库存不足');
                }

                $row2=Goods::updateAll(['goods_number'=>$goods_number->$item['goods_number']],['id'=>$item['id']]);
                if(empty($row2)){
                    throw new Exception('下单失败');
                }


                $orderGoods= new OrderGoods();
                $orderGoods->order_id=$order->order_id;
                $orderGoods->goods_id=$item['goods_id'];
                $orderGoods->goods_number=$item['goods_number'];
                $orderGoods->goods_price=$item['goods_price'];

                $row3=$orderGoods->save();
                if(empty($row3)){
                    throw new Exception('下单失败');
                }
            }

            $transaction->commit();
            return [
                'order_id'=>$order->order_id,
                'order_sn'=>'',
                'order_price'=>'',
            ];

        }catch(\Exception $e){
            $transaction->rollBack();

            return $e->getMessage();
        }
    }

    public static function orderSuccess($order_id,$params=[])
    {
        $time=date('Y-m-d H:i:s');
        $transaction=\Yii::$app->db->beginTransaction();
        try{


            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            $res=[
                'status'=>0,
                'msg'=>$e->getMessage()
            ];

            return json_encode($res);
        }

        //模板消息推送
        TemplateService::notice($order_id);

        //模板消息推送队列
        $data=[
            'user_id'=>'',
            'order_id'=>$order_id
        ];
        QueueListService::addQueue('pay',$data);
    }

    public static function createOrdersn()
    {
        do {
            $order_sn = md5(microtime(1) . rand(1000000, 9999999), '!@#$%');
        }while(Order::findOne(['order_sn'=>$order_sn]));

        return $order_sn;
    }

}