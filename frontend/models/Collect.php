<?php
namespace frontend\models;

use backend\models\Goods;
use yii\db\ActiveRecord;

class Collect extends ActiveRecord{
    public static function tableName(){
        return "{{%collect}}";
    }

    public function rules(){
        return [
            [['mid','gid','addtime'],'required']
        ];
    }

    public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'gid']);
    }

    public function collect($mid,$gid){
        if(is_int($mid) && $mid>0){
            $where['mid']=$mid;
            $where['gid']=$gid;
            $info=Collect::findOne($where);
            if($info){
                return $info->attributes['id'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}