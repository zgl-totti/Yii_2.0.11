<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Member extends ActiveRecord{
    public static function tableName(){
        return "{{%member}}";
    }

    public function getLevel(){
        return $this->hasMany(Level::className(),['level'=>'id']);
    }
}