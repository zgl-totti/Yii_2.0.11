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
}