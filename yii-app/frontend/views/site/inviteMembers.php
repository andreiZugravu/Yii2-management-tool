<?php

/* @var $model \common\models\User */
/* @var $inviteModel \common\models\Invite */

use \yii\helpers\html;
use \common\models\myHelper;
use yii\bootstrap\ActiveForm;

$this->title = 'Invite Members';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-invite-members">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-assign-tickets']); ?>

            <?php
                $teams = myHelper::stringToArrayIntegers($model->Teams);

                $teamNames = [];
                $index = 0;
                foreach ($teams as $teamId)
                {
                    $team_admins_ids = \common\models\Team::findOne(['id' => $teamId])->admins_ids;
                    $team_project_managers_ids = \common\models\Team::findOne(['id' => $teamId])->project_manager_id;

                    if(myHelper::findIdInString($team_admins_ids, Yii::$app->user->id) ||
                        myHelper::findIdInString($team_project_managers_ids, Yii::$app->user->id)) {
                        $teamNames[$teamId] = \common\models\Team::findOne(['id' => $teamId])->name;
                        ++$index;
                    }
                }

                if($index > 0)
                {
                    echo $form->field($inviteModel, 'team_id')->dropDownList($teamNames);
                }
                else
                {
                    echo "You're not an admin/project manager in any team yet!";
                    echo "<br/>";
                }
            ?>
            <?php
                $users = \common\models\User::find()->where(['!=', 'id', $model->id])->all(); //everyone else but me

                $usernames = [];
                foreach($users as $user)
                {
                    $usernames[$user->id] = $user->username;
                }

                echo $form->field($inviteModel, 'user_id')->checkboxList($usernames);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Invite Member', ['class' => 'btn btn-info', 'name' => 'invite-member-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
