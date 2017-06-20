<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>列表页</title>

    <link href="__PUBLIC__/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/Admin/css/select.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="__PUBLIC__/Admin/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Admin/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Admin/js/select-ui.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Admin/js/layer/layer.js"></script>


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
    <style type="text/css">
        .catepage{
            float: right;
            margin-top:30px ;
        }
        .catepage a{
            border-radius: 50px;
            margin: 2px;
            width: 25px;
            height: 25px;
            line-height: 25px;
            border: 1px solid #ccc;
            display: inline-block;
            text-align: center;
            background-color:#3C95C8 ;
            padding: 5px;
            font-weight: bolder;

        }
        .catepage a:hover{
            background-color: white;
            color: #00aaee;
            font-weight: bolder;
        }
        .current{
            border-radius: 50px;
            width: 25px;
            height: 25px;
            border: 1px solid #ccc;
            line-height: 23px;
            display: inline-block;
            padding: 5px;
            text-align: center;
        }
        .tablelist tr th{
            text-align: center;
        }
    </style>
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
    <form action="<?=\yii\helpers\Url::to(['member/index'])?>" method="get" id="selForm">
        <ul class="seachform">

            <li><label>综合查询</label><input name="keywords" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" type="text" class="scinput" /></li>
            <li><label>&nbsp;</label><input name="sub" type="submit" class="scbtn" value="查询"/></li>

        </ul>
    </form>

    <table class="tablelist" style="text-align: center">

        <tr>
            <th>编号</th>
            <th>id</th>
            <th>会员名</th>
            <th>状态</th>
            <th>添加时间</th>
            <th>性别</th>
            <th>等级</th>
            <th>余额</th>
            <th>花费</th>
            <th>积分</th>
            <th>状态控制</th>

        </tr>
        <?php foreach($list as $k=>$v): ?>
            <tr>
                <td width="80px"><?=$pages->page*$pages->pageSize+$k+1;?></td>
                <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                <td><?=(\yii\helpers\Html::encode($v['active'])==0)?'已禁用':'已启用';?></td>
                <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>

                <?php if(\yii\helpers\Html::encode($v['gender'])==0): ?>
                <td>男</td>
                <?php elseif(\yii\helpers\Html::encode($v['gender'])==1): ?>
                <td>女</td>
                <?php else: ?>
                <td>保密</td>
                <?php endif;?>

                <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                <td>
                    <a href="<?=\yii\helpers\Url::to(['member/detail','id'=>$v['id']])?>">详情</a>
                    <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate"><?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?></a>
                    <a href="<?=\yii\helpers\Url::to(['member/del','id'=>$v['id']])?>" class="tablelink del" style="color:red">删除</a></td>
            </tr>
        <?php endforeach;?>
    </table>
        <div class="catepage">
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
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm('确定要更改状态吗？',{
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['member/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:1000},function(){
                                href="<?=\yii\helpers\Url::to(['member/index'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:1000})
                        }
                    },'json')
                })
            })
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm('确定要删除吗？',{
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['member/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:1000},function(){
                                href="<?=\yii\helpers\Url::to(['member/index'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:1000})
                        }
                    },'json')
                })
            })
        })
	</script>
    </div>
</body>
    <script type="text/javascript">
        //禁用
        function disabled(aid){
            layer.confirm("确定禁用？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/disabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }
                },'json')
            })
        }
        //启用
        function enabled(aid){
            layer.confirm("确定启用？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/enabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        //删除
        function del(aid){
            layer.confirm("确定删除？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/del')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>
</html>
