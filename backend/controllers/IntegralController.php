<?php
namespace backend\controllers;

use backend\models\Integral;
use backend\models\UploadForm;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class IntegralController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','goodsname',$keywords];
        }else{
            $where='';
        }
        $integral=Integral::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$integral->count()
        ]);
        $list=$integral->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index',['pages'=>$pages,'list'=>$list,'keywords'=>$keywords]);
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $integral=Integral::findOne($id);
            $integral->display=$integral['display']==0?1:0;
            if($integral->save()){
                return Json::encode(['code'=>1,'body'=>'操作成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'操作失败']);
            }
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Integral::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $id=\Yii::$app->request->post('id');
            $integral=Integral::findOne($id);
            if($integral->load(\Yii::$app->request->post(),'') && $integral->validate()){
                $info=Integral::findOne(\Yii::$app->request->post());
                if($info){
                    return Json::encode(['code'=>4,'body'=>'商品已存在']);
                }
                $integral->addtime=time();
                if($integral->save()){
                    $upload= new UploadForm();
                    $upload->file=UploadedFile::getInstance($upload,'file');
                    if($upload->validate()){
                        $upload->file->saveAs('web/uploads/integral/'.$upload->file->baseName.'.'.$upload->file->extension);
                        $integral->pic=$upload->$upload->file->baseName.'.'.$upload->file->extension;
                        if($integral->save()){
                            return Json::encode(['code'=>1,'body'=>'编辑成功']);
                        }else{
                            return Json::encode(['code'=>2,'body'=>'编辑失败']);
                        }
                    }else{
                        return Json::encode(['code'=>3,'body'=>$upload->getErrors()]);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'编辑失败']);
                }
            }else{
                return Json::encode(['code'=>6,'body'=>'必填项不能为空']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=Integral::find()->alias('i')->joinWith('pics')->where(['i.id'=>$id])->asArray()->one();
            return $this->render('edit',['info'=>$info]);
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $integral= new Integral();
            if($integral->load(\Yii::$app->request->post(),'') && $integral->validate()){
                $goodsname=trim(\Yii::$app->request->post('goodsname'));
                $info=Integral::findOne(['goodsname'=>$goodsname]);
                if($info){
                    return Json::encode(['code'=>4,'body'=>'商品已存在']);
                }
                $integral->addtime=time();
                if($integral->save()){
                    $upload= new UploadForm();
                    $upload->file=UploadedFile::getInstance($upload,'file');
                    if($upload->validate()){
                        $upload->file->saveAs('web/uploads/integral/'.$upload->file->baseName.'.'.$upload->file->extension);
                        $integral->pic=$upload->$upload->file->baseName.'.'.$upload->file->extension;
                        if($integral->save()){
                            return Json::encode(['code'=>1,'body'=>'添加成功']);
                        }else{
                            return Json::encode(['code'=>2,'body'=>'添加失败']);
                        }
                    }else{
                        return Json::encode(['code'=>3,'body'=>$upload->getErrors()]);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'添加失败']);
                }
            }else{
                return Json::encode(['code'=>6,'body'=>'必填项不能为空']);
            }
        }else{
            return $this->render('add');
        }
    }



    /*public function edit(){
        if (IS_POST) {
            $goods = D('integral');
            //收集表单信息
            $data = $goods->create();
            if ($data) {
                $data['addtime'] = time();  //获取当前时间更新
                //更新商品信息
                if ($goods->save($data)){
                    //更新图片信息
                    if ($_FILES) {
                        $goodsInfo = $goods->field('pic')->find(I('post.id'));
                        $upload = new \Think\Upload();
                        $upload->maxSize = 3145728;// 设置附件上传大小
                        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型D
                        $upload->rootPath = './Public/Admin/Uploads/'; // 设置附件上传根目录
                        $upload->savePath = "integral/";
                        $upload->autoSub = false;
                        $info = $upload->upload();
                        foreach ($info as $key => $val) {
                            $image = new \Think\Image();
                            //获取图片文件路径
                            $filename = './Public/Admin/Uploads/' . $val['savepath'] . $val['savename'];
                            //1.先设置路径
                            $thumb_100 = './Public/Admin/Uploads/'.$val['savepath'].'/thumb100/100_'.$val['savename'];
                            $thumb_350 ='./Public/Admin/Uploads/'.$val['savepath'].'/thumb350/350_'.$val['savename'];
                            $thumb_800 = './Public/Admin/Uploads/'.$val['savepath'].'/thumb800/800_'.$val['savename'];
                            $image->open($filename)->thumb(100,100)->save($thumb_100);
                            $image->open($filename)->thumb(500,500)->save($thumb_350);
                            $image->open($filename)->thumb(800,800)->save($thumb_800);
                            //修改主图
                            if ($key == 0) {
                                $data['id'] = I('post.id');
                                $data['pic'] = $val['savename'];
                                if ($goods->save($data)) {
                                    //删除原主图(这会出问题)
                                    unlink('./Public/Admin/Uploads/integral/' . $goodsInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb100/100_' . $goodsInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb350/350_' . $goodsInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb800/800_' . $goodsInfo['savename']);
                                } else {$this->error('主图更新失败');};
                            } else if ($key > 0) { //修改辅图
                                $pid = $key;
                                $data['id'] = $pid;
                                $data['picname'] = $val['savename'];
                                if (M('integral_pic')->save($data)) {
                                    $picInfo = M('integral_pic')->field('picname')->find($pid);
                                    //删除原图
                                    unlink('./Public/Admin/Uploads/integral/' . $picInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb100/100_' . $picInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb350/350_' . $picInfo['savename']);
                                    unlink('./Public/Admin/Uploads/integral/thumb800/800_' . $picInfo['savename']);
                                }
                            }
                        }
                    }
                    $this->success('商品更新成功');
                } else {
                    $this->error('商品更新失败');
                }
            }
            else {$this->error($goods->getError());}
        } else {
            $gid = trim(I('get.id'));
            $goods = D('Integral')->where(array('id'=>$gid))->find();
            $pics = M('integral_pic')->where(array('iid' => $gid))->select();
            $this->assign('goods', $goods);
            $this->assign('pics', $pics);
            $this->display();
        }
    }*/
}