<?php
namespace frontend\controllers;


use backend\models\Article;

class ArticleController extends BaseController{
    public function actionIndex(){
        $id=\Yii::$app->request->get('id');
        $info=Article::findOne($id);
        $article=Article::find()->where(['active'=>1])->orderBy('addtime desc')->limit(7)->asArray()->all();
        return $this->render('index',['info'=>$info,'article'=>$article]);
    }





    /*public function article(){
        $Article=D('Article');
        $info=$Article->field('title')->group('title')->select();
        foreach($info as $k=>$v){
            $info[$k][]=$Article->where($v)->where("active=1")->field('cate,id')->select();
        }
        return   $info;
    }*/
}