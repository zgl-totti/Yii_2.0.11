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
        div.pagin{background-color: red;}
        div.pagin div{float: right}
        div.pagin span{text-align:center;line-height: 30px; display: inline-block;width: 30px;height: 30px; background-color:orange;}
        div.pagin a{text-align:center;line-height: 30px;display: inline-block;width: 30px;height: 30px; background-color:gray;}
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
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm("确定要更改状态吗？",{
                    icon:3,
                    title:'提示'
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['category/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['category/index'])?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            });
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm("确定要删除吗？",{
                    icon:3,
                    title:'提示'
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['category/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['category/index'])?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            })
        })
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">分类设置</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <form action="<?=\yii\helpers\Url::to(['category/index'])?>" method="get">
                <ul class="seachform">
                    <li><label>综合查询</label><input name="keywords" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
                </ul>
            </form>
            <table class="tablelist">
                <thead>
                <tr>
                    <!--<th><input name="" type="checkbox" value="" checked="checked"/></th>-->
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>分类名称</th>
                    <th>分类id</th>
                    <th>分类父id</th>
                    <th>上级分类</th>
                    <th>是否展示</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <!--<td><input name="" type="checkbox" value="" /></td>-->
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><a href="<?=\yii\helpers\Url::to(['category/index','pid'=>$v['id']])?>"><?=\yii\helpers\Html::encode($v['catename'])?></a></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['pid'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['path'])?></td>
                        <td><?=(\yii\helpers\Html::encode($v['active'])==1)?'已展示':'已禁用';?></td>
                        <td>
                            <a href="<?=\yii\helpers\Url::to(['category/edit','id'=>$v['id']])?>" class="tablelink">编辑</a>&nbsp;&nbsp;
                            <a href="#" id="<?=$v['id']?>" class="tablelink operate"><?=(\yii\helpers\Html::encode($v['active'])==1)?'禁用':'展示';?></a>&nbsp;&nbsp;
                            <a href="#" id="<?=$v['id']?>" class="tablelink del">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="pagin">
                <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
    <!--<script type="text/javascript">
        function disabled(bid){
            layer.confirm("确定要更改吗？",{
                icon:3,
                title:'提示'
            },function(){
                $.get("{:U('Category/disabled')}","id="+bid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Category/showlist')}";   //如果成功刷新页面;
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }
                },'json')
            })
        }
        function enabled(bid){
            layer.confirm("确定要更改吗？",{
                icon:3,
                title:'提示'
            },function(){
                $.get("{:U('Category/enabled')}","id="+bid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Category/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        function del(bid){
            layer.confirm("确定要删除吗?",{
                icon:2,
                title:'提示'
            },function(){
                $.get("{:U('Category/del')}","id="+bid,function(res){
                    if(res.status=='ok'){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Category/showlist')}";
                        })
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }
                },'json')
            })
        }
    </script>-->
</div>
</body>
</html>
