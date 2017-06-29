<?php
namespace backend\models;

use yii\db\ActiveRecord;

class GoodsComment extends ActiveRecord{
    public static function tableName(){
        return "{{%goods_comment}}";
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['id'=>'mid']);
    }
}