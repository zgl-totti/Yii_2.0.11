<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>会员详情</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>

    <style type="text/css">
        td{
            border-bottom: 1px solid #ccc;
        }
        .t1{
            width: 250px;
        }
        .te{
            font-size: 26px;
            text-decoration: double;
            color: orangered;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
    </ul>
</div>
<div class="te">用户详情</div>
<table style="margin:0 auto; ;width:400px;height: 500px;letter-spacing: 0px">
    <tr>
        <td class="t1">姓名:</td><td><?=\yii\helpers\Html::encode($info['username'])?></td>
    </tr>
    <tr>
        <td class="t1">性别:</td>
        <?php if(\yii\helpers\Html::encode($info['gender'])==0): ?>
            <td>男</td>
        <?php elseif(\yii\helpers\Html::encode($info['gender'])==1): ?>
            <td>女</td>
        <?php else: ?>
            <td>保密</td>
        <?php endif;?>
    </tr>
    <tr>
        <td class="t1" >等级:</td><td style="color: red"><?=\yii\helpers\Html::encode($info['level_name'])?></td>
    </tr>
    <tr>
        <td class="t1">金钱:</td><td><?=\yii\helpers\Html::encode($info['money'])?></td>
    </tr>
    <tr>
        <td class="t1">总花费:</td><td><?=\yii\helpers\Html::encode($info['costs'])?></td>
    </tr>
    <tr>
        <td class="t1">积分:</td><td><?=\yii\helpers\Html::encode($info['credit'])?></td>
    </tr>
    <tr>
        <td class="t1">QQ:</td><td><?=\yii\helpers\Html::encode($info['qq'])?></td>
    </tr>
    <tr>
        <td class="t1">手机号:</td><td><?=\yii\helpers\Html::encode($info['mobile'])?></td>
    </tr>
    <tr>
        <td class="t1">邮箱地址:</td><td><?=\yii\helpers\Html::encode($info['email'])?></td>
    </tr>
    <tr>
        <td class="t1">用户状态:</td>
        <td><?=(\yii\helpers\Html::encode($info['active'])==1)?'已启用':'已禁用';?></td>
    </tr>
    <tr>
        <td class="t1">注册时间:</td><td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']))?></td>
    </tr>

</table>
</body>
</html>