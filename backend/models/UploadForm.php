<?php
namespace backend\models;

use yii\base\Model;

class UploadForm extends Model{
    public $file;

    public function rules(){
        return [
            [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }
}

