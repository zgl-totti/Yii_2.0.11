<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goodsname',
            [
                'attribute' => 'bname',
                'value' => function ($data) {
                    return $data->brand->bname;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'catename',
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
