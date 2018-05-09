<?php
namespace backend\controllers;


use backend\models\Cateattr;
use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\Json;

class CateattrController extends BaseController{
    //获取属性列表信息
    public function actionAttrList(){
        $cateattr= new Cateattr();
        $category= new Category();
        $count=$cateattr->num();
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=$cateattr->getList('',$pages);
        foreach($list as $key=>$val){
            $where['cat_id']=$val['pid'];
            $info=$category->getOne($where);
            $list[$key]['cat_name']=$info['cat_name'];
        }
        return $this->renderPartial('attrlist',[
            'list'=>$list,
            'pages'=>$pages
        ]);
    }

    public function actionAddattrname(){
        if(\Yii::$app->request->isAjax){
            $cateattr= new Cateattr();
            $data['attr_name']=\Yii::$app->request->post('attr_name');
            $data['addtime']=time();
            $id=$cateattr->add($data);
            if($id) {
                $attr_value = \Yii::$app->request->post('attr_value');
                $attr_values = explode(',', $attr_value);
                foreach ($attr_values as $val) {
                    $map['attr_name'] = $val;
                    $map['pid'] = $id;
                    $row = $cateattr->addAttrname($map);
                    if ($row) {
                        $res['status'] = 1;
                        $res['info'] = '添加成功！';
                        return Json::encode($res);
                    } else {
                        $res['status'] = 2;
                        $res['info'] = '添加失败！';
                        return Json::encode($res);
                    }
                }
            }else{
                $res['status']=3;
                $res['info']='添加失败！';
                return Json::encode($res);
            }
        }else{
            return $this->renderPartial('addattrname');
        }
    }

    //删除属性信息
    public function actionAttrDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $cateattr= new Cateattr();
            $where['id']=$id;
            $condition['pid']=$id;
            $row=$cateattr->del($where);
            if($row){
                $num=$cateattr->delAttrname($condition);
                if($num){
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
                $res['info']='删除失败！';
                return Json::encode($res);
            }
        }
    }

    //修改属性信息
    public function actionAttrEdit(){
        if(\Yii::$app->request->isAjax){
            $cateattr= new Cateattr();
            $data=$_POST;
            foreach($data as $val){
                if($data['attr_value']){
                    $attr_values=explode(',',$data['attr_value']);
                    foreach($attr_values as $v1){
                        $info['attr_name']=$v1;
                        $info['pid']=$val['id'];
                        $cateattr->addAttrname($info);
                    }
                }
                $condition['id']=$val['id'];
                $attr['attr_name']=$val['attr_name'];
                $row=$cateattr->updateAttr($condition,$attr);
                if($row){
                    $res['status']=1;
                    $res['info']='编辑成功！';
                    return Json::encode($res);
                }else{
                    $res['status']=2;
                    $res['info']='编辑失败！';
                    return Json::encode($res);
                }
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $condition['pid']=$id;
            $cateattr= new Cateattr();
            $category= new Category();
            $attr_name=$cateattr->getAttrOne($condition);
            $attrInfo=$cateattr->getOne($where);
            $data['cat_id']=$attrInfo['pid'];
            $categoryInfo=$category->getOne($data);
            return $this->renderPartial('attrDetail',[
                'attr_name'=>$attr_name,
                'attrInfo'=>$attrInfo,
                'categoryInfo'=>$categoryInfo
            ]);
        }
    }
}