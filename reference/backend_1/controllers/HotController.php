<?php
namespace backend\controllers;


use backend\models\Goods;
use backend\models\Hotsale;
use yii\data\Pagination;
use yii\helpers\Json;

class HotController extends BaseController{
    public function actionShow(){
        $goodsname=\Yii::$app->request->get('goodsname');
        if($goodsname){
            $where=['and',['like','goodsname',$goodsname],['is_hot',1]];
        }else {
            $where['is_hot'] = 1;
        }
        $goods= new Goods();
        $hotsale= new Hotsale();
        $count=$goods->num($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $order='addtime desc';
        $list=$goods->getList($where,$pages,$order);
        foreach ($list as $k => $val) {
            $condition['goods_id'] = $val['goods_id'];
            $info=$hotsale->getOne($condition);
            $list[$k]['start_time'] = $info['start_time'];
            $list[$k]['end_time'] = $info['end_time'];
        }
        return $this->renderPartial('show',['list'=>$list,'pages'=>$pages]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $goods= new Goods();
            $info=$goods->getOne($where);
            $data=$_POST;
            $data['goods_name'] = $info['goodsname'];
            $data['add_time']=time();
            $data['shop_price'] = $info['shop_price'];
            $data['goods_id'] = $info['goods_id'];
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $time=$data['end_time']-time();
            if($time>0){
                $hotsale= new Hotsale();
                $condition['goods_id']=$id;
                $info=$hotsale->getOne($condition);
                if($info){
                    $row=$hotsale->update($condition,$data);
                }else{
                    $row=$hotsale->add($data);
                }
                if($row){
                    $res['status']=1;
                    $res['info']='热销更新成功！';
                    return $res;
                }else{
                    $res['status']=2;
                    $res['info']='热销更新失败！';
                    return $res;
                }
            }else{
                $res['status']=3;
                $res['info']='结束时间不能小于开始时间！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $goods= new Goods();
            $info=$goods->getOne($where);
            return $this->renderPartial('edit',['info'=>$info]);
        }
    }
}

