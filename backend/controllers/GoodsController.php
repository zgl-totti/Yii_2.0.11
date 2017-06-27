<?php
namespace backend\controllers;

use backend\models\Goods;
use yii\data\Pagination;
use yii\helpers\Json;

class GoodsController extends BaseController{
    public $layout=false;

    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }
        $goods=Goods::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$goods->count()
        ]);
        $list=$goods->joinWith('cate')
            ->joinWith('brand')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()->all();
        return $this->render('index',['list'=>$list,'keywords'=>$keywords,'pages'=>$pages]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){

        }else{
            $id=\Yii::$app->request->get('id');
            $info=Goods::find()->alias('g')
                ->where(['g.id'=>$id])
                ->joinWith('cate')
                ->joinWith('brand')
                ->asArray()
                ->one();
            return $this->render('edit',['info'=>$info]);
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Goods::findOne($id);
            $info->display=$info['display']==0?1:0;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'状态更改成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'状态更改失败']);
            }
        }
    }

    public function actionRecycle(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Goods::findOne($id);
            $info->delete=1;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'加入回收站成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'加入回收站失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Goods::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }
}