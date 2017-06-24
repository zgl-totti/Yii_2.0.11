<?php
namespace backend\controllers;

use backend\models\Advertise;
use backend\models\UploadForm;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class AdvertiseController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $adname=\Yii::$app->request->get('adname');
        $adposition=\Yii::$app->request->get('position');
        if($adname){
            $where=['like','adname',$adname];
        }else{
            $where='';
        }
        if($adposition){
            $conditon=['adposition',$adposition];
        }else{
            $conditon='';
        }
        $count=Advertise::find()->where($where)->andWhere($conditon)->count();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=Advertise::find()->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('adposition,top desc')
            ->asArray()
            ->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'adname'=>$adname]);
    }

    //展示隐藏操作
    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Advertise::findOne($id);
            if($info['top']==0){
                $map['adposition']=$info['adposition'];
                $map['top']=array('neq',0);
                $num=Advertise::find()->where($map)->count();
                if($num<3){
                    $info->top=time();
                    if($info->save()){
                        return Json::encode(['code'=>1,'body'=>'展示成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'展示失败']);
                    }
                }else{
                    return Json::encode(['code'=>3,'body'=>'超过图片展示数量']);
                }
            }else{
                $info->top=time();
                if($info->save()){
                    return Json::encode(['code'=>1,'body'=>'隐藏成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'隐藏失败']);
                }
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            if(Advertise::findOne($id)->delete()){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $advertise= new Advertise();
            if($advertise->load(\Yii::$app->request->post(),'') && $advertise->validate()){
                if(Advertise::find()->where(\Yii::$app->request->post())->one()){
                    return Json::encode(['code'=>3,'body'=>'广告已存在']);
                }else{
                    if($advertise->save()){
                        $model= new UploadForm();
                        $files=UploadedFile::getInstance($model,'file');
                        foreach($files as $file){
                            $upload= new UploadForm();
                            $upload->file=$file;
                            if($upload->validate()){
                                $upload->file->saveAs('backend/web/uploads/'.$upload->file->baseName.'/'.$upload->file->extension);
                                $data['pic']=$upload->file->baseName.'/'.$upload->file->extension;
                                if($advertise->save($data)) {
                                    return Json::encode(['code' => 1, 'body' => '添加成功']);
                                }else{
                                    return Json::encode(['code' => 2, 'body' => '添加失败']);
                                }
                            }else{
                                foreach($upload->getErrors() as $error){
                                    $model->addError('file',$error);
                                }
                                return Json::encode(['code'=>3,'body'=>'上传失败']);
                            }
                        }
                    }else{
                        return Json::encode(['code'=>4,'body'=>'添加失败']);
                    }
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $advertise= new Advertise();
            if($advertise->load(\Yii::$app->request->post()) && $advertise->validate()){
                $id=\Yii::$app->request->post('id');
                $adname=trim(\Yii::$app->request->post('adname'));
                $where['adname']=$adname;
                if(Advertise::find()->where($where)->one()){
                    return Json::encode(['code'=>4,'body'=>'广告名称已存在']);
                }else{
                    $model= new UploadForm();
                    $files=UploadedFile::getInstance($model,'file');
                    if($files){
                        foreach($files as $file){
                            $upload= new UploadForm();
                            $upload->file=$file;
                            if($upload->validate()){
                                $upload->file->saveAs('backend/web/uploads/'.$upload->file->baseName.'/'.$upload->file->extension);
                                $data['adlogo']=$upload->file->saveName;
                            }
                        }
                    }
                    $data['adname']=$adname;
                    $data['adposition']=trim(\Yii::$app->request->post('adposition'));
                    $data['top']=(\Yii::$app->request->post('top'))?time():0;
                    $row=Advertise::findOne($id)->save($data);
                    if($row){
                        return Json::encode(['code'=>1,'body'=>'编辑成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'编辑失败']);
                    }
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'必填项不能为空']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Advertise::findOne($id);
            return $this->render('edit',['info'=>$info]);
        }
    }
}