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
    <?=\yii\helpers\Html::jsFile('@web/js/timer/WdatePicker.js')?>
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
                    <input type="hidden" name="id" value="<?=\yii\helpers\Html::encode($info['id'])?>" />
                    <li><label>商品名称<b>*</b></label>
                        <input disabled="disabled" name="" type="text" value="<?=\yii\helpers\Html::encode($info['goods']['goodsname'])?>" class="dfinput" style="width:518px;"/>
                    </li>
                    <li>
                        <label>商品图片<b>*</b></label>
                        <div class="imagBox ">
                            <div class="imgsml">
                                <img id="img0"  src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($info['goods']['pic']);?>" alt="" width="150px" height="100px"/>
                            </div>
                        </div>
                        <!--<input id="file0" style="margin-left: 85px;margin-top: 10px;  " type="file" name="pic"/>-->
                    </li>
                    <li><label>开始时间<b>*</b></label>
                        <!--<input id="d11" style="border:1px;" type="text" onClick="WdatePicker()" />-->
                        <input id="d11" name="starttime" onClick="WdatePicker()" type="text" class="dfinput" style="height:20px;width:146px;" value="<?=date('Y-m-d',\yii\helpers\Html::encode($info['starttime']))?>"/>
                    </li>
                    <li><label>结束时间<b>*</b></label><input name="endtime" class="Wdate" type="text" id="d15" onFocus="WdatePicker({isShowClear:false,readOnly:true})" value="<?=date('Y-m-d',\yii\helpers\Html::encode($info['endtime']))?>"/></li>
                    <li><label>&nbsp;</label><input id="sub" type="button" class="btn" value="确认设置"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        //设置拍卖时间
        $("#sub").click(function(){
            $.post("<?=\yii\helpers\Url::to(['auction/settime'])?>",$("#form1").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:2000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['auction/index'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:2000})
                }
            },'json')
        })
    })
</script>
<script type="text/javascript">
    $("#file0").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl) {
            $("#img0").attr("src", objUrl) ;
        }
    }) ;
    //建立一個可存取到該file的url
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
