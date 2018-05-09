<?php
namespace backend\controllers;


use backend\models\Attribute;
use backend\models\Category;
use backend\models\Goodsbrands;
use backend\models\UploadForm;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class BrandsController extends BaseController{

    public function actionBrand(){
        $pid=\Yii::$app->request->get('pid');
        $brandname=\Yii::$app->request->get('brand_name');
        if($pid==0){
            $where['brand_name']=$brandname;
        }else{
            $where['pid']=$pid;
        }
        if($pid && $brandname){
            $where=['or',['brand_name',$brandname],['pid',$pid]];
        }
        if(!isset($where)){
            $where='';
        }
        $category= new Category();
        $cate=$category->getAll();
        $brands= new Goodsbrands();
        $count=$brands->num($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count,
        ]);
        $brandList=$brands->getAll($where,$pages);
        return $this->renderPartial('Goods/brand',[
            'cate'=>$cate,
            'brandsList'=>$brandList,
            'pages'=>$pages
        ]);
    }

    public  function actionAddbrand(){
        if(\Yii::$app->request->isPost){
            $brands= new Goodsbrands();
            $attribute= new Attribute();
            $category= new Category();
            $data=$_POST;
            $data['addtime']=time();
            $where['cat_id']=$data['pid'];
            $where['attr_name']='品牌';
            $attr_brands=$attribute->getOne($where);
            $bid=$brands->add($data);
            $brand_name['attr_values']=$attr_brands['attr_values'].','.$bid;
            $attribute->update($where,$brand_name);
            $cat_id['cat_id']=$data['pid'];
            $condition['brand_id']=$bid;
            $result=$category->update($condition,$cat_id);
            if($result){
                $info=$this->upload('brands');
                if($info){
                    $map['image']=$info;
                    $row=$brands->update($condition,$map);
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
            $category= new Category();
            $cateList=$category->getAll();
            return $this->renderPartial('addbrand',['cateList'=>$cateList]);
        }
    }

    public  function actionBrandDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $brands= new Goodsbrands();
            $info=$brands->getOne($where);
            $condition['cat_id']=$info['pid'];
            $condition['attr_name']='品牌';
            $attribute= new Attribute();
            $attr_brands=$attribute->getOne($condition);
            $attr_values=$attr_brands['attr_values'];
            $attr_arr=explode(',',$attr_values);
            $str='';
            foreach($attr_arr as $key=>$val){
                if($val!=$id){
                    $str.=$val.',';
                }
            }
            $data['attr_values']=substr($str,0,-1);
            $attribute->update($condition,$data);
            $row=$brands->del($where);
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

    public function actionBrandEdit(){
        if(\Yii::$app->request->isPost){
            $data=$_POST;
            $where['brand_id']=$data['brand_id'];
            $brand= new Goodsbrands();
            $row=$brand->update($where,$data);
            if($row){
                if($_FILES){
                    if($this->upload('brands')){
                        $map['image']=$this->upload('brands');
                        $a=$brand->update($where,$map);
                        if($a){
                            $res['status']=1;
                            $res['info']='编辑成功！';
                            return Json::encode($res);
                        }else{
                            $res['status']=2;
                            $res['info']='编辑失败！';
                            return Json::encode($res);
                        }
                    }else{
                        $res['status']=3;
                        $res['info']='上传失败！';
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=1;
                    $res['info']='编辑成功！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=3;
                $res['info']='编辑失败！';
                return Json::encode($res);
            }
        }else{
            $where['brand_id']=\Yii::$app->request->get('id');
            $brand= new Goodsbrands();
            $brandInfo=$brand->getOne($where);
            $condition['cat_id']=$brandInfo['pid'];
            $category= new Category();
            $cateInfo=$category->getOne($condition);
            return $this->renderPartial('brandEdit',[
                'brandInfo'=>$brandInfo,
                'cateInfo'=>$cateInfo
            ]);
        }
    }

    public function upload($path){
        $upload= new UploadForm();
        if(\Yii::$app->request->isPost){
            $upload->imageFiles=UploadedFile::getInstance($upload,'imageFiles');
            if($upload->upload($path)){
                return $upload->upload($path);
            }else{
                return false;
            }
        }
    }
}