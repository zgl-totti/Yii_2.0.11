<?php $this->beginPage() ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>欢迎您的到来</title>

    <?=\yii\helpers\Html::cssFile('@web/css/styles.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/abc.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/layer/layer.js')?>

    <script type="text/javascript">
        $(function(){
            $('#btnSub').click(function(){
                $.post("<?=\yii\helpers\Url::to(['login/register'])?>", $('#form1').serialize(), function (res) {
                    if (res.code == 1) {
                        layer.open({
                            content: res.body,
                            icon: 1,
                            yes: function () {
                                location.href = "<?=\yii\helpers\Url::to(['login/index'])?>";
                            }
                        });
                    } else {
                        layer.open({
                            content: res.body,
                            icon: 2,
                            title: '错误提示'
                        });
                    }
                }, 'json')
            })
        })
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="login-top">
    <div class="wrapper">
        <span class="logo"><img src="<?=\yii\helpers\Url::to('@web/images/logo2.png')?>" alt=""></span>
    </div>
</div>
<div class="zhu">
    <img src="<?=\yii\helpers\Url::to('@web/images/zs.png')?>" alt="左上" class="zs">
    <img src="<?=\yii\helpers\Url::to('@web/images/ys.png')?>" alt="右上" class="ys">
    <div class="panel-lite">
        <div class="img"><img  src="<?=\yii\helpers\Url::to('@web/images/h1.png')?>" alt=""/></div>
        <h4>用户注册</h4>
        <form action="#" id="form1">
            <div class="form-group">
                <input name="username" required="required" class="form-control" autocomplete="off"/>
                <label class="form-label">用户名    </label>
            </div>
            <div class="form-group">
                <input name="password" id="pwd" type="password" required="required"  class="form-control"/>
                <label class="form-label">密　码</label>
            </div>
            <div class="form-group">
                <input name="repwd" type="password" required="required" class="form-control"/>
                <label class="form-label">重复密码</label>
            </div>
            <div class="form-group" style="position: relative">
                <input type="text" name="verify" required="required" class="form-control1" autocomplete="off"/>
                <label class="form-label">验证码</label>
            </div>
                <?=\yii\captcha\Captcha::widget([
                    'name'=>'verify',
                    'captchaAction'=>'login/captcha',
                    'imageOptions'=>[
                        'alt'=>'点击换图','style'=>'cursor:pointer'
                    ],
                ])?>
            <div class="denglu">
                <span id="hzy_fast_login"></span>
            </div>
            <span style="margin-left:200px;"><a href="<?=\yii\helpers\Url::to(['login/index'])?>">已有账号,去登录</a></span>
            <div>
                <button id="btnSub" class="floating-btn" type="button" ><i class="icon-arrow"></i></button>
            </div>
            <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf-frontend" />
        </form>
    </div>
    <img src="<?=\yii\helpers\Url::to('@web/images/zx.png')?>" alt="左下" class="zx">
    <img src="<?=\yii\helpers\Url::to('@web/images/yx.png')?>" alt="右下" class="yx">
</div>


<div class="footer">
    关于我们 | 联系我们 | 人才招聘 | 商家入驻 | 广告服务 | 手机电商 | 友情链接 | 销售联盟 | 美食社区 | 热爱公益 | English Site<br>
    <span>Copyright © 2004-2016  我爱我家wawj.com 版权所有</span>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
