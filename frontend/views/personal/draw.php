
<?=\yii\helpers\Html::cssFile('@web/css/main.css')?>
<?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
<?=\yii\helpers\Html::jsFile('@web/js/main.js')?>


<!--<div class="i_bg bg_color">
    <div class="m_content">
        <include file="Public/user_left"/>
        <div class="right_style">
            <div class="info_content">-->
                <!--积分样式-->
                <div class="integral">
                    <div class="title_Section" style="height: 100px;">
                        <span>用户抽奖规则</span><br />
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.每个用户每天只限抽奖一次</span><br />
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.抽中的积分会累加到用户积分</span><br />
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.大家可以用积分去积分商城购买商品</span><br />
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.祝大家玩的开心愉快&hearts;</span><br />
                    </div>
                    <div class="user_integral_style slideTxtBox">
                        <!-- <div class="hd"></div>-->
                        <div class="bd">
                            <ul style="margin-top: -50px;margin-left: -100px;">
                                <div class="turnplate_box">
                                    <canvas id="myCanvas" width="300px" height="300px">抱歉！浏览器不支持。</canvas>
                                    <canvas id="myCanvas01" width="200px" height="200px">抱歉！浏览器不支持。</canvas>
                                    <canvas id="myCanvas03" width="200px" height="200px">抱歉！浏览器不支持。</canvas>
                                    <canvas id="myCanvas02" width="150px" height="150px">抱歉！浏览器不支持。</canvas>
                                    <button id="tupBtn" class="turnplatw_btn"></button>
                                </div>
                                <!-- 更改系统默认弹窗 -->
                                <script type="text/javascript">
                                    window.alert = function(str) {
                                        $.post("<?=\yii\helpers\Url::to(['personal/draw'])?>",{str:str},function (res) {
                                            if(res.code==1){
                                                layer.msg(res.body,{icon:1,time:1000})
                                            }else{
                                                layer.msg(res.body,{icon:2,time:1000})
                                            }
                                        },'json');
                                    }
                                </script>
                            </ul>

                        </div>
                    </div>
                </div>
            <!--</div>
        </div>
    </div>
</div>-->
