<?php
namespace backend\models;

use yii\db\ActiveRecord;

class IntegralPic extends ActiveRecord{
    public static function tableName(){
        return "{{%integral_pic}}";
    }
}