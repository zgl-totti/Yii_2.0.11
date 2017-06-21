<?php
namespace backend\controllers;

use backend\models\Feedback;
use yii\data\Pagination;
use yii\helpers\Json;

class FeedbackController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    //回馈列表
    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','{{%member}}.username',$keywords];
        }else{
            $where='';
        }
        $feedback=Feedback::find()->joinWith('member')->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$feedback->count(),
        ]);
        $list=$feedback->select('{{%feedback}}.*,{{%member}}.username')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionDetail(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $reply=trim(\Yii::$app->request->post('reply'));
            $info=Feedback::findOne($id);
            if($info['reply']==$reply){
                return Json::encode(['code'=>3,'body'=>'暂无操作']);
            }else{
                $info->reply=$reply;
                if($info->save()){
                    return Json::encode(['code'=>1,'body'=>'操作成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'操作失败']);
                }
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Feedback::find()->joinWith('member')
                ->select('{{%feedback}}.*,{{%member}}.username')
                ->where(['{{%feedback}}.id'=>$id])
                ->asArray()->one();
            return $this->render('detail',['info'=>$info]);
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Feedback::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }
}