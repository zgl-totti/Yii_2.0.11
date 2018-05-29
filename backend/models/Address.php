<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Address extends ActiveRecord{

    public $province;

    public $city;

    public $town;

    public $jiedao;

    public static function tableName(){
        return "{{%address}}";
    }

    public function rules(){
        return [
            [['province','city','town','jiedao','name','mobile','postcode'],'required'],
            [['mobile','postcode'],'numerical', 'integerOnly'=>true],
            ['mobile','min'=>11,'mac'=>11],
            ['postcode','min'=>6,'mac'=>6]
        ];
    }
}