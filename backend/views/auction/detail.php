<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        #auctionA{text-decoration:none;width:80%;height:35px;margin:0 auto;background-color:red;display:block;text-align:center;font-size:20px;color:#ffffff;border-radius:5px;cursor:pointer}
        #auctionA:hover{background-color:#FF3333;}
    </style>
</head>
<body>
    <div style="width:720px;height:480px;">
        <div style="float:left;width:54%;height:100%;">
            <div>
                <span style="color:red;font-size:24px;height:30px;">商品名称:</span>
                <span style="color:black;font-size:18px;height:30px;"><?=mb_substr(\yii\helpers\Html::encode($info['goodsname']),0,15,'utf-8')?></span>
            </div>
            <img width="100%" height="90%" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($info['pic'])?>">
        </div>
        <div style="float:right;width:44%;height:100%;border:1px solid gray;">
            <div style="height:35px;line-height:35px;width:100%;margin-top:20px;">
                <span style="padding-left:10px;">幸运会员:</span>
                <span style="padding-left:10px;color:red"><?=\yii\helpers\Html::encode($info['member']['username'])?></span>
            </div>
            <div style="height:35px;line-height:35px;width:100%;margin-top:20px;">
                <span style="padding-left:10px;">竞拍价格:</span>
                <span style="padding-left:10px;"><font color="red" size="5">￥<?=\yii\helpers\Html::encode($info['price'])?> RMB</font></span>
            </div>
            <div style="height:35px;line-height:35px;width:100%;margin-top:20px;">
                <span style="padding-left:10px;">竞拍时间:</span>
                <span style="padding-left:10px;"><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']))?></span>
            </div>
            <div style="height:35px;line-height:35px;width:100%;margin-top:20px;">
                <span style="padding-left:10px;">竞拍定金:</span>
                <span style="padding-left:10px;"><font color="red" size="4">￥<?=\yii\helpers\Html::encode($info['deposit'])?> RMB</font></span>
            </div>
            <div style="height:35px;line-height:35px;width:100%;margin-top:20px;">
                <span style="padding-left:10px;">支付余额:</span>
                <span style="padding-left:10px;"><font color="red" size="4">￥<?=\yii\helpers\Html::encode($info['price'])-\yii\helpers\Html::encode($info['deposit']);?> RMB</font></span>
            </div>
            <div style="height:35px;line-height:35px;width:100%;margin-top:30px;">
                <!--<a id="auctionA" href="javascript:auctionURL()">返回</a>-->
                <a id="auctionA" href="<?=\yii\helpers\Url::to(['auction/bargain'])?>">返回</a>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function auctionURL(){
        parent.layer.closeAll();
    }
</script>