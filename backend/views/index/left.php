<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>左侧菜单页</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.js')?>

    <script type="text/javascript">
        $(function(){
            //导航切换
            $(".menuson .header").click(function(){
                var $parent = $(this).parent();
                $(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();

                $parent.addClass("active");
                if(!!$(this).next('.sub-menus').size()){
                    if($parent.hasClass("open")){
                        $parent.removeClass("open").find('.sub-menus').hide();
                    }else{
                        $parent.addClass("open").find('.sub-menus').show();
                    }
                }
            });

            // 三级菜单点击
            $('.sub-menus li').click(function(e) {
                $(".sub-menus li.active").removeClass("active");
                $(this).addClass("active");
            });

            $('.title').click(function(){
                var $ul = $(this).next('ul');
                $('dd').find('.menuson').slideUp();
                if($ul.is(':visible')){
                    $(this).next('.menuson').slideUp();
                }else{
                    $(this).next('.menuson').slideDown();
                }
            });
        })
    </script>


</head>

<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>后台管理</div>
    <dl class="leftmenu">

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>
                <a href="<?=\yii\helpers\Url::to(['index/main'])?>" target="rightFrame">后台首页</a>
            </div>
        </dd>
        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>系统管理
            </div>
            <ul class="menuson">

                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['feedback/index'])?>" target="rightFrame">商城反馈</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('AdminNav/index')}" target="rightFrame">菜单列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['admin/index'])?>" target="rightFrame">管理员列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['admin/add'])?>" target="rightFrame">添加管理员</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('AdminNav/add')}" target="rightFrame">菜单列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('AdminNav/add')}" target="rightFrame">添加菜单</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>角色管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Admin/index')}" target="rightFrame">角色列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Admin/add')}" target="rightFrame">添加角色</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>权限管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Admin/index')}" target="rightFrame">权限列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Admin/add')}" target="rightFrame">添加权限</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>广告管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['advertise/index'])?>" target="rightFrame">广告列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['advertise/add'])?>" target="rightFrame">添加广告</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>商品管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['goods/index'])?>" target="rightFrame">商品列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['goods/add'])?>" target="rightFrame">添加商品</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Goods/index')}" target="rightFrame">用户评论</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="{:U('Goods/addAct')}" target="rightFrame">商品回收站</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>品牌管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['brand/index'])?>" target="rightFrame">品牌列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['brand/add'])?>" target="rightFrame">添加品牌</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>分类管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['category/index'])?>" target="rightFrame">分类列表</a>
                        <i></i>
                    </div>
                </li>

                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['category/add'])?>" target="rightFrame">添加分类</a>
                        <i></i>
                    </div>
                </li>

            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>促销管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['sale/index'])?>" target="rightFrame">限时抢购</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['sale/vote'])?>" target="rightFrame">投票系统</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['sale/activity','activity'=>2])?>" target="rightFrame">节日狂欢</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['sale/activity','activity'=>3])?>" target="rightFrame">十年店庆</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>会员管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['member/index'])?>" target="rightFrame">会员列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['member/level'])?>" target="rightFrame">会员等级</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>订单管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index'])?>" target="rightFrame">订单列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index','status'=>1])?>" target="rightFrame">待付款订单</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index','status'=>2])?>" target="rightFrame">待发货订单</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index','status'=>3])?>" target="rightFrame">已发货订单</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index','status'=>4])?>" target="rightFrame">未评价订单</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['order/index','status'=>5])?>" target="rightFrame">已完成订单</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>新闻管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['news/index'])?>" target="rightFrame">新闻列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['news/add'])?>" target="rightFrame">新闻发布</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['news/comment'])?>" target="rightFrame">评论列表</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>拍卖专场
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['auction/index'])?>" target="rightFrame">拍卖列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['auction/bidding'])?>" target="rightFrame">竞价记录</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['auction/bargain'])?>" target="rightFrame">成交记录</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>文章管理
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['article/index'])?>" target="rightFrame">文章列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['article/add'])?>" target="rightFrame">添加文章</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="<?=\yii\helpers\Url::to('@web/images/leftico01.png')?>" /></span>积分商城
            </div>
            <ul class="menuson">
                <li class="active">
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['integral/index'])?>" target="rightFrame">商品列表</a>
                        <i></i>
                    </div>
                </li>
                <li>
                    <div class="header">
                        <cite></cite>
                        <a href="<?=\yii\helpers\Url::to(['integral/add'])?>" target="rightFrame">添加商品</a>
                        <i></i>
                    </div>
                </li>
            </ul>
        </dd>
    </dl>

    <!--<dl class="leftmenu">
        <notempty name="navList">
            <volist name="navList" id="v1">
                <dd>
                    <div class="title">
                        <span><img src="__PUBLIC__/Admin/images/leftico01.png" /></span>{$v1.navname}
                    </div>
                    <ul class="menuson">
                        <notempty name="v1['child']">
                            <volist name="v1['child']" id="v2" key="k">
                                <li class={$k==1?"active":''}>
                                    <div class="header">
                                        <cite></cite>
                                        <a href="{:U($v2['navurl'])}" target="rightFrame">{$v2.navname}</a>
                                        <i></i>
                                    </div>
                                </li>
                            </volist>
                        </notempty>
                    </ul>
                </dd>
            </volist>
        </notempty>
    </dl>-->
</body>
</html>
