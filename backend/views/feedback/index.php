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
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.form.js')?>

    <style type="text/css">
        body .demo-class .layui-layer-title{background:#3fafe1; color: #333 border: none;}
        body .demo-class .layui-layer-btn{border-top:1px solid #E9E7E7}
        body .demo-class .layui-layer-btn a{background:#333;}
        body .demo-class .layui-layer-btn .layui-layer-btn1{background:#999;}
        body .demo-class {width: 500px;height: 300px;}
        .page{  float: right;  }
        .page a,.page span{  display: inline-block;  background: #2096cd;  margin-left: 5px;  width: 24px;  height: 24px;  text-align: center;  line-height: 24px;  font-weight: bolder;  }
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
        <li><a href="#">系统设置</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <form action="<?=\yii\helpers\Url::to(['feedback/index'])?>" method="get">
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
                    <th>是否回复</th>
                    <th>反馈时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><input name="" type="checkbox" value="" /></td>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=(\yii\helpers\Html::encode($v['reply']))?'已回复':'未回复';?></td>
                        <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
                        <td>
                            <a href="<?=\yii\helpers\Url::to(['feedback/detail','id'=>$v['id']])?>" class="tablelink">查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="pagin">
                <!--<div class="message" style="display: block;width: 300px;height: 30px;float: left;font-size: 14px;font-weight: bolder">共<i class="blue">{$count}</i>条记录，当前显示第&nbsp;<i class="blue">
                    <if condition="$p eq 0 ">
                        1
                        <else />
                        {$p}
                    </if>
                </i>页</div>-->
                <div class="page" style="display: block;float: right;">
                    <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
    <script type="text/javascript">
        $(function(){
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm('确定删除吗?',{icon:2,title:'提示'},function(){
                    $.post("<?=\yii\helpers\Url::to(['feedback/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['feedback/index'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            })
        })
    </script>
</div>
</body>
<script type="text/javascript">
    //删除
    function del(id){
        layer.confirm('确定删除?',{icon:2,title:'提示'},function(){
            $.get("{:U('Feedback/del')}","id="+id,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Feedback/showlist')}";
                    })
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }
            })
        })
    }
</script>
</html>