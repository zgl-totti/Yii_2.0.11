<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord{
    public $captcha;

    public static function tableName(){
        return "{{%admin}}";
    }

    public function scenarios(){

        $scenarios=parent::scenarios();
        $scenarios['login']=['username','password','captcha'];
        $scenarios['create']=['username','password','gender'];
        return $scenarios;

        /*return [
            'create'=>['username','password','gender'],
            'login'=>['username','password','captcha'],
            'edit'=>['password']
        ];*/
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