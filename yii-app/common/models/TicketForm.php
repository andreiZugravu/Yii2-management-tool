<?php

namespace common\models;

use yii\base\Model;
use common\models\Ticket;
use Yii;
use yii\helpers\VarDumper;

class TicketForm extends Model
{
    public $description;
    public $status;
    public $users;
    public $deadline;

    /**
     * rules
     */
    public function rules()
    {
        return [
          // description, status, users, deadline are all required
          [['description', 'status', 'users', 'deadline'], 'required'],
          //don't need blank spaces before and after the description,
          ['description', 'trim'],
          //don't need a HUGE description
          ['description', 'string', 'max' => 255],
        ];
    }

    /**
     * Retains ticket information
     */
    public function assign()
    {
        $ticket = new Ticket();
        $ticket->description = $this->description;
        $ticket->status = $this->status;

        $this->deadline .= ":00:00"; //we're not asking the user to pass the minute and the seconds, just the date and the hour

        $ticket->deadline = Yii::$app->formatter->asTime($this->deadline, 'yyyy-MM-dd hh-mm-ss');
        $ticket->created_at = time();
        $ticket->updated_at = time();
        $userids = $this->users;
        $ids = "";

        foreach ($userids as $id)
        {
            $ids = $ids . $id . " ";
        }

        $ticket->users_ids = $ids;

        return $ticket->save() ? $ticket : false;
    }
}