<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/* @var $model \common\models\User */
/* @var $chooseTeamModel \common\models\ChooseTeam */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Team;

$this->title = "Choose a team to continue";
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-assign-tickets']); ?>

            <?php
                $teams_ids = $model->Teams;
                $index = 0;
                $length = strlen($teams_ids);
                $teams_array = [];

                while($index < $length)
                {
                    while ($index < $length && $teams_ids[$index] === ' ') ++$index;
                    //ignore white spaces

                    $teamNumber = NULL;
                    while($index < $length && is_numeric($teams_ids[$index]))
                    {
                        $teamNumber .= $teams_ids[$index];
                        ++$index;
                    }

                    $teams_array[$teamNumber] = \common\models\Team::findOne(['id' => $teamNumber])->name;
                }

                    echo $form->field($chooseTeamModel, 'team_id')->dropDownList($teams_array);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Choose Team', ['class' => 'btn btn-info', 'name' => 'choose-team-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>