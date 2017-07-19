<?php
namespace frontend\controllers;


use frontend\models\Message;
use yii\data\Pagination;

class MessageController extends PersonalController{
    public function actionIndex(){
        $id=\Yii::$app->request->get('id');
        $where['m.id']=$id;
        $info=Message::find()->alias('m')
            ->where($where)
            ->select('m.*,g.goodsname,g.pic,mu.username as lucky,d.deposit')
            ->joinWith('auctionGoods ag')
            ->joinWith('success s')
            ->innerJoin('shop_goods g','ag.gid=g.id')
            ->innerJoin('shop_member mu','s.mid=mu.id')
            ->innerJoin('shop_auction_deposit d','d.ag_id=ag.id and d.mid=s.mid')
            ->asArray()->one();
        return $this->render('index',['info'=>$info]);
    }

    public function actionUnread(){
        $where['mid']=$this->mid;
        $where['msgstatus']=0;
        $message=Message::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$message->count()
        ]);
        $list=$message->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('unread',['list'=>$list,'pages'=>$pages]);
    }

    public function actionRead(){
        $where['mid']=$this->mid;
        $where['msgstatus']=1;
        $message=Message::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$message->count()
        ]);
        $list=$message->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('unread',['list'=>$list,'pages'=>$pages]);
    }
}