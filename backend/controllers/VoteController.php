<?php
namespace backend\controllers;

use backend\models\Activity;
use backend\models\Filter;
use backend\models\Vote;
use yii\data\Pagination;
use yii\helpers\Json;

class VoteController extends BaseController{
    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
            $condition=['eq','addvote',1];
        }else{
            $where='';
            $condition=['addvote',1];
        }

        /*if($condition["goodsname"]){
            $voteList=$activity->alias("a")->field("g.pic,g.goodsname,a.votecount,a.starttime,a.endtime,a.id")
                ->where($condition)->order("votecount desc")->join("shop_goods g on g.id=a.gid")
                ->limit($page->firstRow.','.$page->listRows)->select();
        }else{
            $voteList=$activity->alias("a")->field("g.pic,g.goodsname,a.votecount,a.starttime,a.endtime,a.id")
                ->where("a.addvote=1")->order("votecount desc")->join("shop_goods g on g.id=a.gid")
                ->limit($page->firstRow.','.$page->listRows)->select();
        }
        $map["key"]=I("get.keywords");
        foreach($map as $k=>$v){
            $page->parameter[$k]=urlencode($v);
        }*/

        $activity=Activity::find()->joinWith('goods')->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$activity->count(),
        ]);
        $list=$activity->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('votecount','desc')
            ->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    //投票记录
    public function actionRecord(){
        $activity=Activity::find();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$activity->count(),
        ]);

        /*$voteList=$vote->alias("v")->field("g.pic,g.goodsname,a.votecount,v.id,v.votetime,v.ip,v.votenum")
            ->join("shop_activity a on a.id=v.aid ")
            ->order("votetime desc")->join("shop_goods g on g.id=a.gid")
            ->limit($page->firstRow.','.$page->listRows)->select();
        foreach($voteList as $k=>$v){
            $dataIP["ip"]=$v["ip"];
            $filterInfo=M("Vote_filter")->where($dataIP)->count();
            $voteList[$k]["black"]=$filterInfo;
        }*/

        $list=$activity->joinWith('goods')->joinWith('vote')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        foreach($list as $k=>$v){
            $where['ip']=$v['ip'];
            $info=Filter::find()->where($where)->count();
            $list[$k]['black']=$info;
        }
        return $this->render('record',['pages'=>$pages,'list'=>$list]);

    }

    //增加票数
    public function actionAddVote(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $data['votecount']=$info['votecount']+10;
            if($info->load($data) && $info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //减少票数
    public function actionJianshao(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Activity::findOne($id);
            $data['votecount']=$info['votecount']-10;
            if($info->load($data) && $info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //加入黑名单
    public function actionAddBlack(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $vote=Vote::findOne($id);
            $data['ip']=$vote['ip'];
            $filter= new Filter();
            if($filter->load($data) && $filter->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    //移除黑名单
    public function actionRemoveBlack(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Vote::findOne($id);
            $row=Filter::findOne(['ip'=>$info['ip']])->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }
}