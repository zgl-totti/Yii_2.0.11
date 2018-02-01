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
    <!--<script>
        $(function () {
            $(".select2").live('change',function(){
                var val = $(".select2").attr("value");
                $('#vocation1').show();
                $.post('{:U("Admin/Category/getChildCate")}',{'val':val},function(res){
                    var str='<option value="0">二级分类</option>';
                    for(var i in res){
                        str+='<option value="'+res[i]["id"]+'">'+res[i]['catename']+'</option>';
                    }
                    $('#selectChild').html(str);
                })
            })
        })
    </script>-->
    <script type="text/javascript">
        KE.show({
            id : 'content7',
            cssPath : './index.css'
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

            $('.btn').click(function(){
                var id = $('#ggg').attr('value');
                $.post('{:U("Admin/Category/edit")}',{'id':id},function(res){
                })
            })
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
                    <li><label>商品分类名称<b>*</b></label><input name="catename" type="text" class="dfinput" value="<?=\yii\helpers\Html::encode($info['catename'])?>" style="width:167px;"/></li>
                    <input name="gid" type="hidden" value="<?=\yii\helpers\Html::encode($info['id'])?>" id="ggg">
                    <li><label>选择修改分类<b>*</b></label>
                        <div class="vocation">
                            <select class="select2" name="parent"><option value="0">请选择</option>
                                <?php foreach($res as $v): ?>
                                    <option id="catename" value="<?=$v['id']?>" <?=($v['id']==$info['id'])?'selected':'';?>><?=$v['catename']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input onclick="myfun()" type="button" class="btn" value="编辑分类"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function myfun(){
        $.post("{:U('Category/edit')}",$('#form1').serialize(),function(res){
            if(res.status=='notc'){
                layer.alert("亲,商品名称不能为空!",{icon:2},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            }else if(res.status=='notp'){
                layer.alert("亲,商品分类不能为空!",{icon:2},function(){
                    window.location.href="{:U('Category/addlist')}";
                })
            }else if(res.status=='ok'){
                layer.alert("商品分类编辑成功",{icon:1},function(){
                    window.location.href="{:U('Category/showlist')}";
                })
            } else{
                layer.alert("商品分类添加失败,请稍后操作",{icon:3},function(){
                    window.location.href="{:U('Category/showlist')}";
                })
            }
        })
    }
</script>
</html>
