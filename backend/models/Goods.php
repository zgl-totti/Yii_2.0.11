<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord{
    public static function tableName(){
        return "{{%goods}}";
    }

    public function getCate(){
        return $this->hasOne(Category::className(),['id'=>'cid']);
    }

    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'bid']);
    }
}