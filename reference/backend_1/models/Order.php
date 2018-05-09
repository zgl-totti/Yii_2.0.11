<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Order extends Model{
    public function getTodayOrder($where){
        $prices=(new Query())->select('order_price')->from('mj_order')
            ->where($where)->where('order_status','gt',1)
            ->sum('order_price');
        $ordernum=(new Query())->select('id')->from('mj_order')->where($where)->count();
        $data['todayprice']=$prices;
        $data['todayordernum']=$ordernum;
        return $data;
    }

    public function getStatus($where){
        for($i=1;$i<=6;$i++){
            $condition['order_status']=$i;
            $data[$i]=(new Query())->select('id')->from('mj_order')
                ->where($condition)
                ->where($where)
                ->count();
        }
        return $data;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_order',$where,$data)->execute();
        return $row;
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_order')->where($where)->one();
        return $info;
    }

    public function getAll($where){
        $list=(new Query())->select('*')->from('mj_order')->where($where)->all();
        return $list;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_order',$where)->execute();
        return $row;
    }

    public function getList($where,$pages){
        $list=(new Query())->select('s.admin_opt,o.id,a.name,a.address,o.order_sn,o.order_price,o.add_time,o.order_status,a.mobile,s.status_name')
            ->from('mj_order o')
            ->join('inner join','mj_order_status s','o.order_status=s.id')
            ->innerJoin('mj_address a','o.address=a.id')
            ->where($where)
            ->orderBy(['id'=>'desc'])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function getNum($where){
        $count=(new Query())->select('o.id')
            ->from('mj_order o')
            ->join('inner join','mj_order_status s','o.order_status=s.id')
            ->innerJoin('mj_address a','o.address=a.id')
            ->where($where)
            ->count();
        return $count;
    }

    public function getOrderDetail($where){
        $list=(new Query())->select('s.*,o.id,o.user_id,o.order_sn,o.order_price,o.add_time,o.order_status,a.name,a.address,a.mobile,message')
            ->from('mj_order o')
            ->innerJoin('mj_address a','a.id=o.address')
            ->innerJoin('mj_order_status s','s.id=o.status')
            ->where($where)
            ->all();
        return $list;
    }

    public function getGoodsDetail($where){
        $list=(new Query())->select('g.img_savepath,g.goods_img,g.goodsname,g.shop_price,og.goods_number,o.order_price')
            ->from('mj_order o')
            ->innerJoin('mj_order_goods og','og.order_id=o.id')
            ->innerJoin('mj_goods g','g.goods_id=og.goods_id')
            ->where($where)
            ->all();
        return $list;
    }

    public function getReminderNum($where){
        $count=(new Query())->select('id')->from('mj_order_reminder')->where($where)->count();
        return $count;
    }

    public function updateReminder($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_order_reminder',$where,$data)->execute();
        return $row;
    }

    public function getOneReminder($where){
        $info=(new Query())->select('id')->from('mj_order_reminder')->where($where)->one();
        return $info;
    }
}