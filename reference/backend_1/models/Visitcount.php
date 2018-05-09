<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Visitcount extends Model{
    public function getOne($where){
        $info=(new Query())->select('id')->from('mj_visitcount')->where($where)->one();
        return $info;
    }
}