<?php
namespace backend\controllers;

use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\Json;

class CategoryController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $keywords=\Yii::$app->request->get('keywords');
        if($keywords){
            $where=['like','catename',$keywords];
        }else{
            $where='';
        }
        $category=Category::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$category->count(),
        ]);
        $list=$category->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionGetChildCate(){
        if(\Yii::$app->request->isAjax){
            $pid=\Yii::$app->request->post('val');
            $info=Category::findAll(['pid'=>$pid]);
            if($info){
                return Json::encode(['code'=>1,'body'=>$info]);
            }else{
                return Json::encode(['code'=>2,'body'=>'没有查到数据']);
            }
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $info=Category::findOne($id);
            $data['active']=($info['active']==0)?1:0;
            $path=$info['path'];
            $where=['like','path',$path];
            $row=Category::updateAll($data,$where);
            if($row){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Category::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $catename=\Yii::$app->request->post('catename');
            $parent=\Yii::$app->request->post('parent');
            $child=\Yii::$app->request->post('child');
            if($catename){
                $category= new Category();
                if($parent){
                    if($child){
                        $pid=$child;
                    }else{
                        $pid=$parent;
                    }
                    $data['catename']=$catename;
                    $data['pid']=$pid;
                    $info=Category::findOne($data);
                    if(!$info){
                        if($category->load($data) && $category->save()){
                            $id=\Yii::$app->db->getLastInsertID();
                            $res=Category::findOne($pid);
                            $arr['path']=implode(',',$res['path']).','.$id;
                            if($res->load($arr) && $res->save()){
                                return Json::encode(['code'=>1,'body'=>'添加分类成功']);
                            }else{
                                return Json::encode(['code'=>2,'body'=>'添加分类失败']);
                            }
                        }else{
                            return Json::encode(['code'=>3,'body'=>'添加分类失败']);
                        }
                    }else{
                        return Json::encode(['code'=>4,'body'=>'分类名已存在']);
                    }
                }else{
                    $data['catename']=$catename;
                    $data['pid']=0;
                    $info=Category::findOne($data);
                    if(!$info){
                        if($category->load($data) && $category->save()){
                            $id=\Yii::$app->db->getLastInsertID();
                            $arr['path']=$id;
                            $res=Category::findOne($id);
                            if($res->load($arr) && $res->save()){
                                return Json::encode(['code'=>1,'body'=>'添加成功']);
                            }else{
                                return Json::encode(['code'=>2,'body'=>'添加失败']);
                            }
                        }else{
                            return Json::encode(['code'=>3,'body'=>'添加失败']);
                        }
                    }else{
                        return Json::encode(['code'=>4,'body'=>'分类名已存在']);
                    }
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'分类名不能为空']);
            }
        }else{
            $list=Category::findAll(['pid'=>0]);
            return $this->render('add',['list'=>$list]);
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $catename=\Yii::$app->request->post('catename');
            $pid=\Yii::$app->request->post('parent');
            if(!$catename){
                return Json::encode(['code'=>5,'body'=>'分类名不能为空']);
            }
            if(!$pid){
                return Json::encode(['code'=>4,'body'=>'分类不能为空']);
            }
            $info=Category::findOne($pid);
            $data['path']=$info['path'].','.$id;
            $data['catename']=$catename;
            $data['pid']=$pid;
            $category=Category::findOne($id);
            if($category->load($data) && $category->save()){
                return Json::encode(['code'=>1,'body'=>'编辑成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'编辑失败']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Category::findOne($id);
            $list=Category::find()->orderBy('path')->asArray()->all();
            foreach($list as $val){
                $space=count(explode(',',$val['path']));
                $val['catename']=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $space).$val['catename'];
                $res[]=$val;
            }
            return $this->render('edit',['info'=>$info,'res'=>$res]);
        }
    }
}