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
            [['username','password','repwd','verify'],'required','on'=>['login/register']],
            [['username','password'],'required','on'=>['login/index']],
            ['verify','captcha','on'=>['login/register']],
            ['username','required','on'=>['/personal/member']],
        ];
    }
}