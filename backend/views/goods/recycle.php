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
        <li><a href="#">系统设置</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <form action="<?=\yii\helpers\Url::to(['goods/recycle'])?>" method="get">
                <ul class="seachform">
                    <li><label>综合查询</label><input name="keywords" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
                </ul>
            </form>
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>商品分类</th>
                    <th>商品品牌</th>
                    <th>市场价格</th>
                    <th>商城价格</th>
                    <th>库存量</th>
                    <th>销售数量</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><input name="" type="checkbox" value="" /></td>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic']);?>" width="50px" height="50px" alt=""/></td>
                        <td><?=mb_substr(\yii\helpers\Html::encode($v['goodsname']),0,20,'utf-8');?></td>
                        <td><?=\yii\helpers\Html::encode($v['cate']['catename'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['brand']['bname'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['marketprice'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['price'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['num'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['salenum'])?></td>
                        <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink recover">恢复</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>
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
            $('.recover').click(function(){
                var id=$(this).attr('id');
                layer.confirm("是否要恢复数据？",{icon:3,title:'恢复'},function(){
                    $.post("<?=\yii\helpers\Url::to(['goods/recover'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['goods/recycle'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:1000});
                        }
                    },'json')
                })
            })
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm("确定要删除吗？",{icon:3,title:'删除'},function(){
                    $.post("<?=\yii\helpers\Url::to(['goods/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['goods/recycle'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:1000});
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
<script type="text/javascript">
    function regain(gid){
        layer.confirm("是否要恢复数据",{icon:3,title:'恢复'},function(){
            $.get("{:U('Goods/regain')}",'id='+gid,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:6,time:1000},function(){
                        window.location.href="{:U('Goods/recycle')}";
                    })
                }else{
                    layer.msg(res.msg,{icon:5,time:1000});
                }
            },'json')
        })
    }
    function del(gid){
        layer.confirm('确定彻底删除',{icon:6,title:'删除'},function(){
            $.get("{:U('Goods/del')}","id="+gid,function(res){
                if(res.status=='ok'){
                    layer.msg(res.msg,{icon:1,time:1000},function(){})
                    window.location.href="{:U('Goods/recycle')}";
                }else{
                    layer.msg(res.msg,{icon:2,time:1000})
                }
            },'json')
        })
    }
</script>
</html>
