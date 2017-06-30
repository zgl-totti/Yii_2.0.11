<?php
namespace backend\models;

use yii\db\ActiveRecord;

class OrderGoods extends ActiveRecord{
    public static function tableName(){
        return "{{%order_goods}}";
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }

    public function getOrder(){
        return $this->hasOne(Order::className(),['id'=>'oid']);
    }
}