<?php
namespace frontend\controllers;

use backend\models\Goods;
use backend\models\GoodsComment;
use backend\models\Member;
use frontend\models\Collect;
use frontend\models\History;
use yii\helpers\Json;
use yii\web\Controller;

class GoodsController extends BaseController{
    public $mid;
    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid');
        $info=Member::findOne($mid);
        \Yii::$app->view->params['info']=$info;
        $this->mid=$mid;
    }

    public function actionIndex(){
        $gid=\Yii::$app->request->get('gid');
        $info=Goods::find()->alias('g')->where(['g.id'=>$gid])->joinWith('pics')->asArray()->one();
        $history= new History();
        $history->addHistory($this->mid,$gid);
        $historyList=$history->historyList($this->mid);
        $recommend=$history->recommend($gid);
        $count=GoodsComment::find()->where(['gid'=>$gid])->count();
        $collect= new Collect();
        $collectGoods=$collect->collect($this->mid,$gid);
        return $this->render('index',[
            'info'=>$info,
            'historyList'=>$historyList,
            'recommend'=>$recommend,
            'count'=>$count,
            'collectGoods'=>$collectGoods
        ]);
    }

    //评论
    public function actionComment(){
        if(\Yii::$app->request->isAjax){
            $gid=\Yii::$app->request->post('gid');
            $where['gid']=$gid;
            $star=\Yii::$app->request->post('star');
            if($star==1){
                $condition=['between','start','4,5'];
            }elseif($star==2){
                $condition['start']=3;
            }elseif($star==3){
                $condition=['between','start','1,2'];
            }else{
                $condition=['between','start','1,5'];
            }
            $list=GoodsComment::find()
                ->where($where)->andWhere($condition)
                ->joinWith('member')
                ->asArray()->all();
            if($list){
                return Json::decode(Json::encode($list));
            }else{
                return false;
            }
        }
    }

    //收藏
    public function actionCollect(){
        if(is_int($this->mid) && $this->mid>0){
            $where['mid']=$this->mid;
            $where['gid']=\Yii::$app->request->post('gid');
            $info=Collect::findOne($where);
            if($info){
                if($info->delete()) {
                    return Json::encode(['code' => 1, 'body' => '操作成功']);
                }else{
                    return Json::encode(['code' => 2, 'body' => '操作失败']);
                }
            }else{
                $collect= new Collect();
                $where['addtime']=time();
                if($collect->load($where) && $collect->save()){
                    return Json::encode(['code' => 1, 'body' => '操作成功']);
                }else{
                    return Json::encode(['code' => 2, 'body' => '操作失败']);
                }
            }
        }else{
            return Json::encode(['code'=>3,'body'=>'请先登录']);
        }
    }
}