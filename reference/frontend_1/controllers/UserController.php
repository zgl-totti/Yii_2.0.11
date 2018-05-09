<?php
namespace frontend\controllers;

use frontend\models\User;
use yii\helpers\Json;
use yii\web\Controller;

class UserController extends Controller{
    public function actionIndex(){
        $list1=User::find()->all();
        $list2=User::find()->where(['<=','id',10])->all();
        $list3=User::find()->where(['<=','id',10])->asArray()->all();
        print_r($list1);
        echo '<br>';
        print_r($list2);
        echo '<br>';
        print_r($list3);
    }

    public function actionAdd(){
        //添加操作
        $user= new User();
        $user->username='totti';
        $user->password='roma';
        $user->insert();
    }

    public function actionEdit(){
        $id=1;
        $user=User::findOne($id);
        $user->username='roma';
        $user->update();
    }

    public function actionDel(){
        $id=1;
        $user=User::findOne($id);
        $user->delete();
    }

    public function actionWater(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $data=$_POST;
            $user=User::findOne($id);
            if($user->load($data) && $user->save()){
                return Json::encode(['code'=>1,'info'=>'更新成功']);
            }else{
                return Json::encode(['code'=>2,'info'=>'更新失败']);
            }
        }else{
            $user= new User();
            $data=$_GET;
            if($user->load($data) && $user->save()){
                return Json::encode(['code'=>1,'info'=>'添加成功']);
            }else{
                return Json::encode(['code'=>2,'info'=>'添加失败']);
            }
        }
    }
}