<?php
namespace frontend\models;

use yii\base\Model;
use yii\db\Query;

class Category extends Model{
    public function getList($where,$pagination){
        $list=(new Query())->select('*')->from('beauty_category')
            ->where($where)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $list;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('beauty_category')->where($where)->one();
        return $info;
    }

    public function getAll($where){
        $info=(new Query())->select('*')->from('beauty_category')->where($where)->all();
        return $info;
    }

    public function num($where){
        $num=(new Query())->select('*')->from('beauty_category')->where($where)->count();
        return $num;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('beauty_category',$data)->execute();
        $id=\Yii::$app->db->getLastInsertID();
        if($row) {
            return $id;
        }else{
            return false;
        }
    }

    public function edit($where,$data){
        $row=\Yii::$app->db->createCommand()->update('beauty_category',$where,$data)->execute();
        return $row;
    }
}