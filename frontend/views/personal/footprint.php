
<div class="i_bg bg_color">
    <div class="user_style clearfix">
        <div class="user_center">
            <div class="m_content">
                <div class="right_style">
                    <div class="info_content">


<div class="collect_style r_user_style">
    <div class="title_Section"><span>浏览历史</span></div>
    <div class="collect">
        <ul class="Quantity"><li>已浏览：<?=\yii\helpers\Html::encode($num)?>条</li><li></li></ul>
        <div class="collect_list">
            <ul>
                <?php foreach($list as $v): ?>
                    <li class="collect_p">
                        <a href="javascript:delFoot(<?=\yii\helpers\Html::encode($v['id'])?>)"><em class="iconfont icon-close2 delete"></em></a>
                        <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['gid'])])?>" class="buy_btn">查看详情</a>
                        <div class="collect_info">
                            <div class="img_link"> <a href="#" class="center "><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').\yii\helpers\Html::encode($v['goods']['pic']);?>"></a></div>
                            <dl class="xinxi">
                                <dt><a href="#" class="name"><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></a></dt>
                                <dd><span class="Price"><b>￥</b><?=\yii\helpers\Html::encode($v['goods']['price'])?></span>
                                </dd>
                            </dl>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>


                    </div></div></div></div></div></div>
<script>
    function delFoot(id){
        layer.confirm("你确定要删除吗?",{icon:3,btn:['确定','取消']},function(){
            $.post("<?=\yii\helpers\Url::to(['personal/footprint'])?>",{id:id},function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['personal/footprint'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:1000})
                }
            })
        })
    }
</script>