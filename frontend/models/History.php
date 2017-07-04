<?php
namespace frontend\models;

use backend\models\Category;
use backend\models\Goods;
use yii\db\ActiveRecord;

class History extends ActiveRecord{
    public static function tableName(){
        return "{{%history}}";
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }

    public function addHistory($mid,$gid){
        if(is_int($mid) && $mid>0){
            $where['mid']=$mid;
            $where['gid']=$gid;
            $info=History::findOne($where);
            if($info){
                $info->addtime=time();
                $info->save();
            }else{
                $history= new History();
                $history->mid=$mid;
                $history->gid=$gid;
                $history->addtime=time();
                $history->save();
            }
        }else{
            \Yii::$app->session->set("gid_{$gid}",$gid);
        }
    }

    public function historyList($mid){
        if(is_int($mid) && $mid>0){
            $list=History::find()
                ->where(['mid'=>$mid])
                ->joinWith('goods')
                ->orderBy('addtime desc')
                ->asArray()
                ->all();

        }else{
            /*foreach(session() as $v1) {
                foreach($v1 as $v2){
                    $list[]=Goods::find()->where(['id'=>$v2['id']])->orderBy('addtime desc')->asArray()->one();
                    $list=array_reverse($list);
                }
            }*/
            $list=[];
        }
        return $list;
    }

    public function recommend($gid){
        $info=Goods::findOne($gid);
        $category=Category::findOne($info['cid']);
        $where['cid']=$category['pid'];
        $condition=['!=','id',$gid];
        $list=Goods::find()->where($where)->andWhere($condition)->asArray()->all();
        return $list;
    }

    public function collect(){

    }
}