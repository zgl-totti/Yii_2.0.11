<?php $this->beginPage() ?>
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
</head>
<body>
<?php $this->beginBody() ?>
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
            <form action="<?=\yii\helpers\Url::to(['admin/index'])?>" method="get" id="selForm">
                <ul class="seachform">
                    <li><label>综合查询</label><input value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" name="keywords" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
                </ul>
            </form>
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>名称</th>
                    <th>所属组</th>
                    <th>性别</th>
                    <th>上次登录时间</th>
                    <th>本次登录时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v):?>
                    <tr>
                        <td><input name="" type="checkbox" /></td>
                        <td><?=$pages->page*$pages->pageSize+$k+1?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=(\yii\helpers\Html::encode($v['gender'])==0)?'男':'女';?></td>
                        <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['logintime']))?></td>
                        <td><?=\yii\helpers\Html::encode($v['loginip'])?></td>
                        <td><?=(\yii\helpers\Html::encode($v['active'])==0)?'已禁用':'已启用';?></td>
                        <td>
                            <a href="#" id="<?=$v['id']?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;
                            <a href="<?=\yii\helpers\Url::to(['admin/edit','id'=>$v['id']])?>" class="tablelink">编辑</a>&nbsp;&nbsp;
                            <a href="#" id="<?=$v['id']?>" class="tablelink del">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="pagin">
                <!--<div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>-->
                <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</div>
<?php $this->endBody() ?>
</body>
<script type="text/javascript">
    $(function(){
        $('.operate').click(function(){
            var id=$(this).attr('id');
            layer.confirm('你确定要操作吗？',{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.post("<?=\yii\helpers\Url::to(['admin/operate'])?>",{id:id},function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:1,time:1000},function(){
                            window.location.href="<?=\yii\helpers\Url::to(['admin/index']);?>";
                        });
                    }else{
                        layer.msg(res.body,{icon:2,time:1000});
                    }
                },'json')
            })
        });
        $('.del').click(function(){
            var id=$(this).attr('id');
            layer.confirm('你确定要删除吗？',{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.post("<?=\yii\helpers\Url::to(['admin/del'])?>",{id:id},function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:1,time:1000},function(){
                            window.location.href="<?=\yii\helpers\Url::to(['admin/index']);?>";
                        });
                    }else{
                        layer.msg(res.body,{icon:2,time:1000});
                    }
                },'json')
            })
        })
    })
</script>
<!--<script type="text/javascript">
    //删除
    function del(aid){
        layer.confirm("你确定要删除我吗？",{
            icon:3,
            title:'提示',
            btn:['确定','取消']
        },function(){
            $.get("{:U('Admin/del')}","id="+aid,function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Admin/showlist')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }

            },'json')
        })
    }
    //禁用
    function disabled(aid){
        layer.confirm("你确定要禁用我吗？",{
            icon:3,
            title:'提示',
            btn:['确定','取消']
        },function(){
            $.get("{:U('Admin/disabled')}","id="+aid,function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Admin/showlist')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }

            },'json')
        })
    }
    //启用
    function enabled(aid){
        layer.confirm("你确定要启用我吗？",{
            icon:3,
            title:'提示',
            btn:['确定','取消']
        },function(){
            $.get("{:U('Admin/enabled')}","id="+aid,function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Admin/showlist')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }

            },'json')
        })
    }
</script>-->
</html>
<?php $this->endPage() ?>
