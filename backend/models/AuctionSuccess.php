<?php
namespace backend\models;

use yii\db\ActiveRecord;

class AuctionSuccess extends ActiveRecord{
    public static function tableName(){
        return "{{%auction_success}}";
    }

    public function getAuctionGoods(){
        return $this->hasOne(AuctionGoods::className(),['id'=>'ag_id']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['id'=>'mid']);
    }
}