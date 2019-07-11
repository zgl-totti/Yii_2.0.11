<?php
namespace frontend\controllers;


use backend\models\Member;
use yii\helpers\Json;

class AccountController extends  PersonalController
{
    public function actionChangePwd()
    {
        if (\Yii::$app->request->isAjax) {
            $mid = $this->mid;
            $password = trim(\Yii::$app->request->post('password'));
            $newPwd = trim(\Yii::$app->request->post('newPwd'));
            $reNewPwd = trim(\Yii::$app->request->post('reNewPwd'));
            if ($newPwd != $reNewPwd) {
                return Json::encode(['code' => 5, 'body' => '两次密码输入不一致']);
            }
            $where['id'] = $mid;
            $where['password'] = md5($password);
            $info = Member::findOne($where);
            if (!$info) {
                return Json::encode(['code' => 5, 'body' => '原密码输入错误']);
            }
            $info->password = md5($newPwd);
            if ($info->save()) {
                return Json::encode(['code' => 1, 'body' => '密码修改成功']);
            } else {
                return Json::encode(['code' => 2, 'body' => '密码修改失败']);
            }
        }
    }

    public function actionPayPwd()
    {
        if (\Yii::$app->request->isAjax) {
            $mid = $this->mid;
            $paypwd = trim(\Yii::$app->request->post('paypwd'));
            $newpaypwd = trim(\Yii::$app->request->post('newpaypwd'));
            $renewpaypwd = trim(\Yii::$app->request->post('renewpaypwd'));
            if ($newpaypwd != $renewpaypwd) {
                return Json::encode(['code' => 5, 'body' => '两次密码输入不一致']);
            }
            $where['id'] = $mid;
            $where['password'] = $paypwd;
            $info = Member::findOne($where);
            if (!$info) {
                return Json::encode(['code' => 5, 'body' => '原密码输入错误']);
            }
            $info->password = $newpaypwd;
            if ($info->save()) {
                return Json::encode(['code' => 1, 'body' => '密码修改成功']);
            } else {
                return Json::encode(['code' => 2, 'body' => '密码修改失败']);
            }
        }
    }

    public function actionRecharge()
    {
        if (\Yii::$app->request->isAjax) {
            $mid = $this->mid;
            $pay = \Yii::$app->request->post('pay');
            if (!$pay) {
                return Json::encode(['code' => 5, 'body' => '充值方式不能为空']);
            }
            $money = \Yii::$app->request->post('money');
            if (!$money) {
                return Json::encode(['code' => 5, 'body' => '充值金额不能为空']);
            }
            if (is_int($money) && $money > 0) {
                if ($money > 10000) {
                    return Json::encode(['code' => 5, 'body' => '最大充值金额是10000元']);
                }
                $info = Member::findOne($mid);
                $info->money = $info['money'] + $money;
                if ($info->save()) {
                    return Json::encode(['code' => 1, 'body' => '充值成功']);
                } else {
                    return Json::encode(['code' => 5, 'body' => '充值失败']);
                }
            } else {
                return Json::encode(['code' => 5, 'body' => '充值金额只能是整数']);
            }
        }
    }
}