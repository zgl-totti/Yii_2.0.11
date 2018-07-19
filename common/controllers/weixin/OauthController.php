<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/7
 * Time: 0:29
 */

namespace common\controllers;


use app\common\services\HttpClient;
use app\common\services\QueueListService;
use app\common\services\UriService;

//微信网页授权及绑定账号
class OauthController extends BaseController
{
    public function actionLogin()
    {
        $scope=$this->get('scope','snsapi_base');
        $appid=\Yii::$app->params['weixin']['appid'];
        $redirect_url=UriService::buildWwwUrl('oauth/callback');

        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_url={$redirect_url}&response_type=code&scope={$scope}&state=#wechat_redirect";

        return $this->redirect($url);
    }

    public function actionCallback()
    {
        $code=$this->get('code','');
        if(empty($code)){
            return $this->goHome();
        }

        $appid=\Yii::$app->params['weixin']['appid'];
        $sk=\Yii::$app->params['weixin']['sk'];

        //通过code获取网页授权的access_token
        $url="https://open.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$sk}&code={$code}&grant_type=authorization_code";
        $ret=HttpClient::get($url);
        $ret=@json_decode($ret,true);

        $ret_token=$ret['access_token'] ?? '';
        if(empty($ret_token)){
            return $this->goHome();
        }

        $openid=$ret['openid'] ?? '';
        $scope=$ret['scope'] ?? '';

        $this->setCookie($this->current_openid,$openid);

        $reg_bind=OauthMemberBind::find()->where('openid',$openid)->where('type','')->one();

        if($reg_bind) {
            $member_info=Member::findOne(['id'=>$reg_bind['member_id'],'status'=>1]);
            if(empty($member_info)){
                $reg_bind->delete();
                return $this->goHome();
            }

            if ($scope == 'snsapi_userinfo') {
                $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$ret_token}&openid={$openid}&lang=zh_CN";
                $wechat_user_info = HttpClient::get($url);
                $wechat_user_info=@json_decode($wechat_user_info,true);


                if($member_info['nickname']==$member_info['mobile']){
                    $member_info->nickname=$wechat_user_info['nickname'] ?? $member_info->nickname;
                    $member_info->save();
                }
            }

            //设置登录态


        }

        return UriService::buildWwwUrl('');
    }

    /**
     * 账号绑定
     */
    public function actionBind()
    {
        if(\Yii::$app->request->isGet){
            return $this->render('');
        }

        $mobile=trim($this->post('mobile'));

        $member_info=Member::get();
        $openid=$this->getCookie($this->current_openid);

        if($openid){
            $bindInfo=OauthMemberBind::find()->where(['openid'=>$openid,'member_id'=>'','type'=>''])->one();

            if(empty($bindInfo)){
                $model_bind= new OauthMemberBind();
                $model_bind->member_id=$member_info['id'];
                $model_bind->type='';
                $model_bind->client_type='weixin';
                $model_bind->openid=$openid;
                $model_bind->unionid='';
                $model_bind->extra='';
                $model_bind->updated_time=date('Y-m-d H:i:s');
                $model_bind->created_time=date('Y-m-d H:i:s');

                $model_bind->save();

                //绑定后消息队列推送消息
                QueueListService::addQueue('bind',[
                    'user_id'=>'',
                    'type'=>1,
                    'openid'=>''
                ]);
            }
        }

        if(UriService::isWechat() && $member_info['nickname']==$member_info['mobile']){
            return $this->renderJson(['url'=>UriService::buildWwwUrl('oauth/login',['scope'=>'snsapi_userinfo'])],'绑定成功');
        }

        return $this->renderJson(['url'=>UriService::buildWwwUrl('index/index')],'绑定成功');

    }
}