<?php
namespace frontend\controllers;

use backend\models\Activity;
use backend\models\Advertise;
use backend\models\Article;
use backend\models\Brand;
use backend\models\Category;
use backend\models\Goods;
use backend\models\Member;
use backend\models\News;
use backend\models\Order;
use backend\models\OrderGoods;
use yii\web\Controller;

class IndexController extends BaseController{
    public $layout=false;

    public function actionIndex(){
        $mid=$this->mid;
        $info=Member::findOne($mid);
        $category=$this->getCategory();
        $recommend=Goods::find()->where(['display'=>1,'activity'=>0])->orderBy('salenum desc')->limit(8)->asArray()->all();
        $brand=Brand::find()->limit(10)->asArray()->all();
        $order=$this->getOrderList();
        $news=News::find()->where(['isshow'=>1])->limit(6)->orderBy('addtime desc')->asArray()->all();
        $hot=Goods::find()->where(['display'=>1,'activity'=>1])->orderBy('salenum desc')->limit(8)->asArray()->all();
        $activity=Activity::find()->joinWith('goods')->limit(5)->asArray()->all();
        $advertise=$this->getAdvertise();
        $list['a']=$this->getGoodsList(1);
        $list['b']=$this->getGoodsList(2);
        $list['c']=$this->getGoodsList(3);
        $list['d']=$this->getGoodsList(4);
        $like=Goods::find()->orderBy('clicknum desc')->limit(6)->asArray()->all();
        $article=$this->getArticle();
        return $this->render('index',[
            'info'=>$info,
            'category'=>$category,
            'recommend'=>$recommend,
            'brand'=>$brand,
            'news'=>$news,
            'order'=>$order,
            'hot'=>$hot,
            'activity'=>$activity,
            'advertise'=>$advertise,
            'list'=>$list,
            'like'=>$like,
            'article'=>$article
        ]);
    }

    public function actionAdvertise(){
        return $this->render('advertise');
    }

    public function getCategory(){
        $where['pid']=0;
        $where['active']=1;
        $category=Category::find()->where($where)->asArray()->all();
        foreach($category as $k1=>$v1){
            $where['pid']=$v1['id'];
            $category[$k1]['child']=Category::find()->where($where)->asArray()->all();
            foreach($category[$k1]['child'] as $k2=>$v2){
                $where['pid']=$v2['id'];
                $category[$k1]['child'][$k2]['child']=Category::find()->where($where)->asArray()->all();
            }
        }
        return $category;
    }

    public function getGoodsList($id){
        $info=Category::findOne($id);
        $where=['like','path',$info['path']];
        $cate=Category::find()->where($where)->asArray()->all();
        $str='';
        foreach($cate as $v){
            $str.=$v['id'].',';
        }
        $path=explode(',',substr($str,0,-1));
        $conditon=['in','cid',$path];
        $factor['delete']=0;
        $factor['display']=1;
        $list=Goods::find()->where($conditon)->andWhere($factor)
            ->limit(8)->asArray()->all();
        return $list;
    }

    public function getAdvertise(){
        $where=['!=','top',0];
        $conditon1['adposition']=0;
        $conditon2['adposition']=1;
        $conditon3['adposition']=2;
        $conditon4['adposition']=3;
        $conditon5['adposition']=4;
        $advertise['a']=Advertise::find()->where($where)->andWhere($conditon1)->orderBy('top desc')->asArray()->all();
        $advertise['b']=Advertise::find()->where($where)->andWhere($conditon2)->orderBy('top desc')->asArray()->all();
        $advertise['c']=Advertise::find()->where($where)->andWhere($conditon3)->orderBy('top desc')->asArray()->all();
        $advertise['d']=Advertise::find()->where($where)->andWhere($conditon4)->orderBy('top desc')->asArray()->all();
        $advertise['e']=Advertise::find()->where($where)->andWhere($conditon5)->orderBy('top desc')->asArray()->all();
        return $advertise;
    }

    public function getOrderList(){
        $where['o.order_status']=1;
        $list=OrderGoods::find()->alias('og')
            ->joinWith('goods')
            ->joinWith('order o')
            ->where($where)
            ->orderBy('og.id desc')
            ->asArray()
            ->all();
        return $list;
    }

    public function getArticle(){
        $article=Article::find()->where(['active'=>1])->select('title')->groupBy('title')->asArray()->all();
        foreach($article as $k=>$v){
            $article[$k]['category']=Article::find()->where(['title'=>$v['title']])->asArray()->all();
        }
        return $article;
    }

    public function actionConnect(){
        return $this->render('connect');
    }









