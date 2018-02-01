<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台首页</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/echarts.min.js')?>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
    </ul>
</div>
<div class="mainindex">
    <div class="welinfo">
        <span><img src="<?=\yii\helpers\Url::to('@web/images/sun.png')?>" alt="天气" /></span>
        <b><?=\yii\helpers\Html::encode($info->username)?> 早上好，欢迎使用后台管理系统</b>
    </div>
    <div class="welinfo">
        <span><img src="<?=\yii\helpers\Url::to('@web/images/time.png')?>" alt="时间" /></span>
        <i>您上次登录的时间：<?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($info->logintime))?></i> <i>;您上次登录IP：<?=\yii\helpers\Html::encode($info->loginip)?> </i> ;如非本人操作，请及时更改密码
    </div>
    <!--<ul class="iconlist">
       <li><img src="__PUBLIC__/Admin/images/ico01.png" /><p><a href="#">管理设置</a></p></li>
       <li><img src="__PUBLIC__/Admin/images/ico02.png" /><p><a href="#">发布文章</a></p></li>
       <li><img src="__PUBLIC__/Admin/images/ico03.png" /><p><a href="#">数据统计</a></p></li>
       <li><img src="__PUBLIC__/Admin/images/ico04.png" /><p><a href="#">文件上传</a></p></li>
       <li><img src="__PUBLIC__/Admin/images/ico05.png" /><p><a href="#">目录管理</a></p></li>
       <li><img src="__PUBLIC__/Admin/images/ico06.png" /><p><a href="#">查询</a></p></li>
    </ul> -->
    <div class="xline"></div>
    <div class="box"></div>
    <div class="welinfo">
        <span><img src="<?=\yii\helpers\Url::to('@web/images/dp.png')?>" alt="提醒" /></span>
        <b>服务器信息</b>
    </div>
    <ul class="infolist">
        <li><span>服务器软件：<?=\yii\helpers\Html::encode($_SERVER['SERVER_SOFTWARE'])?></span></li>
        <li><span>开发语言：<?=\yii\helpers\Html::encode($_SERVER['SERVER_SOFTWARE'])?></span></li>
        <li><span>数据库: <?=\yii\helpers\Html::encode($_SERVER['SERVER_SOFTWARE'])?></span></li>
    </ul>
    <div class="xline"></div>
    <div class="uimakerinfo"><b>版权所有：易购网</b>(<a href="http://www.egoods.com" target="_blank"><?=\yii\helpers\Html::encode($_SERVER['SERVER_NAME'])?></a>)</div>
    <div id="main1" style="width: 40%;height:600px;float: right;"></div>
    <div id="main" style="width: 60%;height:600px;position: absolute"></div>
    <?php /*foreach($goods as $v):*/?><!--
    <p><?/*=mb_substr(\yii\helpers\Html::encode($v['goodsname']),0,5,'utf-8');*/?></p>
    --><?php /*endforeach;*/?>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '商品销量排行'
            },
            tooltip: {},
            legend: {
                data:['数值','销量前十']
            },
            xAxis : [
                {
                    //type : 'category',
                    data : [
                        <?php foreach($goods as $v):
                        echo "'".mb_substr(\yii\helpers\Html::encode($v['goodsname']),0,5,'utf-8')."',";
                    endforeach;?>
                    ]
                }
            ],
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data:[
                    <?php foreach($goods as $v):
                    echo \yii\helpers\Html::encode($v['salenum']).',';
                endforeach;?>
                ],
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                }
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main1'));
        myChart.setOption({
            title : {
                text: '会员等级占比',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            calculable : true,
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:<?=$count['num1']?>, name:'普通会员'},
                        {value:<?=$count['num2']?>, name:'青铜会员'},
                        {value:<?=$count['num3']?>, name:'白银会员'},
                        {value:<?=$count['num4']?>, name:'黄金会员'},
                        {value:<?=$count['num5']?>, name:'钻石会员'}
                    ]
                }
            ]
        })
    </script>
</div>
</body>
</html>
