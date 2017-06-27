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
    <?=\yii\helpers\Html::jsFile('@web/js/kindeditor/kindeditor-all-min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.form.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/timer/WdatePicker.js')?>

    <?=\yii\helpers\Html::cssFile('@web/sale/css/jquery-ui-1.8.17.custom.css')?>
    <?=\yii\helpers\Html::cssFile('@web/sale/css/jquery-ui-timepicker-addon.css')?>
    <?=\yii\helpers\Html::jsFile('@web/sale/js/jquery-ui-1.8.17.custom.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/sale/js/jquery-ui-timepicker-addon.js')?>
    <?=\yii\helpers\Html::jsFile('@web/sale/js/jquery-ui-timepicker-zh-CN.js')?>

    <script type="text/javascript">
        $(function () {

            $(".ui_timepicker").datetimepicker({
                //showOn: "button",
                //buttonImage: "./css/images/icon_calendar.gif",
                //buttonImageOnly: true,
                showSecond: true,
                timeFormat: 'hh:mm:ss',
                stepHour: 1,
                stepMinute: 1,
                stepSecond: 1
            })
        })
    </script>
    <!--更改结束-->

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
    <style type="text/css">
        .logobox{ width:200px; height:130px; border:1px solid #dddddd; margin-left:90px;}
        .resizebox{ width:180px; height:110px; border:1px solid #dddddd;margin:10px; }


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
        <div id="tab1" class="tabson">
            <form id="form1" action="#">
                <ul class="forminfo">
                        <li><label>商品名称<b>*</b></label>
                            <input name="goodsname" type="text"  class="dfinput" disabled value="<?=\yii\helpers\Html::encode($info['goods']['goodsname'])?>"  style="width:300px;"/>
                        </li>
                    <input type="hidden" value="<?=\yii\helpers\Html::encode($info['id'])?>" name="id"/>
                        <li>
                            <div class="logobox">
                                <div class="resizebox">
                                    <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($info['goods']['pic'])?>" alt="" height="110px" width="180px"  />
                                </div>
                            </div>
                        </li>
                        <li><label>开始时间<b>*</b></label>
                            <!--<input name="starttime" value="{:date('Y-m-d H:i:m',$list[0]['starttime'])}" type="text" onfocus="WdatePicker({isShowClear:false,readOnly:true})"  class="Wdate"  style="height:30px;"/>-->
                            <input type="text" name="starttime" class="ui_timepicker" value="<?=date('Y-m-d H:i:m',\yii\helpers\Html::encode($info['starttime']))?>">
                        </li>
                        <li><label>截止时间<b>*</b></label>
                            <input type="text" name="endtime" class="ui_timepicker" value="<?=date('Y-m-d H:i:m',\yii\helpers\Html::encode($info['endtime']))?>">
                            <!--<input class="Wdate" value="{:date('Y-m-d  H:i:m',$list[0]['endtime'])}" name="endtime" type="text" onfocus="WdatePicker({isShowClear:false,readOnly:true})"     style="height:30px;" />-->
                        </li>

                    <li><label>&nbsp;</label><input id="btn" type="button" class="btn" value="编辑发布"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('.btn').click(function(){
            $.post("<?=\yii\helpers\Url::to(['sale/edit'])?>",$('#form1').serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:6,time:2000},function(){
                        location="<?=\yii\helpers\Url::to(['sale/index'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:5,time:2000})
                }
            },'json')
        })
    })

    /*$(function(){
        $('#form1').submit(function() {
            $(this).ajaxSubmit(function(res) {

                if(res.status=="ok"){

                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="{:U('Sale/qianggou')}";
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }
            });
            return false; //阻止表单默认提交
        });

    })*/
</script>
