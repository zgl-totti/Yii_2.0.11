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
 }