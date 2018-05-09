<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Hotsale extends Model{
    public function getOne($where){
        $info=(new Query())->select('*')->from('hotsale_goods')->where($where)->one();
        return $info;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('hotsale_goods',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('hotsale_goods',$where,$data)->execute();
        return $row;
    }
}