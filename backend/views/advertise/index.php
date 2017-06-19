<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>列表页</title>
    <?=\yii\helpers\Html::cssFile('@web/css/style.css')?>
    <?=\yii\helpers\Html::cssFile('@web/css/select.css')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/jquery.idTabs.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/js/select-ui.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $(".select1").uedSelect({
                width : 345
            });
            $(".select2").uedSelect({
                width : 167
            });
            $(".select3").uedSelect({
                width : 100
            });
        });

    </script>
    <style type="text/css">
        div.pagin{background-color: red;}
        div.pagin div{float: right}
        div.pagin span{text-align:center;line-height: 30px; display: inline-block;width: 30px;height: 30px; background-color:orange;}
        div.pagin a{text-align:center;line-height: 30px;display: inline-block;width: 30px;height: 30px; background-color:gray;}
    </style>
</head>
<body>
	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">广告管理</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div id="usual1" class="usual">
            <div id="tab2" class="tabson">
                <ul class="seachform">
                    <form action="<?=\yii\helpers\Url::to(['advertise/index'])?>" method="get">
                        <li><label>广告查询</label><input name="adname" type="text" class="scinput" value="<?=\yii\helpers\Html::encode($adname?$adname:'')?>" /></li>
                        <li><label>位置</label>
                            <div class="vocation">
                                <select class="select3" name="adposition">
                                        <option value="0" >首页轮播</option>
                                        <option value="1" >一楼</option>
                                        <option value="2" >二楼</option>
                                        <option value="3">三楼</option>
                                        <option value="4">四楼</option>
                                        <option value="5">活动</option>
                                        <option value="6">兑换</option>
                                        <option value="7">其他</option>
                                </select>
                            </div>
                        </li>
                        <li><label>&nbsp;</label><input name="scbtn" type="submit" class="scbtn" value="查询"/></li>
                    </form>
                </ul>
                <table class="tablelist">
                    <thead>
                <tr>
                    <!--<th><input name="" type="checkbox" value="" checked="checked"/></th>-->
                    <th>编号</th>
                    <th>广告标题</th>
                    <th>广告图片</th>
                    <th>广告位置</th>
                    <th>置顶</th>
                    <th>操作</th>
                </tr>
                </thead>
                    <tbody>
                    <?php foreach($list as $k=>$v): ?>
                    <tr>
                        <td><?=$pages->page*$pages->pageSize+$k+1;?></td>
                        <td><?=\yii\helpers\Html::encode($v['adname'])?></td>
                        <td><img src="<?=\yii\helpers\Url::to('@web/uploads/ads/').$v['adlogo']?>" width="150"></td>

                        <td>
                            <?php switch(\yii\helpers\Html::encode($v['adposition'])) :
                                case 0:
                                    echo '首页轮播';
                                    break;
                                case 1:
                                    echo '一楼';
                                    break;
                                case 2:
                                    echo '二楼';
                                    break;
                                case 3:
                                    echo '三楼';
                                    break;
                                case 4:
                                    echo '四楼';
                                    break;
                                case 5:
                                    echo '活动';
                                    break;
                                default :
                                    echo '其他';
                            endswitch;?>
                        </td>

                        <td>
                            <?=(\yii\helpers\Html::encode($v['top'])==0)?'隐藏':'展示';?>
                        </td>
                        <td>
                            <a class="tablelink edit" href="<?=\yii\helpers\Url::to(['advertise/edit','id'=>\yii\helpers\Html::encode($v['id'])])?>">编辑</a>&nbsp;&nbsp;
                            <a class="tablelink operate" href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>">
                                <?=(\yii\helpers\Html::encode($v['top'])==0)?'展示':'隐藏';?>
                            </a>&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink del">删除</a>&nbsp;&nbsp;
                            <a href="#" id="<?=\yii\helpers\Html::encode($v['id'])?>" class="tablelink top">
                                <?=(\yii\helpers\Html::encode($v['top'])==0)?'':'置顶';?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
                </table>
                <div class="pagin">
                    <div><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
          $("#usual1 ul").idTabs();
        </script>
        <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm('你确定要操作吗？',{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['advertise/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['advertise/index']);?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            });
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm('你确定要删除吗？',{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['advertise/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['adverise/index']);?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            })
        })
    </script>
</body>
<!--<script type="text/javascript">
        //禁用品牌
        function disabled(aid){
            layer.confirm("你确定要隐藏我吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Ads/disabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Ads/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        //启用品牌
        function enabled(aid){
            layer.confirm("你确定要展示我吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Ads/enabled')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Ads/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
        function zhiding(aid){
            layer.confirm("你确定要置顶我吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Ads/zhiding')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Ads/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>
    <script type="text/javascript">
        function del(aid){
            layer.confirm("你确定要删除吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Ads/del')}","id="+aid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Ads/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>-->
</html>
