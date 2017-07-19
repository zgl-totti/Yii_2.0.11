<?php
namespace frontend\controllers;

use backend\models\Advertise;
use backend\models\Goods;
use frontend\models\History;
use yii\data\Pagination;

class IntegralController extends BaseController{
    public function actionIndex(){
        $where['display']=0;
        $condition['adposition']=6;
        $advertise=Advertise::find()->where($condition)->asArray()->all();
        $goods=Goods::find()->where($where);
        $pages= new Pagination([
            'pageSize'=>9,
            'totalCount'=>$goods->count()
        ]);
        $list=$goods->offset($pages->offset)->limit($pages->limit)->orderBy('addtime desc')->asArray()->all();
        foreach($list as $k=>$v){
            $list[$k]['price']=$v['price']*10;
        }
        return $this->render('index',['advertise'=>$advertise,'list'=>$list,'pages'=>$pages]);
    }

    public function actionDetail(){
        $id=\Yii::$app->request->get('id');
        $where['g.id']=$id;
        $info=Goods::find()->alias('g')->where($where)->joinWith('pics')->asArray()->one();
        $info['price']=$info['price']*10;
        $history= new History();
        $recommend=$history->recommend($id);
        return $this->render('detail',['info'=>$info,'recommend'=>$recommend]);
    }















    /*public function ads(){
        $pathInfo = M('Category')->where("id=1")->field('path')->select();
        $path=$pathInfo[0]['path'];
        $map['path']=(array('like',"{$path}%"));
        $cateArr =  M('Category')->where($map)->field('id')->select();
        $catestr='';
        foreach ($cateArr as $k=>$v){
            $catestr.=$v['id'].',';
        }
        $catestr=substr($catestr,0,-1);
        $goods = M('Goods');
        $where1['cid']=(array('in',"{$catestr}"));
        $one = $goods->where($where1)->limit(6)->select();
        $this->assign('one',$one);
        $this->display();
    }
    //显示留言
    public function shower(){
        $gid=I("post.gid/d");
        if($gid){
            $comment=M('goods_comment');
            $com=$comment
                ->join('shop_member ON shop_goods_comment.mid=shop_member.id')
                ->where('shop_goods_comment.isshow=1')
                ->where("gid={$gid}")
                ->field('commentcontent,username,replycontent,shop_goods_comment.addtime,isreply')
                ->select();
            $this->ajaxReturn($com);
        }else{
            $this->ajaxReturn('失败');
        }
    }
    //收藏
    public function collect(){
        $collect=D('Collect');
        if(session('mid') && session('mid')>0){
            $col['mid']=session('mid');
            $col['gid']=I('post.id');
            $info=$collect->where($col)->select();
            if($info){
                $collect->where($col)->delete();
                $this->ajaxReturn(array('status'=>1,'msg'=>'取消收藏成功'));
            }else{
                $col['addtime']=time();
                $info2=$collect->add($col);
                if($info2){
                    $this->ajaxReturn(array('status'=>2,'msg'=>'收藏成功'));
                }else{
                    $this->ajaxReturn(array('status'=>3,'msg'=>'收藏失败'));
                }
            }
        }else{
            $this->ajaxReturn(array('status'=>4));
        }
    }*/
}