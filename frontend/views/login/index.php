<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>欢迎您的到来</title>

    <?=\yii\helpers\Html::cssFile('@web/css/styles.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/drag.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/drag.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/abc.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/layer/layer.js')?>

</head>
<body>
<div class="login-top">
    <div class="wrapper">
        <span class="logo"><img src="<?=\yii\helpers\Url::to('@web/images/logo2.png')?>" alt=""></span>
    </div>
</div>
<div class="zhu">
    <img src="<?=\yii\helpers\Url::to('@web/images/zs.png')?>" alt="左上" class="zs">
    <img src="<?=\yii\helpers\Url::to('@web/images/ys.png')?>" alt="右上" class="ys">

    <div class="panel-lite">
        <div class="img"><img src="<?=\yii\helpers\Url::to('@web/images/h1.png')?>" alt=""/></div>
        <h4>用户登录</h4>
        <form action="#" class="form1" autocomplete="off" >
            <div class="form-group">
                <input name="username" required="required" class="form-control" autocomplete="off" />
                <label class="form-label" >用户名   </label>
            </div>
            <div class="form-group">
                <input name="password" id="pwd" type="password" required="required" class="form-control"/>
                <label class="form-label">密　码</label>
            </div>
            <div id="drag"></div>
            <script type="text/javascript">
                $('#drag').drag();
            </script>
            <div class="denglu">
                <span id="hzy_fast_login"></span>
            </div>
            <span style="margin-left:200px;color: red"><a href="<?=\yii\helpers\Url::to(['login/register'])?>">没有账号,去注册</a></span>
            <div>
                <button class="floating-btn" type="button" ><i class="icon-arrow"></i></button>
            </div>
        </form>
    </div>
    <img src="<?=\yii\helpers\Url::to('@web/images/zx.png')?>" alt="左下" class="zx">
    <img src="<?=\yii\helpers\Url::to('@web/images/yx.png')?>" alt="右下" class="yx">
</div>
<div class="footer">
    关于我们 | 联系我们 | 人才招聘 | 商家入驻 | 广告服务 | 手机电商 | 友情链接 | 销售联盟 | 美食社区 | 热爱公益 | English Site<br>
    <span>Copyright © 2004-2016  我爱我家wawj.com 版权所有</span>
</div>
<script type="text/javascript">
    $(function () {
        $('.floating-btn').click(function() {
            $.post("<?=\yii\helpers\Url::to(['login/index'])?>", $(".form1").serialize(), function (res) {
                if (res.code == 1) {
                    layer.msg(res.body, {icon: 1, time: 1000}, function () {
                        window.location.href = "<?=\yii\helpers\Url::to(['index/index'])?>";
                    });
                } else {
                    layer.msg(res.body, {icon: 2, time: 1000});
                }
            },'json');
        })
    })
</script>
</body>
</html>
