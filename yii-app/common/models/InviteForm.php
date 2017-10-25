<?php

namespace common\models;

use \yii\base\Model;

class InviteForm extends Model
{
    public $team_id;
    public $user_id;
    public $role;

    public function rules()
    {
        return [
            [['team_id', 'role'], 'required'] //user_id will be the id of the current user
        ];
    }

    public function attributeLabels()
    {
        return [
          'team_id' => 'Your teams',
          'role' => 'Choose a role'
        ];
    }

    public function invite()
    {
        if($this->team_id) //should never be empty though
        {
            foreach($this->team_id as $teamId)
            {
                //add team_id_role to the Invites column of the user
                $a = 0;
            }
        }
    }
}