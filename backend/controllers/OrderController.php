<?php
namespace backend\controllers;

use backend\models\Address;
use backend\models\Order;
use backend\models\OrderGoods;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\Json;

class OrderController extends BaseController{
    public $layout=false;

    public function actionIndex(){
        $status=\Yii::$app->request->get('status');
        $keywords=trim(\Yii::$app->request->get('keywords'));
        $username=trim(\Yii::$app->request->get('username'));
        $order_status=\Yii::$app->request->get('order_status');
        if($status){
            $where['order_status']=$status;
        }elseif($order_status){
            $where['order_status']=$order_status;
        }else{
            $where='';
        }
        if($keywords){
            $condition=['like','order_syn or order_price',$keywords];
        }else{
            $condition='';
        }
        if($username){
            $factor=['like','username',$username];
        }else{
            $factor='';
        }
        $order=Order::find()->joinWith('member')->where($where)->andWhere(['and',$condition,$factor]);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$order->count()
        ]);
        $list=$order->joinWith('status')
            ->select('{{%order}}.*,{{%member}}.username,{{%order_status}}.status_name')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('{{%order}}.id desc')
            ->asArray()
            ->all();
        return $this->render('index',[
            'list'=>$list,
            'pages'=>$pages,
            'keywords'=>$keywords,
            'username'=>$username,
            'status'=>$status,
            'order_status'=>$order_status
        ]);

    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $info=Order::find()->alias('o')->where(['o.id'=>$id])
            ->joinWith('status')->joinWith('member')
            ->joinWith('address')
            ->joinWith('orderGoods')
            ->asArray()
            ->one();
        foreach($info['orderGoods'] as $k=>$v){
            $info['orderGoods']=OrderGoods::find()->alias('og')->joinWith('goods')
                ->where(['og.gid'=>$v['gid']])
                ->asArray()
                ->one();
        }

        /*$info=Order::find()->alias('o')->where(['o.id'=>$id])
            ->select('o.*,g.*')
            ->joinWith('status')->joinWith('member')
            ->joinWith('address')
            ->joinWith('orderGoods og')
            ->innerJoin('shop_goods g','g.id=og.gid')
            ->asArray()
            ->one();*/

        return $this->render('detail',['info'=>$info]);
    }

    public function actionSend(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $address=trim(\Yii::$app->request->post('address'));
            $mobile=trim(\Yii::$app->request->post('mobile'));
            $username=trim(\Yii::$app->request->post('username'));
            $info=Order::findOne($id);
            $model=Address::findOne($info['address']);
            if(empty($address)){
                return Json::encode(['code'=>3,'body'=>'收货地址不能为空']);
            }elseif($address != $model['address']){
                $model->address=$address;
            }
            if(empty($mobile)){
                return Json::encode(['code'=>4,'body'=>'收货电话不能为空']);
            }elseif($mobile != $model['$mobile']){
                $model->mobile=$mobile;
            }
            if(empty($username)){
                return Json::encode(['code'=>5,'body'=>'收货人不能为空']);
            }elseif($username != $model['username']){
                $model->username=$username;
            }
            $model->save();
            $info->order_status=3;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'发货成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'发货失败']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['o.id']=$id;
            $info=Order::find()->alias('o')->joinWith('address')->where($where)->asArray()->one();
            return $this->render('send',['info'=>$info]);
        }
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $transaction=\Yii::$app->db->beginTransaction();
            try{
                $row1=Order::findOne($id)->delete();
                $row2=OrderGoods::deleteAll(['oid'=>$id]);
                if(!$row1 || !$row2){
                    throw new Exception('订单删除失败');
                }
                $transaction->commit();
                return Json::encode(['code'=>1,'body'=>'订单删除成功']);
            }catch (Exception $e){
                $transaction->rollBack();
                return Json::encode(['code'=>2,'body'=>$e->getMessage()]);
            }
        }
    }
}