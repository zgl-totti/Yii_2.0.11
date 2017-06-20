<?php
namespace backend\controllers;

use backend\models\Member;
use yii\data\Pagination;
use yii\helpers\Json;

class MemberController extends BaseController{
    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','username',$keywords];
        }else{
            $where='';
        }
        $member=Member::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$member->count(),
        ]);
        /*$list=$member->order("addtime")->join('shop_level ON shop_member.level=shop_level.lid')
            ->where($condition)
            ->limit($page->firstRow.",".$page->listRows)
            ->select();*/
        $list=$member->joinWith('level')
            ->select('member.*')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        print_r($list);die;
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        /*$abc=$member->where($where)->join('shop_level ON shop_member.level=shop_level.lid')->select();*/
        $info=Member::find()->joinWith('level')->where(['member.id'=>$id])->one();
        return $this->render('detail',['info'=>$info]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Member::findOne($id);
            $data['active']=($info['active']==0)?1:0;
            if($info->load($data) && $info->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Member::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionLevel(){
        $member=Member::find();
        $where1['level']=1;
        $count1=$member->where($where1)->count();
        $pages= new Pagination([
            'pageSize'=>20,
            'totalCount'=>$count1,
        ]);

        /*$list=$member->order("addtime")->join('shop_level ON shop_member.level=shop_level.lid')
            ->where('level=1')->limit($page->firstRow.",".$page->listRows)
            ->select();
        $map['key']=I('get.keywords');
        foreach ($map as $key=>$v){
            $page->parameter[$key]=urlencode($v);
        }*/

        $list1=$member->joinWith('level')->where($where1)
            ->offset($pages->offset)->limit($pages->limit)
            ->orderBy('addtime')->all();
        $where2['level']=2;
        $count2=$member->where($where2)->count();
        $list2=$member->joinWith('level')->where($where2)
            ->offset($pages->offset)->limit($pages->limit)
            ->orderBy('addtime')->all();
        $where3['level']=3;
        $count3=$member->where($where3)->count();
        $list3=$member->joinWith('level')->where($where3)
            ->offset($pages->offset)->limit($pages->limit)
            ->orderBy('addtime')->all();
        $where4['level']=4;
        $count4=$member->where($where4)->count();
        $list4=$member->joinWith('level')->where($where4)
            ->offset($pages->offset)->limit($pages->limit)
            ->orderBy('addtime')->all();
        $where5['level']=5;
        $count5=$member->where($where5)->count();
        $list5=$member->joinWith('level')->where($where5)
            ->offset($pages->offset)->limit($pages->limit)
            ->orderBy('addtime')->all();
        return $this->render('index',[
            'count1'=>$count1,'list1'=>$list1,
            'count2'=>$count2,'list2'=>$list2,
            'count3'=>$count3,'list3'=>$list3,
            'count4'=>$count4,'list4'=>$list4,
            'count5'=>$count5,'list5'=>$list5,
            'pages'=>$pages
        ]);
    }
}