<?php
namespace frontend\controllers;

use backend\models\Advertise;
use backend\models\Auction;
use backend\models\AuctionGoods;
use frontend\models\Deposit;
use frontend\models\Message;
use frontend\models\Success;
use yii\data\Pagination;
use yii\helpers\Json;

class AuctionController extends BaseController{
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $where['isshow']=1;
        $auction=AuctionGoods::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>9,
            'totalCount'=>$auction->count()
        ]);
        $list=$auction->joinWith('goods')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()->all();
        $condition=['!=','top',0];
        $factor['adposition']=5;
        $advertise=Advertise::find()->where($factor)->andWhere($condition)->orderBy('top desc')->asArray()->all();
        return $this->render('index',[
            'pages'=>$pages,
            'list'=>$list,
            'advertise'=>$advertise
        ]);
    }

    public function actionDetail(){
        if(\Yii::$app->request->isAjax){
            $ag_id=\Yii::$app->request->post('ag_id');
            $auctionPrice=\Yii::$app->request->post('auctionprice');
            $mid=\Yii::$app->session->get('mid');
            $where['ag_id']=$ag_id;
            $where['mid']=$mid;
            $info=Deposit::findOne($where);
            if($info){
                $num1=Auction::find()->where(['ag_id'=>$ag_id])->count();
                if($num1>10){
                    return Json::encode(['code'=>5,'body'=>'对不起，你来晚了，参赛人数已到上限']);
                }
                $num2=Auction::find()->where($where)->count();
                if($num2>=3){
                    return Json::encode(['code'=>5,'body'=>'对不起，每个人只能竞拍三次，你已用完']);
                }
                $arr=AuctionGoods::findOne($ag_id);
                if($auctionPrice<$arr['startprice']){
                    return Json::encode(['code'=>5,'body'=>'对不起,竞拍价不能低于起拍价']);
                }
                $time1=Auction::find()->where($where)->max('addtime');
                $condition=['and',['ag_id'=>$ag_id],['!=','mid',$mid]];
                $time2=Auction::find()->where($condition)->max('addtime');
                if($time1>=$time2){
                    return Json::encode(['code'=>5,'body'=>'对不起,你不能连续竞价']);
                }
                if($auctionPrice>$arr['maxprice']){
                    return Json::encode(['code'=>5,'body'=>'竞拍价不能高于最高价']);
                }
                if($auctionPrice==$arr['maxprice']){
                    $model=AuctionGoods::findOne($ag_id);
                    $model->status=0;
                    $model->save();

                    $success= new Success();
                    $success->mid=$mid;
                    $success->ag_id=$ag_id;
                    $success->price=$auctionPrice;
                    $success->save();

                    $auction= new Auction();
                    $auction->mid=$mid;
                    $auction->ag_id=$ag_id;
                    $auction->auctionprice=$auctionPrice;
                    $auction->addtime=time();
                    $row=$auction->save();

                    $message= new Message();
                    $message->mid=$mid;
                    $message->ag_id=$ag_id;
                    $message->message='恭喜你获得该宝贝，请去我的拍卖查看，付款，逾期将扣除保证金，谢谢合作!';
                    $message->addtime=time();
                    $message->save();

                    if($row){
                        return Json::encode(['code'=>1,'body'=>'恭喜你拍得该宝贝,请去会员中心查看']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'出价失败']);
                    }
                }else{
                    $auction= new Auction();
                    $auction->mid=$mid;
                    $auction->ag_id=$ag_id;
                    $auction->auctionprice=$auctionPrice;
                    $auction->addtime=time();
                    if($auction->save()){
                        $num3=3-($num2+1);
                        return Json::encode(['code'=>1,'body'=>'出价成功,该商品你还有'.$num3.'次竞拍机会']);
                    }else{
                        return Json::encode(['code'=>2,'body'=>'出价失败']);
                    }
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'你没交过保证金,不能直接参与竞拍']);
            }
        }else{
            $id=\Yii::$app->request->get('id');
            $where['a.id']=$id;
            $condition['ag_id']=$id;
            $info=AuctionGoods::find()->alias('a')->where($where)->joinWith('goods')->asArray()->one();
            $auctionPrice=Auction::find()->where($condition)->max('auctionprice');
            $info['auctionPrice']=$auctionPrice?$auctionPrice:$info['startprice'];
            $num1=Auction::find()->where($condition)->count();
            $num2=Auction::find()->groupBy('mid')->having($condition)->count();
            $info['totalNum']=$num1?$num1:0;
            $info['perpleNum']=$num2?$num2:0;
            return $this->renderPartial('detail',['info'=>$info]);
        }
    }

    //保证金
    public function actionDeposit(){
        if(\Yii::$app->request->isAjax){
            $ag_id=\Yii::$app->request->post('ag_id');
            $deposit=\Yii::$app->request->post('deposit');
            if(! is_numeric($deposit)){
                return Json::encode(['code'=>3,'body'=>'保证金必须是数字']);
            }
            $info=AuctionGoods::findOne($ag_id);
            $lowPrice=floor($info['maxprice']/2);
            if($lowPrice>$deposit){
                return Json::encode(['code'=>4,'body'=>'保证金不能低于'.$lowPrice.'元']);
            }
            $where['ag_id']=$ag_id;
            $where['deposit']=$deposit;
            $where['mid']=\Yii::$app->session->get('mid');
            $arr=Deposit::findOne($where);
            if($arr){
                return Json::encode(['code'=>5,'body'=>'你已经交过保证金了，可以直接参与竞价']);
            }
            $model= new Deposit();
            $model->mid=$where['mid'];
            $model->deposit=$deposit;
            $model->ag_id=$ag_id;
            if($model->save()){
                return Json::encode(['code'=>1,'body'=>'谢谢你的参与,请去竞价']);
            }else{
                return Json::encode(['code'=>2,'body'=>'保证金提交失败，请重试']);
            }
        }
    }

    //时间已到，拍卖结束,挑选出最大出价者
    public function actionTimeOver(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $where['ag_id']=$id;
            $info=Success::find()->where($where)->one();
            if(!$info){
                $auction=Auction::find()->where($where)->orderBy('auctionprice desc')->asArray()->one();
                $success= new Success();
                $success->mid=$auction['mid'];
                $success->ag_id=$id;
                $success->price=$auction['auctionprice'];
                $success->save();
            }
        }
    }
}