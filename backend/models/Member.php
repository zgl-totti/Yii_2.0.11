<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Member extends ActiveRecord{
    public $repwd;
    public $verify;
    public static function tableName(){
        return "{{%member}}";
    }

    public function getLevel(){
        return $this->hasOne(Level::className(),['id'=>'level']);
    }

    public function rules(){
        return [
            [['username','password','repwd','verify'],'required'],
            ['verify','captcha']
        ];
    }
}