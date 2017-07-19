<?php
namespace frontend\models;

use backend\models\AuctionGoods;
use backend\models\AuctionSuccess;
use yii\db\ActiveRecord;

class Message extends ActiveRecord{
    public static function tableName(){
        return "{{%message}}";
    }

    public function getAuctionGoods(){
        return $this->hasOne(AuctionGoods::className(),['id'=>'ag_id']);
    }

    public function getSuccess(){
        return $this->hasOne(AuctionSuccess::className(),['ag_id'=>'ag_id']);
    }
}