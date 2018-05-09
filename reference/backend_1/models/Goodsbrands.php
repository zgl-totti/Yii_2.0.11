<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Goodsbrands extends Model{
    public function getAll($where,$pages){
        $list=(new Query())->select('*')->from('mj_goods_brands')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function num($where){
        $count=(new Query())->select('*')->from('mj_goods_brands')->where($where)->count();
        return $count;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_goods_brands')->where($where)->one();
        return $info;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_goods_brands',$where)->execute();
        return $row;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_goods_brands',$where,$data)->execute();
        return $row;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_goods_brands',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }
}