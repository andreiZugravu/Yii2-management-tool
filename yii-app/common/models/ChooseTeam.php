<?php

namespace common\models;

use yii\base\Model;

/* @property integer $team_id */

class ChooseTeam extends Model
{
    public function attributeLabels()
    {
        return [
            'team_id' => 'Team Id'
        ];
    }
}