<?php

namespace common\models;

use \yii\base\Model;
use \yii\helpers\VarDumper;
use Yii;

class InviteForm extends Model
{
    public $team_id;
    public $user_id;

    public function rules()
    {
        return [
            [['team_id', 'user_id'], 'required'] //user_id will be the id of the current user
        ];
    }

    public function attributeLabels()
    {
        return [
          'teams_ids' => 'Your teams',
          'user_id'   => 'Choose a user',
        ];
    }

    public function invite()
    {
        if($this->user_id) //should never be empty though
        {
            foreach($this->user_id as $userId)
            {
                //add team_id to the Invites column of the user
                \common\models\User::findOne(['id' => $userId])->addInvite($this->team_id);
            }
        }
    }
}