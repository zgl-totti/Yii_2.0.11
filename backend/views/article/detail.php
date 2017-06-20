<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>详情页</title>
</head>
<body>
<div>
    <p>文档标题：<?=\yii\helpers\Html::encode($info['title'])?></p>
    <p>文档作者：<?=\yii\helpers\Html::encode($info['author'])?></p>
    <p>文档类别：<?=\yii\helpers\Html::encode($info['cate'])?></p>
    <p>文档内容：<?=\yii\helpers\Html::encode($info['content'])?></p>
</div>
</body>
</html>