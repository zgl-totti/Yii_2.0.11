<?php
namespace backend\models;

use yii\db\ActiveRecord;

class AuctionGoods extends ActiveRecord{
    public static function tableName(){
        return "{{%auction_goods}}";
    }

    public function rules(){
        return [
            [['starttime','endtime'],'required']
        ];
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }
}