<?php
namespace backend\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord{
    public static function tableName(){
        return"{{%news}}";
    }

    public function rules(){
        return [
            [['title','author','content'],'required']
        ];
    }
}