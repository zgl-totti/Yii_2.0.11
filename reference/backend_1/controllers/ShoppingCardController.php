<?php
namespace backend\controllers;

use backend\models\Valuecard;
use yii\helpers\Json;

class ShoppingcardController extends BaseController{
    public function actionIndex(){
        $value= new Valuecard();
        $list=$value->getType();
        return $this->render('index',['list'=>$list]);
	}

    public function actionExcel(){
        $tid=\Yii::$app->request->get('vc_type');
        $tid=$tid?intval($tid):0;
        $where['type_id']=$tid;
        $value= new Valuecard();
        $info=$value->getOneType($where);
        $bonus_filename = $info['type_name'] .'_card_list';
        $bonus_filename = mb_convert_encoding($bonus_filename,'UTF8', 'GB2312');
        header("Content-type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=$bonus_filename.xls");
        echo mb_convert_encoding($info."储值卡号码列表",'UTF8', 'GB2312') . "\t\n";
        /* 红包序列号, 红包金额, 类型名称(红包名称), 使用结束日期 */
        echo mb_convert_encoding('购物卡卡号','UTF8', 'GB2312') ."\t";
        echo mb_convert_encoding('购物卡密码','UTF8', 'GB2312') ."\t";
        echo mb_convert_encoding('购物卡金额','UTF8', 'GB2312') ."\t";
        echo mb_convert_encoding('购物卡名称','UTF8', 'GB2312') ."\t";
        echo mb_convert_encoding('是否使用','UTF8', 'GB2312') ."\t\n";
        $list=$value->getList($where);
        foreach($list as $k=>$v){
            echo chunk_split($v['vc_sn'] ,4," ") . " \t";
            /* 修改  字串导出变成科学技术问题  */
            echo $v['vc_pwd'] . "\t";
            echo $v['type_money'] . "\t";
            $arr=array();
            if (!isset($arr[$v['type_name']])) {
                $arr[$v['type_name']] = mb_convert_encoding($v['type_name'],'UTF8', 'GB2312');
            }
            echo $arr[$v['type_name']] . "\t";
            echo date('Y/m/d', $v['use_start_date']);
            echo '--';
            echo date('Y/m/d', $v['use_end_date']);
            echo "\t\n";
        }
    }

    public function actionVc_list(){
        $value= new Valuecard();
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('type_id');
            $vc_sn=\Yii::$app->request->post('vc_sn');
            $is_used=\Yii::$app->request->post('is_used');
            if($vc_sn && $is_used==0){
                $where=['v.vc_sn',$vc_sn];
            }elseif($is_used!=0){
                if($is_used==1){
                    $where=['v.used_time',0];
                }else{
                    $where=['neq','v.used_time',0];
                }
            }
            $where=['v.vc_type_id',$id];
            $info=$value->getList($where);
            return $this->render('vc_list',['info'=>$info]);
        }else{
            $id=\Yii::$app->request->get('type_id');
            $where['v.vc_type_id']=$id;
            $info=$value->getList($where);
            return $this->render('vc_list',['info'=>$info]);
        }
    }

    public function actionSend(){
        if(\Yii::$app->request->isAjax){
            //储值卡的类型ID和生成的数量的处理
            $vc_type_id=\Yii::$app->request->post('vc_type_id');
            $send_sum=\Yii::$app->request->post('send_sum');
            $vc_type_id=$vc_type_id?$vc_type_id:0;
            $send_sum=$send_sum?$send_sum:1;
            $add_time=time();
            //生成储值卡序列号
            $j=0;
            while($j < $send_sum) {
                //账号8位数字
                $vc_sn = $this->actionMakecode();
                //密码6位数字
                $vc_pwd =  $this->actionMakecode();
                $value= new Valuecard();
                $where['vc_sn']=$vc_sn;
                $info=$value->getOneType($where);
                $data['vc_type_id']=$vc_type_id;
                $data['vc_sn']=$vc_sn;
                $data['vc_pwd']=$vc_pwd;
                $data['add_time']=$add_time;
                if(!$info){
                    $value->addType($data);
                    $j++;
                }
            }
        }else{
            $id = \Yii::$app->request->get('type_id');
            return $this->render('send', ['id' => $id]);
        }
    }

    public function actionMakecode($num=8){
        $re = '';
        $s = '0123456789';
        while(strlen($re)<$num) {
            // 从$s中随机产生一个字符
            $re .= $s[rand(0, strlen($s)-1)];
        }
        return $re;
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('type_id');
            $value= new Valuecard();
            if($id){
                $data['type_name'] = \Yii::$app->request->post('type_name');
                $data['type_money'] = \Yii::$app->request->post('type_money');
                $data['use_start_date'] = \Yii::$app->request->post('use_start_date');
                $data['use_end_date'] = \Yii::$app->request->post('use_end_date');
                $data['type_name'] = \Yii::$app->request->post('type_name');
                $where['id']=$id;
                $row=$value->updateType($where,$data);
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
                $data['type_name'] = \Yii::$app->request->post('type_name');
                $data['type_money'] = \Yii::$app->request->post('type_money');
                $data['use_start_date'] = \Yii::$app->request->post('use_start_date');
                $data['use_end_date'] = \Yii::$app->request->post('use_end_date');
                $data['type_name'] = \Yii::$app->request->post('type_name');
                $row=$value->addType($data);
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
            $id=\Yii::$app->request->get('type_id');
            $where['type_id']=$id;
            $value= new Valuecard();
            $info=$value->getOneType($where);
            return $this->render('add',['info'=>$info]);
        }
    }

    //删除会员
    public function actionDelete(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $value= new Valuecard();
            $row=$value->delType($where);
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

    //删除购物卡
    public function actionVc_delete(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['id']=$id;
            $value= new Valuecard();
            $row=$value->del($where);
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
}