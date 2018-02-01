
<!--购物车样式-->
<div class="Inside_pages clearfix">
    <div class="shop_carts">
        <!--<div class="Process"><img src="__PUBLIC__/Home/images/Process_img_01.png" /></div>-->
        <div class="Shopping_list">
            <div class="title_name">
                <ul>
                    <li class="checkbox"></li>
                    <li class="name">商品名称</li>
                    <li class="scj">市场价</li>
                    <li class="bdj">本店价</li>
                    <li class="sl">购买数量</li>
                    <li class="xj">小计</li>
                    <LI class="cz">操作</LI>
                </ul>
            </div>
            <div class="shopping">
                <form  method="post" action="#" id="cartForm">
                    <input type="hidden" name="total_price" id="totalprices" value="">
                    <table class="table_list">
                        <?php foreach($list as $k=>$v): ?>
                        <tr class="tr">
                            <td class="checkbox"><input onclick="gettotalprice()" name="checkitems[]" type="checkbox" value="<?=\yii\helpers\Html::encode($v['gid'])?>" /></td>
                            <td class="name">
                                <div class="img"><a href="#"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" /></a></div>
                                <div class="p_name"><a href="#"><?=mb_substr($v['goods']['goodsname'],0,20,'utf-8')?></a></div>
                            </td>
                            <td class="scj sp"><span id="Original_Price_1">￥<?=\yii\helpers\Html::encode($v['goods']['marketprice'])?></span></td>
                            <td class="bgj sp" ><span class="price_item_1" id="price_item_1"><?=\yii\helpers\Html::encode($v['goods']['price'])?></span></td>
                            <td class="sl">
                                <div class="Numbers">
                                    <a onClick="setAmount.reduce('#qty_item_1')" href="javascript:jian(<?=$k;?>)" class="jian">-</a>
                                    <input onkeyup="chgnum(this)" type="text" id="buy-num<?=$k;?>" name="buynum<?=\yii\helpers\Html::encode($v['gid']);?>" value="{$val1['buynum']}" id="qty_item_1" onkeyup="setAmount.modify('#qty_item_1')" class="number_text">
                                    <a onclick="setAmount.add('#qty_item_1')" href="javascript:jia(<?=$k;?>)" class="jia">+</a>
                                </div>
                            </td>
                            <td class="xj" >
                                <span class="total_item_1" ></span>
                            </td>
                            <td class="cz">
                                <p><a href="javascript:del(<?=\yii\helpers\Html::encode($v['gid'])?>)">删除</a><P>
                                <p><a id="collect" href="javascript:collect({$val1['gid']})">收藏该商品</a></p>
                                <!--<p><a style="display:none;" id="collect2" href="">已收藏</a></p>-->
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <div class="sp_Operation clearfix">
                        <div class="select-all">
                            <div class="cart-checkbox">
                                <input type="checkbox"  onclick="gettotalprice();" id="chkAll" />全选
                                <!--<input type="checkbox"   id="CheckedAll" name="toggle-checkboxes" class="jdcheckbox" clstag="clickcart">全选-->
                            </div>
                            <div class="operation">
                                <a href="javascript:void(0);" id="send">删除选中的商品</a>
                            </div>
                        </div>
                        <!--结算-->
                        <div class="toolbar_right">
                            <ul class="Price_Info">
                                <li class="p_Total">
                                    <label class="text">商品总价：</label>
                                    <span class="price sumPrice" id="total"></span>
                                </li>
                                <!--<li class="integral">本次购物可获得<b id="total_points"></b>积分</li>-->
                            </ul>
                            <div class="btn">
                                <!--<a class="cartsubmit" href="javascript:sub()"></a>-->
                                <a class="cartsubmit"></a>
                                <a class="continueFind" href="<?=\yii\helpers\Url::to(['product/index'])?>"></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--推荐产品样式-->
        <div class="recommend_shop">
            <div class="title_name">推荐购买</div>
            <div class="recommend_list">
                <div class="hd">
                    <a class="prev" href="javascript:void(0)">&gt;</a>
                    <a class="next" href="javascript:void(0)">&lt;</a>
                </div>
                <div class="bd">
                    <ul>
                        <?php foreach($recommend as $v): ?>
                        <li class="recommend_info">
                            <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['id'])])?>" class="buy_btn">查看详情</a>
                            <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['id'])])?>" class="img"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic']);?>" width="160px" height="160px"/></a>
                            <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['id'])])?>" class="name"><?=\yii\helpers\Html::encode($v['goodsname'])?></a>
                            <h4><span class="Price"><i>RNB</i><?=\yii\helpers\Html::encode($v['price'])?></span></h4>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <script>jQuery(".recommend_list").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:6});</script>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".cartsubmit").click(function(){
            $.post("<?=\yii\helpers\Url::to(['order/create-order'])?>",$("#cartForm").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['order/index'])?>?oid="+res.oid;
                    })
                }else if(res.code==5){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        layer.open({
                            type:2,
                            title:"",
                            skin:'demo-class',
                            area:["480px","56%"],
                            shadeClose: true,
                            shade: 0.8,
                            content:"<?=\yii\helpers\Url::to(['login/login'])?>"
                        })
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:1000});
                }
            },'json')
        })
    })
