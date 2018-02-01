
<?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
<?=\yii\helpers\Html::jsFile('@web/js/echarts.min.js')?>

<style type="text/css">
    body .demo-class .layui-layer-title{background:#F4DDB2; border: none;}
    body .demo-class .layui-layer-content{background:#F4DDB2; border: none;}
    .active1{
        background-color: red;
        color: white;
    }
    label{
        cursor: pointer;
    }
</style>
<style>/*好评度css*/
    #main>div{display: block !important;}
</style>
<!--产品详细页样式-->
<div class="clearfix Inside_pages">
    <div class="Location_link">
        <em></em><a href="#">进口食品、进口牛{$Think.session.sum}</a>  &lt;   <a href="#">进口饼干/糕点</a>    &lt;   <a href="#">销售产品名称</a>
    </div>
    <!--产品详细介绍样式-->
    <div class="clearfix" id="goodsInfo">
        <!--产品图片放大-->
        <div class="mod_picfold clearfix">
            <div class="clearfix" id="detail_main_img">
                <div class="layout_wrap preview">
                    <div id="vertical" class="bigImg">
                        <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb800/800_').\yii\helpers\Html::encode($info['pic']);?>" width="" height="" alt="" id="midimg" />
                        <div id="winSelector"></div>
                    </div>
                    <div class="smallImg">
                        <div class="scrollbutton smallImgUp disabled">&lt;</div>
                        <div id="imageMenu">
                            <ul>
                                <?php foreach($info['pics'] as $v): ?>
                                    <li>
                                        <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb350/350_').$v['picname'];?>" width="68" height="68" alt="洋妞"/>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="scrollbutton smallImgDown">&gt;</div>
                    </div><!--smallImg end-->
                    <div id="bigView" style="display:none;"><div><img width="800" height="800" alt="" src="" /></div></div>
                </div>
            </div>
            <div class="Sharing">
                <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1441079683326">
                    <a href="#" class="bds_more" data-cmd="more">分享到：</a>
                    <div class="bdsharebuttonbox">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    </div>
                </div>
                <script>
                    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/__PUBLIC__/Home/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                </script>
                <!--收藏-->
                <?php if($collectGoods): ?>
                    <div class="Collect" style="color: red;cursor: pointer" onclick="collect({$val['id']},this);"><em class="ico1" style="background-position:0 -438px;"></em>收藏商品</div>
                <?php else: ?>
                    <div class="Collect" style="cursor: pointer" onclick="collect({$val['id']},this);"><em class="ico1"></em>收藏商品</div>
                <?php endif;?>
            </div>
        </div>
        <script type="text/javascript">
            //收藏
            function collect(id,val) {
                $.post("<?=\yii\helpers\Url::to(['goods/collect'])?>", {id: id}, function (res) {
                    if(res.code==3){
                        layer.confirm('您还未登陆哦', {
                            btn: ['登录','取消'] //按钮
                        }, function(){
                            window.location.href="<?=\yii\helpers\Url::to(['login/index'])?>";
                        });
                    }else if(res.code==1){
                        layer.msg(res.msg,{icon:6,time:1000});
                        $(val).children("em").css({ "background-position": " 0 -438px" });
                        $(val).css({color:"red"})
                    }else{
                        layer.msg(res.msg,{icon:5,time:1000});
                        $(val).children("em").css({ "background-position": " 0 -415px" });
                        $(val).css({color:"black"})
                    }
                },'json')
            }
        </script>
        <!--产品信息-->
        <div class="property">
            <form action="<?=\yii\helpers\Url::to(['cart/addtobuy'])?>" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY">
                <input type="hidden" name="gid" value="<?=\yii\helpers\Html::encode($info['id'])?>">
                <input type="hidden" name="price" value="<?=\yii\helpers\Html::encode($info['price'])?>">
                <h2><?=\yii\helpers\Html::encode($info['goodsname'])?></h2>
                <div class="goods_info"><?=\yii\helpers\Html::encode($info['introduction'])?></div>
                <div class="ProductD clearfix">
                    <div class="productDL">
                        <dl><dt>售&nbsp;&nbsp;价：</dt><dd><span id="ECS_SHOPPRICE"><i>￥</i><?=\yii\helpers\Html::encode($info['price'])?></span><del>市场价：￥<?=\yii\helpers\Html::encode($info['marketprice'])?></del></dd> </dl>
                        <dl><dt>上架时间：</dt><dd><?=date("Y-m-d",\yii\helpers\Html::encode($info['addtime']))?></dd></dl>
                        <!--<div class="Appraisal"><p>销售评价</p><a>1234</a> </div>-->
                    </div>
                </div>
                <div class="buyinfo" id="detail_buyinfo">
                    <dl>
                        <dt>数量</dt>
                        <dd>
                            <div class="choose-amount left">
                                <!--<a class="btn-reduce" href="javascript:;" onclick="setAmount.reduce('#buy-num')">-</a>-->
                                <!--<a class="btn-add" href="javascript:;" onclick="setAmount.add('#buy-num')">+</a>-->
                                <a class="btn-reduce" id="jia" href="javascript:jian();">-</a>
                                <a class="btn-add" id="jian" href="javascript:jia();">+</a>
                                <input class="text" name="buynum" id="buy-num" value="1" onkeyup="setAmount.modify('#buy-num');">
                            </div>
                            <div class="P_Quantity">剩余：<?=\yii\helpers\Html::encode($info['num'])?>件</div>
                        </dd>
                        <dd>
                            <div class="wrap_btn">
                                <a href="javascript:addToBuy()" class="wrap_btn2" title="立即购买"></a>
                                <a href="javascript:addToCart()" class="wrap_btn1" title="加入购物车"></a>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="Guarantee clearfix">
                    <dl><dt>支付方式</dt><dd><em></em>货到付款（部分地区）</dd><dd><em></em>在线支付</dd>
                        <dd> <div class="payment" id="payment">
                                <a href="javascript:void(0);" class="paybtn">支付方式<span class="iconDetail"></span></a><ul><li>货到付款</li><li>礼品卡支付</li><li>网上支付</li><li>银行转账</li></ul>
                            </div>
                        </dd>
                    </dl>
                </div>
            </form>
        </div>
        <!--推荐-->
        <div class="p_right_info">
            <div class="Brands">
                <a href="javascript:text();"><img src="<?=\yii\helpers\Url::to('@web/images/products/logo/chat.jpg')?>"  width="120" height="60"/></a>
                <script type="text/javascript">
                    function text(){
                        layer.open({
                            type: 2,
                            shade: false,
                            area: ['700px', '660px'],
                            title:'聊天室',
                            //content: 'http://localhost:55151/',
                            content: "<?=\yii\helpers\Url::to(['chat-room/index'])?>",
                            zIndex: layer.zIndex, //重点1
                            success: function(layero){
                                layer.setTop(layero); //重点2
                            }
                        });
                    }
                </script>
                <h5 style="color:orange;">开心聊天室</h5>
            </div>
            <div class="Recommend">
                <div class="title_name">同类产品推荐</div>
                <div class="Recommend_list">
                    <ul>
                        <?php foreach($recommend as $v): ?>
                            <li class="clearfix">
                                <div class="pic_img">
                                    <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['id'])])?>">
                                        <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['pic'])?>" data-bd-imgshare-binded="1">
                                    </a>
                                </div>
                                <div class="r_content">
                                    <div class="title"><a href="#"><?=\yii\helpers\Html::encode($v['goodsname'])?></a></div>
                                    <div class="p_Price">￥<?=\yii\helpers\Html::encode($v['price'])?></div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--样式-->
    <div class="clearfix">
        <!--引入浏览历史文件-->
        <div class="left_style">
            <div class="user_Records">
                <div class="title_name">用户浏览记录</div>
                <ul>
                    <?php foreach($historyList as $v): ?>
                        <li>
                            <a href="<?=\yii\helpers\Url::to(['goods/index','gid'=>\yii\helpers\Html::encode($v['gid'])])?>">
                                <p><img src="<?=\yii\helpers\Url::to('@web/uploads/goods/').\yii\helpers\Html::encode($v['goods']['pic']);?>" data-bd-imgshare-binded="1"></p>
                                <p class="p_name"><?=\yii\helpers\Html::encode($v['goods']['goodsname'])?></p>
                            </a>
                            <p><span class="p_Price"><i>￥</i><?=\yii\helpers\Html::encode($v['goods']['price'])?></span><b><?=\yii\helpers\Html::encode($v['goods']['marketprice'])?></b></p>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <!--引入浏览历史文件-->
        <!--介绍信息样式-->
        <div class="right_style">
            <div class="inDetail_boxOut ">
                <div class="inDetail_box">
                    <div class="fixed_out ">

                        <ul class="sit" style="width: 950px;height: 41px;background: white">
                            <li class="active1" style="width: 231px;border: 1px solid #ccc;height: 40px;display: block;font-size: 15px;text-align: center;line-height: 40px;float: left;cursor: pointer">商品详情</li>
                            <li style="width: 231px;border: 1px solid #ccc;height: 40px;display: block;font-size: 15px;text-align: center;line-height: 40px;float: left;cursor: pointer">卖家承诺</li>
                            <li class="sdetail" style="width: 231px;border: 1px solid #ccc;height: 40px;display: block;font-size: 15px;text-align: center;line-height: 40px;float: left;cursor: pointer">买家评论<span class="aaa">(<?=\yii\helpers\Html::encode($count)?>)</span></li>
                        </ul>
                        <div class="subbuy" style="width: 220px;height: 40px;text-align: center">
                            <span class="extra currentPrice"><?=\yii\helpers\Html::encode($info['price'])?></span>
                            <a href="javascript:addToBuy()" class="extra  notice J_BuyButtonSub">立即购买</a></div>
                    </div>
                    <div class="change" style="max-height: 30000px;position: relative">
                        <div class="active2">
                            <?php foreach($info['pics'] as $v): ?>
                                <img src="<?=\yii\helpers\Url::to('@web/uploads/goods/thumb800/800_').\yii\helpers\Html::encode($v['picname']);?>"/>
                            <?php endforeach;?>
                        </div>
                        <div style="display: none;text-align: left;width:1000px;line-height: 30px">
                            <pre>
                            <p style="text-align: center">质量安全承诺书</p>
                            为了认真贯彻执行《食品安全法》和《农产品质量安全法》，确保农产品流通安全，本市场（店）郑重承诺：
                            一、严格依照《食品安全法》、《农产品质量安全法》等法律法规从事农产品经营活动，对社会和公众负责，诚信经营，保证所经营农产品的安全，<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;接受社会监督，承担社会责任。
                            二、具有与经营的品种、数量相适应的农产品包装、贮存等场地且符合下列要求：
                            1、经营场所与有毒、有害场所以及其他污染源保持规定距离；
                            2、经营场所与个人生活空间分开；
                            3、经营场所保持内部环境整洁；【水果产品质量承诺书】
                            三、具有与经营的品种、数量相适应防腐、洗涤以及处理废水、存放垃圾和废弃物的设备或者设施且符合下列要求：
                            1、设备及设施空间布局和操作流程设计符合规定，合理布局；
                            2、贮存、运输和装卸农产品的容器、工具和设备安全、无害、保持清洁，符合保证安全所需的温度等特殊要求，不得将农产品与有毒、有害物品一起运输；
                            3、备有数量足够、安全无害的工具、容器，标志明显，防止直接入口农产品与非直接入口农产品类食品、原料与成品交叉污染；
                            4、容器、工具和设备与个人生活用品严格分开。
                            四、建立食品进货查检记录制度。采购农产品时查验供货者的农产品合格的证明文件，并如实记录农产品的名称、规格、数量、供货者名称及联系方<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;式、进货日期等内容，保存期限不少于二年。
                            五、所经营的下列农产品符合农产品质量安全规定的要求。
                            1、蔬菜（含食用菌）、水果类——有机磷类、氨基甲酸脂类农药残留，重金属含量符合质量安全要求。
                            2、畜禽类——不含瘦肉精、莱克多巴胺及激素类。
                            3、水产类——甲醛、氯霉素及重金属含量不超标。
                            六、实行市场准入制度
                            【水果产品质量承诺书】
                            1、创造条件设立检测室，配备配备符合检测要求的速测仪器和专职的检测人员，适时开展农产品质量检测工作，并将检测结果在醒目位置公示。
                            2、对获得国家无公害农产品（产地）、绿色食品、有机食品的食用农产品，凭认证证书和专用标志直接进入市场销售；国外入境上市农产品凭入境<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;检验检疫证书入市销售。
                            3、对行业行政主管部门认定的无公害农产品生产基地的产品和实行定点屠宰并取得检疫合格证的畜产品，实行索证抽检。凭农产品产地认定证书<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;、近期产品检测合格证明和畜产品定点屠宰印章、检疫合格证可以直接进入市场销售；无近期产品检测合格证明的，进行现场抽检，合格后方可进入市场销售。
                            4、对来源于非认证基地的农产品并且未取得任何认证的产品，实行现场检测，由市场开办者进行检测，经检测合格后，进入市场销售。
                            5、不盗用、伪造使用无公害、绿色、有机农产品标示，以及农产品产地证明。
                            七、实行不合格农产品退市制度
                            对检测不合格的农产品，禁止进入市场销售，进行退市、无害化处理或销毁，并向农产品质量监管部门报告。
                            八、实行质量安全结果公示制度
                            应在场内显著位置设立“农产品质量安全公示牌”，对进场销售的农产品质量安全状况进行公示。公示内容包括农产品的品名、产地、质量安全状况等信息。
                            九、实行标识管理制度
                            制作不同标识牌，挂牌销售，推行产品分级包装和产地标识管理。标识牌要注明产品名称、产地、生产者、生产日期、产品质量等内容。
                            十、销售明知是不符合食品安全标准的农产品，承诺赔偿消费者损失，并支付价款十倍的赔偿金。自觉接受群众监督。
                            十一、以上承诺如有违反，自愿接受农产品质量管理部门依照法律法规给予的处罚。
                        </pre></div>
                        <div style="display:none;">
                            <h2 style="font-size: 25px;margin-right: 300px;">全部评论 </h2>
                            <d style="position: relative;display: block;width: 82%;height: 100px;border: 1px solid #c2ccd1;margin-top: 20px">
                                <p style="height: 60%;width:100px;border-right: 1px solid #c2ccd1;margin-top: 20px;text-align: center">好评率<br>
                                    <r class="lvlv" style="width: 98px;height: 98px;text-align: center;font-size: 23px;color: orangered">0</r>
                                </p>
                                <div id="main" style="width: 600px;height:100px;position: absolute;left: 130px;bottom: -5px"></div>
                            </d>

                            <form action="<?=\yii\helpers\Url::to(['goods/comment'])?>" method="post">
                                <ul id="ul">
                                    <br>
                                    <label><input name="one" id="b1" type="radio"  checked="checked" value="0" />全部</label>
                                    <label><input name="one" id="b2" type="radio"  value="1" />好评</label>
                                    <label><input name="one" id="b3" type="radio" value="2" />中评</label>
                                    <label><input name="one" id="b4" type="radio" value="3" />差评</label>　
                                </ul>

                                <ul id="showComment" class="jiesou" style="margin-top: 50px;color: #6c6c6c;height:1000px;overflow: auto;">

                                    <!--<li style="float: left;width: 1000px"><li>买家评论:{$val.commentcontent}</li><li style="width: 200px;float: right;"> {$val.username}</li></li>
                                    <p>{$val['addtime']|date="Y/m/d",###}</p>
                                        <br>
                                    <li style="color: orangered;width: 600px">卖家回复:
                                        <if condition="$val['isreply'] eq 1">
                                            {$val['replycontent']}
                                            <else/>
                                            亲的好评对小店来说是多么重要，它是对小店服务的肯定，更是对小店工作的默默支持，它激发了小店追求更高标准的潜力，让小店感觉到一切的付出都是那么的值得，感谢亲的支持，相信小店会做的更好，因为有亲。也希望亲时刻记得有小店这样一位朋友在期待亲的再次光临！
                                        </if>
                                    </li>-->
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--分享-->
        <script type="text/javascript">
            window._bd_share_config={
                "common":{
                    "bdPopTitle":"您的自定义pop窗口标题",
                    "bdSnsKey":{},
                    "bdText":"此处填写自定义的分享内容",
                    "bdMini":"2",
                    "bdMiniList":false,
                    "bdPic":"http://localhost/centlight/public/attachment/201410/24/14/5449ef39574f5_282x220.jpg", /* 此处填写要分享图片地址 */
                    "bdStyle":"0",
                    "bdSize":"16"
                },
                "share":{}
            };
            with(document)[
                (getElementsByTagName('head')[0]||body).
                appendChild(createElement('script')).
                    src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)
            ];
            function substr(s, n) {
                return s.slice(0, n).replace(/([^x00-xff])/g, "$1a").slice(0, n).replace(/([^x00-xff])a/g, "$1");
            }
            alert(substr(str,15));
        </script>


        <script type="text/javascript">
            var bate="";
            $(function(){
                $('.sit li').click(function(){
                    var i=$(this).index();
                    $('.sit li').removeClass('active1').eq(i).addClass('active1');
                    $('.change').children('div').hide().eq(i).show();
                })
            })
            $(function () {
                $('.sdetail').click(function () {
                    var gid=$('#gid').val();
                    $.post("{:U('shower')}",'gid='+gid,function (res) {
                        var str='';
                        for(var i in res){
                            str+="<div style='width:200px;height: 80px'><img src=";
                            str+=res[i].pic?'__PUBLIC__/Admin/Uploads/member/thumb100/100_'+res[i].pic:'__PUBLIC__/Home/images/h1.png';
                            str+= " style='width: 60px;height: 60px;border-radius: 100px' /><p><li style='width: 200px;float: right'> 会员:"+res[i].username+"</li></p></div>"
                            str+="买家评论:";
                            str+="<li style='float: left;width: 1000px'><li>"+res[i].commentcontent+"</li>";
                            s=+res[i].cad+"%";
                            for(var m in res[i].picname){
                                str+="<img src='__PUBLIC__/Admin/Uploads/comments/"+res[i].picname[m]['picname']+"' ' style='height:100px;width:100px'>";
                            }
                            str+="<br><p style='float: right'>"+res[i].addtime+"</p><br>";
                            str+="卖家回复:<li style='color:#AF874D'>";
                            /* str+="<p style='float: right'>"+res[i].addtime+"</p><br>";
                             str+="卖家回复:<li style='color:#AF874D'>";*/
                            if(res[i].isreply== 1){
                                str+= ""+res[i].replycontent+"<br><br><hr style='color: #c5d9e8;width: 100%'><br></div>";
                            }else{
                                str+="亲的好评对小店来说是多么重要,它是对小店服务的肯定,更是对小店工作的默默支持,它激发了小店追求更高标准的潜力,让小店感觉到一切的付出都是<br>那么的值得,感谢亲的支持,相信小店会做的更好,因为有亲.也希望亲时刻记得有小店这样一位朋友在期待亲的再次光临!<br><br><hr style='color: #c5d9e8;width: 100%'></li><br></div>";
                            }
                        }
                        $('.jiesou').html(str);
                        $('.lvlv').html(s);

                        //统计图开始部分
                        s=(parseFloat(s)/100).toFixed(2);
                        // 基于准备好的dom，初始化echarts实例
                        var myChart = echarts.init(document.getElementById('main'));
                        // 指定图表的配置项和数据
                        var option = {
                            legend: {
                                data:['好评度']
                            },
                            tooltip: {},

                            yAxis: {
                                data: ["好评度"]

                            },
                            xAxis: {
                                max:1
                            },
                            series: [{
                                type: 'bar',
                                data: [s]
                            }]
                        };
                        // 使用刚指定的配置项和数据显示图表。
                        myChart.setOption(option);
                        //统计图结束部分
                    },'json')
                })
            })
        </script>
    </div>
