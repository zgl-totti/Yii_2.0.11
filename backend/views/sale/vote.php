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
                <form action="<?=\yii\helpers\Url::to(['sale/vote'])?>" method="get" id="form1">
                <li><label>综合查询</label><input value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" name="keywords" type="text" class="scinput" /></li>
                <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
                </form>
                <li style="border-radius:5px;float: right;height:34px;width:80px;background-color:#3994C7;text-align:center;line-height:34px;">
                    <a style="color:white;font-size:16px;" href="<?=\yii\helpers\Url::to(['sale/record'])?>">投票记录</a>
                </li>

            </ul>
            <table class="tablelist">
                <thead>
                <tr>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>图片</th>
                    <th>商品名</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>总票数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                <tr>
                    <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                    <td><img width="50" height="50" src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>"></td>
                    <td><?=\yii\helpers\Html::encode($v['goods']['goodsname']);?></td>
                    <td><?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v['starttime']))?></td>
                    <td><?=date("Y-m-d H:i:s",\yii\helpers\Html::encode($v['endtime']))?></td>
                    <td><?=\yii\helpers\Html::encode($v['votecount'])?></td>
                    <td>
                        <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink add">增加票数</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink reduce">减少票数</a>
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
            $('.add').click(function(){
                var id=$(this).attr('id');
                $.post("<?=\yii\helpers\Url::to(['sale/add-vote'])?>",{id:id},function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:6,time:2000},function(){
                            location="<?=\yii\helpers\Url::to(['sale/vote'])?>";
                        })
                    }else{
                        layer.msg(res.body,{icon:5,time:2000})
                    }
                },'json')
            })
            $('.reduce').click(function(){
                var id=$(this).attr('id');
                $.post("<?=\yii\helpers\Url::to(['sale/reduce'])?>",{id:id},function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:6,time:2000},function(){
                            location="<?=\yii\helpers\Url::to(['sale/vote'])?>";
                        })
                    }else{
                        layer.msg(res.body,{icon:5,time:2000})
                    }
                },'json')
            })
        })
    </script>

    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
    <script type="text/javascript">
        //增加票数
        function add(id){
            $.get("{:U('Vote/addVote')}",{id:id},function(res){
                if(res.status=="ok"){
                    layer.msg("增加10票成功",{icon:1,time:2000},function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg("增加票数成功",{icon:1,time:2000})
                }
            })
        }
        //增加票数
        function jianshao(id){
            $.get("{:U('Vote/jianshao')}",{id:id},function(res){
                if(res.status=="ok"){
                    layer.msg("减10票成功",{icon:1,time:2000},function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg("减10票失败",{icon:2,time:2000})
                }
            })
        }
    </script>
</div>
</body>
</html>
