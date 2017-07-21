<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\frontend\assets\AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=\yii\helpers\Url::to('@web/uploads/minilogo.ico')?>" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?=Html::cssFile('@web/css/common.css')?>
    <?=Html::cssFile('@web/fonts/iconfont.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
    <?=Html::cssFile('@web/css/Orders.css')?>
    <?=Html::cssFile('@web/css/show.css')?>
    <?=Html::cssFile('@web/css/purebox-metro.css')?>
    <?=Html::cssFile('@web/css/addtocart.css')?>
    <?=Html::cssFile('@web/css/ordersuccess.css')?>

    <!--支付-->
    <link rel="shortcut icon" href="<?=\yii\helpers\Url::to('@web/images/bitbug_favicon.icon')?>" />
    <?=Html::cssFile('@web/css/showcart.css')?>
    <?=Html::cssFile('@web/css/reset1.css')?>

    <!--支付-->
    <?=Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
    <?=Html::jsFile('@web/js/jquery.reveal.js')?>
    <?=Html::jsFile('@web/js/jquery.SuperSlide.2.1.1.js')?>
    <?=Html::jsFile('@web/js/common_js.js')?>
    <?=Html::jsFile('@web/js/footer.js')?>
    <?=Html::jsFile('@web/js/layer/layer.js')?>

    <style type="text/css">
       .nav_on{ background:#FF7200;color:white;}
    </style>
    <script type="text/javascript">
        $(function(){
            $(".Navigation_name li").removeClass();
            var reg1=/\/index\//;
            var reg2=/\/product\//;
            var reg3=/\/sale\//;
            var reg4=/\/vote\//;
            var reg5=/\/auction\//;
            var reg6=/\/integral\//;
            var reg7=/\/connect\//;
            var nowurl=document.URL;
            if(reg1.test(nowurl)){
                $('#cplb').addClass("nav_on");
            }else if(reg2.test(nowurl)){
                $('#cplb').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }else if(reg3.test(nowurl)){
                $('#xsqg').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }else if(reg4.test(nowurl)){
                $('#tptj').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }else if(reg5.test(nowurl)){
                $('#pmsc').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }else if(reg6.test(nowurl)){
                $('#jfdh').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }else if(reg7.test(nowurl)){
                $('#lxwm').addClass("nav_on");
                $(".Navigation_name li").mouseleave(function(){
                    $(this).removeClass("on");
                })
            }
        })

    </script>
    <script type="text/javascript">
        url="{:U('Index/buyCart')}";
        delurl="{:U('Cart/del')}";
        pub="__PUBLIC__";
        //退出
        function logout(){
            layer.confirm("你确定要退出吗？",{icon:3,btn:['确定','取消']},function(){
                $.get("{:U('Home/Member/logout')}",function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Home/Index/index')}"
                        })
                    }
                })
            })
        }
        //我的购物车删除
        function del(gid){
            $.get(delurl,{gid:gid},function(res){
                if(res.status=="ok"){
                    $("div.hd_Shopping_list").click();
                }else{
                    layer.msg(res.msg,{icon:2});
                }
            });
        }
        //会员中心判断是否登陆过
        function islogin(){
            var mid=$("#islogin").val();
            if(mid){
                window.location.href="{:U('Home/Personal/showlist')}";
            }else{
                layer.confirm("登陆后才能进入",{icon:4,btn:['去登陆','算了吧']},function(){
                    window.location.href="{:U('Home/Member/login')}";
                })
            }
        }
        //我的订单判断是否登陆
        function isorder(){
            var mid=$("#islogin").val();
            if(mid){
                window.location.href="{:U('Home/Personal/order')}";
            }else{
                layer.confirm("登陆后才能查看",{icon:4,btn:['去登陆','算了吧']},function(){
                    window.location.href="{:U('Home/Member/login')}";
                })
            }
        }

        function getText(){
            var _date = new Date();
            var _time = _date.getHours();
            var _text = '';
            if(_time>=6 && _time<9)
                _text = '早上好';
            else if(_time>=9 && _time<11)
                _text = '上午好';
            else if(_time>=11 && _time<13)
                _text = '中午好';
            else if(_time>=13 && _time<17)
                _text = '下午好';
            else
                _text = '晚上好';
            return _text;
        }
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<!--顶部样式-->
<div id="header_top">
    <input type="hidden" value="<?=\yii\helpers\Html::encode($this->params['info']['id'])?>" id="islogin"/>
    <div id="top">
        <div class="Inside_pages">
            <?php if(\yii\helpers\Html::encode($this->params['info']['id'])>0): ?>
                <div class="Collection"><script>jQuery('.Collection').html(getText());</script>,<?=\yii\helpers\Html::encode($this->params['info']['username'])?>,欢迎光临锦宏颜！<em></em><a href="#">收藏我们</a></div>
            <?php else: ?>
                <div class="Collection"><script>jQuery('.Collection').html(getText());</script>,欢迎光临锦宏颜！<em></em><a href="#">收藏我们</a></div>
            <?php endif;?>
            <div class="hd_top_manu clearfix">
                <ul class="clearfix">
                    <?php if(\yii\helpers\Html::encode($this->params['info']['id'])>0): ?>
                        <li class="hd_menu_tit zhuce" data-addclass="hd_menu_hover">
                            欢迎光临本店！<a id="logout" href="javascript:logout()" class="red">[退出]</a>
                        </li>
                    <?php else: ?>
                        <li class="hd_menu_tit zhuce" data-addclass="hd_menu_hover">
                            欢迎光临本店！<a href="<?=\yii\helpers\Url::to(['login/index'])?>" class="red">[登录]</a>
                            新用户<a href="<?=\yii\helpers\Url::to(['login/register'])?>" class="red">[免费注册]</a>
                        </li>
                    <?php endif;?>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="javascript:isorder()">我的订单</a></li>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"> <a href="{:U('Home/Cart/mycart')}">购物车</a> </li>
                    <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="{:U('Home/Connect/showlist')}">联系我们</a></li>
                    <li class="hd_menu_tit zhuce" data-addclass="hd_menu_hover">
                        <a href="javascript:islogin()" class="red">[会员中心]</a>
                    </li>
                    <li class="hd_menu_tit phone_c" data-addclass="hd_menu_hover"><a href="#" class="hd_menu "><em class="iconfont icon-shouji"></em>手机版</a>
                        <div class="hd_menu_list erweima">
                            <ul>
                                <img src="__PUBLIC__/Home/images/erweima.jpg"  width="100px" height="100"/>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--顶部样式1-->
    <div id="header"  class="header page_style">
        <div class="logo"><a href="{:U('Home/Index/index')}"><img src="<?=\yii\helpers\Url::to('@web/images/logo.png')?>" /></a></div>
        <!--结束图层-->
        <div class="Search">
            <!--<p><input name="" type="text"  class="text"/><input name="" type="submit" value="搜 索"  class="Search_btn"/></p>-->
            <form action="<?=\yii\helpers\Url::to(['product/index'])?>" method="get">
                <p>
                    <input name="keywords" type="text"  value="<?=Html::encode($this->params['keywords'])?>" class="text" style="height: 38px"/>
                    <!--<input name="words" type="text"  value="<?/*=Html::encode($keywords?$keywords:'')*/?>" class="text" style="height: 38px"/>-->
                    <input name="" type="submit" value="搜 索" class="Search_btn" />
                </p>
            </form>
            <p class="Words">
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>1])?>">甜品</a>
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>3])?>">零食</a>
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>5])?>">水果</a>
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>7])?>">生鲜蔬菜</a>
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>8])?>">肉类</a>
                <a href="<?=\yii\helpers\Url::to(['product/index','cid'=>2])?>">饮品</a>
            </p>
        </div>
        <!--购物车样式-->
        <div class="hd_Shopping_list" id="Shopping_list">
            <div class="s_cart"><em class="iconfont icon-cart2"></em><a href="#">我的购物车</a>
                <!--<i class="ci-right">&gt;</i>-->
                <!--<i class="ci-count" id="shopping-amount">
                <if condition="$Think.session.sum egt 0">
                    {$Think.session.sum}
                    <else/>
                    0
                </if>
            </i>-->
            </div>
            <div class="dorpdown-layer">
                <div class="spacer"></div>
                <!--<div class="prompt"></div><div class="nogoods"><b></b>购物车中还没有商品，赶紧选购吧！</div>-->
                <ul class="p_s_list">
                </ul>
                <div class="Shopping_style">
                    <div class="p-total">共<b id="totalnum"></b>件商品　共计<strong id="totalprice"></strong></div>
                    <a href="{:U('Home/Cart/myCart')}" title="去购物车结算" id="btn-payforgoods" class="Shopping">去购物车结算</a>
                </div>
            </div>
        </div>
    </div>
    <!--菜单导航样式-->
    <div id="Menu" class="clearfix">
        <div class="index_style clearfix">
            <div id="allSortOuterbox" class="display">
                <div class="t_menu_img"></div>
            </div>
            <script>$("#allSortOuterbox").slide({ titCell:".Menu_list li",mainCell:".menv_Detail",	});</script>
            <!--菜单栏-->
            <div class="Navigation" id="Navigation">
                <!--<ul class="Navigation_name">-->
                <ul class="Navigation_name">
                    <li id="sy"><a href="<?=\yii\helpers\Url::to(['index/index'])?>">首页</a></li>
                    <li id="cplb"><a href="<?=\yii\helpers\Url::to(['product/index'])?>">产品列表</a></li>
                    <li id="xsqg"><a href="<?=\yii\helpers\Url::to(['sale/index'])?>">限时抢购</a><em class="hot_icon"></em></li>
                    <li id="tptj"><a href="<?=\yii\helpers\Url::to(['vote/index'])?>">投票统计</a></li>
                    <li id="pmsc"><a href="<?=\yii\helpers\Url::to(['auction/index'])?>">拍卖商城</a></li>
                    <li id="jfdh"><a href="<?=\yii\helpers\Url::to(['integral/index'])?>">积分兑换</a></li>
                    <li id="lxwm"><a href="<?=\yii\helpers\Url::to(['index/connect'])?>">联系我们</a></li>
                </ul>
            </div>
            <script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
            <!-- <a href="#" class="link_bg"><img src="__PUBLIC__/Home/images/link_bg_03.png" /></a>-->
        </div>
    </div>