</div>
<input type="hidden" id="gid" value="{$gid}"/>
<input type="hidden" id="mid" value="{$Think.session.mid}"/>
<!--图片放大效果-->
<?=\yii\helpers\Html::jsFile('@web/js/jqzoom.js')?>
<script language="javascript">
    function updatenum(type){
        var qty = parseInt(document.forms['ECS_FORMBUY'].elements['number'].value);
        if(type == 'del'){
            if(qty > 1){
                document.forms['ECS_FORMBUY'].elements['number'].value = (qty - 1);
            }
        }else{
            document.forms['ECS_FORMBUY'].elements['number'].value = (qty + 1);
        }
        //changePrice();
    }
    function dorank(rank_id){
        var rank_id;
        $("#rank").val(rank_id);
    }
    function send_cooment(){
        $(".commentBox").toggle();
    }
    function checkLength(which) {
        var maxChars = 1000; //
        if(which.value.length > maxChars){
            alert("您出入的字数超多限制!");
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    }
</script>
<script type="text/javascript">
    //加
    function jia(){
        var num=document.getElementById("buy-num").value;
        num++;
        if(num > {$detailInfo['num']}){
            num={$detailInfo['num']};
        }
        document.getElementById("buy-num").value=num;
    }
    //减
    function jian(){
        var num=document.getElementById("buy-num").value;
        num--;
        if(num  <= 1){
            num=1;
        }
        document.getElementById("buy-num").value=num;
    }
    //加入购物车
    function addToCart(){
        var gid=$('#gid').val();
        $.post("<?=\yii\helpers\Url::to(['cart/add'])?>",$("#ECS_FORMBUY").serialize(),function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['cart/add'])?>?gid="+gid;
                })
            }else{
                layer.msg(res.msg,{icon:2,time:1000});
            }
        },'json');
    }

    //立即购买
    function addToBuy(){
        //判断用户是否登陆过
        var mid=$('#mid').val();
        if(mid){
            $.post("<?=\yii\helpers\Url::to(['order/create-order'])?>",$("#ECS_FORMBUY").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['order/index'])?>oid="+res.oid;
                    })
                }else{
                    layer.msg(res.msg,{icon:2,time:1000})
                }
            });
        }else{
            layer.open({
                type:2,
                title:"",
                skin:'demo-class',
                area:["480px","56%"],
                shadeClose: true,
                shade: 0.8,
                content:"<?=\yii\helpers\Url::to(['login/login'])?>"
            })
        }
    }
