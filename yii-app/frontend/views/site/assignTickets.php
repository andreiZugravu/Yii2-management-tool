<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/* @var $ticketModel \common\models\Ticket */
/* @var $chosen_team_id integer */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\Models\Ticket;

$this->title = 'Assign tickets';
?>
<div class="site-assign-tickets">
    <h1> <?= Html::encode($this->title) ?> </h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-assign-tickets']); ?>

            <?= $form->field($ticketModel, 'description')->textInput(['autofocus' => true]) ?>

            <?= $form->field($ticketModel, 'status')->dropDownList(
                    [
                        '1' => 'Low',
                        '2' => 'Normal',
                        '3' => 'Medium',
                        '4' => 'High',
                        '5' => 'Urgent'
                    ]
            ) ?>

            <?php
                $users= \common\models\Team::findOne(['id' => $chosen_team_id])->users_ids;

                $usernames = [];
                $index = 0;
                $length = strlen($users);
                while($index < $length)
                {
                    while($index < $length && $users[$index] == ' ') ++$index;
                    //skip white spaces

                    $userId = NULL;
                    while($index < $length && is_numeric($users[$index]))
                    {
                        $userId .= $users[$index];
                        ++$index;
                    }

                    if($userId != NULL)
                    {
                        $usernames[$userId] = \common\models\User::findOne(['id' => $userId])->username;
                    }
                }

                echo $form->field($ticketModel, 'users')->checkboxList($usernames);

            ?>

            <?= $form->field($ticketModel,'deadline')->textInput(['autofocus' => true]) ?>
            <div> <strong> Note : Please use the standard format : yyyy-MM-dd hh </strong> </div>
            <div class="form-group">
               <?= Html::submitButton('Assign-Tickets', ['class' => 'btn btn-info', 'name' => 'assign-tickets-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