</script>
<script type="text/javascript">
    //全选
    function chk(){
        var chkAll=document.getElementById('chkAll');
        var chks=document.getElementsByName('checkitems[]');
        for(var i=0;i<chks.length;i++){
            chks[i].checked=chkAll.checked;
            if(chks[i].checked){
                gettotalprice();
            }else {
                document.getElementById('total').innerHTML="￥"+0;
            }
        }
    }
    document.getElementById('chkAll').onclick=chk;
//        $('.cateList').hide();
    //加
    function jia(n){
        var num=document.getElementById("buy-num"+n).value;
        num++;
        document.getElementById("buy-num"+n).value=num;
        getprices();
        gettotalprice();
    }
    //减
    function jian(n){
        var num=document.getElementById("buy-num"+n).value;
        num--;
        if(num  <= 1){
            num=1;
        }
        document.getElementById("buy-num"+n).value=num;
        getprices();
        gettotalprice();
    }

    //提交表单
//    function sub(){
//        document.getElementById("cartForm").submit();
//    }

    function chgnum(v){
        if(v.value<1){
            v.value=1;
        }
        if(v.value>199){
            v.value=199;
        }
        if(isNaN(v.value)){
            v.value=1;
        }

        gettotalprice();
    }
    //小计
    function getprices(){
        var nums=document.getElementsByClassName('number_text');
        var price=document.getElementsByClassName('price_item_1');
        var prices=document.getElementsByClassName('total_item_1');
        for(var i=0;i<price.length;i++){
            prices[i].innerHTML=(parseFloat(price[i].innerHTML)*parseFloat(nums[i].value)).toFixed(2);
        };
    }
    //总计
    function gettotalprice(){
        getprices();
        var inputs=document.getElementsByName('checkitems[]');
        var prices=document.getElementsByClassName('total_item_1');
        var totalprice=0;
        for(var i=0;i<inputs.length;i++){
            if(inputs[i].checked){
                totalprice+=parseFloat(prices[i].innerHTML);
            };
        };
        document.getElementById('total').innerHTML='￥'+totalprice;
        document.getElementById('totalprices').value=totalprice;
    }
    gettotalprice();
    //删除
    function del(id){
        layer.confirm("确定要删除吗?",{icon:3,btn:['确定','取消']},function(){
            $.post("<?=\yii\helpers\Url::to(['cart/del'])?>",{id:id},function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['cart/index'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:1000});
                }
            },'json')
        })
    }
    //收藏
    function collect(id){
        $.post("<?=\yii\helpers\Url::to(['collect/add'])?>",{gid:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000})
            }else if(res.code==5){
                layer.alert(res.body,{icon:3},function(){
                    layer.open({
                        type:2,
                        title:"",
                        skin:'demo-class',
                        area:["480px","56%"],
                        shadeClose: true,
                        shade: 0.8,
                        content:"<?=\yii\helpers\Url::to(['login/login'])?>"
                    })
                });
            }else{
                layer.msg(res.body,{icon:2,time:1000});
            }
        },'json')
    }
</script>
