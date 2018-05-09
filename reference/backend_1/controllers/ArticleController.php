<?php
namespace backend\controllers;

use backend\models\Article;
use backend\models\Articlecategory;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ArticleController extends BaseController{
    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            if(\Yii::$app->request->post('first_id')<7){
                $data['type_id']=\Yii::$app->request->post('first_id');
            }else{
                $data['type_id']=\Yii::$app->request->post('third_id');
            }
            if($data['type_id']>0){
                $data['author']=\Yii::$app->request->post('author');
                $data['title']=\Yii::$app->request->post('title');
                $data['keywords']=\Yii::$app->request->post('keywords');
                $data['content']=\Yii::$app->request->post('content');
                $article=new Article();
                $info=$article->getOne($data);
                if(!$info){
                    $data['add_time']=time();
                    $id=$article->add($data);
                    if($id){
                        $image=UploadedFile::getInstanceByName('image');
                        $dir="/public/uploads/article";
                        if(!file_exists($dir)){
                            mkdir($dir);
                        }
                        if($image->validate()){
                            $filename=$image->baseName;
                            $dir=$dir.date('Ymd')."/".$filename;
                            $image->saveAs($dir);
                            $where['id']=$id;
                            $upload['image']=$dir;
                            $row=$article->update($where,$upload);
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
                    $res['info']='文章已存在！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=6;
                $res['info']='请重选分类！';
                return Json::encode($res);
            }
        }else{
            $this->renderPartial('add');
        }
    }

    public function actionShow(){
        $keywords=\Yii::$app->request->get('keywords');
        if($keywords){
            $where=['like','title',$keywords];
        }else{
            $where='';
        }
        $article=new Article();
        $count=$article->num($where);
        $pages=new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count,
        ]);
        $order=['add_time','desc'];
        $list=$article->getAll($where,$pages,$order);
        foreach($list as $k=>$val){
            $conditon['id']=$val['type_id'];
            $articlecategory=new Articlecategory();
            $res=$articlecategory->getAll($conditon);
            $list[$k]['type_name']=$res[0]['type_name'];
        }
        return $this->redirect('show',[
            'list'=>$list,
            'pages'=>$pages,
        ]);
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax) {
            $article = new Article();
            $id = \Yii::$app->request->post('id');
            $where['id']=$id;
            $data=$article->getOne($where);
            $rootpath='/public/uploads/article/';
            $picname=$data['article_img'];
            unlink($rootpath.$picname);
            $row=$article->del($where);
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

    public function actionUpdate(){
        if(\Yii::$app->request->isPost){
            $data=$_POST;
            $article=new Article();
            $info=$article->getOne($data);
            if(!$info){
                $data['update_time']=time();
                unset($data['article_img']);
                $where['id']=\Yii::$app->request->post('id');
                $row=$article->update($where,$data);
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
                $res['status']=3;
                $res['info']='文章已存在！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $article=new Article();
            $articlecategory=new Articlecategory();
            $info=$article->getOne($where);
            $conditon='';
            $typename=$articlecategory->getAll($conditon);
            return $this->renderPartial('update',[
                'res'=>$info,
                'type'=>$typename,
            ]);
        }
    }

    //根据父ID查询分类列表
    public function actionGetCateByPid(){
        if(\Yii::$app->request->isAjax){
            $pid=\Yii::$app->request->post('pid');
            $pid=$pid?$pid:0;
            $articlecategory=new Articlecategory();
            $where['pid']=$pid;
            $cateList=$articlecategory->getAll($where);
            if($cateList){
                $res['status']=1;
                $res['info']=$cateList;
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='查询失败！';
                return Json::encode($res);
            }
        }
    }

    //文章点击量数据统计
    public function actionClickTop($num=10){
        if(\Yii::$app->request->isAjax){
            $article=new Article();
            $list=$article->clickTop($num);
            foreach($list as $k=>$v){
                $artClick['x'][$k]=mb_substr($v['title'],0,4,'utf-8');
                $artClick['y'][$k]=$v['click_num'];
            }
            if($artClick){
                $res['status']=1;
                $res['info']=$artClick;
                return Json::encode($res);
            }else{
                $res['status']=2;
                return Json::encode($res);
            }
        }
    }

    //文章分类数量统计
    public function actionGetCateinfo(){
        if(\Yii::$app->request->isAjax){
            $articlecategory=new Articlecategory();
            $where['pid']=0;
            $list=$articlecategory->getAll($where);
            foreach($list as $key=>$val){
                $list['x'][$key]=$val['type_name'];
                $list['y'][$key]['name']=$val['type_name'];
                $list['y'][$key]['value']=$val['article_num'];
            }
            if($list){
                $res['status']=1;
                $res['info']=$list;
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='没有查到数据！';
                return Json::encode($res);
            }
        }else{
            $article= new Article();
            $list=$article->getType(6);
            $this->getCateSum();
            if($list){
                $res['status']=1;
                $res['info']=$list;
                return Json::encode($res);
            }else{
                $res['status']=2;
                $res['info']='没有查到数据！';
                return Json::encode($res);
            }
        }
    }

    //文章三级分类数量更新入表
    public function actionGetCateSum(){
        $article_category= new Articlecategory();
        $where['path']=7;
        $first_cate=$article_category->getOne($where);
        $pid=$first_cate['id'];
        $condition['pid']=$pid;
        $second_cate=$article_category->getOne($condition);
        $first_cate['child']=$second_cate;
        foreach($second_cate as $key=>$val){
            $map['pid']=$val['id'];
            $third=$article_category->getAll($map);
            $first_cate['child'][$key]['child']=$third;
        }
        foreach($first_cate['child'] as $k=>$v){
            $num='';
            foreach($v['child'] as $k1=>$v1){
                $num+=$v1['article_num'];
            }
            $cid['id']=$v['id'];
            $first_cate['child'][$k]['article_num']=$num;
            $data['article_num']=$first_cate['child'][$k]['article_num'];
            $article_category->update($cid,$data);
        }
        $n='';
        foreach($first_cate['child'] as $k2=>$v2){
            $n+=$v2['article_num'];
            $first_cate['article_num']=$n;
        }
        $info['article_num']=$first_cate['article_num'];
        $factor['id']=$pid;
        $article_category->update($factor,$info);
    }
}