<?php
namespace  backend\models;

use yii\db\ActiveRecord;

class Advertise extends ActiveRecord{
    public static function tableName(){
        return "{{%ads}}";
    }
}