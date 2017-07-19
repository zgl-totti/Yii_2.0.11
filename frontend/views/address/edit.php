<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.validate.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/geo.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/layer/layer.js')?>

    <style type="text/css">
        input{height:30px;margin-top: 20px;}
        td{text-align:right;line-height: 30px;position: relative}
        input.inp1{width:260px;}
        select{height: 30px;}
        input.sub{width:100px;height: 40px;cursor: pointer;}
        label.error{position: absolute;left: -10px;top:52px;  color:#ff0300;  font-weight: bold;  font-size: 13px; width:100px; }
    </style>
</head>
<body>
    <form action="#" method="post" id="form1">
        <input class="inp1" type="hidden" name="id" value="<?=\yii\helpers\Html::encode($info['id'])?>" >
        <table>
            <tr>
                <td>姓名:</td>
                <td><input class="inp1" type="text" name="name" value="<?=\yii\helpers\Html::encode($info['name'])?>" ></td>
            </tr>
            <tr>
                <td>电话:</td>
                <td><input class="inp1" type="text" name="mobile" value="<?=\yii\helpers\Html::encode($info['mobile'])?>" ></td>
            </tr>
            <tr>
                <td>原地址:</td>
                <td><input class="inp1" type="text" name="mobile" disabled="disabled" value="<?=\yii\helpers\Html::encode($info['address'])?>" ></td>
            </tr>
            <tr>
                <td>新地址:</td>
                <td>
                    <select class="select" name="province" id="s1">
                    <option></option>
                    </select>
                    <select class="select" name="city" id="s2">
                        <option></option>
                    </select>
                    <select class="select" name="town" id="s3">
                        <option></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>街道:</td>
                <td><input class="inp1" name="jiedao" type="text"></td>
            </tr>
            <tr>
                <td>邮政编码:</td>
                <td><input class="inp1" type="text" name="postcode" value="<?=\yii\helpers\Html::encode($info['postcode'])?>" ></td>
            </tr>
            <tr>
                <td colspan="2"><input id="btn" class="sub" type="button" value="确认"></td>
            </tr>
        </table>
    </form>
</body>
<script type="text/javascript">
    setup();
    preselect();
    $(function(){
        var Obj=$("#form1").validate({
            rules:{
                name:{
                    required:true,
                    minlength:2,
                    maxlength:12
                },
                mobile:{
                    required:true,
                    mobile:true
                },
                address1:{
                    required:true
                },
                address2:{
                    required:true
                },
                post:{
                    required:true,
                    postCode:true
                }
            },
            messages:{
                name:{
                    required:"姓名不能为空",
                    minlength:"至少2个字符",
                    maxlength:"至多12个字符"
                },
                mobile:{
                    required:"号码不能为空"
                },
                address1:{
                    required:"地址不能为空"
                },
                address2:{
                    required:"街道不能为空"
                },
                post:{
                    required:"邮政不能为空"
                }
            }
        })
        // 邮政编码验证
        jQuery.validator.addMethod("postCode", function (value, element) {
            var codeReg = /^[0-9]{6}$/;
            return this.optional(element) || (codeReg.test(value));
        }, "邮编格式错误");

        // 手机号码验证
        jQuery.validator.addMethod("mobile", function (value, element) {
            var mobileReg = /^1[34578]{1}[0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        }, "手机号码格式错误");
        jQuery.validator.onfocus=true;

        $("#btn").live('click',function(){
            if(Obj.form()){
                $.post("<?=\yii\helpers\Url::to(['address/edit'])?>",$("#form1").serialize(),function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:1,time:1000},function(){
                            parent.location.reload();
                            //parent.location.href="{:U('Order/showlist')}";
                        })
                    }else{
                        layer.msg(res.body,{icon:2,time:1000});
                    }
                },'json')
            }
        })
    })
</script>
</html>