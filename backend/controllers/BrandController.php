<?php
namespace backend\controllers;

use backend\models\Brand;
use backend\models\UploadForm;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class BrandController extends BaseController{
    public $layout=false;
    public function actionIndex(){
        $bname=trim(\Yii::$app->request->get('bname'));
        if($bname){
            $where=['like','bname',$bname];
        }else{
            $where='';
        }
        $count=Brand::find()->where($where)->count();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=Brand::find()->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'bname'=>$bname]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Brand::findOne($id);
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
            if(Brand::findOne($id)->delete()){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $bname=trim(\Yii::$app->request->post('bname'));
            if(!$bname){
                return Json::encode(['code'=>3,'body'=>'品牌名称不能为空']);
            }
            $info=Brand::findOne(['bname'=>$bname]);
            if(!$info){
                return Json::encode(['code'=>4,'body'=>'品牌名称已存在']);
            }
            $brand= new Brand();
            $brand->bname=$bname;
            $brand->description=trim(\Yii::$app->request->post('description'));
            $brand->addtime=time();
            if($brand->save()){
                $id=\Yii::$app->db->getLastInsertID();
                $model= new UploadForm();
                $model->file=UploadedFile::getInstance($model,'file');
                if($model->validate()){
                    $model->file->saveAs('backend/web/uploads/'.$model->file->baseName.'.'.$model->file->extension);
                    $data['logo']=$model->file->baseName.$model->file->extension;
                    $arr=Brand::findOne($id);
                    if($arr->load($data) && $arr->save()){
                        return Json::encode(['code'=>1,'body'=>'添加成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'添加失败']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'上传失败']);
                }
            }else{
                return Json::encode(['code'=>6,'body'=>'添加失败']);
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $brand= new Brand();
            if($brand->load(\Yii::$app->request->post()) && $brand->validate()){
                $bname=trim(\Yii::$app->request->post('bname'));
                $info=Brand::findOne(['bname'=>$bname]);
                if(!$info){
                    $data['description']=trim(\Yii::$app->request->post('description'));
                    $data['bname']=$bname;
                    $data['addtime']=time();
                    $id=\Yii::$app->request->post('id');
                    $model=Brand::findOne($id);
                    if($model->load($data) && $model->save()){
                        $upload= new UploadForm();
                        $upload->file=UploadedFile::getInstance($upload,'file');
                        if($upload->validate()){
                            $upload->file->saveAs('backend/web/uploads/'.$upload->file->baseName.'.'.$upload->file->extension);
                            $arr['logo']=$upload->file->baseName.$upload->file->extension;
                            if($model->load($arr) && $model->save()){
                                return Json::encode(['code'=>1,'body'=>'编辑成功']);
                            }else{
                                return Json::encode(['code'=>2,'body'=>'编辑失败']);
                            }
                        }else{
                            return Json::encode(['code'=>3,'body'=>'上传失败']);
                        }
                    }else{
                        return Json::encode(['code'=>4,'body'=>'编辑失败']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'品牌名称已存在']);
                }
            }else{
                return Json::encode(['code'=>6,'body'=>'必填项不能为空']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Brand::findOne($id);
            return $this->render('edit',['info'=>$info]);
        }
    }
}