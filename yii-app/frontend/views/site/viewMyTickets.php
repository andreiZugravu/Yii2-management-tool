<?php

/** @var $model \common\models\User */

use yii\helpers\Html;
use \common\models\myHelper;

$this->title = 'View my tickets';
?>
<div class="site-view-my-tickets">
    <h1> <?= Html::encode($this->title) ?> </h1>
</div>

<?php
    $tickets = myHelper::stringToArrayIntegers($model->Tickets);
    foreach ($tickets as $ticket)
    {
        echo $ticket . "<br/>";
    }
?>