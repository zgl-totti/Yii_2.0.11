<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Cateattr extends Model{
    public function getOne($where){
        $list=(new Query())->select('*')->from('mj_cateattr')
            ->where($where)
            ->one();
        return $list;
    }

    public function getAll($where=''){
        $list=(new Query())->select('*')->from('mj_cateattr')
            ->where($where)
            ->all();
        return $list;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_cateattr',$where)->execute();
        return $row;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_cateattr',$where,$data)->execute();
        return $row;
    }

    public function num($where=''){
        $count=(new Query())->select('*')->from('mj_cateattr')->where($where)->count();
        return $count;
    }

    public function getList($where='',$pages){
        $list=(new Query())->select('*')->from('mj_cateattr')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_cateattr',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }

    public function addAttrname($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_attr_name',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }

    public function delAttrname($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_attr_name',$where)->execute();
        return $row;
    }

    public function getAttrOne($where){
        $info=(new Query())->select('*')->from('mj_attr_name')->where($where)->one();
        return $info;
    }

    public function updateAttr($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_attr_name',$where,$data)->execute();
        return $row;
    }
}