<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/select.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.idTabs.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/select-ui.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>

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
        <div id="tab1" class="tabson">
            <ul class="forminfo">
                <li><label>用户名<b>*</b></label><input disabled name="username" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['member']['username'])?>" style="width:345px;"/></li>
                <li><label>商品名<b>*</b></label><input disabled name="goodsname" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['goods']['goodsname'])?>" style="width: 345px;"></li>
                <li><label>评论时间<b>*</b></label><input disabled name="addtime" type="text" class="dfinput" value="<?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']))?>" style="width: 345px;"></li>
                <li><label>评论内容<b>*</b></label><textarea disabled rows="15" cols="55" style="border: 1px solid #a9a9a9;margin-top: 10px;"><?=\yii\helpers\Html::encode($info['commentcontent'])?></textarea></li>
                <div style="border-bottom:1px dashed #a9a9a9;width: 100%;height: 20px;margin-bottom: 20px;"></div>
                <li><label>管理员<b>*</b></label><input disabled name="admin" value="admin" type="text" class="dfinput" style="width: 345px"></li>
                <li><label>回复内容<b>*</b></label><textarea disabled rows="15" cols="55" style="border: 1px solid #a9a9a9;margin-top: 10px;"><?=\yii\helpers\Html::encode($info['replycontent'])?></textarea></li>
                <li><label>&nbsp;</label><input onclick="myfun()" type="button" class="btn" value="返回"/></li>
            </ul>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function myfun(){
        window.location.href="<?=\yii\helpers\Url::to(['goods/comment'])?>";
    }
</script>
</html>