
<div class="Notice"><span>系统最新公告:</span>为了更好地服务于商城的会员朋友及读者 发表意见。</div>
<div class="user_info">
    <ul class="">
        <li class="Balance" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/account'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_05.png')?>" /><h4>余额：￥<?=\yii\helpers\Html::encode($info['money'])?></h4></a></li>
        <li class="Order_form" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/order'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_04.png')?>" /><h4>订单：(<?=\yii\helpers\Html::encode($sum)?>)</h4></a></li>
        <li class="grade" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/my-cart'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_09.png')?>" />
                <h4>购物车数量 : <?=\yii\helpers\Html::encode($cart)?></h4>
            </a></li>
        <li class="Favorable" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/level'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_07.png')?>" /><h4><?=\yii\helpers\Html::encode($info['level']['level_name'])?></h4></a></li>
        <li class="integral" style="width: 170px;"><a href="<?=\yii\helpers\Url::to(['personal/integral'])?>"><img src="<?=\yii\helpers\Url::to('@web/images/user_img_06.png')?>" /><h4><?=\yii\helpers\Html::encode($info['credit'])?>分</h4></a></li>
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
