<?php

/** @var $model \common\models\User */

use yii\helpers\Html;

$this->title = 'No Permission';
?>
<div class="site-no-permission-tickets">
    <h1> <?= Html::encode("You do not have permission to do this, since your role is : " . $model->getRole()) ?> </h1>
    <?= "<br>"?>
</div>