<?php
namespace frontend\controllers;


use backend\models\Activity;
use backend\models\Advertise;
use backend\models\Filter;
use backend\models\Vote;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\Json;

class VoteController extends BaseController{
    public $enableCsrfValidation=false;  //关闭防御csrf的攻击机制;

    public function actionIndex(){
        $where1=['!=','starttime',0];
        $where2=['>','endtime',time()];
        $condition=['and',$where1,$where2];
        $factor['addvote']=1;
        $activity=Activity::find()->where($condition)->andWhere($factor);
        $pages= new Pagination([
            'pageSize'=>9,
            'totalCount'=>$activity->count()
        ]);
        $list=$activity->joinWith('goods')
            ->orderBy('votecount desc')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        $arr=['and',['adposition'=>5],['!=','top',0]];
        $advertise=Advertise::find()->where($arr)->orderBy('top desc')->asArray()->all();
        return $this->render('index',[
            'pages'=>$pages,
            'list'=>$list,
            'advertise'=>$advertise
        ]);
    }

    public function actionAddVote(){
        if(\Yii::$app->request->isAjax) {
            $id = \Yii::$app->request->get('id');
            $ip = \Yii::$app->request->getUserIP();
            $filter = Filter::findOne(['ip' => $ip]);
            if ($filter) {
                return Json::encode(['code' => 3, 'body' => '对不起，你恶意投票，已被拉入黑名单']);
            }
            $activity = Activity::findOne($id);
            $where['aid'] = $id;
            $where['ip'] = $ip;
            $info = Vote::findOne($where);
            if ($info) {
                if ($info['votenum'] >= 3) {
                    return Json::encode(['code' => 4, 'body' => '对不起，该商品的投票次数你已经用完']);
                }
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $activity->votecount += 1;
                    $info->votenum += 1;
                    $num = 3 - $info->votenum;
                    $row1 = $activity->save();
                    $row2 = $info->save();
                    if (!$row1 || !$row2) {
                        throw new Exception('投票失败！');
                    }
                    $transaction->commit();
                    return Json::encode(['code' => 1, 'body' => '投票成功,该商品你还有' . $num . '次投票机会']);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    return Json::encode(['code' => 2, 'body' => $e->getMessage()]);
                }
            } else {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $activity->votecount += 1;
                    $vote = new Vote();
                    $vote->aid = $id;
                    $vote->ip = $ip;
                    $vote->votenum = 1;
                    $row1 = $activity->save();
                    $row2 = $vote->save();
                    if (!$row1 || !$row2) {
                        throw new Exception('投票失败！');
                    }
                    $transaction->commit();
                    return Json::encode(['code' => 1, 'body' => '投票成功,该商品你还有2次投票机会']);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    return Json::encode(['code' => 2, 'body' => $e->getMessage()]);
                }
            }
        }
    }
}