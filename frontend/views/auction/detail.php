<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery-1.9.1.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/layer/layer.js')?>
    <style>
        #box{width:440px;height:570px;margin:0 auto;border:1px solid gray;}
        table tr{height:40px;line-height:40px;font-size:16px;}
        table tr td{padding-left:20px;color:#000}
        #submoney{border-radius:10px;text-decoration:none;color:white;background-color:#FF3333;/*background:transparent;*/height:40px;width:150px;font-size:20px;border:1px solid gray;cursor:pointer;}
        #sub{border-radius:10px;text-decoration:none;color:white;background-color:#FF3333;/*background:transparent;*/height:40px;width:150px;font-size:20px;border:1px solid gray;cursor:pointer;}
        #submoney:hover{background-color:#ff6c5c;}
        #sub:hover{background-color: #ff6c5c;}
        button.btn{margin-left:20px;margin-top:10px;}
        input{padding-left:10px;}
        #timer{color:#FF3333;font-weight:bolder}
    </style>
</head>
<body>
    <div id="box">
        <form action="#" id="form1">
        <input type="hidden" value="<?=\yii\helpers\Html::encode($info['starttime'])?>" id="start"/>
        <input type="hidden" value="<?=\yii\helpers\Html::encode($info['endtime'])?>" id="end"/>
        <input type="hidden" value="<?=\yii\helpers\Html::encode($info['id'])?>" name="ag_id" id="agid"/>
        <table>
            <tr>
                <td>商品名称：</td>
                <td style="color:red;font-weight:bolder"><?=mb_substr(\yii\helpers\Html::encode($info['goods']['goodsname']),0,18,'utf-8')?></td>
            </tr>
            <tr>
                <td>当前价格：</td>
                <td>￥<font color="#FF3333" size="6"><?=\yii\helpers\Html::encode($info['auctionPrice'])?></font> <em>RMB</em></td>
            </tr>
            <tr>
                <td>起拍价格：</td>
                <td>￥<?=\yii\helpers\Html::encode($info['startprice'])?> RMB</td>
            </tr>
            <tr>
                <td>保底价格：</td>
                <td>￥<?=\yii\helpers\Html::encode($info['commonprice'])?> RMB</td>
            </tr>
            <tr>
                <td>最高价格：</td>
                <td>￥<?=\yii\helpers\Html::encode($info['maxprice'])?> RMB</td>
            </tr>
            <tr>
                <td>加价幅度：</td>
                <td><?=\yii\helpers\Html::encode($info['range'])?></td>
            </tr>
            <tr>
                <td>宝贝数量：</td>
                <td><?=\yii\helpers\Html::encode($info['goods']['num'])?></td>
            </tr>
            <tr>
                <td>出价人数：</td>
                <td><?=\yii\helpers\Html::encode($info['totalNum'])?>人</td>
            </tr>
            <tr>
                <td>出价次数：</td>
                <td><?=\yii\helpers\Html::encode($info['perpleNum'])?>次</td>
            </tr>
            <tr>
                <td>剩余时间：</td>
                <td id="timer"></td>
            </tr>
            <tr>
                <td>竞拍价格：</td>
                <td>
                    <button id="jian">-</button>
                    <input id="offer" name="auctionprice" placeholder="出价" type="text" size="3">
                    <button id="jia">+</button>
                </td>
            </tr>
        </table>
                <button class="btn" id="submoney">报名交保证金</button>
                <button class="btn" id="sub">确定出价</button>
        </form>
    </div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        //交易保证金
        $("#submoney").click(function(){
            layer.confirm("最低保证金为当前竞拍商品最高价的一半",{icon:6,btn:['同意','算了']},function(){
                layer.prompt({
                    title:"请输入保证金"
                },function(value,index,elem){
                    var val=value;
                    var id=$("#agid").val();
                    $.post("<?=\yii\helpers\Url::to(['auction/deposit'])?>",{deposit:val,ag_id:id},function(res){
                        if(res.code==1){
                            layer.alert(res.body,{icon:6});
                        }else{
                            layer.alert(res.body,{icon:5});
                        }
                    })
                    layer.close(index);
                })
            })
            return false;//阻止表单默认提交
        });

        //确认出价
        $("#sub").click(function(){
            $.post("<?=\yii\helpers\Url::to(['auction/detail'])?>",$("#form1").serialize(),function(res){
                if(res.code==1){
                    layer.alert(res.body,{icon:6},function(){
                        parent.location.reload();
                    })
                }else{
                    layer.alert(res.body,{icon:5})
                }
            })
            return false;
        })
    })
</script>
<script type="text/javascript">
    //时间处理
    $(function(){
        setInterval(changTime, 1000);    //每一秒都循环一次函数
        function changTime(){
            document.getElementById("timer").innerHTML = getTime1();
        }
        function getTime1() {
            var now = new Date().getTime(); //获取当前的
            var end = ($('#end').val()) * 1000;
            var temp = end - now;
            if (temp <= 0) {
                return "拍卖已收场 ";
            } else {
                var temp2 = new Date();
                temp2.setTime(temp);
                var sec = Math.floor((temp) / 1000 % 60);
                var min = Math.floor(temp / (60 * 1000) % 60);
                var hou = Math.floor(temp / (60 * 60 * 1000) % 24);
                var day = Math.floor(temp / (24 * 60 * 60 * 1000));
                return day + "天 " + hou + "小时 " + min + "分钟 " + sec + "秒";
            }
        }
    })
    //出价额度和幅度处理
    document.getElementById("offer").value=<?=$info['auctionPrice']?>;
    var offer1=document.getElementById("offer").value;
    offer1=parseInt(offer1);
    $(function(){
        //出价框失去焦点时
        $("#offer").blur(function(){
            var offer2=parseInt($("#offer").val());
            //出价框时区焦点时，文本值不能小于当前起拍价
            if(offer1>offer2){
                $("#offer").val(offer1);
            }else{
                $("#offer").val(offer2);
            }
        })
        //减少按钮被点击时
        var range=parseInt(<?=$info['range']?>);//获得加价幅度
        var nowPrice=parseInt(<?=$info['auctionPrice']?>);
        $("#jian").click(function(){
            var offer2=parseInt($("#offer").val());
            var res=offer2-range;
            if(res<nowPrice){
                $("#offer").val(nowPrice);
            }else{
                $("#offer").val(res);
            }
            return false;//阻止表单默认提交
        })
        //增加按钮被点击时
        var maxPrice=parseInt(<?=$info['maxprice']?>);
        $("#jia").click(function(){
            var offer2=parseInt($("#offer").val());
            var res=parseInt(offer2)+parseInt(range);
            if(res>maxPrice){
                $("#offer").val(maxPrice);
            }else{
                $("#offer").val(res);
            }
            return false;//阻止表单默认提交
        })
    })
</script>