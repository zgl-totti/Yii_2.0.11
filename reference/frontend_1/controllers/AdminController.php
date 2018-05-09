<?php
namespace frontend\controllers;


use Codeception\Module\Yii2;
use frontend\models\Category;
use yii\caching\Cache;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\User;

class AdminController extends Controller{
    public function actionIndex(){
        $username='totti';
        $club='Roma';
        $time=time();
        $rule='King';
        return $this->render('index',['username'=>$username,'club'=>$club,'time'=>$time,'rule'=>$rule]);
    }

    public function actionAdd(){
        $data['username']='totti';
        $data['club']='Roma';
        $data['time']=time();
        $data['rule']='King';
        return $this->renderPartial('add',['data'=>$data]);
    }

    public function actionTiaozhuan(){
        $id=\Yii::$app->request->get('id');
        $gid=\Yii::$app->request->get('gid');
        echo $id;
        echo $gid;
    }


    public function actionEdit(){
        $list1=\Yii::$app->db->createCommand("select * from beauty_admin where id=1")->queryOne();
        $list2=\Yii::$app->db->createCommand("select * from beauty_admin where id=1")->queryOne();
        print_r($list1);
        echo '<br>';
        print_r($list2);
    }

    public function actionList(){
        $where['status']=1;
        //$list=(new Query())->select('*')->from('beauty_admin')->where($where)->limit(1)->all();
        //$list=(new Query())->select('*')->from('beauty_admin')->where($where)->one();
        //$list=(new Query())->select('id,username')->from('beauty_admin')->where($where)->limit(1)->all();
        //$list=(new Query())->select(['id as aid','username'])->from('beauty_admin')->where($where)->limit(1)->all();
        /*$list=(new Query())->select('*')->from('beauty_admin')->where($where)->limit(10)->orderBy('id desc')->all();
        print_r($list);*/


        /*//批处理查询
        $list=(new Query())->select('*')->from('beauty_admin')->where($where);
        foreach($list->batch() as $val){
            print_r($val);
        }
        foreach($list->each() as $v){
            print_r($v);
        }*/
    }

    //判断请求类型
    public function actionStatus(){
        if(\Yii::$app->request->isAjax){
            echo 'haha';
        }elseif(\Yii::$app->request->isGet){
            echo 'doubi';
        }else{
            echo '123';
        }
    }

    //缓存
    public function actionOperate(){
        $aid=\Yii::$app->cache->get('aid');
        if($aid){
            echo $aid;
        }else{
            \Yii::$app->cache->set('aid',123);
            echo '缓存数据不存在！';
        }
    }

    public function actionDelcache(){
        $aid=\Yii::$app->cache->get('aid');
        if($aid){
            \Yii::$app->cache->delete('aid');
            echo '缓存已删除！';
        }
    }

    //session
    public function actionSession(){
        $aid=\Yii::$app->session->get('aid');
        if($aid){
            echo 'session已存在,值是：'.$aid;
        }else{
            \Yii::$app->session->set('aid','session已设置');
            echo 'session不存在！';
        }
    }

    public function actionDelsession(){
        $aid=\Yii::$app->session->get('aid');
        if($aid){
            \Yii::$app->session->remove('aid');
            echo 'session已删除';
        }
    }

    //cookie
    public function actionCookie(){
        $aid=\Yii::$app->request->cookies->getValue('aid');
        if($aid){
            echo 'cookie已存在,值是：'.$aid;
        }else{
            $cookie= new Cookie([
                'name'=>'aid',
                'expire'=>time()+3600,
                'httpOnly'=>'true',
                'value'=>'cookie已设置'
            ]);
            \Yii::$app->response->getCookies()->add($cookie);
            echo 'cookie不存在！';
        }
    }

    public function actionDelcookie(){
        $aid=\Yii::$app->request->cookies->get('aid');
        if($aid){
            \Yii::$app->response->getCookies()->remove('aid');
            echo 'cookie已删除';
        }
    }

    public function actionAdvertise(){
        $sql="select * from beauty_admin";
        $list=\Yii::$app->db->createCommand($sql)->queryAll();
        print_r($list);
    }

    public function actionRoma(){
        $where['id']=1;
        //$info=\app\models\Admin::find()->where($where)->one();
        //print_r($info);
        return $this->redirect('totti');
    }

    public function actionTotti(){
        print_r(\Yii::$app->request->referrer);
    }
}