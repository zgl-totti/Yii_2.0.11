<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>列表页</title>

    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/select.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.idTabs.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/select-ui.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>

    <?/*=\backend\assets\AppAsset::register($this)*/?>

    <script type="text/javascript">
        $(document).ready(function(e) {
            $(".select1").uedSelect({
                width : 345
            });
            $(".select2").uedSelect({
                width : 167
            });
            $(".select3").uedSelect({
                width : 100
            });
        });
    </script>
    <script type="text/javascript">
        $(function(){

        })
    </script>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">系统设置</a></li>
    </ul>
    </div>
    <div class="formbody">
    <div id="usual1" class="usual">
  	<div id="tab2" class="tabson">
        <form action="<?=\yii\helpers\Url::to(['order/index'])?>" method="get">
    <ul class="seachform">
        <li>
            <label>订单号/价格</label>
            <input name="order_syn" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" type="text" class="scinput" />
        </li>
        <li><label>订单状态</label>
            <div class="vocation">
                <select class="select2" name="status">
                    <option value="0">全部</option>
                    <option value="1">已下单，为付款</option>
                    <option value="2">已付款，为发货</option>
                    <option value="3">已发货，未签收</option>
                    <option value="4">已签收，未评价</option>
                    <option value="10">已评价，订单完成</option>
                    <option value="5">已取消</option>
                    <option value="6">申请退货</option>
                    <option value="7">退货中</option>
                    <option value="8">已退货</option>
                    <option value="9">商家已取消，缺货</option>
                </select>
            </div>
        </li>
        <li>
            <label>用户名</label>
            <input name="username" type="text" class="scinput" value="<?=\yii\helpers\Html::encode($username?$username:'')?>"/>
        </li>
        <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
    </ul>
        </form>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input name="" type="checkbox" value="" checked="checked"/></th>
            <th>序号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
            <th>编号</th>
            <th>用户名</th>
            <th>订单状态</th>
            <th>订单金额</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $k=>$v): ?>
        <tr>
            <td><input name="" type="checkbox" value="" /></td>
            <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
            <td><?=\yii\helpers\Html::encode($v['order_syn'])?></td>
            <td><?=\yii\helpers\Html::encode($v['username'])?></td>
            <td><?=\yii\helpers\Html::encode($v['status_name'])?></td>
            <td><?=\yii\helpers\Html::encode($v['order_price'])?></td>
            <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['order/detail','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink detail">订单详情</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(\yii\helpers\Html::encode($v['order_status'])==2): ?>
                    <a href="#" class="tablelink operate" id="<?=\yii\helpers\Html::encode($v['id'])?>">发货</a>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
       <div>
           <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
       </div>
    </div>
	</div>
	<script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>

        <script type="text/javascript">
           function tosend(oid){
               layer.open({
                   type:2,
                   title:"确认发货信息",
                   skin:'demo-class',
                   area:["500px","45%"],
                   shadeClose: true,
                   shade: 0.8,
                   content:"{:U('tosend')}?id="+oid
               })
           }
            //删除
            function del(id){
                layer.confirm("你确定要删除我吗",{icon:4,btn:['确定','取消']},function(){
                    $.get("{:U('Order/delete')}",{oid:id},function(res){
                        if(res.status=="ok"){
                            layer.msg(res.msg,{icon:1,time:2000},function(){
                                window.location.href="{:U('Order/showlist')}"
                            })
                        }else{
                            layer.alert(res.msg);
                        }
                    })
                })
            }
        </script>
    </div>
</body>

</html>
