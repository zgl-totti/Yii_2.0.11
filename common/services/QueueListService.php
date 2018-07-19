<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/14
 * Time: 14:59
 */

namespace app\common\services;


class QueueListService
{
    public static function addQueue($queue_name,$data=[])
    {
        $model=new QueueList();
        $model->queue_name=$queue_name;
        $model->data=json_encode($data);
        $model->status=1;
        $model->created_time=time();

        return $model->save();
    }
}