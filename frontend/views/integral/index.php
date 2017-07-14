
<div class="limit_style" id="">
    <div id="slideBox" class="slideBox">
        <div class="hd">
            <ul class="smallUl"></ul>
        </div>
        <!--广告段位-->
        <div class="bd">
            <ul>
                <?php foreach($advertise as $v): ?>
                <li><a href="<?=\yii\helpers\Url::to(['index/advertise'])?>" target="_blank">
                    <div style="background:url(<?=\yii\helpers\Url::to('@web/uploads/ads/').\yii\helpers\Html::encode($v['adlogo']);?>) no-repeat rgb(255, 227, 130); background-position:center; width:100%; height:400px;">
                    </div></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
        <a class="prev" href="javascript:void(0)"></a>
        <a class="next" href="javascript:void(0)"></a>

    </div>
    <script type="text/javascript">
        jQuery("#slideBox").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true});
    </script>
</div>

<div class="Inside_pages clearfix">
    <!--限时团购-->
    <div class="limit_style Preferential_list">
        <div class="pic_sort clearfix" id="Area">
            <?php foreach($list as $v): ?>
            <ul class="list">
                <li class="pic_time">积分兑换</li>
                <li class="pic_img">
                    <a href="<?=\yii\helpers\Url::to(['integral/detail','id'=>$v['id']])?>"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').\yii\helpers\Html::encode($v['pic']);?>" style="width: 250px;height:200px;"></a>
                </li>
                <li class="pic_inner">
                    <div class="btn"><a href="<?=\yii\helpers\Url::to(['integral/detail','id'=>$v['id']])?>"><img src="<?=\yii\helpers\Url::to('@web/images/jf.png')?>"></a></div>
                    <div class="pic_Price left"><b style="font-size: 20px;">&nbsp;&nbsp;<?=floor(\yii\helpers\Html::encode($v['price']))?>积分 <img src="<?=\yii\helpers\Url::to('@web/images/moneychange.png')?>" style="margin: 7px 0 0 10px;"></b></div>
                    <div class="Number right">
                        <p class="Number_Price">￥<?=\yii\helpers\Html::encode($v['marketprice'])?></p>
                        <p class="pic_Number"><?=\yii\helpers\Html::encode($v['num'])?>件</p>
                    </div>
                </li>
            </ul>
            <?php endforeach;?>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>

