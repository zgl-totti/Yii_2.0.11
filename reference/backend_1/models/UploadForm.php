<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model{

    public $imageFiles;

    public function rules(){
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload($path){
        if ($this->validate()) {
            if (!file_exists($path)){
                mkdir('uploads/'.$path.'/',true);
            }
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/'.$path.'/'.$file->baseName . '.' . $file->extension);
                return 'uploads/'.$path.'/'.$file->baseName . '.' . $file->extension;
            }
        } else {
            return false;
        }
    }
}