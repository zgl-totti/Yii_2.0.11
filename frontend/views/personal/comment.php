
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
    body .demo-class {width: 400px;height: 400px;}
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
                <div id="tabbox">
                    <ul class="tabs" id="tabs">
                        <li><a href="#" tab="tab1">未评价</a></li>
                        <li><a href="#" tab="tab2">已评价</a></li>
                    </ul>
                    <ul class="tab_conbox">
                        <li id="tab1" class="tab_con">
                            <table class="tablelist">
                                <thead>
                                <tr>
                                    <th>编号<i class="sort"></i></th>
                                    <th>商品图片</th>
                                    <th>商品名称</th>
                                    <th>单价</th>
                                    <th>购买数量</th>
                                    <th>总价</th>
                                    <th>评价</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list1 as $k1=>$v1): ?>
                                    <tr>
                                        <td><?=$pages1->pageSize*$pages1->page+$k1+1;?></td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb100/100_').\yii\helpers\Html::encode($v2['info']['pic']);?>" style="width: 50px;height: 50px;"></li>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><?=mb_substr(\yii\helpers\Html::encode($v2['info']['goodsname']),0,20,'utf-8')?></li>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><?=\yii\helpers\Html::encode($v2['info']['price'])?></li>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><?=\yii\helpers\Html::encode($v2['buynum'])?></li>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><?=\yii\helpers\Html::encode($v2['buynum'])*\yii\helpers\Html::encode($v2['info']['price']);?></li>
                                            <?php endforeach;?>
                                        </td>
                                        <td>
                                            <?php foreach($v1['orderGoods'] as $v2): ?>
                                                <li><a href="javascript:comment(<?=\yii\helpers\Html::encode($v2['gid'])?>,<?=\yii\helpers\Html::encode($v2['oid'])?>)" class="tablelink">我要评价</a></li>
                                            <?php endforeach;?>
                                        </td>
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
                                    <th>单价</th>
                                    <th>购买数量</th>
                                    <th>总价</th>
                                    <th>评价内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                            <tbody>
                            <?php foreach($list2 as $k1=>$v1): ?>
                                <tr>
                                    <td><?=$pages2->pageSize*$pages2->page+$k1+1;?></td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb100/100_').\yii\helpers\Html::encode($v2['info']['pic']);?>" style="width: 50px;height: 50px;"></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><?=mb_substr(\yii\helpers\Html::encode($v2['info']['goodsname']),0,20,'utf-8')?></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><?=\yii\helpers\Html::encode($v2['info']['price'])?></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><?=\yii\helpers\Html::encode($v2['buynum'])?></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><?=\yii\helpers\Html::encode($v2['buynum'])*\yii\helpers\Html::encode($v2['info']['price']);?></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li><?=mb_substr(\yii\helpers\Html::encode($v2['comment']['commentcontent']),0,10,'utf-8')?></li>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php foreach($v1['orderGoods'] as $v2): ?>
                                            <li>
                                                <a href="javascript:del(<?=\yii\helpers\Html::encode($v2['id'])?>)">删除</a>
                                                <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>$v2['gid']])?>">查看详情</a>
                                            </li>
                                        <?php endforeach;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            </table>
                            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages2])?>
                        </li>
                    </ul>
                </div>




<script>
    function comment(gid,oid){
        layer.open({
            type:2,
            title:'评价',
            skin:'demo-class',
            area: ['600px', '620px'],
            content:"<?=\yii\helpers\Url::to(['personal/comment-goods'])?>?gid="+gid+"&&oid="+oid
        });
    }
    function del(id){
        layer.confirm('是否删除',{icon:3,title:'删除'},function(){
            $.post("<?=\yii\helpers\Url::to(['personal/del-comment'])?>",{id:id},function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['personal/comment'])?>";
                    })
                }else{layer.msg(res.body,{icon:2,time:1000});}
            },'json')
        })
    }
</script>