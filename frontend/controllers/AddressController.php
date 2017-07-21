<?php
namespace frontend\controllers;


use backend\models\Address;
use yii\helpers\Json;

class AddressController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;

    /*public $mid;
    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid',47);
        if(is_int($mid) && $mid>0){
            $this->mid=$mid;
        }else{
            return $this->redirect(['/login/index']);
        }
    }*/

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $address= new Address();
            if($address->load(\Yii::$app->request->post(),'') && $address->validate()){
                $num=Address::find()->where(['mid'=>$this->mid])->count();
                if($num>5){
                    return Json::encode(['code'=>5,'body'=>'最多只能添加5个收货地址']);
                }
                $mobile=$address->mobile;
                if(preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
                    $site=trim($address->province).trim($address->city).trim($address->town).trim($address->jiedao);
                    $address->address=$site;
                    $address->addtime=time();
                    $address->mid=$this->mid;
                    if($address->save()){
                        return Json::encode(['code'=>1,'body'=>'添加成功']);
                    }else{
                        return Json::encode(['code'=>5,'body'=>'添加失败']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'手机号码格式不正确']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $address=Address::findOne($id);
            if($address->load(\Yii::$app->request->post(),'') && $address->validate()){
                $mobile=trim(\Yii::$app->request->post('mobile'));
                if(preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
                    $site=trim($address->province).trim($address->city).trim($address->town).trim($address->jiedao);
                    $address->address=$site;
                    $address->addtime=time();
                    if($address->save()){
                        return Json::encode(['code'=>1,'body'=>'修改成功']);
                    }else{
                        return Json::encode(['code'=>5,'body'=>'修改失败']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'手机号码格式不正确']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'必填项不能为空']);
            }


        }else{
            $id=\Yii::$app->request->get('id');
            $info=Address::findOne($id);
            return $this->render('edit',['info'=>$info]);
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Address::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionSetDefault(){
        if(\Yii::$app->request->isAjax){
            $where['mid']=$this->mid;
            $where['isdefault']=1;
            $address=Address::findOne($where);
            if($address){
                $address->default=0;
                $address->save();
            }
            $id=\Yii::$app->request->post('id');
            $info=Address::findOne($id);
            $info->isdefault=1;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'设置成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'设置失败']);
            }
        }
    }
}