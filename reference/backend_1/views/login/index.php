<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>美酒网-管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="__CSS__/general.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__JS__/jQuery-1.8.2.min.js"></script>
    <script src="__PLUGIN__/layer/layer.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#editform').submit(function(){
                $.post("",$('#editform').serialize(),function(res){
                    if(res.status){
                        layer.msg(res.info,{icon: 6},function(){
                            location='{:U("Index/index")}';
                        });
                    }else{
                        layer.msg(res.info,function(){
                          var str='{:U('chkcode')}#'+Math.random()+'';

                            $('.gb_version').attr('src',str);
                        });

                    }
                });
                return false;
            })
        });
    </script>




<!--登录小键盘-->
<script type="text/javascript" src="__JS__/vk_loader.js"></script><script type="text/javascript" src="__JS__/scriptqueue.js"></script><script onload="return 1;" src="__JS__/e.js" type="text/javascript" charset="UTF-8"></script><script onload="return 1;" src="__JS__/virtualkeyboard.js" type="text/javascript" charset="UTF-8"></script><link href="__CSS__/keyboard.css" type="text/css" rel="stylesheet"><script onload="return 1;" src="__JS__/layouts.js" type="text/javascript" charset="UTF-8"></script>

<style type="text/css">
/* css 重置 */
* {margin: 0;padding: 0;list-style: none;}
html,body{height:100%; padding:0;}
body {background: #fff;font: normal 12px/22px 宋体;position:relative;background:#2f4158 url(__IMG__/login_bg02.jpg) 50% 50%; background-size: cover;}
img{border: 0;}
a{text-decoration: none;color: #333;}
/* 本例子css */
.slideBox {width: 521px;height: 70px;overflow: hidden;margin:0px auto;margin-top:20px;position: relative; background:url(__IMG__/qq.png) no-repeat;}
.slideBox p{position:absolute; right:12px; top:5px; height:55px; line-height:55px; color:#eb8918; width:150px; text-align:left; font-size:20px;}

.login_box{position:absolute; left:0; top:50%; width:100%;}
.login_logo{text-align:center; padding-bottom:30px;}
.login_con{width:460px; margin:-290px auto 0;}
.login_con{margin:-230px auto 0;}
.login_c{background:#fff; border:12px solid #5ac4f5;width:435px;}
.login_c .table{margin:0 auto;}
.login_c .table .title{font-size:22px; font-family:"Microsoft Yahei"; color:#159bd9; padding:40px 0 30px;}
.login_input,input.login_input[type='text']{background:#f3f3f3;width:268px; line-height:22px; height:22px; border:0; margin:0; outline:0; padding:8px 0 8px 35px; color:#333; font-family:Microsoft Yahei,'微软雅黑'; font-size:14px;}
input.login_input.text_2{width:130px;}
.login_c .label{position:relative; display:block;}
.login_c .label i{position:absolute; top:11px; left:10px;}
.login_c .button{background:#0f8bc5; width:300px; height:38px; line-height:38px; text-align:center; color:#fff; font-size:18px; padding:0; border-radius:0; font-family:Microsoft Yahei,'微软雅黑';border:0; outline:0; margin:0 0 0 3px;}
.login_c .button:hover{}
.jizhu_label{position:relative; float:left; color:#7a7a7a; line-height:19px; font-family:Microsoft Yahei,'微软雅黑'; cursor:pointer;}
.jizhu_label span{width:19px; height:19px; background:url(__IMG__/login_checkbox.png) no-repeat; float:left; overflow:hidden; margin-right:5px;}
.jizhu_label span.checkbox{background-position:-19px 2px;}
.jizhu_label span input{margin-left:-30px;}
.gb_version{position:absolute; top:0; right:0; width:120px; height:36px;}
.login_f{background-position:-844px 0;}
</style>
</head>
<body>
<div class="login_box">
<div class="login_con">
<div class="login_logo"><a href="#" target="_blank"><img src="__IMG__/logo.png"></a></div>
<div class="login_c">
<form method="post" name="theForm" id="editform" >
  <table class="table" align="center" border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
      <td class="title" align="center" valign="middle">美酒网</td>
    </tr>
    <tr>
      <td align="center">
      	<table>
          <tbody><tr>
            <td colspan="2">
            	<label class="label">
                    <i><img src="__IMG__/login_icon01.png"></i>
                    <input name="user_name" class="login_input" placeholder="用户名" type="text">
                </label>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-top:18px;">
            	<label class="label">
                    <i><img src="__IMG__/login_icon02.png"></i>
                    <input name="password" class="login_input" placeholder="密码" type="password">
                </label>
            </td>
          </tr>
                    <tr>
            <td colspan="2" style="padding-top:18px;">
            	<label class="label">
                	<i><img src="__IMG__/login_icon03.png" style="margin-top:1px;"></i>
                    <input name="chkcode" class="login_input text_2" placeholder="验证码" type="text">
                </label>
            </td>
          </tr>
                    <tr>
            <td style="padding-top:10px;" align="left" height="34"><label class="jizhu_label"><span><input value="1" name="remember" type="checkbox"></span> 保存登录信息</label></td>
          </tr>
          <tr>
          	<td style="padding-top:25px;" align="center" height="38"><input style="cursor: pointer" value="登&nbsp;&nbsp;录" class="button" type="submit"></td>
          </tr>
        </tbody></table>
        </td>
    </tr>
    <tr>
    	<td height="35">&nbsp;</td>
    </tr>
  </tbody></table>
  <input name="act" value="signin" type="hidden">
</form>
</div>
</div>
</div>
<script type="text/javascript" src="__IMG__/jquery_002.js"></script><script language="JavaScript">
<!--
  document.forms['theForm'].elements['username'].focus();
  
  /**
   * 检查表单输入的内容
   */
  function validate()
  {
    var validator = new Validator('theForm');
    if (document.forms['theForm'].elements['captcha'])
    {
      validator.required('captcha', captcha_empty);
    }
	validator.required('username', user_name_empty);
    //validator.required('password', password_empty);
    return validator.passed();
  }
  
//-->
$(function(){
	function checked(){
		var jizhu_label=$('.jizhu_label')
		if(jizhu_label.find('input').is(':checked')){
			jizhu_label.find('span').addClass('checkbox');
		}else{
			jizhu_label.find('span').removeClass('checkbox');
		}
	}
	checked()
	$('.jizhu_label').click(checked)
})
</script>
<!--[if lte IE 8]>
<script language="JavaScript">
document.forms['theForm'].elements['username'].blur();
</script>
<![endif]-->


</body></html>