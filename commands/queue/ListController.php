<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/15
 * Time: 16:53
 */

namespace app\commands\queue;


use app\commands\BaseController;
use common\services\TemplateService;

class ListController extends BaseController
{
    /**
     * php yii queue/list/run
     */
    public function actionRun()
    {
        $list = Order::find()->where('status', 0)->orderBy('id', 'desc')->limit(10)->all();
        if (empty($list)) {
            return $this->log('not data to handle');
        }

        foreach ($list as $item) {
            switch ($item['queue_name']) {
                case 'pay':
                    $this->handlePay($item);
                    break;
                case 'bind':
                    $this->handleBind($item);
                    break;
            }
        }

    }

    private function handlePay($item)
    {
        $data=@json_decode($item,true);
        if(!isset($data['user_id']) || !isset($data['order_id'])){
            return false;
        }

        if(empty($data['user_id']) || empty($data['order_id'])){
            return false;
        }

        TemplateService::notice($data['order_id']);
    }
}