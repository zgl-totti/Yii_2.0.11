<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Valuecard extends Model{
    public function getType($where=''){
        $list=(new Query())->select('*')->from('mj_valuecard_type')->where($where)->all();
        return $list;
    }

    public function getOneType($where){
        $info=(new Query())->select('*')->from('mj_valuecard_type')->where($where)->one();
        return $info;
    }

    public function addType($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_valuecard_type',$data)->execute();
        return $row;
    }

    public function updateType($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_valuecard_type',$where,$data)->execute();
        return $row;
    }

    public function delType($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_valuecard_type',$where)->execute();
        return $row;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_valuecard',$where)->execute();
        return $row;
    }

    public function getList($where){
        $list=(new Query())->select('v.*,t.*')
            ->from('mj_valuecard v')
            ->innerJoin('mj_valuecard_type t','t.type_id=v.vc_type_id')
            ->where($where)
            ->all();
        return $list;
    }
}
