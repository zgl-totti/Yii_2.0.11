<?php
namespace backend\controllers;

use backend\models\Adminnav;
use yii\data\Pagination;
use yii\helpers\Json;

class NavController extends BaseController{
    public function actionIndex(){
        $nav= new Adminnav();
        $count=$nav->num();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=$nav->getList('',$pages);
        return $this->renderPartial('index',['list'=>$list,'pages'=>$pages]);
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $data['name']=\Yii::$app->request->post('item_name');
            $data['url']=\Yii::$app->request->post('item_url');
            $data['vieworder']=\Yii::$app->request->post('item_vieworder');
            $data['ifshow']=\Yii::$app->request->post('item_ifshow');
            $data['opennew']=\Yii::$app->request->post('item_opennew');
            $data['type']=\Yii::$app->request->post('item_type');
            $nav= new Adminnav();
            $id=$nav->addNav($data);
            if($id){
                $res['status']=1;
                $res['info']='添加成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='添加失败！';
                return Json::encode($res);
            }
        }else{
            return $this->renderPartial('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $data['name']=\Yii::$app->request->post('item_name');
            $data['url']=\Yii::$app->request->post('item_url');
            $data['vieworder']=\Yii::$app->request->post('item_vieworder');
            $data['ifshow']=\Yii::$app->request->post('item_ifshow');
            $data['opennew']=\Yii::$app->request->post('item_opennew');
            $data['type']=\Yii::$app->request->post('item_type');
            $where['id']=$id;
            $nav= new Adminnav();
            $row=$nav->update($where,$data);
            if($row){
                $res['status']=1;
                $res['info']='编辑成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='编辑失败！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $nav= new Adminnav();
            $info=$nav->getOne($where);
            return $this->renderPartial('edit',['info'=>$info]);
        }
    }

    public function delete(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $nav= new Adminnav();
            $row=$nav->del($where);
            if($row){
                $res['status']=1;
                $res['info']='删除成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='删除失败！';
                return Json::encode($res);
            }
        }
    }
}