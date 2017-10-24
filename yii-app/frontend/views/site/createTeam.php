<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/* @var $teamModel \common\models\Team */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\Models\Team;

$this->title = 'Create a team';
?>
<div class="site-create-team">
    <h1> <?= Html::encode($this->title) ?> </h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-assign-tickets']); ?>

            <?= $form->field($teamModel, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($teamModel, 'description')->textInput(['autofocus' => true]) ?>

            <?php
            $users = \common\models\User::findAll(['Role' => 'Unclassified']);

            $usernames = [];
            $index = 0;
            foreach($users as $user)
            {
                $usernames[$user->id] = $user->username;
            }

            echo $form->field($teamModel, 'users')->checkboxList($usernames);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Create-Team', ['class' => 'btn btn-danger', 'name' => 'create-team-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>