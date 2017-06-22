<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/select.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.idTabs.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/select-ui.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>

    <script type="text/javascript">
        $(document).ready(function(e) {
            $(".select1").uedSelect({
                width : 345
            });
            $(".select2").uedSelect({
                width : 167
            });
            $(".select3").uedSelect({
                width : 100
            });
        });
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson" style="float: left;">
            <ul class="forminfo">
                <li><label>订单编号<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['order_syn'])?>
                </li>
                <li><label>用户名<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['member']['username'])?>
                </li>
                <li><label>原价<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['order_price'])?>
                </li>
                <li><label>折扣价<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['order_price'])-10;?>
                </li>
                <li><label>收货人<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['address']['name'])?>
                </li>
                <li><label>联系方式<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['address']['mobile'])?>
                </li>
                <li><label>发货地址<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['address']['address'])?>
                </li>
                <li><label>创建时间<b>*</b></label>
                    <br/><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']));?>
                </li>
                <li><label>订单状态<b>*</b></label>
                    <br/><?=\yii\helpers\Html::encode($info['status']['status_name'])?>
                </li>
                <li><label>&nbsp;</label><input type="button" class="btn" value="返回"/></li>
            </ul>
        </div>

        <div style="float:left;margin-top: 30px;margin-left: 200px;">
            <table class="tablelist" style="width:600px;">
                <thead>
                <tr>
                    <th>商品名</th>
                    <th>图片</th>
                    <th>购买数量</th>
                    <th>单价</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($info['orderGoods']['goods'] as $k=>$v): ?>
                    <tr>
                        <td><?=mb_substr(\yii\helpers\Html::encode($v['goodsname']),0,10,'utf-8');?></td>
                        <td><img width="200" height="140" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic']);?>"/></td>
                        <td><?=\yii\helpers\Html::encode($info['orderGoods']['buynum'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['price'])?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
<script>
    $(function(){
        $(".btn").click(function(){
            window.location.href="<?=\yii\helpers\Url::to(['order/index'])?>";
        })
    })
</script>
</html>
