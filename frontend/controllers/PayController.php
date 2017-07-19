<?php
namespace frontend\controllers;


use backend\models\Goods;
use backend\models\Member;
use backend\models\Order;
use backend\models\OrderGoods;
use yii\helpers\Json;

class PayController extends BaseController{
    public $mid;

    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid',47);
        if(is_int($mid) && $mid>0){
            $this->mid=$mid;
        }else{
            return $this->redirect(['/login/index']);
        }
    }

    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            $oid=\Yii::$app->request->post('oid');
            $address=\Yii::$app->request->post('address');
            $delivery=\Yii::$app->request->post('delivery');
            if(!$address){
                return Json::encode(['code'=>5,'body'=>'收货地址不能为空']);
            }
            $info=Order::findOne($oid);
            $info->address=$address;
            $info->delivery=$delivery;
            if($info->save()){
                return Json::encode(['code'=>1,'body'=>'订单提交成功']);
            }else{
                return Json::encode(['code'=>5,'body'=>'订单提交失败']);
            }
        }else{
            $oid=\Yii::$app->request->get('oid');
            $info=Order::findOne($oid);
            return $this->render('index',['info'=>$info]);
        }
    }

    public function actionPayment(){
        if(\Yii::$app->request->isAjax){
            $oid=\Yii::$app->request->post('oid');
            $paypwd=trim(\Yii::$app->request->post('paypwd'));
            if(!$paypwd){
                return Json::encode(['code'=>5,'body'=>'支付密码不能为空']);
            }
            $mid=$this->mid;
            $where['mid']=$mid;
            $where['paypwd']=$paypwd;
            $info=Member::findOne($where);
            if(!$info){
                return Json::encode(['code'=>5,'body'=>'支付密码错误']);
            }
            $order=Order::findOne($oid);
            if($order['order_price']>$info['money']){
                return Json::encode(['code'=>5,'body'=>'余额不足,请充值']);
            }
            $info->credit=$info['credit']+floor($order['order_price']/10);
            $info->money=$info['money']-$order['order_price'];
            $costs=$info['costs']+$order['order_price'];
            $info->costs=$costs;
            if($costs>0 && $costs<=2999){
                $info->level=1;
            }elseif($costs>2999 && $costs<=4999){
                $info->level=2;
            }elseif($costs>4999 && $costs<=7999){
                $info->level=3;
            }elseif($costs>7999 && $costs<=9999){
                $info->level=4;
            }else{
                $info->level=5;
            }
            $info->save();

            $order->order_status=2;
            $order->save();

            $orderGoods=OrderGoods::find()->where(['oid'=>$oid])->asArray()->all();
            foreach($orderGoods as $k=>$v){
                $goods=Goods::findOne($v['gid']);
                $goods->salenum=$goods['salenum']+$v['buynum'];
                if($goods['num']<$v['buynum']){
                    return Json::encode(['code'=>5,'body'=>'库存量不足']);
                }
                $goods->num=$goods['num']-$v['buynum'];
                $goods->save();
            }

            return Json::encode(['code'=>1,'body'=>'支付成功']);
        }
    }




    /*//确认支付
    public function topay(){
        $member=M("Member");
        $goods=M("Goods");
        $order=D("Order");
        if(IS_POST){
            $mid=session("mid");//会员ID
            $oid=I("post.oid");
            //根据订单ID，查出订单总价
            $orderInfo=$this->orderTotal($oid);
            $orderTotal=$orderInfo["order_price"];
            $orderSyn=$orderInfo["order_syn"];
            //根据会员ID，查出会员的余额
            $memberInfo=$this->memberMoney($mid);
            $memberMoney=$memberInfo["money"];
            $memberPayPwd=$memberInfo["paypwd"];
            $memberCosts=$memberInfo["costs"];
            $memberCredit=$memberInfo["credit"];
            //根据订单ID，查出订单的所有商品信息【salenum,num】
            $goodsInfo=$this->goodsInfo($oid);
            $paypwd=I("post.paypwd");
            //支付密码不能为空
            if(!$paypwd){
                $this->ajaxReturn(array("status"=>"error","msg"=>"支付密码不能为空"));
            }else{
                //支付密码是否正确
                if($paypwd!=$memberPayPwd){
                    $this->ajaxReturn(array("status"=>"error","msg"=>"支付密码不正确"));
                }else{
                    //判断会员余额是否足够
                    if($memberMoney<$orderTotal){
                        $this->ajaxReturn(array("status"=>"error","msg"=>"余额不足，请去充值"));
                    }else{
                        //支付
                        $data["id"]=$mid;
                        $data["credit"]=$memberCredit+floor($orderTotal/10);
                        $data["costs"]=$memberCosts+$orderTotal;
                        $data["money"]=$memberMoney-$orderTotal;
                        //根据会员的消费，计算会员的等级
                        $costsLevel=$data["costs"];
                        if($costsLevel>0&&$costsLevel<=2999){
                            //普通会员
                            $data["level"]=1;
                        }elseif($costsLevel>2999&&$costsLevel<=4999){
                            //黄铜会员
                            $data["level"]=2;
                        }elseif($costsLevel>4999&&$costsLevel<=7999){
                            //白银会员
                            $data["level"]=3;
                        }elseif($costsLevel>7999&&$costsLevel<=9999){
                            //黄金会员
                            $data["level"]=4;
                        }else{
                            //钻石会员
                            $data["level"]=5;
                        }
                        $member->save($data);
                        //更新商品数量信息
                        foreach($goodsInfo as $k=>$v){
                            $goodsData=$this->getGoodsNum($v["id"]);
                            $goodsNum["id"]=$v["id"];
                            $goodsNum["salenum"]=$goodsData["salenum"]+$v["buynum"];
                            if($goodsData["num"]<$v["buynum"]){
                                $this->ajaxReturn(array("status"=>"error","msg"=>"库存量不足"));
                            }
                            $goodsNum["num"]=$goodsData["num"]-$v["buynum"];
                            $goods->save($goodsNum);
                        }
                        //更新订单表中的状态值为2【代表已付款】
                        $status["order_status"]=2;
                        $status["id"]=$oid;
                        $order->save($status);
                        //返回支付成功信息
                        $this->ajaxReturn(array("status"=>"ok","msg"=>"支付成功","oid"=>$oid,"orderSyn"=>$orderSyn));
                    }
                }
            }
        }else{
            $this->display("Home/Pay/paylist");
        }
    }*/
}



























