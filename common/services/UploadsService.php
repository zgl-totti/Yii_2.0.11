<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2018/7/4
 * Time: 21:52
 */

namespace app\common\services;


class UploadsService
{
    protected static $error_msg=null;

    protected static $error_code=null;

    public static function error($msg='',$code=-1)
    {
        self::$error_msg=$msg;
        self::$error_code=$code;

        return false;
    }

    public static function getLastErrorMsg()
    {
        return self::$error_msg;
    }

    public static function getLastErrorCode()
    {
        return self::$error_msg;
    }


    public static function uploadByFile($file_name,$file_path,$bucket='')
    {
        if(!$file_name){
            return self::error('文件名是必须的');
        }

        if(!$file_path || !file_exists($file_path)){
            return self::error('请输入正确的文件路径');
        }

        $upload_config=\Yii::$app->params['upload'];
        if(!isset($upload_config[$bucket])){
            return self::error('参数bucket错误');
        }

        $tmp_file=explode('.',$file_name);
        $file_type=strtolower(end($tmp_file));
        $hash_key=md5(file_get_contents($file_path));

        $upload_dir_path=UriService::getRootPath().'/web'.$upload_config[$bucket];
        $folder_name=date('Ymd');
        $upload_dir=$upload_dir_path.$folder_name;

        if(!file_exists($upload_dir)){
            mkdir($upload_dir,0777);
            chmod($upload_dir,0777);
        }

        $upload_full_name=$folder_name.'/'.$hash_key.'.'.$file_type;

        if(is_uploaded_file($file_path)){
            move_uploaded_file($file_path,$upload_dir_path.$upload_full_name);
        }else{
            file_put_contents($upload_dir_path.$upload_full_name,file_get_contents($file_path));
        }

        return [
            'code'=>200,
            'path'=>$upload_full_name,
            'prefix'=>$upload_config[$bucket].'/web'
        ];
    }
}