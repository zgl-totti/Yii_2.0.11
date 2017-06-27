<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Activity extends ActiveRecord{
    public static function tableName(){
        return "{{%activity}}";
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }

    public function getVote(){
        return $this->hasOne(Vote::className(),['id'=>'aid']);
    }
}