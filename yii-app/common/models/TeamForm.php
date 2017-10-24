<?php

namespace common\models;

use yii\base\Model;
use common\models\Team;
use Yii;
use yii\helpers\VarDumper;

class TeamForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $users;

    /**
     * rules
     */
    public function rules()
    {
        return [
            //name and description are both required
            [['name', 'description'], 'required'],
            //don't need blank spaces before and after the name/description
            [['name', 'description'], 'trim'],
            //don't need a HUGE name/description
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * Retains team information
     */
    public function create()
    {
        $team = new Team();
        $team->description = $this->description;
        $team->name = $this->name;
        $team->created_at = time();
        $team->updated_at = time();

        $ids = "";
        $ids = $ids . Yii::$app->user->identity->getId() . " "; //should always add yourself, the team creator, to the team
        if ($this->users)
        {
            $userids = $this->users;
            foreach ($userids as $id) {
                //first, add this user to the team
                $ids = $ids . $id . " ";
            }
        }
        $team->users_ids = $ids;

        $team->tickets_ids = ""; //for safety, the default value is ''

        $team->admins_ids = "" . Yii::$app->user->identity->getId() . " ";
        $team->project_manager_id = "";
        $team->developers_ids = "";
        $team->business_intelligences_ids = "";
        $team->observers_ids = "";
        return $team->save() ? $team : false;
    }
}