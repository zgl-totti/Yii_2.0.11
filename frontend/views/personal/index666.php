
<style type="text/css">
    body{ margin:0; padding:0; font-size:12px; font-family:"Microsoft YaHei"; line-height:25px; color:#555555;}
    div,table{ margin:0 auto;}
    a{ color:#555555; text-decoration:none; cursor:pointer;}
    a:hover{ color:#ff4e00; text-decoration:none; cursor:pointer;}
    img{border:0;}
    .i_bg{ width:100%; min-width:1200px; overflow:hidden;}
    .bg_color{background-color:#f6f6f6;}
    .m_content{width:1210px; overflow:hidden; margin-top:20px;}
    .m_left{width:211px; overflow:hidden; padding:5px; float:left;}
    .left_n{height:35px; line-height:35px; overflow:hidden; background:url(<?=\yii\helpers\Url::to('@web/images/sp/m_t.png')?>) no-repeat 31px center; background-color:#090909; color:#FFF; font-size:14px; text-indent:68px; margin-bottom:10px;}
    .left_m{overflow:hidden; background-color:#FFF; padding-bottom:20px; margin-bottom:10px; -webkit-box-shadow:0 0 5px #e0e0e0; -moz-box-shadow:0 0 5px #e0e0e0; box-shadow:0 0 5px #e0e0e0;}
    .left_m_t{height:35px; line-height:35px; overflow:hidden; color:#3e3e3e; font-size:14px; text-indent:68px; margin-bottom:10px; border-bottom:1px solid #e2e2e2;}
    .t_bg1{background:url(<?=\yii\helpers\Url::to('@web/images/sp/m_i_1.png')?>) no-repeat 31px center;}
    .t_bg2{background:url(<?=\yii\helpers\Url::to('@web/images/sp/m_i_2.png')?>) no-repeat 31px center;}
    .t_bg3{background:url(<?=\yii\helpers\Url::to('@web/images/sp/m_i_3.png')?>) no-repeat 31px center;}
    .t_bg4{ background:url(<?=\yii\helpers\Url::to('@web/images/sp/m_i_4.png')?>) no-repeat 31px center;}
    .left_m ul li{height:28px; line-height:28px; overflow:hidden; color:#3e3e3e; text-indent:68px;}
    .left_m ul li a{color:#3e3e3e;}
    .left_m ul li a:hover, .left_m ul li a.now{ color:#ff4e00;}
    .m_right{width:970px; height:auto !important; min-height:540px; height:737px; background-color:#FFF; float:right; display:inline; margin:5px; padding-bottom:50px; -webkit-box-shadow:0 0 5px #e0e0e0; -moz-box-shadow:0 0 5px #e0e0e0; box-shadow:0 0 5px #e0e0e0;}
</style>
<div class="i_bg bg_color">
    <!--Begin 用户中心 Begin -->
    <div class="m_content">
        <div class="m_left">
            <div class="left_n">管理中心</div>
            <div class="left_m">
                <div class="left_m_t t_bg2">会员中心</div>
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/member'])?>">用户信息</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/level'])?>">会员等级</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/collect'])?>">我的收藏</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/footprint'])?>">我的足迹</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/auction'])?>">我的拍卖</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/integral'])?>">我的积分</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/comment'])?>">我的评论</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/draw'])?>">幸运抽奖</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg1">订单中心</div>
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/order'])?>">我的订单</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/address'])?>">收货地址</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg4">购物中心</div>
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/my-cart'])?>">购物车</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg4">我的信息</div>
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['message/unread'])?>">未读信息<font color="red">(<?=\yii\helpers\Html::encode($num1)?>)</font></a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['message/read'])?>">已读信息<font color="red">(<?=\yii\helpers\Html::encode($num2)?>)</font></a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg3">账户中心</div>
                <ul>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/account'])?>">账户安全</a></li>
                    <li><a href="<?=\yii\helpers\Url::to(['personal/feedback'])?>">用户反馈</a></li>
                </ul>
            </div>
        </div>
        <div class="m_right">
            <!--右侧内容样式-->
            <div class="right_style">
                <div class="info_content">
                    <div class="Notice"><span>系统最新公告:</span>为了更好地服务于商城的会员朋友及读者 发表意见。</div>
                    <div class="user_info">
                        <ul class="">
                            <li class="Balance" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/account'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_05.png')?>" /><h4>余额：￥<?=\yii\helpers\Html::encode($info['money'])?></h4></a></li>
                            <li class="Order_form" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/order'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_04.png')?>" /><h4>订单：(<?=\yii\helpers\Html::encode($sum)?>)</h4></a></li>
                            <li class="grade" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/my-cart'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_09.png')?>" />
                                <h4>购物车数量 : <?=\yii\helpers\Html::encode($cart)?></h4>
                            </a></li>
                            <li class="Favorable" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/level'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_07.png')?>" /><h4><?=\yii\helpers\Html::encode($info['level']['level_name'])?></h4></a></li>
                            <li class="integral" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/integral'])?>{:U('Personal/point')}"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_06.png')?>" /><h4><?=\yii\helpers\Html::encode($info['credit'])?>分</h4></a></li>
                        </ul>
                    </div>
                    <!--样式-->
                    <div class="user_info_p_s  clearfix">
                        <!--订单记录-->
                        <div class="left_user_cont" style="width:600px;float: left;left: 0">
                            <div class="us_Orders left clearfix" style="width:600px;float: left;left: 0">
                                <div class="Orders_name">
                                    <div class="title_name">
                                        <div class="Records">购买记录</div>
                                        <div class="right select">只记录你最近30天的购买三条记录   </div>
                                    </div>
                                </div>
                                <table style="width:600px;float: left;left: 0">
                                    <thead>
                                    <tr>
                                        <th>产品名称</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($list as $v): ?>
                                        <tr>
                                            <td>
                                                <?php foreach($v['orderGoods'] as $v1): ?>
                                                    <li>
                                                        <a href="#" class="img"><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb100/100_').\yii\helpers\Html::encode($v1['info']['pic']);?>" width="80" height="80"></a>
                                                        <a href="#" class="title" style="line-height: 60px;"><?=mb_substr(\yii\helpers\Html::encode($v1['info']['goodsname']),0,15,'utf-8')?></a>
                                                    </li>
                                                <?php endforeach;?>
                                            </td>
                                            <td><?=\yii\helpers\Html::encode($v['status']['status_name'])?></td>
                                            <td>
                                                <?php foreach($v['orderGoods'] as $v1): ?>
                                                    <br><li>
                                                        <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v1['gid'])])?>" class="View">查看</a>
                                                    </li><br>
                                                <?php endforeach;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <div class="us_jls"><a href="<?=\yii\helpers\Url::to(['personal/order'])?>" style="margin-top: 10px;font-size: 20px;">查看更多</a></div>
                            </div>
                        </div>
                        <!--右侧记录样式--><!--这放一个日历插件-->
                        <!--右侧记录样式-->
                        <div class="right_user_recording" style="width: 350px;">
                            <div class="us_Record" style="width: 350px;">
                                <div id="Record_p" class="Record_p">
                                    <div class="title_name" style="text-align: center;font-size: 20px;font-weight: bolder">精美日历</div>
                                </div>
                                <div id="calendar" class="y" style="width:230px;float: left;left:0;">
                                </div>
                            </div>
                        </div>
                        <!--结束-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End 用户中心 End-->
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.min.1.8.2.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery-ui-datepicker.min.js')?>
    <script type="text/javascript">
        $('#calendar').datepicker({
            inline: true,
            firstDay: 1,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        });
    </script>
    <style type="text/css">
        .footer{margin-top:100px;text-align:center;color:#666;font:bold 14px Arial}
        .footer a{color:#999;text-decoration:none}
        #wrapper{padding: 50px 0 0 325px;}#calendar{margin:25px auto; width: 200px;}
        /* Reset */
        .ui-datepicker,
        .ui-datepicker table,
        .ui-datepicker tr,
        .ui-datepicker td,
        .ui-datepicker th {
            margin: 0;
            padding: 0;  border: none;  border-spacing: 0;  }
        /* Calendar Wrapper */
        .ui-datepicker {  display: none;  width: 294px;  padding: 15px;  cursor: default;
            text-transform: uppercase;  font-family: Tahoma;  font-size: 12px;  background: rgba(0, 0, 0, 0.24);  -webkit-border-radius: 3px;  -moz-border-radius: 3px;  border-radius: 3px;  }
        /* Calendar Header */
        .ui-datepicker-header {  position: relative;  padding-bottom: 10px;  border-bottom: 1px solid #d6d6d6;  }
        .ui-datepicker-title { text-align: center; }
        /* Month */
        .ui-datepicker-month {  position: relative;  padding-right: 15px;  color: #000;  }
        .ui-datepicker-month:before {  display: block;  position: absolute;  top: 5px;  right: 0;  width: 5px;  height: 5px;  content: '';
            background: #a5cd4e;
            background: -moz-linear-gradient(top, #a5cd4e 0%, #6b8f1a 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a5cd4e), color-stop(100%,#6b8f1a));
            background: -webkit-linear-gradient(top, #a5cd4e 0%,#6b8f1a 100%);
            background: -o-linear-gradient(top, #a5cd4e 0%,#6b8f1a 100%);
            background: -ms-linear-gradient(top, #a5cd4e 0%,#6b8f1a 100%);
            background: linear-gradient(top, #a5cd4e 0%,#6b8f1a 100%);
            -webkit-border-radius: 5px;  -moz-border-radius: 5px;  border-radius: 5px;  }
        .ui-datepicker-prev span,
        .ui-datepicker-next span{  display: block;  width: 5px;  height: 10px;  text-indent: -9999px;  background-image: url(img/arrows.png);  }
        .ui-datepicker-prev span { background-position: 0px 0px; }
        .ui-datepicker-next span { background-position: -5px 0px; }
        .ui-datepicker-prev-hover span { background-position: 0px -10px; }
        .ui-datepicker-next-hover span { background-position: -5px -10px; }
        /* Calendar "Days" */
        .ui-datepicker-calendar th {  padding-top: 15px;  padding-bottom: 10px;  text-align: center;  font-weight: normal;  color: #000;  }
        .ui-datepicker-calendar td {  padding: 0 7px;  text-align: center;  line-height: 26px;  }
        .ui-datepicker-calendar .ui-state-default {  display: block;  width: 26px;  outline: none;  text-decoration: none;  color: #fff;  border: 1px solid transparent;}
        /* Day Active State*/
        .ui-datepicker-calendar .ui-state-active {color: #6a9113;border-color: #6a9113;}
        /* Other Months Days*/
        .ui-datepicker-other-month .ui-state-default { color: #565656; }
    </style>
