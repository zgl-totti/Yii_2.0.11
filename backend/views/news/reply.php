<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>信息回复</title>
    <style type="text/css">
        textarea{
            border: 2px solid gray;
        }
        input{
            height: 40px;
            width: 60px;
            background-color:#999;
            color: white;
            cursor: pointer;
            margin-top: 10px;;
        }
    </style>
    <?=\yii\helpers\Html::jsFile('@web/js/jQuery-1.8.2.min.js')?>
    <?=\yii\helpers\Html::jsFile('@web/layer/layer.js')?>
</head>
<body>
<form action="#" id="form1">
    <input name="id" type="hidden" value="<?=\yii\helpers\Html::encode($id)?>">
    <textarea rows="10" cols="50" name="replycontent"></textarea>
    <input id="btn" type="button" value="确定">
</form>
</body>
<script>
   $(function(){
       $("#btn").click(function(){
           $.post("<?=\yii\helpers\Url::to(['news/reply'])?>",$("#form1").serialize(),function(res){
               if(res.code==1){
                   layer.msg(res.body,{icon:1,time:1000},function(){
                       location="<?=\yii\helpers\Url::to(['news/comment'])?>";
                   })
               }else {
                   layer.msg(res.body,{icon:2,time:1000});
               }
           },'json')
       })
   })
</script>
</html>