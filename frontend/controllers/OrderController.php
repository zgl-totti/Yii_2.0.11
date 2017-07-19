<?php
namespace frontend\controllers;


use backend\models\Address;
use backend\models\Goods;
use backend\models\Member;
use backend\models\Order;
use backend\models\OrderGoods;
use frontend\models\Credit;
use yii\helpers\Json;

class OrderController extends BaseController{
    public $enableCsrfValidation=false;
    public $mid;

    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid',47);
        if(is_int($mid) && $mid>0){
            $this->mid=$mid;
        }
    }

    public function actionIndex(){
        $id=\Yii::$app->request->get('id',10);
        $where['o.id']=$id;
        $info=Order::find()->alias('o')
            ->where($where)
            ->joinWith('member')
            ->joinWith('orderGoods')
            ->joinWith('status')
            ->asArray()->one();
        foreach($info['orderGoods'] as $k=>$v){
            $info['orderGoods'][$k]['goods']=Goods::findOne($v['gid']);
        }
        $condition['mid']=$this->mid;
        $address=Address::findAll($condition);
        return $this->render('index',['info'=>$info,'address'=>$address]);
    }

    public function actionCreateOrder(){
        if(\Yii::$app->request->isAjax){
            $mid=$this->mid;
            if($mid){
                $total_price=\Yii::$app->request->post('total_price');
                if(!$total_price){
                    return Json::encode(['code'=>5,'body'=>'请选择商品进行购买']);
                }
                $order_syn=date('YmdHis',time()).rand(1000000000,9999999999);
                $order= new Order();
                $order->mid=$mid;
                $order->order_syn=$order_syn;
                $order->order_price=$total_price;
                $order->addtime=time();
                if($order->save()){
                    $oid=$order->attributes['id'];
                    $arr=\Yii::$app->request->post('checkitems');
                    foreach($arr as $v){
                        $orderGoods= new OrderGoods();
                        $orderGoods->oid=$oid;
                        $orderGoods->gid=$v['gid'];
                        $orderGoods->buynum=$v['buynum'];
                        if($orderGoods->save()){
                            return Json::encode(['code'=>1,'body'=>'订单生产']);
                        }else{
                            return Json::encode(['code'=>5,'body'=>'下单失败']);
                        }
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'下单失败']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'请先登录']);
            }
        }
    }

    public function actionSuccess(){
        $oid=\Yii::$app->request->get('oid');
        $info=Order::findOne($oid);
        $where['o.mid']=$this->mid;
        $condition=['!=','o.id',$oid];
        $order=Order::find()->where($where)
            ->andWhere($condition)
            ->joinWith('orderGoods')
            ->asArray()->all();
        foreach($order as $k1=>$v1){
            foreach($v1['orderGoods'] as $k2=>$v2){
                $list[]=Goods::findOne($v2['gid']);
            }
        }
        return $this->render('success',['info'=>$info,'list'=>$list]);
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $oid=\Yii::$app->request->post('oid');
            $row1=Order::findOne($oid)->delete();
            $row2=OrderGoods::deleteAll(['oid'=>$oid]);
            if($row1 && $row2){
                return Json::encode(['code'=>1,'body'=>'删除订单成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除订单失败']);
            }
        }
    }

    public function actionSignFor(){
        if(\Yii::$app->request->isAjax){
            $oid=\Yii::$app->request->post('oid');
            $info=Order::findOne($oid);
            $info->order_status=4;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'签收成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'签收失败']);
            }
        }
    }

    public function actionIntegral(){
        if(\Yii::$app->request->isAjax) {
            $mid = $this->mid;
            if(!$mid) {
                return Json::encode(['code' => 5, 'body' => '登录后才能兑换']);
            }
            $gid=\Yii::$app->request->post('gid');
            $buynum=\Yii::$app->request->post('buynum');
            $price=\Yii::$app->request->post('price');
            $member = Member::findOne($mid);
            if($member['credit']<$price){
                return Json::encode(['code' => 5, 'body' => '你的积分不足,兑换失败']);
            }
            $member->credit=floor($member['credit']-$price);
            $member->money=$member['money']+$price*$buynum/10;
            $member->save();

            //积分兑换商品插入到积分兑换表
            $credit= new Credit();
            $credit->mid=$mid;
            $credit->gid=$gid;
            $credit->credit=$price*$buynum;
            $credit->buynum=$buynum;
            $credit->addtime=time();
            $credit->save();

            //生成订单
            $order= new Order();
            $order->order_syn=date('YmdHis',time()).rand(1000000000,9999999999);
            $order->order_price=$price*$buynum/10;
            $order->mid=$mid;
            $order->addtime=time();
            $order->save();

            $oid=$order->attributes['id'];
            $orderGoods= new OrderGoods();
            $orderGoods->oid=$oid;
            $orderGoods->gid=$gid;
            $orderGoods->buynum=$buynum;
            $orderGoods->save();

            if(''){
                return Json::encode(['code' => 1, 'body' => '兑换成功']);
            }else {
                return Json::encode(['code' => 5, 'body' => '兑换失败']);
            }
        }
    }















    //我的购物车--->生成订单
    public function createOrder(){
        $order=D("Order");
        $orderGoods=D("Order_goods");
        if(session("mid")&&session("mid")>0){
            //组建订单数据
            $data["mid"]=session("mid");//购买用户
            $data["order_syn"]=date("YmdHis",time()).rand(1000000000,9999999999);//订单号
            $data["order_price"]=I("post.total_price");//订单总价
            $data["addtime"]=time();//下单时间
            //判断商品总价是否为空，为空代表没有商品被选中购买
            if(!I("post.total_price")){
                $this->ajaxReturn(array("status"=>"error","msg"=>"请至少勾选一项商品进行购买"));
            }
            $oid=$order->add($data);//把数据存入订单表
            //将订单中的商品，更新到订单商品表中
            foreach(I("post.checkitems") as $gid){
                $goods["oid"]=$oid;
                $goods["gid"]=$gid;
                $goods["buynum"]=I("post.buynum".$gid);
                $og=$orderGoods->add($goods);
            }
            if($oid && $og){
                //修改拍卖成功的状态
                $successInfo["isshow"]=0;
                $auctionInfo["mid"]=session("mid");
                $auctionInfo["ag_id"]=I("post.ag_id");
                M("Auction_success")->where($auctionInfo)->save($successInfo);
                if(I("post.pay")){
                    $this->ajaxReturn(array("status"=>"ok","msg"=>"下单成功","oid"=>$oid,"pay"=>I("post.pay")));
                }else{
                    $this->ajaxReturn(array("status"=>"ok","msg"=>"下单成功","oid"=>$oid));
                }
            }else{
                $this->ajaxReturn(array("status"=>"error","msg"=>"请至少选择一项商品进行购买"));
            }
        }else{
            $this->ajaxReturn(array("status"=>"login","msg"=>"请登录后再购买！！！"));
        }
    }

    //积分处理生成订单
    public function integral(){
        $order=D("Order");
        $og=D("Order_goods");
        $member=M("Member");
        $mid=session("mid");
        if($mid){
            $price=I("post.price");
            //首先判断用户的积分是否充足
            $memberInfo=$member->where("id={$mid}")->field("credit,money")->find();
            if($memberInfo["credit"]<$price){
                $this->ajaxReturn(array("status"=>"error","msg"=>"兑换失败,你的积分不足"));
            }else{
                $buynum=I("post.buynum");
                //积分充足，扣除积分兑换成余额，更新会员的积分
                $memberInfo1["id"]=$mid;
                $memberInfo1["credit"]=floor($memberInfo["credit"])-floor($price);
                $memberInfo1["money"]=$memberInfo["money"]+($price*$buynum)/10;
                $member->save($memberInfo1);
                //记录积分兑换的商品信息,插入到积分兑换表中
                $creditModel=M("Credit_goods");
                $credit["gid"]=I("post.gid");
                $credit["buynum"]=$buynum;
                $credit["mid"]=$mid;
                $credit["credit"]=$price*$buynum;
                $credit["addtime"]=time();
                $creditModel->add($credit);
                //生成订单
                $data["order_syn"]=date("YmdHis",time()).rand(1000000000,9999999999);//订单号
                $data["order_price"]=($price*$buynum)/10;
                $data["mid"]=$mid;
                $data["addtime"]=time();
                $oid=$order->add($data);
                if($oid){
                    $goods["oid"]=$oid;
                    $goods["gid"]=I("post.gid");
                    $goods["buynum"]=$buynum;
                    $og_id=$og->add($goods);
                }
                if($oid && $og_id){
                    $this->ajaxReturn(array("status"=>"ok","msg"=>"订单生成","oid"=>$oid));
                }else{
                    $this->ajaxReturn(array("status"=>"error","msg"=>"兑换失败"));
                }
            }
        }else{
            $this->ajaxReturn(array("status"=>"error","msg"=>"登录后才能兑换"));
        }
    }
}







































