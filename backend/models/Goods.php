<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord{
    public static function tableName(){
        return "{{%goods}}";
    }

    public $cate_id;
    public function attributeLabels(){
        return [
            'goodsname'=>'商品名称',
            'price'=>'价格',
            'activity'=>'活动',
            'addtime'=>'添加时间',
            'salenum'=>'销量',
            'bid'=>'品牌名称',
            'cid'=>'分类名称',
            'display'=>'展示',
            'cate_id'=>'行业分类'
        ];
    }

    public function getCate(){
        return $this->hasOne(Category::className(),['id'=>'cid']);
    }

    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'bid']);
    }

    public function getPics(){
        return $this->hasMany(GoodsPic::className(),['gid'=>'id']);
    }
}