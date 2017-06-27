<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Auction extends ActiveRecord{
    public static function tableName(){
        return "{{%auction}}";
    }

    public function getAuctionGoods(){
        return $this->hasOne(AuctionGoods::className(),['id'=>'ag_id']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['id'=>'mid']);
    }
}