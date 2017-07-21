<?php
namespace frontend\controllers;

use backend\models\Brand;
use backend\models\Category;
use backend\models\Goods;
use backend\models\Member;
use yii\data\Pagination;
use yii\web\Controller;

class ProductController extends BaseController{
    
    /*public $mid;
    public function init(){
        parent::init();
        $mid=\Yii::$app->session->get('mid');
        $info=Member::findOne($mid);
        \Yii::$app->view->params['info']=$info;
        $this->mid=$mid;
    }*/

    public function actionIndex(){
        $bid=\Yii::$app->request->get('bid');
        $cid=\Yii::$app->request->get('cid');
        $keywords=trim(\Yii::$app->request->get('keywords'));
        $minprice=\Yii::$app->request->get('minprice');
        $maxprice=\Yii::$app->request->get('maxprice');
        $order=\Yii::$app->request->get('order');
        if($bid){
            $where['bid']=$bid;
        }else{
            $where='';
        }
        if($cid){
            $arr=['like','path',"$cid%",false];
            $a=Category::find()->where($arr)->select('id')->asArray()->all();
            foreach($a as $v){
                $b[]=$v['id'];
            }
            $term=['in','cid',$b];
        }else{
            $term='';
        }
        if($keywords){
            $divisor=['like','goodsname',$keywords];
        }else{
            $divisor='';
        }
        if($minprice && $maxprice){
            $condition=['between','price',$minprice,$maxprice];
        }else{
            $condition='';
        }
        if($order==1){
            $order_by='salenum';
        }elseif($order==2){
            $order_by='price';
        }elseif($order==3){
            $order_by='addtime';
        }else{
            $order_by='num';
        }
        $brand=Brand::findAll(['active'=>1]);
        $factor['display']=1;
        $goods=Goods::find()->where($where)->andWhere($condition)->andWhere($factor)->andWhere($term)->andWhere($divisor);
        $pages= new Pagination([
            'pageSize'=>16,
            'totalCount'=>$goods->count()
        ]);
        $goodsList=$goods->offset($pages->offset)->limit($pages->limit)->orderBy($order_by)->asArray()->all();
        $sales=Goods::find()->where(['display'=>1])->orderBy('salenum desc')->limit(10)->asArray()->all();
        \Yii::$app->view->params['keywords']=$keywords;
        return $this->render('index',[
            'brand'=>$brand,
            'goodsList'=>$goodsList,
            'pages'=>$pages,
            'sales'=>$sales,
            'bid'=>$bid,
            'min'=>$minprice,
            'order'=>$order
        ]);
    }




