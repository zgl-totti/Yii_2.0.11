<?php
namespace backend\controllers;

use backend\models\Goods;
use backend\models\Message;
use backend\models\Order;
use yii\data\Pagination;
use yii\helpers\Json;

class OrderController extends BaseController{
    //订单列表页，订单查询
    public function order_list(){
        $order_sn=\Yii::$app->request->get('order_sn');
        $status=\Yii::$app->request->get('status');
        if($order_sn){
            $where['order_status']=$order_sn;
        }else{
            $where['order_status']=$status;
        }
        if(!isset($where)){
            $where='';
        }
        $order= new Order();
        $count=$order->getNum($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$count
        ]);
        $list=$order->getList($where,$pages);
        //催单消息数量
        $condition['cui_status']=1;
        $num=$order->getReminderNum($condition);
        $info=$order->getOneReminder($condition);
        return $this->renderPartial('order_list',['list'=>$list,'pages'=>$pages,'num'=>$num,'info'=>$info]);
    }

    //退货列表页
    public function actionGoodsBackList(){
        $status=\Yii::$app->request->get('status');
        if($status){
            $where['status']=$status;
        }else{
            $where['status']=0;
        }
        $goods= new Goods();
        $info=$goods->getReturn($where);
        foreach($info as $k=>$v){
            $condition['goods_id']=$v['goods_id'];
            $arr=$goods->getOne($condition);
            $info[$k]['goodsname']=$arr['goodsname'];
        }
        return $this->renderPartial('goodsBackList',['info'=>$info]);
    }

    public function actionGoodsReturn(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $goods= new Goods();
            $order= new Order();
            $message= new Message();
            $where['id']=$id;
            $info=$goods->getOne($where);
            $data['status']=1;
            $factor['g.id']=$info['ogid'];
            $goods->update($where,$data);
            $message->returnMessage($factor);
            $condition['id']=$info['ogid'];
            $arr['is_return']=2;
            $row=$order->update($condition,$arr);
            if($row){
                $res['status']=1;
                $res['info']='确认收货成功！';
                return Json::encode($res);
            }else{
                $res['status']=1;
                $res['info']='确认退货失败，请稍后重试！';
                return Json::encode($res);
            }
        }
    }

    //删除已确认退货信息
    public function actionDelGoodsReturn(){
        if(\Yii::$app->request->isAjax){
            $where['id']=\Yii::$app->request->post('id');
            $goods= new Goods();
            $row=$goods->delReturn($where);
            if ($row) {
                $res['status'] = 1;
                $res['info'] = '删除成功！';
                return Json::encode($res);
            } else {
                $res['status'] = 2;
                $res['info'] = '删除失败！';
                return Json::encode($res);
            }
        }
    }

    //订单详情页，订单列表联合订单状态表、配送地址表，订单商品联合订单状态、商品表  查询
    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $order= new Order();
        $where['o.id']=$id;
        $orderList=$order->getOrderDetail($where);
        $goodsList=$order->getGoodsDetail($where);
        return $this->renderPartial('detail',['orderList'=>$orderList,'goodsList'=>$goodsList]);
    }

    //订单列表单选或多选删除
    public function actionDelOrder(){
        if(\Yii::$app->request->isAjax){
            $str=\Yii::$app->request->post('str');
            if(is_array($str)) {
                $where = ['in', 'id', $str];
                $order = new Order();
                $info = $order->getAll($where);
                $arr = ['2', '3', '4', '6'];
                if (array_intersect($arr, $info)) {
                    $res['status'] = 3;
                    $res['info'] = '含有不可操作的订单！';
                    return Json::encode($res);
                } else {
                    $row = $order->del($where);
                    if ($row) {
                        $res['status'] = 1;
                        $res['info'] = '删除成功！';
                        return Json::encode($res);
                    } else {
                        $res['status'] = 2;
                        $res['info'] = '删除失败！';
                        return Json::encode($res);
                    }
                }
            }else{
                $where['id']=$str;
                $order= new Order();
                $row=$order->del($where);
                if ($row) {
                    $res['status'] = 1;
                    $res['info'] = '删除成功！';
                    return Json::encode($res);
                } else {
                    $res['status'] = 2;
                    $res['info'] = '删除失败！';
                    return Json::encode($res);
                }
            }
        }
    }

    //订单列表单选或多选配货
    public function actionPeihuo(){
        if(\Yii::$app->request->isAjax){
            $str=\Yii::$app->request->post('str');
            if(!empty($str)) {
                $where = ['in', 'id', $str];
                $order = new Order();
                $info = $order->getAll($where);
                $arr = ['1', '3', '4', '5','6'];
                if (array_intersect($arr, $info)) {
                    $res['status'] = 3;
                    $res['info'] = '含有不可操作的订单！';
                    return Json::encode($res);
                } else {
                    $data['order_status']=3;
                    $row=$order->update($where,$data);
                    if ($row) {
                        $map['status']=2;
                        $order->updateReminder($where,$map);
                        $res['status'] = 1;
                        $res['info'] = '配货成功！';
                        return Json::encode($res);
                    } else {
                        $res['status'] = 2;
                        $res['info'] = '配货失败！';
                        return Json::encode($res);
                    }
                }
            }else{
                $res['status'] = 3;
                $res['info'] = '失败,等会再试！';
                return Json::encode($res);
            }
        }
    }

    //订单详情页取消(5),发货(3)，操作方法
    public function actionDb($num){
        $id=\Yii::$app->request->get('str');
        $order= new Order();
        $where['id']=$id;
        $data['order_status']=$num;
        $row=$order->update($where,$data);
        if($row){
            echo '操作成功';
        }else{
            echo '操作失败';
        }
    }

    public function actionQuxiao(){
        $oid=\Yii::$app->request->get('str');
        $where['id']=$oid;
        $order= new Order();
        $info=$order->getOne($where);
        $data['uid']=$info['user_id'];
        $data['message']="您的订单号为".$info['order_sn']."的订单已经遭到取消，详情请咨询商家";
        $message= new Message();
        $id=$message->add($data);
        if($id){
            $this->actionDb(5);
        }
    }

    public function actionFahuo(){
        if(\Yii::$app->request->isAjax) {
            $oid = \Yii::$app->request->post('str');
            $where['id'] = $oid;
            $order = new Order();
            $info = $order->getOne($where);
            if ($info['status'] == 2) {
                $data['uid']=$info['user_id'];
                $data['message']="您的订单号为".$info['order_sn']."的订单已经发货了";
                $message= new Message();
                $row=$message->add($data);
                if($row){
                    $res['status']=1;
                    $res['info']='操作成功！';
                    return Json::encode($res);
                }else{
                    $res['status']=2;
                    $res['info']='操作失败！';
                    return Json::encode($res);
                }
            } else {
                $res['status']=3;
                $res['info']='非法操作！';
                return Json::encode($res);
            }
        }
    }

    //定时查询客户催单信息
    public function actionCuidanxinxi(){
        $reminder= new Order();
        $where['status']=1;
        $data['status']=2;
        $reminder->updateReminder($where,$data);
    }

    //订单Excel导出
    public function actionExport(){
        $file_name="订单列表".date("Y-m-d H:i:s",time());
        $file_suffix = "xls";
        $where='';
        $status=\Yii::$app->request->get('status');
        $sn=\Yii::$app->request->get('sn');
        if(!empty($status)) {
            $where['o.order_status'] = $status;
        }
        if(!empty($sn)) {
            $where['o.order_sn'] = $sn;
        }
        $order= new Order();
        $list=$order->getOrderDetail($where);
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name.$file_suffix");
        //根据业务，自己进行模板赋值
        return $this->renderPartial('export',['list'=>$list]);
    }
}
