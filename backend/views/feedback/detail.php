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
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.form.js')?>
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
                    <input name="id" id="id" type="hidden" value="<?=\yii\helpers\Html::encode($info['id'])?>">
                    <li><label>用户名<b>*</b></label><input disabled name="username" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['username'])?>"  style="width:345px;"/></li>
                    <li><label>评论时间<b>*</b></label><input disabled name="addtime" type="text" class="dfinput" value="<?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info['addtime']))?>" style="width: 345px;"></li>
                    <li><label>评论内容<b>*</b></label><textarea disabled rows="15" cols="55" style="border: 1px solid #a9a9a9;margin-top: 10px;"><?=\yii\helpers\Html::encode($info['content'])?></textarea></li>
                    <div style="border-bottom:1px dashed #a9a9a9;width: 100%;height: 20px;margin-bottom: 20px;"></div>
                    <li><label>管理员<b>*</b></label><input disabled name="admin" value="<?=\yii\helpers\Html::encode($info['feedback_admin'])?>" type="text" class="dfinput" style="width: 345px"></li>
                    <li><label>回复内容<b>*</b></label>
                        <textarea name="reply" id="reply" rows="15" cols="55" style="border: 1px solid #a9a9a9;margin-top: 10px;"><?=\yii\helpers\Html::encode($info['reply'])?></textarea>
                    </li>
                    <li><label>&nbsp;</label><input onclick="myfun()" type="button" class="btn" value="返回"/>
                        <label>&nbsp;</label><input type="button" class="btn" id="btn" value="提交" style="margin-left: 20px;"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function myfun(){
        window.location.href="<?=\yii\helpers\Url::to(['feedback/index'])?>";
    }
    $(function(){
        $('#btn').click(function(){
            $.post("<?=\yii\helpers\Url::to(['feedback/detail'])?>",$('#form1').serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:6,time:2000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['feedback/index'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:5,time:2000})
                }
            },'json')
        })
    })
    /*$(function(){
        $('#btn').click(function(){
            $('form').ajaxSubmit(function(res){
                if(res.status==1){layer.msg(res.msg, {icon:2,time:1000});}
                else if(res.status==2){layer.msg(res.msg,{icon:2,time:1000})}
                else{layer.msg(res.msg, {icon:1,time:1000},function(){
                    location.href="{:U('Feedback/showlist')}";
                });}
            })
            return false;
        })
        })*/
</script>
</html>