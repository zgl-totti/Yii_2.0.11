<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员登记表</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/select.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.idTabs.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/select-ui.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/echarts.min.js')?>

    <style type="text/css">
        .lev{
            margin: 20px 150px;
            width: 160px;
            cursor: pointer;
        }
        .lev img{
            height:84px ;
            width: 100px;

        }
        .lev span{
            width: 100px;
            text-align: center;

        }
        .active{
            margin: 0 auto;
            background-color: rgba(10,214,245,0.3);
            padding:1px;
            border-radius: 155px;
        }
        .catepage{
            float: right;
            margin-top:30px ;
        }
        .catepage a{
            border-radius: 50px;
            margin: 2px;
            width: 25px;
            height: 25px;
            line-height: 25px;
            border: 1px solid #ccc;
            display: inline-block;
            text-align: center;
            background-color:#3C95C8 ;
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
        .tablelist tr th{
            text-align: center;
        }

    </style>
    <script type="text/javascript">
        $(function(){
            $('.sit ul').click(function(){
                var i=$(this).index();
                $('.sit ul').removeClass('active').eq(i).addClass('active');
                $('.change table').hide().eq(i).show();
            })
        })
    </script>
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm('确定要更改状态吗？',{
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['member/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:2000},function(){
                                location="<?=\yii\helpers\Url::to(['member/level'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:2000})
                        }
                    },'json')
                })
            })
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm('确定要删除吗？',{
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['member/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:6,time:2000},function(){
                                location="<?=\yii\helpers\Url::to(['member/level'])?>";
                            })
                        }else{
                            layer.msg(res.body,{icon:5,time:2000})
                        }
                    },'json')
                })
            })
        })
    </script>
</head>
<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">会员等级</a></li>
        </ul>
    </div>
    <div style="width: 1250px">
        <div class="sit" style="float: left;width: 400px">
            <ul class="active">
                <li class="lev"><img src="<?=\yii\helpers\Url::to('@web/images/y4.jpg')?>" alt="">
                    <span>花费￥0-2999<br>普通会员(<?=\yii\helpers\Html::encode($count['count1'])?>)</span>
                </li>
            </ul>
            <ul >
                <li class="lev"><img  src="<?=\yii\helpers\Url::to('@web/images/y1.jpg')?>" alt="">
                    <span>花费￥3000-4999<br>青铜会员(<?=\yii\helpers\Html::encode($count['count2'])?>)</span>
                </li>
            </ul>
            <ul>
                <li class="lev"><img src="<?=\yii\helpers\Url::to('@web/images/y2.jpg')?>" alt="">
                    <span>花费￥5000-7999<br>白银会员(<?=\yii\helpers\Html::encode($count['count3'])?>)</span>
                </li>
            </ul>
            <ul>
                <li class="lev"><img src="<?=\yii\helpers\Url::to('@web/images/y3.jpg')?>" alt="">
                    <span>花费￥8000-9999<br>黄金会员(<?=\yii\helpers\Html::encode($count['count4'])?>)</span>
                </li>
            </ul>
            <ul>
                <li class="lev"><img src="<?=\yii\helpers\Url::to('@web/images/y5.jpg')?>" alt="">
                    <span>花费￥10000+<br>钻石会员(<?=\yii\helpers\Html::encode($count['count5'])?>)</span>
                </li>
            </ul>
        </div>
        <div class="change" style="float: left;width: 600px;height: 722px;background-color: rgba(10,214,245,0.3);">
            <!-- <yi-->
            <table class="tablelist" style="text-align: center">
                <tr>
                    <th>编号</th>
                    <th>id</th>
                    <th>会员名</th>
                    <th>等级</th>
                    <th>余额</th>
                    <th>花费</th>
                    <th>积分</th>
                    <th>状态控制</th>
                </tr>
                <?php foreach($list['list1'] as $k=>$v): ?>
                    <tr style="border-bottom: 1px solid whitesmoke">
                        <td width="80px"><?=$pages['pages1']->page*$pages['pages1']->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del" style="color: red">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages['pages1']])?></div>
            <!--  //er-->
            <table class="tablelist" style="text-align: center;display: none">
                <tr>
                    <th>编号</th>
                    <th>id</th>
                    <th>会员名</th>
                    <th>等级</th>
                    <th>余额</th>
                    <th>花费</th>
                    <th>积分</th>
                    <th>状态控制</th>
                </tr>
                <?php foreach($list['list2'] as $k=>$v): ?>
                    <tr style="border-bottom: 1px solid whitesmoke">
                        <td width="80px"><?=$pages['pages2']->page*$pages['pages2']->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del" style="color: red">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages['pages2']])?></div>
            <!--  //er-->
            <table class="tablelist" style="text-align: center;display: none">
                <tr>
                    <th>编号</th>
                    <th>id</th>
                    <th>会员名</th>
                    <th>等级</th>
                    <th>余额</th>
                    <th>花费</th>
                    <th>积分</th>
                    <th>状态控制</th>
                </tr>
                <?php foreach($list['list3'] as $k=>$v): ?>
                    <tr style="border-bottom: 1px solid whitesmoke">
                        <td width="80px"><?=$pages['pages3']->page*$pages['pages3']->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del" style="color: red">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages['pages3']])?></div>

            <table class="tablelist" style="text-align: center;display: none">
                <tr>
                    <th>编号</th>
                    <th>id</th>
                    <th>会员名</th>
                    <th>等级</th>
                    <th>余额</th>
                    <th>花费</th>
                    <th>积分</th>
                    <th>状态控制</th>
                </tr>
                <?php foreach($list['list4'] as $k=>$v): ?>
                    <tr style="border-bottom: 1px solid whitesmoke">
                        <td width="80px"><?=$pages['pages4']->page*$pages['pages4']->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del" style="color: red">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages['pages4']])?></div>

            <table class="tablelist" style="text-align: center;display: none">
                <tr>
                    <th>编号</th>
                    <th>id</th>
                    <th>会员名</th>
                    <th>等级</th>
                    <th>余额</th>
                    <th>花费</th>
                    <th>积分</th>
                    <th>状态控制</th>
                </tr>
                <?php foreach($list['list5'] as $k=>$v): ?>
                    <tr style="border-bottom: 1px solid whitesmoke">
                        <td width="80px"><?=$pages['pages5']->page*$pages['pages5']->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['id'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['username'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['level_name'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['money'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['costs'])?></td>
                        <td><?=\yii\helpers\Html::encode($v['credit'])?></td>
                        <td>
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink operate">
                                <?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用';?>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del" style="color: red">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages['pages5']])?></div>

        </div>
        <div id="main" style="width: 600px;height:600px;float: left"></div>
    </div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        myChart.setOption({
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:{$count}, name:'普通会员'},
                        {value:{$count1}, name:'青铜会员'},
                        {value:{$count2}, name:'白银会员'},
                        {value:{$count3}, name:'黄金会员'},
                        {value:{$count4}, name:'钻石会员'}
                    ]
                }
            ]
        })
    </script>
</body>
    <script type="text/javascript">
        //禁用
        function disabled(aid){
            layer.confirm("确定禁用？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/disabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/level')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        //启用
        function enabled(aid){
            layer.confirm("确定启用？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/enabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/level')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        //删除
        function del(aid){
            layer.confirm("确定删除？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Member/del')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Member/level')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>
</html>
