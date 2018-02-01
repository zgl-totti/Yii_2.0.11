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
            <form action="<?=\yii\helpers\Url::to(['auction/bidding'])?>" method="get">
                <ul class="seachform">
                    <li><label>综合查询</label><input value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" name="keywords" type="text" class="scinput" /></li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
                </ul>
            </form>
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>图片</th>
                    <th>商品名称</th>
                    <th>竞拍人</th>
                    <th>竞拍价格</th>
                    <th>竞拍时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><input name="" type="checkbox" value="" /></td>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><img width="50" height="50" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic'])?>" alt=""/></td>
                        <td><?=\yii\helpers\Html::encode($v['goodsname'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['member']['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['auctionprice'])?></td>
                        <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
                        <td>
                            <a href="#" class="tablelink del" id="<?=\yii\helpers\Html::encode($v['id'])?>">删除</a>
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
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm("你确定要删除我吗？",{btn:['确定','取消']},function(){
                    $.post("<?=\yii\helpers\Url::to(['auction/bidding-del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:2000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['auction/bidding'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:2})
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
        //删除
        function del(id){
            layer.confirm("你确定要删除我吗？",{btn:['确定','取消']},function(){
                $.get("{:U('Auction/del')}",{id:id},function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:2000},function(){
                            window.location.href="{:U('Auction/recordList')}";
                        })
                    }else{
                        layer.alert(res.msg,{icon:2})
                    }
                })
            })
        }
    </script>
</div>
</body>
</html>
