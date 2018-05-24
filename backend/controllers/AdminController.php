<?php
namespace backend\controllers;

use backend\models\Admin;
use yii\data\Pagination;
use yii\helpers\Json;

class AdminController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

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
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){

            //使用场景
            $admin= new Admin();
            $admin->scenario='create';

            if($admin->load(\Yii::$app->request->post(),'') && $admin->validate()){
                $data['username']=$admin->username;
                $info=Admin::find()->where($data)->one();
                if(!$info) {
                    $password=$admin->password;
                    $pwd=md5($password);
                    $admin->password=$pwd;
                    $admin->addtime=time();
                    $admin->logintime=time();
                    $admin->loginip=\Yii::$app->request->getUserIP();
                    $row = $admin->save();
                    if ($row) {
                        return Json::encode(['code' => 1, 'body' => '添加成功']);
                    } else {
                        return Json::encode(['code' => 2, 'body' => '添加失败']);
                    }
                }else{
                    return Json::encode(['code' => 3, 'body' => '管理员已存在']);
                }
            }else{
                return Json::encode(['code'=>4,'body'=>$admin->getErrors()]);
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
            $gender=trim(\Yii::$app->request->post('gender'));
            $password=trim(\Yii::$app->request->post('password'));
            $pwd=md5($password);
            $info=Admin::findOne($id);
            $info->gender=$gender;
            $info->password=$pwd;
            $row=$info->save();
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