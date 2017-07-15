
<style>
    #footPage{width: 300px;height: 50px; float: right}
    #footPage span{display:inline-block;width:30px;height:30px;margin-left:10px;background-color:#D86C01;text-align:center;margin-top:10px;line-height:30px;font-size:10px;}
    #footPage a{display:inline-block;width:30px;height:30px;margin-left:10px;background-color:#D86C01;text-align:center;margin-top:10px;line-height:30px;}
</style>

<div class="collect_style r_user_style">
    <div class="title_Section"><span>用户收藏</span></div>
    <div class="collect">
        <ul class="Quantity"><li>已藏量：<?=\yii\helpers\Html::encode($num)?>条</li><li></li></ul>
        <div class="collect_list">
            <ul>
                <?php foreach($list as $v): ?>
                    <li class="collect_p">
                        <a href="javascript:collectdel(<?=\yii\helpers\Html::encode($v['id'])?>);"><em class="iconfont icon-close2 delete"></em></a>
                        <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['gid'])])?>" class="buy_btn">查看详情</a>
                        <div class="collect_info">
                            <div class="img_link"> <a href="#" class="center "><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').\yii\helpers\Html::encode($v['goods']['pic']);?>"></a></div>
                            <dl class="xinxi">
                                <dt><a href="#" class="name"><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></a></dt>
                                <dd><span class="Price"><b>￥</b><?=\yii\helpers\Html::encode($v['goods']['price'])?></span><span class="collect_Amount"><i class="iconfont icon-shoucang"></i><?=\yii\helpers\Html::encode($v['goods']['salenum'])?></span></dd>
                            </dl>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div id="footPage"><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
    </div>
</div>

<script type="text/javascript">
    function collectdel(id){
        /*$.get("{:U('Personal/collectdel')}","cid="+cid,function(res){
            if(res.status==1){
                layer.msg(res.msg,{icon:6,time:500},function(){
                    window.location.href="{:U('Personal/collection')}";
                })
            }else if(res.status==0){layer.msg('删除失败',{icon:5,time:1000});}
        })*/
        $.post("<?=\yii\helpers\Url::to(['personal/collect'])?>",{id:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:6,time:500},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['personal/collect'])?>";
                })
            }else{
                layer.msg(res.body,{icon:5,time:1000});
            }
        })
    }
</script>