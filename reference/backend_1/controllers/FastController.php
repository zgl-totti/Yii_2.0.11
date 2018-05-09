<?php
namespace backend\controllers;


use backend\models\Category;
use backend\models\Fastsale;
use backend\models\Goods;
use yii\data\Pagination;
use yii\helpers\Json;

class FastController extends BaseController{
    public function actionShow(){
        $cat_id=\Yii::$app->request->get('cat_id');
        $goodsname=\Yii::$app->request->get('goodsname');
        if($cat_id && $goodsname){
            $where=['and',['cat_id',$cat_id],['like','goodsname',$goodsname]];
        }elseif($cat_id && !$goodsname){
            $where=['cat_id',$cat_id];
        }elseif($goodsname && !$cat_id){
            $where=['like','goodsname',$goodsname];
        }else{
            $where='';
        }
        $goods= new Goods();
        $fastsale= new Fastsale();
        $category= new Category();
        $cateList=$category->getAll();
        $count=$goods->goodsCount($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $order=['is_promote','desc'];
        $list=$goods->getList($where,$pages,$order);
        foreach ($list as $k => $val) {
            $data['goods_id'] = $val['goods_id'];
            $info=$fastsale->getOne($data);
            $list[$k]['fast_num'] = $info['fast_num'];
            $list[$k]['start_time'] = strtotime('2017-05-01 00:00:00');
            $list[$k]['end_time'] = strtotime('2017-06-01 00:00:00');
            $list[$k]['promote_price'] = $info['promote_price'];
            $list[$k]['is_recommend'] = $info['is_recommend'];
        }
        return $this->renderPartial('show',[
            'goodsname'=>$goodsname,
            'cateList'=>$cateList,
            'list'=>$list,
            'pages'=>$pages
        ]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $goods= new Goods();
            $fastsale= new Fastsale();
            $where['id']=$id;
            $info=$goods->getOne($where);
            $data = $_POST;
            $data['shop_price'] = $info['shop_price'];
            $data['goods_id'] = $info['goods_id'];
            $starttime=strtotime('2017-05-01 00:00:00');
            $endtime=strtotime('2017-06-01 00:00:00');
            $data['end_time'] = $endtime;
            $time=$starttime-$endtime;
            if($time>0){
                $data['start_time'] = strtotime($starttime);
            }else{
                $data['start_time']=time();
            }
            $data['goods_name'] = $info['goodsname'];
            $data['add_time']=time();
            if($info['is_promote']==1){
                $condition['goods_id']=$id;
                $row=$fastsale->update($condition,$data);
            }else{
                $row=$fastsale->add($data);
            }
            if($row){
                $factor['goods_id']=$id;
                $arr['is_promote'] = 1;
                $arr['promote_price']=$data['promote_price'];
                $arr['promote_num']=$data['fast_num'];
                $goods->update($factor,$arr);
                $res['status']=1;
                $res['info']='编辑成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='编辑失败！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $goods= new Goods();
            $fastsale= new Fastsale();
            $where['goods_id']=$id;
            $goodsInfo=$goods->getOne($where);
            $saleInfo=$fastsale->getOne($where);
            $goodsInfo['fast_num']=$saleInfo['fast_num'];
            $starttime=strtotime('2017-05-01 00:00:00');
            $goodsInfo['start_time'] = $starttime;
            $goodsInfo['promote_price'] = $saleInfo['promote_price'];
            $goodsInfo['is_recommend'] = $saleInfo['is_recommend'];
            return $this->renderPartial('edit',['goodsInfo'=>$goodsInfo]);
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $fastsale= new Fastsale();
            $goods= new Goods();
            $id=\Yii::$app->request->post('id');
            $where['goods_id']=$id;
            $row=$fastsale->del($where);
            if($row){
                $data['is_promote']=0;
                $num=$goods->update($where,$data);
                if($num){
                    $res['status']=1;
                    $res['info']='下架成功！';
                    return Json::encode($res);
                }else{
                    $res['status']=2;
                    $res['info']='下架失败！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=3;
                $res['info']='下架失败！';
                return Json::encode($res);
            }
        }
    }

    public function actionGetCartSale(){
        if(\Yii::$app->request->isAjax){
            $category= new Category();
            $goods= new Goods();
            $where['is_promote']=1;
            $cateInfo=$category->getAll();
            $goodsInfo=$goods->getAll($where);
            foreach($cateInfo as $k=>$v){
                $goodsInfo['x'][$k]=$v['cat_name'];
                $id=$v['cat_id'];
                $condition['cat_id']=$id;
                $count=$goods->num($condition);
                $goodsInfo['y'][$k]['name']=$v['cat_name'];
                $goodsInfo['y'][$k]['value']=$count;
            }
            if($goodsInfo){
                $res['status']=1;
                $res['info']=$goodsInfo;
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='没有查到数据！';
                return Json::encode($res);
            }
        }
    }

    public function actionFastSaleTop($num=8){
        if(\Yii::$app->request->isAjax){
            $fastsale= new Fastsale();
            $list=$fastsale->getSaleTop($num);
            foreach($list as $k=>$val){
                $fastList['x'][$k]=mb_substr($val['goodsname'],0,18,'utf-8');
                $fastList['y'][$k]=$val['sale_num'];
            }
            if($fastList){
                $res['status']=1;
                $res['info']=$fastList;
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='没有查到数据！';
                return Json::encode($res);
            }
        }
    }
}

