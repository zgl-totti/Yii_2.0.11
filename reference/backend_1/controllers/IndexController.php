<?php
namespace backend\controllers;


use backend\models\Adminnav;
use backend\models\Goods;
use backend\models\Member;
use backend\models\Order;
use backend\models\Visitcount;

class IndexController extends BaseController{
    public function actionIndex(){
        return $this->renderPartial('index');
    }

    public function actionMain(){
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $where=['between','add_time',[$beginToday,$endToday]];
        $condition['status']=3;
        $factor['visit_time']=$beginToday;
        $order=new Order();
        $member=new Member();
        $goods=new Goods();
        $visitCount=new Visitcount();
        $goodsCount=$goods->num($condition);
        $count=$member->num($where);
        $visitCount=$visitCount->getOne($factor);
        $data=$order->getTodayOrder($where);
        $status=$order->getStatus($where);
        return $this->renderPartial('index',[
            'goodsCount'=>$goodsCount,
            'orderStatus'=>$status,
            'visitCount'=>$visitCount['count'],
            'registerCount'=>$count,
            'data'=>$data,
        ]);


        /*$Order=D('Orders');
        $Visit=M('VisitCount');
        $Member=D('Member');
        $GoodsReturn=M('GoodsReturn');
        $where1['status']=3;
        $GoodsReturnCount=$GoodsReturn->where($where1)->count();
        $count=$Member->TodayRegister($beginToday,$endToday);
        $visitCount=$Visit->where("visit_time=".$beginToday)->field('count')->find();
        $data=$Order->getTodayOrder($beginToday,$endToday);
        $status=$Order->getStatus($beginToday,$endToday);
        $this->assign('TodayPrices',$data['TodayPrice']);
        $this->assign('TodayOrderNum',$data['TodayOrderNum']);
        $this->assign('RegisterCount',$count);
        $this->assign('visitCount',$visitCount['count']);
        $this->assign('Orderstatus',$status);
        $this->assign('ReturnCount',$GoodsReturnCount);
        $this->display();*/
    }

    public function actionBar(){
        return $this->renderPartial('Public/bar');
    }

    public function actionTop(){
        return $this->renderPartial('Public/top');
    }

    public function actionMenu(){
        $nav=new Adminnav();
        $navList=$nav->getNavTree();
        return $this->renderPartial('Public/menu1',['navList'=>$navList]);


        /*$cuidan=M('cuidan');
        $where['cui_status']=1;
        $num=$cuidan->where($where)->count();
        $this->assign('num',$num);
        $nav=D('AdminNav');
        $navList=$nav->getNavTree();
        $this->assign('navList',$navList);
        $this->display('Public/menu1');*/
    }
}