<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=Html::a('世界杯', '#', [
            'id' => 'create',
            'data-toggle' => 'modal',
            'data-target' => '#create-modal',
            'class' => 'btn btn-success',
        ]);?>
        <?=Html::a('欧洲杯', '#', [
            'id' => 'update',
            'data-toggle' => 'modal',
            'data-target' => '#update-modal',
            'class' => 'btn btn-success',
        ]);?>
    </p>



    <?php
    Modal::begin([
        'id' => 'create-modal',
        'header' => '<h4 class="modal-title">创建</h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
    ]);
    $requestUrl = \yii\helpers\Url::toRoute('test1');
    $js = <<<JS
    $.get('{$requestUrl}', {},
        function (data) {
            $('.modal-body').html(data);
        }  
    );

JS;
    $this->registerJs($js);
    Modal::end();

    Modal::begin([
        'id' => 'update-modal',
        'header' => '<h4 class="modal-title">更新</h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
    ]);
    $requestUrl = \yii\helpers\Url::toRoute('test2');
    $js = <<<JS
$('#europe').click(function() {
    alert('欧洲杯');
    $('.document-nav-form').remove();
    $.get('{$requestUrl}', {},
        function (data) {
            $('.modal-body').html(data);
        }  
    );
})
JS;
    $this->registerJs($js);
    Modal::end();
    ?>



    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goodsname',
            [
                'attribute' => 'bid',
                'value' => function ($data) {
                    return $data->brand->bname;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'cid',
                'value' => function ($data) {
                    return $data->cate->catename;
                },
                'format' => 'html',
            ],
            'price',
            'salenum',
            [
                'attribute' => 'activity',
                'value' => function ($data) {
                    return $data->activity==1?'有活动':'无活动';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'display',
                'value' => function ($data) {
                    return $data->display==1?'上架':'下架';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'addtime',
                'value' => function ($data) {
                    return '<span class="nowrap">' . Yii::$app->formatter->asDatetime($data['addtime'], 'yyyy-MM-dd HH:mm:ss') . '</span>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => '操作',
                'value' => function ($data) {
                    return Html::a($data->display==0?'上架':'下架',['operate'],['class' => 'btn btn-success']);
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


