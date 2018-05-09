<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Member extends Model{
    public function num($where){
        $count=(new Query())->select('id')->from('mj_member')->where($where)->count();
        return $count;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_member')->where($where)->one();
        return $info;
    }

    public function getAll($where='',$order='id desc'){
        $list=(new Query())->select('*')->from('mj_member')->where($where)->orderBy($order)->all();
        return $list;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_member',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return $row;
        }
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_member',$where,$data)->execute();
        return $row;
    }

    public function getList($where='',$order='id desc',$pages){
        $list=(new Query())->select('*')->from('mj_member')
            ->where($where)
            ->orderBy($order)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_member',$where)->execute();
        return $row;
    }

    public function getAllLevel($where=''){
        $list=(new Query())->select('*')->from('mj_member_level')->where($where)->all();
        return $list;
    }

    public function delLevel($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_member_level',$where)->execute();
        return $row;
    }

    public function getOneLevel($where){
        $info=(new Query())->select('*')->from('mj_member_level')->where($where)->one();
        return $info;
    }

    public function updateLevel($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_member_level',$where,$data)->execute();
        return $row;
    }

    public function addLevel($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_member_level',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return $row;
        }
    }
}