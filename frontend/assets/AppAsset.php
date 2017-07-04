<?php

namespace frontend\assets;

use backend\models\Member;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/common.css',
        'fonts/iconfont.css',
        'css/orders.css',
        'css/show.css',
        'css/purebox-metro.css',
        'css/addtocart.css',
        'css/ordersuccess.css',
        'css/showcart.css',
        'css/reset1.css'
    ];
    public $js = [
        'js/jquery-1.9.1.min.js',
        'js/jquery.SuperSlide.2.1.1.js',
        'js/common_js.js',
        'js/abc.js',
        'js/footer.js',
        'js/ZoomPic.js',
        'js/jquery.lazyload.js',
        'js/layer/layer.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
