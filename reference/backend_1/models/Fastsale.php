<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Fastsale extends Model{
    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_fastsale_goods',$where)->execute();
        return $row;
    }

    public function getSaleTop($num){
        $list=(new Query())->select('*')->from('mj_fastsale_goods')->where(['is_promote',1])->limit($num)->all();
        return $list;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_fastsale_goods')->where($where)->one();
        return $info;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_fastsale_goods',$where,$data)->execute();
        return $row;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_fastsale_goods',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }
}