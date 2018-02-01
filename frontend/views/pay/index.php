
<!-- 购物车的内容 开始-->
<div class="shoppingMain">
    <ul class="title clearfix">
        <li class="xuanzhong">
            <a href="#"><p  class="mycar"><span>1</span>我的购物车</p></a>
        </li>
        <li>
            <a href="#"><p  class="write"><span>2</span>填写订单</p></a>
        </li>
        <li>
            <a href="#"><p class="pay"><span>3</span>订单支付</p></a>
        </li>
    </ul>
    <div class="border">
        <div class="myCar">
            <div class="success">
                <h3>订单已提交成功，请尽快付款！</h3>
                <p class="p1">您的订单号：<span><?=\yii\helpers\Html::encode($info['order_syn'])?></span>
                <p class="p2">订单金额：<span><?=\yii\helpers\Html::encode($info['order_price'])?></span>元</p>
            </div>
            <div class="pay1">
                <div class="chir_pay">
                    <span id="sp1" class="ac">支付方式</span>
                    <span id="sp2">支付平台</span>
                    <span id="sp3">网上银行</span>
                </div>
                <form action="#" method="post" id="myform2">
                    <input type="hidden" name="oid" id="oid" value="<?=\yii\helpers\Html::encode($info['id'])?>" >
                <div  id="div1" style="display: block">
                    <div class="pay2">
                        <span></span> 支付方式
                    </div>
                    <div class="pay3">
                        <ul class="clearfixs">
                            <li style="font-size:18px;">
                                <input checked="checked" type="radio" name="radio" value="1">&nbsp;&nbsp;余额支付
                            </li>
                            <li style="font-size:18px;height:20px;position: relative">
                                <div style="position: absolute;height:26px;width:350px;top:-8px;">
                                    支付密码：<input style="padding:0px 10px;;" type="password" name="paypwd" placeholder="请输入支付密码">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="div2" style="display: none">
                    <div class="pay2">
                        <span></span> 支付平台
                    </div>
                    <div class="pay3">
                        <ul class="clearfixs">
                            <li><input type="radio" name="radio" value="3"> <img src="<?=\yii\helpers\Url::to('@web/images/logo_alipay.gif')?>" alt="" /></li>
                            <li><input type="radio" name="radio" value="4"> <img src="<?=\yii\helpers\Url::to('@web/images/logo_yeepay.gif')?>" alt="" /></li>
                            <li><input type="radio" name="radio" value="5"> <img src="<?=\yii\helpers\Url::to('@web/images/logo_weixin.gif')?>" alt="" /></li>
                        </ul>
                    </div>
                </div>
                <div id="div3" style="display: none">
                    <div class="pay2">
                        <span></span> 网上银行
                    </div>
                    <div class="pay3">
                        <ul class="clearfixs">
                            <li style="font-size:18px;">
                                <input type="radio" name="radio" value="6">&nbsp;&nbsp;建设银行
                            </li>
                            <li style="font-size:18px;">
                                <input type="radio" name="radio" value="7">&nbsp;&nbsp;邮政储蓄银行
                            </li>
                            <li style="font-size:18px;">
                                <input type="radio" name="radio" value="8">&nbsp;&nbsp;工商银行
                            </li>
                        </ul>
                    </div>
                </div>
                    <input id="subBtn" type="button" value="确认无误，点击支付" class="input1">
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    //确认支付
    $(function(){
        $("#subBtn").click(function(){
            var oid=$('#oid').val();
            $.post("<?=\yii\helpers\Url::to(['pay/payment'])?>",$("#myform2").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['order/success'])?>?oid="+oid;
                    })
                }else{
                    layer.alert(res.body,{icon:4});
                }
            },'json')
        })
    })
    //支付方式选项卡
    $(function(){
        $("#sp1").click(function(){
            $(this).addClass("ac").siblings().removeClass("ac");
            $("#div1").show();
            $("#div2").hide();
            $("#div3").hide();
        })
        $("#sp2").click(function(){
            $(this).addClass("ac").siblings().removeClass("ac");
            $("#div2").show();
            $("#div1").hide();
            $("#div3").hide();
        })
        $("#sp3").click(function(){
            $(this).addClass("ac").siblings().removeClass("ac");
            $("#div3").show();
            $("#div2").hide();
            $("#div1").hide();
        })
    })
</script>