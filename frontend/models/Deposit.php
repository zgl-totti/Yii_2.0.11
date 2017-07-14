<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Deposit extends ActiveRecord{
    public static function tableName(){
        return "{{%auction_deposit}}";
    }
}