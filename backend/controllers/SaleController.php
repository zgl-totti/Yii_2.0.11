<?php
namespace backend\controllers;

use yii\data\Pagination;
use yii\helpers\Json;

class SaleController extends BaseController{
    public function actionIndex(){
        $starttime=trim(\Yii::$app->request->get('starttime'));
        if($starttime){
            $where=['>=','starttime',$starttime];
        }else{
            $where='';
        }
        /*$list=$active->alias('a')->join('shop_goods g ON g.id= a.gid')
            ->field('a.id,gid,goodsname,pic,starttime,endtime,addvote')
            ->where($where)->limit($page->firstRow.','.$page->listRows)
            ->select();*/
        $activity=Activity::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$activity->count(),
        ]);
        $list=$activity->joinWith('goods')->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',['pages'=>$pages,'list'=>$list,'starttime'=>$starttime]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=Goods::findOne($id);
        return $this->render('detail',['info'=>$info]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $data['addvote']=($info['addvote']==0)?1:0;
            if($info->load($data) && $info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $data['starttime']=strtotime(\Yii::$app->request->post('starttime'));
            $data['endtime']=strtotime(\Yii::$app->request->post('endtime'));
            if($data['starttime']>$data['endtime']){
                return Json::encode(['code'=>3,'body'=>'截止时间小于活动开始时间']);
            }else{
                if($info->load($data) && $info->save()){
                    return Json::encode(['code'=>1,'body'=>'编辑成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'编辑失败']);
                }
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Activity::find()->joinWith('goods')->where(['activity.id'=>$id])->one();
            return $this->render('edit',['info'=>$info]);
        }
    }
}