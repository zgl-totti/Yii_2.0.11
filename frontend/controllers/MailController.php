<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 11:36
 */

namespace frontend\controllers;


use yii\web\Controller;

class MailController extends Controller{
    /**
     * Created by PhpStorm.
     * Content: 发送邮件
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionIndex(){
        $mail=\Yii::$app->mailer->compose();
        $mail->setTo('5767xxxxx@qq.com');
        $mail->setSubject('今天是周三，4444');
        $mail->setTextBody('好好学习,444');
        $mail->setHtmlBody('天天向上,4444');
        //var_dump($mail->send());
        if($mail->send()){
            echo '邮件发送成功';
        }else{
            echo '邮件发送失败';
        }
    }

    /**
     * Created by PhpStorm.
     * Content: 发送短信
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionNote(){
        $mobile='151xxxx0001';
        $text='haha';
        \Yii::$app->smser->send($mobile,$text);
    }

    /**
     * Created by PhpStorm.
     * Content: 发送手机验证码
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionPhone_Msg($mobile,$message){
        $password = 'xxxx_-46';           //密码
        $userName = 'SDK-BBX-010-21147x';  //序列号
        $flag = 0;
        $params = '';
        $content = iconv( "UTF-8", "gb2312//IGNORE" ,$message.'【哈哈】');
        $argv = array(
            'sn' =>$userName,
            'pwd'=>strtoupper(md5($userName.$password)), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
            'mobile'=>$mobile,
            'content'=>$content,
            'ext'=>'',
            'stime'=>'',
            'rrid'=>''
        );
        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params.= $key."="; $params.= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        $fp = fsockopen("sdk2.entinfo.cn",8060,$errno,$errstr,10) or exit($errstr."--->".$errno);
        $header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
        $header .= "Host:sdk2.entinfo.cn\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: ".$length."\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $params."\r\n";
        fputs($fp,$header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            if ($inheader == 0) {
            }
        }
        $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
        $line=str_replace("</string>","",$line);
        $result=explode("-",$line);
        if(count($result)<0){
            return 0;
        }else{
            return 1;
        }
    }

    /**
     * Created by PhpStorm.
     * Content: 生成订单号
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionOrderID(){
        $yCode = array('a', 'B', 'w', 'D', 'e', 'f', 'g', 'h', 'i', 'j','k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't');
        $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }

    /**
     * Created by PhpStorm.
     * Content: 验证手机号
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionIs_mobile($phone){
        $mobile=trim($phone);
        if(preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[0236789]{1}[0-9]{8}$/",$mobile)){
            Return true;
        }else{
            Return false;
        }
    }

    /**
     * Created by PhpStorm.
     * Content: 验证邮箱
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionIs_email($email) {
        return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
    }

    /**
     * Created by PhpStorm.
     * Content: 生成SEO
     * User: Administrator
     * Date: 2017/8/2
     * Time: 11:36
     */
    public function actionSeo( $title = '', $description = '', $keyword = '') {
        if(!empty($title)){
            $title = strip_tags($title);
        }
        if(!empty($description)){
            $description = strip_tags($description);
        }
        if (!empty($keyword)){
            $keyword = str_replace(' ', ',', strip_tags($keyword));
        }

        //	加载到页面变量中
        $ci		=	& get_instance();
        $default	=	$ci->config->item('base_seo');

        $seo['seo_title']		= $title ? $title.' '.$default : $default;
        $seo['seo_keywords']	= !empty($keyword) ? $keyword.' '.$default : $default;
        $seo['seo_description'] = !empty($description) ? $description.' '.$default : $default;

        foreach ($seo as $k => $v) {
            $seo[$k] = str_replace(array("\n","\r"),'', $v);
        }

        //	加载到页面变量中
        $ci		=	& get_instance();
        $ci->load->vars($seo);
        return $seo;
    }
}