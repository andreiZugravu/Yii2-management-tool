<?php

/* @var $model \common\models\User */

use \yii\helpers\html;
use \common\models\myHelper;

$this->title = 'View my teams';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-view-my-teams">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php
                $teams = myHelper::stringToArrayIntegers($model->Teams);
                if($teams)
                {
                    foreach($teams as $team)
                        echo $team . " " . "<br/>";
                }
            ?>
        </div>
    </div>
</div>
