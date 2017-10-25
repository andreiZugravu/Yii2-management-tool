<?php

namespace common\models;

use yii\base\Model;

/**
 * @property integer $team_id
 * @property integer $user_id
 * @property string $role
 */
class Invite extends Model
{
    public function attributeLabels()
    {
        return [
            'team_id' => 'Your teams',
            'user_id' => 'User Id',
            'role'    => 'Role'
        ];
    }
}