    /*public function showlist(){
        $where['display']=1;
        //品牌列表
        session('cx',null);
        session('path',null);
        $tjbrand['active']=1;
        $brandlist=$this->getBrands($tjbrand);
        $this->assign('brandlist',$brandlist);
        //productList列表
        session('bid',I('get.bid'));
        $bid=session('bid');
        //选择商品品牌
        if(!empty($bid)){
            $where['display']=1;
            $where['bid']=session('bid');
            session('max', I('get.maxprice'));
            session('min', I('get.minprice'));
            $max=session('max');
            $min=session('min');
            //选择商品价格
            if(!empty($min)&&!empty($max)) {
                $where['price'] = array(array('gt', $min), array('lt', $max));
                $order=I('get.order');
                $this->assign('orderIT',$order);
                //选择商品次序
                if(!empty($order)) {
                    $goodslist=$this->getGoods($where,$order);
                }else{      //未选择商品次序
                    $goodslist=$this->getGoods($where);
                }
            }else{   //未选择商品价格
                session('max', null);
                session('min', null);
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getGoods($where, $order);
                } else {  //未选择商品次序
                    $goodslist = $this->getGoods($where);
                }
            }
        }else{   //未选择商品品牌
            session('bid', null);
            session('max', I('get.maxprice'));
            session('min', I('get.minprice'));
            $max = session('max');
            $min = session('min');
            //选择商品价格
            if (!empty($min) && !empty($max)) {
                $where['price'] = array(array('gt', $min), array('lt', $max));
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getGoods($where, $order);
                } else {      //未选择商品次序
                    $goodslist = $this->getGoods($where);
                }
            } else {   //未选择商品价格
                session('max', null);
                session('min', null);
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getGoods($where, $order);
                } else {  //未选择商品次序
                    $goodslist = $this->getGoods($where);
                }
            }
        }
        $rank=$this->rank();
        $this->assign('rank',$rank);
        $history=new HistoryController();
        $historyInfo=$history->selectHistory();
        $this->assign("historyInfo",$historyInfo);
        $this->assign('empty','<span style="color: #c2ccd1;font-size: 32px;margin:0 auto;">没有数据^^</span>');
        $this->assign('min',$min);
        $this->assign('bid',$bid);
        $this->assign('goodslist',$goodslist);
        $this->display();
    }
    //头部查询
    public function searchlist(){
        session('bid',null);
        session('path',null);
        $brandlist=$this->getBrands();
        $this->assign('brandlist',$brandlist);
        //查询
        $where['display']=1;
        session('cx', I('get.words','',trim));
        $cx = session('cx');
        if (!empty($cx)) {
            $where['goodsname'] = array('like', "%$cx%");
            session('max', I('get.maxprice'));
            session('min', I('get.minprice'));
            $max = session('max');
            $min = session('min');
            if (!empty($min) && !empty($max)) {
                $where['price'] = array(array('gt', $min), array('lt', $max));
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getGoods($where, $order);
                } else {      //未选择商品次序
                    $goodslist = $this->getGoods( $where);
                }
            } else {   //未选择商品价格
                session('max', null);
                session('min', null);
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getGoods($where,$order);
                } else {      //未选择商品次序
                    $goodslist = $this->getGoods($where);
                }
            }
        }
        $history=new HistoryController();
        $historyInfo=$history->selectHistory();
        $this->assign("historyInfo",$historyInfo);
        $this->assign('empty','<span style="color: #c2ccd1;font-size: 32px;margin:0 auto;">没有数据^^</span>');
        $this->assign('min',$min);
        $this->assign('cx',trim(session('cx')));
        $this->assign('goodslist',$goodslist);
        $this->display();
    }
    //首页分类搜索
    public function catelist(){
        $where['display']=1;
        session('cx',null);
        session('bid',null);
        $brandlist=$this->getBrands();
        $this->assign('brandlist',$brandlist);
        //分类查询
        session('path', I('get.path'));
        $path = session('path');
        if (!empty($path)) {
            session('max', I('get.maxprice'));
            session('min', I('get.minprice'));
            $max = session('max');
            $min = session('min');
            if (!empty($min) && !empty($max)) {
                $where['price'] = array(array('gt', $min), array('lt', $max));
                //dump($where);
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getCate($path,$where,$order);
                } else {      //未选择商品次序
                    $goodslist = $this->getCate($path,$where);
                }
            } else {   //未选择商品价格
                session('max', null);
                session('min', null);
                $order = I('get.order');
                $this->assign('orderIT', $order);
                //选择商品次序
                if (!empty($order)) {
                    $goodslist = $this->getCate($path,$where,$order);
                } else {      //未选择商品次序
                    $goodslist = $this->getCate($path,$where);
                }
            }
        }
        $history=new HistoryController();
        $historyInfo=$history->selectHistory();
        $this->assign("historyInfo",$historyInfo);
        $this->assign('empty','<span style="color: #c2ccd1;font-size: 32px;margin:0 auto;">没有数据^^</span>');
        $this->assign('min',$min);
        $this->assign('goodslist',$goodslist);
        $this->display();
    }
    //品牌列表函数
    public function getBrands($where=array()){
        $brand=M('Brand');
        $brandlist=$brand->where($where)->select();
        return $brandlist;
    }
    //列表页函数
    public function getGoods($where=array(),$order){
        $goods=M('Goods');
        $count= $goods->alias('g')->join('shop_brand b ON g.bid=b.id')->where($where)->count();
        $p      = new Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $p->lastSuffix=false;
        $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev','上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last','末页');
        $p->setConfig('first','首页');
        $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show= $p->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('firstRow',$p->firstRow);// 赋值分页输出
        if($order==1){
            $orderIT='salenum';
        }elseif($order==2){
            $orderIT='price';
        }elseif($order==3){
            $orderIT='g.addtime';
        }else{
            $orderIT='g.num';
        }
        $goodslist= $goods->alias('g')->join('shop_brand b ON g.bid=b.id')->where($where)->field('g.*')->limit($p->firstRow . ',' . $p->listRows)->order($orderIT)->select();
        return $goodslist;
    }
    //首页分类搜索函数
    public function getCate($path,$where,$order){
        $category=M('Category');
        $map['path'] = array('LIKE', "$path%");
        $categoryList=$category->where($map)->field('id')->select();
        $goods=D('Goods');
        foreach($categoryList as $k=>$v){
            $cid[]=$v['id'];
        }
        $where['cid']=array('in',$cid);
        $count= $goods->where($where)->count();
        $p      = new Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $p->lastSuffix=false;
        $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录  第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev','上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last','末页');
        $p->setConfig('first','首页');
        $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show= $p->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('firstRow',$p->firstRow);// 赋值分页输出
        if($order==1){
            $orderIT='salenum';
        }elseif($order==2){
            $orderIT='price';
        }elseif($order==3){
            $orderIT='addtime';
        }else{
            $orderIT='num';
        }
        $goodslist= $goods->where($where)->order($orderIT)->limit($p->firstRow . ',' . $p->listRows)->select();
        return $goodslist;
    }
    public function rank(){
        $goods=M('goods');
        $rank=$goods->order('salenum desc')->limit(10)->select();
        return $rank;
    }*/
}