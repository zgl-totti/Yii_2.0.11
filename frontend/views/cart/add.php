
<!-- 中间开始 -->
    <div style="margin-bottom:20px;padding:45px;background:#F5F5F5;">
        <div class="box">
            <h1 style="color:#71B247;margin:10px 0">商品已成功加入购物车</h1>
            <table width="100%" border="0" style="border:0" id="cart">
                <tr>
                    <td>
                        <a href="">
                            <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($info['pic']);?>" alt="" style="width:80px;margin:10px;vertical-align:middle" />
                            <?=\yii\helpers\Html::encode($info['goodsname'])?> &nbsp;&nbsp;购买数量：<?=\yii\helpers\Html::encode($info['buynum'])?> &nbsp;&nbsp;单价：￥<?=\yii\helpers\Html::encode($info['price'])?>
                        </a>
                    </td>
                    <td class="pxtitle" style="border:0">
                        <a href="<?=\yii\helpers\Url::to(['product/index'])?>" style="padding:10px 20px;font-size:14px;">继续购物</a>
                        <a href="<?=\yii\helpers\Url::to(['cart/index'])?>" style="padding:10px 20px;font-size:14px;background:#B1191A">去购物车结算</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="pxlistcon box">
        <div class="pxlist" >
            <h3>购买该商品的用户还购买了</h3>
            <ul>
                <?php foreach($goods as $v): ?>
                    <li>
                        <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>$v['gid']])?>" title="">
                            <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($info['goods']['pic']);?>" alt="" />
                            <span><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></span>
                        </a>
                        <p>￥<?=\yii\helpers\Html::encode($v['goods']['price'])?></p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
<!-- 中间结束 -->
