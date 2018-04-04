<?php
namespace backend\controllers;

use backend\models\Address;
use backend\models\Order;
use backend\models\OrderGoods;
use moonland\phpexcel\Excel;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\Json;

class OrderController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $status=\Yii::$app->request->get('status');
        $keywords=trim(\Yii::$app->request->get('order_syn'));
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
            $condition=['or',['like','order_syn',$keywords],['like','order_price',$keywords]];
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

        //print_r($list->createCommand()->getRawSql());die;

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


    /**
     * 订单导出
     * @author totti_zgl
     * @date 2018/4/4 11:17
     */
    public function actionExport(){
        $keywords=\Yii::$app->request->get('order_syn');
        $order_status=\Yii::$app->request->get('order_status');
        $username=\Yii::$app->request->get('username');
        if($order_status){
            $where['order_status']=$order_status;
        }else{
            $where='';
        }
        if($keywords){
            $condition=['or',['like','order_syn',$keywords],['like','order_price',$keywords]];
        }else{
            $condition='';
        }
        if($username){
            $factor=['like','username',$username];
        }else{
            $factor='';
        }
        $list=Order::find()
            ->joinWith('member')
            ->joinWith('status')
            ->select('{{%order}}.*,{{%member}}.username,{{%order_status}}.status_name')
            ->where($where)
            ->andWhere(['and',$condition,$factor])
            ->orderBy('{{%order}}.id desc')
            ->asArray()
            ->all();
        foreach ($list as $k=>$v){
            $arr[$k]['id']=$v['id'];
            $arr[$k]['order_syn']=$v['order_syn'];
            $arr[$k]['order_price']=$v['order_price'];
            $arr[$k]['order_status']=$v['status_name'];
            $arr[$k]['addtime']=date('Y-m-d H:i:s',$v['addtime']);
        }
        Excel::export([
            'models'=>$arr,
            'fileName'=>'订单表_'.date('Ymd'),
            'columns'=>['id','order_syn','order_price','order_status','addtime'],
            'headers'=>['id'=>'ID','order_syn'=>'订单编号','order_price'=>'订单价格','order_status'=>'订单状态','addtime'=>'下单时间']
        ]);


        /*\moonland\phpexcel\Excel::widget([
            'models' => $allModels,
            'mode' => 'export', //default value as 'export'
            'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label.
            'headers' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        ]);

        \moonland\phpexcel\Excel::export([
            'models' => $allModels,
            'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label.
            'headers' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        ]);

        // export data with multiple worksheet.
        \moonland\phpexcel\Excel::widget([
            'isMultipleSheet' => true,
            'models' => [
                'sheet1' => $allModels1,
                'sheet2' => $allModels2,
                'sheet3' => $allModels3
            ],
            'mode' => 'export', //default value as 'export'
            'columns' => [
                'sheet1' => ['column1','column2','column3'],
                'sheet2' => ['column1','column2','column3'],
                'sheet3' => ['column1','column2','column3']
            ],
            //without header working, because the header will be get label from attribute label.
            'headers' => [
                'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
                'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
                'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
            ],
        ]);

        \moonland\phpexcel\Excel::export([
            'isMultipleSheet' => true,
            'models' => [
                'sheet1' => $allModels1,
                'sheet2' => $allModels2,
                'sheet3' => $allModels3
            ], 'columns' => [
                'sheet1' => ['column1','column2','column3'],
                'sheet2' => ['column1','column2','column3'],
                'sheet3' => ['column1','column2','column3']
            ],
            //without header working, because the header will be get label from attribute label.
            'headers' => [
                'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
                'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
                'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
            ],
        ]);*/
    }
}