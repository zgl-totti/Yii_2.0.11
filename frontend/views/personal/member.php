

<!--个人信息-->
<div class="Personal_info" id="Personal">
    <div class="title_Section"><span style="font-size: 20px;">个人信息</span></div>
    <form id="formInfo" action="<?=\yii\helpers\Url::to(['personal/member'])?>" method="post" enctype="multipart/form-data">
        <ul class="xinxi">
            <li class="User_avatar" style="width: 110px;height: 110px;border: 0"><label>当前头像：</label>
                <?php if(\yii\helpers\Html::encode($info['pic']) && file_exists(\yii\helpers\Url::to('@web/uploads/member/').$info['pic'])): ?>
                    <img id="img0" src="<?=\yii\helpers\Url::to('@web/uploads/member/').\yii\helpers\Html::encode($info['pic']);?>" style="width: 100px;height: 100px;float: left;position: absolute;left: 700px;" />
                <?php else: ?>
                    <img id="img0" src="<?=\yii\helpers\Url::to('@web/images/people.png')?>" style="width: 100px;height: 100px;float: left;position: absolute;left: 700px;"/>
                <?php endif;?>
            </li>
            <li><input name="pic" type="file" id="file0" style="width: 75px;height: 25px;margin-left: 110px;" value="上传头像"  class="submit" /></li>
            <li><label>用户姓名：</label>  <span><input name="username" type="text" value="<?=\yii\helpers\Html::encode($info['username'])?>"  class="text"  disabled="disabled"/></span></li></li>
            <li><label>用户性别：</label>
                <span class="sex">
                    <?php if(\yii\helpers\Html::encode($info['gender'])==0){
                        echo '男';
                    }elseif(\yii\helpers\Html::encode($info['gender'])==1){
                        echo '女';
                    }else{
                        echo '保密';
                    };?>
                </span>
                <div class="add_sex">
                    <input type="radio" name="gender" value="2" checked="checked">
                    保密&nbsp;&nbsp;
                    <input type="radio" name="gender" value="0">
                    男&nbsp;&nbsp;
                    <input type="radio" name="gender" value="1">
                    女&nbsp;&nbsp;</div></li>
            <li><label>电子邮箱：</label>  <span><input name="email" type="text" value="<?=\yii\helpers\Html::encode($info['email'])?>"  class="text"  disabled="disabled"/></span></li>
            <li><label>用户QQ：</label>  <span><input name="qq" type="text" value="<?=\yii\helpers\Html::encode($info['qq'])?>"  class="text"  disabled="disabled"/></span></li>
            <li><label>移动电话：</label>  <span><input name="mobile" type="text" value="<?=\yii\helpers\Html::encode($info['mobile'])?>"  class="text"  disabled="disabled"/></span></li>
            <div class="bottom">
                <input name="" type="button" value="修改信息"  class="modify"/>
                <input id="btn" type="button" value="确认修改"  class="confirm"/>
                <input id="btn1" type="button" value="放弃修改"  class="confirm" style="background: #ff5d58;"/>
            </div>
        </ul>
    </form>
</div>
<script>
    $(function(){
        $("#btn").click(function(){
            $('#formInfo').ajaxSubmit(function(res){
                if(res.status=="ok"){
                    layer.msg(res.msg,{icon:1,time:500},function(){
                        window.location.href="{:U('Personal/memberInfo')}";
                    })
                }else{
                    layer.alert(res.msg);
                }
            })
            return false;
        })

        $("#btn1").click(function(){
            window.location.reload();
        })

    })
</script>
<script>
    $("#file0").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl) {$("#img0").attr("src", objUrl) ;}
    }) ;
    //建立一個可存取到該file的url
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>