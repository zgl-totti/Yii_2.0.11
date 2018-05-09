<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Goods extends Model{
    public function num($where){
        $count=(new Query())->select('id')->from('mj_goods_return')->where($where)->count();
        return $count;
    }

    public function delReturn($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_goods_return',$where)->execute();
        return $row;
    }

    public function getReturn($where){
        $list=(new Query())->select('*')->from('mj_goods_return')->where($where)->all();
        return $list;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_goods')->where($where)->one();
        return $info;
    }

    public function getAll($where){
        $list=(new Query())->select('*')->from('mj_goods')->where($where)->all();
        return $list;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_goods',$where,$data)->execute();
        return $row;
    }

    public function goodsCount($where){
        $count=(new Query())->select('id')->from('mj_goods')->where($where)->count();
        return $count;
    }

    public function getList($where,$pages,$order){
        $list=(new Query())->select('*')->from('mj_goods')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();
        return $list;
    }
}