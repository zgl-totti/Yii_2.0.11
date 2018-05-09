<?php
namespace frontend\controllers;


use frontend\models\Category;
use yii\data\Pagination;
use yii\db\Exception;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class CategoryController extends Controller{
    //表单提交局部关闭CSRF拦截
    public $enableCsrfValidation=false;
    //分类列表
    public function actionIndex(){
        $keywords=\Yii::$app->request->get('keywords');
        $addtime=\Yii::$app->request->get('addtime');
        if($keywords && $addtime){
            $where=['and',['like','cname',$keywords],['>=','addtime',$addtime]];
        }elseif($keywords && !$addtime){
            $where=['like','cname',$keywords];
        }elseif($addtime && !$keywords){
            $where=['>=','addtime',$addtime];
        }else{
            $where='';
        }
        $category= new Category();
        $count=$category->num($where);
        $pages=new Pagination([
            'pageSize' => 10,
            'totalCount' =>$count,
        ]);
        $list=$category->getList($where,$pages);
        return $this->render('list',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords,'addtime'=>$addtime]);
    }

    public function actionShow(){
        if(\Yii::$app->request->isAjax) {
            //ajax返回的格式
            \Yii::$app->response->format = Response::FORMAT_JSON;

            $id = \Yii::$app->request->post('id');
            $where['id']=$id;
            $category=new Category();
            $info=$category->getOne($where);
            if($info){
                $data['show']=($info['show']==0)?1:0;
                $path=$info['path'].',';
                $condition['path']=['like',"{$path}%"];
                $childInfo=$category->getAll($condition);
                $str=$id.',';
                foreach($childInfo as $k=>$v){
                    $str.=$v['id'].',';
                }
                $str=substr($str,0,-1);
                $map1['id']=['in',$str];
                $map2['cid']=['in',$str];
                $transaction=\Yii::$app->db->beginTransaction();
                try{
                    $row1=\Yii::$app->db->createCommand()->update('beauty_category',$map1,$data)->execute();
                    $row2=\Yii::$app->db->createCommand()->update('beauty_goods',$map2,$data)->execute();
                    if(!$row1 || !$row2){
                        throw new Exception('更新失败！');
                    }
                    $transaction->commit();
                    $res['status']=1;
                    $res['info']='更新成功！';
                    return $res;
                }catch (Exception $e){
                    $transaction->rollBack();
                    $res['status'] = 2;
                    $res['info'] = $e->getMessage();
                    return Json::encode($res);
                }
            }else{
                $res['status'] = 3;
                $res['info'] = '分类不存在！';
                return $res;
            }
        }
    }

    //添加分类
    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $thirdCate=\Yii::$app->request->post('thirdCate');
            $secondCate=\Yii::$app->request->post('secondCate');
            $firstCate=\Yii::$app->request->post('firstCate');
            if($thirdCate){
                $pid=$thirdCate;
            }elseif($secondCate){
                $pid=$secondCate;
            }else{
                $pid=$firstCate;
            }
            $cname=\Yii::$app->request->post('cname');
            if($cname){
                $where['cname']=$cname;
                $category=new Category();
                $info=$category->getOne($where);
                if(!$info){
                    $data['cname']=$cname;
                    $data['pid']=$pid;
                    $data['addtime']=time();
                    $insertId=$category->add($data);
                    if($insertId){
                        if($pid==0){
                            $path['path']=$insertId;
                        }else{
                            $condition['id']=$pid;
                            $pathInfo=$category->getAll($condition);
                            $path['path']=$pathInfo['path'].','.$insertId;
                        }
                        $opertion['id']=$insertId;
                        $row=$category->edit($opertion,$path);
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
                        $res['info']='添加失败！';
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=4;
                    $res['info']='分类名已存在！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=5;
                $res['info']='分类名不能为空！';
                return Json::encode($res);
            }
        }else {
            return $this->render('add');
        }
    }

    //显示三级联动分类
    public function actionGetcatebypid(){
        //ajax返回数据是json格式
        //\Yii::$app->response->format = Response::FORMAT_JSON;
        //如果pid不存在则默认为0
        $pid=\Yii::$app->request->post('pid',0);
        $where['pid']=$pid;
        $category=new Category();
        $cateList=$category->getAll($where);
        if($cateList){
            $res['status']=1;
            $res['info']=$cateList;
            return Json::encode($res);
            //return $res;
        }else{
            return false;
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isAjax) {
            $thirdCate=\Yii::$app->request->post('thirdCate');
            $secondCate=\Yii::$app->request->post('secondCate');
            $firstCate=\Yii::$app->request->post('firstCate');
            if($thirdCate){
                $pid=$thirdCate;
            }elseif($secondCate){
                $pid=$secondCate;
            }else{
                $pid=$firstCate;
            }
            $cname=\Yii::$app->request->post('cname');
            if($cname){
                $where['cname']=$cname;
                $category=new Category();
                $info=$category->getOne($where);
                if(!$info){
                    $id=\Yii::$app->request->post('id');
                    if($pid==0){
                        $newpath=$id;
                    }else{
                        $condition['id']=$pid;
                        $info=$category->getOne($condition);
                        $newpath=$info['path'].','.$id;
                    }
                    $map['id']=$id;
                    $cateInfo=$category->getOne($map);
                    $oldpath=$cateInfo['path'];
                    //更新分类的cname,pid,path
                    $data['path']=$newpath;
                    $data['pid']=$pid;
                    $data['cname']=$cname;
                    $transaction=\Yii::$app->db->beginTransaction();
                    try{
                        $row1=$category->edit($map,$data);
                        $row2=\Yii::$app->db->createCommand("update beauty_category set path=replace(path,'{$oldpath}','{$newpath}')  where path like '{$oldpath}%'")->execute();
                        if(!$row1 || !$row2){
                            throw new Exception('编辑失败！');
                        }
                        $transaction->commit();
                        $res['status']=1;
                        $res['info']='编辑成功！';
                        return $res;
                    }catch (Exception $e){
                        $transaction->rollBack();
                        $res['status']=2;
                        $res['info']=$e->getMessage();
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=4;
                    $res['info']='分类名已存在！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=5;
                $res['info']='分类名不能为空！';
                return Json::encode($res);
            }
        }else {
            $id = \Yii::$app->request->get('id');
            $where['id'] = $id;
            $category = new Category();
            $info = $category->getOne($where);
            return $this->render('editor', ['info' => $info]);
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $transaction=\Yii::$app->db->beginTransaction();
            try{
                $where['id']=1000;
                $data['username']='totti';
                $row1=(new Query())->select('*')->from('beauty_admin')->where(['id'=>1])->one();
                $row2=\Yii::$app->db->createCommand()->update('beauty_admin',$where,$data)->execute();
                if(!$row1 || !$row2){
                    throw new Exception('失败!');
                }
                $transaction->commit();
                $res['status']=1;
                $res['info']='成功！';
                return Json::encode($res);
            }catch (Exception $e){
                $transaction->rollBack();
                $res['status']=2;
                $res['info']=$e->getMessage();
                return Json::encode($res);
            }
        }
    }

    //缓存
    public function actionGetcache(){
        $aid=\Yii::$app->cache->get('aid');
        if($aid){
            echo $aid;
        }else{
            \Yii::$app->cache->set('aid',123);
            echo '缓存数据不存在！';
        }
    }

    public function actionDelcache(){
        $aid=\Yii::$app->cache->get('aid');
        if($aid){
            \Yii::$app->cache->delete('aid');
            echo '缓存已删除！';
        }
    }

    //session
    public function actionSession(){
        $aid=\Yii::$app->session->get('aid');
        if($aid){
            echo 'session已存在,值是：'.$aid;
        }else{
            \Yii::$app->session->set('aid','session已设置');
            echo 'session不存在！';
        }
    }

    public function actionDelsession(){
        $aid=\Yii::$app->session->get('aid');
        if($aid){
            \Yii::$app->session->destroy('aid');
            echo 'session已删除';
        }
    }

    public function actionServer(){
        $server=\Yii::$app->request->getUserIP();
        print_r($server);
    }
}