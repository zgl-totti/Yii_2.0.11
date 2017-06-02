<?php
namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\helpers\Json;

class BrandController extends BaseController{
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
            $data['active']=($info['active']==0)?1:0;
            if($info->save($data)){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function acitonDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            if(Brand::findOne($id)->delete()){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function acitonAdd(){
        if(\Yii::$app->request->isPost){



        }else{
            return $this->render('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){




        }else{
            $id=\Yii::$app->request->get('id');
            $info=Brand::findOne($id);
            return $this->render('edit',['info'=>$info]);
        }
    }






    //编辑
    public function edictlist(){
        if(IS_GET){
            $Brand=M('Brand');// 实例化User对象
            $where['id']=I('get.id');
            $list = $Brand->where($where)->select();
            //print_r($list);
            $this->assign('list',$list);// 赋值数据集
        }
        if(IS_AJAX){
            $Brand=M('Brand');// 实例化User对象
            $where['id']=I('post.id');
            $Data=$Brand->create();
            $Data['bname']=I('post.bname');
            $Data['description']=I('post.description');
            $Data['addtime']=time();
            $v=$Brand->where($where)->save($Data);
            //print_r($Data);
            if($v){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }else{
            $this->display(); // 输出模板
        }

    }

    //添加列表
    public function addlist(){
        $Brand=M('Brand');
        if(IS_AJAX) {
            $bname=I("post.bname");
            //判断品牌名是否为空
            if(empty($bname)){
                $this->ajaxReturn(array("status"=>"error","msg"=>"品牌名不能为空"));
            }else{
                //判断品牌名称是否重复
                if($Brand->where("bname='{$bname}'")->find()){
                    $this->ajaxReturn(array("status"=>"error","msg"=>"品牌已存在"));
                }else{
                        $upload = new \Think\Upload();// 实例化上传类
                        $upload->maxSize = 3145728;// 设置附件上传大小
                        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                        $upload->rootPath = './Public/Admin/Uploads/'; // 设置附件上传根目录
                        $upload->autoSub = true;
                        $upload->subName = 'brand';
                        // 上传文件
                        $info = $upload->upload();
                        $Data['bname']=I('post.bname');
                        $Data['description']=I('post.description');
                        $Data['addtime']=time();
                        $flag=$Brand->add($Data);
                        if($flag){
                            //判断是否有图片上传
                            if ($info) {
                                $where['id']=$flag;
                                $brandpic['logo']=$info['pic']['savename'];
                                $num=$Brand->where($where)->save($brandpic);
                                if($num){
                                    $this->ajaxReturn(array('status'=>'ok','msg'=>'添加完成,是否继续添加?'));
                                }else{
                                    $this->ajaxReturn(array('status'=>'error','msg'=>'图片上传失败'));
                                }
                            } else {// 上传成功
                                $this->ajaxReturn(array('status'=>'ok','msg'=>'添加完成,是否继续添加?'));
                            }
                        }else{
                            $this->ajaxReturn(array('status'=>'error','msg'=>'添加失败'));
                        }
                }

            }

        }else{
            $this->display();
        }
    }

}