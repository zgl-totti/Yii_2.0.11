<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Advertise extends Model{
    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_advertise')->where($where)->one();
        return $info;
    }

    public function getAll($where=''){
        $list=(new Query())->select('*')->from('mj_advertise')->where($where)->all();
        return $list;
    }

    public function getList($where='',$pages,$order='id desc'){
        $list=(new Query())->select('*')->from('mj_advertise')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();
        return $list;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_advertise',$where)->execute();
        return $row;
    }

    //广告类型
    public function type(){
        $type=(new Query())->select('*')->from('mj_goods_category')->all();
        $type[6]['cat_id']=7;
        $type[6]['cat_name']='手机端';
        return $type;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_advertise',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return $row;
        }
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_advertise',$where,$data)->execute();
        return $row;
    }

    public function num($where){
        $count=(new Query())->select('*')->where($where)->count();
        return $count;
    }
}