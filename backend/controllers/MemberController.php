<?php
namespace backend\controllers;

use backend\models\Member;
use yii\data\Pagination;
use yii\helpers\Json;

class MemberController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

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
        $list=$member->joinWith('level')
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=Member::find()->joinWith('level')
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->where(['{{%member}}.id'=>$id])
            ->asArray()->one();
        return $this->render('detail',['info'=>$info]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Member::findOne($id);
            $info->active=($info['active']==0)?1:0;
            if($info->save()){
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
        $where1['level']=1;
        $count1=Member::find()->where($where1)->count();
        $pages1= new Pagination(['pageSize'=>20, 'totalCount'=>$count1]);
        $list1=Member::find()->joinWith('level')->where($where1)
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages1->offset)->limit($pages1->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();

        /*$list=$member->order("addtime")->join('shop_level ON shop_member.level=shop_level.lid')
            ->where('level=1')->limit($page->firstRow.",".$page->listRows)
            ->select();
        $map['key']=I('get.keywords');
        foreach ($map as $key=>$v){
            $page->parameter[$key]=urlencode($v);
        }*/

        $where2['level']=2;
        $count2=Member::find()->where($where2)->count();
        $pages2= new Pagination(['pageSize'=>20, 'totalCount'=>$count2]);
        $list2=Member::find()->joinWith('level')->where($where2)
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages2->offset)->limit($pages2->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        $where3['level']=3;
        $count3=Member::find()->where($where3)->count();
        $pages3= new Pagination(['pageSize'=>20, 'totalCount'=>$count3]);
        $list3=Member::find()->joinWith('level')->where($where3)
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages3->offset)->limit($pages3->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        $where4['level']=4;
        $count4=Member::find()->where($where4)->count();
        $pages4= new Pagination(['pageSize'=>20, 'totalCount'=>$count4]);
        $list4=Member::find()->joinWith('level')->where($where1)
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages4->offset)->limit($pages4->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        $where5['level']=5;
        $count5=Member::find()->where($where5)->count();
        $pages5= new Pagination(['pageSize'=>20, 'totalCount'=>$count5]);
        $list5=Member::find()->joinWith('level')->where($where5)
            ->select('{{%member}}.*,{{%level}}.level_name')
            ->offset($pages5->offset)->limit($pages5->limit)
            ->orderBy('addtime')
            ->asArray()
            ->all();
        $count['count1']=$count1;
        $count['count2']=$count2;
        $count['count3']=$count3;
        $count['count4']=$count4;
        $count['count5']=$count5;
        $pages['pages1']=$pages1;
        $pages['pages2']=$pages2;
        $pages['pages3']=$pages3;
        $pages['pages4']=$pages4;
        $pages['pages5']=$pages5;
        $list['list1']=$list1;
        $list['list2']=$list2;
        $list['list3']=$list3;
        $list['list4']=$list4;
        $list['list5']=$list5;
        return $this->render('level',['list'=>$list,'pages'=>$pages,'count'=>$count]);
    }
}