<?php
 namespace backend\models;

 use yii\db\ActiveRecord;

 class Integral extends ActiveRecord{
     public static function tableName(){
         return "{{%integral}}";
     }

     public function getPics(){
         return $this->hasMany(IntegralPic::className(),['iid'=>'id']);
     }

     public function rules(){
         return [
             [['goodsname','integral','num','detail'],'required'],
             //[['image'],'file','extensions'=>'gif,jpg,jpeg,png']
         ];
     }
 }