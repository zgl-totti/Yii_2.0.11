
<style type="text/css">
    body,ul,li{margin: 0;padding: 0;list-style: none;}
    a{text-decoration: none;color: #000;font-size: 14px;}
    #tabbox{ width:900px; overflow:hidden; margin:0 auto;}
    .tab_conbox{border: 1px solid #999;border-top: none;}
    .tab_con{ display:none;}
    .tabs{height: 32px;border-bottom:1px solid #999;border-left: 1px solid #999;width: 100%;}
    .tabs li{height:31px;line-height:31px;float:left;border:1px solid #999;border-left:none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
    .tabs li a {display: block;padding: 0 20px;border: 1px solid #fff;outline: none;}
    .tabs li a:hover {background: #ccc;}
    .tabs .thistab,.tabs .thistab a:hover{background: #fff;border-bottom: 1px solid #fff;}
    .tab_con {padding:12px;font-size: 14px; line-height:175%;}
    .tablelist{border:solid 1px #cbcbcb; width:100%; clear:both;border: 0;padding: 0;margin: 0;}
    .tablelist td{line-height:35px; text-indent:11px; border-right: dotted 1px #c7c7c7;}
    .tablelist tbody tr.odd{background:#f5f8fa;}
    .tablelist tbody tr:hover{background:#e5ebee;}
    body .demo-class .layui-layer-title{background: #e15e6b; color: #333 border: none;font-size: 20px;}
    body .demo-class .layui-layer-btn{border-top:1px solid #E9E7E7}
    body .demo-class .layui-layer-btn a{background:#333;}
    body .demo-class .layui-layer-btn .layui-layer-btn1{background:#999;}
    body .demo-class {width: 500px;height: 300px;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery.jqtab = function(tabtit,tabcon) {
            $(tabcon).hide();
            $(tabtit+" li:first").addClass("thistab").show();
            $(tabcon+":first").show();
            $(tabtit+" li").click(function() {
                $(tabtit+" li").removeClass("thistab");
                $(this).addClass("thistab");
                $(tabcon).hide();
                var activeTab = $(this).find("a").attr("tab");
                $("#"+activeTab).fadeIn();
                return false;
            });
        };
        /*调用方法如下：*/
        $.jqtab("#tabs",".tab_con");
    });
</script>


                <!--评论-->
                <div id="tabbox" style="margin-top: 20px;">
                    <ul class="tabs" id="tabs">
                        <li><a href="#" tab="tab1">竞拍记录</a></li>
                        <li><a href="#" tab="tab2">已拍商品</a></li>
                    </ul>
                    <ul class="tab_conbox">
                        <li id="tab1" class="tab_con">
                            <table class="tablelist">
                                <thead>
                                <tr>
                                    <th>编号<i class="sort"></i></th>
                                    <th>商品图片</th>
                                    <th>商品名称</th>
                                    <th>竞拍价</th>
                                    <th>购买数量</th>
                                    <th>竞拍时间</th>
                                   <!-- <th>总价</th>
                                    <th>评价</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list1 as $k1=>$v1): ?>
                                    <tr>
                                        <td><?=$pages1->page*$pages1->pageSize+$k1+1;?></td>
                                        <td>
                                            <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v1['pic']);?>" style="width: 50px;height: 50px;">
                                        </td>
                                        <td><?=mb_substr(\yii\helpers\Html::encode($v1['goodsname']),0,15,'utf-8')?></td>
                                        <td><?=\yii\helpers\Html::encode($v1['auctionprice'])?></td>
                                        <td>1</td>
                                        <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v1['addtime']))?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages1])?>
                        </li>

                        <li id="tab2" class="tab_con">
                            <table class="tablelist">
                                <thead>
                                <tr>
                                    <th>编号<i class="sort"></i></th>
                                    <th>商品图片</th>
                                    <th>商品名称</th>
                                    <th>竞拍价</th>
                                    <th>购买数量</th>
                                    <th>交易保证金</th>
                                    <th>需支付</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list2 as $k2=>$v2): ?>
                                    <form action="#" id="auctionForm<?=$k2?>">
                                        <input name="checkitems[]" value="<?=\yii\helpers\Html::encode($v2['auctionGoods']['gid'])?>" type="hidden">
                                        <input name="ag_id" value="<?=\yii\helpers\Html::encode($v2['ag_id'])?>" type="hidden">
                                        <input name="pay" value="<?=\yii\helpers\Html::encode($v2['price'])-\yii\helpers\Html::encode($v2['deposit']);?>" type="hidden">
                                        <input name="buynum" value="1" type="hidden">
                                    <tr>
                                        <td><?=$pages2->page*$pages2->pageSize+$k2+1;?></td>
                                        <td><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v2['pic']);?>" style="width: 50px;height: 50px;"></td>
                                        <td><?=\yii\helpers\Html::encode($v2['goodsname'])?></td>
                                        <td><?=\yii\helpers\Html::encode($v2['price'])?></td>
                                        <td>1</td>
                                        <td><?=\yii\helpers\Html::encode($v2['deposit'])?></td>
                                        <td><?=\yii\helpers\Html::encode($v2['price'])-\yii\helpers\Html::encode($v2['deposit']);?></td>
                                        <td>
                                            <?php if(\yii\helpers\Html::encode($v2['isshow'])==1): ?>
                                                <a href="javascript:pay(<?=$k2?>)">去付款</a>
                                            <?php else: ?>
                                                <a href="<?=\yii\helpers\Url::to(['personal/order'])?>">查看订单</a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    </form>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages2])?>
                        </li>
                    </ul>
                </div>

<script type="text/javascript">
    //去付款
    function pay(k){
        $.post("<?=\yii\helpers\Url::to(['order/creat-order'])?>",$("#auctionForm"+k).serialize(),function(res){
            if(res.code==1){
                layer.msg(res.msg,{icon:1,time:2000},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['order/index'])?>?oid="+res.oid+"&pay="+res.pay;
                })
            }else{
                layer.msg("付款失败，请稍后尝试",{icon:2,time:1000})
            }
        });
    }
</script>