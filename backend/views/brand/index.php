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
    <?=\yii\helpers\Html::jsFile('@web/js/jqurey.form.js')?>
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
    <script type="text/javascript">
        function getAll()
        {
            var tit = document.getElementById("operAll");
            var inputs = document.getElementsByTagName("input");
            for(var i = 0; i < inputs.length; i++)
            {
                if(inputs[i].type == "checkbox")
                {
                    if(tit.checked == true)
                    {
                        inputs[i].checked = true;
                    }else{
                        inputs[i].checked = false;
                    }
                }
            }
        }
    </script>
    <script type="text/javascript">
        function del(bid){
            layer.confirm("你确定要删除吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Brand/del')}","id="+bid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Brand/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>
    <style type="text/css">
        .search_style{left:10px;height: 30px;margin-bottom: 10px;  border:1px solid #ddd; padding:30px 20px; position:relative; margin-top:20px; }
        .search_style .title_names{ position:absolute; top:-20px; font-size:18px; background-color:#ffffff; padding:5px 20px; left:10px;}
        #page a,#page span{
            display: inline-block;width: 18px;height: 18px;padding: 5px;margin: 2px;text-decoration: none;background: #f0ead8;
            color: #009900;border: 1px solid #c9e2b3;
        }
        #page a:hover{
            background: #333;
            color: #fff;

        }
        #page span {
            background: #333;
            color: #fff;
            font-weight: bold;
        }
        .td-manage a{
            cursor: pointer;
        }

    </style>
</head>

<body>
	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
        </ul>
    </div>
    <div class="formbody">

        <div id="usual1" class="usual">
            <div id="tab2" class="tabson">
            <ul class="seachform">

            <div class="search_style">
                <div class="title_names">搜索查询</div>
                <ul class="search_content">
                    <form action="<?=\yii\helpers\Url::to(['brand/index'])?>" method="get">
                        <li><label>品牌名称</label><input value="<?=\yii\helpers\Html::encode($bname?$bname:'')?>" name="bname" type="text" class="scinput" placeholder="输入品牌名称"  /></li>
                        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
                    </form>
                </ul>
            </div>

            <div class="table_menu_list">
                <table class="tablelist" id="sample-table">
                    <thead>
                    <tr>
                        <th width="50px">编号</th>
                        <!--<th width="80px">ID</th>-->
                        <th width="120px">品牌LOGO</th>
                        <th width="120px">品牌名称</th>
                        <th width="350px">描述</th>
                        <th width="180px">加入时间</th>
                        <th width="70px">状态</th>
                        <th width="200px">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($list as $k=>$v): ?>
                        <tr>
                            <td width="80px"><?=$pages->page*$pages->pageSize+$k+1;?></td>
                            <!--<td width="50px" id="myID"><?/*=$v['id']*/?></td>-->
                            <td>
                                <?php if(\yii\helpers\Html::encode($v['logo'])==''): ?>
                                    <img src="<?=\yii\helpers\Url::to('@web/uploads/brand/default.png')?>" width="130"/>
                                <?php else: ?>
                                    <img src="<?=\yii\helpers\Url::to('@web/uploads/brand/').$v['logo'];?>" width="130"/>
                                <?php endif;?>
                            </td>
                            <td><?=\yii\helpers\Html::encode($v['bname'])?></td>
                            <td><?=mb_substr(\yii\helpers\Html::encode($v['description']),0,40,'utf-8')?></td>
                            <td><?=date('Y-m-d H:i:s',\yii\helpers\Html::encode($v['addtime']))?></td>
                            <td ><?=(\yii\helpers\Html::encode($v['active'])==0)?'已禁用':'已启用'?></td>
                            <td class="td-manage">
                                <a href="#" id="<?=$v['id']?>" class="tablelink operate"><?=(\yii\helpers\Html::encode($v['active'])==0)?'启用':'禁用'?></a>&nbsp;&nbsp;
                                <a href="<?=\yii\helpers\Url::to(['brand/edit','id'=>$v['id']])?>" class="tablelink edit">编辑</a>&nbsp;&nbsp;
                                <a href="#" id="<?=$v['id']?>" class="tablelink del">删除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>

                    </tbody>
                </table>
                <div id="page" style="margin-top: 20px;float: right;"><?=\yii\widgets\LinkPager::widget(['pagination'=>$pages])?></div>
            </div>
                <!--<div id="page" style="margin-top: 20px;">{$page}</div>-->
            </ul>
	    </div>

        </div>

    </div>
	<script type="text/javascript">
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
    <script type="text/javascript">
        $(function(){
            $('.operate').click(function(){
                var id=$(this).attr('id');
                layer.confirm("你确定要操作吗？",{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['brand/operate'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['brand/index'])?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            });
            $('.del').click(function(){
                var id=$(this).attr('id');
                layer.confirm("你确定要操作吗？",{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.post("<?=\yii\helpers\Url::to(['brand/del'])?>",{id:id},function(res){
                        if(res.code==1){
                            layer.msg(res.body,{icon:1,time:1000},function(){
                                window.location.href="<?=\yii\helpers\Url::to(['brand/index'])?>";
                            });
                        }else{
                            layer.msg(res.body,{icon:2,time:1000});
                        }
                    },'json')
                })
            })
        })
	</script>
    <script type="text/javascript">
        //禁用品牌
        function disabled(bid){
                layer.confirm("你确定要启用我吗？",{
                    icon:3,
                    title:'提示',
                    btn:['确定','取消']
                },function(){
                    $.get("{:U('Brand/disabled')}","id="+bid,function(res){
                        if(res.status=="ok"){
                            layer.msg(res.msg,{icon:1,time:1000},function(){
                                window.location.href="{:U('Brand/showlist')}";
                            });
                        }else{
                            layer.msg(res.msg,{icon:2,time:1000});
                        }

                    },'json')
                })
        }
        //启用品牌
        function enabled(bid){
            layer.confirm("你确定要启用我吗？",{
                icon:3,
                title:'提示',
                btn:['确定','取消']
            },function(){
                $.get("{:U('Brand/enabled')}","id="+bid,function(res){
                    if(res.status=="ok"){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="{:U('Brand/showlist')}";
                        });
                    }else{
                        layer.msg(res.msg,{icon:2,time:1000});
                    }

                },'json')
            })
        }
    </script>
</body>
</html>




