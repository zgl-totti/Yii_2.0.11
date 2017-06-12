<?php
namespace backend\controllers;

use backend\models\Feedback;
use yii\data\Pagination;
use yii\helpers\Json;

class FeedbackController extends BaseController{
    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','username',$keywords];
        }else{
            $where='';
        }
        $feedback=Feedback::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$feedback->count(),
        ]);
        /*$list = D('Feedback')->join('shop_member on shop_member.id = shop_feedback.mid')
            ->field('feedback_id,username,content,reply,shop_feedback.addtime,feedback_admin')
            ->where($map)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();*/
        $list=$feedback->offset($pages->offset)->limit($pages->limit)->asArray()->all();
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
                $data['reply']=$reply;
                if($info->load($data) && $info->save()){
                    return Json::encode(['code'=>1,'body'=>'操作成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'操作失败']);
                }
            }
        }else{
            /*$feed = D('Feedback')->join('shop_member on shop_member.id = shop_feedback.mid')
                ->field('feedback_id,username,content,reply,shop_feedback.addtime,feedback_admin')
                ->where(array("feedback_id"=>I('get.id')))
                ->find();*/
            $id=\Yii::$app->request->get('id');
            $info=Feedback::findOne($id);
            return $this->render('detail',$info);
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