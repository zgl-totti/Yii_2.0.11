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
                <li><label>新闻标题<b>*</b></label><input disabled="disabled" name="title" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['news']['title'])?>"  style="width:200px;"/></li>
                <li><label>评论者<b>*</b></label><input disabled="disabled" name="author" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['member']['username'])?>"  style="width:200px;"/></li>
                <li><label>评论内容<b>*</b></label><textarea disabled="disabled" name="content" rows="10" cols="50" style="border: 1px solid lightblue"><?=\yii\helpers\Html::encode($info['commentcontent'])?></textarea></li>
                <li><label>回复者<b>*</b></label><input disabled="disabled" name="author" type="text" class="dfinput" value="admin"  style="width:200px;"/></li>
                <li><label>回复内容<b>*</b></label><textarea disabled="disabled" name="content" rows="10" cols="50" style="border: 1px solid lightblue"><?=\yii\helpers\Html::encode($info['replycontent'])?></textarea></li>
                <li><label>&nbsp;</label><input onclick="clickBtn()" type="button" class="btn" value="返回"/></li>
            </ul>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function clickBtn(){
        window.location.href="<?=\yii\helpers\Url::to(['news/comment'])?>";
    }
</script>
</html>
