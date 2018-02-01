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

    <script type="text/javascript">
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
            <form action="<?=\yii\helpers\Url::to(['goods/add'])?>" method="post" enctype="multipart/form-data" id="form1">
                <ul class="forminfo">
                    <li><label>商品名称<b>*</b></label><input name="goodsname" type="text" class="dfinput" placeholder="请填写商品名称"  style="width:345px;"/></li>
                    <li><label>选择分类<b>*</b></label>
                        <div class="vocation">
                            <select class="select1" name="cid"><option value="0">顶级分类</option>
                                <?php foreach($category as $v): ?>
                                    <option value="<?=\yii\helpers\Html::encode($v['id'])?>"><?=$v['catename'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label>选择商标<b>*</b></label>
                        <div class="vocation">
                            <select class="select1" name="bid"><option value="0">品牌选择</option>
                                <?php foreach($brand as $v): ?>
                                    <option value="<?=\yii\helpers\Html::encode($v['id'])?>"><?=\yii\helpers\Html::encode($v['bname'])?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label>市场价格<b>*</b></label><input name="marketprice" type="text" class="dfinput" placeholder="相关信息"   style="width:345px;"/></li>
                    <li><label>商品价格<b>*</b></label><input name="price" type="text" class="dfinput" placeholder="相关信息"   style="width:345px;"/></li>
                    <li><label>商品数量<b>*</b></label><input name="num" type="text" class="dfinput" placeholder="相关信息"  style="width:345px;"/></li>
                    <li><label>商品主图<b>*</b></label>
                        <div class="usercity">
                            <p id="preview1" ><img id="imghead1"  border=0 src=''></p><span></span>
                            <!--文件上传标签隐藏 ,指定给了label-->
                            <input type="file" id="image1" name="image[]" onchange="previewImage(this,'preview1','imghead1')" style="display:none;" >
                            <label for="image1"  style="margin:10px;text-align:center;color:#fff;border-radius:10px;width:60px;height:30px;line-height:26px;font-size:14px;background:#685CF6;padding:3px 15px;border:1px solid #ccc;display: inline-block">上传图片</label>
                        </div>
                    </li>
                    <li><label>商品副图<b>*</b></label>
                        <div class="usercity">
                            <p id="preview2" ><img id="imghead2"  border=0 src='' style="background-color: red;"></p><span></span>
                            <input type="file" id="image2" name="image[]" onchange="previewImage(this,'preview2','imghead2')" style="display:none;" >
                            <label for="image2"  style="margin:10px;text-align:center;color:#fff;border-radius:10px;width:60px;height:30px;line-height:26px;font-size:14px;background:#685CF6;padding:3px 15px;border:1px solid #ccc;display: inline-block">上传图片</label>
                        </div>
                        <div class="usercity">
                            <p id="preview3" ><img id="imghead3"  border=0 src=''></p><span></span>
                            <input type="file" id="image3" name="image[]" onchange="previewImage(this,'preview3','imghead3')" style="display:none;" >
                            <label for="image3"  style="margin:10px;text-align:center;color:#fff;border-radius:10px;width:60px;height:30px;line-height:26px;font-size:14px;background:#685CF6;padding:3px 15px;border:1px solid #ccc;display: inline-block">上传图片</label>
                        </div>
                        <div class="usercity">
                            <p id="preview4" ><img id="imghead4"  border=0 src=''></p><span></span>
                            <input type="file" id="image4" name="image[]" onchange="previewImage(this,'preview4','imghead4')" style="display:none;" >
                            <label for="image4"  style="margin:10px;text-align:center;color:#fff;border-radius:10px;width:60px;height:30px;line-height:26px;font-size:14px;background:#685CF6;padding:3px 15px;border:1px solid #ccc;display: inline-block">上传图片</label>
                        </div>
                    </li>
                    <li><label>商品介绍<b>*</b></label>
                        <textarea name="introduction" style="width:400px;height:200px;border:1px solid #0081ef;"></textarea>
                    </li>
                    <li><label>商品参数<b>*</b></label>
                        <textarea id="content1" name="parameter" style="width:700px;height:250px;visibility:hidden;"></textarea>
                    </li>
                    <li><label>商品描述<b>*</b></label>
                        <textarea id="content7" name="description" style="width:700px;height:250px;visibility:hidden;"></textarea>
                    </li>
                    <li><label>&nbsp;</label><input type="submit" class="btn" value="马上发布"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        $('#form1').submit(function() {
            $(this).ajaxSubmit(function(res) {
                if(res.status=='gnull'){
                    layer.alert("商品名称不能为空!",{icon:2},function(){
                        window.location.href="{:U('Goods/addlist')}";
                    })
                }else if(res.status=='cnull'){
                    layer.alert("商品分类不能为空!",{icon:2},function(){
                        window.location.href="{:U('Goods/addlist')}";
                    })
                }else if(res.status=='bnull'){
                    layer.alert("品牌不能为空!",{icon:2},function(){
                        window.location.href="{:U('Goods/addlist')}";
                    })
                }else if(res.status=='picerror'){
                    layer.alert("图片上传失败!",{icon:2},function(){
                        window.location.href = "{:U('Goods/addlist')}";
                    })
                }
                else if(res.status=='falsepic'){
                    layer.alert("主图更新失败!",{icon:2},function(){
                        window.location.href = "{:U('Goods/addlist')}";
                    })
                }else if(res.status=='ok'){
                    layer.alert("恭喜你,添加成功",{icon:1},function(){
                        window.location.href = "{:U('Goods/addlist')}";
                    })
                }
            });
            return false; //阻止表单默认提交
        });
    })
</script>
<script type="text/javascript">
    //图片上传预览    IE是用了滤镜。
    function previewImage(file,pre,imag)
    {
        var MAXWIDTH  = 300;
        var MAXHEIGHT = 300;
        var div = document.getElementById(pre);
        //判断图片类型的
        if( !file.value.match( /.jpg|.gif|.png|.jpeg/i ) ){
            //$(this).prev('span').text('图片格式无效！');
            $('#'+pre).next('span').css({"color":"red","font-weight":"bold"}).text('图片类型无效！');
            return false;
        }else{
            $('#'+pre).next('span').css({"color":"green","font-weight":"bold"}).text('图片类型符合！');
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
            //fileReader 是html5的新特性
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            //对图片进行透明处理 sizingMethod显示方式
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
        $(file).next('label').css({position:"relative",top:"-200px",left:'50px',opacity:"0.7",background:'pink'}).html('重新选择');
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
</html>
