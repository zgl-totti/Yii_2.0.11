<?php
namespace frontend\controllers;


use frontend\models\Collect;
use yii\helpers\Json;

class CollectController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;
    public $mid;

    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid',47);
        if(is_int($mid) && $mid>0){
            $this->mid=$mid;
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $gid=\Yii::$app->request->post('gid');
            $mid=$this->mid;
            if($mid){
                $where['mid']=$mid;
                $where['gid']=$gid;
                $info=Collect::findOne($where);
                if($info){
                    return Json::encode(['code'=>2,'body'=>'该商品已经收藏过了']);
                }
                $collect= new Collect();
                $collect->mid=$this->mid;
                $collect->gid=$gid;
                $collect->addtime=time();
                if($collect->save()){
                    return Json::encode(['code'=>1,'body'=>'收藏成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'收藏失败']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'请先登录']);
            }
        }
    }
}