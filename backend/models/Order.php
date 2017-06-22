<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord{
    public static function tableName(){
        return "{{%order}}";
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['id'=>'mid']);
    }

    public function getStatus(){
        return $this->hasOne(Status::className(),['id'=>'order_status']);
    }

    public function getAddress(){
        return $this->hasOne(Address::className(),['id'=>'address']);
    }

    public function getOrderGoods(){
        return $this->hasMany(OrderGoods::className(),['oid'=>'id']);
    }
}