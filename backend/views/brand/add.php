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
    <style type="text/css">
        .logobox{ width:200px; height:130px; border:1px solid #dddddd; margin-left:150px;}
        .resizebox{ width:180px; height:110px; border:1px solid #dddddd;margin:10px; }
        .textarea{ width:400px; height:200px; resize: none;border:1px solid #dddddd;  }
        .wordage{color:#999;  margin-top:10px;}
        .wordage span{float: left}
        .btn{margin-left: 5%;margin-top:10px}
        #pic{
            width:100px;
            height:100px;
            border-radius:50% ;
            margin:20px auto;
            cursor: pointer;
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
        <div id="tab1" class="tabson">
            <form id="form1" action="<?=\yii\helpers\Url::to(['brand/add'])?>" method="post" enctype="multipart/form-data">
                <ul class="forminfo">
                    <li><label>品牌名称<b>*</b></label><input name="bname" type="text" onclick="this.value=''" class="dfinput" placeholder="请填写品牌名称"  style="width:450px;"/></li>
                    <li><label>品牌LOGO<b>*</b></label>
                        <div class="logobox">
                            <div class="resizebox">
                                <img id="img0" src="<?=\yii\helpers\Url::to('@web/uploads/default.png')?>" width="180px" height="110px"/>
                            </div>
                        </div>
                        <input id="file0"  type="file" name="pic" style=" margin-left:150px; margin-top:15px;"/>
                    </li>
                    <li><label>描述<b>*</b></label>
                        <div class="vocation">
                            <textarea name="description" cols="" rows="" class="textarea" onkeyup="checkLength(this);"></textarea>
                            <div class="wordage"><span>剩余字数：</span><span id="sy" style="color:Red;">500</span>&nbsp;字</div>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input id="btn" name="" type="submit" class="btn" value="马上发布"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
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
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $(".left_add").height($(window).height()-60);
        //当文档窗口发生改变时 触发
        $(window).resize(function(){
            $(".left_add").height($(window).height()-60);
        });
    })
    function checkLength(which) {
        var maxChars = 500;
        if(which.value.length > maxChars){
            layer.open({
                icon:2,
                title:'提示框',
                content:'您出入的字数超多限制!'
            });
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; // 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    }
</script>
<script type="text/javascript">
    $(function(){
        $('#form1').submit(function() {
            $(this).ajaxSubmit(function(res) {
                if(res.code==1){
                    layer.confirm(res.body,{icon:3,btn:['确定','取消']},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['brand/add'])?>";
                    },function(){
                        window.location.href="<?=\yii\helpers\Url::to(['brand/index'])?>";
                    });
                }else{
                    layer.msg(res.body,{icon:2,time:1000});
                }
            });
            return false; //阻止表单默认提交
        });
    })
</script>
