<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord{
    public static function tableName(){
        return "{{%article}}";
    }

    public function rules(){
        return [
            [['title','author','cate','content'],'required','message'=>"{attribute}不能为空"]
        ];
    }

    public function attributeLabels(){
        return [
            'title'=>'文章标题',
            'author'=>'文章作者',
            'cate'=>'文章分类',
            'content'=>'文章内容'
        ];
    }
}