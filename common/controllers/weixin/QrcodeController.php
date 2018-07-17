<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/17
 * Time: 22:39
 */

namespace common\controllers;


use app\common\services\RequestService;

class QrcodeController extends BaseController
{
    public function actionIndex()
    {
        $name = $this->post('name');
        $info = Qrcode::where('qrcode_name', $name)->find();
        if ($info) {
            return false;
        }

        $qrcode = new Qrcode();
        $qrcode->qrcode_name = $name;
        $qrcode->updated_time = time();

        if ($qrcode->save()) {
            if (!$qrcode->qrcode) {
                $ret = $this->tmpQrcode($qrcode->id);
                if ($ret) {
                    $qrcode->extra = json_encode($ret);
                    $qrcode->qrcode = isset($ret['url']) ? $ret['url'] : '';
                    $qrcode->expired_time = date('Y-m-d H:i:s', time() + $ret['expire_seconds']);

                    $qrcode->save();
                }
            }
        }
    }

    /**
     * 生成临时二维码
     */
    private function tmpQrcode($id)
    {
        $config = \Yii::$app->params['wexin'];
        RequestService::setConfig('', '', '');
        $access_token = RequestService::getAccessToken();

        $data = [
            'expire_seconds' => 2592000,
            'action_name' => 'QR_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_id' => $id
                ]
            ]
        ];

        RequestService::send('', $data, 'POST');
    }

    /**
     * 展示二维码
     */
    public function actionQrcode()
    {
        $url=$this->get('url');
        header('Content-type:image/png');

        Qrcode::png($url,false,Enum::QR_ECLEVEL_H,5,0,false);
    }
}