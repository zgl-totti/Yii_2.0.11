<?php
namespace backend\models;

use yii\db\ActiveRecord;

class GoodsPic extends ActiveRecord{
    public static function tableName(){
        return "{{%goods_pic}}";
    }
}