<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Message extends Model{
    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_message',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return $row;
        }
    }

    public function returnMessage($where){
        $info=(new Query())->select('o.*,g.goods_name')->from('mj_order o')
            ->join('mj_order_goods g','o.id=g.orders_id')
            ->where($where)
            ->one();
        $data['uid']= $info['user_id'];
        $data['message']='您的订单号为'.$info['order_sn'].'中的'.$info['goods_name'].'已经退货成功!';
        $id=$this->add($data);
        return $id;
    }
}