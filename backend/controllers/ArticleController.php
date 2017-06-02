<?php
namespace backend\controllers;

use backend\models\Article;
use yii\data\Pagination;
use yii\helpers\Json;

class ArticleController extends BaseController{
    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','title',$keywords];
        }else{
            $where='';
        }
        $count=Article::find()->where($where)->count();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=Article::find()->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=Article::findOne($id);
        return $this->render('detail',['info'=>$info]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Article::findOne($id);
            $data['active']=($info['active']==0)?1:0;
            if($info->save($data)){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            if(Article::findOne($id)->delete()){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $article= new Article();
            if($article->load(\Yii::$app->request->post()) && $article->validate()){
                if($article->save(\Yii::$app->request->post())){
                    return Json::encode(['code'=>1,'body'=>'添加成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'添加失败']);
                }
            }else{
                return Json::encode(['code'=>3,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->render('add');
        }
    }
}