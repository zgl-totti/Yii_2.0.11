<?php
namespace common\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord{

    public $captcha;

    public static function tableName(){
        return "{{%admin}}";
    }

    //验证场景
    public function scenarios(){

        $scenarios=parent::scenarios();
        $scenarios['login']=['username','password','captcha'];
        $scenarios['create']=['username','password','gender'];

        return $scenarios;
    }

    public function rules(){
        return [
            [['username','password'],'required','message'=>"{attribute}不能为空",'on'=>['login','create','edit']],
            ['captcha','required','message'=>"{attribute}不能为空",'on'=>'login'],
            ['gender','required','message'=>"{attribute}不能为空",'on'=>'create'],
            ['captcha','captcha','captchaAction'=>'login/captcha','message'=>"{attribute}错误",'on'=>'login']
        ];
    }

    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密 码',
            'captcha'=>'验证码',
            'gender'=>'性别'
        ];
    }

}