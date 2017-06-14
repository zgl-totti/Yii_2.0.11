<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Filter extends ActiveRecord{
    public static function tableName(){
        return "{{%vote_filter}}";
    }
}