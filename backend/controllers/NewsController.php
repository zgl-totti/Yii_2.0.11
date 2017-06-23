<?php
namespace backend\controllers;

use backend\models\News;
use backend\models\NewsComment;
use yii\data\Pagination;
use yii\helpers\Json;

class NewsController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','title',$keywords];
        }else{
            $where='';
        }
        $news=News::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$news->count()
        ]);
        $list=$news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index',['keywords'=>$keywords,'list'=>$list,'pages'=>$pages]);
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=News::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $news=News::findOne($id);
            $news->isshow=$news['isshow']==0?1:0;
            if($news->save()){
                return Json::encode(['code'=>1,'body'=>'更改状态成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'更改状态失败']);
            }
        }
    }

    public function actionTop(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $news=News::findOne($id);
            $news->top=$news['top']==0?1:0;
            if($news->save()){
                return Json::encode(['code'=>1,'body'=>'更改置顶状态成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'更改置顶状态失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $news= new News();
            if($news->load(\Yii::$app->request->post()) && $news->validate()){
                $title=$news->title;
                $info=News::findOne(['title'=>$title]);
                if($info){
                    return Json::encode(['code'=>3,'body'=>'新闻已存在']);
                }
                if($news->save()){
                    return Json::encode(['code'=>1,'body'=>'添加成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'添加失败']);
                }
            }else{
                return Json::encode(['code'=>4,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionComment(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','title',$keywords];
        }else{
            $where='';
        }
        $comment=NewsComment::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$comment->count()
        ]);
        $list=$comment->joinWith('news')->joinWith('member')
            ->offset($pages->offset)->limit($pages->limit)
            ->asArray()->all();
        return $this->render('comment',['pages'=>$pages,'list'=>$list,'keywords'=>$keywords]);
    }

    public function actionCommentDetail(){
        $id=\Yii::$app->request->get('id');
        $info=NewsComment::find()->alias('c')
            ->where(['c.id'=>$id])
            ->joinWith('news')
            ->joinWith('member')
            ->asArray()->one();
        return $this->render('commentDetail',['info'=>$info]);
    }

    public function actionCommentOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $comment=NewsComment::findOne($id);
            $comment->isshow=$comment['isshow']==0?1:0;
            if($comment->save()){
                return Json::encode(['code'=>1,'body'=>'更改状态成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'更改状态失败']);
            }
        }
    }

    public function actionCommentDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=NewsComment::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionReply(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $replycontent=trim(\Yii::$app->request->post('replycontent'));
            if($replycontent){
                $comment=NewsComment::findOne($id);
                $comment->replycontent=$replycontent;
                if($comment->save()){
                    return Json::encode(['code'=>1,'body'=>'回复成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'回复失败']);
                }
            }else{
                return Json::encode(['code'=>3,'body'=>'回复内容不能为空']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            return $this->render('reply',['id'=>$id]);
        }
    }
}