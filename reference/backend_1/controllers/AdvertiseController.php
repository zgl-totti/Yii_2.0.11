<?php
namespace backend\controllers;

use backend\models\Adveritse;
use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class AdvertiseController extends BaseController{
    public function actionShow(){
        $advertise= new Adveritse();
        $category= new Category();
        $where['position_id']=\Yii::$app->request->get('position_id');
        $count=$advertise->num($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $order='starttime desc';
        $list=$advertise->getList($where,$pages,$order);
        foreach($list as $k=>$val) {
            $condition['$cid']=$val['cat_id'];
            $catelist=$category->getAll();
            $catelist[6]['cat_name'] = '手机端';
            $catelist[6]['cat_id'] = '7';
            $cid=$val['cat_id']-1;
            $list[$k]['cat_name']=$catelist[$cid]['cat_name'];
        }
        return $this->renderPartial('show',[
            'list'=>$list,
            'catelist'=>$catelist,
            'pages'=>$pages
        ]);
    }

    //广告添加页面
    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $data=$_POST;
            $data['starttime']=strtotime($data['start_time']);
            $data['endtime']=strtotime($data['end_time']);
            $time=$data['endtime']-$data['starttime'];
            if($data['cat_id']>0 && $time>0){
                $advertise= new Adveritse();
                $id=$advertise->add($data);
                if($id){
                    $brands= new BrandsController();
                    $info=$brands->upload('advertise');
                    if($info){
                        $upload['picname']=$info;
                        $where['id']=$id;
                        $row=$advertise->update($where,$upload);
                        if($row){
                            $res['status']=1;
                            $res['info']='添加成功！';
                            return Json::encode($res);
                        }else{
                            $res['status']=2;
                            $res['info']='添加失败！';
                            return Json::encode($res);
                        }
                    }else{
                        $res['status']=3;
                        $res['info']='上传失败！';
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=4;
                    $res['info']='添加失败！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=5;
                $res['info']='广告时间或类型错误！';
                return Json::encode($res);
            }
        }else{
            $advertise= new Adveritse();
            $type=$advertise->type();
            return $this->renderPartial('add',['type'=>$type]);
        }
    }

    //广告删除页面
    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $advertise= new Adveritse();
            $info=$advertise->getOne($where);
            if($info) {
                $path = '/uploads/advertise/' . $info['picname'];
                unlink($path);
                $row=$advertise->del($where);
                if($row){
                    $res['status']=1;
                    $res['info']='删除成功！';
                    return Json::encode($res);
                }else{
                    $res['status']=2;
                    $res['info']='删除失败！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=3;
                $res['info']='广告不存在！';
                return Json::encode($res);
            }
        }
    }

    //广告修改页面
    public function actionUpdate(){
        if(\Yii::$app->request->isPost){
            $advertise= new Adveritse();
            $data=$_POST;
            $data['starttime']=strtotime($data['start_time']);
            $data['endtime']=strtotime($data['end_time']);
            unset($data['picname']);
            $where['id']=\Yii::$app->request->post('id');
            if($_FILES){
                $upload= new BrandsController();
                $info['picname']=$upload->upload('advertise');
                $advertise->update($where,$info);
            }
            $row=$advertise->update($where,$data);
            if($row){
                $res['status']=1;
                $res['info']='修改成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='修改失败！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $advertise= new Adveritse();
            $where['id']=$id;
            $info=$advertise->getOne($where);
            return $this->renderPartial('update',['info'=>$info]);
        }
    }
}










