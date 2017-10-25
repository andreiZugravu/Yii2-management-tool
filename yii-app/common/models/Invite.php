<?php

namespace common\models;

use yii\base\Model;

/**
 * @property integer $team_id
 * @property array $user_id
 */
class Invite extends Model
{
    public function attributeLabels()
    {
        return [
            'team_id' => 'Your teams',
            'user_id' => 'User Id',
        ];
    }
}