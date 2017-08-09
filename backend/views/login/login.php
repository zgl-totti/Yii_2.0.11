<?php
    echo \yii\helpers\Html::cssFile('@web/css/style.css');
    echo \yii\helpers\Html::jsFile('@web/js/jquery_1.8.2.min.js');
    echo \yii\helpers\Html::jsFile('@web/js/jquery.js');
    echo \yii\helpers\Html::jsFile('@web/js/cloud.js');
    echo \yii\helpers\Html::jsFile('@web/layer/layer.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>欢迎登录后台管理系统</title>
    <script type="text/javascript">
        $(function(){
            $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            $(window).resize(function(){
                $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            });
            $('.btn').click(function(){
                var $form=$('#roma');
                $.post($form.attr('action'),$form.serialize(),function(res){
                    if(res.code==1){
                        /*layer.msg(res.body,{icon:6,time:1000},function(){
                            *//*window.location.href="<?=\yii\helpers\Url::toRoute(['admin/roma']);?>";*//*
                        });*/
                        location="<?=\yii\helpers\Url::toRoute(['index/index']);?>";
                    }else{
                        layer.msg(res.body);
                    }
                },'json');
            })
        });
    </script>
    <!--<style type="text/css">
        .loginbox ul li label{padding-left: 0;font-size: 14px}
        .form-control{width: 300px;height: 40px;border: 1px solid blue;}
    </style>-->
</head>
<body style="background-color:#1c77ac; background-image:url(../../web/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
<?php $this->beginBody() ?>
    <div id="mainBody">
        <div id="cloud1" class="cloud"></div>
        <div id="cloud2" class="cloud"></div>
    </div>
    <div class="logintop">
        <span>欢迎登录后台管理界面平台</span>
        <ul>
            <li><a href="#">回首页</a></li>
            <li><a href="#">帮助</a></li>
            <li><a href="#">关于</a></li>
        </ul>
    </div>
    <div class="loginbody">
        <span class="systemlogo"></span>
        <?php $form=\yii\widgets\ActiveForm::begin([
            'id'=>'roma',
            'action'=>\yii\helpers\Url::to(['login/index'])
        ]);?>
            <div class="loginbox loginbox1">
                <ul>
                    <li style="position: relative">
                        <?=$form->field($info,'username')->textInput();?>
                    </li>
                    <li style="position: relative">
                        <?=$form->field($info,'password')->passwordInput();?>
                    </li>
                    <li>
                        <?= $form->field($info, 'captcha',['options'=>['class'=>'form-group'],'template'=>'{input}'])
                            ->widget(\yii\captcha\Captcha::className(),[
                                'captchaAction'=>'login/captcha',
                                'imageOptions'=>[
                                    'alt'=>'点击换图','style'=>'cursor:pointer'
                                ],
                            ]); ?>
                    </li>
                    <li>
                        <?=\yii\helpers\Html::button('确定',['class' => 'btn'])?>
                        <label><input type="checkbox" value="" />记住密码</label>
                        <label><a href="#">忘记密码？</a></label>
                    </li>
                </ul>
            </div>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>