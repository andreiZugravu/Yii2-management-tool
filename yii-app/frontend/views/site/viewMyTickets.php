<?php

/** @var $model \common\models\User */

use yii\helpers\Html;

$this->title = 'View my tickets';
?>
<div class="site-view-my-tickets">
    <h1> <?= Html::encode($this->title) ?> </h1>
</div>

<?php
    $ticketString = $model->Tickets;
    $index = 0;
    $length = strlen($ticketString);
    $ticketNumber = 0;

    while($index < $length)
    {
        while ($index < $length && $ticketString[$index] === ' ') ++$index;
        //ignore white spaces

        $auxString = NULL;
        while($index < $length && is_numeric($ticketString[$index]))
        {
            $auxString .= $ticketString[$index];
            ++$index;
        }

        ++$ticketNumber;
        echo 'Ticket number ' . $ticketNumber . ' : ' . $auxString;
        echo "<br/>"; //later change this
    }
?>