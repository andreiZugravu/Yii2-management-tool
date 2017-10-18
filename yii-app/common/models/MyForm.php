<?php

namespace common\models;

use Yii;
use yii\base\Model;

class MyForm extends Model
{
    public $name;
    public $surname;
    public $phoneNumber;
    public $developer;

    private $_user;

    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            ['developer', 'boolean'],
            ['phoneNumber', 'validatePhoneNumber']
        ];
    }

    public function validatePhoneNumber($attribute)
    {
        return $this->phoneNumber == '00000000';
    }

}

?>