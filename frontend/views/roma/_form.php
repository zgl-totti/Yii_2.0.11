<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goodsname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bid')->dropDownList($brand,['prompt'=>'请选择品牌']) ?>

    <?= $form->field($model, 'bid')->dropDownList(\yii\helpers\ArrayHelper::map($list,'id', 'bname'),['prompt'=>'请选择品牌']) ?>

    <?= $form->field($model, 'cid')->dropDownList($category,['prompt'=>'顶级分类','style'=>'width:420px']) ?>

    <?= $form->field($model, 'marketprice')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salenum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display')->textInput() ?>

    <?= $form->field($model, 'addtime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activity')->textInput() ?>

    <?= $form->field($model, 'introduction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parameter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delete')->textInput() ?>

    <?= $form->field($model, 'collectnum')->textInput() ?>

    <?= $form->field($model, 'clicknum')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
