
<style>
    .pic_inner #div1{width:100%;height:48px;;text-align:center;line-height:48px;font-size:16px;color:#ffffff}
    .pic_inner #div2{width:100%;height:50px;line-height:50px;}
    .pic_inner #div2 span{float:left;width:200px;height:48px;font-size:16px;padding-left:10px;display: inline-block;color:#ffffff}
    .pic_inner #div2 #auction{border-radius:10px;float:left;width:100px;height:30px;text-align:center;
        margin-left:30px;;background-color:white;line-height:30px;margin-top:10px;display: inline-block;
        font-size:16px;color:#FF7200}
    .pic_inner #div2 #auction2{border-radius:10px;float:left;width:100px;height:30px;text-align:center;
        margin-left:30px;;background-color:white;line-height:30px;margin-top:10px;display: inline-block;
        font-size:16px;color:#999;}
    .pic_inner #div2 #auction:hover{background-color:#999;color:#ffffff}
    div.layui-layer-title{color:#FF3333;font-size:24px;}
    /*.layer-anim{box-shadow: 1px 1px 50px #ff6976  }*/
</style>
<div class="limit_style" id="">
    <div id="slideBox" class="slideBox">
        <div class="hd">
            <ul class="smallUl"></ul>
        </div>
        <div class="bd">
            <ul>
                <?php foreach($advertise as $v): ?>
                    <li><a href="<?=\yii\helpers\Url::to(['index/advertise'])?>" target="_blank"><div style="background:url(<?=\yii\helpers\Url::to('@web/uploads/ads/').\yii\helpers\Html::encode($v['adlogo']);?>) no-repeat rgb(255, 227, 130); background-position:center; width:100%; height:350px;">
                    </div></a></li>
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
        <div style="line-height:50px;height:50px;font-size:20px;padding-left:40px;color:#FF7200;">
            每个商品最多被十人参与竞价，每个人对同一个商品只有三次竞价的机会
        </div>
    </div>
</div>
<div class="Inside_pages clearfix">
    <!--限时团购-->
    <div class="limit_style Preferential_list">
        <div class="pic_sort clearfix" id="Area">
            <input type="hidden" value="{$Think.session.mid}" id="mid">
            <?php foreach($list as $k=>$v): ?>
                <?php if(\yii\helpers\Html::encode($v['status'])==0): ?>
                    <input class="yjy" type="hidden" value="<?=\yii\helpers\Html::encode($v['endtime'])?>" id="end<?=$k;?>"/>
                    <ul class="list">
                        <li id="timer<?=$k;?>" class="pic_time"></li>
                        <li class="pic_img">
                                <a class="gif"><img style="margin-top:10px;" width="300" height="200" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic'])?>"></a>
                        </li>
                        <li class="pic_inner">
                            <div id="div2">
                                <span>最高价:<b>￥<?=\yii\helpers\Html::encode($v['maxprice'])?>&nbsp;RMB</b></span>
                                    <a id="auction2" class="endHome yijiaoyi">已成功交易</a>
                            </div>
                        </li>
                    </ul>
                <?php else: ?>
                <input type="hidden" value="<?=\yii\helpers\Html::encode($v['starttime'])?>" id="start<?=$k?>"/>
                <input type="hidden" value="<?=\yii\helpers\Html::encode($v['endtime'])?>" id="end<?=$k?>"/>
                <ul class="list">
                    <li id="timer<?=$k?>" class="pic_time"></li>
                    <li class="pic_img">
                        <?php if(\yii\helpers\Html::encode($v['endtime'])<=time()): ?>
                            <a class="gif"><img style="margin-top:10px;" width="300" height="200" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>"></a>
                            <?php else: ?>
                            <a href=""><img style="margin-top:10px;" width="300" height="200" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>"></a>
                        <?php endif;?>
                        <!--<a class="gif" id="img" href=""><img style="margin-top:10px;" width="300" height="200" src="__PUBLIC__/Admin/Uploads/goods/{$val2.pic}"></a>-->
                    </li>
                    <li class="pic_inner">
                        <div id="div2">
                            <span>最高价:<b>￥<?=\yii\helpers\Html::encode($v['maxprice'])?>&nbsp;RMB</b></span>
                            <?php if(\yii\helpers\Html::encode($v['endtime'])<=time()): ?>
                                <a id="auction2" class="endHome">拍卖已收场</a>
                                <?php else: ?>
                                <a id="auction" href="javascript:auction(<?=$v['id']?>)">我要竞拍</a>
                            <?php endif;?>
                            <!--<a id="auction" href="javascript:auction({$val2['id']})">我要竞拍</a>-->
                        </div>
                    </li>
                </ul>
                <?php endif;?>
            <?php endforeach;?>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function auction(id){
        var mid=document.getElementById("mid").value;
        if(mid){
            layer.open({
                type:2,
                title:"我的竞拍",
                skin:'demo-class',
                area:["500px","70%"],
                shadeClose: true,
                shade: 0.8,
                content:"<?=\yii\helpers\Url::to(['auction/detail'])?>?id="+id
            })
        }else{
            layer.confirm("你好，登录后才能竞拍?",{icon:4,btn:['去登陆','算了吧']},function(){
                layer.open({
                    type:2,
                    title:"",
                    skin:'demo-class',
                    area:["480px","56%"],
                    shadeClose: true,
                    shade: 0.8,
                    content:"{:U('Auction/tologin')}"
                })
            })
        }
    }
</script>
<script type="text/javascript">
    $(function(){
        setInterval(changTime, 1000);    //每一秒都循环一次函数
        function changTime(){
            for(i=1;i<=9;i++){document.getElementById("timer"+i).innerHTML = getTime1(i);}
        }
        function getTime1(i) {
            var now = new Date().getTime(); //获取当前的
            var end = ($('#end'+i).val()) * 1000;
            var temp = end - now;
            if (temp <= 0) {
                return "拍卖已收场";
            }
            else {
                var temp2 = new Date();
                temp2.setTime(temp);
                var sec = Math.floor((temp) / 1000 % 60);
                var min = Math.floor(temp / (60 * 1000) % 60);
                var hou = Math.floor(temp / (60 * 60 * 1000) % 24);
                var day = Math.floor(temp / (24 * 60 * 60 * 1000));
                return "剩余时间 "+ day + "天 " + hou + "小时 " + min + "分钟 " + sec + "秒";
            }
        }
        //点击拍完收场动图
        $(".gif").click(function(){
            layer.msg('此拍卖已经结束',{icon:6,time:2000},function(){
                $('.gif img').attr({src:'<?=\yii\helpers\Url::to('@web/images/loading.gif')?>'});
            });
        })
        //点击拍卖已完结
        $(".endHome").click(function(){
            layer.alert('很遗憾,你来晚了,此拍卖已经结束',{icon:6});
        })
        //已交易处理
        var yjy=$(".yijiaoyi").html();
        if(yjy=="已成功交易"){
            $(".yjy").val(0);
        }
    })
</script>