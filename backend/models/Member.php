<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Member extends ActiveRecord{
    public $repwd;
    public $verify;

    public static function tableName(){
        return "{{%member}}";
    }

    public function scenarios(){
        return [
            'index'=>['username','password'],
            'register'=>['username','password','repwd','verify'],
            'member'=>['username'],
        ];
    }

    public function rules(){
        return [
            [['username','password','repwd','verify'],'required','on'=>'register'],
            [['username','password'],'required','on'=>'index'],
            ['verify','captcha','captchaAction'=>'login/captcha','on'=>'register'],
            ['username','required','on'=>'member'],
        ];
    }

    public function getLevel(){
        return $this->hasOne(Level::className(),['id'=>'level']);
    }
}