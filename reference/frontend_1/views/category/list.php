<?= \yii\helpers\Html::csrfMetaTags() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>列表页</title>
</head>
<body>
	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">分类管理</a></li>
        </ul>
    </div>
    <div class="formbody">
    <div id="usual1" class="usual">
  	<div id="tab2" class="tabson">
        <form action="" method="get">
            <ul class="seachform">
                <li>
                    <label>按名称查询</label><input name="keywords" type="text" value="<?=$keywords?>" class="scinput" />
                </li>
                <li>
                    <label>按时间时间：</label><input name="addtime" type="text" value="<?=$addtime?>" class="scinput" />
                </li>
                <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
                <li><label>&nbsp;</label>
                    <input type="button" class="scbtn" id="exportdata" value="Excel表导出" style="width: 90px;height: 35px;margin:0;padding: 0;"/></li>
            </ul>
        </form>

    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input name="" type="checkbox" value="" checked="checked"/></th>
            <th>编号</th>
            <th>分类名称</th>
            <th>分类Id</th>
            <th>上级分类</th>
            <th>分类父Id</th>
            <th>添加时间</th>
            <th>是否展示</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($list as $k=>$val) :
                    ?>
                    <tr>
                        <td><input name="" type="checkbox" value=""/></td>
                        <td><?= $pages->page*$pages->pageSize+$k+1; ?></td>
                        <td><?= $val['cname'] ?></td>
                        <td><?= $val['id'] ?></td>
                        <td><?= $val['path'] ?></td>
                        <td><?= $val['pid'] ?></td>
                        <td><?= date('Y-m-d H:i:s', $val['addtime']) ?></td>
                        <td class="zhuangtai"><?= $val['show'] ? '展示' : '下架' ?></td>
                        <td class="par">
                            <a href="javascript:;" pid="<?= $val['pid'] ?>" id="<?= $val['id'] ?>"
                               class="tablelink click"><?= $val['show'] ? '下架' : '展示' ?></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?= \yii\helpers\Url::to(['edit', 'id' => $val['id']]) ?>"
                               class="tablelink">编辑</a>
                        </td>
                    </tr>
                <?php
                endforeach;
            ?>
        </tbody>
    </table>
        <?=\yii\widgets\LinkPager::widget(['pagination' => $pages]);?>
	</div>
    </div>
        <p>总记录数：<?=$pages->totalCount;?></p>
        <p>每页数量：<?=$pages->pageSize;?></p>
        <p>总页数：<?=$pages->pageCount;?></p>
        <p>当前页：<?=$pages->page+1;?></p>
        <p>每页开始数：<?=$pages->limit;?></p>
        <p>每页开始数：<?=$pages->page*$pages->pageSize;?></p>
        <p>当前页：<?php print_r($pages);?></p>
    </div>
</body>
</html>
<script type="text/javascript">
    <?php $this->beginBlock('test') ?>
    $(function() {
        $('.click').click(function(){
            var id=$(this).attr('id');
            var pid=$(this).attr('pid');
            layer.confirm('确定要更改分类状态吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("<?=\yii\helpers\Url::to(['show'])?>",{id:id,pid:pid},function(res){
                    if(res.status==1){
                        layer.msg(res.info,{icon:6});
                    }else{
                        layer.msg(res.info,{icon:5});
                    }
                },'json');
            });
        })
    });
    <?php $this->endBlock() ?>
    <?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>

    /*$(function(){
        $('.click').click(function(){
            id=$(this).attr('id');
            pid=$(this).attr('pid');
            layer.confirm('确定要更改分类状态吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{:url('Category/updateshow')}",{id:id,pid:pid},function(res){
                    if(res.status==1){
                        layer.msg(res.info,{icon:6},function(){
                            location="{:url('Category/index')}";
                        });
                    }else{
                        layer.msg(res.info,{icon:5});
                    }
                },'json');
            });
        })
    })*/
</script>
