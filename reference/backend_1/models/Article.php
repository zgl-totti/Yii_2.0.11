<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Article extends Model{
    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_article')->where($where)->one();
        return $info;
    }

    public function add($data){
        $row=\Yii::$app->db->createCommand()->insert('mj_article',$data)->execute();
        if($row) {
            $id = \Yii::$app->db->getLastInsertID();
            return $id;
        }else{
            return false;
        }
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_article',$where,$data)->execute();
        return $row;
    }

    public function num($where){
        $count=(new Query())->select('*')->from('mj_article')->where($where)->count();
        return $count;
    }

    public function getAll($where,$pages,$order='id asc'){
        $list=(new Query())->select('*')->from('mj_article')->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();
        return $list;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_article',$where);
        return $row;
    }

    //文章点击量数据统计
    public function clickTop($num){
        $res=(new Query())->select('title,click_num')->from('mj_article')
            ->orderBy('click_num','desc')
            ->limit($num)
            ->all();
        return $res;
    }

    //文章分类和数量统计
    public function getType($n){
        $res=(new Query())->select('*')->from('mj_article_category')
            ->where('pid',0)
            ->limit($n)
            ->all();
        foreach($res as $k=>$v){
            $id=$v['id'];
            $count=(new Query())->select('id')->from('mj_article')
                ->where('type_id',$id)
                ->count();
            $num['article_num']=$count;
            $where['id']=$id;
            \Yii::$app->db->createCommand()->update('mj_article_category',$where,$num);
        }
        return $res;
    }
}