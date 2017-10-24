<?php

use yii\helpers\Html;

$this->title = 'View team tickets';
?>
<div class="site-view-team-tickets">
    <h1> <?= Html::encode($this->title) ?> </h1>
</div>

<?php
    $users = \common\models\User::findAll(['Role' => 'unclassifiedUser']); //THIS is how we're gonna get the users based on certain criterions : most often, their ROLES
    foreach ($users as $us) {
        echo 'User : ' . $us->username;
        echo "<br/>"; //later change this

        $ticketString = $us->Tickets;
        $index = 0;
        $length = strlen($ticketString);
        $ticketNumber = 0;

        if ($length == 0)
        {
            echo 'This user has no tickets at the moment.';
            echo "<br/>"; //later change this
        }

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

        echo "<br/>"; //later change this
    }
?>