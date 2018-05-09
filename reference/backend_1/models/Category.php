<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Category extends Model{
    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_category')->where($where)->one();
        return $info;
    }

    public function getAll($where=''){
        $list=(new Query())->select('*')->from('mj_category')->where($where)->all();
        return $list;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_category',$where,$data)->execute();
        return $row;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_category',$where)->execute();
        return $row;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_category',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }
}