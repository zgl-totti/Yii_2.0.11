<?php
namespace backend\controllers;

use backend\models\Brand;
use backend\models\Category;
use backend\models\Goods;
use backend\models\GoodsComment;
use yii\data\Pagination;
use yii\helpers\Json;

class GoodsController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }
        $condition['delete']=0;
        $goods=Goods::find()->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$goods->count()
        ]);
        $list=$goods->joinWith('cate')
            ->joinWith('brand')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()->all();
        return $this->render('index',['list'=>$list,'keywords'=>$keywords,'pages'=>$pages]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){

        }else{
            $id=\Yii::$app->request->get('id');
            $info=Goods::find()->alias('g')
                ->where(['g.id'=>$id])
                ->joinWith('cate')
                ->joinWith('brand')
                ->joinWith('pics')
                ->asArray()
                ->one();
            //print_r($info);die;
            $list=Category::find()->orderBy('path')->asArray()->all();
            foreach($list as $val){
                $space=count(explode(',',$val['path']));
                $val['catename']=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$space).$val['catename'];
                $category[]=$val;
            }
            $brand=Brand::find()->asArray()->all();
            return $this->render('edit',['info'=>$info,'category'=>$category,'brand'=>$brand]);
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Goods::findOne($id);
            $info->display=$info['display']==0?1:0;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'状态更改成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'状态更改失败']);
            }
        }
    }

    public function actionAddRecycle(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Goods::findOne($id);
            $info->delete=1;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'加入回收站成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'加入回收站失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Goods::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){

        }else{
            $list=Category::find()->orderBy('path')->asArray()->all();
            foreach($list as $val){
                $space=count(explode(',',$val['path']));
                $val['catename']=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$space).$val['catename'];
                $category[]=$val;
            }
            $brand=Brand::find()->asArray()->all();
            return $this->render('add',['category'=>$category,'brand'=>$brand]);
        }
    }

    public function actionRecycle(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }
        $condition['delete']=1;
        $goods=Goods::find()->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$goods->count()
        ]);
        $list=$goods->joinWith('cate')
            ->joinWith('brand')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()->all();
        return $this->render('recycle',['list'=>$list,'keywords'=>$keywords,'pages'=>$pages]);
    }

    public function actionRecover(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Goods::findOne($id);
            $info->delete=0;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'恢复成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'恢复失败']);
            }
        }
    }

    public function actionComment(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','g.goodsname',$keywords];
        }else{
            $where='';
        }
        $comment=GoodsComment::find()->where($where)->joinWith('goods g');
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$comment->count()
        ]);
        $list=$comment->joinWith('member')
            ->offset($pages->offset)->limit($pages->limit)
            ->asArray()->all();
        return $this->render('comment',['keywords'=>$keywords,'list'=>$list,'pages'=>$pages]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=GoodsComment::find()->alias('c')
            ->where(['c.id'=>$id])
            ->joinWith('goods')
            ->joinWith('member')
            ->asArray()
            ->one();
        return $this->render('detail',['info'=>$info]);
    }

    public function actionReply(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $reply=trim(\Yii::$app->request->post('replycontent'));
            if($reply){
                $comment=GoodsComment::findOne($id);
                $comment->replycontent=$reply;
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
            $info=GoodsComment::find()->alias('c')
                ->where(['c.id'=>$id])
                ->joinWith('goods')
                ->joinWith('member')
                ->asArray()
                ->one();
            return $this->render('reply',['info'=>$info]);
        }
    }

    public function actionDelComment(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=GoodsComment::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionCommentOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=GoodsComment::findOne($id);
            $info->isshow=$info['isshow']==0?1:0;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'状态更改成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'状态更改失败']);
            }
        }
    }
}