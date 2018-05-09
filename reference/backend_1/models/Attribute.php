<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Attribute extends Model{
    public function getOne($where){
        $list=(new Query())->select('*')->from('mj_attribute')->where($where)->one();
        return $list;
    }

    public function getAll($where=''){
        $list=(new Query())->select('*')->from('mj_attribute')->where($where)->all();
        return $list;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_attribute',$where,$data)->execute();
        return $row;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_attribute',$where)->execute();
        return $row;
    }
}