</script>
<!--详情的js-->
<script type="text/javascript">
    $(function () {
        $("#ul input").click(function () {
            /*var i=$(this).index();*/
            var star=$(this).val();
            var gid=$('#gid').val();
            $.post("{:U('Detail/shower')}",{'star':star,'gid':gid},function(res){

                var str='';
                for(var i in res){
                    str+="<div style='width:200px;height: 80px'><img src=";
                    str+=res[i].pic?'__PUBLIC__/Admin/Uploads/member/thumb100/100_'+res[i].pic:'__PUBLIC__/Home/images/h1.png';
                    str+= " style='width: 60px;height: 60px;border-radius: 100px' /><p><li style='width: 200px;float: right'> 会员:"+res[i].username+"</li></p></div>";
                    /* str+="<div style='width: 200px;height: 80px'>" +
                             "<if condition='"+res.i.pic+" eq null'><img src='__PUBLIC__/Home/images/h1.png' style='width: 60px;height: 60px;border-radius: 100px'><else/><img src='__PUBLIC__/Admin/Uploads/member/thumb100/100_"+res[i].pic+"' alt='wutu' style='width: 60px;height: 60px;border-radius: 100px'></if>";
                     str+= "<p><li style='width: 200px;float: right'> 会员:"+res[i].username+"</li></p></div>"*/

                    str+="买家评论:<br>";
                    str+="<li style='float: left;width: 1000px'><li>"+res[i].commentcontent+"</li>";
                    s=+res[i].cad+"%";
                    for(var m in res[i].picname){
                        str+="<img src='__PUBLIC__/Admin/Uploads/comments/"+res[i].picname[m]['picname']+"' alt='wutu' style='height: 100px;width: 100px'>";
                    }
                    str+="<br><p style='float: right'>"+res[i].addtime+"</p><br>";
                    str+="卖家回复:<li style='color:#AF874D'>";

                    if(res[i].isreply== 1){
                        str+= ""+res[i].replycontent+"<br><br><hr style='color: #c5d9e8;width: 82%'><br>";
                    }else{
                        str+="亲的好评对小店来说是多么重要,它是对小店服务的肯定,更是对小店工作的默默支持,它激发了小店追求更高标准的潜力,让小店感觉到一切的付出都是<br>那么的值得,感谢亲的支持,相信小店会做的更好,因为有亲.也希望亲时刻记得有小店这样一位朋友在期待亲的再次光临!<br><br><hr style='color: #c5d9e8;width: 100%'></li><br>";
                    }
                }
                $('#showComment').html(str);


            },'json')
            /*commentcontent,username,replycontent,shop_goods_comment.addtime,isreply*/
        });
    })
