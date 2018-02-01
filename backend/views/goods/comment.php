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

    <style type="text/css">
       body .demo-class .layui-layer-title{background:#3fafe1; color: #333 border: none;}
       body .demo-class .layui-layer-btn{border-top:1px solid #E9E7E7}
       body .demo-class .layui-layer-btn a{background:#333;}
       body .demo-class .layui-layer-btn .layui-layer-btn1{background:#999;}
       body .demo-class {width: 500px;height: 300px;}
       .page{  float: right;  }
       .page a,.page span{  display: inline-block;  background: yellowgreen;  margin-left: 5px;  width: 24px;  height: 24px;  text-align: center;  line-height: 24px;  font-weight: bolder;  }
       .page span{background: #ececec;}
       .page a:hover{  background: #ececec;  }
    </style>
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
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">评论页面</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <form action="<?=\yii\helpers\Url::to(['goods/comment'])?>" method="get">
                <ul class="seachform">
                    <li><label>综合查询</label><input name="keywords" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
                </ul>
            </form>
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>用户名</th>
                    <th>商品名</th>
                    <th>是否回复</th>
                    <th>评论时间</th>
                    <th>是否展示</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                <tr>
                    <td><input name="" type="checkbox" value="" /></td>
                    <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                    <td><?=\yii\helpers\Html::encode($v['member']['username'])?></td>
                    <td><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></td>
                    <td><?=\yii\helpers\Html::encode($v['isreply'])==0?'未回复':'已回复';?></td>
                    <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
                    <td><?=\yii\helpers\Html::encode($v['isshow'])==1?'展示':'隐藏';?></td>
                    <td>
                        <a href="<?=\yii\helpers\Url::to(['goods/detail','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink">查看详情</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                            <?=\yii\helpers\Html::encode($v['isshow'])==1?'隐藏':'展示';?>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?=\yii\helpers\Url::to(['goods/reply','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink reply">
                            <?=\yii\helpers\Html::encode($v['isreply'])==0?'回复':'';?>
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="pagin">
                <div class="page" style="display: block;float: right;">
                    <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm("确定要改变状态吗?",{
                    icon:3,
                    title:'提示'
                },function() {
                    $.post("<?=\yii\helpers\Url::to(['goods/comment-operate'])?>", {id: id}, function (res) {
                        if (res.code == 1) {
                            layer.msg(res.body, {icon: 6, time: 2000}, function () {
                                location = "<?=\yii\helpers\Url::to(['goods/comment'])?>";
                            })
                        } else {
                            layer.msg(res.body, {icon: 5, time: 2000})
                        }
                    }, 'json')
                })
            })
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm("确定要完全删除吗?",{
                    icon:3,
                    title:'提示'
                },function() {
                    $.post("<?=\yii\helpers\Url::to(['goods/del-comment'])?>", {id: id}, function (res) {
                        if (res.code == 1) {
                            layer.msg(res.body, {icon: 6, time: 2000}, function () {
                                location = "<?=\yii\helpers\Url::to(['goods/comment'])?>";
                            })
                        } else {
                            layer.msg(res.body, {icon: 5, time: 2000})
                        }
                    }, 'json')
                })
            })
        })
    </script>
    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</div>
</body>
<script type="text/javascript">
    //回复
    function reply(cid){
        layer.open({
            type:2,
            title:'回复',
            skin:'demo-class',
            content:"{:U('answer')}?id="+cid
        })
    }
    //删除
    function del(cid){
        layer.confirm('确定删除?',{icon:2,title:'提示'},function(){
            $.get("{:U('GoodsComment/del')}","id="+cid,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('GoodsComment/comment')}";
                    })
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }
            })
        })
    }
    //显示

    function enabled(cid){
        $.get("{:U('GoodsComment/enabled')}","id="+cid,function(res){
            if(res.status=='ok'){
                layer.msg(res.msg,{icon:1,time:1000},function(){
                    window.location.href="{:U('GoodsComment/comment')}";
                })
            }else
            {
                layer.msg(res.msg,{icon:2,time:1000});
            }
        },'json')
    }
    function disabled(cid){
        $.get('{:U("GoodsComment/disabled")}',"id="+cid,function(res){
            if(res.status=='ok'){
                layer.msg(res.msg,{icon:1,time:1000},function(){
                    window.location.href="{:U('GoodsComment/comment')}";
                })
            }else
            {
                layer.msg(res.msg,{icon:2,time:1000});
            }
        },'json')
    }
</script>
</html>