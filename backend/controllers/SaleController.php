<?php
namespace backend\controllers;

use backend\models\Activity;
use backend\models\Filter;
use backend\models\Goods;
use backend\models\Vote;
use yii\data\Pagination;
use yii\helpers\Json;

class SaleController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    //抢购
    public function actionIndex(){
        $time1=\Yii::$app->request->get('starttime');
        $time2=\Yii::$app->request->get('endtime');
        $starttime=strtotime($time1);
        $endtime=strtotime($time2);
        if($starttime && $endtime){
            $where=['between',$starttime,$endtime];
        }elseif($starttime){
            $where=['>=','starttime',$starttime];
        }elseif($endtime){
            $where=['<=','endtime',$endtime];
        }else{
            $where='';
        }
        $activity=Activity::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$activity->count(),
        ]);
        $list=$activity->joinWith('goods')->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',['pages'=>$pages,'list'=>$list,'time1'=>$time1,'time2'=>$time2]);
    }

    //抢购商品详情
    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=Activity::find()->alias('a')->where(['a.id'=>$id])->joinWith('goods')->asArray()->one();
        return $this->render('detail',['info'=>$info]);
    }

    //抢购状态操作
    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $info->addvote=($info['addvote']==0)?1:0;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //抢购设置
    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $starttime=strtotime(\Yii::$app->request->post('starttime'));
            $endtime=strtotime(\Yii::$app->request->post('endtime'));
            if($starttime>$endtime){
                return Json::encode(['code'=>3,'body'=>'截止时间不能小于活动开始时间']);
            }
            $info->starttime=$starttime;
            $info->endtime=$endtime;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'编辑成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'编辑失败']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Activity::find()->alias('a')->joinWith('goods')->where(['a.id'=>$id])->asArray()->one();
            return $this->render('edit',['info'=>$info]);
        }
    }

    //节日及店庆
    public function actionActivity(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        $activity=trim(\Yii::$app->request->get('activity'));
        if($activity){
            $condition['activity']=$activity;
        }else{
            $condition='';
        }
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }

        $goods=Goods::find()->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$goods->count(),
        ]);
        $list=$goods->joinWith('cate')->joinWith('brand')->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('activity',['pages'=>$pages,'list'=>$list,'keywords'=>$keywords,'activity'=>$activity]);
    }

    //投票列表
    public function actionVote(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }
        $condition['addvote']=1;
        $activity=Activity::find()->joinWith('goods')->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$activity->count(),
        ]);
        $list=$activity->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('votecount desc')
            ->all();
        return $this->render('vote',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    //投票记录
    public function actionRecord(){
        $vote=Vote::find();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$vote->count()
        ]);
        $list=$vote->alias('v')
            ->joinWith('activity a')
            ->innerJoin('shop_goods g','a.gid=g.id')
            ->select('v.*,g.goodsname,g.pic')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('votetime desc')
            ->asArray()->all();
        foreach($list as $k=>$v){
            $info=Filter::findAll(['ip'=>$v['ip']]);
            if($info){
                $list[$k]['black']=1;
            }else{
                $list[$k]['black']=0;
            }
        }
        return $this->render('record',['list'=>$list,'pages'=>$pages]);
    }

    //增加票数
    public function actionAddVote(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $info->votecount=$info['votecount']+10;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //减少票数
    public function actionReduce(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $info->votecount=$info['votecount']-10;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //黑名单
    public function actionBlack(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $status=\Yii::$app->request->post('status');
            $info=Vote::findOne($id);
            if($status==1){
                $row=Filter::findOne(['ip'=>$info['ip']])->delete();
                if($row){
                    return Json::encode(['code'=>1,'body'=>'移出黑名单成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'移出黑名单失败']);
                }
            }elseif($status==2){
                $arr=Filter::findOne(['ip'=>$info['ip']]);
                if($arr){
                    return Json::encode(['code'=>3,'body'=>'已在黑名单中']);
                }
                $filter= new Filter();
                $filter->ip=$info['ip'];
                if($filter->save()){
                    return Json::encode(['code'=>1,'body'=>'加入黑名单成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'加入黑名单失败']);
                }
            }
        }
    }
}