    /*public function index(){
        $goodslist1=$this->getGoodslist(1);
        $goodslist2=$this->getGoodslist(2);
        $goodslist3=$this->getGoodslist(3);
        $goodslist4=$this->getGoodslist(4);
        $cart=M('cart');
        if (session("mid") && session("mid") > 0){
            $mid=session('mid');
            $dat=$cart->where("mid={$mid}")->select();
            foreach ($dat as $k=>$v){
                $abc[]=$v['buynum'];
                $sum='';
                foreach ($abc as $k1=>$v1){
                    $sum+=$v1;
                }
            }
        }else{
            $abc=session("mycart");
                $sum = '0';
                foreach ($abc as $k=>$v){
                    $sum+=$v['buynum'];
                }
            }
        session("sum",$sum);
        $this->assign('sum',$sum);
        $show=$this->lastlist();
        $this->assign('lastlist',$show);
        //循环商标
        $brand = M('Brand');
        $bpic = $brand->limit(10)->select();
        $activity =M('Goods');
        $act = M('Activity');
        //第一排促销活动
        $firsttj = $activity->order('addtime desc')->where(array("activity"=>0,'display'=>1))->limit(10)->select();
        //循环促销商品
        $h = $act->field('gid,endtime')->limit(5)->select();
        foreach ($h as $k=>$v){
            $where1['id']=$v['gid'];
            $cxlist = $activity->where($where1)->select();
            foreach($cxlist as $k1=>$v1){
                $cxlist[$k1]['endtime']=$v['endtime'];
            }
            $sumlist[]=$cxlist[0];
        }
        //循环推荐商品
        $tjlist = $activity->order('salenum desc')->where(array("activity"=>0,'display'=>1))->limit(8)->select();
        //主页菜单
        $cate = M('Category');
        $firstcate = $cate->where(array('pid'=>0,'active'=>1))->field('catename,id,path' )->select();
        foreach ($firstcate as $k=>$v){
            $where['pid'] = $v['id'];
            $where['active']=1;
            $firstcate[$k]['second'] = $cate->where($where)->field('catename,id,path')->select();
            foreach ($firstcate[$k]['second'] as $k1=>$v1){
                $firstcate[$k]['second'][$k1]['third'] = $cate->where(array('pid'=>$v1['id'],'active'=>1))->select();
            }
        }
        //猜我喜欢
        $like = $activity->order('clicknum desc')->limit(6)->select();
        //获取session
        $mid = session('mid');
        $this->assign('time',time());
        $this->assign('mid',$mid);
        $this->assign('like',$like);
        $this->assign('firstcate',$firstcate);
        $this->assign('sumlist',$sumlist);
        $this->assign('tjlist',$tjlist);
        $this->assign('firsttj',$firsttj);
        $this->assign('bpic',$bpic);
        $this->assign('goodslist1',$goodslist1);
        $this->assign('goodslist2',$goodslist2);
        $this->assign('goodslist3',$goodslist3);
        $this->assign('goodslist4',$goodslist4);
        //广告部分
        $where['top']=array('neq',0);
        $ads=M('Ads');
        $where['adposition']=0;
        $adslist=$ads->where($where)->order('top desc')->select();
        $this->assign('adslist',$adslist);
        $where['adposition']=1;
        $adslist1=$ads->where($where)->order('top desc')->select();
        $this->assign('adslist1',$adslist1);
        $where['adposition']=2;
        $adslist2=$ads->where($where)->order('top desc')->select();
        $this->assign('adslist2',$adslist2);
        $where['adposition']=3;
        $adslist3=$ads->where($where)->order('top desc')->select();
        $this->assign('adslist3',$adslist3);
        $where['adposition']=4;
        $adslist4=$ads->where($where)->order('top desc')->select();
        $this->assign('adslist4',$adslist4);
        $this->assign('indexTag','index');
        $nasd=A('News');
        $newsinfo=$nasd->getNewsList();
        $this->assign('xinwen',$newsinfo);
        //文档列表
        $articleInfo=A('Home/Article')->article();
        $this->assign('articleInfo',$articleInfo);
        $this->display();
    }
    //广告页面
    public function ads(){
        $list1= $this->getGoodslist(3);
        $list2 =$this->getGoodslist(5);
        $list3 = $this->getGoodslist(1);
        $list4 = $this->getGoodslist(2);
        $this->assign('list1',$list1);
        $this->assign('list2',$list2);
        $this->assign('list3',$list3);
        $this->assign('list4',$list4);
        $this->display();
    }
    public function buyCart(){
        $cart = M('cart');
        $goods=D("Goods");
        if (session("mid") && session("mid") > 0) {
            $user["mid"]=session("mid");
            $ceshi=$cart->where($user)->field('id')->select();
            if ($ceshi){
                $data=$cart->where($user)
                    ->join('shop_goods ON shop_cart.gid=shop_goods.id')
                    ->select();
                echo json_encode($data);
            }
        }else{
            foreach(array_reverse(session("mycart")) as $k=>$v){
                $data[$k]=$goods->getSessionGoods($v["gid"]);
                $data[$k]["gid"]=$v["gid"];
                $data[$k]["buynum"]=$v["buynum"];
            }
            echo json_encode($data);
        }
    }
    public function buycar(){
        $cart=M('cart');
        if (session("mid") && session("mid") > 0){
            $user['mid']=session('mid');
            $dat=$cart->where($user)->select();
            $this->assign('buynum',$dat);
            $this->display('Home/Index/index');
        }
    }*/
}