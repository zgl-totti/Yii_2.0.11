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
        $(function () {
            $("#firstParent").live('change',function(){
                var val=$(this).attr('value');
                $('#vocation1').show();
                $.post("<?=\yii\helpers\Url::to(['category/getcategory'])?>",{val:val},function(res){
                    var str='<option value="0" >二级分类</option>';
                    for(var i in res){
                        str+='<option value="'+res[i]['id']+'">'+res[i]['catename']+'</option>';
                    }
                    $('#selectChild').html(str);
                },'json')
            })
            $('.button').click(function(){
                $.post("<?=\yii\helpers\Url::to(['category/add'])?>",$('#form1').serialize(),function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:6,time:1000},function(){
                            window.location.href="<?=\yii\helpers\Url::to(['cagegory/index'])?>";
                        })
                    }else{
                        layer.msg(res.body,{icon:5,time:1000})
                    }
                })
            })
        })
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
        <li><a href="#">分类管理</a></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="#" method="post" id="form1">
                <ul class="forminfo">
                    <li><label>商品分类<b>*</b></label><input name="catename" type="text" class="dfinput" placehold="请添加分类名称"  style="width:167px;"/></li>
                    <li><label>选择分类<b>*</b></label>
                        <div class="vocation">
                            <select id="firstParent" class="select2" name="parent">
                                <option value="0">请选择</option>
                                <?php foreach($list as $v): ?>
                                    <option id="catename" value="<?=$v['id']?>"><?=\yii\helpers\Html::encode($v['catename'])?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div id="vocation1" class="vocation" style="display: none; margin-left: 20px;">
                            <select  class="select2" id="selectChild" name="child">
                                <option value="0" selected>二级分类</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <label>&nbsp;</label><input id="contrue" type="button" class="btn" value="添加分类"/>
                    </li>
                    <!--<li><label>&nbsp;</label><input onclick="myfun()" id="contrue" type="button" class="btn" value="添加分类"/></li>-->
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function myfun() {
        $.post("{:U('Category/addlist')}",$("#form1").serialize(),function (res) {
            if(res.status=='notc'){
                layer.alert("亲,商品名称不能为空!",{icon:2},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            }else if(res.status=='notp'){
                layer.alert("亲,商品分类不能为空!",{icon:2},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            }else if(res.status=='ok'){
                layer.alert("商品分类添加成功,请继续",{icon:1},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            } else{
                layer.alert("商品分类添加失败,请稍后操作",{icon:3},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            }
        })
    }
</script>
</html>
