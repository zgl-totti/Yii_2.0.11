<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class CommentPic extends ActiveRecord{
    public static function tableName(){
        return "{{%comment_pic}}";
    }
}