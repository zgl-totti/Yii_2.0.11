<?php
namespace frontend\controllers;


use backend\models\Goods;
use frontend\models\Cart;
use yii\helpers\Json;

class CartController extends BaseController{
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
        if($this->mid){
            $mid=$this->mid;
            $where['mid']=$mid;
            $list=Cart::find()->where($where)->joinWith('goods')->asArray()->all();
        }else{
            for($i=0;$i>0;$i++){
                $session[]=\Yii::$app->session->get('mycart'.$i);
            }
            foreach($session as $k=>$v){
                $list[$k]['goods']=Goods::findOne($v['gid']);
            }
        }
        $condition['display']=1;
        $recommend=Goods::find()->where($condition)->orderBy('salenum desc')->limit(10)->asArray()->all();
        return $this->render('index',['list'=>$list,'recommend'=>$recommend]);
    }

    public function actionDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            if($this->mid){
                $row=Cart::findOne($id)->delete();
                if($row){
                    return Json::encode(['code'=>1,'body'=>'删除成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'删除失败']);
                }
            }else{
                //\Yii::$app->session->set('mycart'.$id,null);
                \Yii::$app->session->remove('mycart'.$id);
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isAjax){
            $mid=$this->mid;
            $gid=\Yii::$app->request->post('gid');
            $buynum=\Yii::$app->request->post('buynum');
            if($mid){
                $info=Cart::findOne(['mid'=>$mid,'gid'=>$gid]);
                if($info){
                    $info->buynum=$info['buynum']+$buynum;
                    $info->addtime=time();
                    if($info->save()){
                        return Json::encode(['code'=>1,'body'=>'添加购物车成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'添加购物车失败']);
                    }
                }else{
                    $cart= new Cart();
                    $cart->mid=$mid;
                    $cart->gid=$gid;
                    $cart->buynum=$buynum;
                    $cart->addtime=time();
                    if($cart->save()){
                        return Json::encode(['code'=>1,'body'=>'添加购物车成功']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'添加购物车失败']);
                    }
                }
            }else{
                $session=\Yii::$app->session->get('mycart'.$gid);
                if($session){
                    $session['buynum']=$session['buynum']+$buynum;
                    $session['addtime']=time();
                    \Yii::$app->session->set('mycart'.$gid,$session);
                    return Json::encode(['code'=>1,'body'=>'添加购物车成功']);
                }else{
                    $mycart['gid']=$gid;
                    $mycart['buynum']=$buynum;
                    $mycart['addtime']=time();
                    \Yii::$app->session->set('mycart'.$gid,$mycart);
                    return Json::encode(['code'=>1,'body'=>'添加购物车成功']);
                }
            }
        }else{
            $gid=\Yii::$app->request->get('gid');
            $info=Goods::findOne($gid);
            $mid=$this->mid;
            if($mid){
                $cart=Cart::findOne(['mid'=>$mid,'gid'=>$gid]);
                $info['buynum']=$cart['buynum'];
            }else{
                $session=\Yii::$app->session->get('mycart'.$gid);
                $info['buynum']=$session['buynum'];
            }
            $where=['!=','c.id',$gid];
            $goods=Cart::find()->alias('c')->where($where)->joinWith('goods')->asArray()->all();
            return $this->render('add',['info'=>$info,'goods'=>$goods]);
        }
    }
}