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

    <style type="text/css">
        .cb{width: 30px;  height: 30px;margin:0 10px 0 0;  }
        .lb{width:150px;height: 70px;font-size: 30px;}
    </style>
    <script type="text/javascript">
         /*var uploadUrl = '{:U("uploadGoodsPic")}';
         var listUrl = '{:U("showlist")}';*/
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
                                    location.href="{:U('Goods/showlist')}";
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
            <form action="<?=\yii\helpers\Url::to(['goods/edit'])?>" method="post" enctype="multipart/form-data" id="form1">
                <ul class="forminfo">
                    <li><label>商品名称<b>*</b></label><input name="goodsname" value="<?=\yii\helpers\Html::encode($info['goodsname'])?>" type="text" class="dfinput" style="width:345px;"/></li>
                    <input type="hidden" name="id" value="<?=\yii\helpers\Html::encode($info['id'])?>"/>
                    <li><label>选择分类<b>*</b></label>
                        <div class="vocation">
                            <select class="select1" name="cid"><option value="0">顶级分类</option>
                                <?php foreach($category as $v): ?>
                                    <option value="<?=\yii\helpers\Html::encode($v['id'])?>" <?=($v['id']==$info['cid'])?'selected':'';?>><?=$v['catename'];?></option>
                                <?php endforeach;?>
                            </select></div></li>
                    <li><label>选择商标<b>*</b></label>
                        <div class="vocation">
                            <select class="select1" name="bid"><option value="0">品牌选择</option>
                                <?php foreach($brand as $v): ?>
                                    <option  value="<?=\yii\helpers\Html::encode($v['id'])?>" <?=($v['id']==$info['bid'])?'selected':'';?>><?=\yii\helpers\Html::encode($v['bname'])?></option>
                                <?php endforeach;?>
                            </select></div></li>
                    <li><label>市场价格<b>*</b></label><input name="marketprice" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['marketprice'])?>" style="width:345px;"/></li>
                    <li><label>商品价格<b>*</b></label><input name="price" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['price'])?>"  style="width:345px;"/></li>
                    <li><label>商品数量<b>*</b></label><input name="num" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['num'])?>"  style="width:345px;"/></li>
                    <br /> <li><label>活动中心<b>*</b></label>
                    <label for="act1" style="width: 150px;font-size: 26px;color: #212121;"><input onclick="auctionClick()" type="radio" value="1"  name="activity" id="act1" class="cb" <?=\yii\helpers\Html::encode($info['activity'])==1?'checked':'';?> />限时抢购</label>
                    <label for="act2" style="width: 150px;font-size: 26px;color: #212121;"><input onclick="auctionClick()"  type="radio" value="2" name="activity" id="act2" class="cb" <?=\yii\helpers\Html::encode($info['activity'])==2?'checked':'';?> />普通商品</label>
                    <label for="act3" style="width: 150px;font-size: 26px;color: #212121;"><input onclick="auctionClick()" type="radio" value="3" name="activity" id="act3" class="cb" <?=\yii\helpers\Html::encode($info['activity'])==3?'checked':'';?> />十年店庆</label>
                    <label for="act4" style="width: 150px;font-size: 26px;color: #212121;"><input onclick="auctionClick()" type="radio" value="4" name="activity" id="act4" class="cb" <?=\yii\helpers\Html::encode($info['activity'])==4?'checked':'';?> />拍卖专场</label>
                    <br/><br /><br /><br /></li>
                    <div id="auction" style="display:none">
                    <li><label>起步价格<b>*</b></label><input name="startprice" type="text" class="dfinput"  style="width:345px;"/></li>
                    <li><label>低价<b>*</b></label><input name="commonprice" type="text" class="dfinput"   style="width:345px;"/></li>
                    <li><label>最高价<b>*</b></label><input name="maxprice" type="text" class="dfinput"   style="width:345px;"/></li>
                    <li><label>加价幅度<b>*</b></label><input name="range" type="text" class="dfinput"   style="width:345px;"/></li>
                    </div>
                    <li>
                        <label>商品主图<b>*</b></label>
                        <div class="usercity" style="border:3px dashed #e6e6e6;width:520px;height:300px;position: relative">
                            <p id="preview0" ><img width="300" id="imghead0"  border=0 src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').\yii\helpers\Html::encode($info['pic'])?>"></p><span></span>
                            <input type="file" id="image0" name="0" onchange="previewImage(this,'preview0','imghead0',300,300)" style="display:none;" >
                            <label for="image0"  style="margin:0;top:0;position:absolute;background:rgba(0,0,0,0.4);color:#fff;font-size:12px;text-align:center;border-radius:4px;width:60px;height:20px;line-height:20px;padding:3px 3px;cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">修改主图</label>
                        </div>
                    </li>
                    <li>
                        <label>商品图片<b>*</b></label>
                        <?php foreach($info['pics'] as $v): ?>
                            <div class="usercity" style="border:3px dashed #e6e6e6;width:170px;height:155px;margin:5px 0px;position: relative">
                                <p id="preview<?=$v['id']?>" >
                                    <img width="150" id="imghead<?=$v['id']?>"  border=0 src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').$v['picname'];?>">
                                </p><span></span>
                                <input type="file" id="image<?=$v['id']?>" name="<?=$v['id']?>" onchange="previewImage(this,'preview<?=$v['id']?>','imghead<?=$v['id']?>',150,150)" style="display:none;" >
                                <label for="image<?=$v['id']?>"  style="margin:0;top:0;position:absolute;background:rgba(0,0,0,0.4);color:#fff;font-size:12px;text-align:center;border-radius:4px;width:60px;height:20px;line-height:20px;padding:3px 3px;cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">修改图片</label>
                            </div>
                        <?php endforeach;?>
                    </li>
                    <li><label>商品介绍<b>*</b></label>
                        <textarea name="introduction" style="width:400px;height:200px;border:1px solid #0081ef;"><?=\yii\helpers\Html::encode($info['introduction'])?></textarea>
                    </li>
                    <li><label>商品参数<b>*</b></label>
                        <textarea id="content1" name="parameter" style="width:700px;height:250px;visibility:hidden;"><?=\yii\helpers\Html::encode($info['parameter'])?></textarea>
                    </li>
                    <li><label>商品描述<b>*</b></label>
                        <textarea id="content7" name="description" style="width:700px;height:250px;visibility:hidden;"><?=\yii\helpers\Html::encode($info['description'])?></textarea>
                    </li><br/>
                    <li><label>&nbsp;</label><input type="button" class="btn" value="编辑提交"/></li>
                </ul>
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
