
<!--<div class="i_bg bg_color">
    <div class="user_style clearfix">
        <div class="user_center">
            <div class="m_content">
                <include file="Public/user_left"/>
                <div class="right_style">
                    <div class="info_content">-->
                        <!--地址管理样式-->
                        <div class="adderss_style">
                            <div class="title_Section"><span>收货地址管理</span></div>
                            <div class="adderss_list">
                                <!--地址列表-->
                                <div class="Address_List clearfix">
                                    <!--地址类表-->
                                    <?php foreach($list as $v): ?>
                                    <?php if(\yii\helpers\Html::encode($v['isdefault'])==1): ?>
                                        <ul class="Address_info">
                                            <div class="address_title">
                                                <a href="javascript:updateAddress(<?=\yii\helpers\Html::encode($v['id'])?>)" class="modify iconfont icon-fankui btn btn-primary" title="修改信息" data-toggle="modal" id="purebox"></a>
                                                <span style="color:#FF7200">默认地址</span>
                                                <a href="javascript:del(<?=\yii\helpers\Html::encode($v['id'])?>)" class="delete "><i class="iconfont icon-close2"></i></a></div>
                                            <li><?=\yii\helpers\Html::encode($v['name'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['address'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['mobile'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['postcode'])?></li>
                                        </ul>
                                    <?php else: ?>
                                        <ul class="Address_info">
                                            <div class="address_title">
                                                <a href="javascript:setDefaultAdd(<?=\yii\helpers\Html::encode($v['id'])?>)" class="modify iconfont icon-fankui btn btn-primary" title="设置为默认地址" data-toggle="modal" id="fujia"></a>
                                                附加地址
                                                <a href="javascript:del(<?=\yii\helpers\Html::encode($v['id'])?>)" class="delete "><i class="iconfont icon-close2"></i></a></div>
                                            <li><?=\yii\helpers\Html::encode($v['name'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['address'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['mobile'])?></li>
                                            <li><?=\yii\helpers\Html::encode($v['postcode'])?></li>
                                        </ul>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <form action="#" method="post" id="addressForm">
                                <div class="Add_Addresss">
                                    <div class="title_name"><i></i>添加地址</div>
                                    <table>
                                        <tbody><tr>
                                            <td class="label_name">收货区域</td>
                                            <td colspan="3" class="select">
                                                <!--<label> 国家/地区 </label><select class="select" name="province" id="s1"><option></option></select>-->
                                                <label> 省份 </label><select class="select" name="province" id="s1"><option></option></select>
                                                <label> 市/县 </label><select class="select" name="city" id="s2"><option></option></select>
                                                <label> 区/县 </label><select class="select" name="town" id="s3"><option></option></select>
                                            </td>
                                        </tr>
                                        <tr><td class="label_name">详细地址</td><td><input name="jiedao" type="text" class="Add-text"><i>（必填）</i></td>
                                            <td class="label_name">收件人姓名</td><td><input name="name" type="text" class="Add-text"><i>（必填）</i></td>
                                            <!--<td class="label_name">送货时间</td><td><input name="" type="text" class="Add-text"><i>（选填）</i></td></tr>-->
                                        <!--<tr>
                                            <td class="label_name">电子邮箱</td><td><input name="" type="text" class="Add-text"><i>（选填）</i></td>
                                        </tr>-->
                                        <tr>
                                            <td class="label_name">手&nbsp;&nbsp;机</td><td><input name="mobile" type="text" class="Add-text"><i>（必填）</i></td>
                                            <td class="label_name">邮&nbsp;&nbsp;编</td><td><input name="postcode" type="text" class="Add-text"><i>（必填）</i></td>
                                        </tr>
                                        <!--<tr>
                                            <td class="label_name">固定电话</td><td><input name="" type="text" class="Add-text"><i>（选填）</i></td></tr>
                                        <tr><td class="label_name"></td><td></td><td class="label_name"></td><td></td>
                                        </tr>-->
                                        </tbody></table>
                                    <div class="address_Note"><span>注：</span>只能添加5个收货地址信息。请勿用假名填写地址，如造成损失由收货人自己承担。</div>
                                    <div class="btn"><input type="button" value="添加地址" class="Add_btn"></div>
                                </div>
                            </form>
                        </div>
                    <!--</div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<?=\yii\helpers\Html::jsFile('@web/js/geo.js')?>
<script type="text/javascript">
    setup();
    preselect();
    $(function(){
        $(".Add_btn").click(function(){
            $.post("<?=\yii\helpers\Url::to(['address/add'])?>",$("#addressForm").serialize(),function(res){
                if(res.code==1){
                    layer.msg(res.body,{icon:1,time:1000},function(){
                        window.location.href="<?=\yii\helpers\Url::to(['personal/address'])?>";
                    })
                }else{
                    layer.msg(res.body,{icon:2,time:1000});
                }
            },'json')
        })
    })

    function del(id){
        $.post("<?=\yii\helpers\Url::to(['address/del'])?>",{id:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['personal/address'])?>";
                })
            }else{
                layer.msg(res.body,{icon:1,time:1000})
            }
        })
    }

    //设置默认地址
    function setDefaultAdd(id){
        $.post("<?=\yii\helpers\Url::to(['address/set-default'])?>",{id:id},function(res){
            if(res.code==1){
                layer.msg(res.body,{icon:1,time:1000},function(){
                    window.location.href="<?=\yii\helpers\Url::to(['personal/address'])?>";
                })
            }else{
                layer.msg(res.body,{icon:1,time:1000})
            }
        },'json')
    }

    //修改默认地址
    function updateAddress(id){
        layer.open({
            type:2,
            title:"修改默认收货",
            skin:'demo-class',
            area:["450px","50%"],
            shadeClose: true,
            shade: 0.8,
            content:"<?=\yii\helpers\Url::to(['address/edit'])?>?id="+id
        })
    }
</script>
