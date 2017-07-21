<?php
namespace frontend\controllers;


use backend\models\Address;
use backend\models\Auction;
use backend\models\AuctionSuccess;
use backend\models\Feedback;
use backend\models\Goods;
use backend\models\GoodsComment;
use backend\models\Member;
use backend\models\Order;
use backend\models\UploadForm;
use frontend\models\Cart;
use frontend\models\Collect;
use frontend\models\CommentPic;
use frontend\models\Credit;
use frontend\models\Draw;
use frontend\models\History;
use frontend\models\Message;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class PersonalController extends BaseController{
    public $layout='personal';
    public $mid;
    public function init(){
        parent::init();
        $_mid=$this->mid;
        if(is_int($_mid) && $_mid>0){
            $where['mid']=$_mid;
            $condition1['msgstatus']=0;
            $condition2['msgstatus']=1;
            $num1=Message::find()->where($where)->andWhere($condition1)->count();
            $num2=Message::find()->where($where)->andWhere($condition2)->count();
            \Yii::$app->view->params['num1']=$num1;
            \Yii::$app->view->params['num2']=$num2;
        }else{
            return $this->redirect(['/login/index']);
        }
    }

    public function actionIndex(){
        //print_r($this->mid);die;
        $mid=$this->mid;
        $where['mid']=$mid;
        $condition1['msgstatus']=0;
        $condition2['msgstatus']=1;
        $num1=Message::find()->where($where)->andWhere($condition1)->count();
        $num2=Message::find()->where($where)->andWhere($condition2)->count();
        $sum=Order::find()->where($where)->count();
        $cart=Cart::find()->where($where)->count();
        $factor['m.id']=$mid;
        $info=Member::find()->alias('m')->where($factor)->joinWith('level')->asArray()->one();
        $list=Order::find()->alias('o')
            ->joinWith('orderGoods og')
            ->joinWith('status s')
            ->where($where)->limit(3)
            ->asArray()->all();
        foreach($list as $k1=>$v1){
            foreach($v1['orderGoods'] as $k2=>$v2){
                $list[$k1]['orderGoods'][$k2]['info']=Goods::find()->where(['id'=>$v2['gid']])->asArray()->one();
            }
        }
        return $this->render('index',[
            'num1'=>$num1,
            'num2'=>$num2,
            'sum'=>$sum,
            'cart'=>$cart,
            'info'=>$info,
            'list'=>$list
        ]);
    }

    public function actionMember(){
        if(\Yii::$app->request->isPost) {
            $id=$this->mid;
            $member=Member::findOne($id);
            if($member->load(\Yii::$app->request->post(),'') && $member->validate()){
                $username=trim(\Yii::$app->request->post('username'));
                $info=Member::findOne(['username'=>$username]);
                if($info){
                    return Json::encode(['code'=>5,'body'=>'用户已存在']);
                }
                if($member->save()){
                    $model= new UploadForm();
                    $model->file=UploadedFile::getInstance($model,'file');
                    if($model->file) {
                        if ($model->validate()) {
                            $model->file->saveAs('@web/uploads/member/' . $model->file->baseName . '.' . $model->file->extension);
                            $member->pic = $model->file->baseName . $model->file->extension;
                            if ($member->save()) {
                                return Json::encode(['code' => 1, 'body' => '修改信息成功']);
                            } else {
                                return Json::encode(['code' => 2, 'body' => '修改信息失败']);
                            }
                        } else {
                            return Json::encode(['code' => 5, 'body' => $model->getErrors()]);
                        }
                    }else{
                        return Json::encode(['code' => 1, 'body' => '修改信息成功']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'修改信息失败']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'用户名不能为空']);
            }
        }else{
            $info=Member::findOne($this->mid);
            return $this->render('member',['info'=>$info]);
        }
    }

    public function actionLevel(){
        $info=Member::find()->alias('m')->where(['m.id'=>$this->mid])->joinWith('level')->asArray()->one();
        return $this->render('level',['info'=>$info]);
    }

    public function actionCollect(){
        if (\Yii::$app->request->isAjax) {
            $id=\Yii::$app->request->post('id');
            $row=Collect::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'收藏商品已删除']);
            }else{
                return Json::encode(['code'=>1,'body'=>'收藏商品删除失败']);
            }
        } else {
            $where['mid'] = $this->mid;
            $collect = Collect::find()->where($where);
            $pages = new Pagination([
                'pageSize' => 9,
                'totalCount' => $collect->count()
            ]);
            $list = $collect
                ->joinWith('goods')
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()->all();
            $num = $collect->count();
            return $this->render('collect', ['list' => $list, 'num' => $num, 'pages' => $pages]);
        }
    }

    public function actionFootprint(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=History::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'商品足迹已删除']);
            }else{
                return Json::encode(['code'=>1,'body'=>'删除失败']);
            }
        }else {
            $where['mid'] = $this->mid;
            $footprint = History::find()->where($where);
            $pages = new Pagination([
                'pageSize' => 9,
                'totalCount' => $footprint->count()
            ]);
            $list = $footprint
                ->joinWith('goods')
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()->all();
            $num = $footprint->count();
            return $this->render('footprint',['list' => $list, 'num' => $num, 'pages' => $pages]);
        }
    }

    public function actionAuction(){
        $where['a.mid']=$this->mid;
        $auction=Auction::find()->alias('a')->where($where);
        $pages1= new Pagination([
            'pageSize'=>9,
            'totalCount'=>$auction->count()
        ]);
        $list1=$auction->joinWith('auctionGoods ag')
            ->innerJoin('shop_goods g','g.id=ag.gid')
            ->select('a.*,g.goodsname,g.pic')
            ->offset($pages1->offset)
            ->limit($pages1->limit)
            ->asArray()->all();
        $success=AuctionSuccess::find()->alias('a')->where($where);
        $pages2= new Pagination([
            'pageSize'=>9,
            'totalCount'=>$auction->count()
        ]);
        $list2=$success->joinWith('auctionGoods ag')
            ->innerJoin('shop_goods g','g.id=ag.gid')
            ->innerJoin('shop_auction_deposit d','d.mid=a.mid and d.ag_id=a.ag_id')
            ->select('a.*,g.goodsname,g.pic,d.deposit')
            ->offset($pages2->offset)
            ->limit($pages2->limit)
            ->asArray()->all();
        return $this->render('auction',['pages1'=>$pages1,'list1'=>$list1,'pages2'=>$pages2,'list2'=>$list2]);
    }

    public function actionIntegral(){
        $mid=$this->mid;
        $where['mid']=$mid;
        $order=Order::find()->where($where);
        $pages1= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$order->count()
        ]);
        $list1=$order->offset($pages1->offset)->limit($pages1->limit)->asArray()->all();
        $info=Member::findOne($mid);
        $credit=Credit::find()->where($where);
        $pages2= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$credit->count()
        ]);
        $list2=$credit->joinWith('goods')->offset($pages2->offset)->limit($pages2->limit)->asArray()->all();
        $sum=$credit->sum('credit');
        return $this->render('integral',['pages1'=>$pages1,'list1'=>$list1,'info'=>$info,'pages2'=>$pages2,'list2'=>$list2,'sum'=>$sum]);
    }

    public function actionComment(){
        $mid=$this->mid;
        $where['mid']=$mid;
        $where['order_status']=4;
        $order1=Order::find()->where($where);
        $pages1= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$order1->count()
        ]);
        $list1=$order1->joinWith('orderGoods')
            ->offset($pages1->offset)
            ->limit($pages1->limit)
            ->asArray()->all();
        foreach($list1 as $k1=>$v1){
            foreach($v1['orderGoods'] as $k2=>$v2){
                $list1[$k1]['orderGoods'][$k2]['info']=Goods::find()->where(['id'=>$v2['gid']])->asArray()->one();
            }
        }
        $where['order_status']=5;
        $order2=Order::find()->where($where);
        $pages2= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$order2->count()
        ]);
        $list2=$order2->joinWith('orderGoods')
            ->offset($pages2->offset)
            ->limit($pages2->limit)
            ->asArray()->all();
        foreach($list2 as $k1=>$v1){
            foreach($v1['orderGoods'] as $k2=>$v2){
                $list2[$k1]['orderGoods'][$k2]['info']=Goods::find()->where(['id'=>$v2['gid']])->asArray()->one();
                $list2[$k1]['orderGoods'][$k2]['comment']=GoodsComment::find()->where(['gid'=>$v2['gid'],'mid'=>$mid])->asArray()->one();
            }
        }
        return $this->render('comment',['pages1'=>$pages1,'list1'=>$list1,'pages2'=>$pages2,'list2'=>$list2]);
    }

    public function actionDelComment(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=GoodsComment::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'评论删除成功']);
            }else{
                return Json::encode(['code'=>1,'body'=>'评论删除失败']);
            }
        }
    }

    public function actionCommentGoods(){
        if(\Yii::$app->request->isAjax){
            $comment= new GoodsComment();
            if($comment->load(\Yii::$app->request->post(),'') && $comment->validate()){
                $gid=\Yii::$app->request->post('gid');
                $mid=$this->mid;
                $info=GoodsComment::findOne(['gid'=>$gid,'mid'=>$mid]);
                if($info){
                    return Json::encode(['code'=>5,'body'=>'你已经评价过了']);
                }
                $comment->addtime=time();
                if($comment->save()){
                    $model= new UploadForm();
                    $model->file=UploadedFile::getInstance($model,'file');
                    if($model->file) {
                        if ($model->validate()) {
                            $model->file->saveAs('@web/uploads/member/' . $model->file->baseName . '.' . $model->file->extension);
                            $pic= new CommentPic();
                            $pic->mid=$mid;
                            $pic->gid=$gid;
                            $pic->addtime=time();
                            $pic->picname = $model->file->baseName . $model->file->extension;
                            if ($pic->save()) {
                                return Json::encode(['code' => 1, 'body' => '评价成功']);
                            } else {
                                return Json::encode(['code' => 5, 'body' => '评价失败']);
                            }
                        } else {
                            return Json::encode(['code' => 5, 'body' => $model->getErrors()]);
                        }
                    }else{
                        return Json::encode(['code' => 1, 'body' => '评价成功']);
                    }
                }else{
                    return Json::encode(['code'=>5,'body'=>'评价失败']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'必填项不能为空']);
            }
        }else{
            $gid=\Yii::$app->request->get('gid');
            $oid=\Yii::$app->request->get('oid');
            return $this->renderPartial('commentGoods',['gid'=>$gid,'oid'=>$oid]);
        }
    }

    public function actionDraw(){
        if(\Yii::$app->request->isAjax){
            $str=trim(\Yii::$app->request->post('str'));
            $where['addtime']=date('Y-m-d',time());
            $where['mid']=$this->mid;
            $info=Draw::findOne($where);
            if($info){
                return Json::encode(['code'=>5,'body'=>'亲,您今日已抽过奖,请明天再来吧!']);
            }
            $draw= new Draw();
            $draw->mid=$where['mid'];
            $draw->addtime=$where['addtime'];
            $draw->text=$str;
            if($draw->save()){
                $member=Member::findOne($this->mid);
                $num=substr($str,0,2);
                $member->credit=$member['credit']+$num;
                if($member->save()){
                    return Json::encode(['code'=>1,'body'=>$str]);
                }else{
                    return Json::encode(['code'=>5,'body'=>'抽奖失败,请稍后再试!']);
                }
            }else{
                return Json::encode(['code'=>5,'body'=>'抽奖失败,请稍后再试!']);
            }
        }else {
            return $this->render('draw');
        }
    }

    public function actionOrder(){
        $status=\Yii::$app->request->get('status');
        if($status){
            $where['order_status']=$status;
        }else{
            $where='';
        }
        $condition['mid']=$this->mid;
        $order=Order::find()->alias('o')->where($where)->andWhere($condition);
        $pages= new Pagination([
            'pageSize'=>10,
            'totalCount'=>$order->count()
        ]);
        $list=$order->joinWith('orderGoods og')
            ->joinWith('status s')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->asArray()->all();
        foreach($list as $k1=>$v1){
            foreach($v1['orderGoods'] as $k2=>$v2){
                $list[$k1]['orderGoods'][$k2]['goods']=Goods::findOne($v2['gid']);
            }
        }
        return $this->render('order',['pages'=>$pages,'list'=>$list]);
    }

    public function actionAddress(){
        $where['mid']=$this->mid;
        $list=Address::find()->where($where)->asArray()->all();
        return $this->render('address',['list'=>$list]);
    }

    public function actionFeedback(){
        if(\Yii::$app->request->isAjax){
            $mid=$this->mid;
            $content=trim(\Yii::$app->request->post('content'));
            if(!$content){
                return Json::encode(['code'=>5,'body'=>'反馈内容不能为空!']);
            }
            $where['mid']=$mid;
            $where['content']=$content;
            $info=Feedback::findOne($where);
            if($info){
                return Json::encode(['code'=>5,'body'=>'此信息你已经反馈过了,请耐心等待!']);
            }
            $feedback= new Feedback();
            $feedback->mid=$mid;
            $feedback->addtime=time();
            $feedback->content=$content;
            if($feedback->save()){
                return Json::encode(['code'=>1,'body'=>'反馈成功!']);
            }else{
                return Json::encode(['code'=>5,'body'=>'反馈失败!']);
            }
        }else {
            $where['mid']=$this->mid;
            $feedback=Feedback::find()->where($where);
            $pages= new Pagination([
                'pageSize'=>10,
                'totalCount'=>$feedback->count()
            ]);
            $list=$feedback->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            return $this->render('feedback',['pages'=>$pages,'list'=>$list]);
        }
    }

    public function actionDelFeedback(){
        if(\Yii::$app->request->isAjax){
            $id=\Yii::$app->request->post('id');
            $row=Feedback::findOne($id)->delete();
            if($row){
                return Json::encode(['code'=>1,'body'=>'删除成功!']);
            }else{
                return Json::encode(['code'=>2,'body'=>'删除失败!']);
            }
        }
    }

    public function actionMyCart(){
        $mid=$this->mid;
        $where['mid']=$mid;
        $list=Cart::find()->where($where)->joinWith('goods')->asArray()->all();
        $condition['display']=1;
        $recommend=Goods::find()->where($condition)->orderBy('salenum desc')->limit(10)->asArray()->all();
        return $this->render('myCart',['list'=>$list,'recommend'=>$recommend]);
    }

    public function actionAccount(){
        $mid=$this->mid;
        $info=Member::findOne($mid);
        return $this->render('account',['info'=>$info]);
    }







    /*public function uploadGoodsPic(){
        $upload=new \Think\Upload();
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/Admin/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'comments/'; // 设置附件上传（子）目录
        $upload->autoSub  =false;  //关闭自动使用子目录上传文件
        $info=$upload->upload();
        $data['mid']=session('mid');
        $data['gid']=session('lastgid');
        $data['picname']=$info['file']['savename'];
        $data['addtime']=time();
        $result = M('Comment_pic')->add($data);
        if($result){
            $this->ajaxReturn(array("status"=>1,"msg"=>"图片上传成功"));
        }else{$this->ajaxReturn(array("status"=>0,"msg"=>"图片上传失败"));}
    }*/
}