</div>


<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>


<!--底部图层-->
<div class="phone_style">
    <div class="index_style">
        <span class="phone_number"><em class="iconfont icon-dianhua"></em>400-4565-345</span><span class="phone_title">客服热线 7X24小时 贴心服务</span>
    </div>
</div>
<div class="footerbox clearfix">
    <div class="clearfix">
        <div class="">
            <dl>
                <dt>售后保障</dt>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>13))}">&nbsp;售后政策</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>14))}">&nbsp;价格保护</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>15))}">&nbsp;退款说明</a> </dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>16))}">&nbsp;取消订单 </a></dd>
            </dl>
            <dl>
                <dt>支付方式</dt>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>17))}">&nbsp;货到付款</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>18))}">&nbsp;在线支付</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>19))}">&nbsp;分期付款</a> </dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>20))}">&nbsp;异常情况</a></dd>
            </dl>
            <dl>
                <dt>新手上路</dt>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>2))}">&nbsp;交易条款</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>6))}">&nbsp;售后流程</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>7))}">&nbsp;购物流程</a> </dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>8))}">&nbsp;隐私说明 </a></dd>
            </dl>
            <dl>
                <dt>特色服务</dt>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>21))}">&nbsp;次日送达</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>22))}">&nbsp;送货入库</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>23))}">&nbsp;无忧退换货</a> </dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>24))}">&nbsp;全国联保</a></dd>
            </dl>
            <dl>
                <dt>配送与支付</dt>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>9))}">&nbsp;保险需求测试</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>10))}">&nbsp;专题及活动</a></dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>11))}">&nbsp;挑选保险产品</a> </dd>
                <dd><a href="{:U('Home/Article/articledetail',array('id'=>12))}">&nbsp;常见问题 </a></dd>
            </dl>
        </div>
    </div>
    <div class="text_link">
        <p>
            <a href="#">关于我们</a>｜ <a href="#">公开信息披露</a>｜ <a href="#">加入我们</a>｜ <a href="#">联系我们</a>｜ <a href="#">版权声明</a>｜ <a href="#">隐私声明</a>｜ <a href="#">网站地图</a></p>
        <p>蜀ICP备11017033号 Copyright ©2011 成都福际生物技术有限公司 All Rights Reserved. Technical support:CDDGG Group</p>
    </div>
