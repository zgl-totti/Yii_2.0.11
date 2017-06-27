<?php
namespace backend\controllers;

use backend\models\Auction;
use backend\models\AuctionGoods;
use backend\models\AuctionSuccess;
use yii\data\Pagination;
use yii\helpers\Json;

class AuctionController extends BaseController{
    public $layout=false;
    public $enableCsrfValidation=false;

    public function actionIndex(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','g.goodsname',$keywords];
        }else{
            $where='';
        }
        $auction=AuctionGoods::find()->joinWith('goods g')->where($where);
        $pages= new Pagination([
            'pageSize'=>$auction->count()
        ]);
        $list=$auction->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index',['list'=>$list,'pages'=>$pages,'keywords'=>$keywords]);
    }

    public function actionSettime(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $starttime=strtotime(\Yii::$app->request->post('starttime'));
            $endtime=strtotime(\Yii::$app->request->post('endtime'));
            if($endtime>$starttime){
                $auction=AuctionGoods::findOne($id);
                $data['AuctionGoods']['starttime']=$starttime;
                $data['AuctionGoods']['endtime']=$endtime;
                if($auction->load($data) && $auction->save()){
                    return Json::encode(['code'=>1,'body'=>'设置成功']);
                }else{
                    return Json::encode(['code'=>2,'body'=>'设置失败']);
                }
            }else{
                return Json::encode(['code'=>3,'body'=>'时间设置错误']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $info=AuctionGoods::findOne($id);
            return $this->render('settime',['info'=>$info]);
        }
    }

    public function actionOperate(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $auction=AuctionGoods::findOne($id);
            $auction->isshow=$auction['isshow']==0?1:0;
            if($auction->save()){
                return Json::encode(['code'=>1,'body'=>'更改状态成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'更改状态失败']);
            }
        }
    }

    //竞价记录
    public function actionBidding(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','g.goodsname',$keywords];
        }else{
            $where='';
        }
        $auction=Auction::find()->alias('a')
            ->joinWith('auctionGoods ag')
            ->innerJoin('shop_goods g','g.id=ag.gid')
            ->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$auction->count()
        ]);
        $list=$auction->joinWith('member')
            ->select('a.*,g.goodsname,g.pic')
            ->offset($pages->offset)->limit($pages->limit)
            ->asArray()->all();
        return $this->render('bidding',['keywords'=>$keywords,'pages'=>$pages,'list'=>$list]);
    }

    public function actionBiddingDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Auction::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    //成交记录
    public function actionBargain(){
        $keywords=trim(\Yii::$app->request->get('keywords'));
        if($keywords){
            $where=['like','g.goodsname',$keywords];
        }else{
            $where='';
        }
        $auction=AuctionSuccess::find()->alias('a')
            ->joinWith('auctionGoods ag')
            ->innerJoin('shop_goods g','g.id=ag.gid')
            ->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$auction->count()
        ]);
        $list=$auction->joinWith('member')
            ->select('a.*,g.goodsname,g.pic')
            ->offset($pages->offset)->limit($pages->limit)
            ->asArray()->all();
        return $this->render('bargain',['keywords'=>$keywords,'pages'=>$pages,'list'=>$list]);
    }

    public function actionBargainDel(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=AuctionSuccess::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败']);
            }
        }
    }

    public function actionBargainDetail(){
        $id=\Yii::$app->request->get('id');
        $info=AuctionSuccess::find()->alias('as')
            ->joinWith('member')
            ->joinWith('auctionGoods ag')
            ->innerJoin('shop_goods g','g.id=ag.gid')
            ->innerJoin('shop_auction_deposit d','d.mid=as.mid and d.ag_id=as.ag_id')
            ->innerJoin('shop_auction a','a.mid=as.mid and a.ag_id=as.ag_id')
            ->select('as.*,g.goodsname,g.pic,d.deposit,max(a.addtime) addtime')
            ->where(['as.id'=>$id])
            ->asArray()->one();
        return $this->render('detail',['info'=>$info]);
    }




    /*//成交记录
    public function submitList(){
        $auctionGodos=M("Auction_goods");
        $auctionSuccess=M("Auction_success");
        $auction=D("Auction");
        //【1】把拍卖表中状态为0的拍卖品转入拍卖成功交易表
        $info1=$auctionGodos->where("status=0")->select();
        //遍历连表auction查询信息
        foreach($info1 as $k=>$v){
            //先得到目前每个商品的最高价
            $data["ag_id"]=$v["id"];
            $maxprice=$auction->where("ag_id={$v['id']}")->max("auctionprice");
            //根据最高价格，和拍卖品主键ID，唯一定位会员ID
            $midArr=$auction->field("mid")->where("ag_id={$v['id']} AND auctionprice='{$maxprice}'")->find();
            if($midArr["mid"]){
                $data["mid"]=$midArr["mid"];
            }
            $data["price"]=$maxprice;
            //查看拍卖交易成功表中是否存在
//            $info2=$auctionSuccess->where($data)->find();
            //有人出价时
            if($data["price"]){
                //查看拍卖交易成功表中是否存在
                $info2=$auctionSuccess->where($data)->find();
            }
            //当不存在时，直接写入拍卖交易成功表中
            if(!$info2){
                $auctionSuccess->add($data);
            }
        }
        //【2】交易成功列表页
        $condition["goodsname"]=array("like","%".I('get.keywords')."%");
        if(I('get.keywords')){
            //从交易成功表中查询出交易成功的记录
            $count=$auctionSuccess->alias("s")->where($condition)->join("shop_auction_goods ag on s.ag_id=ag.id")
                                  ->join("shop_goods g on g.id=ag.gid")->count();
        }else{
            //从交易成功表中查询出交易成功的记录
            $count=$auctionSuccess->count();
        }
        $page=new Page($count,2);
        $show=$page->show();
        $page->rollPage=3;
        $page->setConfig("first","首页");
        if(I("get.keywords")){
            $successInfo=$auctionSuccess->alias("s")->where($condition)->field("s.id,g.pic,g.goodsname,m.username,s.price")
                ->join("shop_auction_goods ag on s.ag_id=ag.id")
                ->join("shop_goods g on g.id=ag.gid")
                ->join("shop_member m on m.id=s.mid")->limit($page->firstRow.','.$page->listRows)->select();
        }else{
            $successInfo=$auctionSuccess->alias("s")->field("s.id,g.pic,g.goodsname,m.username,s.price")
                ->join("shop_auction_goods ag on s.ag_id=ag.id")
                ->join("shop_goods g on g.id=ag.gid")
                ->join("shop_member m on m.id=s.mid")->limit($page->firstRow.','.$page->listRows)->select();
        }
        $map["key"]=I("get.keywords");
        foreach($map as $k=>$v){
            $page->parameter[$k]=urlencode($v);
        }
        $this->assign("successInfo",$successInfo);
        $this->assign("firstRow",$page->firstRow);
        $this->assign("page",$show);
        $this->assign("keywords",I("get.keywords"));
        $this->display();
    }
    //前台拍卖控制器调用
    public function autoDY(){
        $auctionGodos=M("Auction_goods");
        $auctionSuccess=M("Auction_success");
        $auction=D("Auction");
        //【1】把拍卖表中状态为0的拍卖品转入拍卖成功交易表
        $info1=$auctionGodos->where("status=0")->select();
        //遍历连表auction查询信息
        foreach($info1 as $k=>$v){
            //先得到目前每个商品的最高价
            $data["ag_id"]=$v["id"];
            $maxprice=$auction->where("ag_id={$v['id']}")->max("auctionprice");
            //根据最高价格，和拍卖品主键ID，唯一定位会员ID
            $midArr=$auction->field("mid")->where("ag_id={$v['id']} AND auctionprice='{$maxprice}'")->find();
            if($midArr["mid"]){
                $data["mid"]=$midArr["mid"];
            }
            $data["price"]=$maxprice;
            //有人出价时
            if($data["price"]){
                //查看拍卖交易成功表中是否存在
                $info2=$auctionSuccess->where($data)->find();
            }
            //当不存在时，直接写入拍卖交易成功表中
            if(!$info2){
                $auctionSuccess->add($data);
            }
        }
    }*/
}