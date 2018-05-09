<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Admin extends Model{
    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_admin_user')->where($where)->one();
        return $info;
    }

    public function edit($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_admin_user',$where,$data)->execute();
        return $row;
    }
}