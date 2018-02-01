

<div style="margin-bottom:20px;padding:45px;height: 300px">
    <div class="box">
        <h1 style="color:#71B247;height:150px;line-height:150px;padding-left:100px;margin:10px 0;background:url('__PUBLIC__/Home/images//ok.jpg') no-repeat left 30px;">
            订单<?=\yii\helpers\Html::encode($info['order_syn'])?>支付成功！<a href="<?=\yii\helpers\Url::to(['index/index'])?>" style="margin:0px 10px;" target="_self">返回首页继续购物</a>
        </h1>
        <dl style="margin-left: 50px;font-size:14px;">
            <dt>温馨提示：</dt>
            <dd> &nbsp;</dd>
            <dd>1. 请保持手机畅通，以便快递公司和您联系，确保收件顺利</dd>
            <dd> &nbsp;</dd>
            <dd>2. 如有疑问，请拨打客服电话：400-6666-8888</dd>
        </dl>
    </div>
</div>
<div class="pxlistcon box">
    <div class="pxlist" >
        <h3>购买该商品的用户还购买了</h3>
        <ul>
            <?php foreach($list as $v): ?>
                <li>
                    <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['id'])])?>{:U('Detail/detail',array('gid'=>$val['id']))}" title="">
                        <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic']);?>" alt="" />
                        <span><?=\yii\helpers\Html::encode($v['goodsname'])?></span>
                    </a>
                    <p>￥<?=\yii\helpers\Html::encode($v['price'])?></p>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<div style="clear:both;"></div>
<script type="text/javascript">
    $(function() {
        $('.cateList').hide();
    });

    function sort(v) {
        $(v).addClass('active').siblings().removeClass('active');
    }
</script>