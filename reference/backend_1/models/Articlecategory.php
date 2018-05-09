<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Articlecategory extends Model{
    public function getAll($where){
        $list=(new Query())->select('*')->from('mj_article_category')->where($where)->all();
        return $list;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_article_category')->where($where)->one();
        return $info;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_article_category',$where,$data)->execute();
        return $row;
    }
}