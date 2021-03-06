
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        *{margin:0;padding:0;list-style-type:none;}
        body{color:#666;font:12px/1.5 Arial;}
        /* star */
        #star{position:relative;width:500px;margin:20px auto;height:24px;}
        #star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
        #star ul{margin:0 10px;}
        #star li{float:left;width:24px;cursor:pointer;text-indent:-9999px;background:url(<?=\yii\helpers\Url::to('@web/images/star.png')?>) no-repeat;}
        #star strong{color:#f60;padding-left:10px;}
        #star li.on{background-position:0 -28px;}
        #star p{position:absolute;top:20px;width:159px;height:60px;display:none;background:url(<?=\yii\helpers\Url::to('@web/images/icon.gif')?>) no-repeat;padding:7px 10px 0;}
        #star p em{color:#f60;display:block;font-style:normal;}
        #btn{margin-left:140px;width:70px;height: 35px;font-size: 20px;font-weight: bolder;font-family: '微软雅黑';border-radius: 10px;background: #2b2b2d;color: #fff;}
        #btn:hover{background: #80808f;}
        .text{margin:10px 50px;}
    </style>
    <?=\yii\helpers\Html::cssFile('@web/webuploader/0.1.5/webuploader.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/layer/layer.js')?>
    <?=\yii\helpers\Html::jsFile('@web/webuploader/0.1.5/webuploader.js')?>
    <?=\yii\helpers\Html::jsFile('@web/webuploader/upload.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.form.js')?>

    <script type="text/javascript">
        var uploadUrl = '{:U("uploadGoodsPic")}';
        var listUrl = '{:U("commentlist")}';

        window.onload = function (){
            var oStar = document.getElementById("star");
            var aLi = oStar.getElementsByTagName("li");
            var oUl = oStar.getElementsByTagName("ul")[0];
            var oSpan = oStar.getElementsByTagName("span")[1];
            var oP = oStar.getElementsByTagName("p")[0];
            var i = iScore = iStar = 0;
            var aMsg = [
                "很不满意|与卖家描述的严重不符，非常不满",
                "不满意|与卖家描述的不符，不满意",
                "一般|质量一般，没有卖家描述的那么好",
                "满意|与卖家描述的基本一致，还是挺满意的",
                "非常满意|与卖家描述的完全一致，非常满意"
            ]
            for (i = 1; i <= aLi.length; i++){
                aLi[i - 1].index = i;
                //鼠标移过显示分数
                aLi[i - 1].onmouseover = function (){
                    fnPoint(this.index);
                    //浮动层显示
                    oP.style.display = "block";
                    //计算浮动层位置
                    oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
                    //匹配浮动层文字内容
                    oP.innerHTML = "<em><b>" + this.index + "</b> 分 " + aMsg[this.index - 1].match(/(.+)\|/)[1] + "</em>" + aMsg[this.index - 1].match(/\|(.+)/)[1]
                };
                //鼠标离开后恢复上次评分
                aLi[i - 1].onmouseout = function (){
                    fnPoint();
                    //关闭浮动层
                    oP.style.display = "none"
                };
                //点击后进行评分处理
                aLi[i - 1].onclick = function (){
                    iStar = this.index;
                    oP.style.display = "none";
                    oSpan.innerHTML = "<strong>" + (this.index) + " 分</strong> (" + aMsg[this.index - 1].match(/\|(.+)/)[1] + ")"
                }
            }
            //评分处理
            function fnPoint(iArg){
                iScore = iArg || iStar;     //分数赋值
                for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";}
        };
    </script>
</head>
<body>
<form action="<?=\yii\helpers\Url::to(['personal/comment-goods'])?>" method="post" id="form1">
    <div id="star">
        <span>请对商品打分</span>
        <ul>
            <li><a href="javascript:;">1</a></li>
            <li><a href="javascript:;">2</a></li>
            <li><a href="javascript:;">3</a></li>
            <li><a href="javascript:;">4</a></li>
            <li><a href="javascript:;">5</a></li>
        </ul>
        <span id="start"></span>
        <p></p>
    </div>
    <input name="gid" type="hidden" value="<?=\yii\helpers\Html::encode($gid)?>"/>
    <input name="oid" type="hidden" value="<?=\yii\helpers\Html::encode($oid)?>"/>
    <!--这放图片-->

    <ul>
        <li style="margin-left: 50px;">
            <label>可传图片</label>
            <div class="uploader-list-container vocation" style="width: 525px;border:0px;">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker-2"></div>
                        <p>或将照片拖到这里，单次最多可选3张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
                    <div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div>
                        <div class="uploadBtn" style="display: none">开始上传</div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <!--图片-->
    <textarea class="text" cols="45" rows="13" name="commentcontent" ></textarea><br />
    <!--<input type="button" id="btn" value="提交">-->
    <input type="submit" id="btn" value="提交">
</form>
</body>

<script>
    $('#btn').click(function(){
        var start = $('#start').html();
        $("#star").append("<input type='hidden' name='start' value='"+start.substr(8,1)+"'>");
        $('form').ajaxSubmit(function(res){
            if(res.code==1){
                if($('.imgWrap').html()){
                    $('.uploadBtn').click();
                };
                layer.msg(res.msg, {icon:1}, function(){
                        parent.location.reload();
                        parent.layer.closeAll();}
                );
            }else if(res.status=="cnull"){
                layer.msg(res.msg,{icon:1,time:1000})
            }else{
                layer.msg(res.msg,{icon:2});
            }
        })
        return false;
    })
</script>

<!--<script>
    $(function(){
        $("#btn").click(function(){
            var start = $('#start').html();
            $("#star").append("<input type='hidden' name='start' value='"+start.substr(8,1)+"'>");
            $.post("{:U('Personal/commentlist')}",$("#form1").serialize(),function(res){ //将form1中数据提交到后台
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        parent.location.href="{:U('Personal/comment')}";
                    })
                }
                else if(res.status=="cnull"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        parent.location.href="{:U('Personal/comment')}";
                    })
                }
                else {
                    layer.msg(res.msg,{icon:2});
                }
            })
        })
    })
</script>-->
</html>
