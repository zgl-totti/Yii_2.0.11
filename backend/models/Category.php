<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord{
    //public $child;

    public static function tableName(){
        return "{{%category}}";
    }
}