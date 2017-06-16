<?php
namespace backend\controllers;

use backend\models\Admin;
use yii\data\Pagination;
use yii\helpers\Json;

class AdminController extends BaseController{
    public $layout=false;
    public function actionIndex(){
        $keywords=\Yii::$app->request->get('keywords');
        if($keywords) {
            $where = ['like', 'username', $keywords];
        }else{
            $where='';
        }
        $count=Admin::find()->where($where)->count();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=Admin::find()->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        /*foreach($list as $k=>$v){

        }*/
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $admin= new Admin();
            if($admin->load(\Yii::$app->request->post()) && $admin->validate()){
                $data['username']=\Yii::$app->request->post('username');
                $info=Admin::find()->where($data)->one();
                if(!$info) {
                    $password=trim(\Yii::$app->request->post('password'));
                    $data['password']=md5($password);
                    $data['addtime']=time();
                    $data['gender']=trim(\Yii::$app->request->post('gender'));
                    $row = $admin->save($data);
                    if ($row) {
                        return Json::encode(['code' => 1, 'body' => '添加成功']);
                    } else {
                        return Json::encode(['code' => 2, 'body' => '添加失败']);
                    }
                }else{
                    return Json::encode(['code' => 3, 'body' => '管理员已存在']);
                }
            }else{
                return Json::encode(['code'=>3]);
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Admin::findOne($id);
            $info->active=($info['active']==0)?1:0;
            $row=$info->save();
            if($row){
                return Json::encode(['code'=>1,'body'=>'操作成功！']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败！']);
            }
        }
    }

    //删除管理员
    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Admin::findOne($id);
            $aid=\Yii::$app->session->get('aid');
            $userInfo=Admin::findOne($aid);
            if($aid==1 OR ($userInfo['permission']==1 && $info['permission']!=1)){
                $row=$info->delete();
                if($row){
                    return Json::encode(['code'=>1,'body'=>'删除成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'删除失败']);
                }
            }else{
                return Json::encode(['code'=>3,'body'=>'你没有权限']);
            }
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $data['gender']=trim(\Yii::$app->request->post('gender'));
            $password=trim(\Yii::$app->request->post('password'));
            $data['password']=md5($password);
            $info=Admin::findOne($id);
            $row=$info->save($data);
            if($row){
                return Json::encode(['code'=>1,'body'=>'编辑成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'编辑失败']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Admin::findOne($id);
            return $this->render('edit',['info'=>$info]);
        }
    }
}