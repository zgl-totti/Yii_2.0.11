<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord{
    public $captcha;

    public static function tableName(){
        return "{{%admin}}";
    }

    public function rules(){
        return [
            [['username','password','captcha'],'required','message'=>"{attribute}不能为空"],
            ['captcha','captcha','captchaAction'=>'login/captcha','message'=>"{attribute}错误"]
        ];
    }

    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密 码',
            'captcha'=>'验证码'
        ];
    }

    /*public function validatePassword(){
        $user = $this->getUser();
        if(! $user || ! $user->validatePassword($this->password)) {
            $this->addError('password', 'Incorrect username or password.');
        }
    }

    public function login(){
        if($this->validate()) {
            return \Yii::$app->user->login($this->getUser(), 0);
        }else{
            return false;
        }
    }

    private function getUser(){
        if($this->_user === false) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }*/
}