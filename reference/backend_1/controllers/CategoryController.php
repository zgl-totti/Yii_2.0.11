<?php
namespace backend\controllers;

use backend\models\Attribute;
use backend\models\Cateattr;
use backend\models\Category;
use backend\models\Goodsbrands;
use yii\helpers\Json;

class CategoryController extends BaseController{
    public function actionAddCateGory(){
        if(\Yii::$app->request->isAjax){
            $category= new Category();
            $attribute= new Attribute();
            $cateattr= new Cateattr();
            $data=$_POST;
            $data['addtime']=time();
            $id=$category->add($data);
            if($id){
                $name = $_POST['attr_value'];
                foreach($name as $k=>$val){
                    $attr_name['attr_name']=$val;
                    $attr_name['pid']=0;
                    $pid['pid'] = $id;
                    $cateattr->update($pid,$attr_name);
                    $where['attr_name']=$val;
                    $where['pid'] = $id;
                    $attrInfo=$attribute->getOne($where);
                    $condition['pid']=$attrInfo['id'];
                    $info=$attribute->getAll($condition);

                    $str='';
                    foreach($info as $k1=>$v1){
                        $str.=$v1['id'].',';
                    }
                    $str=substr($str,0,-1);
                    $map['attr_values']=$str;
                    $map['attr_id']=$attrInfo['id'];
                    $factor['cat_id']=$id;
                    $row=$attribute->update($factor,$map);
                    if($row){
                        $res['status']=1;
                        $res['info']='添加成功！';
                        return Json::encode($res);
                    }else{
                        $res['status']=2;
                        $res['info']='添加失败！';
                        return Json::encode($res);
                    }
                }
            }else{
                $res['status']=3;
                $res['info']='添加失败！';
                return Json::encode($res);
            }
        }else{
            $where['pid']=0;
            $cateattr= new Cateattr();
            $cateList=$cateattr->getAll();
            return $this->renderPartial('addcategory',['cateList'=>$cateList]);
        }
    }

    public function actionCheckCateName(){
        if(\Yii::$app->request->isAjax){
            $catname=\Yii::$app->request->post('cat_name');
            $where['cat_name']=$catname;
            $category= new Category();
            $info=$category->getOne($where);
            if($info){
                echo 'false';
            }else{
                echo 'true';
            }
        }
    }

    public function actionCatelist(){
        $cat_name=\Yii::$app->request->get('cat_name');
        if($cat_name){
            $where['cat_name']=$cat_name;
        }else{
            $where='';
        }
        $category= new Cateattr();
        $cateattr= new Cateattr();
        $categoryList=$category->getAll($where);
        foreach($categoryList as $key=>$val){
            $condition['pid']=$val['cat_id'];
            $list=$cateattr->getAll($condition);
            foreach($list as $values){
                $categoryList[$key]['attr_values'][$values['id']]=$values['attr_name'];
            }
        }
        return $this->renderPartial('catelist',['list'=>$categoryList]);
    }

    public function actionCateDetail(){
        if(\Yii::$app->request->isAjax){
            $where['cat_id']=\Yii::$app->request->post('cat_id');
            $category= new Category();
            $data=$_POST;
            $row=$category->update($where,$data);
            if($row){
                $res['status']=1;
                $res['info']='更新成功！';
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='更新失败！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $category= new Category();
            $cateattr= new Cateattr();
            $where['cat_id']=$id;
            $condition['pid']=$id;
            $info=$category->getOne($where);
            $data=$cateattr->getAll($condition);
            return $this->renderPartial('CateDetail',[
                'info'=>$info,
                'data'=>$data
            ]);
        }
    }

    //删除分类，更新属性表，品牌表
    public function actionCategoryDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $category= new Category();
            $attribute= new Attribute();
            $brans= new Goodsbrands();
            $cateattr= new Cateattr();
            $where['cat_id']=$id;
            $condition['pid']=$id;
            $data['pid']=0;
            $factor['is_sale']=0;
            $row=$category->del($where);
            if($row){
                $attribute->del($where);
                $brans->del($condition);
                $cateattr->del($condition);
                $res['status']=2;
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
