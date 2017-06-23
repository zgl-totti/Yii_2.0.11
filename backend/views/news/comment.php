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

    <!--对layer.open弹层很重要-->
    <style type="text/css">
        body .demo-class .layui-layer-title{background:#ccc; color:gray; border: none;}
        body .demo-class .layui-layer-content{background:#ccc; color:white; border: none;}

        div.pagin{height:30px;float: right}
        div.pagin span{height: 30px;text-align: center;background-color:gray;line-height: 30px;width: 30px;display: inline-block}
        div.pagin a{height: 30px;text-align: center;background-color:orange;line-height: 30px;width: 30px;display: inline-block}
    </style>
    <!--对layer.open弹层很重要-->
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
    <form action="<?=\yii\helpers\Url::to(['news/comment'])?>" method="post" id="myform">
    <ul class="seachform">
    <li><label>综合查询</label><input name="keywords" type="text" class="scinput" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" /></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
    </ul>
    </form>
    <table class="tablelist">
    	<thead>
    	<tr>
        <th><input name="" type="checkbox" value="" checked="checked"/></th>
        <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
        <th>用户名</th>
        <th>新闻标题</th>
        <th>是否回复</th>
        <th>评论时间</th>
        <th>是否显示</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $k=>$v): ?>
        <tr>
        <td><input name="" type="checkbox" value="" /></td>
        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
        <td><?=\yii\helpers\Html::encode($v['member']['username'])?></td>
        <td><?=\yii\helpers\Html::encode($v['news']['title'])?></td>
            <td><?=\yii\helpers\Html::encode($v['isreply'])==1?'已回复':'未回复';?></td>
            <td><?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v['addtime']))?></td>
            <td><?=\yii\helpers\Html::encode($v['isshow'])==1?'显示':'隐藏';?></td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['news/comment-detail','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink">查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate"><?=\yii\helpers\Html::encode($v['isshow'])==1?'隐藏':'显示';?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if(\yii\helpers\Html::encode($v['isreply'])==0): ?>
                <a href="<?=\yii\helpers\Url::to(['news/reply','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink">回复</a>
            <?php endif;?>
        </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

       <div class="pagin">
        <!--<div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>-->
           <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
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
                    layer.confirm('确定要删除吗？',{
                        btn:['确定','取消']
                    },function(){
                        $.post("<?=\yii\helpers\Url::to(['news/comment-del'])?>",{id:id},function(res){
                            if(res.code==1){
                                layer.msg(res.body,{icon:6,time:2000},function(){
                                    location="<?=\yii\helpers\Url::to(['news/comment'])?>";
                                })
                            }else{
                                layer.msg(res.body,{icon:5,time:2000})
                            }
                        },'json')
                    })
                })
                $('.operate').click(function(){
                    var id=$(this).attr('id');
                    layer.confirm('确定要更改状态吗？',{
                        btn:['确定','取消']
                    },function(){
                        $.post("<?=\yii\helpers\Url::to(['news/comment-operate'])?>",{id:id},function(res){
                            if(res.code==1){
                                layer.msg(res.body,{icon:6,time:2000},function(){
                                    location="<?=\yii\helpers\Url::to(['news/comment'])?>";
                                })
                            }else{
                                layer.msg(res.body,{icon:5,time:2000})
                            }
                        },'json')
                    })
                })
            })
        </script>
    </div>
</body>
<script type="text/javascript">
    //回复
    function reply(cid){
        layer.open({
            type:2,
           title:"回复",
            skin:'demo-class',
            area:["400px","35%"],
            shadeClose: true,
            shade: 0.8,
            content:"{:U('replyNews')}?id="+cid
        })
    }
    //评论删除
    function commentDel(cid){
        layer.confirm("你确定要删除我吗？",{icon:3,title:'提示',btn:['确定','取消']},function(){
            $.get("{:U('NewsComment/commentDel')}","id="+cid,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('NewsComment/comment')}";
                    })
                }else {layer.msg(res.msg,{icon:2,time:1000})}
            },'json')
        });
    }
    //评论显示
    function commentShow(cid){
        $.get("{:U('NewsComment/commentShow')}","id="+cid,function(res){
            if(res.status=='ok'){
                layer.msg(res.msg,{icon:1,time:1000},function(){
                    window.location.href="{:U('NewsComment/comment')}";
                })
            }else {layer.msg(res.msg,{icon:2,time:1000})}
        },'json')
    }
    //评论隐藏
    function commentHide(cid){
            $.get("{:U('NewsComment/commentHide')}","id="+cid,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('NewsComment/comment')}";
                    })
                }else {layer.msg(res.msg,{icon:2,time:1000})}
            },'json')
    }
</script>
</html>
