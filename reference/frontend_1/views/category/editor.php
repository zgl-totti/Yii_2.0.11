<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>编辑分类</title>
    <style type="text/css">
        .select2{width: 167px;height: 30px;}
    </style>
    <script type="text/javascript">
        <?php $this->beginBlock('test');?>
        $(document).ready(function(e) {
            /*$(".select1").uedSelect({
                width : 345
            });
            $(".select2").uedSelect({
                width : 167
            });
            $(".select3").uedSelect({
                width : 100
            });*/
            /*添加分类三级联动*/
            var getCate=function(pid,name){
                $.post("<?=\yii\helpers\Url::to('getcatebypid')?>",{pid:pid},function(res){
                    if(res.status){
                        var str='<option value="0" selected>请选择</option>';
                        for(var i in res.info){
                            str+='<option value="'+res.info[i].id +'">' + res.info[i].cname+ '</option>';
                        }
                        $('select[name="'+name+'"]').html(str);
                        $('select[name="'+name+'"]').parent().find(".uew-select-text").text($('select[name="'+name+'"]').find(':selected').text());
                    }
                },'json')
            };
            getCate(0,'firstCate');

            $('select[name="firstCate"]').change(function(){
                getCate($(this).find(':selected').val(),'secondCate');
                $(this).parents('.vocation').next('.vocation').show();
                $('select[name="thirdCate"]').empty().parents('.vocation').hide();
            });

            $('select[name="secondCate"]').change(function(){
                getCate($(this).val(),'thirdCate');
                $(this).parents('.vocation').next('.vocation').show();
            });
            /*添加分类三级联动*/

            /*向分类表中添加分类*/
            $('.btn').click(function(){
                $.post("<?=\yii\helpers\Url::to('edit')?>",$("#form1").serialize(),function(res) {
                    if (res.status == 1) {
                        layer.msg(res.info, {icon: 6}, function () {
                            location = "<?=\yii\helpers\Url::to('index')?>";
                        });
                    } else {
                        layer.msg(res.info, {icon: 5});
                    }
                },'json')
            });
        });

        $('#anniu').click(function(){
            $.post("<?=\yii\helpers\Url::to('operate')?>",'',function(res){
                alert(res);
            },'json')
        })
        <?php $this->endBlock() ?>
        <?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
    </script>
</head>


<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">分类管理</a></li>
        <li><a href="#">编辑分类</a></li>
    </ul>
    <a href="#" id="anniu" style="width: 50px;height: 20px;border: 1px solid red;padding: 5px;">按钮</a>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="" method="post" id="form1">
                <ul class="forminfo">
                    <li><label>分类名称<b>*</b></label><input name="cname" type="text" class="dfinput" value="<?=$info['cname']?>" style="width:240px;"/></li>
                    <li><label>顶级分类<b>*</b></label>
                        <input type="hidden" name="id" value="<?=$info['id']?>"/>
                        <div class="vocation">
                            <select class="select2" name="firstCate">
                            </select>
                        </div>
                        <div class="vocation" style="display:none">
                            <select class="select2" name="secondCate" >

                            </select>
                        </div>
                        <div class="vocation" style="display:none">
                            <select class="select2" name="thirdCate" >
                            </select>
                        </div>
                    </li>
                    <li><label>&nbsp;</label><input type="button" class="btn" value="马上编辑"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>

</body>

</html>