</div>


<!--右侧菜单栏购物车样式-->
<div class="fixedBox">
    <ul class="fixedBoxList">
        <li class="fixeBoxLi user">
            <?php if(\yii\helpers\Html::encode($this->params['info']['id'])>0): ?>
                <a href="<?=\yii\helpers\Url::to(['personal/index'])?>">
                    <span class="fixeBoxSpan iconfont icon-yonghu"></span> <strong>用户</strong>
                </a>
            <?php else: ?>
                <a href="<?=\yii\helpers\Url::to(['login/index'])?>">
                    <span class="fixeBoxSpan iconfont icon-yonghu"></span> <strong>用户</strong>
                </a>
            <?php endif;?>
        </li>

        <li class="fixeBoxLi Service "> <span class="fixeBoxSpan iconfont icon-service"></span> <strong>客服</strong>
            <div class="ServiceBox">
                <div class="bjfffs"></div>

                <dl onclick="javascript:;">
                    <dd> <strong style="float: left;top:12px;left: 30px;position: absolute">QQ客服1</strong>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=591813762&site=qq&menu=yes">
                            <img border="0" src="http://wpa.qq.com/pa?p=2:591813762:52" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
                    </dd>
                    <br><br>
                    <dd> <strong style="float: left;top:52px;left: 30px;position: absolute">QQ客服2</strong>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=211663882&site=qq&menu=yes">
                            <img border="0" style="" src="http://wpa.qq.com/pa?p=2:211663882:52" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
                    </dd>
                </dl>

            </div>
        </li>
        <li class="fixeBoxLi code cart_bd " style="display:block;" id="cartboxs">
            <span class="fixeBoxSpan iconfont icon-erweima"></span> <strong>微信</strong>
            <div class="cartBox">
                <div class="bjfff"></div>
                <div class="QR_code">
                    <p><img src="<?=\yii\helpers\Url::to('@web/images/two-code.png')?>" width="150px" height="150px" style=" margin-top:10px;" /></p>
                    <span style="color: #000">微信扫一扫，关注我们</span>
                </div>
            </div>
        </li>
        <li class="fixeBoxLi Home">
            <?php if(\yii\helpers\Html::encode($this->params['info']['id'])>0): ?>
                <a href="<?=\yii\helpers\Url::to(['personal/collect'])?>">
                    <span class="fixeBoxSpan iconfont icon-shoucang"></span> <strong>收藏</strong>
                </a>
            <?php else: ?>
                <a href="<?=\yii\helpers\Url::to(['login/index'])?>">
                    <span class="fixeBoxSpan iconfont icon-shoucang"></span> <strong>收藏</strong>
                </a>
            <?php endif;?>
        </li>
        <li class="fixeBoxLi Home">
            <?php if(\yii\helpers\Html::encode($this->params['info']['id'])): ?>
                <a href="<?=\yii\helpers\Url::to(['personal/footprint'])?>">
                    <span class="fixeBoxSpan iconfont icon-zuji"></span> <strong>足迹</strong>
                </a>
            <?php else: ?>
                <a href="<?=\yii\helpers\Url::to(['login/index'])?>">
                    <span class="fixeBoxSpan iconfont icon-zuji"></span> <strong>足迹</strong>
                </a>
            <?php endif;?>
        </li>

        <li class="fixeBoxLi Home">
            <?php if(\yii\helpers\Html::encode($this->params['info']['id'])): ?>
                <a href="<?=\yii\helpers\Url::to(['personal/feedback'])?>">
                    <span class="fixeBoxSpan iconfont icon-fankui"></span> <strong>反馈</strong>
                </a>
            <?php else: ?>
                <a href="<?=\yii\helpers\Url::to(['login/index'])?>">
                    <span class="fixeBoxSpan iconfont icon-fankui"></span> <strong>反馈</strong>
                </a>
            <?php endif;?>
        </li>
        <li class="fixeBoxLi BackToTop"> <span class="fixeBoxSpan iconfont icon-top"></span> <strong>返回顶部</strong> </li>
    </ul>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
