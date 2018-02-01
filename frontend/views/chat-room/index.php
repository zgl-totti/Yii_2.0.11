<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>新建网页</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <?=\yii\helpers\Html::jsFile('@web/css/talk.css')?>

    <script type="text/javascript">
    </script>

    <style type="text/css">
    </style>
</head>
<body>
<div id="main">
    <div id="left">
        <h2>在线名单：（5人）</h2>
        <ul id="user">
            <li>帅哥：恶魔</li>
            <li>靓妹：甜甜</li>
            <li>帅哥：诸葛</li>
            <li>帅哥：成就梦想</li>
            <li>靓妹：郁金香</li>
        </ul>
        <ul id="anniu">
            <li><input type="button" value="刷新名单" ></li>
            <li><input type="button" value="刷新屏幕" ></li>
            <li><input type="button" value="退出聊天" ></li>
        </ul>
    </div>
    <div id="right">
        <div id="content">
            <h2 id="content-title">有什么意见和建议欢迎大家踊跃提出</h2>
            <hr />
            <div id="show_msg">
                <p style="color:red">PHP爱好者聊天室公告：欢迎恶魔来到聊天室(22:05:35)</p>
                <p>恶魔&nbsp;对&nbsp;大家&nbsp;微笑&nbsp;说：对啊(22:05:35)</p>
                <p>恶魔&nbsp;对&nbsp;大家&nbsp;微笑&nbsp;说：对啊(22:05:35)</p>
                <p style="color:#800080">恶魔&nbsp;对&nbsp;大家&nbsp;微笑&nbsp;说：好久不见了啊(22:05:35)</p>
                <p style="color:red">PHP爱好者聊天室公告：欢迎天使来到聊天室(22:05:35)</p>
                <p>天使&nbsp;对&nbsp;大家&nbsp;微笑&nbsp;说：你来了啊(22:05:35)</p>
            </div>
        </div>
        <div id="send">
            <div id="control">
                颜色：
                <select>
                    <option value="">请选择</option>
                    <option	style="color:#FF8888" value="#FF8888">爱的暗示</option>
                    <option	style="color:#00BBFF" value="#00BBFF">忧郁的蓝</option>
                    <option	style="color:#0000FF" value="#0000FF">碧空蓝天</option>
                    <option	style="color:#9F88FF" value="#9F88FF">灰蓝种族</option>
                    <option	style="color:#000088" value="#000088 ">蔚蓝海洋</option>
                    <option	style="color:#77FFEE" value="#77FFEE">清清之蓝</option>
                    <option	style="color:#4400B3" value="#4400B3">发亮篮紫</option>
                    <option	style="color:#A500CC" value="#A500CC">紫的拘谨</option>
                    <option	style="color:#B088FF" value="#B088FF">卡其制服</option>
                    <option	style="color:#D1BBFF" value="#D1BBFF">伦敦灰雾</option>
                    <option	style="color:#DC143C" value="#DC143C">卡布其诺</option>
                    <option	style="color:#A52A2A" value="#A52A2A">苦涩心红</option>
                    <option	style="color:#FF0000" value="#FF0000">正宗喜红</option>
                    <option	style="color:#990099" value="#990099">红的发紫</option>
                    <option style="color:#FF0000" value="#FF0000">红旗飘飘</option>
                    <option style="color:#D2691E" value="#D2691E ">黄金岁月</option>
                    <option style="color:#800080" value="#800080">紫金绣贴</option>
                    <option style="color:#006400" value="#006400">橄榄树绿</option>
                    <option style="color:#000000" value="#000000">绝对黑色</option>
                </select>
                表情：
                <select>
                    <option value="">请选择</option>
                    <option value="笑着">笑着</option>
                    <option value="高兴地">高兴地</option>
                    <option value="含情脉脉">含情脉脉</option>
                    <option value="微笑">微笑</option>
                    <option value="幸福">幸福</option>
                    <option value="有点脸红">有点脸红</option>
                    <option value="使劲安慰">使劲安慰</option>
                    <option value="自言自语">自言自语</option>
                    <option value="差点要哭">差点要哭</option>
                    <option value="嚎啕大哭">嚎啕大哭</option>
                    <option value="一把鼻涕">一把鼻涕</option>
                    <option value="很无辜">很无辜</option>
                    <option value="流口水">流口水</option>
                    <option value="神秘兮兮">神秘兮兮</option>
                    <option value="幸灾乐祸">幸灾乐祸</option>
                    <option value="很不服气">很不服气</option>
                    <option value="不怀好意">不怀好意</option>
                    <option value="拳打脚踢">拳打脚踢</option>
                    <option value="不知所措">不知所措</option>
                    <option value="翻箱倒柜">翻箱倒柜</option>
                    <option value="很遗憾">很遗憾</option>
                    <option value="很严肃">很严肃</option>
                    <option value="善意警告">善意警告</option>
                    <option value="正气凛然">正气凛然</option>
                    <option value="哈欠连天">哈欠连天</option>
                    <option value="小声的">小声的</option>
                    <option value="大声的">大声的</option>
                    <option value="尖叫一声">尖叫一声</option>
                    <option value="遗憾的">遗憾的</option>
                    <option value="无精打采">无精打采</option>
                    <option value="想吐">想吐</option>
                    <option value="真诚">真诚</option>
                    <option value="不好意思">不好意思</option>
                    <option value="扭捏的">扭捏的</option>
                    <option value="腼腆的">腼腆的</option>
                    <option value="很诧异">很诧异</option>
                    <option value="依依不舍">依依不舍</option>
                </select>
                聊天对象：
                <select>
                    <option>所有的人</option>
                </select>
                <br />
                <textarea id="msg"></textarea>
                <input type="button" value="发送" />

            </div>
        </div>
    </div>
</div>
</body>
</html>