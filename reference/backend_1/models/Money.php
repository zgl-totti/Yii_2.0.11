<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Money extends Model{
    public function getChange($where,$pages){
        $list=(new Query())->select('l.*,m.username*')
            ->from('mj_money_log l')
            ->join('mj_member m','m.id=l.uid')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function num($where){
        $count=(new Query())->select('id')->from('mj_money_log')->where($where)->count();
        return $count;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_money_log',$data)->execute();
        if($row){
            $id=\Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return $row;
        }
    }
}