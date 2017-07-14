<?php
namespace frontend\controllers;


use backend\models\News;
use backend\models\NewsComment;
use yii\data\Pagination;
use yii\helpers\Json;

class NewsController extends BaseController{
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $id=\Yii::$app->request->get('id');
        $where['nid']=$id;
        $info=News::findOne($id);
        $news=News::find()->where(['isshow'=>1])->orderBy('addtime desc')->limit(7)->asArray()->all();
        $comment=NewsComment::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>6,
            'totalCount'=>$comment->count()
        ]);
        $list=$comment->joinWith('member')->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index',['info'=>$info,'news'=>$news,'list'=>$list,'pages'=>$pages]);
    }

    public function actionComment(){
        if(\Yii::$app->request->isAjax){
            $mid=\Yii::$app->session->get('mid');
            $id=\Yii::$app->request->post('id');
            if(is_int($mid) && $mid>0){
                $comment= new NewsComment();
                if($comment->load(\Yii::$app->request->post(),'') && $comment->validate()){
                    $comment->nid=$id;
                    if($comment->save()){
                        return Json::encode(['code'=>1,'body'=>'评论成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'评论失败']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'评论内容不符合规定']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'请先登录']);
            }
        }
    }

    public function actionLikeNum(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=News::findOne($id);
            $num=$info['likenum']+1;
            $info->likenum=$num;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>$num]);
            }else{
                return Json::encode(['code'=>2,'body'=>'点赞失败']);
            }
        }
    }
}