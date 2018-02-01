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
                <li style="font-size:18px;color:#3994C7;font-weight:bolder">投票记录总信息表</li>
                <!-- <li><label>综合查询</label><input name="" type="text" class="scinput" /></li>
                 <li><label>&nbsp;</label><input name="" type="button" class="scbtn" value="查询"/></li>-->
                <li style="border-radius:5px;float: right;height:34px;width:80px;background-color:#3994C7;text-align:center;line-height:34px;">
                    <a style="color:white;font-size:16px;" href="<?=\yii\helpers\Url::to(['sale/vote'])?>">返回</a>
                </li>
            </ul>
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>图片</th>
                    <th>商品名</th>
                    <th>投票IP</th>
                    <th>是否拉黑</th>
                    <th>投票时间</th>
                    <th>投票次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><input name="" type="checkbox" value="" /></td>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><img width="50" height="50" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic']);?>"></td>
                        <td><?=\yii\helpers\Html::encode($v['goodsname'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['ip'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['black'])==1?'已拉黑':'未拉黑';?></td>
                        <td><?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v['votetime']))?></td>
                        <td><?=\yii\helpers\Html::encode($v['votenum'])?></td>
                        <td>
                            <?php if(\yii\helpers\Html::encode($v['black'])==1): ?>
                                <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" status="1" class="tablelink operate">移出黑名单</a>
                            <?php else: ?>
                                <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" status="2" class="tablelink operate">加入黑名单</a>
                            <?php endif;?>
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
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                var status=$(this).attr('status');
                if(status==1){
                    var name='移出';
                }else if(status==2){
                    var name='加入';
                }
                layer.confirm('确定要'+name+'黑名单吗？',{
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['sale/black'])?>",{id:id,status:status},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:2000},function(){
                                location="<?=\yii\helpers\Url::to(['sale/record'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:2000})
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
    <script type="text/javascript">
        //加入黑名单
        function addBlack(id){
            $.get("{:U('Vote/addBlack')}",{id:id},function(res){
                if(res.status=="ok"){
                    layer.msg("拉黑成功",{icon:1,time:2000},function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg("拉黑失败",{icon:2,time:2000})
                }
            })
        }
        //移出黑名单
        function removeBlack(id){
            $.get("{:U('Vote/removeBlack')}",{id:id},function(res){
                if(res.status=="ok"){
                    layer.msg("移出成功",{icon:1,time:2000},function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg("移出失败",{icon:2,time:2000})
                }
            })
        }
    </script>
</div>
</body>
</html>
