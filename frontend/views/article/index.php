

<style type="text/css">
    *{margin:0;padding:0;list-style-type:none;}
    a,img{border:0;}
    body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";}
    .error{
        color: red;
        display: block;
    }
    .catepage{
        margin-top:30px ;
    }
    .catepage a{
        border-radius: 50px;
        margin: 2px;
        width: 25px;
        height: 15px;
        line-height: 15px;
        border: 1px solid #ccc;
        display: inline-block;
        text-align: center;
        background-color:orangered;
        padding: 5px;
        font-weight: bolder;
    }
    .catepage a:hover{
        background-color: white;
        color: #00aaee;
        font-weight: bolder;
    }
    .current{
        border-radius: 50px;
        width: 25px;
        height: 25px;
        border: 1px solid #ccc;
        line-height: 23px;
        display: inline-block;
        padding: 5px;
        text-align: center;
    }
    .zan{
        background-color: #ccc;
        border: 1px solid #6c6c6c;
        border-radius: 10px;
        height: 130px;
        float: left;
        margin-left: 150px;;
        position: absolute;
        left: 600px;
       top: 580px;
    }
</style>
<div style="width: 1200px;margin: 0px auto">
    <img src="<?=\yii\helpers\Url::to('@web/images/AD/ad-4.jpg')?>" alt="">
</div>
<div style="width: 1200px;margin: 0 auto;left: 5px">
    <!--文章内容-->
    <div style="position: relative">
        <div class="neirong" style="width: 980px;max-height:500px;min-height:100px;overflow: auto;float: left;">
            <input id="nid" type="hidden" name="nid" value="<?=\yii\helpers\Html::encode($info['id'])?>">
            <p style="text-align: center;font-size: 25px;font-weight: bold;margin-top: 50px;"><?=\yii\helpers\Html::encode($info['cate'])?></p>
            <p style="text-align: center;font-size: 15px;font-weight: bold;margin-top: 50px;"><?=\yii\helpers\Html::encode($info['author'])?>&nbsp;&nbsp;&nbsp;<?=date('Y-m-d',\yii\helpers\Html::encode($info['addtime']))?></p>
            <m style="margin:60px 50px;line-height: 40px;padding-top: 30px;font-size: 15px"><?=\yii\helpers\Html::encode($info['content'])?></m>
        </div>
    </div>

    <!--侧边新闻内容-->
    <div style="width: 199px;height: 280px;line-height: 20px;border: 5px solid orangered;border-radius: 10px;float: left;margin-top: 50px">
        <table style="margin: 0 auto">
            <th colspan="2" style="font-size: 20px;text-align: center;margin: 0px auto;color: orangered">商城文章</th>
            <br>
            <?php foreach($article as $v): ?>
                <tr style="border-bottom: 1px solid #ccc;color: #ccc">
                    <td style="color: #ccc;height: 30px"><a style="color: #6c6c6c" href="<?=\yii\helpers\Url::to(['article/index','id'=>$v['id']])?>" target="_self" ><?=\yii\helpers\Html::encode($v['cate'])?></a></td>
                    <td style="color: #ccc "><?=date('Y/m/d',\yii\helpers\Html::encode($v['addtime']))?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>

