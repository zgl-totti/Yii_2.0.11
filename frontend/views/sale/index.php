
<style type="text/css">
    .Preferential_list .Complete .cx{ background:url(<?=\yii\helpers\Url::to('@web/images/cx.png')?>) no-repeat; width:360px; height:338px; position:absolute; z-index:111; top:0px}
</style>
<?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
<?=\yii\helpers\Html::jsFile('@web/js/jquery.countdown.min.js')?>
<div class="limit_style" id="">
    <div id="slideBox" class="slideBox">
		<div class="hd">
			<ul class="smallUl"></ul>
		</div>
		<div class="bd">
            <ul>
                <?php foreach($advertise as $v): ?>
                    <li>
                        <a href="<?=\yii\helpers\Url::to(['index/advertise'])?>" target="_blank">
                            <div style="background:url(<?=\yii\helpers\Url::to('@web/uploads/ads/').\yii\helpers\Html::encode($v['adlogo']);?>) no-repeat rgb(255, 227, 130); background-position:center; width:100%; height:350px;"></div>
                        </a>
                    </li>
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
<div id="ProductMenu" class="sw_categorys_nav">
	<!--<div class="container">
		<div class="allcategorys">
			<h3 class="title-item-hd">团购商品分类</h3>
		</div>
		<ul class="Classified Limited_Category">
		 <li class=""><a href="#Area">白酒</a></li>
		 <li class="active"><a href="#Area1">红酒</a></li>
		 <li class=""> <a href="#">保健酒</a></li>
		 <li class=""><a href="#">洋酒</a></li>
		 <li> <a href="#">茶叶</a></li>
		 <li><a href="#">果酒</a></li>
		</ul>
	</div>-->
</div>
<div class="Inside_pages clearfix">
<!--限时团购-->
    <div class="limit_style Preferential_list">
        <div class="pic_sort clearfix" id="Area">
            <?php foreach($list as $k=>$v): ?>
            <?php if(\yii\helpers\Html::encode($v['goods']['num'])==0): ?>
                <ul class="list Complete">
                    <div class="wc_img"></div>
                    <li class="pic_time"><!--剩余时间 <b>06</b>小时 <b>34</b>分 <b>23</b>秒-->
                        <div id="clock<?=$k;?>"></div>
                        <input id="saled<?=$k;?>" type="hidden" value="<?=time();?>"/>
                        <input id="sale<?=$k;?>" type="hidden" value="<?=\yii\helpers\Html::encode($v['endtime'])?>"/>
                    </li>
                    <li class="pic_img">
                        <a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" width="300px" height="200px"></a>
                    </li>
                    <li class="pic_inner">
                        <div class="btn"><a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>" class="btn_gm"></a></div>
                        <div class="pic_Price left"><b>￥<?=\yii\helpers\Html::encode($v['goods']['price'])*0.8;?></b></div>
                        <div class="Number right">
                           <p class="Number_Price">￥<?=\yii\helpers\Html::encode($v['goods']['marketprice']);?></p>
                           <p class="pic_Number"><?=\yii\helpers\Html::encode($v['goods']['num']);?>件</p>
                        </div>
                    </li>
                </ul>
            <?php elseif(\yii\helpers\Html::encode($v['endtime'])<time()): ?>
                <ul class="list Complete">
                    <div class="cx"></div>
                    <li class="pic_time"><!--剩余时间 <b>06</b>小时 <b>34</b>分 <b>23</b>秒-->
                        <div id="clock<?=$k;?>"></div>
                        <input id="saled<?=$k;?>" type="hidden" value="<?=time();?>"/>
                        <input id="sale<?=$k;?>" type="hidden" value="<?=\yii\helpers\Html::encode($v['endtime'])?>"/>

                    </li>
                    <li class="pic_img">
                        <a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" width="300px" height="200px"></a>
                    </li>
                    <li class="pic_inner">
                        <div class="btn"><a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>" class="btn_gm"></a></div>
                        <div class="pic_Price left"><b>￥<?=\yii\helpers\Html::encode($v['goods']['price'])*0.8;?></b></div>
                        <div class="Number right">
                            <p class="Number_Price">￥<?=\yii\helpers\Html::encode($v['goods']['marketprice']);?></p>
                            <p class="pic_Number"><?=\yii\helpers\Html::encode($v['goods']['num']);?>件</p>
                        </div>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="list">
                    <li class="pic_time"><!--剩余时间 <b>06</b>小时 <b>34</b>分 <b>23</b>秒-->
                        <div id="clock<?=$k;?>"></div>
                        <input id="saled<?=$k;?>" type="hidden" value="<?=time();?>"/>
                        <input id="sale<?=$k;?>" type="hidden" value="<?=\yii\helpers\Html::encode($v['endtime'])?>"/>
                    </li>
                    <li class="pic_img">
                        <a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" width="300px" height="200px"></a>
                    </li>
                    <li class="pic_inner">
                        <div class="btn"><a href="<?=\yii\helpers\Url::to(['sale/buy','gid'=>\yii\helpers\Html::encode($v['gid'])])?>" class="btn_gm"></a></div>
                        <div class="pic_Price left"><b>￥<?=\yii\helpers\Html::encode($v['goods']['price'])*0.8;?></b></div>
                        <div class="Number right">
                            <p class="Number_Price">￥<?=\yii\helpers\Html::encode($v['goods']['marketprice']);?></p>
                            <p class="pic_Number"><?=\yii\helpers\Html::encode($v['goods']['num']);?>件</p>
                        </div>
                    </li>
                </ul>
            <?php endif;?>
            <?php endforeach;?>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>
<!--更改-->
<script type="text/javascript">
    $(function(){
        for(var i=1;i<16;i++){
            var t1=$('#saled'+i).val();
            var t2=$('#sale'+i).val();
            var t=parseInt(t2-t1)*1000;
            var twoDaysFromNow = new Date().valueOf() +t;
            $('#clock'+i).countdown(twoDaysFromNow, function(event) {

                if(t<0){
                    $(this).html('本次抢购已结束,敬请期待下次活动');
                }else{
                    $(this).html(event.strftime( '%D 天 %H 小时 %M 分钟 %S 秒'));
                }
            });
        }

    })
</script>

