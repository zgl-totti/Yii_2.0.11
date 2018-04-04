<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
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
    <script type="text/javascript">
        $(function(){
            $("#addBtn").click(function(){
                $.post("<?=\yii\helpers\Url::to(['admin/add'])?>",$("#form1").serialize(),function(res){
                    if(res.code==1){
                        layer.msg(res.body,{icon:6,time:2000},function(){
                            window.location.href="<?=\yii\helpers\Url::to(['admin/index'])?>";
                        })
                    }else{
                        layer.msg(res.body,{icon:6,time:2000})
                    }
                },'json')
            })
            /*$("#addBtn").click(function(){
                $.post("{:U('Admin/Admin/addlist')}",$("#form1").serialize(),function(res){
                    if(res.status=="ok"){
                        layer.confirm(res.msg,{icon:1,title:"提示",btn:['好的','算了']},function(){
                            //好的
                            window.location.href="{:U('Admin/Admin/addlist')}";
                        },function(){
                            //算了
                            window.location.href="{:U('Admin/Admin/showlist')}";
                        });
                    }else{
                        layer.confirm(res.msg,{icon:2,title:"提示",btn:['好的','算了']},function(){
                            //好的
                            window.location.href="{:U('Admin/Admin/addlist')}";
                        },function(){
                            //算了
                            window.location.href="{:U('Admin/Admin/showlist')}";
                        });
                    }
                })
            })*/
        })
    </script>
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
        <div id="tab1" class="tabson">
            <form action="#" id="form1">
                <input name="_csrf" id="csrf" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
                <ul class="forminfo">
                    <!--<li>
                        <label for="{$val['title']}">所属角色<b>*</b></label>
                        <volist name="groupList" id="val">
                        <label for="{$val['title']}" style="width: 70px">{$val['title']}</label>
                        <span style="float:left;margin-right: 25px;">
                            <input name="group_id[]" id="{$val['title']}" value="{$val['id']}" type="checkbox" class="dfinput" style="width:18px;"/>
                        </span>
                        </volist>
                    </li>-->
                    <li><label>管理员账号<b>*</b></label><input name="username" type="text" class="dfinput" placeholder="请填写账号"  style="width:200px;"/></li>
                    <li><label>性别<b>*</b></label>
                        <div class="vocation">
                            <select name="gender" class="select2">
                                <option selected value="0">男</option>
                                <option value="1">女</option>
                                <option value="2">保密</option>
                            </select>
                        </div>
                    </li>
                    <li><label>管理员密码<b>*</b></label><input name="password" type="password" class="dfinput" placeholder="请填写密码"  style="width:200px;"/></li>
                    <li><label>确认密码<b>*</b></label><input name="repassword" type="password" class="dfinput" placeholder="请填写确认密码"  style="width:200px;"/></li>
                    <li><label>&nbsp;</label><input id="addBtn" type="button" class="btn" value="添加管理员"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>
