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
            <form action="#" id="form1">
                <ul class="forminfo">
                    <li><label>新闻标题<b>*</b></label><input name="title" type="text" class="dfinput" placeholder="请填写新闻标题"  style="width:200px;"/></li>
                    <li><label>新闻作者<b>*</b></label><input name="author" type="text" class="dfinput" placeholder="请填写作者名称"  style="width:200px;"/></li>
                    <li><label>新闻内容<b>*</b></label><textarea name="content" rows="10" cols="50" style="border: 1px solid lightblue"></textarea></li>
                    <li><label>&nbsp;</label><input name="" type="button" class="btn" value="马上发布"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        $(".btn").click(function(){
            $.post("<?=\yii\helpers\Url::to(['news/add'])?>",$("#form1").serialize(),function(res){
                if(res.code==1){
                    layer.confirm(res.body,{icon:1,btn:["继续","算了"]},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['news/add'])?>";
                    },function(){
                        window.location.href="<?=\yii\helpers\Url::to(['news/index'])?>";
                    })
                }else {
                    layer.msg(res.body,{icon:2})
                }
            },'json');
        })
    })
</script>
</html>
