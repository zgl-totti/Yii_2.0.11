
<style type="text/css">
    th{text-align:center;height:30px;line-height:30px;font-size:18px;}
    td{text-align:center}
</style>
    <div style="width:960px;float: left;height:800px;margin-top:-10px;">
        <div style="height:40px;line-height:40px;font-size:20px;margin-top:15px;padding-left:30px;">
            <span style="border-bottom:2px solid red;">已读列表</span>
        </div>
        <div style="width:900px;height:500px;border:1px solid gray;">
            <table style="width:900px;">
                <tr>
                    <th>编号</th>
                    <th>发送人</th>
                    <th>内容</th>
                    <th>发送时间</th>
                    <th>操作</th>
                </tr>
                <?php foreach($list as $k=>$v): ?>
                <tr>
                    <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                    <td><?=\yii\helpers\Html::encode($v['sender'])?></td>
                    <td style="color:red"><?=\yii\helpers\Html::encode($v['message'])?></td>
                    <td><?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v['addtime']))?></td>
                    <td>
                        <a href="<?=\yii\helpers\Url::to(['message/index','id'=>\yii\helpers\Html::encode($v['id'])])?>">查看详情</a>
                        <!--<a href="{:U('Message/checkDetail',array('ag_id'=>$val1['ag_id']))}">查看详情</a>-->
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
<div style="clear:both"></div>
<!--<script>
    function checkDetail(id){
        layer.open({
            type:2,
            title:"",
            skin:'demo-class',
            area:['740px','500px'],
            shadeClose: true,
            shade: 0.8,
            content:"<?/*=\yii\helpers\Url::to(['message/index'])*/?>?id="+id;
        })
    }
</script>-->