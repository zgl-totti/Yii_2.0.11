<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Success extends ActiveRecord{
    public static function tableName(){
        return "{{%auction_success}}";
    }
}