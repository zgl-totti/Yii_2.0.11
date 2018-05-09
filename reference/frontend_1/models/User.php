<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord{
    //对应类名和数据表
    public static function tableName(){
        return "{{%user}}";
    }
}