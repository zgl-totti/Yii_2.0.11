<?php
namespace frontend\models;

use backend\models\Goods;
use yii\db\ActiveRecord;

class Credit extends ActiveRecord{
    public static function tableName(){
        return "{{%credit_goods}}";
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }
}