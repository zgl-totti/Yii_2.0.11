<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Feedback extends ActiveRecord{
    public static function tableName(){
        return "{{%feedback}}";
    }
}