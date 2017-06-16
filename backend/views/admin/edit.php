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
                $.post("{:U('Admin/Admin/updlist')}",$("#form1").serialize(),function(res){
                    if(res.status=="ok"){
                        layer.alert(res.msg,{icon:1,title:"提示"},function(){
                            //好的
                            window.location.href="{:U('Admin/Admin/showlist')}";
                        });
                    }else{
                        layer.alert(res.msg,{icon:2,title:"提示"});
                    }
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
    <li><a href="#">系统设置</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    <div id="usual1" class="usual"> 
  	<div id="tab1" class="tabson">
 
    <form action="{:U('Admin/Admin/updlist')}" method="post" id="form1">
        <input value="{$info['id']}" name="id" type="hidden"/>
    <ul class="forminfo">
        <li>
            <label>所属组<b>*</b></label>
            <volist name="groupList" id="value">
                        <span style="float:left;margin-right: 25px;">
                        <label for="{$value.title}" style="width: 70px">{$value.title}</label>
                        <input name="group_id[]" {:in_array($value['id'],$info['gid'])?'checked':''} id="{$value.title}" type="checkbox" value="{$value.id}" class="dfinput"  style="width:18px;"/>
                         </span>
            </volist>
        </li>
    <li><label>管理员账号<b>*</b></label><input disabled="disabled" name="adminname" value="{$info['adminname']}" type="text" class="dfinput" placeholder="请填写账号"  style="width:200px;"/></li>
    <li><label>性别<b>*</b></label>
        <div class="vocation">
            <select name="gender" class="select2">
                <if condition="$info['gender'] eq 0">
                    <option selected value="0">男</option>
                    <elseif condition="$info['gender'] eq 1"/>
                    <option value="1">女</option>
                    <else/>
                    <option value="2">保密</option>
                </if>
            </select>
        </div>
    </li>
    <li><label>管理员密码<b>*</b></label><input name="password"  value="{$info['password']}" type="password" class="dfinput" placeholder="请填写密码"  style="width:200px;"/></li>
   <!-- <li><label>职位名称<b>*</b></label>
    <div class="vocation">
    <select class="select1">
    <option>UI设计师</option>
    <option>交互设计师</option>
    <option>前端设计师</option>
    <option>网页设计师</option>
    <option>Flash动画</option>
    <option>视觉设计师</option>
    <option>插画设计师</option>
    <option>美工</option>
    <option>其他</option>
    </select>
    </div>
    </li>-->

    <li><label>&nbsp;</label><input id="addBtn"  type="button" class="btn" value="编辑保存"/></li>
    </ul>
    </form>
    </div>
	</div>
    </div>


</body>

</html>
