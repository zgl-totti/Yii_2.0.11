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

    <style type="text/css">
        .cb{width: 30px;  height: 30px;margin:0 10px 0 0;  }
        .lb{width:150px;height: 70px;font-size: 30px;}
    </style>
    <script>
        var uploadUrl = '{:U("uploadGoodsPic")}';
        var listUrl = '{:U("showlist")}';
        KindEditor.ready(function(K) {
            K.create('#content7', {
                allowFileManager : true,
                afterBlur:function(){
                    this.sync('#content7');
                }
            });
            K.create('#content1', {
                allowFileManager : true,
                afterBlur:function(){
                    this.sync('#content1');
                }
            });
        });
    </script>
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
            //提交商品发布表单
            $('.btn').click(function(){
                $('form').ajaxSubmit(function(res){
                    if(res.status==1){
                        layer.msg(
                                res.info,
                                {icon:1},
                                function(){
                                    location.href="{:U('Integral/showlist')}";
                                }
                        );
                    }else{
                        layer.alert(res.info);
                    }
                })
                return false;
            })
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
            <form action="<?=\yii\helpers\Url::to(['integral/edit'])?>" method="post" enctype="multipart/form-data" id="form1">
                <ul class="forminfo">
                    <li><label>商品名称<b>*</b></label><input name="goodsname" value="<?=\yii\helpers\Html::encode($info['goodsname'])?>" type="text" class="dfinput" style="width:345px;"/></li>
                    <li>
                        <label>商品积分<b>*</b></label>
                        <input name="integral" type="text" value="<?=\yii\helpers\Html::encode($info['integral'])?>" class="dfinput" style="width: 525px;"/>
                    </li>

                    <li>
                        <label>库存数量<b>*</b></label>
                        <input name="num" type="text" value="<?=\yii\helpers\Html::encode($info['num'])?>" class="dfinput" style="width: 525px;"/>
                    </li>

                    <li>
                        <label>商品主图<b>*</b></label>
                        <div class="usercity" style="border:3px dashed #e6e6e6;width:520px;height:300px;position: relative">
                            <p id="preview0" ><img width="300" id="imghead0"  border=0 src="<?=\yii\helpers\Url::to('@web/uploads/integral/thumb350/350_').\yii\helpers\Html::encode($info['pic']);?>"></p><span></span>
                            <input type="file" id="image0" name="0" onchange="previewImage(this,'preview0','imghead0',300,300)" style="display:none;" >
                            <label for="image0"  style="margin:0;top:0;position:absolute;background:rgba(0,0,0,0.4);color:#fff;font-size:12px;text-align:center;border-radius:4px;width:60px;height:20px;line-height:20px;padding:3px 3px;cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">修改主图</label>
                        </div>
                    </li>
                    <li>
                        <label>商品图片<b>*</b></label>
                        <?php foreach($info['pics'] as $k=>$v): ?>
                            <div class="usercity" style="border:3px dashed #e6e6e6;width:170px;height:155px;margin:5px 0px;position: relative">
                                <p id="preview<?=\yii\helpers\Html::encode($v['id'])?>" >
                                    <img width="150" id="imghead<?=\yii\helpers\Html::encode($v['id'])?>"  border=0 src="<?=\yii\helpers\Url::to('@web/uploads/integral/thumb350/350_').\yii\helpers\Html::encode($v['picname']);?>">
                                </p><span></span>
                                <input type="file" id="image<?=\yii\helpers\Html::encode($v['id'])?>" name="<?=\yii\helpers\Html::encode($v['id'])?>" onchange="previewImage(this,'preview<?=\yii\helpers\Html::encode($v["id"])?>','imghead<?=\yii\helpers\Html::encode($v['id'])?>',150,150)" style="display:none;" >
                                <label for="image<?=\yii\helpers\Html::encode($v['id'])?>"  style="margin:0;top:0;position:absolute;background:rgba(0,0,0,0.4);color:#fff;font-size:12px;text-align:center;border-radius:4px;width:60px;height:20px;line-height:20px;padding:3px 3px;cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">修改图片</label>
                            </div>
                        <?php endforeach;?>
                    </li>

                    <li><label>商品描述<b>*</b></label>
                        <textarea id="content7" name="detail" style="width:700px;height:250px;visibility:hidden;"><?=\yii\helpers\Html::encode($info['detail'])?></textarea>
                    </li><br/>
                    <li><label>&nbsp;</label><input type="button" class="btn" value="编辑提交"/></li>
                </ul>
                <input type="hidden" name="id" value="<?=\yii\helpers\Html::encode($info['id'])?>"/>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    //图片上传预览    IE是用了滤镜。
    function previewImage(file,pre,imag,width,height)
    {
        var MAXWIDTH  = width;
        var MAXHEIGHT = height;
        var div = document.getElementById(pre);
        if( !file.value.match( /.jpg|.gif|.png|.bmp/i ) ){
            //$(this).prev('span').text('图片格式无效！');
            $('#'+pre).next('span').css({"color":"red","font-weight":"bold"}).text('图片类型无效！');
            return false;
        }else{
            $('#'+pre).next('span').css({"color":"green","font-weight":"bold"}).text('');
        }
        if (file.files && file.files[0])
        {
            div.innerHTML ='<img id='+imag+'>';
            var img = document.getElementById(imag);
            img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
            }
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            file.blur();
            var src = document.selection.createRange().text;
            div.innerHTML ='<img id='+imag+'>';
            var img = document.getElementById(imag);
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        }
        $(file).next('label').css({margin:0,top:0,position:'absolute',background:'rgba(0,0,0,0.5)',color:'#fff'}).html('重新选择');
        // $(file).parent().append('<span class="update()" style="margin:0;top:30px;position:absolute;background:rgba(0,0,0,0.9);color:#ff0;text-align:center;border-radius:4px;width:60px;height:20px;line-height:20px;padding:3px 3px;cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">确定更新</span>');
    }
    function clacImgZoomParam( maxWidth, maxHeight, width, height ){
        var param = {top:0, left:0, width:width, height:height};
        if( width>maxWidth || height>maxHeight )
        {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if( rateWidth > rateHeight )
            {
                param.width =  maxWidth;
                param.height = Math.round(height / rateWidth);
            }else
            {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }
        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }
</script>
<script>
    function auctionClick(){
        var chk=document.getElementById("act4").checked;
        if(chk==true){
            document.getElementById("auction").style.display="block";
        }else{
            document.getElementById("auction").style.display="none";
        }
    }
</script>
</html>
