
<?=\yii\helpers\Html::jsFile('@web/js/jquery.min.1.8.2.js')?>
<?=\yii\helpers\Html::jsFile('@web/js/jquery.sumoselect.min.js')?>
<!--确认订单页样式-->
<div class="Inside_pages clearfix" id="Orders">
    <!--<div class="Process"><img src="__PUBLIC__/Home/images/Process_img_02.png" /></div>-->
<form class="form" action="#" method="post" id="myform">
    <div class="Orders_style clearfix">
        <!--订单信息-->
        <div style="width:45%;float: left;" class="Address_info">
            <input type="hidden" name="oid" id="oid" value="<?=\yii\helpers\Html::encode($info['id'])?>"/>
            <div class="title_name">订单信息</div>
            <ul>
                <li><label>用户名：</label><?=\yii\helpers\Html::encode($info['member']['username'])?></li>
                <li><label>订单号：</label><?=\yii\helpers\Html::encode($info['order_syn'])?></li>
                <li><label>订单状态：</label><?=\yii\helpers\Html::encode($info['status']['status_name'])?></li>
                <li><label>下单时间：</label><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']))?></li>
            </ul>
        </div>
        <!--地址信息样式-->
        <div style="width:50%;float: right;" class="Address_info">
            <!--<div class="title_name">默认收货地址<a href="javascript:edit()">编辑收货地址</a></div>-->
            <ul>
                <?php foreach($address as $v): ?>
                    <div class="title_name">默认收货地址<a href="javascript:edit(<?=$v['id']?>)">编辑收货地址</a></div>
                    <?php if($v['isdefault']==1): ?>
                        <input type="hidden" name="address" value="<?=\yii\helpers\Html::encode($v['id'])?>">
                        <li>
                            收件人:<?=\yii\helpers\Html::encode($v['name'])?>&nbsp;&nbsp;地址:<?=\yii\helpers\Html::encode($v['address'])?>&nbsp;&nbsp;电话:<?=\yii\helpers\Html::encode($v['mobile'])?>
                            <span style="float:right;color:#FF6600;font-size:20px;">默认地址</span>
                        </li>
                    <?php else: ?>
                        <li>
                            收件人:<?=\yii\helpers\Html::encode($v['name'])?>&nbsp;&nbsp;地址:<?=\yii\helpers\Html::encode($v['address'])?>&nbsp;&nbsp;电话:<?=\yii\helpers\Html::encode($v['mobile'])?>
                            <a href="javascript:isdefault(<?=\yii\helpers\Html::encode($v['id'])?>)" style="float: right">设为默认地址</a>
                        </li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
        <fieldset>
            <!--快递选择-->
            <div class="express_delivery">
                <div class="title_name">选择快递方式</div>
                <ul class="dowebok">
                    <li><input checked type="radio" value="1" name="delivery" data-labelauty="圆通快递"></li>
                    <li><input type="radio" value="2" name="delivery" data-labelauty="中通快递"></li>
                    <li><input type="radio" value="3" name="delivery" data-labelauty="顺丰快递"></li>
                    <li><input type="radio" value="4" name="delivery" data-labelauty="申通快递"></li>
                    <li><input type="radio" value="5" name="delivery" data-labelauty="韵达快递"></li>
                </ul>
            </div>
            <!--付款方式-->
            <div class="payment">
                <div class="title_name">支付方式</div>
                <ul>
                    <li><input checked type="radio" value="1" name="pay" data-labelauty="余额支付"></li>
                    <li><input type="radio" value="2" name="pay" data-labelauty="支付宝"></li>
                    <li><input type="radio" value="3" name="pay" data-labelauty="财付通"></li>
                    <li><input type="radio" value="4" name="pay" data-labelauty="银联支付"></li>
                    <li><input type="radio" value="5" name="pay" data-labelauty="货到付款"></li>
                </ul>
            </div>
            <!--产品列表-->
            <div class="product_List">
                <table>
                    <thead>
                    <tr class="title">
                        <td class="name">商品名称</td>
                        <td class="price">商品价格</td>
                        <!--<td class="Preferential">优惠价</td>-->
                        <td class="Quantity">购买数量</td>
                        <td class="Money">金额</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($info['orderGoods'] as $v): ?>
                    <tr>
                        <td class="Product_info">
                            <a href="#"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>"  width="100px" height="100px"/></a>
                            <a href="#" class="product_name"><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></a>
                        </td>
                        <!--<td><i>￥</i>{$val3["marketprice"]}</td>-->
                        <td><i>￥</i><?=\yii\helpers\Html::encode($v['goods']['price'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['buynum'])?></td>
                        <td class="Moneys"><i>￥</i><?=\yii\helpers\Html::encode($v['goods']['price'])*\yii\helpers\Html::encode($v['buynum']);?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <!--价格-->
                <div class="price_style">
                    <div class="right_direction">
                        <ul>
                            <li><label>商品总价</label><i>￥</i><span><?=\yii\helpers\Html::encode($info['order_price'])?></span></li>
                            <li class="shiji_price"><label>实&nbsp;&nbsp;付&nbsp;&nbsp;款</label><i>￥</i><span><?=\yii\helpers\Html::encode($info['order_price'])?></span></li>
                        </ul>
                        <div class="btn">
                            <input name="" type="button"  onclick="javascript:goBack()" value="返回购物车"  class="return_btn"/>
                            <input id="submit_btn" type="button" value="提交订单" class="submit_btn"/>
                        </div>
                        <!--<div class="integral right">待订单确认后，你将获得<span>345</span>积分</div>-->
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    //返回购物车
    function goBack(){
        window.location.href="<?=\yii\helpers\Url::to(['cart/index'])?>";
    }
    function checkLength(which) {
        var maxChars = 50; //
        if(which.value.length > maxChars){
            alert("您出入的字数超多限制!");
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    }
</script>
<script type="text/javascript">
    $(function(){
        $(':input').labelauty();
    })
</script>
<script type="text/javascript">
    $(function(){
        $("#submit_btn").click(function(){
            var oid=$('#oid').val();
            $.post("<?=\yii\helpers\Url::to(['pay/index'])?>",$("#myform").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:2000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['pay/index'])?>?oid="+oid;
                    })
                }else{
                    layer.alert(res.body,{icon:2});
                }
            },'json')
        })
    })
    //编辑收货地址
    function edit(id){
        layer.open({
            type:2,
            title:"编辑收货地址",
            skin:'demo-class',
            area:["450px","50%"],
            shadeClose: true,
            shade: 0.8,
            content:"<?=\yii\helpers\Url::to(['address/edit'])?>?id="+id
        })
    }
    //设置默认收货地址
    function isdefault(id){
        $.post("<?=\yii\helpers\Url::to(['address/set-default'])?>",{id:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000},function(){
                    window.location.reload();
                })
            }else{
                layer.msg(res.body,{icon:1,time:1000})
            }
        },'json')
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        window.asd = $('.SlectBox').SumoSelect({csvDispCount: 3 });
        window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
    });
</script>