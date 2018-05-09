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
    <p>我是<?=Html::encode($data['club'])?>的<?=Html::encode($data['username'])?></p>
    <p><?=Html::encode($data['time'])?></p>
    <p><?=$data['rule']?></p>
</body>
</html>