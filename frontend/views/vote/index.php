

<style>
    .pic_inner div#sortBox{  width:100%;  height:50px;}
    #sortBox div{float: left;height:30px;margin-top:10px;}
    #sortBox div span{height:30px;font-size:16px;color:white;}
    #sortBox div a#voteBtn{margin-left:15px;font-size:16px;width:50px;display: inline-block;color:#FF7200;background-color:white;text-align:center;line-height:30px; cursor: pointer;}
    #sortBox div a#voteBtn:hover{background-color:#000000;color:#ffffff;}
    input{text-align:center}
</style>
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
                <!--<li><a href="#" target="_blank"><div style="background:url(__PUBLIC__/Home/images/AD/ad-9.jpg) no-repeat rgb(255, 227, 130); background-position:center; width:100%; height:350px;"></div></a></li>
                <li><a href="#" target="_blank"><div style="background:url(__PUBLIC__/Home/images/AD/ad-9.jpg) no-repeat rgb(255, 227, 130); background-position:center ; width:100%; height:350px;"></div></a></li>
                <li><a href="#" target="_blank"><div style="background:url(__PUBLIC__/Home/images/AD/ad-9.jpg) no-repeat rgb(226, 155, 197); background-position:center; width:100%; height:350px;"></div></a></li>-->
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
    <div class="container">
        <div style="padding-left:30px;width:1000px;line-height:50px;font-size:30px;">欢迎参与投票统计 <span style="font-size:16px;">(前十名商品将参与特价活动，感谢你的到来)</span></div>
    </div>
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
                            <a href="Limit_buy_Detailed.html"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" width="300px" height="200px"></a>
                        </li>
                        <li class="pic_inner">
                            <div class="btn"><a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>$v['gid']])?>" class="btn_gm"></a></div>
                            <div class="pic_Price left"><b>￥<?=\yii\helpers\Html::encode($v['goods']['price'])?></b></div>
                            <div class="Number right">
                                <p class="Number_Price">￥<?=\yii\helpers\Html::encode($v['goods']['marketprice'])?></p>
                                <p class="pic_Number"><?=\yii\helpers\Html::encode($v['goods']['num'])?>件</p>
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
                            <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['gid'])])?>"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" width="300px" height="200px"></a>
                        </li>
                        <li class="pic_inner">
                            <div id="sortBox">
                                <div><span class="sp">当前排名<input readonly size="5" value="<?=$k+1;?>" name="sort"></span></div>
                                <div><span class="sp">投票数量<input readonly size="5" value="<?=\yii\helpers\Html::encode($v['votecount'])?>" name="sort"></span></div>
                                <div><a href="javascript:vote(<?=$v['id']?>)" id="voteBtn">投票</a></div>
                            </div>
                        </li>
                    </ul>
                <?php endif;?>
            <?php endforeach;?>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>
<script>
    //投票
    function vote(id){
        $.post("<?=\yii\helpers\Url::to(['vote/add-vote'])?>",{id:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:2000},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['vote/index'])?>";
                })
            }else{
                layer.msg(res.body,{icon:2,time:2000});
            }
        },'json')
    }
</script>
<!--更改-->
<script type="text/javascript">
    $(function(){
        for(var i=1;i<6;i++){
            var t1=$('#saled'+i).val();
            var t2=$('#sale'+i).val();
            var t=parseInt(t2-t1)*1000;
            var twoDaysFromNow = new Date().valueOf() +t;
            $('#clock'+i).countdown(twoDaysFromNow, function(event) {
                $(this).html(event.strftime( '%D 天 %H 小时 %M 分钟 %S 秒'));
            });
        }
    })
</script>

