
    <style type="text/css">
        *{margin:0;padding:0;list-style-type:none;}
        a,img{border:0;}
        body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";}
        .error{
            color: red;
            display: block;
        }
        .catepage{

            margin-top:30px ;
        }
        .catepage a{
            border-radius: 50px;
            margin: 2px;
            width: 25px;
            height: 15px;
            line-height: 15px;
            border: 1px solid #ccc;
            display: inline-block;
            text-align: center;
            background-color:orangered;
            padding: 5px;
            font-weight: bolder;

        }
        .catepage a:hover{
            background-color: white;
            color: #00aaee;
            font-weight: bolder;
        }
        .current{
            border-radius: 50px;
            width: 25px;
            height: 25px;
            border: 1px solid #ccc;
            line-height: 23px;
            display: inline-block;
            padding: 5px;
            text-align: center;
        }
        .zan{
            background-color: #ccc;
            border: 1px solid #6c6c6c;
            border-radius: 10px;
            height: 130px;
            float: left;
            margin-left: 150px;;
            position: absolute;
            left: 600px;
           top: 580px;
        }
    </style>

    <!--<script src="__PUBLIC__/Home/js/login/jquery.validate.js"></script>
    <script>
        $(function () {
            var Obj=$('.form1').validate({
                rules:{
                    content:{
                        required:true,
                        minlength:6,
                        maxlength:1000
                    }
                },
                messages:{
                    content:{
                        required:'请填写评论',
                        minlength:'用户名至少6个字符',
                        maxlength:'用户名最多1000个字符'
                    }
                }
            })
            $('.btn').click(function(){
                if (Obj.form()){
                    $.post("{:U('News/sendInfo')}", $('.form1').serialize(), function (res) {
                        if (res.status ==1) {
                            layer.msg(res.msg,{
                                icon: 1,
                                time:1000
                            },function () {
                               window.location.reload();
                                $(".btn").attr('disabled','true');
                                $(".btn").val("已提交");
                            });
                        } else {
                            layer.msg(res.msg,{
                                icon: 2,
                                time:1000
                            });
                        }
                    }, 'json')
                }
            })
        })
    </script>-->


<div style="width: 1200px;margin: 0px auto">
    <img src="<?=\yii\helpers\Url::to('@web/images/AD/ad-4.jpg')?>" alt=""  >
</div>
<div style="width: 1200px;margin: 0 auto;left: 5px">
    <!--文章内容-->
    <div style="position: relative">
        <div class="neirong" style="width: 980px;max-height:500px;min-height:100px;overflow: auto;float: left;">
            <p style="text-align: center;font-size: 25px;font-weight: bold;margin-top: 50px;"><?=\yii\helpers\Html::encode($info['title'])?></p>
            <p style="text-align: center;font-size: 15px;font-weight: bold;margin-top: 50px;"><?=\yii\helpers\Html::encode($info['author'])?>&nbsp;&nbsp;&nbsp;<?=date('Y-m-d',\yii\helpers\Html::encode($info['addtime']))?></p>
            <m style="margin:60px 50px;line-height: 40px;padding-top: 30px;font-size: 15px"><?=\yii\helpers\Html::encode($info['content'])?></m>
            <div class="zan" style="color: orangered;font-size: 25px;padding-top: 20px;">
                <div id="fondNum" style="text-align: center"><?=\yii\helpers\Html::encode($info['likenum'])?></div>
                <img class="likeBtn" style="display: block;cursor:pointer;width: 80px" src="<?=\yii\helpers\Url::to('@web/images/dianzan.jpg')?>" alt="">
                <div class="likeBtn" style="font-size: 25px;text-align: center;cursor:pointer">+</div>
            </div>
        </div>
    </div>

    <div style="width: 199px;height: 280px;line-height: 20px;border: 5px solid orangered;border-radius: 10px;float: left;margin-top: 50px">
        <table style="margin: 0 auto">
            <th colspan="2" style="font-size: 20px;text-align: center;margin: 0px auto;color: orangered">最近新闻</th>
            <br>
            <?php foreach($news as $v): ?>
                <tr style="border-bottom: 1px solid #ccc;color: #ccc">
                    <td style="color: #ccc;height: 30px"><a style="color: #6c6c6c" href="<?=\yii\helpers\Url::to(['news/index','id'=>$v['id']])?>" target="_self" ><?=\yii\helpers\Html::encode($v['title'])?></a></td>
                    <td style="color: #ccc "><?=date('Y-m-d',\yii\helpers\Html::encode($v['addtime']))?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>

    <!--//评论区-->
    <form action="#" class="form1">
        <input id="nid" type="hidden" name="nid" value="<?=\yii\helpers\Html::encode($info['id'])?>">
        <div class="comment" style="clear: both;padding-top: 50px;">
            <div style="font-size: 20px;color: orangered;">会员评论</div>
            <textarea name="content" class="content"  placeholder="文明上网,登录评论 !" style="border: 1px solid #6c6c6c;width: 500px;margin: 20px 0;height: 100px;display: block;float: left"></textarea>
            <input type="button" value="提交评论" class="btn" style="margin:20px 0;font-size: 18px;width: 120px;height: 40px;clear:both; display: block;">
        </div>
    </form>
</div>
<div style="width:1200px;margin: 0 auto;">
    <div class="response" style="width: 600px;max-height:600px;line-height: 30px;border: 1px solid #ccc;border-radius: 10px;margin-top: 80px;">
        <p style="font-size: 18px">全部评论</p>
        <br>
        <?php foreach($list as $v): ?>
            <dl>
                <dd style="padding-left:20px ">用户名:<?=\yii\helpers\Html::encode($v['member']['username'])?></dd>
                <dd style="padding-left: 50px;color: #6c6c6c">评论:<?=\yii\helpers\Html::encode($v['commentcontent'])?><dd style="padding-left: 50px;margin-right: 300px;color: #6c6c6c">评论时间:<?=date('Y/m/d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></dd></dd>
            </dl>
        <?php endforeach;?>
        <div class="catepage" style="with:100px;padding-left: 20px">
            <?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
        </div>
    </div>
</div>
<div></div>
<script type="text/javascript">
    $(function () {
        $('.btn').click(function(){
            $.post("<?=\yii\helpers\Url::to(['news/comment'])?>", $('.form1').serialize(), function (res) {
                if (res.code ==1) {
                    layer.msg(res.body,{
                        icon: 1,
                        time:1000
                    },function () {
                        window.location.reload();
                        $(".btn").attr('disabled','true');
                        $(".btn").val("已提交");
                    });
                } else {
                    layer.msg(res.body,{
                        icon: 2,
                        time:1000
                    });
                }
            }, 'json')
        });
        $(".likeBtn").click(function(){
            var id=$("#nid").val();
            $.post("<?=\yii\helpers\Url::to(['news/like-num'])?>",{id:id},function (res) {
                if(res.code==1){
                    $("#fondNum").html(res.body);
                }
            },'json')
        })
    })
    /*function addToLogin(){
        //判断用户是否登陆过
        var mid=$('#mid').val();
        if( mid){
            $.post("/index.php/Home/Order/toBuyCreateOrder.html",$("#ECS_FORMBUY").serialize(),function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href="/index.php/Home/Order/showlist.html?oid="+res.oid;
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
                content:"/index.php/Home/Detail/tologin.html"
            })
        }
    }*/
</script>
