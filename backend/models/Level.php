<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Level extends ActiveRecord{
    public static function tableName(){
        return "{{%level}}";
    }
}