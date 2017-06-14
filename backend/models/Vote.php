<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Vote extends ActiveRecord{
    public static function tableName(){
        return "{{%vote}}";
    }
}