
<style>
    #orderPage{width: 400px;height: 50px; float: right}
    #orderPage span{display:inline-block;width:30px;height:30px;margin-left:10px;background-color:#D86C01;text-align:center;margin-top:10px;line-height:30px;font-size:10px;}
    #orderPage a{display:inline-block;width:30px;height:30px;margin-left:10px;background-color:#D86C01;text-align:center;margin-top:10px;line-height:30px;}
</style>

<!--<div class="i_bg bg_color">
    <div class="m_content">
        <include file="Public/user_left"/>
        <div class="right_style">
            <div class="info_content">-->
                <div class="title_Section"><span>订单管理</span></div>
                <div class="Order_Sort">
                    <ul>
                        <li><a href="<?=\yii\helpers\Url::to(['personal/order','status'=>1])?>"><img src="<?=\yii\helpers\Url::to('@web/images/icon-dingdan1.png')?>"><br>未付款</a></li>
                        <li><a href="<?=\yii\helpers\Url::to(['personal/order','status'=>2])?>"><img src="<?=\yii\helpers\Url::to('@web/images/delivery.ico')?>"><br>未发货</a></li>
                        <li class="noborder" style="width: 220px"><a href="<?=\yii\helpers\Url::to(['personal/order','status'=>3])?>"><img src="<?=\yii\helpers\Url::to('@web/images/icon-weibiaoti101.png')?>"><br>未签收</a></li>
                        <li><a href="<?=\yii\helpers\Url::to(['personal/order','status'=>5])?>"><img src="<?=\yii\helpers\Url::to('@web/images/icon-dingdan.png')?>"><br>已完成</a></li>
                    </ul>
                </div>
                <div class="Order_form_list">
                    <table>
                        <thead>
                        <tr><td class="list_name_title2">编号</td>
                            <td class="list_name_title0">商品</td>
                            <td class="list_name_title1">商品单价(元)</td>
                            <td class="list_name_title2">购买数量</td>
                            <td class="list_name_title4">订单总价(元)</td>
                            <td class="list_name_title5">订单状态</td>
                            <td class="list_name_title6">操作</td>
                        </tr></thead>

                        <tbody>
                        <?php foreach($list as $v1): ?>
                        <tr class="Order_info">
                            <td colspan="7" class="Order_form_time">下单时间：<?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v1['addtime']))?> | 订单号：<?=\yii\helpers\Html::encode($v1['order_syn'])?><em></em></td>
                        </tr>
                        <tr class="Order_Details">
                            <td colspan="4">
                                <table class="Order_product_style">
                                    <tbody>
                                    <?php foreach($v1['orderGoods'] as $k2=>$v2): ?>
                                    <tr>
                                        <td><?=$k2+1;?></td>
                                        <td>
                                            <div class="product_name clearfix">
                                                <a href="#" class="product_img"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v2['goods']['pic']);?>" width="80px" height="80px"></a>
                                                <a href="3"><?=mb_substr(\yii\helpers\Html::encode($v2['goods']['goodsname']),0,20,'utf-8')?></a>
                                                <p class="specification"><?=\yii\helpers\Html::encode($v2['goods']['introduction'])?></p>
                                            </div>
                                        </td>
                                        <td><?=\yii\helpers\Html::encode($v2['goods']['price'])?></td>
                                        <td><?=\yii\helpers\Html::encode($v2['buynum'])?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody></table>
                            </td>
                            <td class="split_line"><?=\yii\helpers\Html::encode($v1['order_price'])?></td>
                            <td class="split_line"><?=\yii\helpers\Html::encode($v1['status']['status_name'])?></td>
                            <td class="operating">
                                <?php if(\yii\helpers\Html::encode($v1['order_status'])==1): ?>
                                    <a href="<?=\yii\helpers\Url::to(['order/index','id'=>\yii\helpers\Html::encode($v1['id'])])?>"><?=\yii\helpers\Html::encode($v1['status']['member_opt'])?></a>
                                <?php elseif(\yii\helpers\Html::encode($v1['order_status'])==2): ?>
                                    <span><?=\yii\helpers\Html::encode($v1['status']['member_opt'])?></span>
                                <?php elseif(\yii\helpers\Html::encode($v1['order_status'])==3): ?>
                                    <a href="javascript:qianshou(<?=\yii\helpers\Html::encode($v1['id'])?>)"><?=\yii\helpers\Html::encode($v1['status']['member_opt'])?></a>
                                <?php elseif(\yii\helpers\Html::encode($v1['order_status'])==4): ?>
                                    <a href="<?=\yii\helpers\Url::to(['personal/comment','id'=>\yii\helpers\Html::encode($v1['id'])])?>"><?=\yii\helpers\Html::encode($v1['status']['member_opt'])?></a>
                                <?php elseif(\yii\helpers\Html::encode($v1['order_status'])==4): ?>
                                    <span><?=\yii\helpers\Html::encode($v1['status']['member_opt'])?></span>
                                <?php endif;?>
                                <a href="javascript:delOrder(<?=\yii\helpers\Html::encode($v1['id'])?>)">删除</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <div id="orderPage"><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
                </div>
                <script>jQuery(".Order_form_list").slide({titCell:".Order_info", targetCell:".Order_Details",defaultIndex:1,delayTime:300,trigger:"click",defaultPlay:false,returnDefault:false});</script>
            <!--</div>
        </div>
        </div>
    </div>-->

<script type="text/javascript">
    //订单删除
    function delOrder(oid){
        layer.confirm("你确定要删除我吗?",{icon:3,btn:['确定','取消']},function(){
            $.post("<?=\yii\helpers\Url::to(['order/del'])?>",{oid:oid},function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:1000});
                }
            })
        })
    }
    //订单签收
    function qianshou(oid){
        $.get("<?=\yii\helpers\Url::to(['order/sign-for'])?>",{oid:oid},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000},function(){
                    window.location.reload();
                })
            }else{
                layer.msg(res.body,{icon:2,time:1000});
            }
        })
    }
</script>