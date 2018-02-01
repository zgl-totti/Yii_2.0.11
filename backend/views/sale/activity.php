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
                <form action="<?=\yii\helpers\Url::to(['sale/activity'])?>" method="get" >
                    <li><input type="hidden" name="activity" value="<?=\yii\helpers\Html::encode($activity)?>"/></li>
                    <li><label>商品查询</label><input name="keywords" type="text" class="scinput" value="<?=\yii\helpers\Html::encode($keywords?$keywords:'')?>" /></li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
                </form>
            </ul>
            <table class="tablelist">
                <thead>
                <tr>
                    <th>编号<i class="sort"><img src="<?=\yii\helpers\Url::to('@web/images/px.gif')?>" /></i></th>
                    <th>商品标题</th>
                    <th>商品图片</th>
                    <th>商品分类</th>
                    <th>商品品牌</th>
                    <th>市场价格</th>
                    <th>商品价格</th>
                    <th>库存</th>
                    <th>销量</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['goodsname'])?></td>
                        <td><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic'])?>" width="150px" height="150px" alt=""/></td>
                        <td><?=\yii\helpers\Html::encode($v['cate']['catename'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['brand']['bname'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['marketprice'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['price'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['num'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['salenum'])?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div id="page" style="margin-top: 20px; float: right"><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
    </div>
    <script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</div>
</body>
</html>