</script>
<script type="text/javascript">
    $(function(){
        //评论列表
        $('.sdetail').click(function () {
            var gid=$('#gid').val();
            $.post("<?=\yii\helpers\Url::to(['goods/comment'])?>",{gid:gid},function (res) {
                var str='';
                for(var i in res){
                    str+="<div style='width:200px;height: 80px'><img src=";
                    str+=res[i].pic?'__PUBLIC__/Admin/Uploads/member/thumb100/100_'+res[i].member.pic:'<?=\yii\helpers\Url::to("@web/images/h1.png")?>';
                    str+= " style='width: 60px;height: 60px;border-radius: 100px' /><p><li style='width: 200px;float: right'> 会员:"+res[i].member.username+"</li></p></div>"
                    str+="买家评论:";
                    str+="<li style='float: left;width: 1000px'><li>"+res[i].commentcontent+"</li>";
                    s=+res[i].cad+"%";
                    for(var m in res[i].picname){
                        str+="<img src='__PUBLIC__/Admin/Uploads/comments/"+res[i].picname[m]['picname']+"' ' style='height:100px;width:100px'>";
                    }
                    str+="<br><p style='float: right'>"+res[i].addtime+"</p><br>";
                    str+="卖家回复:<li style='color:#AF874D'>";
                    /* str+="<p style='float: right'>"+res[i].addtime+"</p><br>";
                     str+="卖家回复:<li style='color:#AF874D'>";*/
                    if(res[i].isreply== 1){
                        str+= ""+res[i].replycontent+"<br><br><hr style='color: #c5d9e8;width: 100%'><br></div>";
                    }else{
                        str+="亲的好评对小店来说是多么重要,它是对小店服务的肯定,更是对小店工作的默默支持,它激发了小店追求更高标准的潜力,让小店感觉到一切的付出都是<br>那么的值得,感谢亲的支持,相信小店会做的更好,因为有亲.也希望亲时刻记得有小店这样一位朋友在期待亲的再次光临!<br><br><hr style='color: #c5d9e8;width: 100%'></li><br></div>";
                    }
                }
                $('.jiesou').html(str);
                $('.lvlv').html(s);

                //统计图开始部分
                s=(parseFloat(s)/100).toFixed(2);
                // 基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('main'));
                // 指定图表的配置项和数据
                var option = {
                    legend: {
                        data:['好评度']
                    },
                    tooltip: {},

                    yAxis: {
                        data: ["好评度"]

                    },
                    xAxis: {
                        max:1
                    },
                    series: [{
                        type: 'bar',
                        data: [s]
                    }]
                };
                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);
                //统计图结束部分
            },'json')
        })
    })
</script>
