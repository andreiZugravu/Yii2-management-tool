<?php

namespace common\models;

use yii\base\model;

class ChooseTeamForm extends Model
{
    public $team_id;

    public function rules()
    {
        return [
            ['team_id', 'required']
        ];
    }
}