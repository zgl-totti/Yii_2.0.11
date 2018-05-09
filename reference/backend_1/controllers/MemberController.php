<?php
namespace backend\controllers;

use backend\models\Member;
use backend\models\Money;
use backend\models\UploadForm;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class MemberController extends BaseController{
    //会员首页
    public function actionIndex(){
        $phone=\Yii::$app->request->get('phone');
        if($phone){
            $where=['like','telephone',$phone];
        }else{
            $where='';
        }
        $member= new Member();
        $count=$member->num($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=$member->getList($where,'',$pages);
        return $this->renderPartial('index',['list'=>$list,'pages'=>$pages]);
    }

    //会员等级首页
    public function actionUser_rank(){
        $member= new Member();
        $data=$member->getAll();
        return $this->renderPartial('user_rank',['rank'=>$data]);
    }

    //增加会员等级
    public function actionAdd_user_rank(){
        if(\Yii::$app->request->isPost){
            $upload= new UploadForm();
            $dir='public/uploads/member';
            if(!file_exists($dir)){
                mkdir($dir);
            }
            $info=$upload->upload($dir);
            if($info){
                $data=$_POST;
                $image=UploadedFile::getInstanceByName('image');
                $filename=$image->baseName;
                $pathname=$dir.date('Ymd')."/".$filename;
                $image->saveAs($pathname);
                $data['level_logo']=$pathname;
                $member= new Member();
                $row=$member->addLevel($data);
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
                $res['info']='必填项不能为空！';
                return Json::encode($res);
            }
        }else{
            return $this->render('add_user_rank');
        }
    }

    //编辑会员等级
    public function actionEdit_rank(){
        if(\Yii::$app->request->isPost){
            $id=\Yii::$app->request->post('id');
            $image=UploadedFile::getInstanceByName('image');
            $dir='public/uploads/member';
            if(!file_exists($dir)){
                mkdir($dir);
            }
            if($image->validate()){
                $filename=$image->baseName;
                $dir=$dir.date('Ymd')."/".$filename;
                $image->saveAs($dir);
                $where['id']=$id;
                $data=$_POST;
                $data['level_logo'] = $dir;
                $member= new Member();
                $row=$member->update($where,$data);
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
                $res['status']=3;
                $res['info']='上传失败！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $member= new Member();
            $info=$member->getOneLevel($where);
            return $this->renderPartial('edit_rank',['info'=>$info]);
        }
    }

    //会员等级删除
    public function actionRank_delete(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            $uid=\Yii::$app->request->post('id');
            $where['id']=$uid;
            $row=$member->delLevel($where);
            if($row){
                return Json::encode(['status'=>1,'info'=>'删除成功！']);
            }else{
                $res['status']=2;
                $res['info']='删除失败！';
                return Json::encode($res);
            }
        }
    }

    //会员添加
    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            $data=$_POST;
            if(isset($data)){
                $pwd=\Yii::$app->request->post('password');
                $data['password']=md5($pwd.uniqid());
                $data['add_time']=time();
                $data['from']='pc';
                $data['login_ip']=\Yii::$app->request->getUserIP();
                $id=$member->add($data);
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
                $res['status']=3;
                $res['info']='必填项不能为空！';
                return Json::encode($res);
            }
        }else{
            $member= new Member();
            $list=$member->getAllLevel();
            return $this->renderPartial('add',['rank'=>$list]);
        }
    }

    //会员数据更新
    public function acitonEdit_user(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('uid');
            $member= new Member();
            $data=$_POST;
            if(isset($data)){
                $pwd=\Yii::$app->request->post('password');
                $data['password']=md5($pwd.uniqid());
                $data['add_time']=time();
                $data['login_ip']=\Yii::$app->request->getUserIP();
                $where['id']=$id;
                $row=$member->update($where,$data);
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
                $res['status']=3;
                $res['info']='必填项不能为空！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $member= new Member();
            $info=$member->getOne($where);
            $list=$member->getAllLevel();
            return $this->renderPartial('edit_user',['info'=>$info,'list'=>$list]);
        }
    }

    //会员资金管理
    public function actionAccount(){
        if(\Yii::$app->request->isAjax){
            $reason=\Yii::$app->request->post('reason');
            $money=\Yii::$app->request->post('money');
            $frozen_money=\Yii::$app->request->post('frozen_money');
            $enable=\Yii::$app->request->post('enable');
            $frozen=\Yii::$app->request->post('frozen');
            $change_user=\Yii::$app->request->post('change_info');
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $member= new Member();
            $info=$member->getOne($where);
            if($reason && $money && $frozen_money){
                if($enable=='m_add'){
                    $count['money']=$info['money']+$money;
                }elseif($enable=='m_down'){
                    $count['money']=$info['money']-$money;
                }
                if($frozen=='f_add'){
                    $count['frozen_money']=$info['frozen_money']+$frozen_money;
                }elseif($frozen=='f_down'){
                    $count['frozen_money']=$info['frozen_money']-$frozen_money;
                }
                $row=$member->update($where,$count);
                if($row){
                    if($enable=='m_add'){
                        $data['money']='+'.$money;
                    }elseif($enable=='m_down'){
                        $data['money']='-'.$money;
                    }
                    if($frozen=='f_add'){
                        $data['frozen_money']='+'.$frozen_money;
                    }elseif($frozen=='f_down'){
                        $data['frozen_money']='-'.$frozen_money;
                    }
                    $deta['money_before']=$info['money'];
                    $deta['frozen_money_before']=$info['frozen_money'];
                    $deta['money_after']=$count['money'];
                    $deta['frozen_money_after']=$count['frozen_money'];
                    $deta['project']='后台资金管理';
                    $deta['change_time']=time();
                    $deta['uid']=$id;
                    $deta['change_user']=$change_user;
                    $money= new Money();
                    $num=$money->add($data);
                    if($num){
                        $res['status']=1;
                        $res['info']='更新成功！';
                        $res['id']=$id;
                        return Json::encode($res);
                    }else{
                        $res['status']=3;
                        $res['info']='更新失败！';
                        return Json::encode($res);
                    }
                }else{
                    $res['status']=4;
                    $res['info']='更新失败！';
                    return Json::encode($res);
                }
            }else{
                $res['status']=5;
                $res['info']='必填项不能为空！';
                return Json::encode($res);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['id']=$id;
            $member= new Member();
            $info=$member->getOne($where);
            return $this->renderPartial('account',['info'=>$info]);
        }
    }

    //查看资金变动
    public function actionAccount_details(){
        $money= new Money();
        $id=\Yii::$app->request->get('id');
        $where['uid']=$id;
        $count=$money->num($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $condition['l.uid']=$id;
        $list=$money->getChange($condition,$pages);
        return $this->renderPartial('account_details',['list'=>$list,'pages'=>$pages]);
    }


    //删除会员
    public function actionDelete(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            $where['id']=\Yii::$app->request->post('id');
            $row=$member->del($where);
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

    //会员统计分析
    public function actionGetFrom(){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            $list=$member->getAll();
            $list['x'][0]='pc';
            $list['x'][1]='wap';
            $list['x'][2]='weixin';
            foreach($list['x'] as $k=>$v){
                $where['from']=$v;
                $count=$member->num($where);
                $list['y'][$k]['name']=$v;
                $list['y'][$k]['value']=$count;
            }
            $res['status']=1;
            $res['info']=$list;
            return Json::encode($res);
        }
    }

    public function actionGetDay($num=8){
        if(\Yii::$app->request->isAjax){
            $member= new Member();
            $list=$member->getAll('','add_time desc');
            $arr_mem = array();
            foreach ($list as $k => $v) {
                $add_time=date('Y-m-d',$v['add_time']);
                $datetime = substr($add_time,0,10);
                //得到每日新增用户数
                if(array_key_exists($datetime,$arr_mem)){
                    $arr_mem[$datetime] +=1;
                }else{
                    $arr_mem[$datetime] =1;
                }
            }
            $num=0;
            foreach($arr_mem as $k1=>$val){
                $fastList['x'][$num]=$k1;
                $fastList['y'][$num]['name']=$k1;
                $fastList['y'][$num]['value']=$val;
                $num++;
            }
            return Json::encode(['status'=>1,'info'=>$fastList]);
        }
    }
}