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
    <?=\yii\helpers\Html::jsFile('@web/js/timer/WdatePicker.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.form.js')?>

    <style type="text/css">
        #page a,#page span{
            display: inline-block;width: 18px;height: 18px;padding: 5px;margin: 2px;text-decoration: none;background: #f0ead8;
            color: #009900;border: 1px solid #c9e2b3;
        }
        #page a:hover{
            background: #333;
            color: #fff;
        }
        #page span {
            background: #333;
            color: #fff;
            font-weight: bold;
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
            <ul class="seachform">
                <form action="<?=\yii\helpers\Url::to(['sale/index'])?>" method="get">
                    <li><label>开始时间:</label>
                        <input class="Wdate" value="<?=\yii\helpers\Html::encode($time1?$time1:'')?>" name="starttime" type="text" onfocus="WdatePicker({isShowClear:false,readOnly:true})" style="height:30px;" />
                    </li>
                    <li><label>结束时间:</label>
                        <input class="Wdate" value="<?=\yii\helpers\Html::encode($time2?$time2:'')?>" name="endtime" type="text" onfocus="WdatePicker({isShowClear:false,readOnly:true})" style="height:30px;" />
                    </li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
                </form>
            </ul>
            <table class="tablelist">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>商品标题</th>
                    <th>商品图片</th>
                    <th>抢购开始</th>
                    <th>抢购结束</th>
                    <th>投票操作</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></td>
                        <td><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic'])?>" alt="" height="100px" width="100px"/></td>
                        <td><?php if(\yii\helpers\Html::encode($v['starttime'])):
                                        echo date('Y-m-d H:i:m',\yii\helpers\Html::encode($v['starttime']));
                                    else:
                                        echo '未设置';
                                    endif;?>
                        </td>
                        <?php if(\yii\helpers\Html::encode($v['endtime'])): ?>
                            <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['endtime']))?></td>
                        <?php else: ?>
                            <td>未设置</td>
                        <?php endif;?>
                        <td><a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate"><?=\yii\helpers\Html::encode($v['addvote'])==0?'加入':'禁用';?></a></td>
                        <td>
                            <a href="<?=\yii\helpers\Url::to(['sale/detail','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?=\yii\helpers\Url::to(['sale/edit','id'=>\yii\helpers\Html::encode($v['id'])])?>" class="tablelink">设置</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>

            <!--<div class="pagin">
                <div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
                <ul class="paginList">
                    <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
                    <li class="paginItem"><a href="javascript:;">1</a></li>
                    <li class="paginItem current"><a href="javascript:;">2</a></li>
                    <li class="paginItem"><a href="javascript:;">3</a></li>
                    <li class="paginItem"><a href="javascript:;">4</a></li>
                    <li class="paginItem"><a href="javascript:;">5</a></li>
                    <li class="paginItem more"><a href="javascript:;">...</a></li>
                    <li class="paginItem"><a href="javascript:;">10</a></li>
                    <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
                </ul>
            </div>-->

            <div id="page" style="margin-top: 20px; float: right"><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm("你确定要更改投票状态吗？",{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['sale/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['sale/index'])?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
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
</html>
<script type="text/javascript">
    //禁用
    function disabled(id){
        layer.confirm("你确定要禁用投票吗？",{
            icon:3,
            title:'提示',
            btn:['确定','取消']
        },function(){
            $.get("{:U('Sale/disabled')}","id="+id,function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Sale/qianggou')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }

            },'json')
        })
    }
    //启用
    function enabled(bid){
        layer.confirm("你确定要加入投票吗？",{
            icon:3,
            title:'提示',
            btn:['确定','取消']
        },function(){
            $.get("{:U('Sale/enabled')}","id="+bid,function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Sale/qianggou')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }

            },'json')
        })
    }
</script>
