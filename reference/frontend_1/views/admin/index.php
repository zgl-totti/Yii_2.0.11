<?php
    use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>123</title>
</head>
<body>
    <p>哈哈</p>
    <p>我是<?=Html::encode($club)?>的<?=Html::encode($username)?></p>
    <p><?=Html::encode($time)?></p>
    <p><?=date('Y-m-d H:i:s',Html::encode($time));?></p>
    <p><?=$rule?></p>
    <p><a href="<?=\yii\helpers\Url::to('add')?>">链接</a></p>
    <p><a href="<?=\yii\helpers\Url::to(['tiaozhuan','id'=>100,'gid'=>10])?>">跳转</a></p>


</body>
