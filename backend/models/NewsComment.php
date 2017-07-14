<?php
namespace backend\models;

use yii\db\ActiveRecord;

class NewsComment extends ActiveRecord{
    public static function tableName(){
        return "{{%news_comment}}";
    }

    public function getNews(){
        return $this->hasOne(News::className(),['id'=>'nid']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['id'=>'mid']);
    }

    public function rules(){
        return [
            ['content','required']
        ];
    }
}