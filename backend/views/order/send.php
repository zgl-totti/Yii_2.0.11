<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>

    <style type="text/css">
        tr{height: 30px;}
        td.radio1{color: #000;font-weight: bolder;font-family:"微软雅黑"}
        label{height: 30px;width: 100px; text-align:right;line-height:30px;display: block;background-color: #CCC;color:#000;
              border-radius:10px;}
        input.text1{height: 30px; width:240px; margin-top:10px;}
        #sub{ width: 100px;height: 40px;margin-top: 10px;text-align: center;line-height: 40px;border-radius: 10px;
            font-size: 20px;color: #000000;font-weight: bolder;cursor: pointer;}
    </style>
</head>
<body>
<form action="#" method="post" id="form1">
    <input name="id" type="hidden" value="<?=\yii\helpers\Html::encode($info['id'])?>">
    <table>
        <tr>
            <td><label>订单号:</label></td>
            <td><input class="text1" type="text" value="<?=\yii\helpers\Html::encode($info['order_syn'])?>" name="order_syn"/></td>
        </tr>
        <tr>
            <td><label>收货人:</label></td>
            <td><input class="text1" type="text" value="<?=\yii\helpers\Html::encode($info['address']['name'])?>" name="username"/></td>
        </tr>
        <tr>
            <td><label>联系方式:</label></td>
            <td><input class="text1" type="text" value="<?=\yii\helpers\Html::encode($info['address']['mobile'])?>" name="mobile"/></td>
        </tr>
        <tr>
            <td><label>收货地址:</label></td>
            <td><input class="text1" type="text" value="<?=\yii\helpers\Html::encode($info['address']['address'])?>" name="address"/></td>
        </tr>
        <tr>
            <td><label>选择快递:</label></td>
            <td class="radio1">
                <input type="radio" value="1" name="delivery" <?=\yii\helpers\Html::encode($info['delivery'])==1?'checked':'';?>/>圆通快递
                <input type="radio" value="2" name="delivery" <?=\yii\helpers\Html::encode($info['delivery'])==2?'checked':'';?>/>中通快递
                <input type="radio" value="3" name="delivery" <?=\yii\helpers\Html::encode($info['delivery'])==3?'checked':'';?>/>顺丰快递
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="sub" type="button" value="确认发货">
            </td>
        </tr>
    </table>
</form>
</body>
<script>
    $(function(){
        $("#sub").click(function(){
            $.post("<?=\yii\helpers\Url::to(['order/send'])?>",$("#form1").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        location="<?=\yii\helpers\Url::to(['order/index'])?>";
                    });
                }else{
                    layer.msg(res.body,{icon:2,time:1000})
                }
            },'json')
        })
    })
</script>
</html>