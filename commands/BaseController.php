<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/14
 * Time: 10:31
 */

namespace app\commands;

use yii\console\Controller;

class BaseController extends Controller
{
    public function log($msg){
        echo date('Y-m-d H:i:s').':'.$msg."\r\n;";
        return true;
    }

}