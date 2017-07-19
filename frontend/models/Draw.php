<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Draw extends ActiveRecord{
    public static function tableName(){
        return "{{%integral_draw}}";
    }
}